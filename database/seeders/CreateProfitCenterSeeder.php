<?php

namespace Database\Seeders;

use App\Models\ProfitCenter;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CreateProfitCenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProfitCenter::create([
            'business_unit_id' => '1', 
            'profit_center' => '1234',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_by' => 1,
        ]);
    }
}
