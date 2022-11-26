<?php

namespace Tots\Auth\Services;

use Firebase\JWT\JWT;
use Tots\Auth\Models\TotsUser;

class AuthService 
{
    public $config = [];

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function generateAuthToken(TotsUser $user)
    {
        return JWT::encode([
            'iss' => $this->config['iss'],
            'aud' => $this->config['aud'],
            'iat' => (new \DateTime())->getTimestamp(),
            'nbf' => (new \DateTime())->getTimestamp(),
            'exp' => (new \DateTime())->add(new \DateInterval($this->config['expire']))->getTimestamp(),
            'uid' => $user->id,
            'data' => array(
                'id' => $user->id,
                'email' => $user->email
            )
        ], $this->config['key'], 'HS256');
    }
}
