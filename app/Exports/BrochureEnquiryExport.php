<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class BrochureEnquiryExport implements FromCollection, WithHeadings
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
                'Brochure Name' => $item->title,
                'Email' => $item->email,
                'Mobile No.' => $item->mobile_no,
                'Date' => date('d-m-Y', strtotime($item->created_at)),
            ]);
        }

        return $filteredData;
    }

    public function headings(): array
    {
        return [
            'Sr No.',
            'Brochure Name',
            'Email',
            'Mobile No.',
            'Date',
        ];
    }
}
