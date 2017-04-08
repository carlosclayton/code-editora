<?php

namespace CodeEditora\Repositories;


use CodeEditora\Criteria\CriteriaTrashedTraitInterface;
use CodeEditora\Criteria\OnlyTrashedTraitInterface;
use Prettus\Repository\Contracts\RepositoryCriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface BookRepository
 * @package namespace App\Repositories;
 */
interface BookRepository extends
    RepositoryInterface,
    RepositoryCriteriaInterface,
    CriteriaTrashedTraitInterface,
    RepositoryRestoreInterface
{

}
