<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ControlciTest extends Model
{
    protected $connection = 'mysql_las';
    protected $table = 'nikkenla_marketing.control_ci';

    public $incrementing = false;
    public $timestamps = false;
}
