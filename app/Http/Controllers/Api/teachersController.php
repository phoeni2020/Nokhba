<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Follow;
use App\Models\StudentViews;
use App\Models\Teachers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;

class teachersController extends Controller
{
    private $filterData = [];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

            if($request->hasHeader('authorization')){
                $token = explode('|', $request->header('authorization'), 2);
                $user = PersonalAccessToken::where('token', hash('sha256', $token[1]))->with('tokenable')->get();
                $id = $user[0]->tokenable->id;
            }
            $validatedData = Validator::make(
                $request->all(),
                [
                'requestOrder.order' => 'required|string',
                'requestOrder.column' => 'required|string',
                'requestOrder.length' => 'required|string',
            ]);
            $validatedData->validated();
            //order column
            $orderType = $validatedData['requestOrder']['order'];
            $orderColumn = $validatedData['requestOrder']['column'];
            $length = $validatedData['requestOrder']['length'];
            /*======================================================================= */
            $CoursesObject = Teachers::query()
                ->with('mainCategories')
                ->with('links');

            /*======================================================================= */
            $recordsTotal = Teachers::count();
            if (!empty(request('filter'))) {
                $dataFilter = '';
                foreach (request('filter') as $field => $value) {
                    if (count(request('filter')) > 1) {
                        $dataFilter .= "$field=$value&";
                    } else {
                        $dataFilter = "$field=$value";
                    }
                }
                parse_str(html_entity_decode($dataFilter), $filterData);
                $this->filterData($filterData);
                $CoursesObject->where($this->filterData);
                $recordsTotal = $CoursesObject->where($this->filterData)->count();
            }
            /*======================================================================= */
            if ($recordsTotal == 0) {
                return response()->json(['count' => 0, 'teachers' => []]);
            }
            $CoursesObject->skip(request('requestOrder')['start'])
                ->take($length)
                ->orderBy($orderColumn, $orderType);
            $teachers = $CoursesObject->get()->all();
            foreach ($teachers as $teacher) {
                if(isset($id)){
                    $follow = empty(Follow::where('teacher','=',$teacher->id)->where('user_id','=',$id)->get()->all())?
                        false:true;
                    $teacher['is_followed'] = $follow;
                }
                else{
                    $teacher['is_followed'] =false;
                }
            }
            $teachersObject['count'] = $recordsTotal;
            $teachersObject['teachers'] = $teachers;
            return response()->json($teachersObject);

    }

    /**
     * @param $filterData
     */
    private function filterData($filterData)
    {
        $this->filterData =[];
        foreach ($filterData as $key => $value) {

            (!empty($value)) ? array_push($this->filterData, ["$key", 'LIKE', "%$value%"]) : '';
        }
    }

    public function courseViews(Course $course,$vedio){
        try{
            $course->views+=1;
            $vedioObject = json_decode($course->vedio,true);
            $vedioObject[0]['views']+=1;
            $course->vedio=json_encode($vedioObject);
            $course->save();
            $userId = request()->user();
            $views = StudentViews::where('student','=',$userId->id)->where('course','=',$course->id)->get()->all();
            if(empty($views)){
                StudentViews::create(['student'=>$userId->id,'course'=>$course->id,'views'=>1]);
            }
            $views[0]->views+=1;
            $views[0]->save();
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
