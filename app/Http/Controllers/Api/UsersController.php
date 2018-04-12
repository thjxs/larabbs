<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Api\UserRequest;
use App\Transformers\UserTransformer;
use App\Models\Image;

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

        return $this->response->item($user, new UserTransformer())->setMeta([
            'access_token' => \Auth::guard('api')->fromUser($user),
            'token_type' => 'Bearer',
            'expires_in' => \Auth::guard('api')->factory()->getTTL() * 60
        ])->setStatusCode(201);
    }

    public function me()
    {
        return $this->response->item($this->user(), new UserTransformer());
    }

    public function update(UserRequest $request)
    {
        $user = $this->user();
        $attributes = $reuqest->only(['name', 'email', 'introductionss']);
        if ($request->avatar_image_id) {
            $image = Image::find($request->avatar_image_id);
            $attributes['avatar'] = $image->path;
        }

        $user->update($attributes);

        return $this->response->item($user, new UserTransformer());
    }
}
