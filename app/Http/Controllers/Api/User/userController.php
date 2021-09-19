<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
use PHPUnit\TextUI\Exception;

class userController extends Controller
{
    /**
     * @param PersonalAccessToken $userToken
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request){
        $user = $request->user();
        if(is_null($user->fName)){
            return response()->json(['user'=>$user,'token'=>$request->token,'dataComplete'=>false]);
        }
        return response()->json(['user'=>$user,'token'=>$request->token,'dataComplete'=>true]);
    }

    /**
     * @param PersonalAccessToken $userToken
     * @param Request $request
     * @return Exception|\Illuminate\Http\JsonResponse|Exception
     */
    public function completeData(Request $request){
        try {
            if($request->hasHeader('token')){
                $validatedData = $request->validate([
                    'fName'=>'required|string|min:3',
                    'mName'=>'required|string|min:3',
                    'lName'=>'required|string|min:3',
                    'phone'=>'required|string|min:10',
                    //'governorate'=>'required|string|exists:governorate',
                    'city'=>'required|string',
                    //'center'=>'required|string|exists:center',
                    'parentPhone'=>'required|string|min:10',
                ]);
                $user = $request->user();
                $user->fName = $validatedData['fName'];
                $user->mName = $validatedData['mName'];
                $user->lName = $validatedData['lName'];
                $user->phone = $validatedData['phone'];
                $user->city = $validatedData['city'];
                $user->parentPhone = $validatedData['parentPhone'];
                $user->save();
                return response()->json(['token'=>$request->header('token'),'user'=>$user,'dataComplete'=>true]);
            }
            return response()->json(['error' =>401,'errorMsg'=>'You Must Send User Token In Header As Token Header Regardless Of Authorization']);
        }
        catch (Exception $e){
            return $e;
        }

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
