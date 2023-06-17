<?php

namespace Tots\Auth\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Tots\Auth\Models\TotsUser;

class ActiveController extends \Laravel\Lumen\Routing\Controller
{
    public function handle(Request $request)
    {
        // Validation
        $this->validate($request, [
            'id' => 'required'
        ]);
        // Search user exist
        $user = TotsUser::where('id', $request->input('id'))->first();
        if($user === null){
            throw new \Exception('This user not exist');
        }
        // Save new status
        $user->status = TotsUser::STATUS_ACTIVE;
        $user->save();

        return ['success' => true];
    }
}
