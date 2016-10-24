<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quantamnha extends Model
{
    protected $table = "quantamnha";
    protected $fillable = ['user_id', 'nha_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function nha_id()
    {
        return $this->belongsTo(TinBDS::class);
    }
}
