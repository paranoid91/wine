<?php

namespace App\Models\Admin;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['lang_id','user_id','title','text','desc','status','main','discount','extra_fields','img','lang','published_at','finished_at'];

    /**
     * @var
     */
    protected $data;

    /*
     * Set Attributes
     */
    /**
     * Serializing extra_fields
     * @param $data
     */
    public function setExtraFieldsAttribute($data){
        $this->attributes['extra_fields'] = @serialize($data);
    }

    /**
     * @param $date
     */
    public function setPublishedAtAttribute($date){
        $this->attributes['published_at'] = (strtotime($date)) ? Carbon::createFromFormat('d/m/Y H:i',$date) : '';
    }

    /**
     * @param $date
     */
    public function setFinishedAtAttribute($date){
        $this->attributes['finished_at'] = (strtotime($date)) ? Carbon::createFromFormat('d/m/Y H:i',$date) : '';
    }

    /**
     * @param $value
     */
    public function setTitleAttribute($value){
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = (isset($this->slug) && !empty($this->slug)) ? $this->slug : str_slug($value);
        if(isset($_REQUEST['_method']) == 'PATCH'){
            $slug = $this->where('id',$this->id)->where('slug',$this->attributes['slug'])->count();
            $this->attributes['slug'] = (!empty($slug) && $slug == 1) ? $this->attributes['slug'] : ((!$slug) ? $this->attributes['slug'] : $this->attributes['slug'] . '-' . str_random(5));
        }else{
            $slug = Data::whereSlug($this->attributes['slug'])->first();
            $this->attributes['slug'] = (empty($slug)) ? $this->attributes['slug'] : $this->attributes['slug'] . '-' . str_random(5);
        }
    }

    /*
     * Get Attributes
     */

    /**
     * @param $value
     * @return mixed|string
     */
    public function getExtraFieldsAttribute($value){
        return (!empty($value)) ? @unserialize($value) : '';
    }

    /**
     * @param $date
     * @return static
     */
    public function getPublishedAtAttribute($date){
        return date('d/m/Y H:i',strtotime($date));
    }

    /**
     * @param $date
     * @return static
     */
    public function getFinishedAtAttribute($date){
        return date('d/m/Y H:i',strtotime($date));
    }

    /*
     * Scopes
     */

    /**
     * @param $query
     */
    public function scopePublished($query){
        $query->where('status','>',0)->where('published_at','<=',Carbon::now())->where('finished_at','>',Carbon::now());
    }

    public function scopeFeatured($query){
        $query->where('status',2)->where('published_at','<=',Carbon::now())->where('finished_at','>',Carbon::now());
    }

    public function scopeStandard($query){
        $query->where('status',1)->where('published_at','<=',Carbon::now())->where('finished_at','>',Carbon::now());
    }

    public function scopeFilter($query,$value){

        if(isset($value['type']) && $value['type'] > 0){
            $query->whereHas('categories',function($q) use ($value){
                $q->where('categories.id',$value['type']);
            });
        }

        if(isset($value['categories']) && $value['categories'] > 0){
            $query->whereHas('categories',function($q) use ($value){
                $q->where('categories.id',$value['categories']);
            });
        }

        if(isset($value['percent_from']) && $value['percent_from'] > -1 && isset($value['percent_to']) && $value['percent_to'] > 0){
            $query->whereBetween('discount',[($value['percent_from'] > 1) ? $value['percent_from'] : 0,$value['percent_to']]);
        }

        if(isset($value['title']) && $value['title'] != ""){
            $query->where('title','LIKE','%'.$value['title'].'%');
        }

    }

    /**
     * @param $query
     * @param $data
     */
    public function scopeByCat($query,$data){
        $this->data = $data;
        $query->whereHas('categories',function($q){
            $q->where('categories.name',$this->data)->select(['categories.id','categories.name']);
        });
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


    /**
     * @return data files
     */
    public function files(){
        return $this->belongsToMany('App\Models\Admin\File');
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


    /**
     * @return array|bool
     */
    public function getCategories(){
        if(count($this->categories) > 0){
            return array_pluck($this->categories->toArray(),'pivot.cat_id');
        }else{
            return false;
        }
    }


    /**
     * Attaching data files
     * @param $files
     */
    public function addFiles($files){
        if(count($files) > 0){
            $this->files()->attach($files); // files array[]
        }
    }

    /**
     * Update Files
     * @param $files
     */
    public function updateFiles($files){
        $this->files()->detach();
        if(count($files) > 0){
            $this->files()->attach($files); // files array[]
        }
    }

    /**
     *  Generate Files
     * @param $first_array
     * @param $second_array
     * @return array
     */

    public function generateFiles($first_array,$second_array){
        $result = [];
        if(count($first_array) > 0){
            foreach($first_array as $fa):
                $result[] = $fa;
            endforeach;
        }
        if(count($second_array) > 0){
            foreach($second_array as $se):
                $result[] = $se;
            endforeach;
        }
        return $result;
    }

    /**
     * @param $new_files
     * @param $old_files
     * @return array
     */
    public function checkOldFiles($new_files,$old_files){
        if(count($old_files) > 0){
            foreach($old_files as $file):
                $new_files[] = intval($file);
            endforeach;
        }
        return $new_files;
    }

    /**
     * @return array|bool
     */
    public function getFiles(){
        if(count($this->files) > 0){
            return array_pluck($this->files,'pivot.file_id');
        }else{
            return [];
        }
    }


    /**
     * Adding Language ID form Data
     * @param $lang_id
     */
    public function addLanguageId($lang_id){
        $this->update(['lang_id'=>$lang_id]);
    }
    
}