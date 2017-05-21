<?php

namespace CodeEduUser\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface UserRepository
 * @package namespace CodeEditora\Repositories;
 */
interface RoleRepository extends RepositoryInterface
{
    public function updatePermissions(array $permissions, $id);
}
