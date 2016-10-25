<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = ['lang_id', 'user_id', 'title', 'price', 'extra_texas', 'rate', 'description', 'delivery', 'serving_tips', 'lang'];

    protected $table = 'products';


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


    /**
     * @param $query
     * @param $data
     */
    public function scopeGetFiles($query, $data){
        $query->with(['files' => function ($q) use ($data) {
            $q->where('files.type',$data)->where('status',1)->select('files.name','files.ext','files.file_path','files.status','files.type');
        }]);
    }


    public function scopeNoHash($query){
        $query->whereHas('files',function($q){
            $q->where('files.hash','<>','')->where(function($q){
                $q->where('files.type', 'trailer')->orWhere('files.type', 'screening');
            });
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
            $files = unset_by_value($files);
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
            foreach($old_files as $key=>$file):
                if(isset($new_files[$key]) && $new_files[$key] <> 0 && $key == 1000){
                    $this->files()->detach($file);
                }elseif(isset($new_files[$key]) && $new_files[$key] <> 0 && $key == 0){
                    $this->files()->detach($file);
                }else{
                    $new_files[] = intval($file);
                }
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
