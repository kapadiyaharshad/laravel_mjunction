<?php

namespace Database\Seeders;

use App\Models\PayerCode;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CreatePayerCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PayerCode::create([
            'client_id' => '1', 
            'payer_code' => '1234',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_by' => 1,
        ]);
    }
}
