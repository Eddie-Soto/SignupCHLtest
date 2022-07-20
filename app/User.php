<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $connection = 'mysql_la_users';
    protected $table = 'users';

    public $incrementing = false;
    public $timestamps = false;
}
