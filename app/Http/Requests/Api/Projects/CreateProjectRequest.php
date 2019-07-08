<?php

namespace App\Http\Requests\Api\Projects;

use App\Http\Requests\Api\BaseRequest;

class CreateProjectRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'name'        => 'required',
            'description' => 'nullable',
            'status'      => 'status_project',
        ];
    }
}
