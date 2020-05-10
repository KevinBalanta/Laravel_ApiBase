<?php

use Illuminate\Database\Seeder;
use App\Models\Profile;
use App\User;
use App\Estate;
use App\IrrigationSystem;
use App\WaterSourceType;
use App\DropperType;
use App\SurcosSeparation;
use App\IrrigationStrategy;
use App\Action;

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
        $profileAdmin = Profile::create(['name'=>'Administrador']);
        //perfil de usuario general
        $profileGeneral = Profile::create(['name'=>'General']);

        //Se crea el primer usuario
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => '5ebe2294ecd0e0f08eab7690d2a6ee69', //secret,
            'profile_id' => $profileAdmin->id
        ]);




            //usuarios de prueba solamente
       $user1 =  User::create([
            'name' => 'User1',
            'email' => 'user1@correo.com',
            'password' => '5ebe2294ecd0e0f08eab7690d2a6ee69', //secret,
            'profile_id' => $profileGeneral->id
        ]);

        $user2 = User::create([
            'name' => 'User2',
            'email' => 'user2@correo.com',
            'password' => '5ebe2294ecd0e0f08eab7690d2a6ee69', //secret,
            'profile_id' => $profileGeneral->id
        ]);

        $user3 = User::create([
            'name' => 'User3',
            'email' => 'user3@correo.com',
            'password' => '5ebe2294ecd0e0f08eab7690d2a6ee69', //secret,
            'profile_id' => $profileGeneral->id
        ]);

        // haciendas de prueba 
        
        Estate::create([
            'name' => 'Hacienda A',
            'user_id' =>  $user1->id
        ]);

        Estate::create([
            'name' => 'Hacienda B',
            'user_id' =>  $user1->id
        ]);

        Estate::create([
            'name' => 'Hacienda C',
            'user_id' =>  $user1->id
        ]);

        Estate::create([
            'name' => 'Hacienda Uno',
            'user_id' =>  $user2->id
        ]);

        Estate::create([
            'name' => 'Hacienda Dos',
            'user_id' =>  $user2->id
        ]);

        Estate::create([
            'name' => 'Hacienda ColombiaCaña',
            'user_id' =>  $user3->id
        ]);

        // creación de los tipos de sistema de riego

        IrrigationSystem::create([
            'name' => 'Goteo'
        ]);

        IrrigationSystem::create([
            'name' => 'Aspersión'
        ]);

        // creación de los tipos de fuente

        WaterSourceType::create([
            'name' => 'Rio'
        ]);

        WaterSourceType::create([
            'name' => 'Pozo'
        ]);

        WaterSourceType::create([
            'name' => 'Reservorio'
        ]);

        // creación de los tipos de gotero

        DropperType::create([
            'name' => 'Tipo A'
        ]);

        DropperType::create([
            'name' => 'Tipo B'
        ]);

        DropperType::create([
            'name' => 'Tipo C'
        ]);

        // creación de la separación entre surcos (mts)

        SurcosSeparation::create([
            'value' => 1.5
        ]);

        SurcosSeparation::create([
            'value' => 1.65
        ]);

        SurcosSeparation::create([
            'value' => 1.75
        ]);

        SurcosSeparation::create([
            'value' => 1.8
        ]);

        // creación de la estrategia de riego

        IrrigationStrategy::create([
            'name' => 'Tiempo'
        ]);

        IrrigationStrategy::create([
            'name' => 'Tensión'
        ]);

        // creación de las acciónes sobre los módulos de riego por goteo

        Action::create([
            'value' => 'Abrir'
        ]);

        Action::create([
            'value' => 'Cerrar'
        ]);

        Action::create([
            'value' => 'Nada'
        ]);
        


    
    }
}
