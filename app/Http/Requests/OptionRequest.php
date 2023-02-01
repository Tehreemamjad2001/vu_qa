<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;


class OptionRequest extends FormRequest
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
        $routeName = Route::currentRouteName();
        switch ($routeName) {
            case "site-setting-update" :
                return [
                    "percentage" => 'required',
                ];
                break;
        }
    }

    public function messages()
    {
        return [
            "value.required" => "Enter value",
        ];
    }
}
