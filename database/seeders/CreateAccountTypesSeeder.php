<?php

namespace Database\Seeders;

use App\Models\AccountType;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CreateAccountTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AccountType::create([
            'name' => 'Admin', 
            'code' => '1234',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_by' => 1,
        ]);
    }
}
