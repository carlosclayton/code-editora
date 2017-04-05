<?php

namespace CodeEditora\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeEditora\Repositories\UserRepository;
use CodeEditora\Models\User;
use CodeEditora\Validators\UserValidator;

/**
 * Class UserRepositoryEloquent
 * @package namespace CodeEditora\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
