<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\QrCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QrController extends Controller
{
    private $filterData =[];
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $id = $request->user()->id;
        $start = $request->start;
        $limit = $request->limit;
        $CoursesObject = DB::table('view_teacher_lesson_qrs')
                        ->select('*')
                        ->where('student_id','=',$id);
        unset($id);

        $filter = request('filter');

        if (!empty($filter)) {
            $filterData = [];
            $dataFilter ='';
            foreach ($filter as $field => $value) {
                if(count($filter) > 1){
                    $dataFilter+="$field = $value";
                }
                else{
                    $dataFilter = "$field=$value";
                }
            }
            parse_str(html_entity_decode($dataFilter), $filterData);
            //dd($filterData);
            $this->filterData($filterData);
            $CoursesObject->where($this->filterData);
        }
        /*======================================================================= */
        // filtered data
        $filteredDataCount = $CoursesObject->count();
        /*======================================================================= */
        $recordsTotal = DB::table('view_teacher_lesson_qrs')
            ->count('*');
        /*======================================================================= */
        $CoursesObject
            ->skip($start)
            ->take($limit)
            ->orderBy($orderColumn??'qrCode_id', $orderType ?? 'ASC');
        $teachers = $CoursesObject->get();
        $teachersObject = [];
        $teachersObject['count'] = $recordsTotal;
        $teachersObject['qrCode']=$teachers->all();
        return response()->json($teachersObject);

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
