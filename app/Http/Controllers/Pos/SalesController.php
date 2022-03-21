<?php

namespace App\Http\Controllers\Pos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Response;
use View;
use Session; 
use File;
use Illuminate\Support\Facades\Hash;
use App\Model\Agents;
use Illuminate\Support\Facades\Auth;
use App\Resources\DigitCarResource;
use App\Resources\DigitResource;
use App\Resources\DigitBikeResource;
use App\Resources\CareResource;


class SalesController extends Controller{
    //  public function __construct() { 
    //     //$this->middleware('auth');
    //  }
    public function __construct(DigitResource $DigitResource,DigitCarResource $DigitCarResource,DigitBikeResource $DigitBikeResource,CareResource $CareResource) { 
            $this->DigitCarResource  = $DigitCarResource;
            $this->DigitBikeResource = $DigitBikeResource;
            $this->DigitResource     = $DigitResource;
            $this->CareResource      = $CareResource;
            $this->middleware('auth');
    }
    public function createQuote(){
         $id = Auth::guard('agents')->user()->id;
         
         
         //$city = DB::table('cities_list')->get();
         $categories = DB::table('categories')->where('status',1)->get();
         //$state = DB::table('states_list')->get();
         // $agent=Agents::select('*')->where('id', $id)->get()->toArray();
        $template = ['title' => 'create lead',"subtitle"=>"create lead",
                     'scripts'=>[asset('page_js/pospJs/sales.js')],'categories'=>$categories];
        $certification_count = DB::table('certification')->where('agent_id', $id)->count();
         $isPass =  false;
         if($certification_count){
             $certification = DB::table('certification')->where('agent_id', $id)->orderBy('id', 'desc')->first();
             $isPass = ($certification->percentage>=50)?true:false;
         }
          $template['isPass'] = $isPass;
        return View::make('pos.sales.createQuote')->with($template);
    }
    
    public function index(){
         $id = Auth::guard('agents')->user()->id;
         
         $suppliers=DB::table('suppliers')->orderBy('id', 'desc')->get();
         $fYear =  getCurretFinancialYear(date('m'));
         $Y = explode('-',$fYear);
         $frm = $Y[0].'-04-01';
         $to  =$Y[1].'-03-31';
         $TotalSalesCount=DB::table('policy_saled')->whereBetween('date',[$frm,$to])->where('agent_id', $id)->count();
         $TotalSaleMonthCount=DB::table('policy_saled')->whereBetween('date',[$frm,$to])
                                                       ->whereMonth('date', date('m'))->whereYear('date', date('Y'))
                                                       ->where('agent_id', $id)->count();
                                              
         $TotalSale=DB::table('policy_saled')->select(DB::raw('SUM(amount) as TotalSale'))->whereBetween('date',[$frm,$to])->where('agent_id', $id)->value('TotalSale');
         $MonthSale=DB::table('policy_saled')->select(DB::raw('SUM(amount) as MonthSale'))->whereBetween('date',[$frm,$to])
                                             ->whereMonth('date', date('m'))
                                             ->whereYear('date', date('Y'))
                                             ->where('agent_id', $id)->value('MonthSale');
         
         $template = ['title' => 'Sales',"subtitle"=>"Dashboard",'suppliers'=>$suppliers,'TotalSale'=>round($TotalSale,0),
                      'MonthSale'=>round($MonthSale,0),'TotalSalesCount'=>$TotalSalesCount,'TotalSaleMonthCount'=>$TotalSaleMonthCount,
                     'scripts'=>[asset('page_js/pospJs/sales.js?v=0.01')],
                     ];
    
        return View::make('pos.sales.salesList')->with($template);
    }
    
