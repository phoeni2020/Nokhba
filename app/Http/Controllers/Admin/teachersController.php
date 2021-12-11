<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\triats\dataFilter;
use App\Http\Controllers\triats\ImageUrl;
use App\Http\Controllers\triats\Teacher;
use App\Http\Resources\linksResourse;
use App\Http\Resources\teacherResourse;
use App\Models\Link;
use App\Models\Teachers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class teachersController extends Controller
{
    use Teacher,ImageUrl,dataFilter;
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function fillTableTeachers()
    {
        try{
            //order column
            $columnsOrder = request('order')[0]['column'];
            $orderType = request('order')[0]['dir'];
            $orderColumn = request('columns')[$columnsOrder]['data'];
            /*======================================================================= */
            $CoursesObject = Teachers::query();
            /*======================================================================= */
            // filtered data
            $filteredDataCount = $CoursesObject->count();
            /*======================================================================= */
            $recordsTotal = Teachers::count();
            /*======================================================================= */
            $CoursesObject->skip(request('start'))
                ->take(request('length'))
                ->orderBy($orderColumn, $orderType);
            $storeEvents = $CoursesObject->get();
            /*======================================================================= */
            $storeEventsData = teacherResourse::collection($storeEvents)
                ->additional([
                    'draw' => intval(request('draw')),
                    'recordsTotal' => $recordsTotal,
                    'recordsFiltered' => $filteredDataCount,
                ]);
            return $storeEventsData;
        }
        catch(\Exception $e){
            return response()->json(['error'=>'Something Went Wrong']);
        }

    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function settingPage(){
        try {
            $authId = $this->getTeacherId();
            $teacher = isset($authId['object'][0])?$authId['object'][0]:'';
            if(empty($teacher)){
                return view('dashbord.teachers.create');
            }
            if(is_null($teacher->short_description) && is_null($teacher->subject)){
                return view('dashbord.teachers.create',['id'=>$teacher->id]);
            }
            return view('dashbord.teachers.create',['teacher'=>$teacher,'id'=>$teacher->id]);
        }
        catch (\Exception $e){
            return redirect()->back()->with(['error'=>$e]);
        }
    }

    /**
     * @param Teachers $teacher
     * @return \Illuminate\Http\RedirectResponse
     */
    public function banTeacher(Teachers $teacher)
    {
        $teacher->delete();
        return redirect()->back()->with(['errorMessage'=>'Teacher Band']);
    }
    /**
     * @param Request $request
     * @param Teachers $teacher
     * @throws \Illuminate\Validation\ValidationException
     */
    public function teacherSettings(Request $request){
        try {
            $validatedData = Validator::make($request->all(),
                [
                    'subject'=>'required',
                    'nickName'=>'required|min:3|max:50',
                    'short_description'=>'required',
                    'long_description'=>'required',
                    'video'=>'required|url',
                    'image' => 'mimes:jpg,jpeg,png,bmp,tiff|max:10000',
                ]
            );
            $teacher = Teachers::where('id','=',$request->teacher)->get();
            $validatedData->validated();
            $image='';
            if($request->has('image')) {
                $image = $request->file('image');
                $response = $this->uploadImage($image,0);
                $image = $response[0];
            }
            if(empty($teacher->toArray())){
                $teacher=Teachers::create([
                    'nickName'=>$request->nickName,
                    'short_description'=>$request->short_description,
                    'long_description'=>$request->long_description,
                    'vedio'=>$request->vedio,
                    'subject'=>$request->subject,
                    'image'=>$image,
                    'user_id'=>auth()->id(),
                ]);
            }
            else{
                $teacher[0]->nickName = $request->nickName;
                $teacher[0]->short_description = $request->short_description;
                $teacher[0]->long_description = $request->long_description;
                $teacher[0]->vedio = $request->video;
                $teacher[0]->subject = $request->subject;
                $teacher[0]->image = $image;
                $teacher[0]->save();
            }
            return redirect()->back()->with(['teacher'=>$teacher,'id'=>$teacher->id]);
        }
        catch (\Exception $e){
            return redirect()->back()->with(['error'=>$e->getMessage()]);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function addAssitant(Request $request){
        $id = $this->getTeacherId();

        $validatedData = Validator::make($request->all(), [
            'fName' => 'required|string|min:3|max:15',
            'mName' => 'required|string|min:3|max:15',
            'lName' => 'required|string|min:3|max:15',
            'email' => 'required|email|unique:users|confirmed',
            'password' => 'required|confirmed|min:8',
            'role' => 'required',
        ]);
        $data = $validatedData->validated();
        $user = User::create([
            'fName' => $data['fName'],
            'mName' => $data['mName'],
            'lName' => $data['lName'],
            'email' => $data['email'],
            'belongs_to_teacher' => auth()->user()->role == 'admin' || auth()->user()->role == 'teacher' ? auth()->user()->id : $id['user_id'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);
        return redirect()->back()->with(['message'=>'Assitant Added']);

    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function linksPage()
    {
        $teacher = $this->getTeacherId();
        //order column
        $columnsOrder = request('order')[0]['column'];
        $orderType = request('order')[0]['dir'];
        $orderColumn = request('columns')[$columnsOrder]['data'];
        /*======================================================================= */
        $CoursesObject = Link::where('teacher','=',$teacher['user_id']);
        /*======================================================================= */
        // filtered data
        $filteredDataCount = $CoursesObject->count();
        /*======================================================================= */
        $recordsTotal = Link::where('teacher','=',$teacher['user_id'])->count();
        /*======================================================================= */
        $CoursesObject->skip(request('start'))
            ->take(request('length'))
            ->orderBy($orderColumn, $orderType);
        $storeEvents = $CoursesObject->get();
        /*======================================================================= */
        $storeEventsData = linksResourse::collection($storeEvents)
            ->additional([
                'draw' => intval(request('draw')),
                'recordsTotal' => $recordsTotal,
                'recordsFiltered' => $filteredDataCount,
            ]);
        return $storeEventsData;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function storeLink(){
        try {
            $authId = $this->getTeacherId();
            $validatedData = Validator::make(request()->all(),[
                'links.*.title'=>'required|min:3|max:20',
                'links.*.hint'=>'min:3|max:75|nullable',
                'links.*.url'=>'max:250|url|nullable',
                'links.*.img'=>'max:250|url|nullable',
            ]);
            $data = $validatedData->validated();
            switch (count($data['links']) > 1 ){
                case true:
                    foreach ($data['links'] as $row){
                        Link::create([
                            'url'=>$row['url']??'#','title'=>$row['title'],'hint'=>$row['hint']??'',
                            'img'=>$row['img']??'','teacher'=>$authId['user_id']
                        ]);
                    }
                    break;
                case false:
                    Link::create([
                        'url'=>$data['links'][0]['url']??'#','title'=>$data['links'][0]['title'],'hint'=>$data['links'][0]['hint']??'',
                        'img'=>$data['links'][0]['img']??'','teacher'=>$authId['user_id']
                    ]);
                    break;
            }
            return redirect(route('admin.teachers.links.index'))->with(['message'=>'Links Added']);
        }
        catch(\Exception $e){
            dd($e);
        }
    }

    public function destroyLink (Link $link)
    {
        $link->delete();
        return redirect()->route('admin.teachers.links.index')->with(['message'=>'Link Deleted']);
    }
}
