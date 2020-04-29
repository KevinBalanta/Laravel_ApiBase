<?php

use Illuminate\Database\Seeder;
use App\Models\Profile;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // $this->call(UsersTableSeeder::class);
        //Se crea el perfil administrador
        $profile = Profile::create(['name'=>'Administrador']);
        //Se crea el primer usuario
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => '5ebe2294ecd0e0f08eab7690d2a6ee69', //secret,
            'profile_id' => $profile->id
        ]);
        
    
    }
}
