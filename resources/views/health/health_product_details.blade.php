 @extends($layout)
@section('content')
<style>
 
/* .section-planYear {*/
/*	 display: flex;*/
/*	 flex-flow: row wrap;*/
/*}*/
/* .section-planYear > div {*/
/*	 flex: 1;*/
/*	 padding: 0.5rem;*/
/*}*/


input[name='zoneType'] {
	 display: none;
}
input[name='zoneType']:not(:disabled) ~ label.label-zoneType {
	 cursor: pointer;
}
input[name='zoneType']:disabled ~ label.label-zoneType {
	 color: rgba(188, 194, 191, 1);
	 border-color: rgba(188, 194, 191, 1);
	 box-shadow: none;
	 cursor: not-allowed;
}
label.label-zoneType {
	 height: 100%;
	 display: block;
	 background: white;
 	 border: 2px solid #0E3679;
	 /*border-radius: 20px;*/
	 padding: 5px;
	 margin-bottom: 1px;
	 /*text-align: center;*/
	 box-shadow: 0px 3px 10px -2px rgba(161, 170, 166, 0.5);
	 position: relative;
}
input[name="zoneType"]:checked + label.label-zoneType {
	     background: #0e367933;
        color: #000;
        box-shadow: 0px 0px 0px #0e3679;
}
input[name='zoneType']:checked + label.label-zoneType::after {
	color: #C52118;
    font-family: FontAwesome;
    border: 2px solid #0E3679;
    content: "\f00c";
    font-size: 15px;
    position: absolute;
    top: 2px;
left: 5%;
    transform: translateX(-50%);
    height: 25px;
    width: 25px;
    line-height: 22px;
    text-align: center;
    border-radius: 50%;
    background: white;
	 box-shadow: 0px 2px 5px -2px rgba(0, 0, 0, 0.25);
}

.section-zoneType h2.zone-type{
    padding-top: 0px;
    padding-bottom:0px;
    font-size: 17px;
    font-weight: 700;
    font-family: 'Nunito Sans';
    text-align: left;
    padding-left: 50px;
    margin-bottom: 0px;
}

.label-zoneType p b {
    font-family: 'Nunito Sans';
    color:#000;
}
/* cover Term*/
 input[name='planYear'] {
	 display: none;
}
 input[name='planYear']:not(:disabled) ~ label.label-planYear {
	 cursor: pointer;
}
 input[name='planYear']:disabled ~ label.label-planYear {
	 color: rgba(188, 194, 191, 1);
	 border-color: rgba(188, 194, 191, 1);
	 box-shadow: none;
	 cursor: not-allowed;
}
 label.label-planYear {
	 height: 100%;
	 display: block;
	 background: white;
 	 border: 2px solid #0E3679;
	 border-radius: 20px;
	 padding: 1rem;
	 margin-bottom: 1rem;
	 text-align: center;
	 box-shadow: 0px 3px 10px -2px rgba(161, 170, 166, 0.5);
	 position: relative;
}
 input[name="planYear"]:checked + label.label-planYear {
	     background: #0e367933;
        color: #000;
        box-shadow: 0px 0px 0px #0e3679;
}
input[name='planYear']:checked + label.label-planYear::after {
	color: #C52118;
    font-family: FontAwesome;
    border: 2px solid #0E3679;
    content: "\f00c";
    font-size: 15px;
    position: absolute;
    top: 29px;
    left: 25%;
    transform: translateX(-50%);
    height: 25px;
    width: 25px;
    line-height: 22px;
    text-align: center;
    border-radius: 50%;
    background: white;
	 box-shadow: 0px 2px 5px -2px rgba(0, 0, 0, 0.25);
}

.section-planYear h2.cover-year{
    padding-top: 22px;
    padding-bottom: 3px;
    font-size: 17px;
    font-weight: 700;
    font-family: 'Nunito Sans';
}

.label-planYear p b {
    font-family: 'Nunito Sans';
    color:#000;
}


 @media only screen and (max-width: 700px) {
	 .section-planYear {
		margin-bottom: 20px;
	}
}


/*.boxes {*/
/*  margin: auto;*/
/*  padding: 50px;*/
/*  background: #484848;*/
/*}*/

/*Checkboxes styles*/
.addonInput { display: none; }

.addonInput + label {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 20px;
  font: 14px/20px 'Nunito Sans';
   /*font-family: 'Nunito Sans';*/
  color: #0e3679;
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
}

.addonInput + label:last-child { margin-bottom: 0; }

