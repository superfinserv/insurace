<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Response;
use View;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
class OrcsController extends Controller{
   
    public function __construct() { 
     
    }
    public function index(){
        
        $template = ['title' => 'ORC',"subtitle"=>"ORC List",
                     'scripts'=>[asset('admin/js/page/policy-orc.js')]];
        if(true){                
           return View::make('admin.orcs.list')->with($template);
        }else{
           return View::make('admin.404')->with($template);
        }
    }
    
     public function getdatatable(Request $request){
        $whr = array();$like=array();$or_like=array();$likeArr=array(); 
        $columns = array(  0 =>'agents.id', 1 =>'first_name',2=>'last_name' ,'3'=>'email','3'=>'is_active'); 
        $limit = $request->length;
        $start = $request->start;
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        
        $insurerTerm = ($request->input('columns.0.search.value'))?:"";
        $typeTerm = ($request->input('columns.1.search.value'))?:"";
        $payTerm = ($request->input('columns.2.search.value'))?:"";
        $pTypTerm = ($request->input('columns.3.search.value'))?:"";
        $query = DB::query();
        $query = DB::table('policy_payouts')->select('policy_payouts.*',
                            'policy_saled.date as loginDate','policy_saled.customer_name as custName',
                            'policy_saled.mobile_no as custMobile','our_partners.name as partnerName',
                        
                            DB::raw("(CASE WHEN policy_saled.policyType ='COM' THEN 'Comprehensive'
                                           WHEN policy_saled.policyType ='TP' THEN 'Third Party'
                                           WHEN policy_saled.policyType ='SAOD' THEN 'Standalone Own Damage'
                                           WHEN policy_saled.policyType ='FL' THEN 'Floater'
                                           WHEN policy_saled.policyType ='IN' THEN 'Individual'
                                           ELSE 'N/A' END) as policyType,
                                           
                                     (CASE WHEN policy_saled.type ='CAR' THEN 'Motor(CAR)'
                                           WHEN policy_saled.type ='BIKE' THEN 'Motor(TW)'
                                           WHEN policy_saled.type ='HEALTH' THEN 'Health'
                                           ELSE 'N/A' END) as policyFor,
                            
                            
                            
                            (CASE WHEN policy_saled.agent_id >0 THEN Tposp.name
                                           ELSE 'N/A' END) as pospName,
                                     (CASE WHEN policy_saled.sp_id >0 THEN Tsp.name
                                           ELSE 'N/A' END) as spName")
                            )
                        ->leftJoin('policy_saled', 'policy_saled.policy_no', '=', 'policy_payouts.policy_no')
                        ->leftJoin('our_partners', 'our_partners.shortName', '=', 'policy_saled.provider')
                        ->leftJoin('agents AS Tposp', 'Tposp.id', '=', 'policy_saled.agent_id')
                        ->leftJoin('agents AS Tsp', 'Tsp.id', '=', 'policy_saled.sp_id')
                      ->when($insurerTerm, function ($query, $insurerTerm) {
                            return $query->where('our_partners.name','LIKE', "%{$insurerTerm}%");
                        })
                      ->when($typeTerm, function ($query, $typeTerm) {
                          return $query->where('policy_rule_sheet.type',$typeTerm);
                        })
                      ->when($payTerm, function ($query, $payTerm) {
                          return $query->where(['policy_rule_sheet.commisionType'=>$payTerm]);
                        })
                        ->when($pTypTerm, function ($query, $pTypTerm) {
                          return $query->where(['policy_rule_sheet.policyType'=>$pTypTerm]);
                        });
              
        $totalFiltered = $query->count();
        //$query->orderBy($order, $dir)
        $payouts = $query->orderBy("id", "ASC")
            ->offset($start)
            ->limit($limit)->get();
        $totalRecords =  DB::table('policy_payouts')->count();
        $result=[];$i=($start+1);
         foreach($payouts as $each){
                 $eachData['Date']  = Carbon::CreateFromFormat('Y-m-d H:i:s',$each->loginDate)->format('d/m/Y');
                 $eachData['Month'] = Carbon::CreateFromFormat('Y-m-d H:i:s',$each->loginDate)->format('m');
                 $eachData['Year']  = Carbon::CreateFromFormat('Y-m-d H:i:s',$each->loginDate)->format('Y');
                 $eachData['PolicyNo'] = $each->policy_no;
                 $eachData['CustomerName'] = $each->policy_no;
                 $eachData['CustomerMobile'] = $each->policy_no;
                 $eachData['Insurer'] = '<div class=""><a href="#">'.$each->partnerName.'</a></div>
                                             <div class=""><span>'.$each->policyFor.'('.$each->policyType.')</span></div>';
                 $eachData['Customer'] = '<div class=""><a href="#">'.$each->custName.'</a></div>
                                             <div class=""><span>'.$each->custMobile.'</span></div>';
                 $eachData['Amount'] = $each->onAmt;
                 $eachData['Total'] = $each->totalDst;
                 $eachData['SpName'] =$each->spName;
                 $eachData['PospName'] =  $each->pospName;
                 $eachData['spAmt'] = $each->spDst;
                 $eachData['pospAmt'] = $each->pospDst;
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
   

    
 
   
}
 

