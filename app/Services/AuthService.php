<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Service\ServiceAuth;
use App\Models\Service\ServiceToken;

class AuthService 
{
    public static function validateToken($thing_id, $token)
    {
        // Delete expired tokens
        ServiceToken::where('expired_at', '<', date('Y-m-d H:i:s'))->delete();

        // check token
        $tokens = ServiceToken::where('token', $token)->where('expired_at', '>=', date('Y-m-d H:i:s'))->get();
        if(count($tokens) > 0) return True;
        return False;
    }

    public static function generateToken($thing_id, $serviceAuth_id)
    {
        $serviceToken = new ServiceToken;
        $serviceToken->service_auth_id = $serviceAuth_id;
        $serviceToken->token = substr(md5(mt_rand()), 0, 30);
        $serviceToken->expired_at = Carbon::now()->addHour(7);
        $serviceToken->save();

        return $serviceToken;
    }

    public static function logout($token)
    {
        $deleted = ServiceToken::where('token', $token)->delete();
        return $deleted;
    }
}
