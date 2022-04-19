<?php

namespace App\Exports;

use App\Model\CarMake;
use App\Model\CarModal;
use App\Model\CarVariant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CarExport implements FromCollection, WithCustomCsvSettings, WithHeadings
{
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }

    public function headings(): array
    {
        return ["Make", "Model",'Variant','Digit Code','HDFC-ERGO Code','FGI Code','cc','Fuel','Seating'];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return CarVariant::select('vehicle_make_car.make as make_name','vehicle_modal_car.modal as modal_name','vehicle_variant_car.variant'
                                 ,'vehicle_variant_car.digit_code','vehicle_variant_car.hdfcErgo_code','vehicle_variant_car.fgi_code'
                                 ,'vehicle_variant_car.cubic_capacity','vehicle_variant_car.fuel_type','vehicle_variant_car.seating_capacity')
                          ->join('vehicle_modal_car', 'vehicle_modal_car.id', '=', 'vehicle_variant_car.modal_id')
                          ->join('vehicle_make_car', 'vehicle_make_car.id', '=', 'vehicle_variant_car.make_id')->get();
    }
} 