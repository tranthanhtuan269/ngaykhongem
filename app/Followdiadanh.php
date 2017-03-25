<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Followdiadanh extends Model
{
    public $timestamps = false;
    protected $table = "followdiadanh";
    protected $fillable = [
        'diadanh_id',
        'user_id',
        'created_at',
        'updated_at'
        ];
}
