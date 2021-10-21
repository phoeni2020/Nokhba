<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\triats\ImageUrl;
use App\Http\Resources\catgoryResource;
use App\Models\Catgory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
class CatgoryController extends Controller
{
    private $filterData =[];
    use ImageUrl;
    /**
    * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    */
    public function fillTableCatgory()
    {
        //order column
        $columnsOrder = request('order')[0]['column'];
        $orderType = request('order')[0]['dir'];
        $orderColumn = request('columns')[$columnsOrder]['data'];
        /*======================================================================= */
        $CoursesObject = Catgory::query();
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
        $recordsTotal = Catgory::count();
        /*======================================================================= */
        $CoursesObject->skip(request('start'))
            ->take(request('length'))
            ->orderBy($orderColumn, $orderType);
        $storeEvents = $CoursesObject->get();
        /*======================================================================= */
        $storeEventsData = catgoryResource::collection($storeEvents)
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
    public function fillCategoryDropdown(){
        $catgoryObject = Catgory::select("id as id", "name as text");
        $searchword = request()->search;
        (!empty($searchword)) ? $catgoryObject->where([['name', 'LIKE', "%{$searchword}%"]]) : '';
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
                'name' => 'required|string|min:3',
                'desc' => 'required|string|min:8',
                'img' => 'required|mimes:jpg,jpeg,png,bmp,tiff|max:10000',
            ],
            [
                'name.required' => 'Name Is Required Field',
                'name.min' => 'Minimum Characters Is 3',
                'desc.required' => 'Description is required',
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

        $user = auth()->user()->id;
        if($request->has('main')){
            $mainCategory  = Catgory::create([
                'name'=>$request->name,'desc'=>$request->desc,
                'main'=>0,'is_parent'=>1,'img_url'=>$imageUrl,
                'thmubnil_img_url'=>$thumbnailsUrl,'user_id'=>$user
            ]
            );
            return redirect()->route('admin.catgory.index')->with(['message'=>'Category Created']);
       }
        elseif($request->has('is_parent')){
            $validatedData = Validator::make(
                $request->all(),
                [
                    'main_cat' => 'required|exists:catgories,id',
                    'parent' => 'required|exists:catgories,id',
                ],
                [
                    'main_cat.required' => 'Main Category Is Required Field',
                    'parent.required' => 'parent Category Is Required Field',
                ]
            );

            if($validatedData->fails()){

                return redirect()->back()->withInput($request->all())->withErrors($validatedData->errors()->messages());
            }
            $parentCategory  = Catgory::create(
                [
                    'name'=>$request->name,'desc'=>$request->desc,
                    'main'=>$request->main_cat, 'is_parent'=>1,'parent'=>$request->parent,
                    'img_url'=>$imageUrl,'thmubnil_img_url'=>$thumbnailsUrl,'user_id'=>$user
                ]
            );
            return redirect()->route('admin.catgory.index')->with(['massage'=>'Category Created']);
        }
        elseif ($request->has('child')){
            $validatedData = Validator::make(
                $request->all(),
                [
                    'child' => 'required|exists:catgories,id',
                ],
                [
                    'child.required' => 'Parent Category Is Required Field',
                ]
            );
            if($validatedData->fails()){

                return redirect()->back()->withInput($request->all())->withErrors($validatedData->errors()->messages());
            }
            $main = Catgory::find($request->child)->main;
            $mainId = $main == 0 ? $request->child:$main;
            $parentCategory  = Catgory::create([
                'name'=>$request->name,'desc'=>$request->desc,'main'=>$mainId,
                'is_parent'=>0,'parent'=>$request->child,
                'img_url'=>$imageUrl,'thmubnil_img_url'=>$thumbnailsUrl,'user_id'=>$user
            ]);
            return redirect()->route('admin.catgory.index')->with(['massage'=>'Category Created']);
        }
        else{
            return redirect()->back()->withInput($request->all())->withErrors('Please Check Your Data');
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Catgory  $catgory
     * @return \Illuminate\Http\Response
     */
    public function edit(Catgory $category)
    {
        return view('dashbord.catgory.edit',['catgory' => $category]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Catgory  $catgory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Catgory $catgory)
    {
        $validatedData = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|min:3',
                'desc' => 'required|string|min:8',
                'img' => 'mimes:jpg,jpeg,png,bmp,tiff|max:10000',
            ],
            [
                'name.required' => 'Name Is Required Field',
                'name.min' => 'Minimum Characters Is 3',
                'desc.required' => 'Description is required',
                'img.required' => 'Photo Is Required Field',
                'img.mimes' => 'The File Must Be Image',
                'img.max' => 'The Image Must Be Maximam 10 Megabytes ',
            ]
        );

        if($validatedData->fails()){

            return redirect()->back()->withErrors($validatedData->errors()->messages());
        }

        if($request->has('img')){

            $catgory->img_url ? '' : $this->unlinkImage($catgory->img_url);
            $catgory->thmubnil_img_url == null ? '' : $this->unlinkImage($catgory->thmubnil_img_url);

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

            $catgory->img_url = $imageUrl;

            $catgory->thmubnil_img_url = $thumbnailsUrl;
        }

        if($request->has('main')){
            $catgory->name = $request->name;
            $catgory->desc = $request->desc;
            $catgory->main = $request->main;
            $catgory->is_parent = $request->is_parent;
            $catgory->is_parent = $request->is_parent;
            $catgory->save();
            return redirect()->route('admin.catgory.index')->with(['message'=>'Category Updated']);
        }
        elseif($request->has('is_parent')){
            $validatedData = Validator::make(
                $request->all(),
                [
                    'main_cat' => 'required|exists:catgories,id',
                    'parent' => 'required|exists:catgories,id',
                ],
                [
                    'main_cat.required' => 'Main Category Is Required Field',
                    'parent.required' => 'parent Category Is Required Field',
                ]
            );
            $validatedData->validated();

            $catgory->name = $request->name;
            $catgory->desc = $request->desc;
            $catgory->main = $request->main_cat;
            $catgory->is_parent = 1;
            $catgory->parent = $request->parent;
            $catgory->save();

            return redirect()->route('admin.catgory.index')->with(['massage'=>'Category Updated']);
        }
        elseif ($request->has('child')){
            $validatedData = Validator::make(
                $request->all(),
                [
                    'child' => 'required|exists:catgories,id',
                ],
                [
                    'child.required' => 'Parent Category Is Required Field',
                ]
            );
            $validatedData->validated();
            $main = Catgory::find($request->child)->main;

            $mainId = $main == 0 ? $request->child:$main;

            $catgory->name = $request->name;
            $catgory->desc = $request->desc;
            $catgory->main = $mainId;
            $catgory->is_parent = 0;
            $catgory->parent = $request->child;

            return redirect()->route('admin.catgory.index')->with(['massage'=>'Category Updated']);
        }
        else{
            return redirect()->back()->withInput($request->all())->withErrors('Please Check Your Data');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Catgory  $catgory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Catgory $category)
    {
        $category->delete();
        return redirect()->back()->with(['errorMessage'=>'Catgory Deleted']);
    }
}
