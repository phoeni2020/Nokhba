<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

class DashbordController extends Controller
{
    public function index($id)
    {
        if(view()->exists("dashbord.$id")){
            return view("dashbord.$id");
        }
        else{
            return view('dashbord.404');
        }

        //   return view($id);
    }
}
