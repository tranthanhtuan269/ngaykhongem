<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateHDVRequest extends Request {

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
                'name' => 'required|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|min:10|max:11',
            ];
	}

	public function messages()
  	{
	    return [
	        'name.required'  => 'Tên hướng dẫn viên không được bỏ trống.',
	        'name.max'  => 'Tên hướng dẫn viên không dài quá 255 kí tự.',
	        'email.required'  => 'Email không được bỏ trống.',
                'email.max'  => 'Email không dài quá 255 kí tự.',
                'phone.required' => 'Phone hướng dẫn viên không được bỏ trống.',
                'phone.min' => 'Phone hướng dẫn viên không ít hơn 10 số.',
                'phone.max' => 'Phone hướng dẫn viên không nhiều hơn 11 số.',
	    ];
  	}
}