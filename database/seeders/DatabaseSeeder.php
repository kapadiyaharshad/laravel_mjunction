<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();
        $this->call([
            CreateAccountTypesSeeder::class,
            CreateBusinessUnitSeeder::class,
            CreateCategorySeeder::class,
            CreateDesignationSeeder::class,
            CreateAdminUserSeeder::class,
            CreatePayerCodeSeeder::class,
            CreateProfitCenterSeeder::class
        ]);
    
    }
}
