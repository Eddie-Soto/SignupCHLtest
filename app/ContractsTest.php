<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContractsTest extends Model
{
    protected $connection = 'mysql_las';
    protected $table = 'nikkenla_incorporation.contracts_test';

    public $incrementing = false;
    public $timestamps = false;
}
