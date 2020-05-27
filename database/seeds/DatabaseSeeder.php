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
        $this->call(TipoDocumentoTableSeeder::class);
        $this->call(EmpleadoSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ClienteSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(ProductoSeeder::class);

    }
}
