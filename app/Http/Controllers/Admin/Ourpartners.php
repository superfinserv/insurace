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

class Ourpartners extends Controller
{
     public function __construct() { 
       // $this->appUtil = $appUtil; 
        $this->middleware('auth');
     }


    public function index(){
         $partners = DB::table('our_partners')->get();
         $template = ['title' => 'Supersolutions :: Our Partners',"subtitle"=>"Our Partners",'partners'=>$partners,
                     'scripts'=>[asset('admin/js/page/our-partners.js')]];
        return View::make('admin.ourpartners.list')->with($template);
    }
    
    public function statusUpdate(Request $request){
      $is = DB::table('our_partners')->where('id',$request->id)->update(['status'=>$request->status]);
      if(1){
          return Response::json(['status'=>'success','message'=>'status updated successfully']);
      }else{
          return Response::json(array('status'=>'error','message'=>'something went wrong!'));
      }
    }
    
    function deletePartner(Request $request){
    //     $p = DB::table('our_partners')->where('id',$request->id)->first();
    //     $image_path = getcwd()."/public/assets/partners/".$p->logo_image;
    //     if(File::exists($image_path)) { File::delete($image_path); }
    //     DB::table('our_partners')->where('id',$request->id)->delete();
    //   if(1){
    //       return Response::json(['status'=>'success','message'=>$p->name.' has been deleted successfully']);
    //   }else{
          return Response::json(array('status'=>'error','message'=>'You can not delete any partners from system'));
      //}
    }
    
    public function partnersSave(Request $request){
        $name= clean_str($request->pname);
        $fileName = $name.'_'.uniqid().'.'.request()->plogo->getClientOriginalExtension();
        //$request->plogo->move(dirname(getcwd(),1)."/insurance//", $fileName);
        $request->plogo->move('public/assets/partners/', $fileName);
        $data['name']=$request->pname;
        $data['logo_image']=$fileName;
        $id = DB::table('our_partners')->insertGetId($data);
        if($id){ 
            $html='<div class="col-lg-2" id="col-figure-'.$id.'">
                 
                    <figure class="overlay" style="box-shadow: 0px 0px 6px #ccc;" data-toggle="tooltip" data-placement="top" title="'.$request->pname.'" >
                      <img src="'.asset('assets/partners/'.$fileName).'" class="img-fluid" alt="'.$request->pname.'">
                      <figcaption class="overlay-body d-flex align-items-end justify-content-center">
                        <div class="img-option img-option-sm">
                          <a href="#" class="img-option-link btn-delete"  data-id="'.$id.'" data-name="'.$request->pname.'" ><div><i class="icon ion-ios-trash"></i></div></a>
                          <a href="#" class="img-option-link btn-status" data-toggle="tooltip" data-placement="top" title="Click to disable" data-status="ACTIVE" data-id="'.$id.'" data-name="'.$request->pname.'" ><div><i class="icon ion-android-alert"></i></div></a>
                          
                          <!--<a href="#" class="img-option-link"><div><i class="icon ion-ios-star"></i></div></a>-->
                        </div>
                      </figcaption>
                    </figure>
                  
             </div>';
          return response()->json(['status'=>'success','data_html'=>$html,'message'=>'New partner has been added successfully']);
        }else {
         return response()->json(['status'=>'error','message'=>'Something went wrong while add new Partner']);
        }
  } 
  
    // Manage plans..
    
     public function partnerPlanslist(Request $request){
         $template = ['title' => 'Supersolutions :: Manage Plans',"subtitle"=>"Manage Health Plans",
                     'scripts'=>[asset('admin/js/page/manage-plans.js')]];
        return View::make('admin.ourpartners.plans.planslist')->with($template);
    }
    
