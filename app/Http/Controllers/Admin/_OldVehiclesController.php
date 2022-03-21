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

class OldVehiclesController extends Controller
{
     public function __construct() { 
       // $this->appUtil = $appUtil; 
        $this->middleware('auth');
     }

    public function index(){
        $template = ['title' => 'Vehicles::List',"subtitle"=>"Vehicles List",
                     'scripts'=>[asset('admin/js/page/vehicles.js')]];
        return View::make('admin.vehicles.list')->with($template);
    }
    
    public function getVehiclesdatatable(Request $request){
       //$whr = array();$like=array();$or_like=array();$likeArr=array(); 
        $columns = array(0 =>'vehicle_variant.id', 1 =>'vehicle_make.make', 2 =>'vehicle_modal.modal',3=>'vehicle_variant.variant',4=>'vehicle_make.vehicle_type',5=>'vehicle_variant.body_type'); 
        $limit = $request->length;
        $start = $request->start;
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        
        $MakeName    = ($request->input('columns.0.search.value'))?:"";
        $ModelName   = ($request->input('columns.1.search.value'))?:"";
        $VarientName = ($request->input('columns.2.search.value'))?:"";
        $vehicleCode = ($request->input('columns.3.search.value'))?:"";
        $vehicleType = ($request->input('columns.4.search.value'))?:"";
       // DB::enableQueryLog();
        $query = DB::query();
        $query = DB::table('vehicle_variant')->join('vehicle_modal', 'vehicle_modal.id', '=', 'vehicle_variant.modal_id')
                                             ->join('vehicle_make', 'vehicle_make.id', '=', 'vehicle_variant.make_id');
        $query->select('vehicle_variant.*','vehicle_make.make as make_name','vehicle_make.vehicle_type as make_vehicle_type','vehicle_modal.modal as modal_name')
                ->when($vehicleCode, function ($query, $vehicleCode) {
                    return $query->where('vehicle_variant.digit_code','like', '%'.$vehicleCode.'%')
                                 ->orwhere('vehicle_variant.fgi_code','like', '%'.$vehicleCode.'%');
                })
               ->when($VarientName, function ($query, $variantName) {
                    return $query->where('vehicle_variant.variant','like', '%'.$variantName.'%');
                })
               ->when($ModelName, function ($query, $ModelName) {
                    return $query->where('vehicle_modal.modal','like', '%'.$ModelName.'%');
                })
                 ->when($MakeName, function ($query, $MakeName) {
                    return $query->where('vehicle_make.make','like', '%'.$MakeName.'%');
                })
                 ->when($vehicleType, function ($query, $vehicleType) {
                    return $query->where('vehicle_make.vehicle_type','like', '%'.$vehicleType.'%');
                });
              
        $totalFiltered =$query->count();
       // $query->orderBy('id','ASC')
        $vehicles =  $query->orderBy($order, $dir)
            ->offset($start)
            ->limit($limit)->get();
           
        $totalRecords =  DB::table('vehicle_variant')->count();
        $result=[];$i=($start+1);
         foreach($vehicles as $each){
                
                $eachData=array();
                $eachData['sno']          = $i;
                $eachData['make']         = '<a href="'.url('vehicle/view/'.$each->id).'">'.trim($each->make_name).'</a>';
                $eachData['modal']        = trim($each->modal_name);
                $eachData['variant']      = trim($each->variant);    
                $eachData['vehicle_type'] = $each->make_vehicle_type;
                $eachData['body_type']    = $each->body_type;
                $eachData['digit_code']   = $each->digit_code;
                $eachData['fgi_code']     = $each->fgi_code;
                $eachData['make_id']     = $each->make_id;
                $eachData['modal_id']     = $each->modal_id;
                $eachData['varient_id']     = $each->id;
                
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
   
     public function viewDeatils(Request $request){
        // $variant = DB::table('vehicle_variant')->where('id','=',$request->id)->first();
        // $make   = DB::table('vehicle_make')->where('id','=',$variant->make_id)->first();
        
        $query = DB::query();
        $query = DB::table('vehicle_variant')->join('vehicle_modal', 'vehicle_modal.id', '=', 'vehicle_variant.modal_id')
                                             ->join('vehicle_make', 'vehicle_make.id', '=', 'vehicle_variant.make_id')
                                             ->where('vehicle_variant.id','=',$request->id);
        $query->select('vehicle_variant.*','vehicle_make.make as make_name','vehicle_make.image as makeImg','vehicle_make.vehicle_type as make_vehicle_type','vehicle_modal.modal as modal_name');
        $data =  $query->first();
        
        $template = ['title' => 'Vehicles::List',"subtitle"=>"Vehicles List",'data'=>$data,
                     'scripts'=>[asset('admin/js/page/vehicle-view.js')]];
        return View::make('admin.vehicles.view')->with($template);
    }
    
     public function uploadFiles(Request $request){
         if($request->param=='make'){
            if(!empty($request->file('makeImage'))) {
                $data = DB::table('vehicle_make')->where('id','=',$request->id)->first();
                $oldfile = $data->image;
                $fileName = uniqid().$request->id.'.'.request()->makeImage->getClientOriginalExtension();
                $request->makeImage->move("public/assets/vehicles/", $fileName);
                DB::table('vehicle_make')->where('id',$request->id)->update(['image'=>$fileName]);
                    if(true){ 
                        if($oldfile!='' && $oldfile!="avatar.png"){
                            $image_path = "public/assets/vehicles/".$oldfile;
                            if(File::exists($image_path)) { File::delete($image_path); }
                        }
                       return response()->json(['status'=>'success','filename'=>$fileName,'message'=>'Brand image has been uploaded successfully']);
                    }else {
                     return response()->json(['status'=>'error','message'=>'Something went wrong while upload']);
                    }
            }
         }
     }
    
   
    public function sortableMake(){
        $pvtCars = DB::table('vehicle_make')->where('vehicle_type','=',"Pvt Car")->orderBy('serial_no','ASC')->get();
        $bikes   = DB::table('vehicle_make')->where('vehicle_type','MotorBike')->orWhere('vehicle_type','Scooter')->orderBy('serial_no','ASC')->get();
        $pcs     = DB::table('vehicle_make')->where('vehicle_type','Passenger Carrying')->orderBy('serial_no','ASC')->get();
        $gcs     = DB::table('vehicle_make')->where('vehicle_type','Goods Carrying')->orderBy('serial_no','ASC')->get();
        $template = ['title' => 'Vehicles::Make',"subtitle"=>"Vehicles Make Sortable",'pvtCars'=>$pvtCars,'bikes'=>$bikes,'pcs'=>$pcs,'gcs'=>$gcs,
                     'scripts'=>[asset('admin/js/page/vehicles-make-sortable.js')]];
        return View::make('admin.vehicles.make-sortable')->with($template);
    }
   
    public function updateMakeSerialNumber(Request $request){
      $serial=1;
       foreach($request->data as $key=>$value){
            $arr = explode("-",$value);
            DB::table('vehicle_make')
              ->where('id', $arr[1])
              //->where('vehicle_type',$request->vehicle_type)
              ->update(['serial_no' => $serial]);
           
           $serial++;
       }
   }
   
    public function sortableModals(Request $request){
       $count  = DB::table('vehicle_modal')->where('make_id',$request->make)->count();
       if($count){
           $make = DB::table('vehicle_make')->where('id',$request->make)->first();
           $data  = DB::table('vehicle_modal')->where('make_id',$request->make)->orderBy('serial_no','ASC')->get();
           $template = ['title' => 'Vehicles::Modals',"subtitle"=>"Vehicles Modals Sortable",'data'=>$data,'make'=>$make,
                         'scripts'=>[asset('admin/js/page/vehicles-modal-sortable.js')]];
            return View::make('admin.vehicles.modal-sortable')->with($template);
       }
    }
    
    public function updateModalSerialNumber(Request $request){
      $serial=1;
       foreach($request->data as $key=>$value){
            $arr = explode("-",$value);
            DB::table('vehicle_modal')
              ->where('id', $arr[1])
              ->where('make_id', $request->make)
              ->update(['serial_no' => $serial]);
           
           $serial++;
       }
   }
   
    public function brands(){
        $brands = DB::table('brands')->orderBy('type', 'ASC')->get();
        $template = ['title' => 'Vehicles:: Brand',"subtitle"=>"ADD & VIEW Brands",'brands'=>$brands,
                     'scripts'=>[asset('admin/js/page/vehicle-brands.js')]];
        return View::make('admin.vehicles.brands')->with($template);
    }
    
    public function getBrandsdatatable(Request $request){
        $columns = array(  0 =>'id', 1 =>'first_name',2=>'last_name' ,'3'=>'email','3'=>'is_active'); 
        $limit = $request->length;
        $start = $request->start;
        
        // $order = $columns[$request->input('order.0.column')];
        // $dir = $request->input('order.0.dir');
        //$query = DB::query();
         $brandName = ($request->input('columns.0.search.value'))?:"";
         $brandType = ($request->input('columns.1.search.value'))?:"";
           
        $query = DB::table('brands');
        $query->select('*')
              ->when($brandName, function ($query, $brandName) {
                    return $query->where('brand','like', '%'.$brandName.'%');
                })
              ->when($brandType, function ($query, $brandType) {
                   // return $query->where('type', "=",$brandType);
                    return $query->whereRaw("find_in_set('".$brandType."',type)");
                });
        $totalFiltered = $query->count();
        $brands = $query->orderBy('id','DESC')
            ->offset($start)
            ->limit($limit)->get();
        $totalRecords =  DB::table('brands')->count();
        $result=[];$i=1;
         foreach($brands as $each){
                $icon = $this->appUtil->getAssets('vehicles/'.$each->brand_logo);
                $eachData=array();
                $eachData['sno']          = "<strong>".$i."</strong>";
                $eachData['brand']        = $each->brand;
                $eachData['icon']         = "<img src='".$icon."' style='width:50px;height:50px;box-shadow: 4px 4px 5px #ccc;'/>";
                $eachData['type']         = $each->type;
                
                $eachData['status'] =($each->status)?'<div class="d-flex justify-content-between align-items-center  btn-testAllow" data-name="'.$each->brand.'" data-id="'.$each->id.'" data-status="'.$each->status.'"><span class="bg-success pd-y-3 pd-x-10 tx-white tx-11 tx-roboto">Active</span> </div>'
                                                                 :'<div class="d-flex justify-content-between align-items-center  btn-testAllow" data-name="'.$each->brand.'" data-id="'.$each->id.'" data-status="'.$each->status.'"><span class="bg-danger pd-y-3 pd-x-10 tx-white tx-11 tx-roboto">Inactive</span> </div>';
              
                $buttons =' <div data-id="'.$each->id.'" data-name="'.$each->brand.'" >
                  <a href="#" data-id="'.$each->id.'" data-name="'.$each->brand.'"  class="btn btn-primary  btn-icon mg-r-5 mg-b-10 edit"><div><i class="icon ion-gear-a"></i></div></a>
                  <a href="'.url('/agentinfo/'.$each->id).'" class="btn btn-dark btn-icon mg-r-5 mg-b-10"><div><i class="icon ion-clipboard"></i></div></a>
                
              </div>';
              //if($this->appUtil->hasPermission('cat_2')){ 
                $eachData['action']          = '-';//$buttons;  
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
    
    public function brandSave(Request $request){
        $data=[];
        if($request->hasFile('brandlogoFile')){
             $avatarName = uniqid().$this->appUtil->clean($request->brandName).'.'.request()->brandlogoFile->getClientOriginalExtension();
             $request->brandlogoFile->move(dirname(getcwd(),1)."/insassets/vehicles/", $avatarName);
              $data['brand_logo'] = $avatarName;
         }else{
            $data['brand_logo'] = "";
        }
      $data['brand']=strtoupper($request->brandName);
      $data['type']=implode(',',$request->brandType);
      //print_r($data);
      $id = DB::table('brands')->insertGetId($data);
      if($id){
          return redirect('vehicle/brands')->with('message', 'success');
        }else{
          return redirect('vehicle/brands')->with('error', 'error');
        }
  } 
    
    public function models(){
        $brands = DB::table('brands')->orderBy('type', 'ASC')->get();
        $template = ['title' => 'Vehicles',"subtitle"=>"ADD & VIEW Models",'brands'=>$brands,
                     'scripts'=>[asset('admin/js/page/vehicle-models.js')]];
        return View::make('admin.vehicles.models')->with($template);
    }
    
    public function getModelsdatatable(Request $request){
        $whr = array();$like=array();$or_like=array();$likeArr=array(); 
        $columns = array(  0 =>'id', 1 =>'first_name',2=>'last_name' ,'3'=>'email','3'=>'is_active'); 
        $limit = $request->length;
        $start = $request->start;
        
        $modelName = ($request->input('columns.0.search.value'))?:"";
        $brandName = ($request->input('columns.1.search.value'))?:"";
        $brandType = ($request->input('columns.2.search.value'))?:"";
        
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $query = DB::query();
        $query = DB::table('models')->join('brands', 'models.brand_id', '=', 'brands.id');
        $query->select('models.*','brands.brand')
               ->when($modelName, function ($query, $modelName) {
                    return $query->where('models.model','like', '%'.$modelName.'%');
                })
                ->when($brandName, function ($query, $brandName) {
                    return $query->where('brands.brand','like', '%'.$brandName.'%');
                })
              ->when($brandType, function ($query, $brandType) {
                    return $query->where('models.type', "=",$brandType);
                });
        $totalFiltered = $query->count();
        $brands = $query->orderBy("id","DESC")
            ->offset($start)
            ->limit($limit)->get();
        $totalRecords =  DB::table('models')->count();
        $result=[];$i=1;
         foreach($brands as $each){
                $eachData=array();
                $eachData['sno']          = "<strong>".$i."</strong>";
                $eachData['brand']        = $each->brand;
                $eachData['model']        = $each->model;
                 $eachData['type']         = $each->type;
                 //'<div class="d-md-flex pd-y-20 pd-md-y-0">
            //             <select class="" data-id="'.$each->id.'" id="typ-'.$each->id.'" >
            //                     <option value="">-Type-</option>
            //                      <option value="Bike" '.($each->type =='Bike' ? 'selected': '').'>Bike</option>
            //                     <option value="Bus" '.($each->type =='Bus' ? 'selected': '').'>Bus</option>
            //                     <option value="Car" '.($each->type =='Car' ? 'selected': '').'>Car</option>
            //                     <option value="Tractor" '.($each->type =='Tractor' ? 'selected': '').'>Tractor</option>
            //                     <option value="Taxi" '.($each->type =='Taxi' ? 'selected': '').'>Taxi</option>
            //                     <option value="Goods" '.($each->type =='Goods' ? 'selected': '').'>Goods</option>
            //             </select>
            //   <button class="btn btn-info btn-sm update-cat" data-id="'.$each->id.'"><i class="fa fa-check"></i></button>
           // </div>';//$each->type;
                $eachData['status'] =($each->status)?'<div class="d-flex justify-content-between align-items-center  btn-testAllow" data-name="'.$each->brand.'" data-id="'.$each->id.'" data-status="'.$each->status.'"><span class="bg-success pd-y-3 pd-x-10 tx-white tx-11 tx-roboto">Active</span> </div>'
                                                                 :'<div class="d-flex justify-content-between align-items-center  btn-testAllow" data-name="'.$each->brand.'" data-id="'.$each->id.'" data-status="'.$each->status.'"><span class="bg-danger pd-y-3 pd-x-10 tx-white tx-11 tx-roboto">Inactive</span> </div>';
              
                $buttons =' <div data-id="'.$each->id.'" data-name="'.$each->brand.'" >
                  <a href="#" data-id="'.$each->id.'" data-name="'.$each->brand.'"  class="btn btn-primary  btn-icon mg-r-5 mg-b-10 edit"><div><i class="icon ion-gear-a"></i></div></a>
                  <a href="'.url('/agentinfo/'.$each->id).'" class="btn btn-dark btn-icon mg-r-5 mg-b-10"><div><i class="icon ion-clipboard"></i></div></a>
                
              </div>';
              //if($this->appUtil->hasPermission('cat_2')){ 
                $eachData['action']          = '-';//$buttons;  
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
   
   function updateCatModel(Request $request){
       if($request->typ!="" && $request->id!=""){
           DB::table('models')
            ->where('id',$request->id)
            ->update(['type' => $request->typ]);
            return Response::json(array('status'=>'success'));
        }else{
             return Response::json(array('status'=>'error'));
        }
   }
   
    public function modelSave(Request $request){
      $data['brand_id']=$request->brand;
      $data['model']=strtoupper($request->modelName);
      $data['type']=ucfirst($request->type);
      
      $id = DB::table('models')->insertGetId($data);
      if($id){
          return redirect('vehicle/models')->with('message', 'success');
        }else{
          return redirect('vehicle/models')->with('error', 'error');
        }
  } 
  
    public function variants(){
        $brands = DB::table('brands')->orderBy('type', 'ASC')->get();
        //$models = DB::table('models')->where('status', '1')->get();
        $body_types = DB::table('vehicle_body_types')->where('status', '1')->get();
        $template = ['title' => 'variants',"subtitle"=>"ADD & VIEW variants",'brands'=>$brands,'body_types'=>$body_types,
                     'scripts'=>[asset('admin/js/page/vehicle-variants.js')]];
        return View::make('admin.vehicles.variants')->with($template);
    }
    
    public function variantSave(Request $request){
      $isDGCode = false;$isFGCode = false;
      if($request->DigitCode!=""){ 
           $hasDG = DB::table('vehicle_variant_code')->where(['supplier'=>"Digit" ,'code'=>$request->DigitCode])->count();
           $isDGCode = ($hasDG>0)?true:false;
      }
      if($request->DigitCode!=""){ 
           $hasFG = DB::table('vehicle_variant_code')->where(['supplier'=>"FG" ,'code'=>$request->FgCode])->count();
           $isFGCode = ($hasFG>0)?true:false;
      }
      
      if($isDGCode){
          return Response::json(array('status'=>'error','message'=>"Digit vehicle code [".$request->DigitCode."] is already exist!"));
      }else if($isFGCode){
          return Response::json(array('status'=>'error','message'=>"Future Genrali vehicle code [".$request->DigitCode."] is already exist!"));
      }else{
          $data['brand_id']=$request->brand;
          $data['model_id']=$request->model;
          $data['variant'] = $request->VariantName;
          $data['fuel_type']=$request->fuelType;
          $data['no_of_wheels']=$request->no_of_wheels;
          $data['seating_capacity']=$request->no_of_seating;
          $data['body_type']=$request->bodyType;
          $data['status'] =1;
          $id = DB::table('vehicle_variant')->insertGetId($data);
          if($id){
             if($request->DigitCode!=""){ DB::table('vehicle_variant_code')->insertGetId(['variant_id'=>$id,'supplier'=>"Digit" ,'code'=>$request->DigitCode]); }
             if($request->FgCode!=""){    DB::table('vehicle_variant_code')->insertGetId(['variant_id'=>$id,'supplier'=>"FGI" ,'code'=>$request->FgCode]); }
                 return Response::json(array('status'=>'success','message'=>"Variant created successfully"));
              }else{
                  return Response::json(array('status'=>'error','message'=>"Someting went wrong while create variant"));
              }
      }
    }
    
    public function getVariantsdatatable(Request $request){
        $whr = array();$like=array();$or_like=array();$likeArr=array(); 
        $columns = array(  0 =>'id', 1 =>'first_name',2=>'last_name' ,'3'=>'email','3'=>'is_active'); 
        $limit = $request->length;
        $start = $request->start;
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        
        $variantName = ($request->input('columns.0.search.value'))?:"";
        $modelName   = ($request->input('columns.1.search.value'))?:"";
        $brandName   = ($request->input('columns.2.search.value'))?:"";
        $vehicleCode = ($request->input('columns.3.search.value'))?:"";
       // DB::enableQueryLog();
        $query = DB::query();
        $query = DB::table('vehicle_variant')->join('models', 'models.id', '=', 'vehicle_variant.model_id')->join('brands', 'models.brand_id', '=', 'brands.id');
        $query->select('vehicle_variant.*','brands.brand','models.model')
                ->when($vehicleCode, function ($query, $vehicleCode) {
                    return $query->join('vehicle_variant_code', 'vehicle_variant_code.variant_id', '=', 'vehicle_variant.id')
                                ->where('vehicle_variant_code.code','like', '%'.$vehicleCode.'%');
                })
                
               ->when($variantName, function ($query, $variantName) {
                    return $query->where('vehicle_variant.variant','like', '%'.$variantName.'%');
                })
               ->when($modelName, function ($query, $modelName) {
                    return $query->where('models.model','like', '%'.$modelName.'%');
                })
                 ->when($brandName, function ($query, $brandName) {
                    return $query->where('brands.brand','like', '%'.$brandName.'%');
                });
              
        $totalFiltered =$query->count();
        $brands = $query->orderBy('id','DESC')
            ->offset($start)
            ->limit($limit)->get();
           
        $totalRecords =  DB::table('vehicle_variant')->count();
        $result=[];$i=1;
         foreach($brands as $each){
                $digit = DB::table('vehicle_variant_code')->where(['variant_id'=>$each->id,'supplier'=>"Digit"])->first();
                $fg = DB::table('vehicle_variant_code')->where(['variant_id'=>$each->id,'supplier'=>"FGI"])->first();
                $strCode="";
                
                $eachData=array();
                $eachData['variant']         = $each->variant;
                $eachData['brand']        = $each->brand;
                $eachData['model']         = $each->model;    
                $eachData['seat']         = $each->seating_capacity;
                $eachData['wheels']         = $each->no_of_wheels;
                $eachData['fuel']         = $each->fuel_type;
                $eachData['body']         = $each->body_type;
                $digitcode = ($digit)?$digit->code:"<u>Null</u>";
                $fgcode = ($fg)?$fg->code:"<u>Null</u>";
                $eachData['Digit_code']= '<a class="pd-x-5" href="#">'.$digitcode.'<i data-typ="Digit" data-vid="'.$each->id.'" class="edit-code icon ion-edit"></i></a>';
                $eachData['FG_code']='<a class="pd-x-5" href="#">'.$fgcode.'<i data-typ="FGI" data-vid="'.$each->id.'" class="edit-code icon ion-edit"></i></a>';
                $eachData['status'] =($each->status)?'<div class="align-items-center  btn-status" data-name="'.$each->variant.'" data-id="'.$each->id.'" data-status="'.$each->status.'"><span class="bg-success pd-y-3 pd-x-10 tx-white tx-11 tx-roboto">Active</span> </div>'
                                                                 :'<div class="d-flex justify-content-between align-items-center  btn-status" data-name="'.$each->variant.'" data-id="'.$each->id.'" data-status="'.$each->status.'"><span class="bg-danger pd-y-3 pd-x-10 tx-white tx-11 tx-roboto">Inactive</span> </div>';
              
                $buttons =' <div data-id="'.$each->id.'" data-name="'.$each->variant.'" >
                  <a href="#" data-id="'.$each->id.'" data-name="'.$each->variant.'"  class="btn btn-danger btn-delete btn-icon mg-r-5 mg-b-10"><div><i class="icon ion-trash-a"></i></div></a>
                  
                
              </div>';
              //if($this->appUtil->hasPermission('cat_2')){ 
                $eachData['action']          = $buttons;  
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
   
    public function varientcodeUpdateModel(Request $request){
         if($request->vid!=""){
            $template['vid'] = $request->vid;
            $template['typ'] = $request->typ;
            return View::make('admin.vehicles.model_code_update')->with($template);
         }else{echo "Invalid Access";}
    }
    
    public function varientcodeUpdate(Request $request){
        if($request->vid){
            if(isset($request->typ) && $request->typ!=""){
                if($request->InputvehicleCodeId!="" && $request->InputvehicleCodeId!="0"){
                    DB::table('vehicle_variant_code')->where(['id'=>$request->InputvehicleCodeId,'variant_id'=>$request->vid])
                                                     ->update(['code'=>$request->InputvehicleCode]); 
                   return Response::json(array('status'=>'success','message'=>'Vehicle code updated successfully!'));
                }else{
                    DB::table('vehicle_variant_code')->insertGetId(['variant_id'=>$request->vid,'supplier'=>$request->typ ,'code'=>$request->InputvehicleCode]);
                    return Response::json(array('status'=>'success','message'=>'Vehicle code added successfully!'));
                }
            }else{
                 return Response::json(array('status'=>'error','message'=>'Something went wrong while updating vehicle code!'));
            }
        }else{
             return Response::json(array('status'=>'error','message'=>'Something went wrong while updating vehicle code!'));
        }
    }
   
    public function UpdatevariantStatus(Request $request){
      $var = DB::table('vehicle_variant')->where('id',$request->id)->update(['status'=>$request->status]);
      return Response::json(array('status'=>'success'));
    }
    
    public function deleteVehicleData(Request $request){
          $id = $request->id;
          $type = $request->type;
          if($type=='variant'){
              DB::table('vehicle_variant_code')->where('variant_id',$id)->delete();
              DB::table('vehicle_variant')->where('id',$id)->delete();
              return Response::json(array('status'=>'success'));
          }else{
              return Response::json(array('status'=>'error'));
          }
      }
}
 

