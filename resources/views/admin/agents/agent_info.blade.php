@extends('admin.layout.app')
@section('content')
<style>
      .information{
            margin-bottom:5px;
            color:#484747;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
        }
        .information .info-label{
            font-weight:600;
            color:#252424;
        }
        .information .info-label i{
            margin-bottom:5px;
            color:#ac0d08;
            margin-right: 5px;
        }
</style>
  <?php $state = ($agentData->state!="")?DB::table('states_list')->where('id',$agentData->state)->first()->name:"";
        $city = ($agentData->city!="")?DB::table('cities_list')->where('id',$agentData->city)->first()->name:"";
        $address = $agentData->address.",".$city.",".$state."-".$agentData->pincode;
       // $assetUrl = "https://supersoluti ons.in/insassets/agents/";
       
    ?>
  
   <div class="br-section-wrapper">
            <div class="bg-white-1">
                
                 <div class="row">
                    <div class="col-lg-3 mg-t-30 mg-lg-t-0">
                        <div class="card pd-20 pd-xs-30 shadow-base bd-0 text-center bg-white p-4 rounded">
                                <img 
                                   src="<?=($agentData->profile!="")?asset('assets/agents/profile/'.$agentData->profile):asset('assets/agents/profile/avatar.png');?>" class="rounded-circle shadow avatar avatar-md-md" alt="">
                                <h5 class="mt-3 mb-0">{{$agentData->name}}</h5>
                                <small class="text-muted">{{$agentData->application_no}}</small>
                                <div class="row mt-4">
                                    <div class="col-6 text-center">
                                        <i class="ti ti-user-plus text-primary mb-2 fs-5"></i>
                                        <h5 class="mb-0">2588</h5>
                                        <p class="text-muted mb-0">Followers</p>
                                    </div><!--end col-->
                                    <div class="col-6 text-center">
                                        <i class="ti ti-users text-primary mb-2 fs-5"></i>
                                        <h5 class="mb-0">454</h5>
                                        <p class="text-muted mb-0">Following</p>
                                    </div><!--end col-->
                                </div><!--end row-->
                                

                            </div>
                           <div class="card border-0  mg-t-30  rounded shadow p-4">
                                    <h5 class="mb-0">Personal Details :</h5>
                                    <div class="mt-4">
                                        <div class="d-flex align-items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail fea icon-ex-md text-muted mg-r-10"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                            <div class="flex-1">
                                                <h6 class="text-primary mb-0">Email :</h6>
                                                <a href="javascript:void(0)" class="text-muted">{{$agentData->email}}</a>
                                            </div>
                                            
                                        </div>
                                        
                                        <div class="d-flex align-items-center mt-3">
                                             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone fea icon-ex-md text-muted mg-r-10"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                                             <div class="flex-1">
                                                <h6 class="text-primary mb-0">Mobile :</h6>
                                                <a href="javascript:void(0)" class="text-muted">{{$agentData->mobile}}</a>
                                            </div>
                                            
                                        </div>
                                        <div class="d-flex align-items-center mt-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin fea icon-ex-md text-muted mg-r-10"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                            <div class="flex-1">
                                                <h6 class="text-primary mb-0">Address :</h6>
                                                <a href="javascript:void(0)" class="text-muted">{{$agentData->address}}, {{$agentData->city_name}}, {{$agentData->state_name}}({{$agentData->pincode}})</a>
                                              </div>
                                        </div>
                                        
                                        
                                    </div>
                                </div>
                                
                                <div class="card border-0 rounded shadow p-4 mt-4 ">
                                    <h5 class="mb-0 text-danger">Application Status:</h5>
        
                                    <div class="mt-4 Application-Status-Elem">
                                        @if($agentData->application_status=="Pending")
                                        <h6 class="mb-0" style="letter-spacing: 0.7px;font-weight: 300;">Do you want to <span class="text-success">Approve</span> or <span class="text-danger">Decline</span> the application? Please press below "Approve/Decline" button</h6>
                                        <div class="mt-4">
                                            <button class="btn btn-success btn-sm btn-app-status" data-id="{{$agentData->id}}" data-status="Approved">Approve</button>
                                            <button class="btn btn-danger btn-sm btn-app-status" data-id="{{$agentData->id}}" data-status="Declined">Decline</button>
                                        </div><!--end col-->
                                         @elseif($agentData->application_status=="Approved")
                                         <button class="btn btn-success btn-sm">Approve</button>
                                         @elseif($agentData->application_status=="Declined")
                                         <button class="btn btn-danger btn-sm ">Decline</button>
                                         @endif
                                    </div>
                                </div>
                                
                                @if($agentData->application_status=="Approved")
                                
                                  <div class="card border-0 rounded shadow p-4 mt-4 ">
                                    <h5 class="mb-0 text-danger">Posp Profile Status:</h5>
        
                                    <div class="mt-4 Application-Status-Elem">
                                        @if($agentData->status=="Pending")
                                         <button class="btn btn-primary btn-sm">Pending</button>
                                        @elseif($agentData->status=="Inforce")
                                         <button class="btn btn-success btn-sm">Inforce</button>
                                        @elseif($agentData->status=="Declined")
                                         <button class="btn btn-danger btn-sm ">Declined</button>
                                        @elseif($agentData->status=="Suspended")
                                         <h6 class="mb-0" style="letter-spacing: 0.7px;font-weight: 300;">Posp is  <span class="text-warning">Suspended</span> for some time due to internal reasons.</h6>
                                         <button class="btn btn-warning btn-sm ">Suspended</button>
                                        @endif
                                    </div>
                                </div>
                                
                                @endif
                                
                        <?php /*
                        <div class="card pd-20 pd-xs-30 shadow-base bd-0">
                         <a href="" class="mg-b-15 d-block text-center">
                               <img src="<?=($agentData->profile!="")?asset('assets/agents/profile/'.$agentData->profile):asset('assets/agents/profile/avatar.png');?>" 
                                    class="img-fluid rounded" alt="" style="width: 200px;height: 200px;border: 1px solid #ccc;">
                         </a>
                         
                           <h6 class="tx-gray-800 tx-uppercase tx-semibold tx-13 mg-b-25">Personal Information</h6>

                            <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Agent Name</label>
                            <p class="tx-info mg-b-25"><?=$agentData->name;?></p>
                            
                            <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Mobile Number(primary)</label>
                            <p class="tx-info mg-b-25"><?=$agentData->mobile;?></p>
                            
                             <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Mobile Number(alternate)</label>
                             <p class="tx-info mg-b-25">{{($agentData->alternate_mobile!='')?$agentData->alternate_mobile:"----"}}</p>
            
            
                            <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Email Address</label>
                            <p class="tx-inverse mg-b-25"><?=$agentData->email;?></p>
                            
                            <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Gender</label>
                             <p class="tx-info mg-b-25"><?=$agentData->sex;?></p>
                             
                             <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Merital Status</label>
                             <p class="tx-info mg-b-25"><?=$agentData->marital_status;?></p>
            
                            <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Home Address</label>
                            <p class="tx-inverse mg-b-25"><?=$address;?></p>
            
                           <hr/>
                           
                          
                        <h6 class="tx-gray-800 tx-uppercase tx-semibold tx-13 mg-b-5">IS AGENT VERIFIED ?</h6>
        
                        <?php if($agentData->isVerified==0){
                             if($agentData->isProceedSign==0){
                                 echo "<a href='#' class='text-danger'>Did Not proceed for verification.</a> ";
                             }else{ ?>
                                    <p class='text-success'>Proceed for verification </br>
                                    <?php if($agentData->videoFile!=""){?>
                                         <a download='' target='_blank' href='<?=asset('assets/agents/profile/'.$agentData->videoFile);?>' class='link text-info'><i class="fas fa-download"></i> Download Identity Video</a>
                                        <?php }else{  echo "Identity not uploaded yet";} ?>
                                    </span>
                                </br>
                                <p class="mg-b-25">If you have checked <a href="#" data-name="<?=$agentData->name;?>" data-isVerified="<?=$agentData->isVerified;?>" data-id="<?=$agentData->id;?>" class="btn-markVerify">click here to verified.</a></p>
                          <?php } 
                         }else{ echo '<p class="tx-info mg-b-25">Yes! Varified.</p>'; }?>
                         <hr/>
                        
                        <h6 class="tx-gray-800 tx-uppercase tx-semibold tx-13 mg-b-5">Is allow test(certification) ?</h6>
                          <p>
                              @if($agentData->is_tranning_complete=='YES')
                              
                              <a href='#' class='{{($agentData->isTestAllow==1)?"text-success":"text-danger"}}'>{{($agentData->isTestAllow==1) ? "Yes! Allowed":"Not Allowed"}}</a>
                              <a href="#" class="btn-testAllow" data-name="<?=$agentData->name;?>" data-id="<?=$agentData->id;?>" data-isTestAllow="<?=$agentData->isTestAllow;?>">click here to change.</a>
                             @else <a href="#"><?=$agentData->name;?>, is Under Training</a> @endif
                          </p>
                        <hr/>
                        
                        <h6 class="tx-gray-800 tx-uppercase tx-semibold tx-13 mg-b-5">Is paid application fee? 
                            <?=($agentData->payment_status==1)?"<a href='#' class='text-success'>Yes! Paid</a>":"<a href='#' class='text-danger'>Not Paid yet!</a>";?>
                            </h6>
                         <?php $pCnt = DB::table('agent_payments')->where('agent_id',$agentData->id)->count();
                             
                         if($pCnt>0 && $agentData->payment_status==1){ 
                            $pay = DB::table('agent_payments')->where('agent_id',$agentData->id)->first();?>
                         
                         <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Transaction ID</label>
                         <p class="tx-inverse mg-b-25"><?=$pay->transaction_id;?></p>
                        
                          <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Transaction Date</label>
                          <p class="tx-inverse mg-b-25"><?=$pay->transaction_date;?></p>
                          
                          <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Paid Amount</label>
                          <p class="tx-inverse mg-b-25">₹<?=$pay->total_amount;?></p>
                               
                           
                        <?php  }else{?>
                            <p class="tx-danger tx-normal mg-b-20"><?=$agentData->name;?> ,did'nt paid Application fee yet!</p>
                         <?php } ?>
                       
                       
                        
                </div><!-- card -->
                */?>
                    </div>
                    <div class="col-md-9 col-lg-8 pd-10">
                            <div class="row">
                                <div class="col-md-12 col-lg-12 pd-10">
                                    <div class="card">
                                        <div class="card-header d-flex align-items-center justify-content-between pd-y-5">
                                          <h6 class="mg-b-0 tx-14 tx-inverse">Bank Details</h6>
                                          <div class="card-option tx-24">
                                           <a href="#" class="<?=($info['bank']<100)?"tx-danger":"tx-success";?> mg-l-10">(<?=$info['bank'];?>% complete)</a>
                                          </div><!-- card-option -->
                                        </div><!-- card-header -->
                                        <div class="card-body">
                                             <ul class="list-group">
                                              <li class="list-group-item rounded-top-0">
                                                <p class="mg-b-0">
                                                  <i class="fa fa-cube tx-info mg-r-8"></i>
                                                  <strong class="tx-inverse tx-medium">Bank Name: </strong>
                                                  <span class="text-muted"><?=$agentData->bank_name;?></span>
                                                </p>
                                              </li>
                                              <li class="list-group-item rounded-top-0">
                                                <p class="mg-b-0">
                                                  <i class="fa fa-cube tx-info mg-r-8"></i>
                                                  <strong class="tx-inverse tx-medium">Account Holder Name: </strong>
                                                  <span class="text-muted"><?=$agentData->account_holder_name;?></span>
                                                </p>
                                              </li>
                                              <li class="list-group-item rounded-top-0">
                                                <p class="mg-b-0">
                                                  <i class="fa fa-cube tx-info mg-r-8"></i>
                                                  <strong class="tx-inverse tx-medium">Account Number: </strong>
                                                  <span class="text-muted"><?=$agentData->account_number;?></span>
                                                </p>
                                              </li>
                                              <li class="list-group-item rounded-top-0">
                                                <p class="mg-b-0">
                                                  <i class="fa fa-cube tx-info mg-r-8"></i>
                                                  <strong class="tx-inverse tx-medium">IFSC code: </strong>
                                                  <span class="text-muted"><?=$agentData->ifsc_code;?></span>
                                                </p>
                                              </li>
                                              <li class="list-group-item rounded-top-0">
                                                <p class="mg-b-0">
                                                  <i class="fa fa-cube tx-info mg-r-8"></i>
                                                  <strong class="tx-inverse tx-medium">Passbook/Bank statement: </strong>
                                                  <span class="text-muted"><?=$agentData->bank_name;?> 
                                                  @if($agentData->passbook_statement!="")
                                                  <a target="_blank"  href="{{url('get/download/file/passbook-statement/'.$agentData->passbook_statement)}}"><i class="fas fa-download"></i> download</a>
                                                  @else 
                                                    Not available
                                                  @endif
                                                  
                                                  </span>
                                                </p>
                                              </li>
                                            </ul>
                                        </div><!-- card-body -->
                                        
                                    </div>
                    </div>
                                <div class="col-md-12 col-lg-12 pd-10">
                                    <div class="card">
                                        
                                        <div class="card-header d-flex align-items-center justify-content-between pd-y-5">
                                          <h6 class="mg-b-0 tx-14 tx-inverse">Education Details</h6>
                                          <div class="card-option tx-24">
                                            <a href="#" class="<?=($info['education']<100)?"tx-danger":"tx-success";?> mg-l-10">(<?=$info['education'];?>% complete)</a>
                                           </div><!-- card-option -->
                                        </div><!-- card-header -->
                                        <div class="card-body">
                                             <ul class="list-group">
                                              <li class="list-group-item rounded-top-0">
                                                <p class="mg-b-0">
                                                  <i class="fa fa-cube tx-info mg-r-8"></i>
                                                  <strong class="tx-inverse tx-medium">Qualification: </strong>
                                                  <span class="text-muted"><?=$agentData->educational_qualification;?></span>
                                                </p>
                                              </li>
                                              
                                              <li class="list-group-item rounded-top-0">
                                                <p class="mg-b-0">
                                                  <i class="fa fa-cube tx-info mg-r-8"></i>
                                                  <strong class="tx-inverse tx-medium">Certificate: </strong>
                                                  <span class="text-muted"> 
                                                  @if($agentData->education_certificate!="")
                                                  <a target="_blank"  href="{{url('get/download/file/education-certificate/'.$agentData->education_certificate)}}"><i class="fas fa-download"></i> download</a>
                                                  @else 
                                                  Not available
                                                  @endif
                                                  
                                                  </span>
                                                </p>
                                              </li>
                                            </ul>
                                        </div><!-- card-body -->
                                        
                                    </div>
                    </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-lg-12 pd-10">
                                    <div class="card">
                                        <div class="card-header d-flex align-items-center justify-content-between pd-y-5">
                                          <h6 class="mg-b-0 tx-14 tx-inverse">Required Documents </h6>
                                          <div class="card-option tx-24">
                                           <a href="#" class="<?=($info['document']<100)?"tx-danger":"tx-success";?> mg-l-10">(<?=$info['document'];?>% complete)</a>
                                          </div><!-- card-option -->
                                        </div><!-- card-header -->
                                        <div class="card-body">
                                             <ul class="list-group">
                                              <li class="list-group-item rounded-top-0">
                                                <p class="mg-b-0">
                                                  <i class="fa fa-cube tx-info mg-r-8"></i>
                                                  <strong class="tx-inverse tx-medium"> PAN card Number: </strong>
                                                  <span class="text-muted"><?=$agentData->pan_card_number;?></span>
                                                </p>
                                              </li>
                                              <li class="list-group-item rounded-top-0">
                                                <p class="mg-b-0">
                                                  <i class="fa fa-cube tx-info mg-r-8"></i>
                                                  <strong class="tx-inverse tx-medium">PAN card (attachment): </strong>
                                                  <span class="text-muted"> 
                                                  
                                                  @if($agentData->pan_card!="")
                                                  <a target="_blank"  href="{{url('get/download/file/pan-card/'.$agentData->pan_card)}}"><i class="fas fa-download"></i> download</a>
                                                  @else 
                                                  Not available
                                                  @endif
                                                  </span>
                                                </p>
                                              </li>
                                              <li class="list-group-item rounded-top-0">
                                                <p class="mg-b-0">
                                                  <i class="fa fa-cube tx-info mg-r-8"></i>
                                                  <strong class="tx-inverse tx-medium">Address proof(Aadhar/licence/passport): </strong>
                                                  <span class="text-muted"><?=$agentData->adhaar_card_number;?></span>
                                                </p>
                                              </li>
                                              <li class="list-group-item rounded-top-0">
                                                <p class="mg-b-0">
                                                  <i class="fa fa-cube tx-info mg-r-8"></i>
                                                  <strong class="tx-inverse tx-medium">Address proof(attachment-1): </strong>
                                                  <span class="text-muted"> 
                                                   @if($agentData->adhaar_card!="")
                                                    <a target="_blank"  href="{{url('get/download/file/adhaar-card/'.$agentData->adhaar_card)}}"><i class="fas fa-download"></i> download</a>
                                                   @else 
                                                    Not available
                                                  @endif
                                                  </span>
                                                </p>
                                              </li>
                                              <li class="list-group-item rounded-top-0">
                                                <p class="mg-b-0">
                                                  <i class="fa fa-cube tx-info mg-r-8"></i>
                                                  <strong class="tx-inverse tx-medium">Address proof(attachment-2): </strong>
                                                  <span class="text-muted"><?=$agentData->bank_name;?> 
                                                   @if($agentData->adhaar_card_back!="")
                                                    <a target="_blank"  href="{{url('get/download/file/adhaar-card/'.$agentData->adhaar_card_back)}}"><i class="fas fa-download"></i> download</a>
                                                   @else 
                                                    Not available
                                                  @endif
                                                 </span>
                                                </p>
                                              </li>
                                            </ul>
                                        </div><!-- card-body -->
                                        
                        </div>
                              </div>
                                <div class="col-md-12 col-lg-12 pd-10">
                                    <div class="card">
                                        
                                        <div class="card-header d-flex align-items-center justify-content-between pd-y-5">
                                          <h6 class="mg-b-0 tx-14 tx-inverse">Business Inforamtions</h6>
                                          <div class="card-option tx-24">
                                        </div><!-- card-option -->
                                        </div><!-- card-header -->
                                        <div class="card-body">
                                        <?php $busscount = DB::table('agent_bussness_info')->where('agent_id',$agentData->id)->count();
                                             if($busscount){
                                                $bussInfo = DB::table('agent_bussness_info')->where('agent_id',$agentData->id)->first();?>
                                                     <ul class="list-group">
                                                      <li class="list-group-item rounded-top-0">
                                                        <p class="mg-b-0">
                                                          <i class="fa fa-cube tx-info mg-r-8"></i>
                                                          <strong class="tx-inverse tx-medium"> Primary Source of income: </strong>
                                                          <span class="text-muted"><?=$bussInfo->income;?></span>
                                                        </p>
                                                      </li>
                                                      
                                                      <li class="list-group-item rounded-top-0">
                                                        <p class="mg-b-0">
                                                          <i class="fa fa-cube tx-info mg-r-8"></i>
                                                          <strong class="tx-inverse tx-medium">Year of experience: </strong>
                                                          <span class="text-muted">  <?=$bussInfo->exp;?></span>
                                                        </p>
                                                      </li>
                                                      
                                                      <li class="list-group-item rounded-top-0">
                                                        <p class="mg-b-0">
                                                          <i class="fa fa-cube tx-info mg-r-8"></i>
                                                          <strong class="tx-inverse tx-medium"> GSITIN no: </strong>
                                                          <span class="text-muted"><?=$bussInfo->gstin;?></span>
                                                        </p>
                                                      </li>
                                                      
                                                      
                                                      <li class="list-group-item rounded-top-0">
                                                        <p class="mg-b-0">
                                                          <i class="fa fa-cube tx-info mg-r-8"></i>
                                                          <strong class="tx-inverse tx-medium"> Have a dedicated office space for handling insurance business?: </strong>
                                                          <span class="text-muted">  <?=($bussInfo->is_ins_bus==1)?"YES":"NO";?></span>
                                                        </p>
                                                      </li>
                                                      
                                                      <li class="list-group-item rounded-top-0">
                                                        <p class="mg-b-0">
                                                          <i class="fa fa-cube tx-info mg-r-8"></i>
                                                          <strong class="tx-inverse tx-medium"> Have a dedicated office space for handling insurance business?: </strong>
                                                          <span class="text-muted">  <?=($bussInfo->is_ins_bus==1)?"YES":"NO";?></span>
                                                        </p>
                                                      </li>
                                                      
                                                     </ul>
                                                    <p class="information"><b><u>Monthly Avarage Business:</u></b></p>
                                                     <ul class="list-group">
                                                          <li class="list-group-item rounded-top-0">
                                                            <p class="mg-b-0">
                                                              <i class="fa fa-cube tx-info mg-r-8"></i>
                                                              <strong class="tx-inverse tx-medium">Moter Premium: </strong>
                                                              <span class="text-muted"> <?=$bussInfo->motor_premium;?></span>
                                                            </p>
                                                          </li>
                                                          <li class="list-group-item rounded-top-0">
                                                            <p class="mg-b-0">
                                                              <i class="fa fa-cube tx-info mg-r-8"></i>
                                                              <strong class="tx-inverse tx-medium">Health Premium: </strong>
                                                              <span class="text-muted"> <?=$bussInfo->health_premium;?></span>
                                                            </p>
                                                          </li>
                                                          <li class="list-group-item rounded-top-0">
                                                            <p class="mg-b-0">
                                                              <i class="fa fa-cube tx-info mg-r-8"></i>
                                                              <strong class="tx-inverse tx-medium">Life Premium: </strong>
                                                              <span class="text-muted"> <?=$bussInfo->life_premium;?></span>
                                                            </p>
                                                          </li>
                                                          <li class="list-group-item rounded-top-0">
                                                            <p class="mg-b-0">
                                                              <i class="fa fa-cube tx-info mg-r-8"></i>
                                                              <strong class="tx-inverse tx-medium"><u>Following licence currently hold:</u> </strong>
                                                              <span class="text-muted"><?=($bussInfo->is_none==1)?" Currently No Licence Hold.":"";?></span>
                                                            </p>
                                                          </li>
                                                           <?php if($bussInfo->is_none==0){ ?>
                                                           <li class="list-group-item rounded-top-0">
                                                            <p class="mg-b-0">
                                                              <i class="fa fa-cube tx-info mg-r-8"></i>
                                                              <strong class="tx-inverse tx-medium">Agency Health:</strong>
                                                              <span class="text-muted"><?=($bussInfo->is_agency_health)?$bussInfo->agency_health:"No";?></span>
                                                            </p>
                                                          </li>
                                                          <li class="list-group-item rounded-top-0">
                                                            <p class="mg-b-0">
                                                              <i class="fa fa-cube tx-info mg-r-8"></i>
                                                              <strong class="tx-inverse tx-medium">Agency Life:</strong>
                                                              <span class="text-muted"> <?=($bussInfo->is_agency_life)?$bussInfo->agency_life:"No";?></span>
                                                            </p>
                                                          </li>
                                                          
                                                          <li class="list-group-item rounded-top-0">
                                                            <p class="mg-b-0">
                                                              <i class="fa fa-cube tx-info mg-r-8"></i>
                                                              <strong class="tx-inverse tx-medium">Agency General:</strong>
                                                              <span class="text-muted"><?=($bussInfo->is_agency_general)?$bussInfo->agency_general:"No";?></span>
                                                            </p>
                                                          </li>
                                                          
                                                          <li class="list-group-item rounded-top-0">
                                                            <p class="mg-b-0">
                                                              <i class="fa fa-cube tx-info mg-r-8"></i>
                                                              <strong class="tx-inverse tx-medium">POS Life:</strong>
                                                              <span class="text-muted"><?=($bussInfo->is_pos_life)?$bussInfo->pos_life:"No";?></span>
                                                            </p>
                                                          </li>
                                                          
                                                          <li class="list-group-item rounded-top-0">
                                                            <p class="mg-b-0">
                                                              <i class="fa fa-cube tx-info mg-r-8"></i>
                                                              <strong class="tx-inverse tx-medium">POS General:</strong>
                                                              <span class="text-muted"><?=($bussInfo->is_pos_general)?$bussInfo->pos_general:"No";?></span>
                                                            </p>
                                                          </li>
                                                          
                                                          <li class="list-group-item rounded-top-0">
                                                            <p class="mg-b-0">
                                                              <i class="fa fa-cube tx-info mg-r-8"></i>
                                                              <strong class="tx-inverse tx-medium">Surveyor:</strong>
                                                              <span class="text-muted"><?=($bussInfo->is_surveyor)?$bussInfo->surveyor:"No";?></span>
                                                            </p>
                                                          </li>
                                                           <?php } ?>
                                                      </ul>
                                            <?php } ?>
                                        </div><!-- card-body -->
                                        
                        </div>
                              </div>
                           </div>
                    </div><!-- col-8 ech section-->
                   
                 </div>
                
            </div><!-- card -->
    </div><!-- col-9 -->
         
        </div>
@endsection