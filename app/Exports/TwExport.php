<?php

namespace App\Exports;

use App\Model\TwMake;
use App\Model\TwModal;
use App\Model\TwVariant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TwExport implements FromCollection, WithCustomCsvSettings, WithHeadings
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
        return TwVariant::select('vehicle_make_tw.make as make_name','vehicle_modal_tw.modal as modal_name','vehicle_variant_tw.variant'
                                 ,'vehicle_variant_tw.digit_code','vehicle_variant_tw.hdfcErgo_code','vehicle_variant_tw.fgi_code'
                                 ,'vehicle_variant_tw.cubic_capacity','vehicle_variant_tw.fuel_type','vehicle_variant_tw.seating_capacity')
                          ->join('vehicle_modal_tw', 'vehicle_modal_tw.id', '=', 'vehicle_variant_tw.modal_id')
                          ->join('vehicle_make_tw', 'vehicle_make_tw.id', '=', 'vehicle_variant_tw.make_id')->get();
    }
} 