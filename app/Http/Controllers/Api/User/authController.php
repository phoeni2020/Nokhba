<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class authController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function signUp(Request $request){


        $validatedData = Validator::make($request->all(), [
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
            ],
            [
                'email.required' => 'E-mail Is Required Field',
                'email.unique' => 'The E-mail MUST Be Unique',
                'email.email' => 'The E-mail Field MUST Be Like Email Format user@example.com',
                'password.required' => 'Password Is Required Field',
                'password.min' => 'Password MUST Be At Least 8 Chars',
            ]
        );
        if($validatedData->fails()){
            return response()->json($validatedData->errors(),401);
        }
        else {
            $data = $validatedData->validated();
            $user = User::create([
                //'name' => $validatedData['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'student' => 1,
            ]);
            event(new Registered($user));
            unset($data);

            $token = $user->createToken('auth_token')->plainTextToken;
            if(is_null($user->fName)){
                return response()->json([
                    'verified' => !($user->email_verified_at == null),
                    'token' => $token,
                    'token_type' => 'Bearer',
                    'user' => $user,
                    'dataComplete' => false
                ]);
            }
            return response()->json([
                'verified' => !($user->email_verified_at == null),
                'token' => $token,
                'token_type' => 'Bearer',
                'user' => $user,
                'dataComplete' => true
            ]);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function signIn (Request $request){

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;
        if(is_null($user->fName)){
            return response()->json([
                'verified' => !($user->email_verified_at == null),
                'token' => $token,
                'token_type' => 'Bearer',
                'user' => $user,
                'dataComplete' => false
            ]);
        }
        return response()->json([
            'verified' => !($user->email_verified_at == null),
            'token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
            'dataComplete' => true
        ]);
    }
}
