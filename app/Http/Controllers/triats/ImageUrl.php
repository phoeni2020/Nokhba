<?php

namespace App\Http\Controllers\triats;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
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
            })->save($destinationPath.$imageExt.'.webp');

            $thumbnailsUrl = asset('/assets/img/thaumbnail').'/'.$imageExt.'.webp';
        }

        $destinationPath = public_path('assets/img/uploaded');

        $image->move($destinationPath, $imageExt.'.webp');

        $imageUrl = asset('/assets/img/uploaded').'/'.$imageExt.'.webp';

        $response = [$imageUrl];

        isset($thumbnailsUrl) ? $response[] = $thumbnailsUrl : '';

        return $response;
    }

    function imageBase64($image){
        $name =time();
        Storage::disk('public')->put($name.'.webp', base64_decode($image));
        return $name.'.webp';
    }
}
