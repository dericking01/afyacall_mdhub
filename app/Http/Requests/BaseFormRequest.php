<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class BaseFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    abstract public function rules();

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    abstract public function authorize();

    /**
     *  Filters to be applied to the input.
     *
     * @return array
     */
    public function filters()
    {
        return [];
    }

    /**
     * Extend validationData which get data to be validated from the request.
     *
     * @return array
     */
    public function validationData()
    {
        $validationData = count($this->json()->all()) ? $this->json()->all() : $this->all();
        $sanitizer = \Sanitizer::make($validationData, $this->filters());

        return $sanitizer->sanitize();
    }

    /**
     * Get a validator
     * @return  \Illuminate\Contracts\Validation\Validator  $validator
     */
    public function getValidator()
    {
        return $this->validator;
    }

}
