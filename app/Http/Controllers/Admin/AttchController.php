<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\attchResource;
use App\Http\Resources\courseResource;
use App\Models\Attch;
use App\Models\Course;
use App\Models\Teachers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class AttchController extends Controller
{
    private $filterData =[];
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function fillTableAttachs()
    {
        //order column
        $columnsOrder = request('order')[0]['column'];
        $orderType = request('order')[0]['dir'];
        $orderColumn = request('columns')[$columnsOrder]['data'];
        /*======================================================================= */
        $CoursesObject = Attch::query();
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
        $recordsTotal = Attch::count();
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
                'img.required' => 'Photo Is Required Field',
                'img.mimes' => 'The File Must Be Image',
                'img.max' => 'The Image Must Be Maximam 10 Megabytes ',
            ]
        );

        if($validatedData->fails()){

            return redirect()->back()->withErrors($validatedData->errors()->messages());
        }

        $attach = new Attch();
        $dataArray = $request->except('_token');
        $response = Teachers::isTeacher();
        $authId = $response['userId'];
        if($response['isTeacher'] === false){
            $teacher =  User::assistant();
            $authId = $teacher->user->id;
        }
        foreach ($dataArray['attch'] as $attachedItem) {

            $image = $attachedItem['img'];

            $imageExt = time().'.'.$image->extension();

            $destinationPath = public_path('/assets/attachs/');

            $image->move($destinationPath, $imageExt);

            $imageUrl = asset('assets/attachs').'/'.$imageExt;

            unset($attachedItem['img']);

            $attachedItem['fileurl'] = $imageUrl;

            $attachedItem['user_id'] = $authId;

           $data = $attach::create($attachedItem);

           if(!$data){
               App::abort(500);
           }
        }

        return redirect()->route('admin.attach.index')->with(['message'=>'Attachments Uploaded Successfully']);
    }

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
