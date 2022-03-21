 @extends($layout)
@section('content')
<style>
.card-userinfo{
      box-shadow: 0 2px 4px 0 rgba(0,0,0,.2), 0 -1px 0 0 rgba(0,0,0,.03);
}
.media-input-container{
         border: 1px solid #AC0F0B;
            padding: 0px 5px 1px 5px;
            /*margin-bottom: 15px;*/
            border-radius: 8px;
            box-shadow: 0px 0px 10px #ccc;
    }
.media-input-container .mediainput{
        margin-bottom:0px;
    }
.media-input-container .mediainput.input-multi{
     padding: 5px 1px;   
    }
.media-input-container .mediainput li{
           display: inline-block;
    }
.media-input-container .mediainput.input-single li{ width:100%; }
.media-input-container .mediainput li input,.media-input-container .mediainput li select{
    height: auto;margin-bottom: 0px;box-shadow: none;width:100%;font-size: 14px;outline: none;border: none;
}
.media-input-container .mediainput.input-single-select{padding:5px 1px;}
.th-border{
   /*border: 1px solid #AC0F0B;*/
        padding: 5px 10px 5px 40px;
        display: block;
        position: relative;
        /* padding-left: 30px; */
        /*margin-bottom: 15px;*/
        cursor: pointer;
        font-size: 18px;
        /*border-radius: 8px;*/
        box-shadow: 0px 0px 10px #ccc;
}

.td-border{
        border: 1px solid #0b3e8b;
        padding: 5px 10px 5px 40px;
        display: block;
        position: relative;
        /* padding-left: 30px; */
        /*margin-bottom: 15px;*/
        cursor: pointer;
        font-size: 18px;
        /*border-radius: 8px;*/
        /*box-shadow: 0px 0px 10px #ccc;*/
}
.control input {
  position: absolute;
  z-index: -1;
  opacity: 0;
}
.control__indicator {
     position: absolute;
    top: 10px;
    left: 8px;
    height: 20px;
    width: 20px;
    background: #e6e6e6;
}
.control--radio .control__indicator {
  border-radius: 50%;
}
.control:hover input ~ .control__indicator,
.control input:focus ~ .control__indicator {
  background: #ccc;
}
.control input:checked ~ .control__indicator {
  background: #AC0F0B;
}
.control:hover input:not([disabled]):checked ~ .control__indicator,
.control input:checked:focus ~ .control__indicator {
  background: #AC0F0B;
}
.control input:disabled ~ .control__indicator {
  background: #e6e6e6;
  opacity: 0.6;
  pointer-events: none;
}
.control__indicator:after {
  content: '';
  position: absolute;
  display: none;
}
.control input:checked ~ .control__indicator:after {
  display: block;
}
.control--checkbox .control__indicator:after {
  left: 8px;
    top: 4px;
    width: 5px;
    height: 12px;
    border: solid #fff;
    border-width: 0 2px 2px 0;
    transform: rotate(45deg);
}
.control--checkbox input:disabled ~ .control__indicator:after {
  border-color: #7b7b7b;
}
.control--radio .control__indicator:after {
  left: 7px;
  top: 7px;
  height: 6px;
  width: 6px;
  border-radius: 50%;
  background: #fff;
}
.control--radio input:disabled ~ .control__indicator:after {
  background: #7b7b7b;
}

label.control.control--checkbox{
    font-weight: 600;
    color: #0c2f74;
}

.span-error{
    font-size: 10px;
    float: right;
    /*margin-top: -15px;*/
    color: red;
    font-weight: 600;
}
.fa.fa-spinner{
        font-size: 15px;
}
</style>
<?php $SUM   = json_decode($data->sumInsured);
      $amts  = json_decode($data->amounts); ?>
