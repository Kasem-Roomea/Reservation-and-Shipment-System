<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class micro extends Model
{
    use HasFactory;
    protected $table = 'micros';
    protected $guarded = [];
    public $timestamps = true;



}
