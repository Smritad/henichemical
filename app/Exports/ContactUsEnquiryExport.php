<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class ContactUsEnquiryExport implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        $filteredData = collect([]);

        foreach ($this->data as $index => $item) {
            $filteredData->push([
                'Sr No.' => $index + 1,
                'Name' => $item->name,
                'Email' => $item->email,
                'Mobile No.' => $item->mobile_no,
                'Subject' => $item->subject,
                'Message' => $item->user_message,
                'Date' => date('d-m-Y', strtotime($item->created_at)),
            ]);
        }

        return $filteredData;
    }

    public function headings(): array
    {
        return [
            'Sr No.',
            'Name',
            'Email',
            'Mobile No.',
            'Subject',
            'Message',
            'Date',
        ];
    }
}
