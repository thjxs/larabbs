<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Api\UserRequest;

class UsersController extends Controller
{
    public function store(UserRequest $request)
    {
        $verifyDate = \Cache::get($request->verification_key);

        if(!$verifyDate) {
            return $this->response->error('verification_code expired', 422);
        }

        if (!hash_equals($verifyDate['code'], $request->verification_code)) {
            return $this->response->errorUnauthorized('verification_code error');
        }

        $user = User::create([
            'name' => $request->name,
            'phone' => $verifyDate['phone'],
            'password' => bcrypt($request->password),
        ]);

        \Cache::forget($request->verification_key);

        return $this->response->created();
    }
}