     public function getPlanListdatatable(Request $request){
        $columns = array( 0 =>'id', 1 =>'plan_name',3=>'status'); 
        $limit = $request->length;
        $start = $request->start;
        
          $order = $columns[$request->input('order.0.column')];
          $dir = $request->input('order.0.dir');
        
         $planName = ($request->input('columns.0.search.value'))?:"";
         $partner = ($request->input('columns.1.search.value'))?:"";
         $statusTerm = ($request->input('columns.2.search.value'))?:"";
        $query = DB::query();
        $query = DB::table('plans')->join('our_partners', 'our_partners.shortName', '=', 'plans.supplier');
        $query->select('plans.*','our_partners.name as partner')
              ->when($planName, function ($query, $planName) {
                    return $query->where('plan_name','like', '%'.$planName.'%');
                })
              ->when($partner, function ($query, $partner) {
                    return $query->where('our_partners.name','like', '%'.$partner.'%');
                })
                ->when($statusTerm, function ($query, $statusTerm) {
                    return $query->where('plans.status','=', $statusTerm);
                });
        $totalFiltered = $query->count();
        $brands = $query->orderBy($order,$dir)
            ->offset($start)
            ->limit($limit)->get();
        $totalRecords =  DB::table('plans')->count();
        $result=[];$i=($start+1);
         foreach($brands as $each){
                 $eachData=array();
                
                $eachData['sno']        = $i;
                $eachData['plan_name']  = $each->plan_name;
                $eachData['partner']    = $each->partner;
                 $eachData['status']    =($each->status=="ACTIVE")?'<div class="btn-status"  data-plan="'.$each->plan_name.'" data-id="'.$each->id.'" data-status="'.$each->status.'"><span class="bg-success pd-y-3 pd-x-10 tx-white tx-11 ">Active</span> </div>'
                                                    :'<div class="btn-status"      data-plan="'.$each->plan_name.'" data-id="'.$each->id.'" data-status="'.$each->status.'"><span class="bg-danger pd-y-3 pd-x-10 tx-white tx-11">Inactive</span> </div>';
                $buttons ='<div class="btn-group" role="group" >
                      <a style="padding: 5px 10px;" data-toggle="tooltip" data-placement="top" title="Update Template"  href="'.url('/our-partners/plans/manage/'.$each->id).'" class="btn btn-primary"><i class="icon ion-compose"></i></a>
                      </div>';
                $eachData['action']          = $buttons;  
             
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
   
     public function managePlans(Request $request){
         $plan = DB::table('plans')->where('id',$request->id)->first();
         $planKeys  =  DB::table('plan_key_features')->get();
         $kbs  =  DB::table('plans_features')->where('plan_id',$plan->id)->get();
         $supp  =  DB::table('suppliers')->where('short',$plan->supplier)->first();
         $template = ['title' => 'Supersolutions :: Manage Plans',"subtitle"=>"Manage Health Plans",'plan'=>$plan,'planKeys'=>$planKeys,'supp'=>$supp,
                     'scripts'=>[asset('admin/js/page/manage-plans.js')]];
        return View::make('admin.ourpartners.plans.manage')->with($template);
    }
    
     public function updatePlanInfo(Request $request){
       
        // $fileName1 = uniqid().'.'.request()->policy_wording->getClientOriginalExtension();
        // $request->policy_wording->move('public/assets/partners/', $fileName);
        
        // $data['policy_wording']=$fileName;
        // $id = DB::table('our_partners')->insertGetId($data);
         $pln= DB::table('plans')->where('id',$request->planID)->first();
         $fileName1=$pln->policy_wording;
         $fileName2=$pln->policy_brochure;
         $plnName=str_replace(' ','-',$request->plan_name);
        if($request->hasFile('policy_wording')){ 
           $fileName1 = $plnName.'-policy-wording'.'.'.request()->policy_wording->getClientOriginalExtension();
           $request->policy_wording->move('public/assets/partners/', $fileName1);
           $data['policy_wording']=$fileName1;
           
           $f1_path = getcwd()."/public/assets/partners/".$pln->policy_wording;
           if(File::exists($f1_path)) { File::delete($f1_path); }
        }
        
        if($request->hasFile('policy_brochure')){ 
           $fileName2 = $plnName.'-policy-brochure'.'.'.request()->policy_brochure->getClientOriginalExtension();
           $request->policy_brochure->move('public/assets/partners/', $fileName2);
           $data['policy_brochure']=$fileName2;
           
           $f2_path = getcwd()."/public/assets/partners/".$pln->policy_brochure;
           if(File::exists($f2_path)) { File::delete($f2_path); }
        }
        $data['descriptions'] = htmlentities($_POST['plan_description']);
        $data['plan_name'] =  $request->plan_name;
        $is = DB::table('plans')->where('id',$request->planID)->update($data);
        $planKeys  =  DB::table('plan_key_features')->get();
        foreach($planKeys as $pks){
            $cnt = DB::table('plans_features')->where('plan_id',$request->planID)->where('features',$pks->key_features)->count();
            if($cnt){
                DB::table('plans_features')->where('features',$pks->key_features)->where('plan_id',$request->planID)->update(['val'=>$_POST[$request->planID.'-pk-'.$pks->id]]);
            }else{
              DB::table('plans_features')->insertGetId(['features'=>$pks->key_features,'val'=>$_POST[$request->planID.'-pk-'.$pks->id],'plan_id'=>$request->planID]);  
            }
        }
        return response()->json(['status'=>'success','message'=>'Plan updated successfully','data'=>['file1'=>$fileName1,'file2'=>$fileName2]]);
        
    }
    
    public function updatePlanInfoStatus(Request $request){
         DB::table('plans')->where('id',$request->id)->update(['status'=>$request->status]);
        return response()->json(['status'=>'success','message'=>'Plan updated successfully']);
        
    }
  
    
//     public function updateBenifits(Request $request){
//         $is = DB::table('plans_key_benefits')->where('id',$request->id)->update(['txt_value'=>$request->value]);
//         return response()->json(['status'=>'success','message'=>'Value updated successfully']);
        
//     }
    
//     public function addNewBenifits(Request $request){
//         $data['txt_value']=$request->value;
//         $data['pId'] =$request->pId;
//         $id = DB::table('plans_key_benefits')->insertGetId($data);
//         if($id){ 
//               $html='<div class="row" id="row-'.$id.'">
//                         <div class="col-lg-10 col-md-10">
//                          <div class="form-group">
//                           <input class="form-control input-fields" name="key-benifits'.$id.'" id="key-benifits'.$id.'" value="'.$request->value.'"/>
//                         </div>
//                         </div>
//                         <div class="col-lg-2 col-md-2">
//                             <a href="#" data-id="'.$id.'"  class="btn btn-success btn-icon rounded-circle mg-r-5 mg-b-10 tx-white updateKeybenifits"> <div><i class="fa fa-check"></i></div></a>
//                             <a href="#" data-id="'.$id.'" class="btn btn-danger  btn-icon rounded-circle mg-r-5 mg-b-10 tx-white deleteKeybenifits"> <div><i class="fa fa-trash"></i></div></a>
//                         </div>
//                     </div>';
//           return response()->json(['status'=>'success','data_html'=>$html,'message'=>'New benifit has been added successfully']);
//         }else {
//          return response()->json(['status'=>'error','message'=>'Something went wrong while add new benifit']);
//         }
//   } 
  
   
  
    // function deletePartnerPlansbenifits(Request $request){
    //     DB::table('plans_key_benefits')->where('id',$request->id)->delete();
    //     if(1){
    //       return Response::json(['status'=>'success','message'=>'information has been deleted successfully']);
    //   }else{
    //       return Response::json(array('status'=>'error','message'=>'something went wrong while delete'));
    //   }
    // }
  
   
}
 

