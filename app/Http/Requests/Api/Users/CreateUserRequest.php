<?php

namespace App\Http\Requests\Api\Users;

use App\Http\Requests\Api\BaseRequest;

class CreateUserRequest extends BaseRequest
{

    public function rules()
    {

        return [
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required',
        ];
    }
}
