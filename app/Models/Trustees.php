<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trustees extends Model
{
    use HasFactory;
    protected $table = 'Trustees';
    protected $guarded = [];
    public $timestamps = true;
}
