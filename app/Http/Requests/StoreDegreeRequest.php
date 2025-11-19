<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDegreeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
   public function authorize(): bool
{
    return $this->user() && $this->user()->role && strtolower($this->user()->role->name) === 'admin';
}

public function rules(): array
{
    return [
        'name' => 'required|string|max:50|unique:degrees',
        'abbrev' => 'nullable|string|max:10',
        'description' => 'nullable|string|max:255',
    ];
}

}
