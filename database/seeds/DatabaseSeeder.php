<?php

use Illuminate\Database\Seeder;
use Trackmate\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        User::truncate();
        factory(User::class, 10)->create();
        $this->call('OAuthClientSeeder');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
