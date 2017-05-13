<?php

namespace CodeEduUser\Providers;

use CodeEduUser\Criteria\FindPermissionsResourceCriteria;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use CodeEduUser\Repositories\PermissionRepository;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'CodeEditora\Model' => 'CodeEditora\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        if (!app()->runningInConsole() || app()->runningUnitTests()) {

            $permissionRepository = app(PermissionRepository::class);
            $permissionRepository->pushCriteria(new FindPermissionsResourceCriteria());
            $permissions = $permissionRepository->all();

            foreach ($permissions as $p) {
                //dd("{$p->name}/{$p->resource_name}");

                \Gate::define("{$p->name}/{$p->resource_name}", function ($user) use ($p) {
                    //dd($p->roles);
                    return $user->hasRole($p->roles);
                });
            }
        }


        \Gate::define('user-admin', function ($user) {
            return $user->isAdmin();
        });
    }
}
