<?php

namespace App\Http\Requests\Api\Projects;

use App\Http\Requests\Api\BaseRequest;

class GetProjectRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'project_id' => 'required|exists:projects,id',
        ];
    }
}
