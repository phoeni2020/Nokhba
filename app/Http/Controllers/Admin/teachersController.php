<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\triats\ImageUrl;
use App\Http\Controllers\triats\Teacher;
use App\Http\Resources\teacherResourse;
use App\Models\Teachers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class teachersController extends Controller
{
    use Teacher,ImageUrl;
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function fillTableTeachers()
    {
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

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function settingPage(){
        $authId = $this->getTeacherId();
        $teacher = $authId['object'][0];
        if(is_null($teacher->short_description) && is_null($teacher->subject)){
            return view('dashbord.teachers.create',['id'=>$teacher->id]);
        }
        return view('dashbord.teachers.create',['teacher'=>$teacher,'id'=>$teacher->id]);
    }

    /**
     * @param Request $request
     * @param Teachers $teacher
     * @throws \Illuminate\Validation\ValidationException
     */
    public function teacherSettings(Request $request,Teachers $teacher){
        $validatedData = Validator::make($request->all(),
                [
                    'subject'=>'required',
                    'short_description'=>'required',
                    'long_description'=>'required',
                    'video'=>'required|url',
                    'image' => 'mimes:jpg,jpeg,png,bmp,tiff|max:10000',
                ]
        );
        $validatedData->validated();
        if($request->has('image')) {
            $image = $request->file('image');
            $response = $this->uploadImage($image,0);
            $teacher->image = $response[0];
        }

        $teacher->short_description = $request->short_description;
        $teacher->long_description = $request->long_description;
        $teacher->vedio = $request->video;
        $teacher->subject = $request->subject;
        $teacher->save();
        return redirect()->back()->with(['teacher'=>$teacher,'id'=>$teacher->id]);
    }

    public function addAssitant(Request $request){
        $validatedData = Validator::make($request->all(),[
            'fName'=>'required|string|min:3|max:15',
            'mName'=>'required|string|min:3|max:15',
            'lName'=>'required|string|min:3|max:15',
            'email'=>'required|email|unique:users|confirmed',
            'password'=>'required|confirmed|min:8',
            'role'=>'required',
        ]);
        $data = $validatedData->validated();
        $user = User::create([
            'fName' => $data['fName'],
            'mName' => $data['mName'],
            'lName' => $data['lName'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);
        return redirect()->back()->with(['message'=>'Assitant Added']);

    }
}
