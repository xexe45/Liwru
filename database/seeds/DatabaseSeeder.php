<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Storage::deleteDirectory('public/library');
        Storage::makeDirectory('public/library');

        //Storage::deleteDirectory('public/users');
        //Storage::makeDirectory('public/users');

        factory(\App\Role::class,1)->create(['name' => 'administrador', 'description' => 'Acceso a todos los módulos del sistema']);
        factory(\App\Role::class,1)->create(['name' => 'lector','description' => 'Acceso a solo algunos los módulos del sistema']);
        factory(\App\Country::class, 1)->create(['name' => 'Perú']);
        factory(\App\Department::class, 1)->create(['name' => 'Piura']);
        factory(\App\Province::class, 1)->create(['name' => 'Piura']);
        factory(\App\User::class,1)->create(
            [
                'name' => 'admin',
                'slug' => str_slug('admin'),
                'email' => 'admin@gmail.com',
                'phone' => '965088193',
                'password' => bcrypt('secret'),
                'birthday' => '1993-12-14',
                'role_id' => \App\Role::ADMINISTRADOR,
                'picture' => 'user.png'
            ]
        );
        factory(\App\Library::class, 1)->create();
    }
}
