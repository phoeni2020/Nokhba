<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\massageResource;
use App\Models\Converstion;

class MassageController extends Controller
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function fillTableMassage()
    {
        //order column
        $columnsOrder = request('order')[0]['column'];
        $orderType = request('order')[0]['dir'];
        $orderColumn = request('columns')[$columnsOrder]['data'];
        /*======================================================================= */
        $CoursesObject = Converstion::query()->where('user_id', '=', 1);
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
        $recordsTotal = Converstion::query()->where('user_id', '=', 1)->count();
        /*======================================================================= */
        $CoursesObject->skip(request('start'))
            ->take(request('length'))
            ->orderBy($orderColumn, $orderType);
        $storeEvents = $CoursesObject->get();
        /*======================================================================= */
        $storeEventsData = massageResource::collection($storeEvents)
            ->additional([
                'draw' => intval(request('draw')),
                'recordsTotal' => $recordsTotal,
                'recordsFiltered' => $filteredDataCount,
            ]);
        return $storeEventsData;
    }

    public function chat(Converstion $converstion)
    {

    }
}
