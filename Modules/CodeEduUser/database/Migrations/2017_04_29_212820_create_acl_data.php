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
            'description' => 'User administrator'
        ]);

        $user = User::where('email', config('codeeduuser.user_dafault.email'))->first();
        $user->roles()->save($roleAdmin);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $roleAdmin = Role::where('name', 'Admin')->first();
        $user = User::where('email', config('codeeduuser.user_dafault.email'))->first();
        $user->roles()->detach($roleAdmin->id);

        $roleAdmin->delete();
    }
}
