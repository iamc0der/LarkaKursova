<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'distance';
    public $timestamps = false;
    protected $guarded = ['*'];
}
