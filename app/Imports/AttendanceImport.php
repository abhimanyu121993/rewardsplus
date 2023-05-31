<?php

namespace App\Imports;

use App\Models\Attendance;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class AttendanceImport implements FromCollection, WithMapping, WithHeadings,WithStyles,WithEvents 
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public $data;
    public function __construct($data)
    {
        $this->data=$data;
    }

    public function collection()
    {
        return collect($this->data);
    }

    public function map($row): array
    {
        return [
            $row->employee->uniqid,
            $row->employee->name,
            Carbon::parse($row->date)->format('d-M-Y'),
            $row->clock_in,
            $row->clock_out,
            $row->status
        ];
    }
    public function headings(): array
    {
        return [
            'Employee Code',
            'Employee Name',
            'Date',
            'Clock In',
            'Clock Out',
            'Status'
            // Add more headings as needed
        ];
    }
    public function styles(Worksheet $sheet)
    {
        return [
            // Style for the heading row
            1 => ['font' => ['bold' => true, 'size' => 14]],
        ];
    }

    public function registerEvents(): array
    {
        
        return [
            
            AfterSheet::class => function (AfterSheet $event) {
                $highestRow = $event->sheet->getHighestRow();
                $event->sheet->getStyle('A1:Z1')->applyFromArray([
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'color' => ['rgb' => '5c61f2'], // Change the color code as desired
                    ],
                    'font' => [
                        'color' => ['rgb' => 'FFFFFF'], // Set the text color to white
                    ],
                ]);
            },
        ];
    }
}
