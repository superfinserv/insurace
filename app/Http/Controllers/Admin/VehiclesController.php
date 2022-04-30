<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Response;
use View;
use Session; 
use File;
use Auth;
//use App\Utils\AppUtil;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Meng\AsyncSoap\Guzzle\Factory;

use App\Exports\TwExport;  
use App\Exports\CarExport;
use Maatwebsite\Excel\Facades\Excel;

class VehiclesController extends Controller
{
     public function __construct() { 
       // $this->appUtil = $appUtil; 
        $this->middleware('auth');
     }
    
       
    public function exportTw()   {  
        return Excel::download(new TwExport, 'Tw-Vehicles.xlsx');  
    }
    public function exportPvtCar()   {  
        return Excel::download(new CarExport, 'Pvt-Car-Vehicles.xlsx');  
    }
    
    public function index(Request $request){
        $template = ['title' => 'Vehicles::List',"subtitle"=>"Vehicles List","prm"=>$request->param];
       if($request->param=="2w"){
           $template['scripts'] = [asset('admin/js/page/2w-vehicles.js')];  
           $template['subtitle'] = "2w";
       }else if($request->param=="pvt-car"){
            $template['scripts'] = [asset('admin/js/page/pvt-car-vehicles.js')];  
            $template['subtitle'] = "Pvt Car";
       }else{
            $template['scripts'] = [asset('admin/js/page/2w-vehicles.js')];  
            $template['subtitle'] = "2w ";
       }
        return View::make('admin.vehicles.list')->with($template);
    }
    
    
    function dataDATACar(){
        
        $client = new Client([
                'headers' => [ 'Content-Type' => 'application/json','MerchantKey'=>'SUPER FINSERV PRIVATE LIMITED DBG MUM BHANUP','SecretToken'=>'ZUAXaH2CcvguB1m5gWxYjA==']
            ]);
            
            $clientResp = $client->post('https://chpa.heaggregator.com/CPMotorOnline/ChannelPartner/GetMasterData',
                ['body' => '{ 
                      "MasterKey": "MAKE",
                      "AgentCode":"FWD22000",
                      "PolicyType":"All"
                    }']
                                );
                         $result = $clientResp->getBody()->getContents();
                         print_r($result);die;


    }
    
     function dataDATA2w(){
        
        $client = new Client([
                'headers' => [ 'Content-Type' => 'application/json','MerchantKey'=>'SUPER FINSERV PRIVATE LIMITED','SecretToken'=>'7+aEy4DrMHumytddFoJbzg==']
            ]);
            
            $clientResp = $client->post('https://chpa.heaggregator.com/CPTWOnline/ChannelPartner/GetMasterData',
                ['body' => '{ 
                      "MasterKey": "MODEL",
                      "AgentCode":"TWD22020",
                      "PolicyType":"All"
                    }']
                                );
                         $result = $clientResp->getBody()->getContents();
                             print_r($result);die;


    }
    
    public function GetvehicleDetailsInfo(Request $request){
      
       $template = ['title' => 'HDFC ERGO Vehicles::List',"subtitle"=>"Model List", "prm"=>$request->param];
       $template['scripts'] = [asset('admin/js/page/hdfc-vehicles-model.js')];  
       return View::make('admin.vehicles.get-vehicle-info')->with($template);
    }
    
  //  public function PostvehicleDetailsInfo
    
     public function hdfcModelData(Request $request){
        $template = ['title' => 'HDFC ERGO Vehicles::List',"subtitle"=>"Model List", "prm"=>$request->param];
        if($request->param=="2w"){
          $template['subtitle'] = "2w";
       }else if($request->param=="pvt-car"){
           $template['subtitle'] = "Pvt Car";
       }else{
            $template['subtitle'] = "2w ";
       }
        
       $template['scripts'] = [asset('admin/js/page/hdfc-vehicles-model.js')];  
       return View::make('admin.vehicles.hdfcModels')->with($template);
    }
    
   
    
