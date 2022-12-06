<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;

class profileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "user_id" => ["required", "exists:users,id"],
            "name" => ["required", "string", "min:3"],
            "last_name" => ["nullable", "string"],
            "phone" => ["required", "regex:/(\+7)[0-9]{10}/"],
            "email" => ["nullable", "email"]
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            "user_id" => auth()->id(),
        ]);
    }
}
