<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use App\Group;
use Illuminate\Validation\Rule;
class GroupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'group_id'=>['required','min:8'],
            'group_title'=>['required','min:4'],
            'group_language'=>['required','min:3',Rule::unique((new Group())->getTable())->ignore($this->group->id ?? null)],
            'token'=>['required','min:20',Rule::unique((new Group())->getTable())->ignore($this->group->id ?? null)]
        ];
    }
}
