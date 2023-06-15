<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersTest extends Model
{
    protected $connection = 'mysql_la_users_test';
    protected $table = 'users';

    public $incrementing = false;
    public $timestamps = false;
}
