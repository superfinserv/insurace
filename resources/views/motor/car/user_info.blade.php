  @extends($layout)
    @section('content')
    <style>
.planInfo-card{
    box-shadow: 0 2px 4px 0 rgba(0,0,0,.2), 0 -1px 0 0 rgba(0,0,0,.03);
}
.table-planInfo tr:last-child td,.table-planInfo tr:last-child th{
   border-bottom:1px solid #ccc;
}

.table-planInfo tr th{
    font-size: 12px;
    font-weight: 500;
    border-left:1px solid #ccc;
}
.table-planInfo tr td{
   font-size: 12px;
   color: black;
       font-weight: 600;
    border-right:1px solid #ccc;
}
.userInfo-title{
    font-size: 16px;font-weight: 600;
}
.userInfo-subtitle{
        margin: 0px;
    font-size: 13px;
    text-align: center;
    margin-bottom: 15px;
}
.sp-custom-btn i.forword{
    font-size: 25px;
    float: right;
}
.sp-custom-btn i.backword{
    font-size: 25px;
    float: left;
}
.btn-red{
    color: #fff;
    background-color: #AC0F0B;;
    border-color: #AC0F0B;
}
.font-18{
   font-size: 18px !important; 
}
.word-capitalize{
    text-transform: capitalize;
}
.word-uppercase{
    text-transform: uppercase;
    color: #000;
}
.sp-custom-btn{
    
    display: inline-block;
    margin-bottom: 0;
    font-weight: 400;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    background-image: none;
    border: 1px solid transparent;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    border-radius: 4px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
.steps{
    display:none;
}
.steps.active-step{
     display:block;
}
#car_number{
     text-transform: uppercase;
}
input.form-control{
    font-weight: 600;
}
input[type="email"]::placeholder,input[type="text"]::placeholder{ /* Firefox, Chrome, Opera */ 
    color: #7673737a;
    font-weight: 400;
    
    
} 
input[type="email"]:-ms-input-placeholder,input[type="text"]:-ms-input-placeholder { /* Internet Explorer 10-11 */ 
    color: #7673737a; 
    font-weight: 400;
} 
  
