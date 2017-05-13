<?php

namespace CodeEduUser\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class AuthorizationResource
{

    /*
    private $reader;
    public function __construct(PermissionReader $reader)
    {
        $this->reader = $reader;
    }
    */

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        $currentAction = \Route::currentRouteAction();
        list($controller, $action) = explode('@', $currentAction);
        $permission = \PermissionReader::getPermission($controller, $action);
        if(count($permission)){
            $permission = $permission[0];

            if(!\Gate::allows("{$permission['name']}/{$permission['resource_name']}")){
                throw new AuthorizationException('Access denied');
            }
        }
        return $next($request);
    }
}
