<?php

use Illuminate\Database\Seeder;
use CodeEduUser\Models\Role;
use CodeEduUser\Models\Permission;

class AclSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $permissionsUser = Permission::where('name', 'like', 'user%')->pluck('id')->all();
        $permissionsRole = Permission::where('name', 'like', 'role%')->pluck('id')->all();
        $permissionsBook = Permission::where('name', 'like', 'book%')->pluck('id')->all();
        $permissionsChapter = Permission::where('name', 'like', 'chapter%')->pluck('id')->all();
        $permissionsCategory = Permission::where('name', 'like', 'category%')->pluck('id')->all();

        //Permissions of Admin
        $roleAdmin = Role::where('name', config('codeeduuser.acl.role_admin'))->first();
        $roleAdmin->permissions()->attach($permissionsUser);
        $roleAdmin->permissions()->attach($permissionsRole);
        $roleAdmin->permissions()->attach($permissionsBook);
        $roleAdmin->permissions()->attach($permissionsCategory);
        $roleAdmin->permissions()->attach($permissionsChapter);

        //Permissions of author
        $roleAuthor = Role::where('name', config('codeedubook.acl.role_author'))->first();
        $roleAuthor->permissions()->attach($permissionsBook);
        $roleAuthor->permissions()->attach($permissionsCategory);
        $roleAuthor->permissions()->attach($permissionsChapter);

    }
}
