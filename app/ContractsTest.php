<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContractsTest extends Model
{
    protected $connection = 'mysql_las';
    protected $table = 'nikkenla_incorporation.contracts';

    public $incrementing = false;
    public $timestamps = false;
}