input[type="email"]::-ms-input-placeholder,input[type="text"]:-ms-input-placeholder { /* Microsoft Edge */ 
    color: #7673737a;
    font-weight: 400;
} 
.form-group {
    margin-bottom: 0px;
}
.fieldset .row{
    margin-bottom: 10px;
}
    .progress-indicator{display:-webkit-box;display:-moz-box;display:-ms-flexbox;display:-webkit-flex;display:flex}.no-flexer,.progress-indicator.stacked{display:block}.no-flexer-element{-ms-flex:0;-webkit-flex:0;-moz-flex:0;flex:0}.flexer-element,.progress-indicator>li{-ms-flex:1;-webkit-flex:1;-moz-flex:1;flex:1}.progress-indicator{margin:0 0 1em;padding:0;font-size:80%;text-transform:uppercase}.progress-indicator>li{list-style:none;text-align:center;width:auto;padding:0;margin:0;position:relative;text-overflow:ellipsis;color:#bbb;display:block}.progress-indicator>li:hover{color:#6f6f6f}.progress-indicator>li.completed,.progress-indicator>li.completed .bubble{color:#3a8a47}.progress-indicator>li .bubble{border-radius:1000px;width:20px;height:20px;background-color:#bbb;display:block;margin:0 auto .5em;border-bottom:1px solid #888}.progress-indicator>li .bubble:after,.progress-indicator>li .bubble:before{display:block;position:absolute;top:9px;width:100%;height:3px;content:'';background-color:#bbb}.progress-indicator>li.completed .bubble,.progress-indicator>li.completed .bubble:after,.progress-indicator>li.completed .bubble:before{background-color:#3a8a47;border-color:#3a8a47}.progress-indicator>li .bubble:before{left:0}.progress-indicator>li .bubble:after{right:0}.progress-indicator>li:first-child .bubble:after,.progress-indicator>li:first-child .bubble:before{width:50%;margin-left:50%}.progress-indicator>li:last-child .bubble:after,.progress-indicator>li:last-child .bubble:before{width:50%;margin-right:50%}.progress-indicator>li.active,.progress-indicator>li.active .bubble{color:#AC0F0B}.progress-indicator>li.active .bubble,.progress-indicator>li.active .bubble:after,.progress-indicator>li.active .bubble:before{background-color:#AC0F0B;border-color:#122a3f}.progress-indicator>li a:hover .bubble,.progress-indicator>li a:hover .bubble:after,.progress-indicator>li a:hover .bubble:before{background-color:#5671d0;border-color:#1f306e}.progress-indicator>li a:hover .bubble{color:#5671d0}.progress-indicator>li.danger .bubble,.progress-indicator>li.danger .bubble:after,.progress-indicator>li.danger .bubble:before{background-color:#d3140f;border-color:#440605}.progress-indicator>li.danger .bubble{color:#d3140f}.progress-indicator>li.warning .bubble,.progress-indicator>li.warning .bubble:after,.progress-indicator>li.warning .bubble:before{background-color:#edb10a;border-color:#5a4304}.progress-indicator>li.warning .bubble{color:#edb10a}.progress-indicator>li.info .bubble,.progress-indicator>li.info .bubble:after,.progress-indicator>li.info .bubble:before{background-color:#5b32d6;border-color:#25135d}.progress-indicator>li.info .bubble{color:#5b32d6}.progress-indicator.stacked>li{text-indent:-10px;text-align:center;display:block}.progress-indicator.stacked>li .bubble:after,.progress-indicator.stacked>li .bubble:before{left:50%;margin-left:-1.5px;width:3px;height:100%}.progress-indicator.stacked .stacked-text{position:relative;z-index:10;top:0;margin-left:60%!important;width:45%!important;display:inline-block;text-align:left;line-height:1.2em}.progress-indicator.stacked>li a{border:none}.progress-indicator.stacked.nocenter>li .bubble{margin-left:0;margin-right:0}.progress-indicator.stacked.nocenter>li .bubble:after,.progress-indicator.stacked.nocenter>li .bubble:before{left:10px}.progress-indicator.stacked.nocenter .stacked-text{width:auto!important;display:block;margin-left:40px!important}@media handheld,screen and (max-width:400px){.progress-indicator{font-size:60%}}
.file-upload{display:block;text-align:center;font-family: Helvetica, Arial, sans-serif;font-size: 12px;}
.file-upload .file-select{display:block;border: 2px solid #dce4ec;color: #34495e;cursor:pointer;height:40px;line-height:40px;text-align:left;background:#FFFFFF;overflow:hidden;position:relative;}
.file-upload .file-select .file-select-button{background:#dce4ec;padding:0 10px;display:inline-block;height:40px;line-height:40px;}
.file-upload .file-select .file-select-name{line-height:40px;display:inline-block;padding:0 10px;}
.file-upload .file-select:hover{border-color:#34495e;transition:all .2s ease-in-out;-moz-transition:all .2s ease-in-out;-webkit-transition:all .2s ease-in-out;-o-transition:all .2s ease-in-out;}
.file-upload .file-select:hover .file-select-button{background:#34495e;color:#FFFFFF;transition:all .2s ease-in-out;-moz-transition:all .2s ease-in-out;-webkit-transition:all .2s ease-in-out;-o-transition:all .2s ease-in-out;}
.file-upload.active .file-select{border-color:#3fa46a;transition:all .2s ease-in-out;-moz-transition:all .2s ease-in-out;-webkit-transition:all .2s ease-in-out;-o-transition:all .2s ease-in-out;}
.file-upload.active .file-select .file-select-button{background:#3fa46a;color:#FFFFFF;transition:all .2s ease-in-out;-moz-transition:all .2s ease-in-out;-webkit-transition:all .2s ease-in-out;-o-transition:all .2s ease-in-out;}
.file-upload .file-select input[type=file]{z-index:100;cursor:pointer;position:absolute;height:100%;width:100%;top:0;left:0;opacity:0;filter:alpha(opacity=0);}
.file-upload .file-select.file-select-disabled{opacity:0.65;}
.file-upload .file-select.file-select-disabled:hover{cursor:default;display:block;border: 2px solid #dce4ec;color: #34495e;cursor:pointer;height:40px;line-height:40px;margin-top:5px;text-align:left;background:#FFFFFF;overflow:hidden;position:relative;}
.file-upload .file-select.file-select-disabled:hover .file-select-button{background:#dce4ec;color:#666666;padding:0 10px;display:inline-block;height:40px;line-height:40px;}
.file-upload .file-select.file-select-disabled:hover .file-select-name{line-height:40px;display:inline-block;padding:0 10px;}

</style>
 <?php $params   =  json_decode($data->params_request);
       $json_data =  json_decode($data->json_data);
       $hasZeroDep = ($params->subcovers->isPartDepProCover=='true')?'Added':'N/A';
       //print_r($params);?>
       <main role="main">
           <input type="hidden" value="{{$data->enquiry_id}}" name="enQId" id="enQId"/>
          <section class="term-smoke ptb">
            <div class="container ">
              <div class="row">
                <div class="col-md-7" style="background: #fff;padding-top: 25px;">
                    <h4 class="userInfo-title text-center" style="">Just few Minutes to get Insured.</h4>
                    <p class="userInfo-subtitle">Provide your Contact and vehicle details then proceed to pay</p>
                    <ul class="progress-indicator">
                        <li class="active" id="progress-step-1">
                            <span class="bubble"></span>
                            Step 1. <br><small>(Pvt Car Owner Details)</small>
                        </li>
                        <li class=""  id="progress-step-2">
                            <span class="bubble"></span>
                            Step 2. <br><small>Communication Address</small>
                        </li>
                        <li class=""  id="progress-step-3">
                            <span class="bubble"></span>
                            Step 3. <br><small>Vehicle Details</small>
                        </li>
                    </ul>
                    
                    <div class="fieldset">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="steps active-step" id="owner_data">
                                    <form class="form-group"  enctype="multipart/form-data"  id="profile_form" method="post" >
                                       <input name="_token" type="hidden" value="{{ csrf_token() }}"  />
                                      <!--if($params->vehicle->policyHolder=='IND')-->
                                         <?php  $fnameLabel =  ($params->vehicle->policyHolder=='IND')?'First Name':'Contact Person First Name';
                                              $lnameLabel =  ($params->vehicle->policyHolder=='IND')?'Last Name':'Contact Person Last Name';
                                              ?>
                                        <div class="row">
                                            <div class="col-md-6">    
                                                <div class="form-group">
                                                    <label for="first_name" style="width: 100%">{{$fnameLabel}}</label>
                                                    
                                                    <div class="input-group mb-3">
                                                      <span class="input-group-text">
                                                          <select style="width: 100%;font-weight: 600;" name="salutation" id="salutation">
                                                              <option value="Mr">Mr</option>
                                                              <option value="Ms">Ms</option>
                                                              <option value="Mrs">Mrs</option>
                                                          </select>
                                                      </span>
                                                      <input style="margin-bottom:0px;" type="text" name="first_name" id="first_name" class="form-control word-uppercase char-only" placeholder="Enter {{$fnameLabel}}" value="<?=isset($params->customer->first_name)?$params->customer->first_name:'';?>" autocomplete="off">
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">    
                                                <div class="form-group">
                                                    <label for="name" style="width: 100%">{{$lnameLabel}}</label>    
                                                    <input style="margin-bottom:0px;" type="text" name="last_name" id="last_name" class="form-control word-uppercase char-only" placeholder="Enter {{$lnameLabel}}" value="<?=isset($params->customer->last_name)?$params->customer->last_name:'';?>" autocomplete="off">
                                                </div>
                                            </div>
                                        
                                        
                                            
                                        </div>
                                        <!--endif-->
                                        <div class="row">
                                            <div class="col-md-6">   
                                                <div class="form-group">
                                                    <label for="email" style="width: 100%">Email Address</label>    
                                                    <input style="margin-bottom:0px;" type="email" name="email" id="email" class="form-control" placeholder="Enter your email address" value="<?=isset($params->customer->email)?$params->customer->email:'';?>" autocomplete="off">
                                                 </div>
                                            </div>
                                            <div class="col-md-6">    
                                               <div class="form-group">
                                                    <label for="mobile" style="width: 100%">Mobile No</label>    
                                                    <input style="margin-bottom:0px;" type="text" name="mobile" id="mobile" maxlength="10" class="form-control number-only" placeholder="Enter your Mobile Number" value="<?=isset($params->customer->mobile)?$params->customer->mobile:'';?>" autocomplete="off">
                                                 </div>
                                            </div>       
                                            
                                        </div>
                                        @if($params->vehicle->policyHolder=='IND')
                                        <div class="row">
                                            <div class="col-md-6">    
                                                 <div class="form-group">
                                                    <label for="dob" style="width: 100%">Date of birth</label>    
                                                    <input style="margin-bottom:0px;"type="text" name="dob" id="dob" class="form-control dob-mask" placeholder="Date of birth (DD/MM/YY)" value="<?=isset($params->customer->dob)?$params->customer->dob:'';?>"  autocomplete="off">
                                                </div>
                                            </div> 
                                             <div class="col-md-6"> 
                                                 <div class="form-group">
                                                     <label style="width: 100%">Select Gender</label>
                                                     <div class="custom-control custom-radio ">
                									  	<input type="radio" class="custom-control-input gender-input" id="genderMale" name="gender" value="Male" <?=(isset($params->customer->gender) && $params->customer->gender=='Male')?'checked':'';?>>
                									  	<label class="custom-control-label" for="genderMale">Male</label>
                									</div>
                
                									<div class="custom-control custom-radio ">
                									  	<input type="radio" class="custom-control-input gender-input" id="genderFeMale" name="gender" value="Female" <?=(isset($params->customer->gender) && $params->customer->gender=='Female')?'checked':'';?>>
                									 	<label class="custom-control-label" for="genderFeMale">Female</label>
                									</div> 
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                         <div class="row">
                                            <div class="col-md-6">    
                                                 <div class="form-group">
                                                    <label for="hypothecationAgency" style="width: 100%">Hypothecation <span style="color: #b6b3b3;font-size: 12px;">(optional)</span></label>    
                                                    @if($partner->shortName=='HDFCERGO')
                                                       <select style="margin-bottom:0px;" class="form-control select2 select2-hypothecationAgency" id="hypothecationAgency" name="hypothecationAgency">
                                                          
                                                      </select>
                                                     @else
                                                       <input style="margin-bottom:0px;"type="text" name="hypothecationAgency" id="hypothecationAgency" class="form-control word-uppercase" placeholder="Ex. HDFC BANK" value="<?=isset($params->vehicle->hypothecationAgency)?$params->vehicle->hypothecationAgency:'';?>"  autocomplete="off">
                                                     @endif
                                                </div>
                                            </div>
                                        </div>
                                        @if($params->vehicle->policyHolder=='COR')
                                          <div class="row">
                                            <div class="col-md-6">    
                                                <div class="form-group">
                                                    <label for="name" style="width: 100%">Company Name</label>    
                                                    <input style="margin-bottom:0px;" type="text" name="company_name" id="company_name" class="form-control word-uppercase" value="<?=isset($params->customer->company)?$params->customer->company:'';?>" placeholder="Enter your Company Name" autocomplete="off">
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">    
                                                <div class="form-group">
                                                    <label for="name" style="width: 100%">GSTIN</label>    
                                                    <input style="margin-bottom:0px;" type="text" name="gstin_number" id="gstin_number" class="form-control word-uppercase" value="<?=isset($params->customer->gstin)?$params->customer->gstin:'';?>" placeholder="Ex.-02XXXXX2230X1XX" autocomplete="off">
                                                </div>
                                            </div>
                                            
                                            
                                        </div>
                                         @endif
                                          @if($params->vehicle->policyHolder=='IND')
                                         @if($params->subcovers->isPA_OwnerDriverCover=="true")
                                        <hr/>
                                        <h4 style="margin-top: 10px;color: #AC0F0B;font-weight: 600;"><u>Nominee Details</u></h4>
                                        <div class="row">
                                            <div class="col-md-4">    
                                                <div class="form-group">
                                                    <label for="name" style="width: 100%">Nominee Name</label>    
                                                    <input style="margin-bottom:0px;" type="text" name="nominee_name" id="nominee_name" class="form-control word-uppercase" value="<?=isset($params->nominee->name)?$params->nominee->name:'';?>" placeholder="Enter Nominee Name" autocomplete="off">
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4">    
                                                <div class="form-group">
                                                    <label for="name" style="width: 100%">Nominee Relation</label>    
                                                    <select style="margin-bottom:0px;" class="form-control select2" id="nominee_relation" name="nominee_relation">
                                                      <option value="">Select</option>
                                                      <?php foreach ($relations as  $value) { ?>
                                                        <option value="{{$value->value}}" <?=(isset($params->nominee->relation) && $params->nominee->relation==$value->value)?'selected':'';?>>{{$value->label}}</option>
                                                      <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">    
                                                <div class="form-group">
                                                    <label for="name" style="width: 100%">Nominee DOB</label>    
                                                    <input style="margin-bottom:0px;" type="text" name="nominee_dob" id="nominee_dob" class="form-control dob-mask" value="<?=isset($params->nominee->dob)?$params->nominee->dob:'';?>" placeholder="Enter Nominee DOB" autocomplete="off">
                                                </div>
                                            </div>
                                            
                                            
                                        </div>
                                         @endif
                                         @endif
                                        <hr/>
                                        <div class="row">
                                            
                                            <div class="col-md-9"> </div>
                                            <div class="col-md-3"> <button type="button" id="btn-step-1" class="btn-block sp-custom-btn btn-red font-18" style="float: right;">Next <i class="forword fa fa-angle-double-right" aria-hidden="true"></i></button></div>
                                        </div> 
                                       <br/>
                                    </form>
                                </div>
                                <div class="steps" id="communication_address">
                                    <form class="form-group"  enctype="multipart/form-data"  id="address_form" method="post" >
                                        <input name="_token" type="hidden" value="{{ csrf_token() }}"  />
                                        <div class="row">
                                            <div class="col-md-12">    
                                               <div class="form-group">
                                                    <label for="address" style="width: 100%">Address</label>    
                                                   <input style="margin-bottom:0px;" type="text" name="address" id="address" class="form-control" value="<?=isset($params->address->addressLine)?$params->address->addressLine:'';?>" placeholder="Postal Address (House, Building, Street)">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">    
                                                <div class="form-group">
                                                    <label for="pincode" style="width: 100%">State Name</label>    
                                                    <select style="margin-bottom:0px;" class="form-control select2" id="state_id" name="state_id">
                                                      <option value="">Select state</option>
                                                      <?php foreach ($states as  $value) { ?>
                                                        <option value="{{$value->id}}-{{$value->name}}"  <?=(isset($params->address->state) && $params->address->state==$value->id.'-'.$value->name)?'selected':'';?>>{{$value->name}}</option>
                                                      <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">    
                                                <div class="form-group">
                                                    <label for="pincode" style="width: 100%">City Name</label>    
                                                    <select style="margin-bottom:0px;" class="form-control select2" id="city_id" name="city_id">
                                                      <option value="">Select City</option>
                                                      <?php if(isset($cities)){
                                                          foreach ($cities as  $ct) { ?>
                                                              <option value="{{$ct->id}}"  <?=(isset($params->address->city) && $params->address->city==$ct->id)?'selected':'';?>>{{$ct->value}}</option>
                                                          <?php }  } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">    
                                              <div class="form-group">
                                                    <label for="pincode" style="width: 100%">Pincode</label>    
                                                    <input style="margin-bottom:0px;" type="text" name="pincode" id="pincode" maxlength="6" value="<?=isset($params->address->pincode)?$params->address->pincode:'';?>" class="form-control number-only" placeholder="Pincode">
                                                </div>
                                            </div>
                                            <div class="col-md-3" style="margin-top: 30px;"> <button type="button" id="btn-back-step-2" class="btn-block sp-custom-btn btn-red font-18" style="float: right;"><i class="backword fa fa-angle-double-left" aria-hidden="true"></i> Previous </button></div>
                                            <div class="col-md-3" style="margin-top: 30px;"> <button type="button" id="btn-step-2" class="btn-block sp-custom-btn btn-red font-18" style="float: right;">Next <i class="forword fa fa-angle-double-right" aria-hidden="true"></i></button></div>
                                            
                                        </div>
                                        <br/>
                                    </form>
                                </div>
                                <div class="steps" id="vehicle_data">
                                    <form class="form-group"  enctype="multipart/form-data"  id="vehicle_form" method="post" >
                                        <input name="_token" type="hidden" value="{{ csrf_token() }}"  />
                                        <div class="row"  id="">
                                             <?php if($params->vehicle->isBrandNew!="true") { ?>
                                            <div class="col-md-6" >    
                                                <div class="form-group">
                                                    <label for="car_number" style="width: 100%">Your Vehicle Number</label>    
                                                     <input style="margin-bottom:0px;" type="text" name="car_number" id="car_number" class="form-control vehicleRegNumber" placeholder="Your Vehicle Number" value="<?=isset($params->vehicle->vehicleNumber)?$params->vehicle->vehicleNumber:'';?>">
                                                </div>
                                            </div>
                                            <?php }?>
                                            <div class="col-md-6">    
                                                <div class="form-group">
                                                    <label for="reg_date" style="width: 100%">Vehicle Registration Date</label>    
                                                    <input style="margin-bottom:0px;" type="text" name="reg_date" id="reg_date" class="form-control dob-mask" readonly placeholder="DD/MM/YY" value="<?=isset($params->vehicle->regDMY)?$params->vehicle->regDMY:'';?>">
                                                </div>
                                            </div>
                                        </div>
                                        <?php //print_r($params->previousInsurance);
                                             if($params->vehicle->isBrandNew!="true" && ( ($params->previousInsurance->isExp=='Not Expired') || ( $params->previousInsurance->isExp=='Expired' && $params->previousInsurance->exp!="0")))
                                                 { ?>
                                                
                                        <div class="row">
                                            <div class="col-md-6">    
                                               <div class="form-group">
                                                    <label for="policy_no" style="width: 100%">Previous Policy Number</label>    
                                                    <input style="margin-bottom:0px;" type="text" name="policy_no" id="policy_no" class="form-control word-uppercase" placeholder="Policy Number" value="<?=isset($params->previousInsurance->policyNo)?$params->previousInsurance->policyNo:'';?>">
                                               </div>
                                            </div>
                                            <div class="col-md-6">    
                                                <div class="form-group">
                                                    <label for="policy_exp_date" style="width: 100%">Policy Expiry Date</label>    
                                                    <input style="margin-bottom:0px;" type="text" name="policy_exp_date" id="policy_exp_date" class="form-control dob-mask" placeholder="Policy Expiry Date" value="<?=isset($params->previousInsurance->expDate)?$params->previousInsurance->expDate:'';?>">
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <div class="row">
                                            <div class="col-md-6">    
                                               <div class="form-group">
                                                    <label for="e_number" style="width: 100%">Engine Number</label>    
                                                    <input style="margin-bottom:0px;" type="text" name="e_number" id="e_number" class="form-control word-uppercase" placeholder="Engine Number" value="<?=isset($params->vehicle->engineNumber)?$params->vehicle->engineNumber:'';?>">
                                               </div>
                                            </div>
                                            <div class="col-md-6">    
                                                <div class="form-group">
                                                    <label for="classic_number" style="width: 100%">Chassis Number</label>    
                                                    <input style="margin-bottom:0px;" type="text" name="chassis_number" id="chassis_number" class="form-control word-uppercase" placeholder="Chassis Number" value="<?=isset($params->vehicle->chassisNumber)?$params->vehicle->chassisNumber:'';?>">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <?php if($params->vehicle->isBrandNew!="true" && ( ($params->previousInsurance->isExp=='Not Expired') || ( $params->previousInsurance->isExp=='Expired' && $params->previousInsurance->exp!="0")))
                                                 { ?>
                                            <div class="col-md-6">    
                                                <div class="form-group">
                                                    <label for="city_id" style="width: 100%">Previous insurer</label>    
                                                    <select style="margin-bottom:0px;" class="form-control select2" id="previousInsurer" name="previousInsurer">
                                                      <option value="">Select</option>
                                                      <?php foreach ($previous_insurer as  $preIns) {
                                                          $selected ="";
                                                          if(isset($params->previousInsurance->insurer)){
                                                              $selected = ($preIns->id==$params->previousInsurance->insurer)?'selected':'';
                                                          }
                                                      ?>
                                                        <option value="{{$preIns->id}}" <?=$selected;?>>{{$preIns->name}}</option>
                                                      <?php }  ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <?php } ?>
                                             @if($data->policyType=="SAOD")
                                              <div class="col-md-6">
                                                    <div class="form-group">
                                                            <label for="name" style="width: 100%;font-weight: 600;">Prevoius Policy Type</label>    
                                                            <select style="margin-bottom:0px;" class="form-control " id="TPprePolicyType" name="TPprePolicyType">
                                                              <option value="">Select</option>
                                                             <option value="1-OD_1-TP" <?=($params->TP->prePolicyType=='1-OD_1-TP')?'selected':'';?>> 1 Year OD and 1 Year TP</option>
                                                             <option value="0-OD_1-TP" <?=($params->TP->prePolicyType=='0-OD_1-TP')?'selected':'';?>>TP only </option>
                                                            
                                                             <option value="0-OD_3-TP" <?=($params->TP->prePolicyType=='0-OD_3-TP')?'selected':'';?>>3 Year TP only </option>
                                                             <option value="1-OD_3-TP" <?=($params->TP->prePolicyType=='1-OD_3-TP')?'selected':'';?>>1 Year OD and 3 Year TP </option>
                                                             <option value="3-OD_3-TP" <?=($params->TP->prePolicyType=='3-OD_3-TP')?'selected':'';?>>3 Year OD and 3 Year TP </option>
                                                             
                                                            </select>
                                                        </div>
                                                </div>
                                            @endif
                                        </div>
                                       
                                        @if($data->policyType=="SAOD")
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                            <label for="name" style="width: 100%;font-weight: 600;">Third Party Policy Insurer</label>    
                                                            <select style="margin-bottom:0px;" class="form-control " id="TPInsurer" name="TPInsurer">
                                                              <option value="">Select</option>
                                                                <?php foreach ($previous_insurer as  $preIns) {
                                                                  $selected ="";
                                                                    if(isset($params->TP->TPInsurer)){
                                                                      $selected = ($preIns->id==$params->TP->TPInsurer)?'selected':'';
                                                                   }
                                                              ?>
                                                                <option value="{{$preIns->id}}" <?=$selected;?>>{{$preIns->name}}</option>
                                                              <?php }  ?>
                                                            </select>
                                                        </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="name" style="width: 100%;font-weight: 600;">TP Policy Number</label>    
                                                        <input value="{{$params->TP->TP_policyno}}" style="margin-bottom:0px;" type="text" name="TP_policyno" id="TP_policyno" class="form-control word-uppercase" placeholder="Enter Policy Number" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                             <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="name" style="width: 100%;font-weight: 600;">TP Policy StartDate</label>    
                                                            <input  value="{{$params->TP->TPpolicyStartDate}}" style="margin-bottom:0px;" type="text" name="TPpolicyStartDate" id="TPpolicyStartDate" class=" form-control dob-mask" placeholder="Policy Start Date" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="name" style="width: 100%;font-weight: 600;">TP Policy EndDate</label>    
                                                            <input  value="{{$params->TP->TPpolicyEndDate}}" style="margin-bottom:0px;" type="text" name="TPpolicyEndDate" id="TPpolicyEndDate" class=" form-control dob-mask" placeholder="Policy End Date" autocomplete="off">
                                                        </div>
                                                    </div>
                                           </div>
                                        
                                        @endif
                                        
                                         <div class="row">
                                            <div class="col-md-3" style="margin-top: 30px;"> <button type="button" id="btn-back-step-3" class="btn-block sp-custom-btn btn-red font-18" style="float: right;"><i class="backword fa fa-angle-double-left" aria-hidden="true"></i> Previous </button></div>
                                            <div class="col-md-4" style="margin-top: 30px;"> <button type="button" data-ref="#"  id="btn-step-3" class="btn-block sp-custom-btn btn-red font-18" style="float: right;">Review & pay <i class="forword fa fa-angle-double-right" aria-hidden="true"></i></button></div>
                                        </div>
                                        
                                        <br/>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                </div>
                <div class="col-md-5" >
                    <div class="card planInfo-card">
					   	<header class="card-header">
					   	   <h3 class="title">Plan info <span style="color: #AC0F0B;font-size: 12px;font-weight: 500;letter-spacing: 0.2;">({{$partner->name}})</span></h3>
					   	</header>
						<div class="card-body">
						    <div class="row" style="border1: 1px solid #cccc;">
						        <div class="col-md-4">
						            <img src="{{asset('assets/partners/'.$partner->logo_image)}}"/>
						        </div>
						        <div class="col-md-8">
						           
						            <table class="table table-planInfo">
						                @if($params->planType!="TP")
						                <tr><th>IDV</th><td>:{{$data->idv}}</td> </tr>
						                @endif
						                <tr><th>ZERO DEP</th> <td>:<span id="span-ZeroDep">{{$hasZeroDep}}</span></td> </tr>
						                
						            </table>
						        </div>
						    </div>
						    <div class="row" style="border1: 1px solid #cccc;">
						        <div class="col-md-12">
						           <table class="table table-planInfo">
						                <tr><th>RTO No.</th><td>:<span id="span_rto_no">
						                    @if($params->vehicle->vehicleNumber!="")
						                    {{$params->vehicle->vehicleNumber}}
						                    @else
						                     {{$params->vehicle->rtoCode}}
						                    @endif
						                </span></td> </tr>
						                <tr><th>Car</th> <td>:{{$params->vehicle->brand->name}},{{$params->vehicle->model->name}},{{$params->vehicle->varient->name}}</td> </tr>
						                <tr><th>Reg. Year</th> <td>:<span id="span_reg_date">{{$params->vehicle->regYear}}</span></td> </tr>
						            </table>
						        </div>
						    </div>
						    <div class="row" style="border1: 1px solid #cccc;">
						        <div class="col-md-12">
						           <table class="table table-planInfo">
						                <tr><th>Net Premium</th> <td>:₹{{$json_data->net}}</td> </tr>
						                <tr><th>Tax (18%)</th> <td>:₹{{$json_data->tax}}</td> </tr>
						                <tr><th>Gross Premium</th><td>:₹{{$json_data->gross}}</td> </tr>
						                <tr><td colspan="2" class="text-center"><a href="#" class="Premium-Breakup" data-ref="{{$data->enquiry_id}}">Premium Breakup</a></td></tr>
						            </table>
						        </div>
						    </div>
						</div>
					</div>
                </div>
              </div>        
            </div>
          </section>
       </main>
 

@endsection