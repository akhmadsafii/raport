<?php

namespace App\Http\Requests\Major;

use App\Helpers\Helper;
use Illuminate\Foundation\Http\FormRequest;

class MajorRequest extends FormRequest
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
            'name' => ['required'],
            'slug' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama harus diisi!',
        ];
    }

    protected function getValidatorInstance()
    {
        $data = $this->all();
        $data['slug'] = str_slug($data['name']) . '-' . Helper::str_random(5);
        $this->getInputSource()->replace($data);

        return parent::getValidatorInstance();
    }
}