.addonInput + label:before {
  content: '';
  display: block;
  width: 20px;
  height: 20px;
  border: 2px solid #C52118;
  position: absolute;
  left: 0;
  top: 0;
  opacity: .6;
  -webkit-transition: all .12s, border-color .08s;
  transition: all .12s, border-color .08s;
}

.addonInput:checked + label:before {
  width: 10px;
  top: -5px;
  left: 5px;
  border-radius: 0;
  opacity: 1;
  border-top-color: transparent;
  border-left-color: transparent;
  -webkit-transform: rotate(45deg);
  transform: rotate(45deg);
}









/* .addon-input {*/
/*	 opacity: 0;*/
/*	 position: absolute;*/
/*}*/
/*.addon-input + label {*/
/*	 position: relative;*/
/*	 display: block;*/
/*	 background: #f8f8f8;*/
/*	 border: 1px solid #f0f0f0;*/
/*	 border-radius: 2em;*/
/*	 padding: 0.5em 1em 0.5em 5em;*/
/*	 box-shadow: 0 1px 2px rgba(100, 100, 100, .5) inset, 0 0 10px rgba(100, 100, 100, .1) inset;*/
/*	 cursor: pointer;*/
/*	 text-shadow: 0 2px 2px #fff;*/
/*}*/
/*.addon-input + label::before {*/
/*	 content: '';*/
/*	 position: absolute;*/
/*	 top: 50%;*/
/*	 left: 0.7em;*/
/*	 width: 3em;*/
/*	 height: 1.2em;*/
/*	 border-radius: 0.6em;*/
/*	 background: #eee;*/
/*	 transform: translateY(-50%);*/
/*	 box-shadow: 0 1px 3px rgba(100, 100, 100, .5) inset, 0 0 10px rgba(100, 100, 100, .2) inset;*/
/*}*/
/* .addon-input + label::after {*/
/*	 content: '';*/
/*	 position: absolute;*/
/*	 top: 50%;*/
/*	 left: 0.5em;*/
/*	 width: 1.4em;*/
/*	 height: 1.4em;*/
/*	 border: 0.25em solid #fafafa;*/
/*	 border-radius: 50%;*/
/*	 box-sizing: border-box;*/
/*	 background-color: #ddd;*/
/*	 background-image: linear-gradient(to top, #fff 0%, #fff 40%, transparent 100%);*/
/*	 transform: translateY(-50%);*/
/*	 box-shadow: 0 3px 3px rgba(0, 0, 0, .5);*/
/*}*/
/* .addon-input + label, .addon-input + label::before, .addon-input + label::after {*/
/*	 transition: all 0.2s cubic-bezier(0.165, 0.84, 0.44, 1);*/
/*}*/
/* .addon-input + label:hover, .addon-input:focus + label {*/
/*	 color: black;*/
/*}*/
/* .addon-input + label:hover::after, .addon-input:focus + label::after {*/
/*	 background-color: #ccc;*/
/*	 box-shadow: 0 1px 2px rgba(0, 0, 0, .5);*/
/*}*/
/* .addon-input:checked {*/
/*	 counter-increment: total;*/
/*}*/
/* .addon-input:checked + label::before {*/
/*	 background: #1ce;*/
/*}*/
/* .addon-input:checked + label::after {*/
/*	 transform: translateX(2em) translateY(-50%);*/
/*}*/


 /* Disabled checkbox */
/*  .addon-input:disabled:not(:checked) + label:before,*/
/*  .addon-input:disabled:checked + label:before {*/
/*     background: #1ce;*/
/*  }*/

/*  .addon-input:disabled:checked + label:after {*/
/*    transform: translateX(2em) translateY(-50%);*/
/*  }*/

/*  .addon-input:disabled + label {*/
/*    color: #aaa;*/
/*  }*/
/*  	<div>*/
/*		<input id="chk01" class="addon-input" type="checkbox" checked disabled/>*/
/*		<label for="chk01">Lorem ipsum dolor sit amet.</label>*/
/*	</div>*/
/*	<div>*/
/*		<input id="chk02" class="addon-input" type="checkbox" />*/
/*		<label for="chk02">Eos voluptate, impedit porro iusto.</label>*/
/*	</div>*/
/* .total::after {*/
/*	 content: counter(total);*/
/*	 font-weight: bold;*/
/*}*/

 
 
</style>
<?php $SUM   = json_decode($data->sumInsured);
      $amts  = json_decode($data->amounts); ?>
