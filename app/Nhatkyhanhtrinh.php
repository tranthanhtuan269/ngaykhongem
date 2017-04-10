<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nhatkyhanhtrinh extends Model
{
    public $timestamps = false;
    protected $table = "nhatkyhanhtrinh";
    protected $fillable = [
        'ten_hanh_trinh',
        'images',
        'type',
        'mo_ta',
        'sub_mo_ta'
        ];
}
