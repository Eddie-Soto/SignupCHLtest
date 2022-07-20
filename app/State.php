<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $connection = 'mysql_las';
    protected $table = 'control_states_test';

    public $incrementing = false;
    public $timestamps = false;

}
