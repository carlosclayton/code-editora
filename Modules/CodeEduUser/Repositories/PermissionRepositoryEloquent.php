<?php

namespace CodeEduUser\Repositories;

use CodeEduUser\Models\Permission;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeEduUser\Models\User;

/**
 * Class UserRepositoryEloquent
 * @package namespace CodeEditora\Repositories;
 */
class PermissionRepositoryEloquent extends BaseRepository implements PermissionRepository
{



    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Permission::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
