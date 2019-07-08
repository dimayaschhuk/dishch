<?php

namespace App\Http\Requests\Api\Users;

use App\Http\Requests\Api\BaseRequest;

class UpdateUserRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'id'         => 'required|exists:users,id',
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required|email|unique_email',
        ];
    }
}
