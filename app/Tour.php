<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    public $timestamps = false;
    protected $table = "tour";
    protected $fillable = [
        'ten_tour',
        'images',
        'ngay_khoi_hanh',
        'ngay_ket_thuc',
        'gia_tour',
        'phuong_tien',
        'type',
        'lich_trinh',
        'nguoi_dan'];

    public function nguoi_dan()
    {
        return $this->belongsTo(User::class);
    }
}
