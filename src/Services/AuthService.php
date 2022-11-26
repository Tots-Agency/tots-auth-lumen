<?php

namespace Tots\Auth\Services;


class AuthService 
{
    public $config = [];

    public function __construct($config)
    {
        $this->config = $config;
    }
}