    public function getTwoVehiclesdatatable(Request $request){
       //$whr = array();$like=array();$or_like=array();$likeArr=array(); 
        $columns =array(0 =>'vehicle_make_tw.make', 
                        1 =>'vehicle_modal_tw.modal',
                        2 =>'vehicle_variant_tw.variant',
                        3=>'vehicle_variant_tw.cubic_capacity',
                        5=>'vehicle_make_tw.digit_code',
                        6=>'vehicle_variant_tw.fgi_code',
                        7=>'vehicle_variant_tw.hdfcErgo_code',
                        8=>'vehicle_make_tw.hdfcErgo_makeCode'); 
        $limit = $request->length;
        $start = $request->start;
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        
        $MakeName    = ($request->input('columns.0.search.value'))?:"";
        $ModelName   = ($request->input('columns.1.search.value'))?:"";
        $VarientName = ($request->input('columns.2.search.value'))?:"";
        $vehicleCode = ($request->input('columns.3.search.value'))?:"";
        $vehicleCC = ($request->input('columns.4.search.value'))?:"";
       // DB::enableQueryLog();
        $query = DB::query();
        $query = DB::table('vehicle_variant_tw')->join('vehicle_modal_tw', 'vehicle_modal_tw.id', '=', 'vehicle_variant_tw.modal_id')
                                             ->join('vehicle_make_tw', 'vehicle_make_tw.id', '=', 'vehicle_variant_tw.make_id');
        $query->select('vehicle_variant_tw.*','vehicle_make_tw.make as make_name','vehicle_make_tw.hdfcErgo_makeCode as hdfcErgo_makeCode','vehicle_modal_tw.modal as modal_name')
                ->when($vehicleCode, function ($query, $vehicleCode) {
                    return $query->where('vehicle_variant_tw.digit_code','like', '%'.$vehicleCode.'%')
                                 ->orwhere('vehicle_variant_tw.fgi_code','like', '%'.$vehicleCode.'%')
                                 ->orwhere('vehicle_variant_tw.hdfcErgo_code','like', '%'.$vehicleCode.'%');
                })
               ->when($VarientName, function ($query, $variantName) {
                    return $query->where('vehicle_variant_tw.variant','like', '%'.$variantName.'%');
                })
               ->when($ModelName, function ($query, $ModelName) {
                    return $query->where('vehicle_modal_tw.modal','like', '%'.$ModelName.'%');
                })
                 ->when($MakeName, function ($query, $MakeName) {
                    return $query->where('vehicle_make_tw.make','like', '%'.$MakeName.'%');
                })
                 ->when($vehicleCC, function ($query, $vehicleCC) {
                    return $query->where('vehicle_variant_tw.cubic_capacity','like', '%'.$vehicleCC.'%');
                });
              
        $totalFiltered =$query->count();
       // $query->orderBy('id','ASC')
        $vehicles =  $query->orderBy($order, $dir)
            ->offset($start)
            ->limit($limit)->get();
           
        $totalRecords =  DB::table('vehicle_variant_tw')->count();
        $result=[];$i=($start+1);
         foreach($vehicles as $each){
                
                $eachData=array();
                $eachData['sno']          = $i;
                $eachData['make']         = '<a href="'.url('vehicle/view/'.$each->id).'">'.trim($each->make_name).'</a>';
                $eachData['modal']        = trim($each->modal_name);
                $eachData['variant']      = trim($each->variant);    
                 $eachData['cc']          =  '<sapn style="font-size:12px;color:black;">'.$each->cubic_capacity.'</span>';
                $eachData['body_type']    = $each->body_type;
                $eachData['digit_code']   = '<sapn style="font-size:13px;color:black;">'.$each->digit_code.'</span>';
                $eachData['fgi_code']     = '<input data-supp="fgi_code"      class="text-vcode" type="text" data-id="'.$each->id.'" id="fgi_code'.$each->id.'" name="fgi_code'.$each->id.'"   value="'.$each->fgi_code.'">';//$each->fgi_code;
                 $eachData['hdfc_code']   = '<input data-supp="hdfcErgo_code" class="text-vcode" type="text" data-id="'.$each->id.'" id="hdfc_code'.$each->id.'" name="hdfc_code'.$each->id.'" value="'.$each->hdfcErgo_code.'">';//$each->hdfcErgo_code;
                $eachData['make_id']      = $each->make_id;
                $eachData['modal_id']     = $each->modal_id;
                $eachData['varient_id']     = $each->id;
                $eachData['hdfc_make']     = '<sapn style="font-size:12px;color:black;">'.$each->hdfcErgo_makeCode.'</span>';
                
                 $eachData['fullInfo']    = $each;
              //if($this->appUtil->hasPermission('cat_2')){ 
                //$eachData['action']          = $buttons;  
             // }else{
              //  $eachData['action']="";
              //}
                $result[] = $eachData; 
              
             $i++; 
         }
         $json_data = array(
           "draw"            => intval($request->input('draw')),  
           "recordsTotal"    => intval($totalRecords),  
           "recordsFiltered" => intval($totalFiltered),  
           "data"            => $result   
           );
        echo json_encode($json_data); 
   }
   
