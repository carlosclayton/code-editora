<?php

namespace CodeEditora\Models;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;


class Category extends Model implements Transformable, TableInterface
{
    use TransformableTrait, SoftDeletes;
    protected $fillable = ['name'];
    protected $dates = ['deleted_at'];

    /**
     * A list of headers to be used when a table is displayed
     *
     * @return array
     */
    public function getTableHeaders()
    {
        return [
            '#',
            'Nome'
        ];
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
            case 'Nome':
                return $this->name;


        }
    }

    public function getNameTrashedAttribute(){
        return $this->trashed() ? "{$this->name} (disabled)" : $this->name;
    }

    /**
     * @return array
     */
    public function transform()
    {
        // TODO: Implement transform() method.
    }

    public function books(){
        return $this->belongsToMany(Book::class);
    }
}
