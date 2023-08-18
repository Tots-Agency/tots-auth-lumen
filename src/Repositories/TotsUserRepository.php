<?php

namespace Tots\Auth\Repositories;

use Tots\Auth\Models\TotsUser;

/**
 *
 * @author matiascamiletti
 */
class TotsUserRepository
{
    public function fetchUserByPhone($phone)
    {
        $user = TotsUser::where('phone', $phone)->first();
        // Verify if account exist
        if($user === null){
            throw new \Exception('This user not exist');
        }
        return $user;
    }

    public function fetchUserByEmailAndPhone($email, $phone)
    {
        $user = TotsUser::where('email', $email)->where('phone', $phone)->first();
        // Verify if account exist
        if($user === null){
            throw new \Exception('This user not exist');
        }
        return $user;
    }

    public function removeById($userId)
    {
        $user = TotsUser::find($userId);
        if($user === null){
            throw new \Exception('This user not exist');
        }
        $user->forceDelete();
    }
}