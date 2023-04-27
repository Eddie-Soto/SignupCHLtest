<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Segmentacion extends Model
{
    protected $connection = 'mysql_las';
    protected $table = 'nikkenla_incorporation.segmentacion_iw';
    protected $guarded = []; 
    // public $incrementing = false;
    public $timestamps = false;
}
