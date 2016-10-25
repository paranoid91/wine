<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = ['user_id','data_id','status','type','key'];

    protected $table = 'data_user';
}
