<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules($id = ""): array
    {
        return [
            "name" => "required|string",
            "username" => [
                "required",
                "string",
                "regex:/^\S*$/",
                "min:4",
                "lowercase",
                Rule::unique("users", "username")->ignore($id),
            ],
            "id_role" => "required|exists:roles,id",
        ];
    }

    public function attributes(): array
    {
        return [
            "name" => "Nama User",
            "username" => "Username",
            "id_role" => "Role",
        ];
    }
}
