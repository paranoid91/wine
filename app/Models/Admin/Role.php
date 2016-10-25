<?php namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {

    /**
     * @var array
     */
    protected $fillable = ['name','permissions'];

    /**
     * @var array
     */
    protected $arr = array();

    /**
     * @var string
     */
    protected $table = "roles";

    /**
     * @var
     */
    protected $permissions;

    /**
     * @param $groups
     */
    public function setPermissionsAttribute($groups){

        if(is_array($groups)){
            foreach($groups as $key => $item):
                    if(in_array('edit',$item)){
                        $groups = array_add($groups,$key.'.update','update');
                    }
                    if(in_array('index',$item)){
                        $groups = array_add($groups,$key.'.show','show');
                    }
                    if(in_array('create',$item)){
                        $groups = array_add($groups,$key.'.store','store');
                    }
                    $groups = array_add($groups,$key.'.filter','filter');
            endforeach;
        }

        $this->attributes['permissions'] = serialize($groups);

    }


    /**
     * @return Roles
     */
    public function roles(){
        $i=0;foreach($this->all() as $role){
            //$arr[$i]['permissions'] = $role->permissions;
            $this->arr[$i]['role'] = $role->name;
            $i++;
        }
        return $this->arr;
    }


    /**
     * @param $query
     * @param array $data
     */
    public function scopeNouser($query, array $data){
        $query->whereNotIn('name',$data);
    }



    public function getPermissionsAttribute($value){
        return unserialize($value);
    }






}
