<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diadanh extends Model
{
    public $timestamps = false;
    protected $table = "diadanh";
    protected $fillable = [
        'ten_diadanh',
        'images',
        'type',
        'mo_ta',
        'sub_mo_ta'
        ];
}
