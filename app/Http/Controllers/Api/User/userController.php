<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Models\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;
use PHPUnit\TextUI\Exception;

class userController extends Controller
{
    use SendsPasswordResetEmails;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function getResetToken(Request $request)
    {
        Log::create(['log'=>'User Requested Reset Password','user'=>request()->user()->id?request()->user()->id:'','data'=>$request->email,'route'=>request()->route()->getName()]);
        $this->validate($request, ['email' => 'required|email|exists:users']);
        $sent = $this->sendResetLinkEmail($request);
        return ($sent)
            ? response()->json(['message'=>'Success','status'=>200])
            : response()->json(['message'=>'Failed','status'=>500]);

    }

    /**
     * @param Request $request
     * @return int
     */
    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);
        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );
        return $response == Password::RESET_LINK_SENT ? 1 : 0;
    }

    /**
     * @param PersonalAccessToken $userToken
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request){
        $user = $request->user();
        if(is_null($user->fName)){
            return response()->json(['user'=>$user,'token'=>$request->header('token'),'dataComplete'=>false]);
        }
        return response()->json(['user'=>$user,'token'=>$request->header('token'),'dataComplete'=>true]);
    }

    /**
     * @param PersonalAccessToken $userToken
     * @param Request $request
     * @return Exception|\Illuminate\Http\JsonResponse|Exception
     */
    public function completeData(Request $request){
        try {
            if($request->hasHeader('token')){
                $validatedData =  Validator::make($request->all(),[
                    'fName'=>'required|string|min:3|max:15',
                    'mName'=>'required|string|min:3|max:15',
                    'lName'=>'required|string|min:3|max:15',
                    'phone'=>'required|string|min:10|max:15',
                    //'governorate'=>'required|string|exists:governorate',
                    'city'=>'required|string',
                    //'center'=>'required|string|exists:center',
                    'parentPhone'=>'required|string|min:10',
                ]);
                if ($validatedData->fails()) {
                    return response()->json($validatedData->errors()->messages(),422);
                }
                $data = $validatedData->validate();
                $user = $request->user();
                $user->fName = $data['fName'];
                $user->mName = $data['mName'];
                $user->lName = $data['lName'];
                $user->phone = $data['phone'];
                $user->city = $data['city'];
                $user->parentPhone = $data['parentPhone'];
                $user->save();
                Log::create(['log'=>'User Completed His data','user'=>request()->user()->id,'data'=>$user,'route'=>request()->route()->getName()]);

                return response()->json(['token'=>$request->header('token'),'user'=>$user,'dataComplete'=>true]);
            }
            return response()->json(['error' =>401,'errorMsg'=>'You Must Send User Token In Header As Token Header Regardless Of Authorization']);
        }
        catch (Exception $e){
            return response()->json(['error'=>$e->getMessage()]);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
                $validatedData = Validator::make($request->all(),[
                'fName'=>'required|string|min:3|max:15',
                'mName'=>'required|string|min:3|max:15',
                'lName'=>'required|string|min:3|max:15',
                'phone'=>'required|string|min:10|max:15',
                //'governorate'=>'required|string|exists:governorate',
                'city'=>'required|string',
                //'center'=>'required|string|exists:center',
                'parentPhone'=>'required|string|min:10',
                ]);
                if ($validatedData->fails()) {
                    return response()->json($validatedData->errors()->messages(),422);
                }
                $data = $validatedData->validate();
                $user = $request->user();
                $data = ['beforeUpdate'=>$user];
                $user->fName = $data['fName'];
                $user->mName = $data['mName'];
                $user->lName = $data['lName'];
                $user->phone = $data['phone'];
                $user->city = $data['city'];
                $user->parentPhone = $data['parentPhone'];
                $user->save();
                $data['afterUpdate']=$user;
                Log::create(['log'=>'User Data Updated','user'=>request()->user()->id,'data'=>$data,'route'=>request()->route()->getName()]);

            return response()->json(['token'=>$request->header('token'),'user'=>$user,'dataComplete'=>true]);
        }
        catch (Exception $e){
            return response()->json(['error'=>$e->getMessage()]);
        }
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function changePassword(Request $request)
    {
        try {
                $input = $request->all();
                $userid = Auth::guard('sanctum')->user()->id;

                $rules = array(
                    'oldPassword' => 'required',
                    'newPassword' => 'required|min:6',
                    'confirmPassword' => 'required|same:newPassword',
                );
                $validator = Validator::make($input, $rules);

                if ($validator->fails()) {
                    $arr = array("status" => 400, "message" => $validator->errors()->first(), "data" => array());
                } else {
                    if ((Hash::check(request('oldPassword'), Auth::user()->password)) == false) {
                        $arr = array("status" => 400, "message" => "Check your old password.", "data" => array());
                    }
                    else if ((Hash::check(request('newPassword'), Auth::user()->password)) == true) {
                        $arr = array("status" => 400, "message" => "Please enter a password which is not similar then current password.", "data" => array());
                    }
                    else {
                        User::where('id', $userid)->update(['password' => Hash::make($input['newPassword'])]);
                        $arr = array("status" => 200, "message" => "Password updated successfully.",
                            "data" => array('user' => $request->user(),'dataComplete'=>true, 'token' => $request->header('token')));
                        Log::create(['log'=>'User Updated Password','user'=>request()->user()->id,'data'=>[],'route'=>request()->route()->getName()]);

                    }
                }
        }
        catch (\Exception $ex)
            {
                if (isset($ex->errorInfo[2])) {
                    $msg = $ex->errorInfo[2];
                } else {
                    $msg = $ex->getMessage();
                }
                $arr = array("status" => 400, "message" => $msg, "data" => array());
            }
        return \Response::json($arr);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $token
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            if(Auth::guard('sanctum')->user()->id == $id){
                Auth::guard('sanctum')->user()->destroy($id);
            }
            $arr = array("status" => 400, "message" => 'User Deleted', "data" => array());
        }
        catch (\Exception $ex)
        {
            if (isset($ex->errorInfo[2])) {
                $msg = $ex->errorInfo[2];
            } else {
                $msg = $ex->getMessage();
            }
            $arr = array("status" => 400, "message" => $msg, "data" => array());
        }
        return \Response::json($arr);
    }

    public function logOut(Request $request){
        try{
            $user = $request->user();
            // Revoke a specific token...
            $user->currentAccessToken()->delete();
            return response()->json(['massage' =>'user logged out'],200);
        }
        catch (\Exception $ex){
            if (isset($ex->errorInfo[2])) {
                $msg = $ex->errorInfo[2];
            } else {
                $msg = $ex->getMessage();
            }
            return response()->json(array("status" => 500, "message" => $msg));
        }

    }


}
