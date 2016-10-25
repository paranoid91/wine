<?php

namespace App;

use Carbon\Carbon;
use Folklore\Image\Facades\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Inspection extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'receipted_at',
        'executed_at',
        'insurer',
        'registration_number',
        'vincode',
        'mark',
        'model',
        'year',
        'mileage',
        'engine_volume',
        'length',
        'law',
        'owner',
        'phone',
        'personal_id',
        'total',
        'extra'
    ];

    /**
     * @var string
     */
    protected $table = 'auto_invoice';

    /*
     * Set Attributes
     */

    /**
     * Serializing extra_fields
     * @param $value
     */
    public function setExtraAttribute($value){
        $this->attributes['extra'] = @serialize($value);
    }

    /**
     * @param $value
     */
    public function setReceiptedAtAttribute($value){
        $this->attributes['receipted_at'] = ($value != "0000-00-00 00:00:00" && $value != "30/11/-0001 12:00") ? Carbon::createFromFormat('d/m/Y h:i',$value) : null;
    }

    /**
     * @param $value
     */
    public function setExecutedAtAttribute($value){
        $this->attributes['executed_at'] = ($value != "0000-00-00 00:00:00" && $value != "30/11/-0001 12:00") ? Carbon::createFromFormat('d/m/Y h:i',$value) : null;
    }
    /*
     * Get Attributes
     */

    /**
     * Unserializing extra_fields
     * @param $value
     * @return mixed|string
     */
    public function getExtraAttribute($value){
        return (!empty($value)) ? @unserialize($value) : '';
    }

    /**
     * @param $value
     * @return bool|string
     */
    public function getReceiptedAtAttribute($value){
        return date('d/m/Y h:i',strtotime($value));
    }

    /**
     * @param $value
     * @return bool|string
     */
    public function getExecutedAtAttribute($value){
        return  date('d/m/Y h:i',strtotime($value));
    }
    /*
     * Relations
     */
    /**
     * Articles is owned by user.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories(){
        return $this->belongsToMany('App\Models\Admin\Cat');
    }

    /*
     * Scopes
     */
    /**
     * @param $query
     * @param $data
     */
    public function scopeByCat($query,$data){
        $query->whereHas('categories',function($q) use ($data){
            $q->where('categories.name',$data)->select(['categories.id','categories.name']);
        });
    }
    /**
     * @param $query
     * @param $data
     */
    public function scopeByCatId($query,$data){
        $query->whereHas('categories',function($q) use ($data){
            if(is_numeric($data) && !is_array($data)){
                $q->where('categories.id',$data)->select(['categories.id','categories.name']);
            }
            if(is_array($data)){
                $q->whereIn('categories.id',$data)->select(['categories.id','categories.name']);
            }
        });
    }

    /*
     * Functions
     */

    /**
     * Attaching data categories
     * @param $categories
     */
    public function addCategories($categories){
        $this->categories()->attach($categories); // categories array[]
    }

    /**
     * Updating data categories
     * @param $categories
     */
    public function updateCategories($categories){
        $this->categories()->detach();
        $this->categories()->attach($categories); // categories array[]
    }


    public function uploadImages($images,$extra){
        if(count($images) > 0){
            if($images[0] != null){
                $i = (count(is_key($extra,'image')) > 0) ? max(array_keys(is_key($extra,'image'))) : 0;
                foreach($images as $k=>$img){
                    $i++;
                    $filename = uniqid(time() . '_');
                    $name = $filename . '.' . $img->getClientOriginalExtension();
                    $image_path = public_path(Config::get('global.upload_path').date('Y-m').'/'.date('d').'/');
                    if($img->move($image_path,$name)){
                        Image::make($image_path. $name, ['width' => 100])->save($image_path . $filename . '_100.' . $img->getClientOriginalExtension());
                        Image::make($image_path. $name, ['width' => 300])->save($image_path . $filename . '_300.' . $img->getClientOriginalExtension());
                        Image::make($image_path . $name, ['width' => 600])->save($image_path . $filename . '_600.' . $img->getClientOriginalExtension());
                        Image::make($image_path . $name, ['width' => 1000])->save($image_path . $filename . '_1000.' . $img->getClientOriginalExtension());
                    }
                    $extra['image'][$i]['dir'] = Config::get('global.upload_path').date('Y-m').'/'.date('d').'/';
                    $extra['image'][$i]['name'] = $filename;
                    $extra['image'][$i]['ext'] = $img->getClientOriginalExtension();
                }
                $this->update(['extra'=>$extra]);
            }
        }
    }


}
