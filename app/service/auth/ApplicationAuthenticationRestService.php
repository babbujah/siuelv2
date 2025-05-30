<?php

use Adianti\Service\AdiantiRestService;

use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

class ApplicationAuthenticationRestService implements AdiantiRestService
{
    public static function getToken($param)
    {
        $user = ApplicationAuthenticationService::authenticate($param['login'], $param['password']);
        
        $ini = AdiantiApplicationConfig::get();
        $key = APPLICATION_NAME . $ini['general']['seed'];
        
        if (empty($ini['general']['seed']))
        {
            throw new Exception('Application seed not defined');
        }
        
        $token = array(
            "user" => $param['login'],
            "userid" => $user->id,
            "username" => $user->name,
            "usermail" => $user->email,
            "expires" => strtotime("+ 3 hours")
        );
        
        return JWT::encode($token, $key, 'HS256');
    }
}
