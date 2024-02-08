<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class CreateOrEditUser extends FormRequest
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
        $rules = [
            'name' => 'required|min:5',
            'email' => 'required|email|unique:users',
        ];

        $this->postMergeRule($rules,'password','required|min:5');

        return $rules;
    }

    /**
     * @param $rules
     * @param $attribute
     * @param $rule
     * @return array
     */
    public function postMergeRule($rules,$attribute,$rule)
    {
        return ($this->method == 'POST') ? Arr::add($rules,$attribute,$rule) : $rules;
    }
}
