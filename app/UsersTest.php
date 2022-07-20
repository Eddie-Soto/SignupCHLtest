<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersTest extends Model
{
    protected $connection = 'mysql_la_users';
    protected $table = 'users';

    public $incrementing = false;
    public $timestamps = false;
}