<main role="main">
    <input type="hidden" value="{{$data->enquiry_id}}" name="enQId" id="enQId"/>
	<section class="invest-long page-heading-h2" style="background: none;" id="enQ-{{$data->enquiry_id}}" data-product="{{$data->product}}">
        <div class="container invest-long-bg" style="box-shadow: none;">
            <div class="row" id="page-proposal">
                <div class="col-12 col-md-8 col-lg-8 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                             <ul  style="list-style-type: none;margin-bottom:0px">
                              <li style="display: inline-block;width:20%;vertical-align: bottom;">
                                  <img style="width: 100px;max-height: 100%;max-width: 100%;margin: auto;" src="{{$plan->supp_logo}}">
                                </li>
                              <li style="display: inline-block;width:65%;vertical-align: top;padding-left:12px;">
                                  <span class="plan-title" style="font-weight: 700;font-family: 'Nunito Sans';"><?=$data->title;?></span>
                                  <p style="margin:0;padding:1px;"></p>
                                    <span style="font-weight: 700;font-family: 'Nunito Sans'; font-size: 16px;width:25%;display: inline-block;">
                                       <i class="fa fa-circle" style="font-size: 10px;vertical-align: middle;margin-right: 5px;"></i><a href="{{url('/health-insurance/product-info/'.$data->enquiry_id)}}" style="color: #AC0F0B;">See Details</a>
                                    </span>
                                    @if($pData->policy_wording!="")
                                    <span style="font-weight: 700;font-family: 'Nunito Sans'; font-size: 16px;width: 35%;display: inline-block;">
                                      <i class="fa fa-circle" style="font-size: 10px;vertical-align: middle;margin-right: 5px;"></i>
                                      <a href="{{url('/get/download/file/policy-word/'.$pData->policy_wording)}}" style="color: #AC0F0B;">Policy Wording</a>
                                    </span>
                                    @endif
                                     @if($pData->policy_brochure!="")
                                    <span style="font-weight: 700;font-family: 'Nunito Sans'; font-size: 16px;width: 35%;display: inline-block;">
                                      <i class="fa fa-circle" style="font-size: 10px;vertical-align: middle;margin-right: 5px;"></i>
                                      <a href="{{url('/get/download/file/policy-word/'.$pData->policy_brochure)}}" style="color: #AC0F0B;">Policy Brochure</a>
                                    </span>
                                    @endif
                              </li>
                               
                            </ul>
                        </div>
                        <div class="card-body" style="padding:6px;">
                            <div style="box-shadow: 0px 5px 6px #ccc;border: 1px solid #ccc;padding: 12px;  border-radius: 12px;">
                                    <h4 style="font-weight: 700;font-size: 16px;">Cover Amount</h4>
                                    <p style="margin-top: 0px;font-size: 13px;">With medical treatments becoming costlier every year, a higher cover ensures quality treatment</p>
                                    <div class="row" id="page-proposal">
                                        <div class="col-12 col-md-5 col-lg-5 col-sm-12">
                                            <label for="planSumInsured"  style="width:100%;font-weight: 800;">
                                                <select id="planSumInsured" class="" style="width:100%">
                                                    <?php $sumArr = sumInsuredArr($data->provider,$data->code,$uType);
                                                    foreach($sumArr as $s=>$l){ ?>
                                                    <option value="<?=$s;?>"   <?=($s==$SUM->shortAmt)?'selected':'';?>><?=($s<100)?$s.' Lakhs':'1 crore';?> </option>
                                                    <?php } ?>
                        
                                                </select>
                                            </label>
                                        </div>
                                    </div>
                            </div>
                            <?php  if($plan->sp=='DIGIT'){?>
                            <div style="margin-top:12px;box-shadow: 0px 5px 6px #ccc;border: 1px solid #ccc;padding: 12px;  border-radius: 12px;">
                                <h4 style="font-weight: 700;font-size: 16px;">Zone</h4>
                                <p style="margin-top: 0px;font-size: 13px;">
                                    Your city of residence is categorized in either Zone A, B or C. As the treatment cost is different in different cities, there are certain
                                    conditions if you change your city of treatment:
                                </p>
                                <?php $actualZone = $data->actualZone;?>
                                <div class="row" id="page-proposal">
                                        <div class="col-12 col-md-12 col-lg-12 col-sm-12 section-zoneType" >
                                            <input type="radio" class="updateZone" name="zoneType" id="zoneType_A" value="A"  {{$data->zone=='A'? "checked":""}}>
                                                  <label class="label-zoneType" for="zoneType_A">
                                                    <h2 class="zone-type" style="color:#000 !important">Zone A</h2>
                                                    <p style="padding-left: 40px;margin-top:0px;">Delhi/NCR, Mumbai including (including Navi Mumbai, Thane and Kalyan)</p>
                                             </label>
                                        </div>
                                        <div class="col-12 col-md-12 col-lg-12 col-sm-12 section-zoneType" style="margin-top:12px;">
                                            <input <?php if($actualZone=="A"){ echo "disabled";}else{ }?> type="radio" class="updateZone" name="zoneType" id="zoneType_B" value="B"  {{$data->zone=='B'? "checked":""}}>
                                                  <label class="label-zoneType" for="zoneType_B">
                                                    <h2 class="zone-type" style="color:#000 !important">Zone B</h2>
                                                    <p style="padding-left: 40px;margin-top:0px;">Hyderabad, Secunderabad, Bangalore, Kolkata, Ahmedabad, Vadodara, Chennai, Pune and Surat.</p>
                                             </label>
                                        </div>
                                        <div class="col-12 col-md-12 col-lg-12 col-sm-12 section-zoneType" style="margin-top:12px;">
                                            <input <?php if($actualZone=="A" || $actualZone=="B"){ echo "disabled"; }else{ }?> type="radio" class="updateZone" name="zoneType" id="zoneType_C" value="C"  {{$data->zone=='C'? "checked":""}}>
                                                  <label class="label-zoneType" for="zoneType_C">
                                                    <h2 class="zone-type" style="color:#000 !important">Zone C</h2>
                                                    <p style="padding-left: 40px;margin-top:0px;">All zone apart from A & B belong to Zone C</p>
                                             </label>
                                        </div>
                                        
                                        <div class="col-12 col-md-12 col-lg-12 col-sm-12" style="margin-top: 20px;font-size: 13px;">
                                            <ul style="list-style-type: disc !important;padding-left:1em !important;margin-left:1em;">
                                                <li>If You have availed choice of Zone B at the time of Policy Inception and availing treatment in a Hospital which is situated in
                                                     Zone A, 10% Co-pay would be applicable on admissible claim amount.</li>
                                                <li> If You have availed choice of Zone C at the time of Policy Inception and availing treatment in a Hospital which is situated in
                                                     Zone B, 10% Co-pay would be applicable on admissible claim amount.</li>
                                                <li>If You have availed choice of Zone C at the time of Policy Inception and availing treatment in a Hospital which is situated in
                                                     Zone A, 20% Co-pay would be applicable on admissible claim amount</li>
                                              </ul>
                                        </div>
                                </div>
                                
                            </div>
                            <?php } ?>
                            
                             <?php  if($plan->sp=='MANIPAL_CIGNA'){?>
                              <?php $actualZone = $data->actualZone;?>
                            <div style="margin-top:12px;box-shadow: 0px 5px 6px #ccc;border: 1px solid #ccc;padding: 12px;  border-radius: 12px;">
                                <h4 style="font-weight: 700;font-size: 16px;">Zone</h4>
                                <p style="margin-top: 0px;font-size: 13px;">
                                    Your city of residence is categorized in either Zone I, II or III. As the treatment cost is different in different cities, there are certain
                                    conditions if you change your city of treatment:
                                </p>
                                 
                                <div class="row" id="page-proposal">
                                        <div class="col-12 col-md-12 col-lg-12 col-sm-12 section-zoneType" >
                                            <input  type="radio" class="updateZone" name="zoneType" id="zoneType_A" value="ZONE1"  {{$data->zone=='ZONE1'? "checked":""}}>
                                                  <label class="label-zoneType" for="zoneType_A">
                                                    <h2 class="zone-type" style="color:#000 !important">Zone 1</h2>
                                                    <p style="padding-left: 40px;margin-top:0px;">Persons paying Zone I premium can avail treatment all over India without any Co-pay.</p>
                                             </label>
                                        </div>
                                        <div class="col-12 col-md-12 col-lg-12 col-sm-12 section-zoneType" style="margin-top:12px;">
                                            <input <?php if($actualZone=="ZONE1"){ echo "disabled";}else{ }?> type="radio" class="updateZone" name="zoneType" id="zoneType_B" value="ZONE2"  {{$data->zone=='ZONE2'? "checked":""}}>
                                                  <label class="label-zoneType" for="zoneType_B">
                                                    <h2 class="zone-type" style="color:#000 !important">Zone 2</h2>
                                                    <p style="padding-left: 40px;margin-top:0px;margin-bottom: 1px;">Can avail treatment in Zone II and Zone III without any Co-pay.</p>
                                                    <p style="padding-left: 40px;margin-top:0px;margin-bottom: 1px;">Availing treatment in Zone I will have to bear 10% of each and every claim.</p>
                                             </label>
                                        </div>
                                        <div class="col-12 col-md-12 col-lg-12 col-sm-12 section-zoneType" style="margin-top:12px;">
                                            <input <?php if($actualZone=="ZONE1" || $actualZone=="ZONE2"){ echo "disabled"; }else{ }?>  type="radio" class="updateZone" name="zoneType" id="zoneType_C" value="ZONE3"  {{$data->zone=='ZONE3'? "checked":""}}>
                                                  <label class="label-zoneType" for="zoneType_C">
                                                    <h2 class="zone-type" style="color:#000 !important">Zone 3</h2>
                                                    <p style="padding-left: 40px;margin-top:0px;margin-bottom: 1px;">Can avail treatment in Zone III, without any Co-pay</p>
                                                    <p style="padding-left: 40px;margin-top:0px;margin-bottom: 1px;">Availing treatment in Zone II will have to bear 10% of each and every claim.</p>
                                                     <p style="padding-left: 40px;margin-top:0px;margin-bottom: 1px;">Availing treatment in Zone I will have to bear 20% of each and every claim.</p>
                                             </label>
                                        </div>
                                        
                                        
                                        <!--<div class="col-12 col-md-12 col-lg-12 col-sm-12" style="margin-top: 20px;font-size: 13px;">-->
                                        <!--    <ul style="list-style-type: disc !important;padding-left:1em !important;margin-left:1em;">-->
                                        <!--        <li>Availing treatment in Zone II will have to bear 10% of each and every claim.<br/>-->
                                        <!--            Availing treatment in Zone I will have to bear 20% of each and every claim.</li>-->
                                        <!--        <li> If You have availed choice of Zone C at the time of Policy Inception and availing treatment in a Hospital which is situated in-->
                                        <!--             Zone B, 10% Co-pay would be applicable on admissible claim amount.</li>-->
                                        <!--        <li>If You have availed choice of Zone C at the time of Policy Inception and availing treatment in a Hospital which is situated in-->
                                        <!--             Zone A, 20% Co-pay would be applicable on admissible claim amount</li>-->
                                        <!--      </ul>-->
                                        <!--</div>-->
                                </div>
                                
                            </div>
                            <?php } ?>
                            
                            <div style="margin-top:12px;box-shadow: 0px 5px 6px #ccc;border: 1px solid #ccc;padding: 12px;  border-radius: 12px;">
                                    <h4 style="font-weight: 700;font-size: 16px;">Policy Period</h4>
                                    <!--<p style="margin-top: 0px;font-size: 13px;">Choosing a multi-year plan saves your money and the trouble of remembering yearly renewals.</p>-->
                                    <div class="row" id="page-proposal" style="margin-top: 10px;">
                                        <div class="col-12 col-md-4 col-lg-4 col-sm-12 section-planYear" >
                                            <input type="radio" class="updateQuote" name="planYear" id="planYear_1" value="1" {{$data->termYear==1? "checked":""}}>
                                                  <label class="label-planYear" for="planYear_1">
                                                    <h2 class="cover-year" style="color:#000 !important">1 Year</h2>
                                                    <?php $one="1";?>
                                                    <p>Premium  <b><span id="<?=$data->enquiry_id;?>-planYear_1">{{setMoneyFormat($amts->$one->Base_Premium)}}</span></b></p>
                                             </label>
                                        </div>
                                        <?php  if($plan->sp!='DIGIT'){?>
                                        <div class="col-12 col-md-4 col-lg-4 col-sm-12 section-planYear">
                                            <input type="radio" class="updateQuote" name="planYear" id="planYear_2"  value="2" {{ $data->termYear==2? "checked":"" }}>
                                                  <label class="label-planYear" for="planYear_2">
                                                    <h2  class="cover-year" style="color:#000 !important">2 Year</h2>
                                                    <?php $two="2";?>
                                                    <p>Premium <b><span id="<?=$data->enquiry_id;?>-planYear_2">{{setMoneyFormat($amts->$two->Base_Premium)}}</span></b></p>
                                             </label>
                                        </div>
                                        
                                         <div class="col-12 col-md-4 col-lg-4 col-sm-12 section-planYear">
                                            <input type="radio" class="updateQuote" name="planYear" id="planYear_3"  value="3" {{ $data->termYear==3? "checked":"" }}>
                                                  <label class="label-planYear" for="planYear_3">
                                                    <h2  class="cover-year" style="color:#000 !important">3 Year</h2>
                                                    <?php $three="3";?>
                                                    <p>Premium <b><span id="<?=$data->enquiry_id;?>-planYear_3">{{setMoneyFormat($amts->$three->Base_Premium)}}</span></b></p>
                                             </label>
                                        </div>
                                        <?php } ?>
                                    </div>
                            </div>
                            <?php  if($data->provider=="CARE"){?>
                            <div style="margin-top:12px;box-shadow: 0px 5px 6px #ccc;border: 1px solid #ccc;padding: 12px;  border-radius: 12px;">
                                 <h4 style="font-weight: 700;font-size: 16px;">Recommended Add-Ons</h4>
                                    <p style="margin-top: 0px;font-size: 13px;">(Please click on below add-ons to add more benefits)</p>
                                    <div class="boxes addon-container" >
                                      <?php 
                                        $addons = array();
                                        if(isset($param->addOn)){ if($param->addOn!=""){ $addons =  explode(",",$param->addOn);}}
                                        
                                       ?>
                                        
                                        
                                        @if($data->code=='1967')
                                                <input id="addOn4" value="CAREADWITHNCB" name="addOn4" type="checkbox" class="addon-ncb addonInput addon-label" <?=((!empty($addons)) && in_array("CAREADWITHNCB",$addons))?"checked":"";?>/>
                                                <label class= "addon-ncb" for="addOn4" class="">NCB Super </label>
                                                
                                                <input id="addOn2" value="CARESHILED1104" name="addOn2" type="checkbox" class="addonInput addon-label" <?=((!empty($addons)) && in_array("CARESHILED1104",$addons))?"checked":"";?>/>
                                                <label for="addOn2">Care Shield</label>
                                                
                                                <input id="addOn3" value="SMARTCA" name="addOn3" type="checkbox" class="addonInput addon-label" <?=((!empty($addons)) && in_array("SMARTCA",$addons))?"checked":"";?>/>
                                                <label for="addOn3">Smart Select</label>
                                                <?php /*
                                                <input id="addOn1" value="HCUPCA1093" name="addOn1" type="checkbox" class="addonInput addon-label" <?=((!empty($addons)) && in_array("HCUPCA1093",$addons))?"checked":"";?>/>
                                                <label for="addOn1">Annual Health Check-up</label>
                                                 */?>
                                                <input id="addOn5" value="RRMCA" name="addOn5" type="checkbox" class="addonInput addon-label" <?=((!empty($addons)) && in_array("RRMCA",$addons))?"checked":"";?>/>
                                                <label for="addOn5">Room rent</label>
                                        
                                        @else
	

                                         
                                         @if($data->code=='611' || $data->code=='608')
                                           <p style="margin-bottom:0px"><span style="font-size: 10px;color: #000;">(Kindly note that Everyday Care benefit is currently available only in Delhi NCR, Mumbai, Pune, Bengaluru and Chennai</span></p>
                                           <input type="checkbox" value="EVERYDAYCARE" class="addonInput addon-label" id="addOn1" name="addOn1" <?=((!empty($addons)) && in_array("EVERYDAYCARE",$addons))?"checked":"";?>/>
                                           <label for="addOn1">Everyday Care </label>
                                          
                                           <input id="addOn2" value="UAR" name="addOn2" type="checkbox" class="addonInput addon-label" <?=((!empty($addons)) && in_array("UAR",$addons))?"checked":"";?>/>
                                           <label for="addOn2">Unlimited Recharge</label>
                                           
                                           <input id="addOn3" value="CARESHILED1104" name="addOn3" type="checkbox" class="addonInput addon-label" <?=((!empty($addons)) && in_array("CARESHILED1104",$addons))?"checked":"";?>/>
                                           <label for="addOn3">Care Shield</label>
                                           
                                         
                                         
                                            @if( ($data->code=='611' || $data->code=='608') && ( (($data->mandatoryAddons=="" || $data->mandatoryAddons=="CAREWITHNCB") && $SUM->shortAmt>=7) || ($data->mandatoryAddons=="" && $SUM->shortAmt<=5)) )
                                               
                                                <input id="addOn4" value="CAREWITHNCB" name="addOn4" type="checkbox" class="addon-ncb addonInput addon-label" <?=((!empty($addons)) && in_array("CAREWITHNCB",$addons))?"checked":"";?>/>
                                                <label class= "addon-ncb" for="addOn4" class="">NCB Super </label>
                                           
                                             @endif
                                             
                                             
                                         @endif
                                         @if($data->code=='1439')
                                           <input id="addOn5" value="AHCCC1126" name="addOn5" type="checkbox" class="addonInput addon-label" checked disabled/>
                                           <label for="addOn5">Health Check-up</label>
                                         @endif  
                                           <input id="addOn6" value="OPDCC1122" name="addOn6" type="checkbox" class="addonInput addon-label" <?=((!empty($addons)) && in_array("OPDCC1122",$addons))?"checked":"";?>/>
                                           <label style="margin-bottom: 0px;" for="addOn6">OPD Care</label>
                                           
                                           <div class="addon-elem-OPDCC1122" style="display:<?=((!empty($addons)) && in_array("OPDCC1122",$addons))?"block":"none";?>">
                                                @if($data->code=='1439')
                                                   <div class="form-check-inline" >
                                                      <label class="form-check-label">
                                                        <input type="radio" value="OPDCC-3000" class="form-check-input" name="OPDCC1122" <?=((!empty($addons)) && in_array("OPDCC-3000",$addons))?"checked":"checked";?>>₹3000
                                                      </label>
                                                </div>
                                                @endif
                                            <div class="form-check-inline">
                                              <label class="form-check-label">
                                                <input type="radio" value="OPDCC-5000" class="form-check-input" name="OPDCC1122" <?=((!empty($addons)) && in_array("OPDCC-5000",$addons))?"checked":"";?>>₹5000
                                              </label>
                                            </div>
                                             <div class="form-check-inline">
                                              <label class="form-check-label">
                                                <input type="radio"  value="OPDCC-10000"  class="form-check-input" name="OPDCC1122" <?=((!empty($addons)) && in_array("OPDCC-10000",$addons))?"checked":"";?>>₹10000
                                              </label>
                                            </div>
                                             @if($data->code=='611' || $data->code=='608')
                                              <?php for ($opd_si=15000; $opd_si <=50000; $opd_si+=5000) {?>
                                                <div class="form-check-inline">
                                                  <label class="form-check-label">
                                                    <input type="radio" value="OPDCC-{{$opd_si}}" class="form-check-input" name="OPDCC1122" <?=((!empty($addons)) && in_array("OPDCC-".$opd_si,$addons))?"checked":"";?>>₹{{$opd_si}}
                                                  </label>
                                                </div>
                                                <?php } ?>
                                             @endif
                                           </div>
                                            
                                         @endif 
                                    </div>
                                    
                               
                            </div>
                            <?php } ?>
                             <?php  if($data->provider=="DIGIT" && $data->policyType=="FL"){?>
                             <div style="margin-top:12px;box-shadow: 0px 5px 6px #ccc;border: 1px solid #ccc;padding: 12px;  border-radius: 12px;">
                                 <h4 style="font-weight: 700;font-size: 16px;">Recommended Add-Ons</h4>
                                 <p style="margin-top: 0px;font-size: 13px;">(Please click on below add-ons to add more benefits)</p>
                                <div class="boxes">
                                    
                                      <input type="radio" value="Maternity_25000" class="addonInput addon-label" id="addOn1" name="addOn1" <?=((!empty($addons)) && in_array("Maternity_25000",$addons))?"checked":"";?>>
                                      <label for="addOn1">Maternity and New Born Baby Cover ({{setMoneyFormat('25000')}}) <span style="color:#747373">(After 2 years of waiting period and covers up to 2 kids only)</span></label>
                                      
                                       <input type="radio" value="Maternity_50000" class="addonInput addon-label" id="addOn2" name="addOn1" <?=((!empty($addons)) && in_array("Maternity_50000",$addons))?"checked":"";?>>
                                       <label for="addOn2">Maternity and New Born Baby Cover ({{setMoneyFormat('50000')}}) <span style="color:#747373">(After 2 years of waiting period and covers up to 2 kids only)</span></label>
                                      
                                       <input type="radio" value="None" class="addonInput addon-label" id="addOn3" name="addOn1" <?=((!empty($addons)) && in_array("None",$addons))?"checked":"";?>>
                                       <label for="addOn3">Not required</label>
                                
                                    </div>
                              </div>
                             <?php } ?>
                             <?php  if($data->provider=="MANIPAL_CIGNA"){?>
                                <div style="margin-top:12px;box-shadow: 0px 5px 6px #ccc;border: 1px solid #ccc;padding: 12px;  border-radius: 12px;">
                                     <h4 style="font-weight: 700;font-size: 16px;">Recommended Add-Ons</h4>
                                     <p style="margin-top: 0px;font-size: 13px;">(Please click on below add-ons to add more benefits)</p>
                                     <div class="boxes">
                                            <input id="addOn2" value="OPCBB06" name="addOn2" type="checkbox" class="addonInput addon-label" <?=((!empty($addons)) && in_array("OPCBB06",$addons))?"checked":"";?>/>
                                            <label for="addOn2">ProHealth-Cumulative Bonus Booster</label>
                                            
                                            <input id="addOn1" value="OPHDCB03" name="addOn1" type="checkbox" class="addonInput addon-label" <?=((!empty($addons)) && in_array("OPHDCB03",$addons))?"checked":"";?>/>
                                            <label for="addOn1">Hospital Daily Cash Benefit</label>
                                            
                                          <?php /*  <input id="addOn3" value="OPWMC04" name="addOn3" type="checkbox" class="addonInput addon-label" <?=((!empty($addons)) && in_array("OPWMC04",$addons))?"checked":"";?>/>
                                            <label for="addOn3">ProHealth-Waiver Mandatory CoPay</label>
                                            */?>
                                            
                                     </div>
                                 </div>
                                      
                                         
                               
                             <?php } ?>
                            
                        </div>
                        
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-4 col-sm-12">
                     <div class="row supplier-info" >
                         
                         <div class="card card-providerinfo" style="width: 100%;">
                           <div class="card-header">
                               <span>Plan Summary</span>
                            </div>
                           <div class="card-body" style="padding: 0px;">
                               <h3 style="color: #AC0F0B;font-weight: 600;font-size: 16px;text-align: center;margin-top: 14px;"><span id="<?=$data->enquiry_id;?>-planTitle" class="plan-title"><?=$data->title;?></span></h3>
                               <table id="rightPlanSummaryTbl" class="table" style="margin-bottom:0px;">
                                <tbody>
                                  <tr>
                                    <td style="font-size: 13px;color: #000;padding: 15px 10px;font-family: 'Nunito Sans';">Cover Type</td>
                                    <td style="font-weight: 700;font-size: 13px;color: #000;padding: 15px 10px;font-family: 'Nunito Sans';">
                                        <span id="<?=$data->enquiry_id;?>-coverType"><?=($data->policyType=='FL')?'Floater':'Individual';?></span>
                                    </td>
                                  </tr>
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
                                   <?php  if($data->provider=="CARE"){?>
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
                                   }?>
                                    <?php  if($data->provider=="DIGIT"){?>
                                     <tr >
                                       <td style="font-size: 16px;color: #000;text-align: center;font-weight: 700;font-family: 'Nunito Sans';" colspan="2">Selected Add-ons</td>
                                     </tr>
                                     <?php if(sizeof($amts->$termYear->Addons)){ 
                                      foreach($amts->$termYear->Addons as $eachAd){ ?>
                                     <tr class="TRaddonElem">'
                                              <td style="font-size: 13px;color: #000;padding: 15px 10px;">{{$eachAd->title}}</td>
                                              <td style="font-weight: 700;font-size: 13px;color: #000;padding: 15px 10px;">
                                                      <span id="<?=$data->enquiry_id;?>'-addonElem">Added</span></td>
                                            </tr>
                                     
                                  <?php } }else{?>
                                  <tr id="noAddonsTr">
                                    <td style="font-size: 13px;color: #000;padding: 15px 10px;font-family: 'Nunito Sans';">No-addons selected</td>
                                    <td style="font-weight: 700;font-size: 13px;color: #000;padding: 15px 10px;font-family: 'Nunito Sans';"><span id="<?=$data->enquiry_id;?>-Addons_Total ">{{setMoneyFormat('00')}}</span></td>
                                  </tr>
                                  <?php } } ?>
                                  
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
                                     <!--Red: #C52118  Blue: #0E3679-->
                                     
                                     <tr id="whatsAppElem" style="display:none;">
                                         <td >
                                             <input class="form-control" type="text" name="shareMobileNo" id="shareMobileNo"/>
                                             
                                         </td>
                                         <td>
                                             
                                             <button id="wp-button"  data-message="{{config('custom.site_url').'/health-insurance/product-detail/'.$data->enquiry_id}}" style="width: 100%;padding: 12px;background-color: #4dc247;color: #fff;font-size: 17px;font-weight: 700;font-family: 'Nunito Sans';border: 1px solid #4dc247;">
                                                 <i class="fa fa-whatsapp" style="font-size:17px"></i> Share</button>
                                         </td>
                                   </tr>
                                    <tr id="whatsAppElemInit">
                                         <td colspan="2">
                                             <button id="shareOnWp" style="width: 100%;padding: 12px;background-color: #4dc247;color: #fff;font-size: 17px;font-weight: 700;font-family: 'Nunito Sans';border: 1px solid #4dc247;">
                                                 <i class="fa fa-whatsapp" style="font-size:17px"></i> Share on WhatsApp</button>
                                         </td>
                                     </tr>
                                     <tr>
                                         <td colspan="2"><button class="{{$data->enquiry_id}}" id="proceed-proposal" style="width: 100%;padding: 12px;background-color: #C52118;color: #fff;font-size: 17px;font-weight: 700;font-family: 'Nunito Sans';border: 1px solid #C52118;">PROCEED</button></td>
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