<?php

namespace CodeEduUser\Models;

use CodeEduUser\Models\User;
use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;

class Role extends Model implements TableInterface
{
    protected $fillable = ['name', 'description'];

    public function permissions(){
        return $this->belongsToMany(Permission::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }

    /**
     * A list of headers to be used when a table is displayed
     *
     * @return array
     */
    public function getTableHeaders()
    {
        return ['#', 'Name', 'Description'];
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
            case 'Description':
                return $this->description;

        }

    }
}
