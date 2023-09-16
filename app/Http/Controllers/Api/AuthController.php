<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //Register
    public function register(Request $request): JsonResponse
    {
        try{
            //validation
            $validator = Validator::make($request->all(),[
                'name' => 'required',

                'email' => 'required|email',

                'password' => 'required',
            ]);

            if($validator->fails())
            {
                return $this->sendError('Validation Failed', $validator->errors());
            }

            $input = $request->all();
            $input['password'] = bcrypt($input['password']);

            $user = User::create($input);

            //create token
            $data['token'] = $user->createToken($user->name)->plainTextToken;
            $data['name'] = $user->name;
            $data['id'] = $user->id;
            $data['email'] = $user->email;
            $data['roles'] = $user->roles->name;

            return $this->sendResponse($data, 'Register Successfully');

        } catch(Exception $e){
            return $this->sendError($e->getMessage());
        }
    }

    public function login(Request $request): JsonResponse
    {
        if(Auth::attempt(['email' => $request->email, 'password'=> $request->password]))
        {
            $user = Auth::user();

            $data['token'] =  $user->createToken($user->name)->plainTextToken;

            $data['id'] =  $user->id;
            $data['name'] =  $user->name;
            $data['email'] = $user->email;
            $data['roles'] =  $user->roles->name;

            return $this->sendResponse($data, 'User login successfully.');
        }
        else {
            return $this->sendError('Login Failed');
        }
    }

    public function logout(Request $request): JsonResponse
    {
        try {
            $user = $request->user();
            $user->tokens()->delete();

            return $this->sendResponse('Logout successfully', null);
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), null);
        }
    }

    public function refreshToken(Request $request)
    {
        if (auth()->user()) {
            $user = $request->user();
            $user->tokens()->delete();

            $data['id'] =  $user->id;
            $data['name'] = $user->name;
            $data['email'] = $user->email;
            $data['roles'] = $user->roles->name;
            $data['token'] = $user->createToken($user->name)->plainTextToken;

            return $this->sendResponse($data, 'Token refresh successfully');
        } else {
            return $this->sendError($request->header('Authorization'));
        }
    }
}
