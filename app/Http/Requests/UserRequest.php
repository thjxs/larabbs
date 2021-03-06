<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->routeIs('users.update_avatar')) {
            return [
                'avatar' => 'mimes:jpeg,bmp,png,gif|dimensions:min_width=200,min_height=200',
            ];
        } else {
            return [
                'name'         => 'required|between:3,25|regex:/^[A-Za-z0-9\-\_]+$/|unique:users,name,'.Auth::id(),
                'email'        => 'required|email',
                'introduction' => 'max:80',
            ];
        }
    }
}
