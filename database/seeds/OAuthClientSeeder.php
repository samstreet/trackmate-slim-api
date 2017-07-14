<?php

use Illuminate\Database\Seeder;

/**
 * @author Sam Street
 */
class OAuthClientSeeder extends Seeder
{
    public function run()
    {
        DB::table('oauth_clients')->truncate();
        
        for ($i = 0; $i < 10; $i++) {
            DB::table('oauth_clients')->insert(
                [
                     'id' => "id$i",
                     'secret' => "secret$i",
                     'name' => "Test Client $i"
                 ]
            );
        }
    }
}