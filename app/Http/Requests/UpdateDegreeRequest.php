<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateDegreeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::user()->role && strtolower(Auth::user()->role->name) === 'admin';
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:50|unique:degrees,name,' . $this->degree->id,
            'abbrev' => 'nullable|string|max:10',
            'description' => 'nullable|string|max:255',
        ];
    }
}
