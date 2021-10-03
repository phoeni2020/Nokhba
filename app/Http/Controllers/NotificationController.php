<?php

namespace App\Http\Controllers;

use App\Models\Notifaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ddd($request);
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
            ddd($jsonObject);
            Notifaction::create(['body'=>$jsonObject]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notifications  $notifications
     * @return \Illuminate\Http\Response
     */
    public function show(Notification $notifications)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notifications  $notifications
     * @return \Illuminate\Http\Response
     */
    public function edit(Notification $notifications)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notifications  $notifications
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notification $notifications)
    {
        //
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
