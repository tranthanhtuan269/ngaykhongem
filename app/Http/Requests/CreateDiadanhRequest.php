<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateDiadanhRequest extends Request {

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
                'ten_diadanh' => 'required|max:255',
                'mo_ta' => 'required',
            ];
	}

	public function messages()
  	{
	    return [
	        'ten_diadanh.required'  => 'Tên địa danh không được bỏ trống.',
	        'ten_diadanh.max'  => 'Tên địa danh không dài quá 255 kí tự.',
	        'mo_ta.required'  => 'Mô tả không nên bỏ trống.',
	    ];
  	}
}