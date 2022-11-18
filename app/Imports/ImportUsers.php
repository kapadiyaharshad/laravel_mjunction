<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Throwable;

class ImportUsers implements ToModel,WithHeadingRow,SkipsOnError
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new User([
            'name'     => $row['name'],
            'email'    => $row['email'],
            'password'    => $row['password'],
            'mobile_number'    => $row['mobile_number'],
            'role'    => $row['role'],
            'accounttype'    => $row['role'].'-'.$row['account_type'],
            'bu'    => $row['business_unit'],
            'status'    => $row['status'],
            'username'    => $row['name'],
        ]);
    }

    public function onError(Throwable $error){

    }
}
