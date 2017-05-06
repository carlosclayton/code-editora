<?php

namespace CodeEduUser\Annotations;

use CodeEduUser\Annotations\Mapping\ControllerAnnotation;
use Doctrine\Common\Annotations\Reader;
use CodeEduUser\Annotations\Mapping\ActionAnnotation;

class PermissionReader
{

    /**
     * @var Reader
     */
    private $reader;

    /**
     * PermissionReader constructor.
     * @param $reader
     */
    public function __construct(Reader $reader)
    {
        $this->reader = $reader;
    }


    public function getPermissions()
    {
        $controllerClasses = $this->getControllers();
        //dd($controllerClasses);
        $declared = get_declared_classes();
        $permissions = [];

        foreach ($declared as $className) {
            $rc = new \ReflectionClass($className);
            if (in_array($rc->getFileName(), $controllerClasses)) {
                $permission = $this->getPermission($className);
                if (count($permission)) {
                    $permissions = array_merge($permissions, $permission);
                }
            }
        }
        return $permissions;
    }

    public function getPermission($controllerClass, $action = null)
    {
        $rc = new \ReflectionClass($controllerClass);

        $controllerAnnotation = $this->reader->getClassAnnotation($rc, ControllerAnnotation::class);
        $permissions = [];
        if ($controllerAnnotation) {
            $permission = [
                'name' => $controllerAnnotation->name,
                'description' => $controllerAnnotation->description
            ];


            $rcMethods = $rc->getMethods();

            $rcMethods = !$action ? $rc->getMethods() : [$rc->getMethod($action)];
            foreach ($rcMethods as $rcMethod) {

                $actionAnnotation = $this->reader->getMethodAnnotation($rcMethod, ActionAnnotation::class);

                if ($actionAnnotation) {
                    $permission['resource_name'] = $actionAnnotation->name;
                    $permission['resource_description'] = $actionAnnotation->description;
                    $permissions[] = (new \ArrayIterator($permission))->getArrayCopy();
                }
            }
        }
        return $permissions;
    }

    private function getControllers()
    {
        $dir = __DIR__ . config('codeeduuser.acl.controllers_annotations');
        $files = [];
        foreach (\File::allFiles($dir) as $file) {
            $files[] = $file->getRealPath();
            require_once $file->getRealPath();
        }

        return $files;
    }

}