<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;


class QuestionRequest extends FormRequest
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
       // dd($routeName);

        switch ($routeName) {
            case "user-save" :
                return [
                    "title" => "required",
                    "description" => "required",
                ];
                break;
            case "save-answer" :
                return [
                    "answer" => "required",
                ];
                break;
        }
    }

    public
    function messages()
    {
        return [
            "title.required" => "Enter Question Title",
            "question.required" => "Enter Question"
        ];
    }
}
