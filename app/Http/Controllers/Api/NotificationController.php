<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notifaction;
use App\Models\Notifications;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$start,$limit)
    {
        $notificationObject = Notifaction::query();
        /*======================================================================= */
        $filteredDataCount = $notificationObject->count();
        /*======================================================================= */
        //$recordsTotal = Notifaction::count();
        /*======================================================================= */
        $startFrom = $start * $limit;
        $notificationObject->skip($startFrom)
            ->take($limit);
        $teachers = $notificationObject->get();
        $response = [];
        $response['count'] = $filteredDataCount;

        foreach ($teachers as $teacher) {
            $array = json_decode($teacher->body,true);
            $array['id']=$teacher->id;
            $response['notifications'][]=$array;
        }

        return response()->json($response);

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notifications  $notifications
     * @return \Illuminate\Http\Response
     */
    public function show(Notifications $notifications)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notifications  $notifications
     * @return \Illuminate\Http\Response
     */
    public function edit(Notifications $notifications)
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
    public function update(Request $request, Notifications $notifications)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notifications  $notifications
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notifications $notifications)
    {
        //
    }
}
