<?php

namespace App\Http\Requests\Score;

use Illuminate\Foundation\Http\FormRequest;

class ExtracurricularRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id_extra' => ['required', 'integer'],
            'id_student_class' => 'required|array|min:1',
            'id_student_class.*' => 'required|integer',
            'score' => 'array|min:1',
            'score.*' => 'string',
            'description' => 'required|array|min:1',
            'description.*' => 'required|string',
        ];
    }


    public function messages()
    {
        return [
            'id_student_class.required' => 'The student class is required',
            'id_student_class.min' => 'At least one student class must be selected',
            'id_student_class.*.required' => 'The student class is required',
            'id_student_class.*.integer' => 'The student class must be an integer',
            'score.min' => 'At least one score must be selected',
            'description.required' => 'The description is required',
            'description.min' => 'At least one description must be provided',
            'description.*.required' => 'The description is required',
            'description.*.string' => 'The description must be a string',
        ];
    }
}
