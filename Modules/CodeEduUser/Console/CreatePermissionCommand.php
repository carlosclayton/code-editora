<?php

namespace CodeEduUser\Console;

use CodeEduUser\Annotations\PermissionReader;
use CodeEduUser\Repositories\PermissionRepository;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CreatePermissionCommand extends Command
{

    /**
     * @var PermissionRepository
     */
    private $repository;

    /**
     * @var PermissionReader
     */
    private $reader;
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'codeeduuser:make-permission';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create permission based on Controller and Action';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(PermissionRepository $repository, PermissionReader $reader)
    {
        parent::__construct();
        $this->repository = $repository;
        $this->reader = $reader;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $permissions = $this->reader->getPermissions();
        foreach($permissions as $permission){
            if(!$this->existsPermission($permission)){
                $this->repository->create($permission);
                $this->info("<info>Permission ". $permission['name'] .":". $permission['resource_name'] ." loaded with success</info>");
            }
        }
        $this->info("<info>Nothing to do</info>");
    }

    private function existsPermission($permission){
        $permission = $this->repository->findWhere([
            'name' => $permission['name'],
            'resource_name' => $permission['resource_name']
        ])->first();
        return $permission != null;
    }
}
