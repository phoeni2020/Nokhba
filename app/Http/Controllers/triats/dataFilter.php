<?php

namespace App\Http\Controllers\triats;

use Carbon\Carbon;

trait dataFilter
{
    private function filterData($filterData)
    {
        $this->filterData = [];
        foreach ($filterData as $key => $value) {
            $op='LIKE';
            if($key=='valid'){
                $op = $value == true ? '>':'<';
                $value =Carbon::now();
                $key='valid_till';
            }
            (!empty($value)) ? array_push($this->filterData, ["$key","$op", "%$value%"]) : '';
        }
    }
}
