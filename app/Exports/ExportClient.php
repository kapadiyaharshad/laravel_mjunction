<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use DB;

class ExportClient implements FromCollection,WithHeadings,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $type = DB::table('clients')->select('clientname','email','mobilenum','account_type','payercode','profit_center','category','key','business_segment','business_unit','services','account_manager','status')->get();
        return $type ;
    }

    public function headings(): array
    {
        return [
            'Client Name',
            'Email',
            'Mobile Number',
            'Account Type',
            'Payer Code',
            'Profit Center',
            'Category',
            'Key',
            'Business Segment',
            'Business Unit',
            'Services',
            'Account Manager',
            'Status'
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A1:M1')
                                ->getFont()
                                ->setBold(true);
            },
        ];
    }

}
