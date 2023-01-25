<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class CategoryRequest extends FormRequest
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
        $getFormRoute = Route::currentRouteName();
//      dd($getFormRoute);
        $id = isset($this->id) ? $this->id : null;
       // dd($id);
        switch ($getFormRoute) {
            case "category-save" :
                return [
                    "category_name" => "required|unique:categories,category_name,",
                    "parent_id" => "required",
                ];
                break;
            case "category-update" :

                return [
                   "category_name" => "required|string|unique:categories,category_name," .$id. ",id,deleted_at,NULL",
                    "parent_id" => "required",
                    "slug" => "required|string|unique:categories,slug," .$id. ",id,deleted_at,NULL",
                ];

                break;
        }

    }

    public function messages()
    {
        return [
            "category_name.required" => "Enter category name",
            "category_name.unique" => "Title already exist!",
            "slug.unique" => "Slug already exist!",
            "parent_id.required" => "Enter category name",
        ];
    }
}
