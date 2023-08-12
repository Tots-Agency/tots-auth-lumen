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
        return TotsUser::where('phone', $phone)->first();
    }
}