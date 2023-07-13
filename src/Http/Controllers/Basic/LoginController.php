<?php

namespace Tots\Auth\Http\Controllers\Basic;

use Illuminate\Http\Request;
use Tots\Auth\Models\TotsUser;
use Illuminate\Support\Facades\Hash;
use Tots\Auth\Models\TotsUserAttemp;
use Tots\Auth\Services\AuthService;

class LoginController extends \Laravel\Lumen\Routing\Controller
{

    /**
     *
     * @var AuthService
     */
    protected $service;

    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }

    public function login(Request $request)
    {
        // Get Params
        $email = $request->input('email');
        $password = $request->input('password');
        // Search active user
        $user = $this->getActiveUser($email, $password);
        // Process data
        $data = $user->toArray();
        // Generate Auth Token
        $data['token_type'] = 'bearer';
        $data['access_token'] = $this->service->generateAuthToken($user);
        
        return $data;
    }

    protected function getActiveUser($email, $password)
    {
        $user = TotsUser::where('email', $email)->first();
        // Verify if account exist
        if($user === null){
            throw new \Exception('This account not exist');
        }
        // Verify max attempt
        $attemps = $this->verifyIfMaxAttempt($user);
        // Verify if password is correct
        if(!Hash::check($password, $user->password)){
            throw new \Exception('Password is not correct.' . ($attemps != null ? ' Attemps: ' . $attemps : ''));
        }

        return $user;
    }

    protected function verifyIfMaxAttempt(TotsUser $user)
    {
        $maxAttempt = $this->service->getMaxAttempt();
        if($maxAttempt == null||$maxAttempt == 0){
            return;
        }

        // Fetch all attemps in the last 24 hours
        $attemps = TotsUserAttemp::where('user_id', $user->id)
            ->where('created_at', '>=', (new \DateTime())->sub(new \DateInterval('PT24H')))
            ->count();

        if($attemps >= $this->service->getMaxAttempt()){
            throw new \Exception('Max attempt reached');
        }

        return $maxAttempt - $attemps;
    }
}
