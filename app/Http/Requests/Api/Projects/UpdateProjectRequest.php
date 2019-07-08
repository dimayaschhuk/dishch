<?php

namespace App\Http\Requests\Api\Projects;

use App\Http\Requests\Api\BaseRequest;

class UpdateProjectRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'id'          => 'required|exists:projects,id',
            'name'        => 'required',
            'description' => 'nullable',
            'status'      => 'status_project',
        ];
    }
}
