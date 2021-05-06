<?php

namespace Dnsoft\Acl\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
        $rules = [];
        if (!is_admin()) {
            $userId = \Auth::guard('admin')->id();
            $rules = [
                'name'     => 'required',
                'email'    => 'nullable|unique:admins,email,' . $userId,
                'password' => 'nullable|required_with:password_confirmation|string|confirmed',
            ];
        }
        
        return $rules;
    }

    public function attributes()
    {
        return [
            'name'                  => __('acl::profile.name'),
            'email'                 => __('acl::profile.email'),
            'password'              => __('acl::profile.password'),
            'password_confirmation' => __('acl::profile.password_confirmation'),
        ];
    }
}
