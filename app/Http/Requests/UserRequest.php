<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\unique;


class UserRequest extends FormRequest
{

    protected $stopOnFirstFailure = false;

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
        //dd($routeName);
        $id = isset($this->id) ? $this->id : null;

        switch ($routeName) {
            case "user-save" :
                return [
                    'name' => 'required',
                    'email' => 'required|email|unique:users,email,' . $id . ',id,deleted_at,NULL',
                    'gender' => 'required',
                    'password' => 'required|confirmed|min:3',
                    'password' => 'required|min:3',
                    'confirmPassword' => 'required|same:password',
                    //'profile_pic' => 'mimes:jpeg,png,jpg'
                ];
                break;
            case "user-update" :
                return [
                    'name' => 'required|',
                    'email' => 'required|email|unique:users,email,' . $id . ',id,deleted_at,NULL',
                    'gender' => 'required',
                ];
                break;
            case "user-update-pass" :
                return [
                    'password' => 'required|confirmed|min:3',
                    'password' => 'required|min:3',
                    'confirmPassword' => 'required|same:password',
                ];
                break;
            case "user-update-profile-pic" :
                return [
                    'profile_pic' => 'mimes:jpeg,png,jpg'
                ];
                break;
            case "admin-save" :
                return [
                    'name' => 'required|max:30',
                    'email' => 'required|email|unique:users,email,' . $id . ',id,deleted_at,NULL',
                    'gender' => 'required',
                    'password' => 'required|confirmed|min:3',
                    'password' => 'required|min:3',
                    'country' => 'required',
                    'confirmPassword' => 'required|same:password',
                ];
                break;
            case "admin-update" :
                return [
                    'name' => 'required|',
                    'email' => 'required|email|unique:users,email,' . $id . ',id,deleted_at,NULL',
                    'gender' => 'required',
                ];
                break;
            case "admin-update-pass" :
                return [
                    'password' => 'required|min:8',
                    'confirmPassword' => 'required|same:password',
                ];
                break;
            case "update-profile-pic" :

                return [
                    'name' => 'required|max:30',
                    'country' => 'required',
                    'about me' => 'required|max:400',
                ];
                break;
            case "profile-pass-setting" :
                return [
                    'old-password' => 'required|min:8',
                    'password' => 'required|min:8',
                    'confirmPassword' => 'required|same:password',
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
            case "contact" :
                return [
                    'name' => 'required',
                    'email' => 'required',
                    'message' => 'required',
                ];
                break;
        }

    }

    public function messages()
    {
        return [
            "name.required" => "Enter your Good Name",
            "email.required" => "Enter your Email",
            "email" => "Enter Valid Email",
            "email.unique" => "Email is already exist!",
            "gender" => "Select any option!",
            "password.same" => "Confirm Password did not match",
            "password.required" => "Password is required",
        ];
    }
}
