<?php

namespace App;

Use DB;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstName','lastName', 'email', 'phone' ,'password','primaryLocation','department','type','status'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function deliveries()
    {
        return $this->hasMany(Delivery::class);
    }

    public function isStaff(){
        if ($this->type>1){
            return true;
        }
        else {
            return false;
        }
    }

    public function isAdmin(){
        if ($this->type>2){
            return true;
        }
        else {
            return false;
        }
    }

    public static function getUser($id){
        $user = DB::table('users')->where('id', $id)->first();

        return  $user;
    }

    public function getFullName(){
        return $this->firstName.' '.$this->lastName;
    }


}
