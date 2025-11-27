<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWorktimeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'member_id'   => 'required|integer|exists:members,id',
            'day'         => 'required|array|min:1',
            'day.*'       => 'required|integer|exists:weeklies,id',
            'start_time' => ['required', 'regex:/^\d{2}:\d{2}(:\d{2})?$/'],
            'end_time'   => ['required', 'regex:/^\d{2}:\d{2}(:\d{2})?$/', 'after:start_time'],
            'start_time2' => ['nullable', 'regex:/^\d{2}:\d{2}(:\d{2})?$/'],
            'end_time2'   => ['nullable', 'regex:/^\d{2}:\d{2}(:\d{2})?$/', 'after:start_time2'],

            'half_day'    => 'nullable|integer|in:0,1',
        ];
    }



   
    public function messages()
    {
        return [
            'member_id.required' => 'សូមជ្រើសរើសបុគ្គលិក។',
            'day.required'       => 'សូមជ្រើសរើសថ្ងៃយ៉ាងហោចណាស់ ១ថ្ងៃ។',
            'start_time.required'=> 'សូមបញ្ចូលម៉ោងចាប់ផ្តើម។',
            'start_time.date_format' => 'ម៉ោងចាប់ផ្តើមមិនត្រឹមត្រូវ។',
            'end_time.required'  => 'សូមបញ្ចូលម៉ោងចប់។',
            'end_time.after'     => 'ម៉ោងចប់ត្រូវធំជាងម៉ោងចាប់ផ្តើម។',

            'start_time2.date_format' => 'ម៉ោងចាប់ផ្តើមទី២មិនត្រឹមត្រូវ។',
            'end_time2.date_format'   => 'ម៉ោងចប់ទី២មិនត្រឹមត្រូវ។',
            'end_time2.after'         => 'ម៉ោងចប់ទី២ត្រូវធំជាងម៉ោងចាប់ផ្តើមទី២។',

            'half_day.in' => 'ទម្រង់ Half day មិនត្រឹមត្រូវ។'
        ];
    }




public function prepareForValidation()
{
    $half = $this->input('half_day') == 1 ? 1 : 0;

    // If half-day, automatically remove afternoon session
    if ($half == 1) {
        $this->merge([
            'start_time2' => null,
            'end_time2'   => null,
        ]);
    }

    $this->merge(['half_day' => $half]);
}



}