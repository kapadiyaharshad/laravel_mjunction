<?php

namespace Database\Seeders;

use App\Models\BusinessUnit;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CreateBusinessUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BusinessUnit::create([
            'bu_name' => 'Admin', 
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_by' => 1,
        ]);
    }
}
