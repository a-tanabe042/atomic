<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentStoreRequest extends FormRequest
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
            'belongs.*.belongs_name' => 'bail|required|min:1|max:255|string',
            'belongs.*.parent_id' => 'bail|required|numeric|integer',
            'belongs.*.sort_order' => 'bail|required|digits:6|numeric'
        ];
    }

    /**
     * バリデーションエラーのカスタム属性の取得
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'belongs.*.belongs_name' => '部署名',
            'belongs.*.parent_id' => '親部署',
            'belongs.*.sort_order' => '表示順序'
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attributeは必須項目です',
            'belongs.*.belongs_name.string' => ':attributeは文字列で入力してください',
            'belongs.*.parent_id.numeric' => ':attributeが選択されていません',
            'belongs.*.parent_id.integer' => ':attributeが選択されていません',
            'belongs.*.sort_order.digits:6' => ':attributeは6桁で入力してください',
            'belongs.*.sort_order.numeric' => ':attributeは数値で入力してください'
        ];
    }
}
