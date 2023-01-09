<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class BlockedKeywordRequest extends FormRequest
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
        $currentFormRoute = Route::currentRouteName();
        switch ($currentFormRoute){
            case "blocked-keyword-save":
                return [
                "keyword" => "required|unique:blocked_keywords,keyword",
            ];
                break;
            case "blocked-keyword-update":
                return [
                    "keyword" => "required",
                ];
                break;
        }

    }
    public function messages()
    {
        return [
            "keyword.required" => "Enter Keyword",
        ];
    }
}
