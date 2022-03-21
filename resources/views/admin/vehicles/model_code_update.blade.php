 <form class="" method="post" enctype="multipart/form-data" action="#" id="vehicleVarCodeForm" >
    <input name="_token" type="hidden" value="{{ csrf_token() }}" />
    <input name="vid"  id="vid" type="hidden" value="{{$vid}}" />
    <input name="typ"  id="typ" type="hidden" value="{{$typ}}" />
    <?php $id ="0";if(($typ=='Digit' || $typ=='FGI') && $typ!=""){
                if($typ=='Digit'){
                   $cntdigit = DB::table('vehicle_variant_code')->where(['variant_id'=>$vid,'supplier'=>"Digit"])->count();
                   if($cntdigit){
                     $digit = DB::table('vehicle_variant_code')->where(['variant_id'=>$vid,'supplier'=>"Digit"])->first();  
                     $value = $digit->code;
                     $id = $digit->id;
                   }else{ $value = ""; }
               }else if($typ=='FGI'){
                  $cntfg = DB::table('vehicle_variant_code')->where(['variant_id'=>$vid,'supplier'=>"FGI"])->count();
                  if($cntfg){
                     $fg = DB::table('vehicle_variant_code')->where(['variant_id'=>$vid,'supplier'=>"FGI"])->first(); 
                     $value = $fg->code;
                      $id = $fg->id;
                  }else{ $value = "";}
               }else{
                   $value ="";
               } 
    ?>
    
    <div class="row">
       <div class="col-lg-12 col-md-12">
            <div class="form-group">
              <input class="form-control" type="text" required id="InputvehicleCode" name="InputvehicleCode" value="{{$value}}"  placeholder="Enter Code for {{$typ}}">
              <input type="hidden" id="InputvehicleCodeId" name="InputvehicleCodeId" value="{{$id}}">
            </div>
       </div>
    </div>
    <div class="row mt-3">
        <div class="col-lg-8 col-md-8"></div>
        <div class="col-lg-4 col-md-4">
            <button class="btn btn-info vehicleVarCodeUpdateBtn" type="button">Update</button>
        </div>
    </div>
<?php } ?>
 </form>