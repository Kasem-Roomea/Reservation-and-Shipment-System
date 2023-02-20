<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trip extends Model
{
    use HasFactory;
    protected $table = 'trips';
    protected $guarded = [];
    public $timestamps = true;

    public function micro()
    {
        return $this->belongsTo('App\Models\micro','micro_id' , 'id');
    }

    public function driver()
    {
        return $this->belongsTo('App\Models\driver','driver_id' , 'id');
    }

    public function fDriver()
    {
        return $this->belongsTo('App\Models\driver','driver_id2' , 'id');
    }

    public function allOpTrustees()
    {
        return $this->hasMany('App\Models\Trustees','trip_id' , 'id');
    }

    public function allOpTickets()
    {
        return $this->hasMany('App\Models\tickets','trip_id' , 'id');
    }

    public function numM()
    {
        return $this->hasMany('App\Models\tickets','trip_id' , 'id')->where('gender' , 'ذكر');
    }

    public function numW()
    {
        return $this->hasMany('App\Models\tickets','trip_id' , 'id')->where('gender' , 'أنثى');
    }


}
