<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\triats\Teacher;
use App\Http\Resources\attchResource;
use App\Models\Attch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;

class AttchController extends Controller
{
    use Teacher;

    private $filterData =[];

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function fillTableAttachs()
    {
        $teacher = $this->getTeacherId();
        //order column
        $columnsOrder = request('order')[0]['column'];
        $orderType = request('order')[0]['dir'];
        $orderColumn = request('columns')[$columnsOrder]['data'];
        /*======================================================================= */
        $CoursesObject = Attch::where('user_id','=',$teacher['user_id']);
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
        $recordsTotal = Attch::where('user_id','=',$teacher['user_id'])->count();
        /*======================================================================= */
        $CoursesObject->skip(request('start'))
            ->take(request('length'))
            ->orderBy($orderColumn, $orderType);
        $storeEvents = $CoursesObject->get();
        /*======================================================================= */
        $storeEventsData = attchResource::collection($storeEvents)
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
     * @return false|string
     */
    public function fillAttchDropdown(){
        $authId = $this->getTeacherId();
        $catgoryObject = Attch::select("id as id", "title as text")->where('user_id','=',$authId['user_id']);
        $searchword = request()->search;
        (!empty($searchword)) ? $catgoryObject->where([['title', 'LIKE', "%{$searchword}%"]]) : '';
        $categries =  $catgoryObject->get()->toArray();
        return json_encode($categries);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = Validator::make(
            $request->all(),
            [
                'attch.*.title' => 'required|string|min:3',
                'attch.*.description' => 'required|string|min:8',
                'attch.*.img' => 'required|mimes:jpg,jpeg,png,bmp,tiff,pdf|max:10000',
            ],
            [
                'title.required' => 'Name Is Required Field',
                'title.min' => 'Minimum Characters Is 3',
                'description.required' => 'Description is required',
                'img.required' => 'File Is Required Field',
                'img.mimes' => 'The File Must Be Image Or PDF',
                'img.max' => 'The File Must Be Maximam 10 Megabytes ',
            ]
        );

        if($validatedData->fails()){

            return redirect()->back()->withErrors($validatedData->errors()->messages());
        }

        $attach = new Attch();
        $dataArray = $request->except('_token');
        $authId = $this->getTeacherId();
        foreach ($dataArray['attch'] as $attachedItem) {

            $image = $attachedItem['img'];

            $imageExt = time().'.'.$image->extension();

            $destinationPath = public_path('/assets/attachs/');

            $image->move($destinationPath, $imageExt);

            $imageUrl = asset('assets/attachs').'/'.$imageExt;

            unset($attachedItem['img']);

            $attachedItem['fileurl'] = $imageUrl;

            $attachedItem['user_id'] = $authId['user_id'];

           $data = $attach::create(['title' =>$attachedItem['title'],'description'=>$attachedItem['description'],'fileurl' =>$attachedItem['fileurl'],'user_id' =>$attachedItem['user_id']]);

           if(!$data){
               App::abort(500);
           }
        }

        return redirect()->route('admin.attach.index')->with(['message'=>'Attachments Uploaded Successfully']);
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attch  $attch
     * @return \Illuminate\Http\Response
     */
    public function show(Attch $attch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attch  $attch
     * @return \Illuminate\Http\Response
     */
    public function edit(Attch $attch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attch  $attch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attch $attch)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attch  $attch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attch $attch)
    {
        //
    }
}
