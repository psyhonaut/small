<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketCreateRequest extends FormRequest
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
            'title'         => 'required|min:5|max:200',
            'description'   => 'required|string|max:500|min:3',
            'department_id' => 'required|integer|exists:departments,id',
            'user_id'       => 'required|integer|exists:users,id',
        ];
    }
}
