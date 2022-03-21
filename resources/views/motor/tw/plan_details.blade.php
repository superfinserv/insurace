<?php $plan_details[$id];
   //print_r($plan_details[$id]['contract']['coverages']);
?>
<div data-v-c38a4fd4="" class="premium-popup">
   <div data-v-c38a4fd4="" class="premium-popup-lside">
      <?php if($id=="godigit"){ ?>
         <img data-v-c38a4fd4="" src="{{asset('img/plan_image/digit.jpg')}}" class="ppl__insurer-logo">
      <?php }?>
      
      <div data-v-c38a4fd4="" class="ppl__idv-value">
         Cover Value(IDV) : <span class="fa fa-inr"></span></span><span data-v-c38a4fd4=""><?php  $vehicleIDV=number_format(intval(str_replace('INR', '', $plan_details[$id]['vehicle']['vehicleIDV']['idv']))); echo $vehicleIDV;?></span>
      </div>
      <div data-v-c38a4fd4="">
         <hr data-v-c38a4fd4="">
         <div data-v-c38a4fd4="" class="ppl__idv-value">
            New No Claim Bonus <br data-v-c38a4fd4="">(NCB): <span data-v-c38a4fd4=""><?php
           
              if(isset($plan_details[$id]['discounts']['otherDiscounts'])){ 
                foreach ($plan_details[$id]['discounts']['otherDiscounts'] as $values){ 
                          if($values['discountType']=='NCB_DISCOUNT'){ echo $values['discountPercent'].'%';  }} }else{ echo '0%';}?></span>
         </div>
      </div>
      <button data-v-c38a4fd4="" class="btn btn--basedark ppl__buy-btn recalculate">
         <span data-v-c38a4fd4="">
            buy now
            <div data-v-c38a4fd4="" class="ppl__buy-btn-value "> <span class="fa fa-inr"></span> </span><span data-v-c38a4fd4=""><?php $netPremium=number_format(intval(str_replace('INR', '', $plan_details[$id]['netPremium']))); echo $netPremium;?></span>
            </div>
         </span>
      </button>
   </div>
   <div class="plan_list_details">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a href="#Premium_Breakup" class="nav-link active" data-toggle="tab">Premium Breakup</a>
        </li>
       
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade show active" id="Premium_Breakup">
         <p>
        <?php $count=1;

        foreach ($plan_details[$id]['contract']['coverages'] as $cover){ 

          if($cover['coverType']=='THIRD_PARTY'){ ?>
             <h3> Basic Cover</h3>
         
         <?php // print_r($plan_details[$id]['contract']['coverages'][0]['selection']); 
         if($cover['selection']=='true'){ ?>
             <div class="row">
         
             <?php foreach ($cover['subCovers'] as $subCovers){ ?>

                          <?php if($subCovers['selection']=='true'){ 
                          
                           ?>
                           <div class="col-md-5">Basic TP Premium
                           </div><div class="col-md-5 text-right"><span class="fa fa-inr"></span> {{number_format(intval(str_replace('INR', '',$subCovers['netPremium'])))}}</div>
                        
                  <?php } ?>
            <?php }  


          }?>

         </div>
         <?php  }  
          if($cover['coverType']=='OWN_DAMAGE'){ ?>
        <?php if($cover['selection']=='true'){ ?>
             <div class="row">
             
                           <div class="col-md-5">Basic OD Premium
                           </div><div class="col-md-5 text-right"><span class="fa fa-inr"></span> {{number_format(intval(str_replace('INR', '',$cover['netPremium'])))}}</div>
                        
                 
         </div>
      
         <?php  } } ?>
         </p>
         <p>
          
         <?php if($cover['coverType']=='ADDONS'){ ?>  
           <h3>Addon Covers</h3>
         <?php if($cover['selection']=='true'){ ?>
             <div class="row">
             <?php foreach ($cover['subCovers'] as $values){ ?>

                          <?php if($values['selection']=='true'){ 
                          
                           ?>
                           <div class="col-md-5">{{$values['name']}}
                           </div><div class="col-md-5 text-right"><span class="fa fa-inr"></span>{{number_format(intval(str_replace('INR', '',$values['netPremium'])))}}</div>
                        
                  <?php } ?>
            <?php } ?>
         </div>
         <?php  }else{
            echo '<p> NO Addons Cover</p>';
         } } ?>
          
          </p>
           <p>
          
         <?php if($cover['coverType']=='OWN_DAMAGE' ){ ?> 
          <?php if($cover['selection']=='true'){ ?> 
           <h3>Accessories Cover</h3>

        
             <div class="row">
             <?php foreach ($cover['subCovers'] as $values){ ?>

                          <?php if($values['selection']=='true'){ 
                          
                           ?>
                           <div class="col-md-5">{{$values['name']}}
                           </div><div class="col-md-5 text-right"><span class="fa fa-inr"></span>{{number_format(intval(str_replace('INR', '',$values['netPremium'])))}}</div>
                        
                  <?php } ?>
            <?php } ?>
         </div>
         <?php  } }  ?>
         
          </p>
          <p>
          
         <?php if($cover['coverType']=='PA_OWNER' || $cover['coverType']=='PA_UNNAMED' || $cover['coverType']=='LEGAL_LIABILITY' ){ 
          if($count==1) { ?><h3>Additional Cover</h3><?php   $count++; }?>
          <?php if($cover['selection']=='true'){ ?>  
            
             <div class="row">
             <?php foreach ($cover['subCovers'] as $values){ ?>

                          <?php if($values['selection']=='true'){ 
                          
                           ?>
                           <div class="col-md-5">{{$values['name']}}
                           </div><div class="col-md-5 text-right"><span class="fa fa-inr"></span>{{number_format(intval(str_replace('INR', '',$values['netPremium'])))}}</div>
                        
                  <?php } ?>
            <?php } ?>
         </div>
         <?php  } } ?>
         
          </p>
        <?php }?>
          <p>
         <h3>Discount</h3>
         <?php // print_r($plan_details[$id]['contract']['coverages'][0]['selection']); 
         if(isset($plan_details[$id]['discounts']['otherDiscounts'])){ ?>
             <div class="row">
             <?php  foreach ($plan_details[$id]['discounts']['otherDiscounts'] as $values){ 
                              if($values['discountPercent']){ ?>
                          
                           <div class="col-md-5">{{str_replace('_', ' ',$values['discountType'])}}
                           </div><div class="col-md-5 text-right"><span class="fa fa-inr"></span>{{number_format(intval(str_replace('INR', '',$values['discountAmount'])))}}</div>
                        
                 
            <?php }else{?>
                          <div class="col-md-5">{{str_replace('_', ' ',$values['discountType'])}}
                           </div>
                           <div class="col-md-5 text-right"><span class="fa fa-inr"></span>{{number_format(intval(str_replace('INR', '',$values['discountAmount'])))}}</div>
               
            <?php } }?>
         </div>
         <?php  }else{ echo '<p>No Discount</p>';} ?>

         </p>
         <hr>
        
         <div class="row">
          
                          
                           <div class="col-md-5"> <h3>Premium:</h3>
                           </div><div class="col-md-5 text-right"><span class="fa fa-inr"></span><?php $netPremium=number_format(intval(str_replace('INR', '', $plan_details[$id]['netPremium']))); echo $netPremium;?></div>
                        
                 
           
         </div>
          <hr>
          <p>
         <h3>Taxes</h3>
         <?php // print_r($plan_details[$id]['contract']['coverages'][0]['selection']); 
         if($plan_details[$id]['serviceTax']){ ?>
             <div class="row">
            
                          
                           <div class="col-md-5">GST
                           </div><div class="col-md-5 text-right"><span class="fa fa-inr"></span><?php $serviceTax=number_format(intval(str_replace('INR', '', $plan_details[$id]['serviceTax']['totalTax']))); echo $serviceTax;?></div>
                        
                 
           
         </div>
         <?php  } ?>

         </p>
        
         <hr>
        <p>
         <div class="row">
          
                          
                           <div class="col-md-5"> <h3>Total Amount:</h3>
                           </div><div class="col-md-5 text-right"><span class="fa fa-inr"></span> <?php $total_amount=intval(str_replace('INR', '', $plan_details[$id]['serviceTax']['totalTax']))+intval(str_replace('INR', '', $plan_details[$id]['netPremium'])); echo  number_format($total_amount);?></div>
                        
         </div>
          <hr>
          </p>
       
      
    </div>
