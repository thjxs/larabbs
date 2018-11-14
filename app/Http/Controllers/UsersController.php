<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\UserRequest;
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
            if ($result) {
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

    public function showFollowings(User $user)
    {
        $users = $user->followings()->paginate(30);
        $title = 'followings';

        return view('users.show_follow', compact('users', 'title'));
    }

    public function showFollowers(User $user)
    {
        $users = $user->followers()->paginate(30);
        $title = 'followers';

        return view('users.show_follow', compact('users', 'title'));
    }
}
