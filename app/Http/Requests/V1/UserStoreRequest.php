<?php

namespace App\Http\Requests\V1;;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserStoreRequest extends FormRequest
{


    protected $user;


    public function __construct($user = null)
    {
        $this->user = $user;
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'=>['required', 'max:64', 'min:4'],
            'email'=>[
                'email',
                'required', 
                'max:320',
                Rule::unique('users')->ignore(optional($this->user)->id),
            ],

            'password'=>[
                'required',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
                'confirmed',
            ],

       
         
        ];
    }
}
