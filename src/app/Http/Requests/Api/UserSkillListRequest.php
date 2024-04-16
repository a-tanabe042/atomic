<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserSkillListRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'user_id' => 'numeric|digits_between:1,20'
        ];
    }

    /**
     * @param void
     * @return array
     */
    public function messages(): array
    {
        return [
            // 改変されるパターンしか起こりえない
            'numeric'                  => "送信データが不正です",
            'digits_between'           => "送信データが不正です"
        ];
    }

    /**
     * [Override] Failed Validation Case Api
     *
     * @param Validator $validator
     * @throw HttpResponseException
     * @see FormRequest::failedValidation()
     */
    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(
            response()->json([
                'data'    => [],
                'status'  => 'NG',
                'summary' => 'Failed validation',
                'errors'  => $validator->errors()->toArray()
            ], 422)
        );
    }
}
