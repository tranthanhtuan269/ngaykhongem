<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateYeucaunhaRequest extends Request {

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
            'tinh' => 'required',
            'huyen' => 'required',
            'tam_tien' => 'required|numeric|min:1000',
            'dien_tich' => 'required|numeric|min:10',
            'mat_tien' => 'required|numeric|min:2',
            'duong_vao' => 'required|numeric|min:1',
            'tang' => 'required|numeric|min:0',
            'phong_ngu' => 'required|numeric|min:0',
            'phong_khach' => 'required|numeric|min:0',
            'wc' => 'required|numeric|min:0'
        ];
	}

	public function messages()
  	{
	    return [
	        'tam_tien.required'  => 'Quý khách không nên bỏ trống thông số tầm tiền.',
	        'dien_tich.required'  => 'Quý khách không nên bỏ trống thông số diện tích.',
	        'mat_tien.required'  => 'Quý khách không nên bỏ trống thông số mặt tiền.',
	        'duong_vao.required'  => 'Quý khách không nên bỏ trống thông số độ rộng đường vào.',
	        'tang.required'  => 'Quý khách không nên bỏ trống số tầng.',
	        'phong_ngu.required'  => 'Quý khách không nên bỏ trống số phòng ngủ.',
	        'phong_khach.required'  => 'Quý khách không nên bỏ trống số phòng khách.',
	        'wc.required'  => 'Quý khách không nên bỏ trống số nhà vệ sinh.',

	        'tam_tien.numeric'  => 'Quý khách cần điền tầm tiền bằng số.',
	        'dien_tich.numeric'  => 'Quý khách cần điền diện tích bằng số.',
            'mat_tien.numeric'  => 'Quý khách cần điền mặt tiền bằng số.',
            'duong_vao.numeric'  => 'Quý khách cần điền đường vào bằng số.',
            'tang.numeric'  => 'Quý khách cần điền số tầng bằng số.',
            'phong_ngu.numeric'  => 'Quý khách cần điền số phòng ngủ bằng số.',
            'phong_khach.numeric'  => 'Quý khách cần điền số phòng khách bằng số.',
            'wc.numeric' => 'Quý khách cần điền số nhà vệ sinh bằng số.',

            'tam_tien.min'  => 'Tầm tiền Quý khách muốn mua quá bé.',
            'dien_tich.min'  => 'Diện tích Quý khách có quá bé.',
            'mat_tien.min'  => 'Mặt tiền Quý khách có quá bé.',
            'duong_vao.min'  => 'Đường vào nhà Quý khách quá bé.',
            'tang.min'  => 'Số tầng nhà Quý khách phải lớn hơn hoặc bằng 0.',
            'phong_ngu.min'  => 'Số phòng ngủ nhà Quý khách phải lớn hơn hoặc bằng 0.',
            'phong_khach.min'  => 'Số phòng khách nhà Quý khách phải lớn hơn hoặc bằng 0.',
            'wc.min' => 'Số nhà vệ sinh nhà Quý khách phải lớn hơn hoặc bằng 0.',
	    ];
  	}
}