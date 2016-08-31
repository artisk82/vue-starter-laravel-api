<?php

namespace Api\Requests;

use Dingo\Api\Http\FormRequest;

class ExcelRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'file' => 'required',
        ];
    }
}