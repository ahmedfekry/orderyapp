<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Validator;
use App\Http\Requests\RegistrationRequest;
use App\Http\Requests\LoginRequest;
use App\User;
use App\ProfileType;
use App\Client;
use Hash;
use Carbon\Carbon;
use Mail;

class AuthenticateController extends Controller
{

    public function __construct()
    {
        // $this->middleware('jwt.auth',['onle' => 'varify']);
    }
  
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        

        if ($validator->fails()) {
            return response()->json($validator->errors()->all(), 500);
        }
        
        $credentials = $request->only('email', 'password');

        try {
            // verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        $user = JWTAuth::authenticate($token);
        if ($user->hasRole('client')) {
            // if no errors are encountered we can return a JWT
            return response()->json(['token' => $token,'name'=>$user->name,'email'=>$user->email]);
        }else{
            return response()->json('User Is not a client',500);
        }
    }

    public function sign_up(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);
        

        if ($validator->fails()) {
            return response()->json($validator->errors()->all(), 500);
        }

        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        
        $user = User::create($data);
        $user->assignRole('client');
        return response()->json(['token' => JWTAuth::fromUser($user),'name'=>$user->name,'email'=>$user->email]);
    }

    public function refresh_token()
    {
        try{

            $token = JWTAuth::getToken();
        
        } catch (TokenBlacklistedException $e) {
        
            return response()->json(['token_blacklisted'], $e->getStatusCode());
        
        }catch (TokenExpiredException $e) {
        
            return response()->json(['token_expired'], $e->getStatusCode());
        
        } catch (TokenInvalidException $e) {
        
            return response()->json(['token_invalid',$token], $e->getStatusCode());
        
        } catch (JWTException $e) {
        
            return response()->json(['token_absent'], $e->getStatusCode());
        
        }

        if(!$token){
            return response()->json(['token_absent'], 404);
        }
        
        $token = JWTAuth::refresh($token);
        return response()->json(['token' => $token]);

    }

    public function logout()
    {
        try{
            
            JWTAuth::parseToken()->invalidate();

        } catch (TokenBlacklistedException $e) {
        
            return response()->json(['token_blacklisted'], $e->getStatusCode());
        
        }catch (TokenExpiredException $e) {
        
            return response()->json(['token_expired'], $e->getStatusCode());
        
        } catch (TokenInvalidException $e) {
        
            return response()->json(['token_invalid'], $e->getStatusCode());
        
        } catch (JWTException $e) {
        
            return response()->json(['token_absent'], $e->getStatusCode());
        
        }
        return response()->json(['logout successfully'],200);     

    }


}
