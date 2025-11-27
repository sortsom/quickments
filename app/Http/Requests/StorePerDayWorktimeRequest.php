<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePerDayWorktimeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // MUST BE TRUE
    }

    public function rules()
    {
        return [
            'member_id' => 'required|integer|exists:members,id',

            // days array required
            'days' => 'required|array|min:1',

            // per-day validation
            'days.*.start_time'  => 'nullable',
            'days.*.end_time'    => 'nullable',

            'days.*.start_time2' => 'nullable',
            'days.*.end_time2'   => 'nullable',
            

            'days.*.half_day'    => 'nullable|in:on,1,0',
            'days.*.work'        => 'nullable|in:on,1,0',

            'days.*.id'          => 'nullable|integer|exists:worktimes,id',
        ];
    }

    public function messages()
    {
        return [
            'member_id.required' => 'សូមជ្រើសរើសបុគ្គលិក។',
            'days.required'      => 'សូមជ្រើសរើសថ្ងៃយ៉ាងហោចណាស់ ១ថ្ងៃ។',

            'days.*.start_time.date_format' => 'ម៉ោងចាប់ផ្តើមមិនត្រឹមត្រូវ។',
            'days.*.end_time.date_format'   => 'ម៉ោងចប់មិនត្រឹមត្រូវ។',

            'days.*.start_time2.date_format' => 'ម៉ោងចាប់ផ្តើមទី២មិនត្រឹមត្រូវ។',
            'days.*.end_time2.date_format'   => 'ម៉ោងចប់ទី២មិនត្រឹមត្រូវ។',

            'days.*.half_day.in' => 'ទម្រង់ Half day មិនត្រឹមត្រូវ។'
        ];
    }

    public function prepareForValidation()
    {
        $days = $this->input('days', []);

        foreach ($days as $key => $day) {

            // Convert checkbox “on” → 1
            $half = isset($day['half_day']) ? 1 : 0;
            $work = isset($day['work']) ? 1 : 0;

            // If half-day → clear afternoon session
            if ($half == 1) {
                $day['start_time2'] = null;
                $day['end_time2']   = null;
            }

            // save back clean data
            $day['half_day'] = $half;
            $day['work']     = $work;

            $days[$key] = $day;
        }

        $this->merge(['days' => $days]);
    }
}
