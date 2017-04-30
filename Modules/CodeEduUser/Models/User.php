<?php

namespace CodeEduUser\Models;

use Bootstrapper\Interfaces\TableInterface;
use CodeEduBook\Models\Books;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements Transformable, TableInterface
{
    use TransformableTrait, Notifiable, SoftDeletes;

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function generetaPassword($password = null ){
        return !$password ? bcrypt(str_random(8)) : bcrypt($password);
    }

    public function books(){
        return $this->hasMany(Books::class);
    }

    /**
     * A list of headers to be used when a table is displayed
     *
     * @return array
     */
    public function getTableHeaders()
    {
        return ['#', 'Name', 'E-mail'];
    }

    /**
     * Get the value for a given header. Note that this will be the value
     * passed to any callback functions that are being used.
     *
     * @param string $header
     * @return mixed
     */
    public function getValueForHeader($header)
    {
        switch($header){
            case '#':
                return $this->id;
            case 'Name':
                return $this->name;
            case 'E-mail':
                return $this->email;

        }
    }

    /**
     * @return array
     */
    public function transform()
    {
        // TODO: Implement transform() method.
    }

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    /**
     * @param Collection|String $role
     * @return bollean
     */
    public function hasRole($role){
        return is_string($role) ? $this->roles->contains('name', $role) : (boolean) $role->intersect($this->roles)->count();
    }


    public function isAdmin(){
        return $this->hasRole(config('codeeduuser.acl.role_admin'));
    }

}
