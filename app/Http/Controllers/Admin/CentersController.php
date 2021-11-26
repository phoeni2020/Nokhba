<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\triats\Teacher;
use App\Http\Resources\centerResource;
use App\Models\Center;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CentersController extends Controller
{
    private $filterData =[];
    use Teacher;

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function fillTableCenter()
    {
        $teacher = $this->getTeacherId();
        if(isset($teacher['error'])){
            return redirect(url('/logout'));
        }
        //order column
        $columnsOrder = request('order')[0]['column'];
        $orderType = request('order')[0]['dir'];
        $orderColumn = request('columns')[$columnsOrder]['data'];
        /*======================================================================= */
        $CoursesObject = Center::where('user_id','=',$teacher['user_id']);
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
        $recordsTotal = Center::where('user_id','=',$teacher['user_id'])->count();
        /*======================================================================= */
        $CoursesObject->skip(request('start'))
            ->take(request('length'))
            ->orderBy($orderColumn, $orderType);
        $storeEvents = $CoursesObject->get();
        /*======================================================================= */
        $storeEventsData = centerResource::collection($storeEvents)
            ->additional([
                'draw' => intval(request('draw')),
                'recordsTotal' => $recordsTotal,
                'recordsFiltered' => $filteredDataCount,
            ]);
        return $storeEventsData;
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
        $teacher = $this->getTeacherId();

        $validatedData = Validator::make($request->all(),[
            'center.*.name'=>'required|min:2|max:100',
            'center.*.address'=>'min:9|nullable',
        ]);
        $data = $validatedData->validate();
        foreach ( $data['center'] as  $row) {
            $row['user_id'] = $teacher['user_id'];
            Center::create($row);
        }
        return redirect()->route('admin.teachers.center.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Center  $center
     * @return \Illuminate\Http\Response
     */
    public function show(Center $center)
    {
        return view('dashbord.teachers.center.edit')->with(['center'=>$center]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Center  $center
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Center $center)
    {
        $validatedData = Validator::make($request->all(),[
            'name'=>'required|min:2|max:100',
            'address'=>'min:9|nullable',
        ]);
        $data = $validatedData->validate();
        $center->name = $request->name;
        $center->address = $request->address;
        $center->save();
        return redirect()->route('admin.teachers.center.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Center  $center
     * @return \Illuminate\Http\Response
     */
    public function destroy(Center $center)
    {
        $center->delete();
        return redirect()->back();
    }
    /**
     * @return false|string
     */
    public function fillCenterDropdown(){
        $authId = $this->getTeacherId();
        $catgoryObject = Center::select("id as id", "name as text")->where('user_id','=',$authId);
        $searchword = request()->search;
        (!empty($searchword)) ? $catgoryObject->where([['title', 'LIKE', "%{$searchword}%"]]) : '';
        $categries =  $catgoryObject->get()->toArray();
        return json_encode($categries);
    }
}
