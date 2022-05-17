<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEvent extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'image' => 'nullable|image',
            'title' => 'required|string|max:60',
            'genre' => 'required|integer',
            'area' => 'required|integer',
            'location' => 'required|string|max:60',
            'date' => 'required|date|after:today',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'contents' => 'required|max:500',
            'condition' => 'required|max:500',
            'stuff' => 'required|max:500',
            'attention' => 'required|max:500',
            'number' => 'required|integer|between:1,50',
            'deadline' => 'required|after:now|before:date',
            'status' => 'boolean'
        ];
    }
}
