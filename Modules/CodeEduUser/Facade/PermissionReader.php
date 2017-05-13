<?php

namespace CodeEduUser\Facade;

use Illuminate\Support\Facades\Facade;
use CodeEduUser\Annotations\PermissionReader as PermissionsReaderService;

class PermissionReader extends Facade
{

    /**
     * @return mixed
     */
    protected static function getFacadeAccessor() {
        return PermissionsReaderService::class;
    }

}