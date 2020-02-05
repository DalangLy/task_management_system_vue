<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TrustClientController extends Controller
{
    public function getTrustClientToken(){
        $http = new \GuzzleHttp\Client;

        try{
            $response = $http->post(config('services.passport_client_credentials.trust_client_end_point'),[
                'form_params' => [
                    'grant_type' => 'client_credentials',
                    'client_id' => config('services.passport_client_credentials.client_id'),
                    'client_secret' => config('services.passport_client_credentials.client_secret'),
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
}
