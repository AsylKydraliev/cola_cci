<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGameRequest extends FormRequest
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
            'game_title' => ['required', 'min:3', 'max:255'],
            'rounds_quantity' => ['required', 'numeric'],
            'rounds' => ['required', 'array'],
            'round_descriptions' => ['required', 'array'],
            'questions' => ['required', 'array'],
            'points' => ['required', 'array'],
            'answer_ids' => ['required', 'array'],

            // правила для элементов внутри массивов
            'rounds.*' => ['required'],
            'round_descriptions.*' => ['required'],
            'questions.*' => ['required', 'max:255'],
            'points.*' => ['required'],
            'answer_ids.*' => ['required'],
        ];
    }
}
