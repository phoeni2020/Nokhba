<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\triats\Teacher;
use App\Http\Resources\courseResource;
use App\Models\Attch;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class CourseController extends Controller
{
    use Teacher;
    private $filterData =[];

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function fillTableCourses()
    {
        //order column
        $columnsOrder = request('order')[0]['column'];
        $orderType = request('order')[0]['dir'];
        $orderColumn = request('columns')[$columnsOrder]['data'];
        /*======================================================================= */
        $CoursesObject = Course::query();
        /*======================================================================= */
        if (!empty(request('filter'))) {
            $filterData = [];
            parse_str(html_entity_decode(request('filter')), $filterData);
            $this->filterData($filterData);
            $CoursesObject->where($this->filterData);
        }
        // filtered data
        $filteredDataCount = $CoursesObject->count();
        /*======================================================================= */
        $recordsTotal = Course::count();
        /*======================================================================= */
        $CoursesObject->skip(request('start'))
            ->take(request('length'))
            ->orderBy($orderColumn, $orderType);
        $storeEvents = $CoursesObject->get();
        /*======================================================================= */
        $storeEventsData = courseResource::collection($storeEvents)
            ->additional([
                'draw' => intval(request('draw')),
                'recordsTotal' => $recordsTotal,
                'recordsFiltered' => $filteredDataCount,
            ]);
        return $storeEventsData;
    }

    /**
     * @return false|string
     */
    public function fillCourseDropdown(){
        $authId = $this->getTeacherId();
        $catgoryObject = Course::select("id as id", "title as text")->where('user_id','=',$authId);
        $searchword = request()->search;
        (!empty($searchword)) ? $catgoryObject->where([['title', 'LIKE', "%{$searchword}%"]]) : '';
        $categries =  $catgoryObject->get()->toArray();
        return json_encode($categries);
    }

    /**
     * @param $filterData
     */
    private function filterData($filterData)
    {
        foreach ($filterData as $key => $value) {
            (!empty($value)) ? array_push($this->filterData, ["$key", 'LIKE', "%$value%"]) : '';
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(),
            [
                'title'=>'required|string|min:5',
                'desc'=>'required|string|min:5',
                'img'=>'required|mimes:jpg,jpeg,png,bmp,tiff|max:10000',
                'category_id'=>'required',
                'attch.*'=>'required|string',
                'vedios.*.url'=>'required|string|url',
                'vedios.*.desc'=>'required|string|min:10',
            ],
        );

        $data = $validatedData->validated();

        $image = $request->file('img');

        $imageExt = time().$image->extension();

        $img = Image::make($image->path());

        $destinationPath = public_path('/assets/img/thaumbnail/');

        $img->resize(150, 150, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.$imageExt);

        $thumbnailsUrl = asset('/assets/img/thaumbnail').'/'.$imageExt;

        $id =$this->getTeacherId();

        $lessonObject = Course::create(
            [
                'title'=>$data['title'],
                'desc'=>$data['desc'],
                'img'=>$thumbnailsUrl,
                'vedio'=>json_encode($data['vedios']),
                'category_id'=>$data['category_id'],
                'user_id'=>$id['user_id'],
            ]
        );

        foreach ($data['attch'] as $attch ){
            $attchObject = Attch::find($attch);
            $attchObject->lesson_id = $lessonObject->id;
            $attchObject->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        //
    }
}
