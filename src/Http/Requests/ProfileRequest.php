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
    $rules = [
      'name'     => 'required',
      'email'    => 'required|unique:admins,email,' . request()->id,
      'password' => 'required|required_with:password_confirmation|string|confirmed',
      'password_confirmation' => 'required',
    ];
    if (request()->id) {
      if (request('password') && !request('password_confirmation') || !request('password') && request('password_confirmation')) {
        // Do nothing
      } else {
        unset($rules['password']);
        unset($rules['password_confirmation']);
      }
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
