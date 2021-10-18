<?php

namespace App\Http\Controllers\triats;

trait ImageUrl
{
    function unlinkImage($Url){
        $parts = explode('/',$Url);
        $parts_i_want = array_slice($parts, 6); // take everything from offset=6 on
        $path = implode('/',$parts_i_want);
        if(file_exists(public_path($path))){
            unlink(public_path($path));
        }
    }
}
