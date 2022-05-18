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
class RulesController extends Controller{
   
    public function __construct() { 
     
    }
    public function index(){
        
        $template = ['title' => 'Rules',"subtitle"=>"Rule List",
                     'scripts'=>[asset('admin/js/page/rules.js')]];
        if(true){                
           return View::make('admin.rules.list')->with($template);
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
        $query = DB::table('policy_rule_sheet')->select('policy_rule_sheet.*','our_partners.name as partnerName')
                        ->leftJoin('our_partners', 'our_partners.shortName', '=', 'policy_rule_sheet.insurer')
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
        $users = $query->orderBy("id", "ASC")
            ->offset($start)
            ->limit($limit)->get();
        $totalRecords =  DB::table('policy_rule_sheet')->count();
        $result=[];$i=($start+1);
         foreach($users as $each){
                 $TYP =  ucfirst(str_replace("_"," ",strtolower($each->type)));
                 $eachData['ruleCode']    = '<div class=""><a href="#">'.strtoupper($each->ruleCode).'</a></div>
                                             <div class=""><span>'.$each->commisionType.' Payouts</span></div>';
                 $eachData['insurer']    = '<div class=""><a href="#">'.$each->partnerName.'</a></div>
                                             <div class=""><span>'.$TYP.'('.$each->policyType.')</span></div>';
                 $eachData['onamt'] = $each->onAmt;
                 $eachData['total'] = ($each->commisionType=="Percent")?$each->totalIn.'%':'₹'.$each->totalIn.'/-';
                 $eachData['posp'] = ($each->commisionType=="Percent")?$each->pospIn.'%':'₹'.$each->pospIn.'/-';
                 $eachData['sp'] = ($each->commisionType=="Percent")?$each->spIn.'%':'₹'.$each->spIn.'/-';   
                 if($each->type=="HEALTH"){ 
                      $eachData['vtype']    = "N/A";
                 }else{
                     $CPA  =  ($each->CPA!="")?$each->CPA:"N/A";
                     $BODY  =  ($each->bodyType!="")?"(".$each->bodyType.")":"";
                 $eachData['vtype']    = '<div class=""><a href="#">'.$each->vehicleType.$BODY.'</a></div>
                                             <div class=""><span>CPA-'.$CPA.'</span></div>';
                 }
                 $eachData['dates']    = '<div class=""><a>From:'.Carbon::CreateFromFormat('Y-m-d',$each->fromDate)->format('d/m/Y').'</a></div>
                                             <div class=""><a>To:'.Carbon::CreateFromFormat('Y-m-d',$each->toDate)->format('d/m/Y').'</a></div>';
               // $eachData['created_at']   = $each->created_at;
                
                //$eachData['status'] = $each->status;
                
          $buttons ='<div class="btn-group" role="group" aria-label="Action Buttons" data-id="'.$each->id.'" data-name="'.$each->ruleCode.'" >
                      <a style="padding: 5px 10px;" data-toggle="tooltip" data-placement="top" title="Copy Rule"  href="#" data-code="'.$each->ruleCode.'"  class="btn btn-dark btn-copy" ><i class="icon ion-ios-copy"></i></a>
                      <a style="padding: 5px 10px;"  href="#" data-toggle="tooltip" data-placement="top" data-param="edit" title="Update Rule"  data-code="'.$each->ruleCode.'" class="btn btn-primary open-model"><i class="icon ion-compose"></i></a>
                      
                    </div>';
                    // /<a style="padding: 5px 10px;" data-toggle="tooltip" data-placement="top" title="Delete Rule"  data-id="'.$each->id.'" data-code="'.$each->ruleCode.'"  href="#" class="btn btn-danger btn-trash"><i class="icon ion-trash-a"></i></a>
              if(true){ 
                $eachData['action'] = $buttons;  
              }else{
                $eachData['action']="";
              }
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
   
   public function curdRuleModel(Request $request){
         $template['param'] =$request->param;
         if(isset($request->code) && $request->param=="edit"){
            $template['data'] = DB::table("policy_rule_sheet")->where('ruleCode',$request->code)->first();
            $template['fromDate'] =  Carbon::CreateFromFormat('Y-m-d',$template['data']->fromDate)->format('d/m/Y');
            $template['toDate'] = Carbon::CreateFromFormat('Y-m-d',$template['data']->toDate)->format('d/m/Y');
          }
          $template['partners'] = DB::table("our_partners")->get();
         return View::make('admin.rules.model_create_edit')->with($template);
     }
      public function saveRules(Request $request){
            $validMessage = ['insurer.required'=>'Insurer is required',
                              'instype.required'=>'Insurance type is required',
                              'policyType.required'=>'Policy Type is required',
                              'cTyp.required'=>'Commision Type is required',
                              'fromDate.required'=>'From date is required',
                              'toDate.required'=>'To date is required',
                              'fromDate.date_format'=>'Invalid Date Format',
                              'toDate.date_format'=>'Invalid Date Format',
                              'totalOut.required'=>'Please Choose book to returned',
                              'pospOut.required'=>'Please provide return date',
                              'spOut.required'=>'Please provide request Type',
                              'onAmt.required'=>'Please on Net/OD',
                              
                       ];
                        
                $validRule =[
                        'insurer' => 'required',
                        'instype'=>'required',
                        'policyType'=>'required',
                        'cTyp'=>'required',
                        'fromDate' => 'required|date_format:d/m/Y',
                        'toDate' => 'required|date_format:d/m/Y',
                        'totalOut' => 'required',
                        'pospOut'=>'required',
                        'spOut'=>'required',
                        'onAmt'=>'required',
                    ];
                if($request->instype=="MOTOR"){
                    $validMessage[ 'vehicleType.required']='Vehicle type is required';
                    $validRule['vehicleType'] ='required';
                }
                if($request->instype=="MOTOR" && $request->vehicleType=="TW"){
                    $validMessage[ 'bodyType.required']='Body type is required';
                    $validRule['bodyType'] ='required';
                    
                    // $validMessage[ 'cpaOpt.required']='Choose CPA as Yes/No';
                    // $validRule['cpaOpt'] ='required';
                 }     
            $validator = Validator::make($request->all(),$validRule ,$validMessage);
            if($validator->fails()){
                 return response()->json(['status'=>'error','message'=> $validator->errors()->first()]);
            }else{
                 $dt['insurer'] = $request->insurer;
                 $dt['commisionType'] = $request->cTyp;
                 $dt['type'] = $request->instype;
                 $dt['policyType'] = $request->policyType;
                 $dt['totalIn'] = $request->totalOut;
                 $dt['pospIn'] = $request->pospOut;
                 $dt['spIn'] = $request->spOut;
                 $dt['fromDate'] = Carbon::CreateFromFormat('d/m/Y',$request->fromDate)->format('Y-m-d');
                 $dt['toDate'] = Carbon::CreateFromFormat('d/m/Y',$request->toDate)->format('Y-m-d');
                 $dt['ruleDesc'] = $request->cTyp." Payout";
                 $dt['status'] = "Active";
                 if($request->instype=="HEALTH"){
                     $dt['vehicleType'] = NULL;
                     $dt['bodyType'] =  NULL;
                     $dt['CPA'] =  NULL;
                 }else{
                     $dt['vehicleType'] = $request->vehicleType;
                     $dt['bodyType'] = $request->bodyType;
                     $dt['CPA'] = $request->cpaOpt;
                 }
                 
               if(isset($request->code)){ 
                   DB::table("policy_rule_sheet")->where('ruleCode',$request->code)->update($dt);
                   return response()->json(['status'=>'success','message'=>$request->code.' updated successfully']); 
               }else{
                    $maxRow = DB::table("policy_rule_sheet")->orderBy('id','DESC')->first();
                    $max = substr($maxRow->ruleCode, 2);
                    $max = $max+1;
                    $dt['ruleCode'] = 'RC'.str_pad($max, 3, 0, STR_PAD_LEFT);
                    DB::table("policy_rule_sheet")->insertGetId($dt);
                    return response()->json(['status'=>'success','message'=>'New Rule created successfully']); 
               }
            }
      }
    
      public function copyRule(Request $request){ 
         $validator = Validator::make($request->all(),['code'=>'required'] ,['code.required']);
         if($validator->fails()){
                 return response()->json(['status'=>'error','message'=> $validator->errors()->first()]);
        }else{
            $SQL = DB::table("policy_rule_sheet")->where('ruleCode',$request->code);
            if($SQL->count())
                  $object = $SQL->first();
                  $array = json_decode(json_encode($object), true);
                  unset($array['created_at']);unset($array['id']);
                    $maxRow = DB::table("policy_rule_sheet")->orderBy('id','DESC')->first();
                    $max = substr($maxRow->ruleCode, 2);
                    $max = $max+1;
                    $array['ruleCode'] = 'RC'.str_pad($max, 3, 0, STR_PAD_LEFT);
                   DB::table("policy_rule_sheet")->insertGetId($array);
                   return response()->json(['status'=>'success','message'=>'Rule copied successfully']); 
            }
      }
   
}
 

