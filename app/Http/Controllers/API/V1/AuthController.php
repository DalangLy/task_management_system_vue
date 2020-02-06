<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);

        $http = new \GuzzleHttp\Client;

        try{
            $response = $http->post(config('services.passport.login_end_point'),[
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => config('services.passport.client_id'),
                    'client_secret' => config('services.passport.client_secret'),
                    'username' => $request->username,
                    'password' => $request->password,
                ]
            ]);
            return $response->getBody();
        }catch (\GuzzleHttp\Exception\BadResponseException $e){
            if($e->getCode() === 400){
                return response()->json('Invalid Request', $e->getCode());
            }else if($e->getCode() === 401){
                return response()->json('Your Credentials are incorrect', $e->getCode());
            }
            return response()->json('Something went wrong on the server', $e->getCode());
        }
    }

    public function user(Request $request){
        return User::where('users.id', Auth::id())
            ->join('genders', 'users.gender_id', 'genders.gender_id')
            ->join('roles', 'users.role_id', 'roles.role_id')
            ->join('positions', 'users.position_id', 'positions.position_id')->first();
    }

    public function issueNewAccessToken(Request $request){
        $request->validate([
            'refresh_token' => 'required',
        ]);

        $http = new \GuzzleHttp\Client;

        try{
            $response = $http->post(config('services.passport.login_end_point'),[
                'form_params' => [
                    'grant_type' => 'refresh_token',
                    'client_id' => config('services.passport.client_id'),
                    'client_secret' => config('services.passport.client_secret'),
                    'refresh_token' => $request->refresh_token,
                ]
            ]);
            return $response->getBody();
        }catch (\GuzzleHttp\Exception\BadResponseException $e){
            if($e->getCode() === 400){
                return response()->json('Invalid Request', $e->getCode());
            }else if($e->getCode() === 401){
                return response()->json('Your Credentials are incorrect', $e->getCode());
            }
            return response()->json('Something went wrong on the server', $e->getCode());
        }
    }

    public function logout(){
        auth()->user()->tokens->each(function($token, $key){
            $token->delete();
        });
        return response()->json('Logged out successfully', 200);
    }
}
