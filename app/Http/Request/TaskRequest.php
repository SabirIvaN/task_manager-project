<?php

namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|max:50',
            'description' => 'max:500',
            'status_id' => 'required|exists:statuses,id',
            'assigned_to_id' => 'required|exists:users,id',
            'label_id' => 'array',
            'label_id.*' => 'exists:labels,id',
        ];
    }
}
