<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'last_name', 'email', 'password','verify','disabled','confirmation_code', 'info', 'subscribe'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @var
     */
    protected $data;

    //User Relations
    /**
     * User Roles
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles(){
        return $this->belongsToMany('App\Models\Admin\Role')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function data(){
        return $this->hasMany('App\Models\Admin\Data');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function product(){
        return $this->hasMany('App\Product');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inspection(){
        return $this->hasMany('App\Inspection');
    }

    //User Attributes
    /**
     * @return data files
     */
    public function favorite()
    {
        return $this->belongsToMany('App\Models\Admin\Data');
    }
    /**
     * @param $pass
     * @return array
     */
    public function setPasswordAttribute($pass){
        if(!empty($pass)){
            $this->attributes['password'] = bcrypt($pass);
        }
    }

    // USER Scopes
    /**
     * @param $query
     * @param array $data
     */
    public function scopeOrderRole($query, array $data){
        $this->data = $data;
        $query->with(['roles' => function ($q) {
            $q->whereNotIn('name',$this->data);
        }]);
        $query->whereHas('roles',function($q){
            $q->whereNotIn('name',$this->data);
        });
    }

    //User FUNCTIONS
    /**
     * @param $name
     * @return bool
     */
    public function hasRole($name){
        foreach($this->roles as $role):
            if(is_array($name)){
                if(in_array($role->name,$name)){
                    return true;
                }
            }else if($role->name == $name) {
                return true;
            }
        endforeach;

        return false;
    }

    /**
     * adding user role
     * @param array $data
     */
    public function addRole($data){
        $this->roles()->attach($data);
    }

    /**
     * @param array $data
     */
    public function updateRole($data){
        $this->roles()->detach();
        $this->roles()->attach($data);
    }

}
