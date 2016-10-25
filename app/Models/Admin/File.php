<?php

namespace App\Models\Admin;

use FFMpeg\FFMpeg;
use FFMpeg\Format\Video\X264;
use Folklore\Image\Facades\Image;
use Illuminate\Database\Eloquent\Model;
use Storage;


class File extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['data_id','name','file_path','cloud_id','ext','server','hash','type','status','sync'];

    /**
     * @var bool
     */
    public $timestamps = false;


    /*
     * Relations
     */

    /**
     * files has one data
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function data(){
        return $this->hasOne('App\Data');
    }

    /**
     * files has one data
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function products(){
        return $this->hasOne('App\Product');
    }

    /*
     * Functions
     */
    /**
     * @param $images
     * @param $data_id
     * @param bool $file
     * @return array
     */
    public function uploadImages($images,$data_id,$file=true){
        $image_array = [];
        if(count($images) > 0 && $data_id > 0){
            $sync_path = 'sync/local/images/'.date('Y-m').'/'.date('d').'/';
            $path = public_path($sync_path);
            $image_path_name = 'uploads/local/images/'.date('Y-m').'/'.date('d').'/';
            $image_path = public_path($image_path_name);
            foreach($images as $key=>$img){
                if(empty($img)) {
                    unset($img);
                }else{
                    if($file == true) {
                        $filename = uniqid(time() . '_');
                        $name = $filename . '.' . $img->getClientOriginalExtension();
                        if ($img->move($image_path,$name)) {
                                if(!is_dir($path)){mkdir($path,0755,true);}
                                copy($image_path . $name,$path . $name);
                                Image::make($image_path . $name, ['width' => 80])->save($image_path . $filename . '_80.' . $img->getClientOriginalExtension());
                                Image::make($image_path . $name, ['width' => 150])->save($image_path . $filename . '_150.' . $img->getClientOriginalExtension());
                                Image::make($image_path . $name, ['width' => 300])->save($image_path . $filename . '_300.' . $img->getClientOriginalExtension());
                                Image::make($image_path . $name, ['width' => 600])->save($image_path . $filename . '_600.' . $img->getClientOriginalExtension());
                                Image::make($image_path . $name, ['width' => 1000])->save($image_path . $filename . '_1000.' . $img->getClientOriginalExtension());

                                $hash = md5_file($image_path.$name);
                                $image = $this->create(['name' => $filename, 'file_path' => $image_path_name, 'ext' => $img->getClientOriginalExtension(), 'hash'=>$hash,'server'=>'eu', 'type' => 'image', 'status' => (($key == 0) ? 1 : (($key==1000) ? 2 : 0))]);
                                $image_array[$key] = $image->id;
                        }
                    }else{
                        foreach($images as $key=>$img) {
                            $image = $this->create(['name' => $img, 'file_path' => '', 'ext' => '', 'type' => 'image','sever'=>'eu', 'status' => ($key == 0) ? 1 : 0]);
                            $image_array[$key] = $image->id;
                        }
                    }
                }
            }
            return $image_array;
        }
    }


    /**
     * @param $movies
     * @param $data_id
     * @param string $type
     * @return array
     */
    public function uploadFrontMovies($movies,$data_id,$type = 'movie'){
         $movie_array = [];
         if(count($movies) > 0 && $data_id > 0){
             $path_name = 'sync/local/movies/'.$type.'/'.date('Y-m').'/'.date('d').'/';
             $path = public_path($path_name);
             foreach($movies as $movie) {
                 if (empty($movie)) {
                     unset($movie);
                 } else {
                     $filename = uniqid(time().'_');
                     $name = $filename.'.'.$movie->getClientOriginalExtension();
                     if($movie->move($path,$name)){
                         if($movie->getClientOriginalExtension() != 'mp4'){
                             $movie_array['converts'][$path.$name] = ['full_path'=>$path.$filename.'.mp4','name'=>$filename];
                             $hash = '';//md5_file($path.$filename.'.mp4');
                         }else{
                             $hash = md5_file($path.$filename.'.mp4');
                         }
                         $video = $this->create(['name'=>$filename,'file_path'=>$path_name,'ext'=>'mp4','hash'=>$hash,'server'=>'eu','type'=>$type]);
                         $movie_array['files'][] = $video->id;
                     }
                 }
             }
             return $movie_array;
         }
    }

    /**
     * @param $movies
     * @param $data_id
     * @param string $type
     * @return array
     */
    public function uploadMovies($movies,$data_id,$type = 'movie'){
        $movie_array = [];
        if(count($movies) > 0 && $data_id > 0){
            $path_name = 'sync/local/movies/'.$type.'/'.date('Y-m').'/'.date('d').'/';
            $path = public_path($path_name);
            foreach($movies as $movie) {
                if (empty($movie)) {
                    unset($movie);
                } else {
                    $filename = uniqid(time().'_');
                    $name = $filename.'.'.$movie->getClientOriginalExtension();
                    if($movie->move($path,$name)){
                        if($movie->getClientOriginalExtension() != 'mp4'){
                            $ffmpeg = FFMpeg::create(
                                [
                                    'timeout'=>3600
                                ]
                            );
                            $video = $ffmpeg->open($path.$name);
                            $format = new X264();
                            if($video->save($format, $path.$filename.'.mp4')){
                                unlink($path.$name);
                            }
                        }
                        $hash = md5_file($path.$filename.'.mp4');
                        $video = $this->create(['name'=>$filename,'file_path'=>$path_name,'ext'=>'mp4','hash'=>$hash,'server'=>'eu','type'=>$type]);
                        $movie_array[] = $video->id;
                    }
                }
            }
            return $movie_array;
        }
    }


}
