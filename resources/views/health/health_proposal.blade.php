 @extends($layout)
@section('content')
<style>
.steps{
    display:none;
}
.steps.active-step{
     display:block;
}
.progress-indicator{display:-webkit-box;display:-moz-box;display:-ms-flexbox;display:-webkit-flex;display:flex}.no-flexer,.progress-indicator.stacked{display:block}.no-flexer-element{-ms-flex:0;-webkit-flex:0;-moz-flex:0;flex:0}.flexer-element,.progress-indicator>li{-ms-flex:1;-webkit-flex:1;-moz-flex:1;flex:1}.progress-indicator{margin:0 0 1em;padding:0;font-size:80%;text-transform:uppercase}.progress-indicator>li{list-style:none;text-align:center;width:auto;padding:0;margin:0;position:relative;text-overflow:ellipsis;color:#bbb;display:block}.progress-indicator>li:hover{color:#6f6f6f}.progress-indicator>li.completed,.progress-indicator>li.completed .bubble{color:#3a8a47}.progress-indicator>li .bubble{border-radius:1000px;width:20px;height:20px;background-color:#bbb;display:block;margin:0 auto .5em;border-bottom:1px solid #888}.progress-indicator>li .bubble:after,.progress-indicator>li .bubble:before{display:block;position:absolute;top:9px;width:100%;height:3px;content:'';background-color:#bbb}.progress-indicator>li.completed .bubble,.progress-indicator>li.completed .bubble:after,.progress-indicator>li.completed .bubble:before{background-color:#3a8a47;border-color:#3a8a47}.progress-indicator>li .bubble:before{left:0}.progress-indicator>li .bubble:after{right:0}.progress-indicator>li:first-child .bubble:after,.progress-indicator>li:first-child .bubble:before{width:50%;margin-left:50%}.progress-indicator>li:last-child .bubble:after,.progress-indicator>li:last-child .bubble:before{width:50%;margin-right:50%}.progress-indicator>li.active,.progress-indicator>li.active .bubble{color:#AC0F0B}.progress-indicator>li.active .bubble,.progress-indicator>li.active .bubble:after,.progress-indicator>li.active .bubble:before{background-color:#AC0F0B;border-color:#122a3f}.progress-indicator>li a:hover .bubble,.progress-indicator>li a:hover .bubble:after,.progress-indicator>li a:hover .bubble:before{background-color:#5671d0;border-color:#1f306e}.progress-indicator>li a:hover .bubble{color:#5671d0}.progress-indicator>li.danger .bubble,.progress-indicator>li.danger .bubble:after,.progress-indicator>li.danger .bubble:before{background-color:#d3140f;border-color:#440605}.progress-indicator>li.danger .bubble{color:#d3140f}.progress-indicator>li.warning .bubble,.progress-indicator>li.warning .bubble:after,.progress-indicator>li.warning .bubble:before{background-color:#edb10a;border-color:#5a4304}.progress-indicator>li.warning .bubble{color:#edb10a}.progress-indicator>li.info .bubble,.progress-indicator>li.info .bubble:after,.progress-indicator>li.info .bubble:before{background-color:#5b32d6;border-color:#25135d}.progress-indicator>li.info .bubble{color:#5b32d6}.progress-indicator.stacked>li{text-indent:-10px;text-align:center;display:block}.progress-indicator.stacked>li .bubble:after,.progress-indicator.stacked>li .bubble:before{left:50%;margin-left:-1.5px;width:3px;height:100%}.progress-indicator.stacked .stacked-text{position:relative;z-index:10;top:0;margin-left:60%!important;width:45%!important;display:inline-block;text-align:left;line-height:1.2em}.progress-indicator.stacked>li a{border:none}.progress-indicator.stacked.nocenter>li .bubble{margin-left:0;margin-right:0}.progress-indicator.stacked.nocenter>li .bubble:after,.progress-indicator.stacked.nocenter>li .bubble:before{left:10px}.progress-indicator.stacked.nocenter .stacked-text{width:auto!important;display:block;margin-left:40px!important}@media handheld,screen and (max-width:400px){.progress-indicator{font-size:60%}}

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

.inputGroup {
	 background-color: #fff;
	 display: block;
	 margin: 10px 0;
	 position: relative;
}
 .inputGroup label {
	 padding: 12px 30px;
	 width: 100%;
	 display: block;
	 text-align: left;
	 color: #3c454c;
	 cursor: pointer;
	 position: relative;
	 z-index: 2;
	 transition: color 200ms ease-in;
	 overflow: hidden;
}
 .inputGroup label:before {
	 width: 10px;
	 height: 10px;
	 border-radius: 50%;
	 content: '';
	 background-color: #AC0F0B;
	 position: absolute;
	 left: 50%;
	 top: 50%;
	 transform: translate(-50%, -50%) scale3d(1, 1, 1);
	 transition: all 300ms cubic-bezier(0.4, 0, 0.2, 1);
	 opacity: 0;
	 z-index: -1;
}
 .inputGroup label:after {
	 width: 32px;
	 height: 32px;
	 content: '';
	 border: 2px solid #d1d7dc;
	 background-color: #fff;
	 background-image: url("data:image/svg+xml,%3Csvg width='32' height='32' viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M5.414 11L4 12.414l5.414 5.414L20.828 6.414 19.414 5l-10 10z' fill='%23fff' fill-rule='nonzero'/%3E%3C/svg%3E ");
	 background-repeat: no-repeat;
	 background-position: 2px 3px;
	 border-radius: 50%;
	 z-index: 2;
	 position: absolute;
	 right: 30px;
	 top: 50%;
	 transform: translateY(-50%);
	 cursor: pointer;
	 transition: all 200ms ease-in;
}
 .inputGroup input:checked ~ label {
	 color: #fff;
}
 .inputGroup input:checked ~ label:before {
	 transform: translate(-50%, -50%) scale3d(56, 56, 1);
	 opacity: 1;
}
 .inputGroup input:checked ~ label:after {
	 background-color: #045fa0;
	 border-color: #045fa0;
}
 .inputGroup input {
	 width: 32px;
	 height: 32px;
	 order: 1;
	 z-index: 2;
	 position: absolute;
	 right: 30px;
	 top: 50%;
	 transform: translateY(-50%);
	 cursor: pointer;
	 visibility: hidden;
}
</style>
<?php $SUM   = json_decode($data->sumInsured);
      $amts  = json_decode($data->amounts); ?>
<main role="main">
     <input type="hidden" value="{{$data->enquiry_id}}" name="enQId" id="enQId"/>
	<section class="invest-long page-heading-h2" style="background: none;">
        <div class="container invest-long-bg" style="box-shadow: none;">
            <div class="row" id="page-proposal">
               <div class="col-12 col-md-12 col-lg-12 col-sm-12">
                    <div class="filters-plans">
                        <ul style="border-bottom: 2px solid #AC0F0B;">
                            <li style="display:inline;">
                                <i style="font-size: 20px;" class="fa fa-check-square-o " aria-hidden="true"></i>
                                <span style="font-weight: 700;color: #C52118;" id="testJson">Just few minutes to get insured...</span>
                            </li>
                        </ul>
                        
                    </div>
                </div> 
                
                <div class="col-12 col-md-8 col-lg-8 col-sm-12">
                    <div class="card card-userinfo">
                        <div class="card-body">
                             <!--<h4 class="userInfo-title text-center" style="">Just few Minutes to get Insured.</h4>-->
                             <p class="userInfo-subtitle text-center" style="color:#0E3679;font-weight: 600;">Provide your required details to get insured</p>
                             <ul class="progress-indicator">
                                <li class="active" id="progress-step-1">
                                    <span class="bubble"></span>
                                    Step 1. <br><small>Proposer Details</small>
                                </li>
                                <li class="{{$data->enquiry_id}}"  id="progress-step-2">
                                    <span class="bubble"></span>
                                    Step 2. <br><small>Insured Member</small>
                                </li>
                                <li class="{{$data->enquiry_id}}"  id="progress-step-3">
                                    <span class="bubble"></span>
                                    Step 3. <br><small>Address Details</small>
                                </li>
                                <li class="{{$data->enquiry_id}}"  id="progress-step-4">
                                    <span class="bubble"></span>
                                    Step 4. <br><small>Medical History</small>
                                </li>
                                <li class="{{$data->enquiry_id}}"  id="progress-step-5">
                                    <span class="bubble"></span>
                                    Step 5. <br><small>Review & Declaration</small>
                                </li>
                            </ul>
                            <div class="premium-info" style="padding: 12px 10px;">
                                <div class="proposalInfoBox ">
                                     @include('health.info.proposer')
                                </div>
                             </div>
                        </div>
                        <div class="card-footer proposalFooter" >
                           <button type="button" class="btn btn-ss btn-next btn-next-proposal" style="float: right;">Continue <i class="right fa fa-chevron-right "></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-4 col-sm-12">
                    
                     <div class="row supplier-info" >
                         <div class="card card-providerinfo" style="width: 100%;">
                           <div class="card-header">
                               <img class="com-logo" style="width: 50px;" src="{{$plan->supp_logo}}">
                               <span style="float: right;font-size: 16px;font-weight: 600;color: #0E3679;line-height: 50px;"><?=$plan->supp_name;?></span>
                            </div>
                           <div class="card-body" style="padding: 0px;">
                               <h3 style="color: #AC0F0B;font-weight: 600;font-size: 16px;text-align: center;margin-top: 14px;"><?=$data->title;?></h3>
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
                                 // }?>
                                  
                                  <tr id="addonsBeforeTr">
                                    <td style="font-size: 13px;color: #000;padding: 15px 10px;font-family: 'Nunito Sans';">GST</td>
                                    <td style="font-weight: 700;font-size: 13px;color: #000;padding: 15px 10px;font-family: 'Nunito Sans';"><span id="<?=$data->enquiry_id;?>-Total_Tax">{{setMoneyFormat($amts->$termYear->Total_Tax)}}</span></td>
                                  </tr>

                                  <tr style="background-color: #cccccc82;">
                                    <td style="font-size: 15px;font-weight: 600;color: #000;padding: 16px 10px;font-family: 'Nunito Sans';">Total Premium</td>
                                    <td style="font-size: 15px;font-weight: 600;color: #000;padding: 16px 10px;font-family: 'Nunito Sans';"><span id="<?=$data->enquiry_id;?>-Total_Premium">{{setMoneyFormat($amts->$termYear->Total_Premium)}}</span></td>
                                  </tr>
                                 </tbody>
                                 <tfoot>
                                    <tr>
                                         <td colspan="2"><button id="backToProductDeatils" style="width: 100%;padding: 12px;background-color: #E5E5E5;color: #0c0b0b;font-size: 17px;font-weight: 700;font-family: 'Nunito Sans';border: 1px solid #E5E5E5;">BACK TO DETAILS</button></td>
                                     </tr>
                                 </tfoot>
                                 
                                 </table>
                           </div>
                     </div>
                </div>
			</div>
    	</div>
    </section>

</main>


@endsection