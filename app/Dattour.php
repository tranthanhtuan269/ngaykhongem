<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dattour extends Model
{
    public $timestamps = false;
    protected $table = "dattour";
    protected $fillable = [
        'tour_id',
        'user_id',
        'created_at'
        ];
}
