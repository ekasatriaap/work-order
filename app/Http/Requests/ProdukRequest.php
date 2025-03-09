<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProdukRequest extends FormRequest
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
    public function rules($id = null): array
    {
        return [
            "kode_produk" => [
                "required",
                "string",
                "max:5",
                Rule::unique("produks", "kode_produk")->ignore($id),
            ],
            "nama_produk" => "required|string",
        ];
    }

    public function attributes(): array
    {
        return [
            "kode_produk" => "Kode Produk",
            "nama_produk" => "Nama Produk",
        ];
    }
}
