<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name','parent','sort'],$info;

    /**
     * @var string
     */
    protected $table = 'categories';

    /**
     * No Timestamps (created_at, published_at)
     * @var bool
     */
    public $timestamps = false;


    /*
     * Relations
     */

    public function data()
    {
        return $this->hasMany('App\Modules\Admin\Data');
    }


    public function products()
    {
        return $this->hasMany('App\Product');
    }
}
