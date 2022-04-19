  @extends($layout)
    @section('content')
      <style>
          .top-bar {position: fixed;}
          .table > tbody > tr td, .table > tbody > tr th {
                  font-size:14px;
                }
                
                 .table > tbody > tr th img{
                     position:relative;
                    top: 18%;
                    left: 5%;
                 } 
            
          @media (max-width: 480px) {
                .table > tbody > tr td, .table > tbody > tr th{
                     display: inline-block;
                }
                .table > tbody > tr th {
                    width: 30%
                }
                 .table > tbody > tr td {
                    width: 70%
                }
                
                 .table > tbody > tr .th-head{
                    width:100%;
                }
                
                .table > tbody > tr td .table-inner > tbody > tr .th-head{
                    width:100%;
                }
                
                 .table > tbody > tr td .table-inner  > tbody > tr th{
                      width: 28%
                 }
                .table > tbody > tr td .table-inner  > tbody > tr td{
                      width: 68%
                 }
                 
                  .table > tbody > tr th img{
                     position:relative;
                    top: 0;
                    left: 30%;
                 } 
            }
      </style>
      <?php $params   =  json_decode($info->params_request);
       //print_r($params);
       $json_data =  json_decode($info->json_data); ?>
      <main role="main">
         <section class="invest-long page-heading-h2">
            <div class="container invest-long-bg link-section" style="padding-top: 20px;" data-type="{{$info->type}}">
                 <div class="row">
                        <div class="col-md-5">
                            <div class="card">
                                    <div class="card-header"><h3 style="margin-bottom:0px">Plan Summary</h3></div>
                                    <div class="card-body">
                                        <table class="table table-bordered tbl-checkout">
                                            <tbody>
                                                <tr>
                                                    <th class="th-head"><img style="width: 100px;height: 100px;" src="{{asset('assets/partners/'.$partner->logo_image)}}" alt=""></th>
                                                    <td class="th-head">
                                                        <table class="table table-inner table-bordered">
                                                             <tbody>
                                                                 <tr>
                                                                     <th class="th-head" colspan="2">{{$partner->name}}</th>
                                                                 </tr>
                                                                 <tr>
                                                                     <th>IDV</th>
                                                                     <td>{{setMoneyFormat($info->idv)}}</td>
                                                                 </tr>
                                                                 <tr>
                                                                     <th>NCB</th>
                                                                     <td><?=isset($json_data->vehicle->newNCB)?$json_data->vehicle->newNCB:0;?>%</td>
                                                                 </tr>
                                                                 <tr>
                                                                     <th>Type</th>
                                                                     @if($info->policyType=="COM")
                                                                     <td>Comprehensive</td>
                                                                     @elseif($info->policyType=="SAOD")
                                                                     <td>Standalone OD</td>
                                                                     @elseif($info->policyType=="TP")
                                                                     <td>Third Party</td>
                                                                     @else 
                                                                     <td>Comprehensive</td>
                                                                     @endif
                                                                 </tr>
                                                             </tbody>
                                                         </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <ul class="list-group">
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
                                          
                                   </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="-card">
                                <!--<div class="card-header"><h3 style="margin-bottom:0px">Personal Details</h3></div>-->
                                <div class="card--body">
                                      <table class="table table-bordered tbl-checkout">
        				          	     <tbody>
        				          	         <tr>
        				          	             <th class="th-head" colspan="4">Personal Details</th>
        				          	         </tr>
        				          	       <tr>
        				          	           <th>Name</th><td><?=$params->customer->first_name." ".$params->customer->last_name;?></td>
        				          	            <?php /*<th>DOB</th><td><?=$params->customer->dob;?></td> */?>
        				          	            <th>Gender</th><td><?=$params->customer->gender;?></td> 
        				          	       </tr>
        				          	       <tr>
        				          	           
        				          	           <th>Email</th><td><?=$params->customer->email;?></td>
        				          	           <th>Mobile</th><td><?=$params->customer->mobile;?></td>
        				          	           
        				          	       </tr>
        				          	      
        				          	       
        				          	       <tr>
        				          	             <th class="th-head" colspan="4">Vehicle Details (<?=$params->vehicle->vehicleNumber;?>)</th>
        				          	         </tr>
        				          	       <tr>
        				          	           <th class="th-head">My Vehicle</th>
        				          	           <td class="th-head" colspan="3"><?=$params->vehicle->brand->name." ".$params->vehicle->model->name." ".$params->vehicle->varient->name."-".$params->vehicle->fueltype."(".$params->vehicle->cc."cc)";?></td>
        				          	       </tr>
        				          	       <tr>
        				          	           <th>RTO No</th><td><?=$params->vehicle->vehicleNumber;?></td>
        				          	           <th>Reg. Date</th><td><?=$params->vehicle->regDMY;?></td>
        				          	           
        				          	       </tr>
        				          	       <tr>
        				          	           <th>Engine No</th><td><?=$params->vehicle->engineNumber;?></td>
        				          	           <th>Chassis No</th><td><?=$params->vehicle->chassisNumber;?></td>
        				          	       </tr>
        				          	       
        				          	       <tr>
        				          	             <th class="th-head" colspan="4">Communication Address</th>
        				          	         </tr>
        				          	       <tr>
        				          	           <th class="th-head">Address</th>
        				          	           <td class="th-head" colspan="3"><?=$params->address->addressLineOne;?>,<?=$params->address->addressLineTwo;?></td>
        				          	       </tr>
        				          	       <tr>
        				          	           <th>City</th><td>{{explode('-',$params->address->city)[1]}}</td>
        				          	           <th>State</th><td>{{explode('-',$params->address->state)[1]}}</td>
        				          	       </tr>
        				          	       <tr>
        				          	           
        				          	           <th>Pincode</th><td><?=$params->address->pincode;?></td>
        				          	           
        				          	       </tr>
        				          	       @if($info->status!="SOLD")
        				          	       <tr>
        				          	           <td class="th-head" colspan="3">
        				          	               <div class="form-check" id="effect">
                                                    <input type="checkbox" class="form-check-input isChecked" id="agreeTerms" style="margin:5px 0 0;">
                                                    <label style="margin-left: 18px;font-size: 13px;color: #000;" class="form-check-label" >I agree to the <a href="#" class="readTermsConditions">Terms & Conditions</a></label>
                                                  </div>
        				          	           </td>
        				          	           <td class="th-head">
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
        				          	           </td>
        				          	       </tr>
        				          	       @endif
        				          	  </tbody>
        							  </table>
                                </div>
                            </div>
                         
						  
                        </div>
                       
                    
                </div>
            </div>
         </section>
      </main>
    @endsection