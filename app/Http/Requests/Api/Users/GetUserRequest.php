<?php

namespace App\Http\Requests\Api\Users;

use App\Http\Requests\Api\BaseRequest;

class GetUserRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id',
        ];
    }
}