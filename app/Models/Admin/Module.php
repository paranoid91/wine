<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    /**
     * Fillable rows in models table
     * @var array
     */
    protected $fillable = ['name','controller','icon','status','sort'];

    /**
     * No Timestamps (created_at, published_at)
     * @var bool
     */
    public $timestamps = false;

    /**
     * @param $module
     * @return string
     */
    public function moduleStatus($module){
        if($module->status > 0)
        {
            $module->update(['status'=>'0']);
            return 'unpublished';
        }else{
            //Article::where('status','=','1')->update(['status'=>'0']);
            $module->update(['status'=>'1']);
            return 'published';
        }
    }

}