<main role="main">
	<section class="invest-long page-heading-h2" style="background: none;">
        <div class="container invest-long-bg" style="box-shadow: none;">
            <div class="row" id="data_alll--">
                <div class="col-12 col-md-12 col-lg-12 col-sm-12">
                    <div class="filters-plans">
                        <ul style="border-bottom: 2px solid #AC0F0B;">
                            <li style="display:inline;">
                                <i style="font-size: 20px;" class="fa fa-check-square-o" aria-hidden="true"></i>
                                <span style="font-weight: 700;color: #C52118;"> Terms and Conditions</span>
                            </li>
                        </ul>
                        
                    </div>
                </div>
                
                <div class="col-12 col-md-8 col-lg-8 col-sm-12">
                    <div class="card card-userinfo">
                        <div class="card-body">
                            <div class="premium-info" style="padding: 12px 35px;"> 
                                <div class="declearationInfoBox"> 
                                <div id="declearationInfoFormBox"> @include($includePage)</div>
                                 
                                       <label class="control control--checkbox">I have read and agree to the <a target="_blank"  href="{{config('custom.site_url')}}/terms-conditions">Terms and Conditions</a>. 
                                       I understand that by clicking on Payment button and making a payment, 
                                       I am signing the proposal form.
                                        And I also hereby appoint {{config('custom.site_name')}} as my corporate agent, 
                                        and authorize them to represent me to Insurance Companies for my Insurance needs.
                                          <input type="checkbox"  name="terms_conditions" id="terms_conditions" value="1"/>
                                          <div class="control__indicator" style="top: 45px;left: 20px;"></div>
                                    </label>
                                </div>
                                <span id="span-error" style="color: red;font-size: 14px;font-weight: 600;"></span>
                             </div>
                        </div>
                        <div class="card-footer proposalFooter" >
                            
                           
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-4 col-sm-12">
                    
                     <div class="row supplier-info" >
                         <div class="card card-providerinfo" style="width: 100%;">
                           <div class="card-header">
                               <img class="com-logo" style="width:75px;" src="{{$plan->supp_logo}}"/>
                               <span style="float: right;font-size: 16px;font-weight: 600;color: #0E3679;line-height: 75px;"><?=$plan->supp_name;?></span>
                            </div>
                           <div class="card-body" style="padding: 0px;">
                               <h3 style="color: #AC0F0B;font-weight: 600;font-size: 16px;text-align: center;margin-top: 14px;"><?=$jd->title;?></h3>
                                <table id="rightPlanSummaryTbl" class="table" style="margin-bottom:0px;">
                                <tbody>
                                  <tr>
                                    <td style="font-size: 13px;color: #000;padding: 15px 10px;font-family: 'Nunito Sans';">Cover Amount</td>
                                    <td style="font-weight: 700;font-size: 13px;color: #000;padding: 15px 10px;font-family: 'Nunito Sans';">₹<span id="<?=$data->enquiry_id;?>-sumInsured"><?=$SUM->shortAmt;?> <?=($SUM->shortAmt<=1)?'Lakh':'Lakhs';?></span></td>
                                  </tr>
                                  <tr>
                                    <td style="font-size: 13px;color: #000;padding: 15px 10px;font-family: 'Nunito Sans';">Policy Period</td>
                                    <td style="font-weight: 700;font-size: 13px;color: #000;padding: 15px 10px;font-family: 'Nunito Sans';"><span id="<?=$data->enquiry_id;?>-termYear"><?=$data->termYear;?></span> Year</td>
                                  </tr>
                                  <?php $termYear = $data->termYear ;?>
                                  <tr>
                                    <td style="font-size: 13px;color: #000;padding: 15px 10px;font-family: 'Nunito Sans';">Base Plan</td>
                                    <td style="font-weight: 700;font-size: 13px;color: #000;padding: 15px 10px;font-family: 'Nunito Sans';"><span id="<?=$data->enquiry_id;?>-Base_Premium">{{setMoneyFormat($amts->$termYear->Base_Premium)}}</span></td>
                                  </tr>
                                   <?php // if($data->provider=="CARE"){?>
                                  <tr >
                                    <td style="font-size: 16px;color: #000;text-align: center;font-weight: 700;font-family: 'Nunito Sans';" colspan="2">Selected Add-ons</td>
                                  </tr>
                                  <?php if(sizeof($amts->$termYear->Addons)){ 
                                     foreach($amts->$termYear->Addons as $eachAd){ ?>
                                     <tr class="TRaddonElem">
                                              <td style="font-size: 13px;color: #000;padding: 15px 10px;">{{$eachAd->title}}</td>
                                              <td style="font-weight: 700;font-size: 13px;color: #000;padding: 15px 10px;">
                                                      <span id="<?=$data->enquiry_id;?>'-addonElem">@if($eachAd->premium==0) Added @else{{setMoneyFormat($eachAd->premium)}}@endif</span></td>
                                            </tr>
                                     
                                  <?php } }else{?>
                                  <tr id="noAddonsTr">
                                    <td style="font-size: 13px;color: #000;padding: 15px 10px;font-family: 'Nunito Sans';">No-addons selected</td>
                                    <td style="font-weight: 700;font-size: 13px;color: #000;padding: 15px 10px;font-family: 'Nunito Sans';"><span id="<?=$data->enquiry_id;?>-Addons_Total ">{{setMoneyFormat('00')}}</span></td>
                                  </tr>
                                  <?php } 
                                  //}?>
                                  
                                  <tr id="addonsBeforeTr">
                                    <td style="font-size: 13px;color: #000;padding: 15px 10px;font-family: 'Nunito Sans';">Total Tax</td>
                                    <td style="font-weight: 700;font-size: 13px;color: #000;padding: 15px 10px;font-family: 'Nunito Sans';"><span id="<?=$data->enquiry_id;?>-Total_Tax">{{setMoneyFormat($amts->$termYear->Total_Tax)}}</span></td>
                                  </tr>

                                  <tr style="background-color: #cccccc82;">
                                    <td style="font-size: 15px;font-weight: 600;color: #000;padding: 16px 10px;font-family: 'Nunito Sans';">Total Premium</td>
                                    <td style="font-size: 15px;font-weight: 600;color: #000;padding: 16px 10px;font-family: 'Nunito Sans';"><span id="<?=$data->enquiry_id;?>-Total_Premium">{{setMoneyFormat($data->premiumAmount)}}</span></td>
                                  </tr>
                                  
                                  
                                 </tbody>
                                  <tfoot>
                                     <!--Red: #C52118  Blue: #0E3679-->
                                     <tr>
                                         <td colspan="2">
                                             <button class="btnPaynow" 
                                                     style="width: 100%;padding: 12px;background-color: #C52118;color: #fff;font-size: 17px;font-weight: 700;font-family: 'Nunito Sans';border: 1px solid #C52118;">
                                                      PAY NOW</span>
                                         </button></td>
                                     </tr>
                                 </tfoot>
                                 
                                 </table>
                              
                           </div>
                     </div>
                         <p style="width: 100%;" class="text-center">-OR-</p>
                        <div class="card" style="width: 100%;">
                            <div class="card-footer">
                               <button class="btn btn-success btn-lg mb30"
                               style="width: 100%;padding: 12px;background-color: #C52118;color: #fff;font-size: 17px;font-weight: 700;font-family: 'Nunito Sans';border: 1px solid #C52118;"
                               data-enc="<?=$data->enquiry_id;?>" id="GenratePaymentLink" style="width:100%;padding:3px;">Send Payment Link</button>
                            </div>
                        </div>
                </div>
			</div>
    	</div>
    </section>

</main>
 <!--<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>-->
 
 
 