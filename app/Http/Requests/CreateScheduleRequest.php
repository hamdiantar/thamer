<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateScheduleRequest extends FormRequest
{
    public function rules()
    {
        return [
            "sch_Status" => "required|in:1,0",
            'sch_Day' => 'required|max:200|string|unique:Schedule,sch_Day',
            "sch_Time_From" => "required_if:sch_Status,=,1",
            "sch_Time_To" => "required_if:sch_Status,=,1",
        ];
    }
}
