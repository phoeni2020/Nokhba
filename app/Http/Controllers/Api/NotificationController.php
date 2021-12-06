<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\triats\dataFilter;
use App\Models\Notifaction;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    private $filterData =[];
    private $data = [];
    private $index = 0;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$start,$limit)
    {
        $notificationObject = Notifaction::query();
        /*======================================================================= */
        if (!empty(request('filter'))) {
            $dataFilter ='';
            foreach (request('filter') as $field => $value) {
                if(count(request('filter')) > 1){
                    $dataFilter.="$field=$value&";
                }
                else{
                    $dataFilter = "$field=$value";
                }
            }
            parse_str(html_entity_decode($dataFilter), $filterData);
            $this->filterData($filterData);
            $notificationObject->where($this->filterData);
            $recordsTotal = $notificationObject->where($this->filterData)->count();
        }

        $filteredDataCount = $notificationObject->count();
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
            $array['teacher']=$teacher->user_id;
            $response['notifications'][]=$array;
        }

        return response()->json($response);

    }

    private function filterData($filterData)
    {
        $this->filterData = [];
        foreach ($filterData as $key => $value) {
            $op='LIKE';
            if($key=='teacher'){
                $key='user_id';
            }
            (!empty($value)) ? array_push($this->filterData, ["$key","$op", "%$value%"]) : '';
        }
    }



}
