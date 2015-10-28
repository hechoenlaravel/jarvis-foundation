<?php

namespace Hechoenlaravel\JarvisFoundation\Tests\Stubs;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table = "app_users";

    protected $fillable = ['name', 'email', 'password', 'uuid'];
}