<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Laravel\Sanctum\PersonalAccessToken;
use PHPUnit\TextUI\Exception;

class userController extends Controller
{
    use SendsPasswordResetEmails;
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function getResetToken(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);
        $sent = $this->sendResetLinkEmail($request);


        return ($sent)
            ? response()->json(['message'=>'Success'])
            : response()->json(['message'=>'Failed']);

    }

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
     * @param Request $request
     * @return mixed
     */
/*    public function forgot_password(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'email' => "required|email",
        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $arr = array("status" => 400, "message" => $validator->errors()->first(), "data" => array());
        }
        else {
            try {
                $response = Password::sendResetLink($request->only('email'), function (\http\Message  $message) {
                    $message->subject($this->getEmailSubject());
                });
                switch ($response) {
                    case Password::RESET_LINK_SENT:
                        return response()->json(array("status" => 200, "message" => trans($response), "data" => array()));
                    case Password::INVALID_USER:
                        return response()->json(array("status" => 400, "message" => trans($response), "data" => array()));
                }
            }
            catch (\Swift_TransportException $ex) {
                $arr = array("status" => 400, "message" => $ex->getMessage(), "data" => []);
            }
            catch (Exception $ex) {
                $arr = array("status" => 400, "message" => $ex->getMessage(), "data" => []);
            }
        }
        return response()->json($arr);
    }*/

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
