<?php

namespace App\Http\Controllers;

use App\Http\Controllers\triats\ImageUrl;
use App\Http\Controllers\triats\Teacher;
use App\Http\Resources\notificationResource;
use App\Models\Notifaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class NotificationController extends Controller
{
    private $filterData =[];
    use ImageUrl,Teacher;
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function fillTableNotifications()
    {
        $teacher = $this->getTeacherId();
        //order column
        $columnsOrder = request('order')[0]['column'];
        $orderType = request('order')[0]['dir'];
        $orderColumn = request('columns')[$columnsOrder]['data'];
        /*======================================================================= */
        $CoursesObject = Notifaction::where('user_id','=',$teacher['user_id']);
        if (!empty(request('filter'))) {
            $filterData = [];
            parse_str(html_entity_decode(request('filter')), $filterData);
            $this->filterData($filterData);
            $CoursesObject->where($this->filterData);
        }
        /*======================================================================= */
        // filtered data
        $filteredDataCount = $CoursesObject->count();
        /*======================================================================= */
        $recordsTotal = Notifaction::where('user_id','=',$teacher['user_id'])->count();
        /*======================================================================= */
        $CoursesObject->skip(request('start'))
            ->take(request('length'))
            ->orderBy($orderColumn, $orderType);
        $storeEvents = $CoursesObject->get();
        /*======================================================================= */
        $storeEventsData = notificationResource::collection($storeEvents)
            ->additional([
                'draw' => intval(request('draw')),
                'recordsTotal' => $recordsTotal,
                'recordsFiltered' => $filteredDataCount,
            ]);
        return $storeEventsData;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $teacher = $this->getTeacherId();

        $validatedData = Validator::make(
            $request->all(),
            [
                'title' => 'required|string|min:3',
                'body' => 'required|string|min:8',
                'img' => 'required|mimes:jpg,jpeg,png,bmp,tiff|max:10000',
            ],
            [
                'title.required' => 'Title Is Required Field',
                'Title.min' => 'Minimum Characters Is 3',
                'body.required' => 'Notification Massage is required',
                'img.required' => 'Photo Is Required Field',
                'img.mimes' => 'The File Must Be Image',
                'img.max' => 'The Image Must Be Maximam 10 Megabytes ',
            ]
        );

        if($validatedData->fails()){

            return redirect()->back()->withErrors($validatedData->errors()->messages());
        }

        $image = $request->file('img');

        $imageExt = time().$image->extension();

        $img = Image::make($image->path());

        $destinationPath = public_path('/assets/img/thaumbnail/');

        $img->resize(150, 150, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.$imageExt);

        $destinationPath = public_path('assets/img/uploaded');

        $image->move($destinationPath, $imageExt);

        $thumbnailsUrl = asset('/assets/img/thaumbnail').'/'.$imageExt;

        $imageUrl = asset('/assets/img/uploaded').'/'.$imageExt;
        if($request->has('eventUrl')) {
            $arrayData = array('title' => $request->title, 'body' => $request->body, 'img' => $imageUrl, 'thaumbnail' => $thumbnailsUrl,
                'action' => ['name' => $request->btnTitle, 'url' => $request->btnUrl]);
            $jsonObject = json_encode($arrayData);
            Notifaction::create(['body'=>$jsonObject,'teacher'=>$teacher['user_id']]);
            return redirect()->route('admin.notifications.index')->with(['message'=>'Notifications Send Successfully']);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notifications  $notifications
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notification $notifications)
    {
        //
    }
}
