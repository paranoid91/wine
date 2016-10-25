<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['title','text','poster','is_publish','lang_id','lang'];

}
