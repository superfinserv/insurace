<?php

namespace App\Exports;

use App\Model\Agents;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class PospExport implements FromCollection, WithCustomCsvSettings, WithHeadings, WithEvents, WithStyles,WithColumnWidths
{
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }

    public function headings(): array
    {
        return ["POSP ID", "Name",'Email','Mobile','Gender','PAN No','Aadhar No','Address','City','State','Pincode','Marital Status',
                'Education','Bank Name','Account No','IFSC','Varified Satus','Tranning Status','Payment Status'];
    }
    
    public function styles(Worksheet $sheet){
        return [
           // Style the first row as bold text.
           1    => ['font' => ['bold' => true]],
        ];
    }
    
    public function columnWidths(): array{
        return [
                'A' => 15,
                'B' => 20,  
                'C' => 30,  
                'D' => 15,  
                'E' => 10,  
                'F' => 20,  
                'G' => 25,  
                'H' => 20,  
                'I' => 15,
                'J' => 15,  
                'K' => 10,  
                'L' => 13,  
                'M' => 18,  
                'N' => 20,  
                'O' => 10,  
                'P' => 20,  
                'R' => 20,  
                'S' => 20,
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    { 
       return Agents::select('posp_ID','name','email','mobile','sex','pan_card_number','adhaar_card_number','address','city','state','pincode',
                             'marital_status','educational_qualification','bank_name','account_number','ifsc_code',
                             DB::raw('(CASE WHEN isVerified = 1 THEN "verified" ELSE "Not verified" END)'),
                             DB::raw('(CASE WHEN is_tranning_complete = "Yes" THEN "Completed" ELSE "Not Completed" END)'),
                             DB::raw('(CASE WHEN is_tranning_complete = 1 THEN "Paid" ELSE "Pending" END)')
                             )->get();
    }
    
     public function registerEvents(): array{
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A1:S1')
                        ->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()
                        ->setARGB('FFC0C0C0');
            },
        ];
    }
} 