<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\triats\dataFilter;
use App\Http\Resources\userResource;
use App\Models\User;
use Illuminate\Http\Request;

class usersController extends Controller
{
    private $filterData =[];

    use dataFilter;

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function fillTableUser()
    {
        //order column
        $columnsOrder = request('order')[0]['column'];
        $orderType = request('order')[0]['dir'];
        $orderColumn = request('columns')[$columnsOrder]['data'];
        /*======================================================================= */
        $CoursesObject = User::query()->where('student','=',1);
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
        $recordsTotal = User::query()->where('student','=',1)->count();
        /*======================================================================= */
        $CoursesObject->skip(request('start'))
            ->take(request('length'))
            ->orderBy($orderColumn, $orderType);
        $storeEvents = $CoursesObject->get();
        /*======================================================================= */
        $storeEventsData = userResource::collection($storeEvents)
            ->additional([
                'draw' => intval(request('draw')),
                'recordsTotal' => $recordsTotal,
                'recordsFiltered' => $filteredDataCount,
            ]);
        return $storeEventsData;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  object  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with(['errorMessage'=>'User Banned']);
    }

    public function getUser(){
        $user = User::find(request('id'));
        return response()->json($user->toArray());
    }
}
