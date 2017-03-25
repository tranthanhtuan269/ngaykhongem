<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateTourRequest extends Request {

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
                'ten_tour' => 'required|max:255',
                'ngay_khoi_hanh' => 'required',
                'ngay_ket_thuc' => 'required',
                'lich_trinh' => 'required',
                'gia_tour' => 'required|numeric|min:100',
            ];
	}

	public function messages()
  	{
	    return [
	        'ten_tour.required'  => 'Tên Tour không được bỏ trống.',
	        'ten_tour.max'  => 'Tên Tour không dài quá 255 kí tự.',
	        'lich_trinh.required'  => 'Lịch trình không nên bỏ trống.',
	        'gia_tour.required'  => 'Giá Tour không được bỏ trống.',
	        'gia_tour.numeric'  => 'Giá Tour phải là số.',
	        'gia_tour.min'  => 'Giá tour quá bé.',
	    ];
  	}
}