	<?php if($count){ ?>
<div class="row mt-3 text-center">
	    <?php $rs =0; 
	    foreach ($varients as $value) { 
    	     //if($rs==0){ echo'<div class="col-md-1"></div>'; }?>
              <div class="col-md-4 col-sm-4 variant choose-varient" data-cc="{{$value->cubic_capacity}}" data-animation="fadeInDown" data-fule="{{$value->fuel_type}}" data-delay="100" data-name="{{$value->variant}}" data-id="{{$value->id}}">
                    	<a  class="Chevrolet-pro br-all" style="border-radius: 8px;border: 1px solid #AC0F0B;" data-toggle="tooltip" data-placement="top"  title="{{$value->variant}}-{{$value->cubic_capacity}}cc">  
                        	<h4 style="font-weight: 700;white-space: nowrap;text-overflow: ellipsis;overflow: hidden;">{{$value->variant}}<br/>({{$value->fuel_type}})</h4>
                        	<span class="hidden-xs"></span>
                        </a>
            
            	</div>
             <?php  $rs++; //if($rs==5){ echo'<div class="col-md-1"></div>';  $rs=0; }
         } ?>
   
 
</div>

<div class="row text-center term-iso-mt health-pro-a">
  <div class="col-md-6 col-sm-6">
    <a href="#" id="backs"  class="smoke-annual">Back</a>
  </div>
  <div class="col-md-6 col-sm-6">
    <a href="#" class="smoke-annual2 nextvariant">Next</a>
  </div>
</div>

<?php  }else{ ?>
<div class="row mt-3 text-center">
    <div class="col-md-3 col-sm-12"></div>
    <div class="col-md-6 col-sm-12">
        <div class="alert alert-warning">
          <strong>Opps!</strong> Sorry We did'nt found any Varients.
       </div>
    </div>
    <div class="col-md-3 col-sm-12"></div>
       
</div>
<?php }?>