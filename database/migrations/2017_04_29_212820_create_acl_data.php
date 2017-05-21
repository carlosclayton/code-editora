<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use CodeEduUser\Models\Role;
use CodeEduUser\Models\User;

class CreateAclData extends Migration
{


    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $roleAdmin = Role::create([
            'name' => config('codeeduuser.acl.role_admin'),
            'description' => config('codeeduuser.acl.role_description')
        ]);

        $user = User::where('email', config('codeeduuser.user_default.email'))->first();
        $user->roles()->save($roleAdmin);
        //$roleAdmin->permissions()->attach(1);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $roleAdmin = Role::where('name', config('codeeduuser.acl.role_admin'))->first();
        $user = User::where('email', config('codeeduuser.user_default.email'))->first();
        $user->roles()->detach($roleAdmin->id);
        $roleAdmin->permissions()->detach();
        $roleAdmin->users()->detach();


        $roleAdmin->delete();
    }
}
