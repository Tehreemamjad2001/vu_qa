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
            case "save-question" :
                return [
                    'title' => 'required',
                    'tags' => '',
                    'description' => 'required',
                    'parent_cat' => 'required',
                ];
                break;
            case "question-update-page" :
                return [
                    'title' => 'required',
                    'description' => 'required',
                    'parent_cat' => 'required',
                ];
                break;
        }
    }
    public function messages()
    {
        return [
            "title.required" => "Write your questions title",
            "description.required" => "Write your questions description",
            "parent_cat.required" => "select category ",
        ];
    }
}
