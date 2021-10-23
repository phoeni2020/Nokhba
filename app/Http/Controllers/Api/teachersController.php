<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Teachers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class teachersController extends Controller
{
    private $filterData;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $validatedData = $request->validate([
            'requestOrder.order' => 'required|string',
            'requestOrder.column' => 'required|string',
            'requestOrder.length' => 'required|string',
        ]);
        //order column
        $orderType = $validatedData['requestOrder']['order'];
        $orderColumn = $validatedData['requestOrder']['column'];
        $length = $validatedData['requestOrder']['length'];
        /*======================================================================= */
        $CoursesObject = Teachers::query()
            ->with('mainCategories')
            ->with('links');

        if (!empty(request('filter'))) {
            $filterData = [];
            parse_str(html_entity_decode(request('filter')), $filterData);
            $this->filterData($filterData);
            $CoursesObject->where($this->filterData);
        }
        /*======================================================================= */
        $recordsTotal = Teachers::count();
        /*======================================================================= */
        if($recordsTotal == 0){
            return response()->json(['count'=>0,'teachers'=>[]]);
        }
        $CoursesObject->skip(request('requestOrder')['start'])
            ->take($length)
            ->orderBy($orderColumn, $orderType);
        $teachers = $CoursesObject->get()->all();
        $teachersObject['count'] = $recordsTotal;
        $teachersObject['teachers'] = $teachers;
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
}
