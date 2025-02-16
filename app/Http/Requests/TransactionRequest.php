<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
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
            'borrow_date' => 'required|date',
            'number_of_transaction_lines' => 'required|integer|min:0',
            'is_complete' => 'boolean',
            'reader_id' => 'required|exists:readers,id',
        ];
    }
}
