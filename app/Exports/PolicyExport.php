<?php

namespace App\Exports;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class PolicyExport implements FromCollection, WithCustomCsvSettings, WithHeadings, WithEvents, WithStyles,WithColumnWidths
{
    
        protected $from_date;
        protected $to_date;
        protected $type;
        protected $partner;
    
        function __construct($from_date,$to_date,$type,$partner) {
                $this->from_date = $from_date;
                $this->to_date = $to_date;
                $this->type = $type;
                $this->partner = $partner;
        }
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
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
                'B' => 6,  
                'C' => 7,  
                'D' => 20,  
                'E' => 12,  
                'F' => 30,  
                'G' => 30,  
                'H' => 20,  
                'I' => 20,
                'J' => 15,  
                'K' => 10,  
                'L' => 13,  
                'M' => 18,  
                'N' => 20,  
                'O' => 10,  
                'P' => 20,  
                'R' => 20,  
                'S' => 20,
                'T' => 20,
                'U' => 20,
                'V' => 20,
                'W' => 20,
                'X' => 20,
                'Y' => 20,
                'Z' => 20,
                'AC' => 20,
                'AB' => 20,
                'AC' => 20,
                
        ];
        
    }
    public function headings(): array
    {
        return ["LOGIN DATE", "MONTH",'YEAR','CUSTOMER NAME','CONTACT NO','EMAIL ID','ADDRESS','CITY','STATE','POLICY NO','START DATE','END DATE','REGISTRATION NO',
                'VEHICLE TYPE','VEHICLE MAKE','VEHICLE MODEL','FUEL','I COMPANY','INSURANCE TYPE','IDV','OD PREMIUM','TP PREMIUM','PA COVER','Total Premium',
                'GST','Premium with GST','POSP','SP'];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {  
        $from_date = $this->from_date;
        $to_date = $this->to_date;
        $type =  $this->type;
        $partner =  $this->partner;
    
        return DB::table('policy_saled')->select(DB::raw("DATE_FORMAT(date, '%d/%m/%Y') as formatted_dob"),
                             DB::raw('MONTH(date) as month'),DB::raw('YEAR(date) as year'),'customer_name','mobile_no',
                             DB::raw('(CASE WHEN type = "HEALTH" THEN params->>"$.selfEmail"
                                            WHEN type = "CAR" THEN params->>"$.customer.email"
                                            WHEN type = "BIKE" THEN params->>"$.customer.email" 
                                            ELSE "NA" END) as email'),
                             DB::raw('(CASE WHEN type = "HEALTH" THEN CONCAT(params->>"$.address.house_no",params->>"$.address.street")
                                            WHEN type = "CAR" THEN CONCAT(params->>"$.address.addressLineOne",params->>"$.address.addressLineTwo")
                                            WHEN type = "BIKE" THEN CONCAT(params->>"$.address.addressLineOne",params->>"$.address.addressLineTwo")
                                            ELSE "NA" END)'),
                             DB::raw('(CASE WHEN type = "HEALTH" THEN SUBSTRING_INDEX(params->>"$.city", "-", -1)
                                            WHEN type = "CAR" THEN SUBSTRING_INDEX(params->>"$.address.city", "-", -1)
                                            WHEN type = "BIKE" THEN SUBSTRING_INDEX(params->>"$.address.city", "-", -1)
                                            ELSE "NA" END)'),
                             DB::raw('(CASE WHEN type = "HEALTH" THEN SUBSTRING_INDEX(params->>"$.state", "-", -1)
                                            WHEN type = "CAR" THEN SUBSTRING_INDEX(params->>"$.address.state", "-", -1)
                                            WHEN type = "BIKE" THEN SUBSTRING_INDEX(params->>"$.address.state", "-", -1)
                                            ELSE "NA" END)'),
                            'policy_no','startDate','endDate',
                             DB::raw('(CASE WHEN type = "CAR" THEN params->>"$.vehicle.vehicleNumber"
                                            WHEN type = "BIKE" THEN params->>"$.vehicle.vehicleNumber"
                                            ELSE "NA" END)'),
                             DB::raw('(CASE WHEN type = "CAR" THEN  "PRIVATE CAR"
                                            WHEN type = "BIKE" THEN "TWO WHEELER"
                                            ELSE "NA" END)'),
                             DB::raw('(CASE WHEN type = "CAR" THEN params->>"$.vehicle.brand.name"
                                            WHEN type = "BIKE" THEN params->>"$.vehicle.brand.name"
                                            ELSE "NA" END)'),
                             DB::raw('(CASE WHEN type = "CAR" THEN params->>"$.vehicle.model.name"
                                            WHEN type = "BIKE" THEN params->>"$.vehicle.model.name"
                                            ELSE "NA" END)'),
                             DB::raw('(CASE WHEN type = "CAR" THEN params->>"$.vehicle.fueltype"
                                            WHEN type = "BIKE" THEN params->>"$.vehicle.fueltype"
                                            ELSE "NA" END)'),
                             'provider',
                             DB::raw('(CASE WHEN policyType = "IN" THEN "INDIVIDUAL"
                                            WHEN policyType = "FL" THEN "FAMILY FLOATER"
                                            WHEN policyType = "COM" THEN "COMPREHANSIVE"
                                            WHEN policyType = "TP" THEN "THIRD PARTY"
                                            WHEN policyType = "SAOD" THEN "STANDALONE OWN DAMAGE"
                                            ELSE "NA" END)'),
                             DB::raw('(CASE WHEN type = "CAR" THEN json_data->>"$.vehicle.idv"
                                            WHEN type = "BIKE" THEN json_data->>"$.vehicle.idv"
                                            ELSE 0 END)'),
                             DB::raw('(CASE WHEN type = "CAR" THEN json_data->>"$.covers.od.grossAmt"
                                            WHEN type = "BIKE" THEN json_data->>"$.covers.od.grossAmt"
                                            ELSE 0 END)'),
                             DB::raw('(CASE WHEN type = "CAR" THEN json_data->>"$.covers.tp.grossAmt"
                                            WHEN type = "BIKE" THEN json_data->>"$.covers.tp.grossAmt"
                                            ELSE 0 END)'), 
                             DB::raw('(CASE  WHEN type = "CAR" THEN (CASE WHEN params->>"$.subcovers.isPA_OwnerDriverCover" = "true" THEN "YES" ELSE "NO" END)
                                             WHEN type = "BIKE" THEN (CASE WHEN params->>"$.subcovers.isPA_OwnerDriverCover" = "true" THEN "YES" ELSE "NO" END)
                                             ELSE "NA" END)'),
                             
                             DB::raw('(CASE WHEN type = "CAR" THEN json_data->>"$.net"
                                            WHEN type = "BIKE" THEN json_data->>"$.net"
                                            ELSE 0 END)'), 
                            DB::raw('(CASE WHEN type = "CAR" THEN json_data->>"$.tax"
                                            WHEN type = "BIKE" THEN json_data->>"$.tax"
                                            ELSE 0 END)'), 
                               'amount','agent_id','sp_id'
                               )
                                ->when($from_date,function ($query) use ($from_date,$to_date) {
                                    $query->whereBetween('date',[$from_date,$to_date]);
                                })
                                ->when($type, function ($query,$type) {
                                    if($type=="HEALTH"){
                                       $query->where('type', $type);
                                    }else{
                                         $query->whereIn('type', ['CAR','BIKE']);
                                    }
                                })
                                ->when($partner, function ($query,$partner) {
                                    $query->where('provider', $partner);
                                })
                               ->get();
    }
    
    /**

     * Write code on Method

     *

     * @return response()

     */
     
        public function registerEvents(): array{
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A1:AC1')
                        ->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()
                        ->setARGB('FFC0C0C0');
            },
        ];
    }
    
    

   
} 