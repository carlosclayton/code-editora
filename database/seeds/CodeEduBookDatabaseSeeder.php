<?php


use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CodeEduBookDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->command->info("Seed executada");
        // $this->call("OthersTableSeeder");
    }
}
