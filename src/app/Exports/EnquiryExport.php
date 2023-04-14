<?php

namespace App\Exports;

use App\Modules\Enquiries\Models\Enquiry;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EnquiryExport implements FromCollection,WithHeadings,WithMapping
{

    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array{
        return[
            'id',
            'name',
            'email',
            'phone',
            'page url',
            'created_at',
        ];
    }
    public function map($data): array
    {
         return[
            $data->id,
            $data->name,
            $data->email,
            $data->phone,
            $data->page_url,
            $data->created_at,
         ];
    }
    public function collection()
    {
        return Enquiry::all();
    }
}
