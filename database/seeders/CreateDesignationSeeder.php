<?php

namespace Database\Seeders;

use App\Models\Designation;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CreateDesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Designation::create([
            'name' => 'Admin', 
            'description' => 'description',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_by' => 1,
        ]);
    }
}
