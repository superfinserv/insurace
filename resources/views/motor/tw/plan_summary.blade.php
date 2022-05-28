  @extends($layout)
    @section('content')
    <style>
    .row-plan-summary{
            box-shadow: 0px 1px 8px #cccc;
            padding: 12px;
            margin-bottom: 5px;
    }
    
        .row-plan-summary .title{
                font-size: 18px;
                font-weight: 500;
                color: #AC0F0B;
                margin-bottom: 7px;
        }
        .row-plan-summary .table-planInfo th,.row-plan-summary .table-planInfo td{
            font-size: 12px;
        }
        .row-plan-summary .table-planInfo th{
            width:30%;
        }
        .row-plan-summary .table-planInfo td{
            width:70%;
        }
    </style>
      <?php $params   =  json_decode($info->params_request);
       //print_r($params);
       $json_data =  json_decode($info->json_data); ?>
     <main role="main">
        <section class="term-smoke ptb">
            <div class="container ">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-heading">
                       <h2 class="__title" style=" padding-top: 20px; padding-bottom: 20px; ">{{ucfirst(strtolower("IMPORTANT DETAILS TO REVIEW BEFORE PAYMENT"))}}</h2>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12" style="background: #fff;padding: 12px 25px;">
                        
                        <div class="row row-plan-summary">
                           <div class="col-md-12">
                               <h3  class="title">Personal Details <span class="pull-right"><a href="{{url('twowheeler-insurance/users-information/'.$info->enquiry_id)}}">Edit</a></span></h3>
                           </div>
                            <div class="col-md-12">
                                <table class="table table-planInfo">
                                    @if($params->vehicle->policyHolder=="IND")
					                <tr><th>Full Name (as per RTO)</th><td>:<span id="">{{$params->customer->first_name}} {{$params->customer->last_name}}</span></td> </tr>
					                <tr><th>Date of birth</th> <td>:<span id="">{{$params->customer->dob}}</span></td> </tr>
					                <tr><th>Gender</th> <td>:<span id="ownerGender">{{$params->customer->gender}}</span></td> </tr>
					                @else
					                <tr><th>Company Name (as per RTO)</th><td>:<span id="">{{$params->customer->company}}</span></td> </tr>
					                <tr><th>GSTIN</th><td>:<span id="">{{$params->customer->gstin}}</span></td> </tr>
					                @endif
					                <tr><th>Mobile Number</th> <td>:<span id="ownerMobile">{{$params->customer->mobile}}</span></td> </tr>
					                <tr><th>Email</th> <td>:<span id="ownerEmail">{{$params->customer->email}}</span></td> </tr>
					                
						        </table>
                            </div>
                        </div>
                        
                        
                        <div class="row row-plan-summary">
                           <div class="col-md-12">
                               <h3 class="title">Vehicle Details <span class="pull-right"><a href="{{url('twowheeler-insurance/users-information/'.$info->enquiry_id)}}">Edit</a></span></h3>
                           </div>
                            <div class="col-md-12">
                                <table class="table table-planInfo">
					                <tr><th>Vehical RTO number</th><td>:<span id="vehicleNo">{{$params->vehicle->vehicleNumber}}</span></td> </tr>
					                <tr><th>Registration Date</th> <td>:<span id="vehicleReg">{{$params->vehicle->regDMY}}</span></td> </tr>
					                <tr><th>Engine Number</th> <td>:<span id="vehicleEngine">{{$params->vehicle->engineNumber}}</span></td> </tr>
					                <tr><th>Chassis number</th> <td>:<span id="vehicleChassis">{{$params->vehicle->chassisNumber}}</span></td> </tr>
						        </table>
                            </div>
                        </div>
                        
                         <div class="row row-plan-summary">
                           <div class="col-md-12">
                               <h3 class="title">Communication Details <span class="pull-right"><a href="{{url('twowheeler-insurance/users-information/'.$info->enquiry_id)}}">Edit</a></span></h3>
                           </div>
                            <div class="col-md-12">
                                <table class="table table-planInfo">
					                <tr><th>Address</th><td>:<span id="ownerAddress">{{$params->address->addressLineOne}},{{$params->address->addressLineTwo}}</span></td> </tr>
					                <tr><th>City</th> <td>:<span id="ownerCity">{{explode('-',$params->address->city)[1]}}</span></td> </tr>
					                <tr><th>State</th> <td>:<span id="ownerState">{{explode('-',$params->address->state)[1]}}</span></td> </tr>
					                <tr><th>Pincode</th> <td>:<span id="ownerPincode">{{$params->address->pincode}}</span></td> </tr>
						        </table>
                            </div>
                        </div>
                         
					</div>
                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                        <div class="card">
                          <div class="card-header">
                              <h4>Plan Summary <span style="color: #AC0F0B;font-size: 12px;font-weight: 500;letter-spacing: 0.2;">({{$partner->name}})</span></h4>
                          </div>
                          <div class="card-body">
                              @if($params->planType!="TP")
                                  <ul id="menu">
                                        <li style="display:inline;">
                                          <img style="width:80px;" class="group list-group-image" src="{{asset('assets/partners/'.$partner->logo_image)}}" alt="">
                                        </li>
                                      <li style="display:inline;float: right;">IDV : <span class="fa fa-inr"></span>{{$info->idv}}</li>
                                  </ul>
                              @endif
                              <hr/>
                              <div class="card planInfo-card">
                					<header class="card-header"><h3 class="title">Premium Breakup</h3>	</header>
                					<div class="card-body">
                                       <ul class="list-group" >
                                                        <?php $covers = $json_data->covers;?>
                                                        <?php foreach($covers as $key=>$cover){
                                                            if($key!="addons" && $cover->selection===true){?>
                                                            <li style="font-size: 12px;line-height:20px !important;" class="list-group-item"><?=$cover->title;?> <b style="float:right">(+) ₹<?=$cover->grossAmt;?>/-</b></li>
                                                           <?php  } ?>
                                                        <?php } ?>
                                                        <?php foreach($covers->addons as $adon){ ?>
                                                                  <li style="font-size: 12px;line-height:20px !important;" class="list-group-item"><?=$adon->title;?> <b style="float:right">(+) ₹<?=$adon->grossAmt;?>/-</b></li>
                                                             
                                                       <?php  } ?>
                                                       <?php foreach($json_data->discount->discounts as $dis){ 
                                                          $typ = ($dis->type=='NCB_DISCOUNT')?"NCB":"OTHER";?>
                                                        <li style="font-size: 12px;line-height:20px !important;" class="list-group-item">@if($typ=='NCB')No Claim Bonus ({{$dis->percent}}%) @else Discount @endif ({{$typ}}-{{$dis->percent}}%)<b style="float:right">(-) ₹<?=$json_data->discount->total;?>/-</b></li>
                                                       <?php }?>
                                                        <li style="font-size: 12px;line-height:20px !important;" class="list-group-item">Service Tax GST(18%) <b style="float:right">(+) ₹<?=$json_data->tax;?>/-</b></li>
                                                       
                                                        <li style="font-weight: 600;background: #ccc;font-size: 12px;line-height:20px !important;" class="list-group-item">
                                                            Final Premium <b style="float:right"><?=$json_data->gross;?></b></li>
                                                           
                                                    </ul>
                                                    <hr/>
                                        <div class="form-check" id="effect">
                                            <input type="checkbox" class="form-check-input isChecked" id="agreeTerms" style="margin:5px 0 0;">
                                            <label style="margin-left: 18px;font-size: 13px;color: #000;" class="form-check-label" >I agree to the <a href="#" class="readTermsConditions">Terms & Conditions</a></label>
                                         </div>
                                    </div>
                                </div>
                          </div>
                          <div class="card-footer">
                              @if($info->provider=='HDFCERGO')
                              <form id="payNowForm" method="POST" action="{{$paymetAction}}">
                                   <input type="hidden" value="{{$info->token}}"  id= "trnsno" name="trnsno"/>
                                   <input type="hidden" value="S001"  id= "FeatureID" name="FeatureID"/>
                                   <input type="hidden" value="{{$checkSum}}"  id= "Checksum" name="Checksum"/>
                              </form>
                              @endif
                              @if($info->provider=='FGI')
                               <form id="payNowForm" method="POST" action="{{$paymetAction}}">
                                 <input type="hidden" name='TransactionID' value='{{$TransactionID}}'/>
                                 <input type="hidden" name='PaymentOption' value='{{$PaymentOption}}'/>
                                 <input type="hidden" name='ResponseURL' value='{{$ResponseURL}}'/>
                                 <input type="hidden" name='ProposalNumber' value='{{$ProposalNumber}}'/>
                                 <input type="hidden" name='PremiumAmount' value='{{$PremiumAmount}}'/>
                                 <input type="hidden" name='UserIdentifier' value='{{$UserIdentifier}}'/>
                                 <input type="hidden" name='UserId' value='{{$UserId}}'/>
                                 <input type="hidden" name='FirstName' value='{{$FirstName}}'/>
                                 <input type="hidden" name='LastName' value='{{$LastName}}'/>
                                 <input type="hidden" name='Mobile' value='{{$Mobile}}'/>
                                 <input type="hidden" name='Email' value='{{$Email}}'/>
                                 <input type="hidden" name='Vendor' value='{{$Vendor}}'/>
                                 <input type="hidden" name='CheckSum' value='{{$checkSum}}'/>
                                </form>  
                              @endif
                              <button class="btn btn-success btn-lg mb30"  data-enc="<?=$info->enquiry_id;?>" id="paynow_amount" style="width:100%;padding:3px;">Pay Securely</button>
                              <!--<p style="margin: 5px;font-size: 12px;font-weight: 600;float: right;text-decoration: underline;"><a href="#" id="GenratePaymentLink" data-enc="#">Genrate Payment Link and share</a></p>-->
                              <!--<button class="btn btn-success mb30"  data-enc="" id="paynow_amount" style="width: 30%;padding:3px;float:right;">Send Payment Link</button>-->
                        </div>
                        
                        </div>
                         <p class="text-center">-OR-</p>
                        <div class="card">
                            <div class="card-footer">
                               <button class="btn btn-success btn-lg mb30"  data-enc="<?=$info->enquiry_id;?>" id="GenratePaymentLink" style="width:100%;padding:3px;">Send Payment Link</button>
                            </div>
                        </div>
                        <div class="ajax_response">
                            
                        </div>
                    </div>
                </div>        
            </div>
       </section>
</main>
 



<style type="text/css">

.btn { font-family: 'Noto Sans', sans-serif; font-size: 16px; text-transform: capitalize; font-weight: 700; padding: 12px 36px; border-radius: 4px; line-height: 2; letter-spacing: 0px; -webkit-transition: all 0.3s; -moz-transition: all 0.3s; transition: all 0.3s; word-wrap: break-word; white-space: normal !important; }
.btn-default { background-color: #0943c6; color: #fff; border: 1px solid #0943c6; }
.btn-default:hover { background-color: #063bb3; color: #fff; border: 1px solid #063bb3; }
.btn-default.focus, .btn-default:focus { background-color: #063bb3; color: #fff; border: 1px solid #063bb3; }

</style>



@endsection


