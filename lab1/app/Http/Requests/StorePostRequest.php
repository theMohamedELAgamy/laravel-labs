<?php

namespace App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\post;
class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    // Rule::unique('App\Models\post')->ignore()
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
            'title' => ['required','min:3','regex:^[a-zA-Z]+$^' ,Rule::unique('App\Models\post')->ignore($this->id)],
            'description' => ['required' ,'min:10'],
            'creator'=>['exists:App\Models\post,user_id']
        ];
    }

}
