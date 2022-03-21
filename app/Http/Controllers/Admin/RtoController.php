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
use Illuminate\Support\Facades\Validator;

class RtoController extends Controller
{
     public function __construct() { 
       // $this->appUtil = $appUtil; 
        $this->middleware('auth');
     }

    public function index(Request $request){
        $template = ['title' => 'RTO',"subtitle"=>"RTO List"];
        $template['scripts'] = [asset('admin/js/page/rto.js')];  
        $template['states'] = DB::table('states')->get(); 
        return View::make('admin.rto.list')->with($template);
    }
    
    public function getdatatable(Request $request){
        $columns = array(0 =>'rtoMaster.rtoCode', 2 =>'cities.name', 3=>'states.name',6=>'rtoMaster.status'); 
        $limit = $request->length;
        $start = $request->start;
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        
        $RTOCode    = ($request->input('columns.0.search.value'))?:"";
        $cityName   = ($request->input('columns.1.search.value'))?:"";
        $stateName = ($request->input('columns.2.search.value'))?:"";
        $MainCode = ($request->input('columns.3.search.value'))?:"";
        $query = DB::query();
        $query = DB::table('rtoMaster')->leftjoin('cities', 'cities.id', '=', 'rtoMaster.city_id')
                                             ->leftjoin('states', 'states.id', '=', 'cities.state_id');
        $query->select('rtoMaster.*','cities.name as cityName','states.name as stateName')
                ->when($RTOCode, function ($query, $RTOCode) {
                    return $query->where('rtoMaster.rtoCode','like', '%'.$RTOCode.'%');
                })
              ->when($cityName, function ($query, $cityName) {
                    return $query->where('cities.name','like', '%'.$cityName.'%');
                })
              ->when($stateName, function ($query, $stateName) {
                    return $query->where('states.name','like', '%'.$stateName.'%');
                });
                //  ->when($MainCode, function ($query, $MainCode) {
                //     return $query->where('vehicle_make_tw.make','like', '%'.$MainCode.'%');
                // });
                
              
        $totalFiltered =$query->count();
       // $query->orderBy('id','ASC')
        $vehicles =  $query->orderBy($order, $dir)
            ->offset($start)
            ->limit($limit)->get();
           
        $totalRecords =  DB::table('rtoMaster')->count();
        $result=[];$i=($start+1);
         foreach($vehicles as $each){
                
                $eachData=array();
                $eachData['sno']          = $i;
                $eachData['rto']         = '<a href="#">'.trim($each->rtoCode).'</a>';
                 $eachData['txt']        = $each->text;
                $eachData['city']        = $each->cityName;
                $eachData['state']      = $each->stateName;    
                $eachData['hdfcErgoTw_code']     = '<input data-typ="2w"  class="text-vcode" type="text" data-id="'.$each->id.'" id="hdfcErgoTw_code'.$each->id.'"  name="hdfcErgoTw_code'.$each->id.'"   value="'.$each->hdfcErgoCodeTw.'">';//$each->fgi_code;
                $eachData['hdfcErgoCar_code']    = '<input data-typ="car" class="text-vcode" type="text" data-id="'.$each->id.'" id="hdfcErgoCar_code'.$each->id.'" name="hdfcErgoCar_code'.$each->id.'" value="'.$each->hdfcErgoCodeCar.'">';//$each->hdfcErgo_code;
                $actSel   = ($each->status=='Active')?'Selected':'';
                $InactSel = ($each->status=='Inactive')?'Selected':'';
                $eachData['status'] = '<select  data-typ="status" class="text-vcode" name="rtoStatus'.$each->id.'" data-id="'.$each->id.'" id="rtoStatus'.$each->id.'"><option value="Active" '.$actSel.'>Active</option><option '.$InactSel.' value="Inactive">Inactive</option></select>';
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
        if($request->typ=='2w'){
          $var = DB::table('rtoMaster')->where('id',$request->id)->update(['hdfcErgoCodeTw'=>$request->val]);
          return Response::json(array('status'=>'success'));
        }else if($request->typ=='car'){
            $var = DB::table('rtoMaster')->where('id',$request->id)->update(['hdfcErgoCodeCar'=>$request->val]);
            return Response::json(array('status'=>'success'));
        }else if($request->typ=='status'){
            $var = DB::table('rtoMaster')->where('id',$request->id)->update(['status'=>$request->val]);
            return Response::json(array('status'=>'success'));
        }else{
             return Response::json(array('status'=>'error'));
        }
    }
    
     public function savenewInfo(Request $request){
          try{
                    $validator = Validator::make($request->all(), [
                        'rtoCode' => 'required|unique:rtoMaster'
                    ],['rtoCode.required'=>'The RTO Code is required.']);
            
            
                    if($validator->fails()){ 
                         return response()->json(['status'=>'error','message'=> $validator->errors()->first()]);
                    }else{
                              $data['rtoCode'] = ucwords(strtolower($request->rtoCode));
                              $data['text'] = ucfirst(strtolower($request->rtoTxt));
                              $data['city_id'] = explode('-',$request->rtoCity)[0];
                              $data['hdfcErgoCodeTw'] = $request->rtoTwHdfc;
                              $data['hdfcErgoCodeCar'] = $request->rtoCarhdfc;
                              $data['status'] = $request->rtoStatus;
                              $id = DB::table('rtoMaster')->insertGetId($data);
                              if($id){
                                   return Response::json(array('status'=>'success','message'=>"New RTO Created successfully"));
                              }else{
                                  return Response::json(array('status'=>'error','message'=>"Someting went wrong while "));
                              }
                    }
          }catch (Throwable $e) { 
              return response()->json(['status' =>'error','message'=>'Internal server error.']);
         }
     }
    
  
    
    
   
    
}
 

