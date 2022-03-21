
<div class="row mt-3 text-center">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <select class="select2 select-choose-model" style="width:100%">
            <option value="">Choose Model</option>
            @foreach($models as $_value)
             <option value="{{$_value->id}}">{{ucwords(strtolower($_value->modal))}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4"></div>
</div>

<div class="row mt-3 text-center">
 
	<?php if($count){
	    $rs =0; 
	     foreach ($models10 as $value) { 
    	     if($rs==0){ echo'<div class="col-md-1"></div>'; }?>
             	<div class="col-md-2 col-sm-2 model choose-model" data-animation="fadeInDown" data-delay="100" data-name="{{ucwords(strtolower($value->modal))}}" data-id="{{$value->id}}">
             	    <a  class="Chevrolet-pro br-all" style="border-radius: 8px;border: 1px solid #AC0F0B;" data-toggle="tooltip" data-placement="top"  title="{{ucwords(strtolower($value->modal))}}">  
                        <h4 style="font-weight: 700;">{{ucwords(strtolower($value->modal))}}</h4>
              	        <span class="hidden-xs"></span>
                     </a>
                </div>
             <?php  $rs++; if($rs==5){ echo'<div class="col-md-1"></div>';  $rs=0; }
         }
   ?>
   
 
</div>


<div class="row text-center term-iso-mt health-pro-a">
  <div class="col-md-6 col-sm-6">
    <a href="{{url('car-insurance/brand')}}" class="smoke-annual">Back</a>
  </div>
  <div class="col-md-6 col-sm-6">
    <a href="#" class="smoke-annual2 nextmodel">Next</a>
  </div>
</div>

<?php  }else{ ?>
    <div class="row text-center">
            <div class="col-md-3 col-sm-12"></div>
            <div class="col-md-6 col-sm-12">
               <div class="alert alert-warning">
                  <strong>Opps!</strong> Sorry We did'nt found any Models.
               </div>
            </div>
            <div class="col-md-3 col-sm-12"></div>
    </div>
<?php }?>

<script>$('.select2').select2();</script>