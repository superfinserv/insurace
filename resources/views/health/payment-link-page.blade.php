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
       $json_data =  json_decode($info->json_data); 
        $amts  = json_decode($info->amounts); 
          $termYear = $info->termYear;
       ?>
      <main role="main">
         <section class="invest-long page-heading-h2">
            <div class="container invest-long-bg" style="padding-top: 20px;">
                 <div class="row">
                        <div class="col-md-5">
                            <div class="card">
                                    <div class="card-header"><h3 style="margin-bottom:0px">{{$partner->name}}</h3></div>
                                    <div class="card-body">
                                        <table class="table table-bordered tbl-checkout">
                                            <tbody>
                                                <tr>
                                                    <th class="th-head"><img style="width: 100px;height: 100px;" src="{{asset('assets/partners/'.$partner->logo_image)}}" alt=""></th>
                                                    <td class="th-head">
                                                        <table class="table table-inner table-bordered">
                                                             <tbody>
                                                                 <tr>
                                                                     <th class="th-head" colspan="2">{{$info->title}}</th>
                                                                 </tr>
                                                                 <tr>
                                                                     <th>Term Year</th>
                                                                     
                                                                     <td>{{$termYear}} Year</td>
                                                                 </tr>
                                                                 <tr>
                                                                     <th>Member</th>
                                                                     <td>Adult:{{$params->total_adult}} | Child:{{$params->total_child}}</td>
                                                                 </tr>
                                                                 <tr>
                                                                     <th>Type</th>
                                                                     @if($info->policyType=="FL")
                                                                     <td>Floater</td>
                                                                     @elseif($info->policyType=="IND")
                                                                     <td>Individual</td>
                                                                     @else 
                                                                     <td>Floter</td>
                                                                     @endif
                                                                 </tr>
                                                             </tbody>
                                                         </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                       
                                     
                                      
                                        <ul class="list-group">
                                             <?php  $sumInsureds  =  json_decode($info->sumInsured); $sumInsured = $sumInsureds->shortAmt;?>
                                                                    
                                            <li style="font-size: 12px;line-height:20px !important;" class="list-group-item">Cover Amount <b style="float:right">₹ {{($sumInsured)}} <?=($sumInsured<=1)?'Lakh':'Lakhs';?></b></li>
                                           <li style="font-size: 12px;line-height:20px !important;" class="list-group-item">Base Plan<b style="float:right">{{setMoneyFormat($amts->$termYear->Base_Premium)}}</b></li>
                                               
                                            <?php if(sizeof($amts->$termYear->Addons)){ 
                                                 foreach($amts->$termYear->Addons as $eachAd){ ?>
                                              
                                                   
                                                    <li style="font-size: 12px;line-height:20px !important;" class="list-group-item"><?=$eachAd->title;?> <b style="float:right">@if($eachAd->premium==0) Added @else{{setMoneyFormat($eachAd->premium)}}@endif</b></li>
                                                   <?php  } ?>
                                                <?php } ?>
                                                
                                               
                                                <li style="font-size: 12px;line-height:20px !important;" class="list-group-item">Service Tax GST(18%) <b style="float:right">(+) {{setMoneyFormat($amts->$termYear->Total_Tax)}}/-</b></li>
                                               
                                                <li style="font-weight: 600;background: #ccc;font-size: 12px;line-height:20px !important;" class="list-group-item">
                                                    Final Premium <b style="float:right"><?=$info->premiumAmount;?></b></li>  
                                     </ul>
                                   
                                          
                                   </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                             @include($includePage)
                            
                            <div class="-card">
                                <!--<div class="card-header"><h3 style="margin-bottom:0px">Personal Details</h3></div>-->
                                <div class="card--body">
                                      <table class="table table-bordered tbl-checkout">
        				          	     <tbody>
        				          	         <tr>
        				          	             <th class="th-head" colspan="4">Proposer Details</th>
        				          	         </tr>
        				          	       <tr>
        				          	           <th>Name</th><td><?=isset($param->selfName)?$param->selfName:"";?></td>
        				          	           <th>DOB</th><td><?=$param->selfdd."/".$param->selfmm."/".$param->selfyy;?></td>
        				          	           
        				          	       </tr>
        				          	       <tr>
        				          	           
        				          	           <th>Email</th><td><?=isset($param->selfEmail)?$param->selfEmail:"";?></td>
        				          	           <th>Mobile</th><td>(+91)<?=isset($param->selfMobile)?$param->selfMobile:"";?></td>
        				          	           
        				          	       </tr>
        				          	        <tr>
        				          	           
        				          	           <th>Height</th><td><?=($param->selfFeet && $param->selfInch)?$param->selfFeet."ft ".$param->selfInch."inch":"";?></td>
        				          	           <th>Weight</th><td><?=isset($param->selfWeight)?$param->selfWeight:"";?> Kg</td>
        				          	           
        				          	       </tr>
        				          	       <tr>
        				          	          <th>Gender</th><td><?=isset($param->gender)?$param->gender:"";?></td> 
        				          	       </tr>
        				          	       
        				          	        <tr>
        				          	             <th class="th-head" colspan="4">Insured members</th>
        				          	        </tr>
        				          	        <?php $c = 1;foreach($param->members as $ins=>$insurer){ ?>
                				          	       <tr>
                				          	           <th class="th-head">Name </th>
                				          	           <td class="th-head" colspan="3"><?=($insurer->type=="self")?$param->selfName."(You)":$insurer->fname." ".$insurer->lname."(".ucfirst($insurer->type).")";?></td>
                				          	       </tr>
                				          	       <tr>
                				          	           <th>DOB</th><td><?=($insurer->type=="self")?$param->selfdd."/".$param->selfmm."/".$param->selfyy:$insurer->dd."/".$insurer->mm."/".$insurer->yy;?></td>
                				          	           <th>Gender</th><td><?=($insurer->type=="self")?$param->gender:$insurer->gender;?></td>
                				          	           
                				          	       </tr>
                				          	       <tr>
                				          	           <th>Height</th><td> <?=($insurer->type=="self")?$param->selfFeet." ft ".$param->selfInch." inch":$insurer->feet."ft ".$insurer->inch." inch";?></td>
                				          	           <th>Weight</th><td> <?=($insurer->type=="self")?$param->selfWeight:$insurer->weight;?> Kg</td>
                				          	       </tr>
                				          	       
                				          	        <?php if(isset($insurer->medical)){
                                                              if(!empty($insurer->medical)){ ?>
                                                                  <tr>
                            				          	             <th class="th-head" colspan="4">Pre Existing Disease </th>
                            				          	          </tr> 
                            				          	         <?php foreach($insurer->medical as $q){?>
                            				          	           <tr>
                            				          	             <td class="th-head" colspan="4"> <?=$q->title;?> : <b>Yes</b></td>
                            				          	           </tr> 
                            				          	           <?php if($q->hasChildQuestions && !empty($q->childQuestions)){ 
                            				          	                   foreach($q->childQuestions as $chQ){?>
                                				          	            <tr>
                                    				          	           <th colspan="3" class="th-head"> {{$chQ->title}}  </th>
                                    				          	           <td class="th-head">
                                    				          	               {{$chQ->answer}}
                                    				          	           </td>
                                    				          	       </tr> 
                                				          	       <?php } } ?>
                            				          	         <?php } ?>
                                                         <?php } } ?>
        				          	       <?php } ?>
        				          	       
        				          	       
        				          	         <tr>
        				          	             <th class="th-head" colspan="4">Nominee Details</th>
        				          	         </tr>
        				          	         <tr>
        				          	           <th class="th-head">Name</th>
        				          	           <td class="th-head" colspan="3"><?=$params->nomineename;?></td>
        				          	         </tr>
        				          	          <tr>
        				          	           <th>DOB</th><td>{{$param->nomineedd}}/{{$param->nomineemm}}/{{$param->nomineeyy}}</td>
        				          	           <th>Relation</th><td><?=isset($param->nomineerelation)?$param->nomineerelation:"";?> </td>
        				          	         </tr>
        				          	       
        				          	       <tr>
        				          	             <th class="th-head" colspan="4">Document Details</th>
        				          	         </tr>
        				          	         <tr>
        				          	           <th class="th-head">Doument</th>
        				          	           <td class="th-head" colspan="3"><?=isset($param->document->documentType)?str_replace("_"," ",$param->document->documentType):"";?></td>
        				          	         </tr>
        				          	         <tr>
        				          	           <th>Document ID</th><td><?=isset($param->document->documentId)?$param->document->documentId:"";?></td>
        				          	           <th>Issue Date</th><td><?=isset($param->document->documentdd)?$param->document->documentdd.'/'.$param->document->documentmm.'/'.$param->document->documentyy:"";?></td>
        				          	         </tr>
        				          	       <tr>
        				          	             <th class="th-head" colspan="4">Communication Address</th>
        				          	         </tr>
        				          	       <tr>
        				          	           <th class="th-head">Address</th>
        				          	           <td class="th-head" colspan="3"><?=$param->address->house_no;?> <?=$param->address->street;?></td>
        				          	       </tr>
        				          	       <tr>
        				          	           <th>City</th><td>{{explode('-',$param->address->city)[1]}}</td>
        				          	           <th>State</th><td>{{explode('-',$param->address->state)[1]}}</td>
        				          	       </tr>
        				          	       <tr>
        				          	           
        				          	           <th>Pincode</th><td><?=$params->address->pincode;?></td>
        				          	           
        				          	       </tr>
        				          	       <tr>
        				          	           <td  class="th-head" colspan="4">
        				          	                I understand that by clicking on Payment button and making a payment, I am signing the proposal form. And I also hereby appoint SUPER FINSERV PRIVATE LIMITED as my corporate agent, and authorize them to represent me to Insurance Companies for my Insurance needs.
        				          	           </td>
        				          	       </tr>
        				          	       <tr>
        				          	           <td class="th-head" colspan="3">
        				          	               <div class="form-check" id="effect">
                                                    <input type="checkbox" class="form-check-input isChecked" id="agreeTerms" style="margin:5px 0 0;">
                                                    <label style="margin-left: 18px;font-size: 13px;color: #000;" class="form-check-label" >I agree to the <a target="_blank" href="{{config('custom.site_url')}}/terms-conditions" class="readTermsConditions">Terms & Conditions</a></label>
                                                  </div>
        				          	           </td>
        				          	           <td class="th-head">
        				          	                
        				          	                <button class="btn btn-success btn-lg mb30"  data-enc="<?=$info->enquiry_id;?>" id="paynow_amount" style="width:100%;padding:3px;">Pay Securely</button>
        				          	           </td>
        				          	       </tr>
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