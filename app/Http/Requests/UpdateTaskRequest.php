<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
            'title' => 'sometimes|string|max:100|unique:tasks,title',
            'description' => 'sometimes|string|min:10',
            'status' => 'sometimes|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'title.max' => 'В названии должно быть максимум 100 символов',
            'title.unique' => 'Задача с таким названием уже существует',
            'description.min' => 'В описании задачи должно быть минимум 10 символов'
        ];
    }
}
