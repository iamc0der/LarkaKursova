<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Department extends Model
{
    protected $table = 'departments';
    public $timestamps = false;
    public function city()
    {
        return $this->belongsTo('App\City','city_id');
    }
    public function workers()
    {
        return $this->hasMany('App\Worker');
    }
}
