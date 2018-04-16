<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Handlers\ImageUploadHandler;
use App\Models\User;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $i = 1;
        return view('users.edit', compact('user', 'i'));
    }

    public function edit_avatar(User $user)
    {
        $i = 2;
        return view('users.edit', compact('user', 'i'));
    }

    public function update(UserRequest $request, ImageUploadHandler $uploader, User $user)
    {
        $this->authorize('update', $user);

        $data = $request->all();
        if ($request->avatar) {
            $result = $uploader->save($request->avatar, 'avatar', $user->id, 362);
            if($result) {
                $data['avatar'] = $result['path'];
            }
        }

        $user->update($data);
        return redirect()->route('users.show', $user->id)->with('success', 'Profile updated');
    }

    public function update_avatar(UserRequest $request, ImageUploadHandler $uploader, User $user)
    {
        $this->authorize('update', $user);
        $result = $uploader->save($request->avatar, 'avatar', $user->id, 362);
        if ($result) {
            $data['avatar'] = $result['path'];
        }
        $user->update($data);
        return redirect()->route('users.show', $user->id)->with('success', 'avatar updated');
    }
}