    public function salesDatatable(Request $request){ 
        $id = Auth::guard('agents')->user()->id;
         $whr = array();$like=array();$or_like=array();$likeArr=array(); 
        $columns = array( 0 =>'id', 1 =>'date',2=>'amount'); 
        $limit = $request->length;
        $start = $request->start;
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        
        
        $fYear = ($request->input('columns.0.search.value'))?:getCurretFinancialYear(date('m'));
        $supTerm = ($request->input('columns.1.search.value'))?:"";
        $policyTypeTerm = ($request->input('columns.2.search.value'))?:"";
        $searchTerm = ($request->input('columns.3.search.value'))?:"";
        
        $query = DB::table("policy_saled")->where('agent_id', $id);
        
        $query->select('*')
              ->when($fYear, function ($query, $fYear) {
                  $Y = explode('-',$fYear);
                 $frm = $Y[0].'-04-01';
                 $to = $Y[1].'-03-31';
                  return $query->whereBetween('date',[$frm,$to]);
                 })
              ->when($supTerm, function ($query, $supTerm) {
                  return $query->where('provider', "LIKE","%{$supTerm}%");
                })
              ->when($policyTypeTerm, function ($query, $policyTypeTerm) {
                    return $query->where('type', "=",$policyTypeTerm);
                })
              ->when($searchTerm, function ($query, $searchTerm) {
                 return $query->where('policy_no','LIKE', "%{$searchTerm}%")->orWhere('transaction_no', 'LIKE', "%{$searchTerm}%");
              });
        
        
        
        //$query = DB::table("policy_saled")->where('agent_id', $id);
        
        //$query->select('*');
        $totalFiltered = $query->count();
        //$query->orderBy($order, $dir)
        $sales = $query->orderBy($order, $dir)
                ->offset($start)->limit($limit)->get();
        $totalRecords =  DB::table("policy_saled")->where('agent_id', $id)->count();
        $result=[];$i=1;
         foreach($sales as $each){
                 $supp =  DB::table('suppliers')->where('short',$each->provider)->value('name');
                // $hasCust =  DB::table('customers')->where('id',$each->customer_id)->count();
                // if($hasCust){ $Cust =  DB::table('customers')->where('id',$each->customer_id)->first(); }
                 
                $supplier  =  ($each->provider)?DB::table("suppliers")->where('short','=',$each->provider)->value('name'):"<span class='text-danger'>Not available</span>";
                 
                $file   =($each->filename!="")
                                        ?'<a href="'.url('get/download/file/policy-file/'.$each->filename).'">Download</a>'
                                        :'<a href="#" data-id="'.$each->id.'" class="getPolicyPdf">Get Pdf</a>';
                                                      
                 
                 $eachData=array();
                //  $custName    =($hasCust && $Cust->name!="")?$Cust->name:"N/A";
                //  $custMobile = ($hasCust)?$Cust->mobile:"N/A";
                 $eachData['customer']       = '<div><a href="javascript:void(0);">'.$each->customer_name.'</a></div>
                                                <div class="text-muted">'.$each->mobile_no.'</div>';
                 $eachData['date']           = '<div class="amount-text">'.createFormatDate($each->date,'Y-m-d H:i:s','d/m/Y').'</div>';  
                 $eachData['amount']         = '<div class="amount-text">₹'.$each->amount.'</div>';
                 $eachData['policyNo']       = '<div class="text-muted"><a href="javascript:void(0);">'.($each->policy_no).'</a></div>';
                 $eachData['transactionNo']  = '<div class="text-muted">'.$each->transaction_no.'</div>';
                 $eachData['policyFrom']     = '<div class="text-muted">'.$supp.'</div>';
                 $eachData['policyFor']      = '<div class="text-muted">'.$each->type.'</div>';
                 $eachData['Paymentstatus']  = '<div class="text-muted">'.$each->payment_status.'</div>';
                 $eachData['policyStatus']   = '<div class="text-muted">'.$each->policy_status.'</div>';
                 $eachData['action']         = '<div class="text-muted" id="actionPolicy-td-'.$each->id.'" >'.$file.'</div>';
                 
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
    
    public function getDashboardCount(Request $request){
        
         $id = Auth::guard('agents')->user()->id;
         if($request->fYear!=""){
             $fYear =  $request->fYear;//getCurretFinancialYear(date('m'));
             $Y = explode('-',$fYear);
             $frm = $Y[0].'-04-01';
             $to  =$Y[1].'-03-31';
         }else{
             $fYear =  getCurretFinancialYear(date('m'));
             $Y = explode('-',$fYear);
             $frm = $Y[0].'-04-01';
             $to  =$Y[1].'-03-31';
         }
         //echo  $fYear;
         $supp=($request->supp!="")?$request->supp:"";
         $pTyp=($request->pTyp!="")?$request->pTyp:"";
         $searchTerm=($request->term!="")?$request->term:"";
         
         $data['TotalSalesCount']=DB::table('policy_saled')->whereBetween('date',[$frm,$to])->where('agent_id', $id)
                                ->when($supp, function ($query, $supp) {
                                  return $query->where('provider', "LIKE","%{$supp}%");
                                })->when($searchTerm, function ($query, $searchTerm) {
                                     return $query->where('policy_no','LIKE', "%{$searchTerm}%")->orWhere('transaction_no', 'LIKE', "%{$searchTerm}%");
                                })->count();
         
         
         $data['TotalSaleMonthCount']=DB::table('policy_saled')->whereBetween('date',[$frm,$to])
                                                       ->whereMonth('date', date('m'))->whereYear('date', date('Y'))
                                                       ->where('agent_id', $id)
                                                       ->when($supp, function ($query, $supp) {
                                                          return $query->where('provider', "LIKE","%{$supp}%");
                                                        })->when($searchTerm, function ($query, $searchTerm) {
                                                             return $query->where('policy_no','LIKE', "%{$searchTerm}%")->orWhere('transaction_no', 'LIKE', "%{$searchTerm}%");
                                                        })->count();
                                              
         $data['TotalSale']=DB::table('policy_saled')->select(DB::raw('ROUND(SUM(amount),0) as TotalSale'))->whereBetween('date',[$frm,$to])
                                                ->where('agent_id', $id)
                                                ->when($supp, function ($query, $supp) {
                                                      return $query->where('provider', "LIKE","%{$supp}%");
                                                   })
                                                ->when($searchTerm, function ($query, $searchTerm) {
                                                     return $query->where('policy_no','LIKE', "%{$searchTerm}%")->orWhere('transaction_no', 'LIKE', "%{$searchTerm}%");
                                                 })
                                                ->value('TotalSale');
         
         $data['MonthSale']=DB::table('policy_saled')->select(DB::raw('ROUND(SUM(amount),0) as MonthSale'))->whereBetween('date',[$frm,$to])
                                                     ->whereMonth('date', date('m'))
                                                     ->whereYear('date', date('Y'))
                                                     ->where('agent_id', $id)
                                                     ->when($supp, function ($query, $supp) {
                                                          return $query->where('provider', "LIKE","%{$supp}%");
                                                      })
                                                     ->when($searchTerm, function ($query, $searchTerm) {
                                                      return $query->where('policy_no','LIKE', "%{$searchTerm}%")->orWhere('transaction_no', 'LIKE', "%{$searchTerm}%");
                                                     })
                                                    ->value('MonthSale');
                                                    
        return response()->json($data); 
    }
    
    public function getPolicyDoc(Request $request){
        $sale=DB::table('policy_saled')->where('id', $request->id)->first();
       
        if($sale->provider=="DIGIT"){
                $resp = $this->DigitCarResource->GetPDF($sale->policy_no);
                if($resp->status){
                  return response()->json(['status'=>'success','fileName'=>$resp->filename]); 
                }else{
                  return response()->json(['status'=>'error','fileName'=>"",'path'=>url('get/download/file/policy-file/'.$resp['filename'])]); 
                }
        }else if($sale->provider=="DIGIT_H"){
            $resp  = $this->DigitResource->GetPDF($sale->policy_no);
             if($resp->status){
                 DB::table('policy_saled')->where(['id'=>$request->id])->update(['filename'=>$resp->filename]);
                  return response()->json(['status'=>'success','fileName'=>$resp->filename,'path'=>url('get/download/file/policy-file/'.$resp->filename)]); 
                }else{
                  return response()->json(['status'=>'error','fileName'=>""]); 
                }
        }else if($sale->provider=="CARE"){
                $resp = $this->CareResource->savePDF($sale->enquiry_id,$sale->policy_no);
                if($resp['status']=='success'){
                    DB::table('policy_saled')->where(['id'=>$request->id])->update(['filename'=>$resp['filename']]);
                    return response()->json(['status'=>'success','fileName'=>$resp['filename'],'path'=>url('get/download/file/policy-file/'.$resp['filename'])]); 
                }else{
                  return response()->json(['status'=>'error','fileName'=>$resp['filename']]); 
                }
        }
    }
    
    // public function testVh(){
         
    //              $data = DB::table('temp_vehicles')
    //                       ->select('*')
    //                       ->where('id', '>=', 1) 
    //                       ->where('id', '<=', 100) 
    //                     ->get();
                          
    //             foreach($data as $row){
    //                 print_r($row);
    //                 $hasMake =  DB::table('vehicle_make')->where('make',ucwords($row->make))->where('vehicle_type',$row->vehicle_type)->count();
    //                 if($hasMake){
                        
    //                 }else{
    //                     $makeID =  DB::table('vehicle_make')->insertGetId(['make'=>ucwords($row->make),'vehicle_type'=>$row->vehicle_type]);
    //                     DB::table('temp_vehicles')->where('make',$row->make)->where('vehicle_type',$row->vehicle_type)->update(['make_id'=>$makeID]);
    //                 }
                    
    //                 echo "<br/><hr/><br/>";
    //             }
       
    //         //   $tempmodals = DB::table('temp_vehicles')
    //         //       ->select('*')
    //         //       ->where('id', '>=', 22969) 
    //         //       ->where('id', '<=', 22970) 
    //         //       ->get();
    //         //     foreach($tempmodals as $res){
    //         //          print_r($res);
    //         //          $Hasmodal =  DB::table('vehicle_modal')->where('make_id',$res->make_id)->where('modal',$res->modal)->count();
    //         //          if($Hasmodal){
                         
    //         //          }else{
    //         //             $modalID =  DB::table('vehicle_modal')->insertGetId(['make_id'=>$res->make_id,'modal'=>$res->modal]);
    //         //             DB::table('temp_vehicles')->where('make_id',$res->make_id)->where('modal',$res->modal)->update(['modal_id'=>$modalID]);
    //         //          }
                     
    //         //         echo "<br/><hr/><br/>";
    //         //     }
             
   
        
    //     //  $data = DB::table('temp_vehicles')
    //     //           ->select('*')
    //     //           ->where('id', '>=', 22969) 
    //     //           ->where('id', '<=', 22970) 
    //     //         ->get();
                  
    //     // foreach($data as $row){
    //     //     print_r($row);
    //     //     $hasMake =  DB::table('vehicle_make')->where('make',ucwords($row->make))->where('vehicle_type',$row->vehicle_type)->count();
    //     //     if($hasMake){
                
    //     //     }else{
    //     //         $makeID =  DB::table('vehicle_make')->insertGetId(['make'=>ucwords($row->make),'vehicle_type'=>$row->vehicle_type]);
    //     //         DB::table('temp_vehicles')->where('make',$row->make)->where('vehicle_type',$row->vehicle_type)->update(['make_id'=>$makeID]);
    //     //     }
            
    //     //     echo "<br/><hr/><br/>";
    //     // }
        
    // }
}