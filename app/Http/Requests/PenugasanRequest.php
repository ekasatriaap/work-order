<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PenugasanRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            "id_penerima_tugas" => "required|exists:users,id",
            "deadline" => "required|date_format:Y-m-d\TH:i",
        ];
    }

    public function attributes(): array
    {
        return [
            "id_penerima_tugas" => "Penerima Tugas",
            "deadline" => "Tenggat Waktu",
        ];
    }
}
