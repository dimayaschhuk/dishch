<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
{
    //даний реквест для того щоб не пропускати неавторизованих користувачів в методи де потрібна авторизація
    public function authorize()
    {
//        return auth('api')->check();
        return TRUE;
    }
    public function rules()
    {
        return [

        ];
    }

}
