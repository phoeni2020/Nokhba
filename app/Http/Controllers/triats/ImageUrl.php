<?php

namespace App\Http\Controllers\triats;

use Intervention\Image\Facades\Image;

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

    function uploadImage($image ,$thumbnail){
        $imageExt = time().$image->extension();

        $img = Image::make($image->path());
        if($thumbnail == 1){
            $destinationPath = public_path('/assets/img/thaumbnail/');

            $img->resize(150, 150, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.$imageExt);

            $thumbnailsUrl = asset('/assets/img/thaumbnail').'/'.$imageExt;
        }

        $destinationPath = public_path('assets/img/uploaded');

        $image->move($destinationPath, $imageExt);

        $imageUrl = asset('/assets/img/uploaded').'/'.$imageExt;

        $response = [$imageUrl];

        isset($thumbnailsUrl) ? $response[] = $thumbnailsUrl : '';

        return $response;
    }
}
