<?php

namespace App\Http\Requests\Api;

use Dingo\Api\Http\FormRequest;

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
        switch ($this->method()) {
            case 'post':
                return [
                    'name'              => 'required|string|max:255',
                    'password'          => 'required|string|min:6',
                    'verification_key'  => 'required|string',
                    'verification_code' => 'required|string',
                ];
                break;

            case 'patch':
                $userId = \Auth::guard('api')->id();

                return [
                    'name'            => 'between:3,25|regex:/^[A-Za-z0-9\-\_]+$/|unique:users,name,'.$suerId,
                    'email'           => 'email',
                    'introduction'    => 'max:80',
                    'avatar_image_id' => 'exists:images,id,type,avatar,user_id'.$userId,
                ];
                break;
        }
    }

    public function attributes()
    {
        return [
            'verification_key'  => 'sms_key',
            'verification_code' => 'sms_code',
            'introduction'      => 'introduction',
        ];
    }
}
