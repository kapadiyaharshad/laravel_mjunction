<?php

namespace App\Imports;

use App\Models\Client;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Throwable;

class ImportClient implements ToModel,WithHeadingRow,SkipsOnError
{
    public function model(array $row)
    {
        return new Client([
            'clientname'     => $row['client_name'],
            'email'    => $row['email'],
            'mobilenum'    => $row['mobile_number'],
            'account_type'    => $row['account_type'],
            'payercode'    => $row['payer_code'],
            'profit_center'    => $row['profit_center'],
            'category'    => $row['category'],
            // 'key'    => $row['key'],
            'business_segment'    => $row['business_segment'],
            'business_unit'    => $row['business_unit'],
            'services'    => $row['services'],
            'account_manager'    => $row['account_manager'],
            'status'    => $row['status'],
        ]);
    }
    public function onError(Throwable $error){

    }
}