    public function getPvtCarVehiclesdatatable(Request $request){
       //$whr = array();$like=array();$or_like=array();$likeArr=array(); 
        $columns = array(   0 =>'vehicle_variant_car.make', 
                            1 =>'vehicle_variant_car.modal', 
                            2 =>'vehicle_variant_car.variant',
                            3=>'vehicle_variant_car.cubic_capacity',
                            5=>'vehicle_variant_car.digit_code',
                            6=>'vehicle_variant_car.fgi_code',
                            7=>'vehicle_make_car.hdfcErgo_makeCode',
                            8=>'vehicle_variant_car.hdfcErgo_code'); 
        $limit = $request->length;
        $start = $request->start;
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        
        $MakeName    = ($request->input('columns.0.search.value'))?:"";
        $ModelName   = ($request->input('columns.1.search.value'))?:"";
        $VarientName = ($request->input('columns.2.search.value'))?:"";
        $vehicleCode = ($request->input('columns.3.search.value'))?:"";
        $vehicleCC = ($request->input('columns.4.search.value'))?:"";
       // DB::enableQueryLog();
        $query = DB::query();
        $query = DB::table('vehicle_variant_car')->join('vehicle_modal_car', 'vehicle_modal_car.id', '=', 'vehicle_variant_car.modal_id')
                                             ->join('vehicle_make_car', 'vehicle_make_car.id', '=', 'vehicle_variant_car.make_id');
        $query->select('vehicle_variant_car.*','vehicle_make_car.make as make_name','vehicle_modal_car.modal as modal_name','vehicle_make_car.hdfcErgo_makeCode as hdfcErgo_makeCode')
                ->when($vehicleCode, function ($query, $vehicleCode) {
                    return $query->where('vehicle_variant_car.digit_code','like', '%'.$vehicleCode.'%')
                                 ->orwhere('vehicle_variant_car.fgi_code','like', '%'.$vehicleCode.'%')
                                 ->orwhere('vehicle_variant_car.hdfcErgo_code','like', '%'.$vehicleCode.'%');
                })
               ->when($VarientName, function ($query, $variantName) {
                    return $query->where('vehicle_variant_car.variant','like', '%'.$variantName.'%');
                })
               ->when($ModelName, function ($query, $ModelName) {
                    return $query->where('vehicle_modal_car.modal','like', '%'.$ModelName.'%');
                })
                 ->when($MakeName, function ($query, $MakeName) {
                    return $query->where('vehicle_make_car.make','like', '%'.$MakeName.'%');
                })
                 ->when($vehicleCC, function ($query, $vehicleCC) {
                    return $query->where('vehicle_variant_car.cubic_capacity','like', '%'.$vehicleCC.'%');
                });
              
        $totalFiltered =$query->count();
       // $query->orderBy('id','ASC')
        $vehicles =  $query->orderBy($order, $dir)
            ->offset($start)
            ->limit($limit)->get();
           
        $totalRecords =  DB::table('vehicle_variant_car')->count();
        $result=[];$i=($start+1);
         foreach($vehicles as $each){
                
                $eachData=array();
                $eachData['sno']          = $i;
                $eachData['make']         = '<a href="'.url('vehicle/view/'.$each->id).'">'.trim($each->make_name).'</a>';
                $eachData['modal']        = trim($each->modal_name);
                $eachData['variant']      = trim($each->variant);    
                 $eachData['cc']          =  '<sapn style="font-size:12px;color:black;">'.$each->cubic_capacity.'</span>';
                $eachData['body_type']    = $each->body_type;
                $eachData['digit_code']   = '<sapn style="font-size:13px;color:black;">'.$each->digit_code.'</span>';
                $eachData['fgi_code']     = '<input data-supp="fgi_code"      class="text-vcode" type="text" data-id="'.$each->id.'" id="fgi_code'.$each->id.'" name="fgi_code'.$each->id.'"   value="'.$each->fgi_code.'">';//$each->fgi_code;
                 $eachData['hdfc_code']   = '<input data-supp="hdfcErgo_code" class="text-vcode" type="text" data-id="'.$each->id.'" id="hdfc_code'.$each->id.'" name="hdfc_code'.$each->id.'" value="'.$each->hdfcErgo_code.'">';//$each->hdfcErgo_code;
                $eachData['make_id']      = $each->make_id;
                $eachData['modal_id']     = $each->modal_id;
                $eachData['varient_id']     = $each->id;
                $eachData['hdfc_make']     = '<sapn style="font-size:12px;color:black;">'.$each->hdfcErgo_makeCode.'</span>';
                 $eachData['fullInfo']    = $each;
              //if($this->appUtil->hasPermission('cat_2')){ 
                //$eachData['action']          = $buttons;  
             // }else{
              //  $eachData['action']="";
              //}
                $result[] = $eachData; 
              
             $i++; 
         }
         $json_data = array(
           "draw"            => intval($request->input('draw')),  
           "recordsTotal"    => intval($totalRecords),  
           "recordsFiltered" => intval($totalFiltered),  
           "data"            => $result   
           );
        echo json_encode($json_data); 
   }
   
    public function updateVcode(Request $request){
        if($request->param=='2w'){
          $var = DB::table('vehicle_variant_tw')->where('id',$request->id)->update([$request->column=>$request->val]);
          return Response::json(array('status'=>'success'));
        }else{
            $var = DB::table('vehicle_variant_car')->where('id',$request->id)->update([$request->column=>$request->val]);
            return Response::json(array('status'=>'success'));
        }
    }
    
    
    
    
  
    
    
   
    
}
 

