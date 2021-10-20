<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\triats\ImageUrl;
use App\Models\Converstion;
use App\Models\Massge;
use App\Models\Teachers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class MassagesController extends Controller
{
    use ImageUrl;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $teacher)
    {
        $teacher = Teachers::where('user_id', $teacher)->get();
        $user = $request->user();
        if (empty($teacher->all())) {
            return response()->json(['error' => 'That Teacher No Longer Exists'], 404);
        }
        $validatedData = $request->validate([
            'requestOrder.order' => 'required|string',
            'requestOrder.column' => 'required|string',
            'requestOrder.length' => 'required|string',
        ]);
        //order column
        $orderType = $validatedData['requestOrder']['order'];
        $orderColumn = $validatedData['requestOrder']['column'];
        $length = $validatedData['requestOrder']['length'];
        /*======================================================================= */
        $converstionObject = Converstion::query()
            ->select(['converstion.id'])->where('user_id','=',$user->id)->get('id');
        $CoursesObject = Massge::where('convsertion','=',$converstionObject[0]->id)
            ->with('user');

        if (!empty(request('filter'))) {
            $filterData = [];
            parse_str(html_entity_decode(request('filter')), $filterData);
            $this->filterData($filterData);
            $CoursesObject->where($this->filterData);
        }
        /*======================================================================= */
        $recordsTotal = Massge::where('convsertion','=',$converstionObject[0]->id)->count();
        /*======================================================================= */
        if($recordsTotal == 0){
            return response()->json(['count'=>0,'teachers'=>[]]);
        }
        $CoursesObject->skip(request('requestOrder')['start'])
            ->take($length)
            ->orderBy($orderColumn, $orderType);
        $teachers = $CoursesObject->get()->all();
        $teachersObject['count'] = $recordsTotal;
        $teachersObject['massages'] = $teachers;
        return response()->json($teachersObject);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$teacher)
    {
        try {
            $teacher = Teachers::where('user_id', $teacher)->get();
            if (empty($teacher->all())) {
                return response()->json(['error' => 'That Teacher No Longer Exists'], 404);
            }
            $validatedData = Validator::make($request->all(), [
                'image' => 'mimes:jpg,jpeg,png,bmp,tiff|max:10000'
            ]);
            $name = $this->imageBase64($request->image);
            $imageUrl = asset('storage') . '/' . $name;
            $student = $request->user();
            $converstionId = Converstion::where('user_id', '=', $student->id)->where('teahcer', '=', $teacher[0]->user_id)->get();
            $converstionId = empty($converstionId->all()) ?
                Converstion::create(['user_id' => $student->id, 'teahcer' => $teacher[0]->user_id])->id : $converstionId[0]->id;
            $massage = Massge::create(
                [
                    'massge' => $request->massage ?? null, 'attchment' => $imageUrl ?? null, 'user_id' => $student->id,
                    'convsertion' => $converstionId
                ]);
            $response = [
                'user' => [
                    'id' => $student->id,
                    'name' => $student->fullname(),
                    'image' => $imageUrl ?? ''
                ],
                'id' => $massage->id,
                'message' => $request->massage ?? '',
                'attachment_image' => $imageUrl ?? '',
                'date' => $massage->created_at->format('Y-m-d H:i:s'),
            ];
            return response()->json($response, 200);
        }
        catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

}