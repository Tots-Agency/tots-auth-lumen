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
}