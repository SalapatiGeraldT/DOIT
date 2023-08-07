<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskStoreRequest extends FormRequest
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
        $taskId = $this->input('id'); // Get the 'id' value from the request

        return [
            'title' => [
                'required',  
                'max:128',
                'min:4',
                Rule::unique('tasks', 'title')->ignore($taskId, 'task_id'),
            ],
            'description' =>  ['required',  'max:349', 'min:8'],
            'status' =>  ['required', 'in:DONE,DOING,TODO'],
            'due_date' => ['nullable', 'after:' . date(DATE_ATOM)],
        ];
    }
}
