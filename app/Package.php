<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'packages';

    public function sender()
    {
        return $this->belongsTo('App\Client','sender_id');
    }
    public function receiver()
    {
        return $this->belongsTo('App\Client','receiver_id');
    }
    public function senderDepartment()
    {
        return $this->belongsTo('App\Department','sender_department_id');
    }
    public function receiverDepartment()
    {
        return $this->belongsTo('App\Department','receiver_department_id');
    }
    public function inspector()
    {
        return $this->belongsTo('App\Worker','inspector_id');
    }
    public function packingType()
    {
        return $this->belongsTo('App\PackingType','packing_type_id');
    }
    public function packageType()
    {
        return $this->belongsTo('App\PackageType','package_type_id');
    }
}