</div>
  
</div>
<style type="text/css">
   .premium-popup-lside[data-v-c38a4fd4] {
    width: 215px;
    border-radius: 4px 0 0 4px;
    background-color: #fff;
    box-shadow: 4px 0 12px 0 rgba(0,0,0,.12);
    padding: 20px 20px 20px 15px;
    z-index: 3;
    float: left;
}
.plan_list_details{
   width: 480px;
   float: left;
   font-size: 15px;
}
.tab-content h3 {
    font-weight: 600;
}
.nav-tabs .nav-item {
    margin-bottom: -1px;
    text-align: center;
    width: 100%;
}
.tab-content>.active {
    display: block;
    opacity: 1;
    padding: 18px;
}
.premium-popup-rside[data-v-c38a4fd4] {
    width: 689px;
}
.ppl__insurer-logo[data-v-c38a4fd4] {
    max-height: 60px;
    margin-bottom: 5px;
    max-width: 185px;
}
.ppl__idv-value[data-v-c38a4fd4] {
    color: rgba(49,68,81,.7);
    font-weight: 500;
    font-size: 13px;
}
.ppl__idv-value span[data-v-c38a4fd4] {
    color: #314451;
    font-weight: 700;
}
.ppl__idv-value span[data-v-c38a4fd4] {
    color: #314451;
    font-weight: 700;
}
.ppl__idv-value[data-v-c38a4fd4] {
    color: rgba(49,68,81,.7);
    font-weight: 500;
    font-size: 13px;
}
.ppl__idv-value span[data-v-c38a4fd4] {
    color: #314451;
    font-weight: 700;
}
.ppl__buy-btn[data-v-c38a4fd4] {
    width: 100%;
    padding: 8px;
    line-height: 1.3;
    margin: 30px 0 40px;
    text-transform: uppercase;
    font-size: 14px;
}
.btn--basedark {
    background: #314451;
    color: #fff;
    border: 1px solid #314451;
}
.jconfirm .jconfirm-box div.jconfirm-closeIcon {
    height: 29px;
    width: 30px;
    position: fixed;
    top: -2px;
    right: -28px;
    cursor: pointer;
    opacity: .6;
    text-align: center;
    font-size: 40px !important;
    line-height: 14px !important;
    display: none;
    z-index: 10;
    opacity: 999999999999999 !important;
    /* background: #77686869; */
    right: 0px;
    top: -21px;
    background: #fff;
    line-height: 1.5;
    border: 1px solid #888;
    z-index: 3;
    border-radius: 50%;
}
.jconfirm .jconfirm-box div.jconfirm-content-pane{
       margin-top: -15px;
}
.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
    border-bottom: 2px solid #af433f;
    color: #b7413f !important;
}
.jconfirm .jconfirm-box div.jconfirm-title-c {
    display: none !important;
}
</style>