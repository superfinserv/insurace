@extends('admin.layout.app')
@section('content')
<?php  $assetUrl = "https://supersolutions.in/insurance/agents/";?>
  <div class="card bd-0 ">
     <style> .clr{  color: #0a4b55 !important;}</style>
     @include('admin.agents.agents_menu_header')
    <div class="card-body bd bd-t-0 rounded-bottom">
        <div class="row">
            <div class="col-md-3 col-lg-3">
                 @include('admin.agents.agents_menu')
            </div>
              
            <div class="col-md-9 col-lg-9 mg-t-20 mg-lg-t-0-force">
               <div class="agent-other-notify"></div>
                <form class="form-group" method="post" enctype="multipart/form-data" action="#" id="agentOtherInfo" >
                  <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                  <input name="_agent"  id="_agent" type="hidden" value="{{$agentData->id}}" />
                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                            <label class="form-control-label">HDFC userid: <span class="tx-danger">*</span></label>
                            <div class="input-group">
                            <input type="text" style="border-radius: 0px;" class="form-control" id="hdfc_id" name="hdfc_id" value="{{$agentData->hdfc_id}}" placeholder="Enter HDFC User id">
                            <span class="input-group-btn">
                              <button style="border-radius: 0;border-left: none;background-color: red;" class="btn bd bg-danger tx-gray-600 agent-hdfc-btn" type="button"><i class="fas fa-check"></i></button>
                            </span>
                          </div>
                         </div>
                      </div>
                      
                      <div class="col-md-6">
                          <div class="form-group" style="margin-bottom:0px;">
                            <label class="form-control-label">Assign Specified Person: <span class="tx-danger">*</span></label>
                            <div class="input-group">
                                 <select class="form-control select2-show-search"  data-placeholder="Choose one" name="sp_id" id="sp_id" style="width: 80%;">
                                     <option value="">Choose Specified Person</option>
                                         @foreach ($sps as $sp)
                                           <option value="{{$sp->id}}"  @if($sp->id==$agentData->mapped_sp) selected @endif>{{$sp->name}}</option>
                                         @endforeach
                                  </select>
                            <span class="input-group-btn">
                              <button class="btn bd bg-white tx-gray-600 agentSpMapBtn" type="button"><i class="fas fa-check"></i></button>
                            </span>
                          </div>
                         </div>
                      </div>
                  </div>
                  
                  @isset($mappedsp)
                    <div class="row mg-t-10">
                       <table class="table table-bordered" style="border: 1px solid #dee2e6;">
                           <thead class="thead-colored thead-light">
                               <tr><th>SP NAME</th><th>SP Phone</th><th>SP Email</th></tr>
                           </thead>
                           <tbody>
                               <tr><td>{{$mappedsp->name}}</td><td>{{$mappedsp->mobile}}</td><td>{{$mappedsp->email}}</td></tr>
                           </tbody>
                       </table>
                    </div>
                   @endisset
               
                   
                </form>
                
                   @if($agentData->application_status=="Approved")
                   
                     <?php  $trn_user = "";$trn_pass = "";$istrncrdSent = false;
                        if($agentData->tranning_crd!=""){
                               $crd = json_decode($agentData->tranning_crd);
                               $trn_user = $crd->username;
                               $trn_pass = $crd->pass;
                               $istrncrdSent = true;
                           } ?>
                    <div class="card mg-b-20">
                    <div class="card-header d-flex align-items-center justify-content-between ">
                        <h6 class="mg-b-0 tx-14 tx-inverse"> Training credentials</h6>
                           <div class="card-option tx-12"></div>
                    </div><!-- card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group" style="margin-bottom:0px;">
                                  <label class="form-control-label">Username: <span class="tx-danger">*</span></label>
                                  <input class="form-control tr-field" type="text" name="tr_username" id="tr_username" value="<?=$trn_user;?>" placeholder="Enter username">
                                </div>
                                
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group" style="margin-bottom:0px;">
                                  <label class="form-control-label">Password: <span class="tx-danger">*</span></label>
                                  <input class="form-control tr-field" type="text" name="tr_pass" id="tr_pass" value="<?=$trn_pass;?>" placeholder="Enter password">
                                </div>
                           </div>
                            <div class="col-md-3">
                                @if($istrncrdSent)
                                  <button type="button" class="btn btn-success mg-t-30 ">Already sent</button>
                                  <button type="button" class="btn btn-sm btn-primary active mg-t-30 btn-send-tr-crd">Re-send</button>
                                @else
                                  <button type="button" class="btn btn-teal active btn-block mg-t-30 btn-send-tr-crd">Send Mail</button>
                                @endif
                            </div>
                            
                        </div>
                    </div>
                </div>
                  @if($istrncrdSent)
                    <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between ">
                        <h6 class="mg-b-0 tx-14 tx-inverse">
                            Is Training Completed ? Then upload Certificate</span></label>
                        </h6>
                       <div class="card-option tx-12" id="isTranningCompletedStatus"></div>
                    </div><!-- card-header -->
                    <div class="card-body" id="isTranningCompletedBody" >
                        <div class="row">
                             
                             
                            <div class="col-lg-6 col-md-6">
                                <span>Life Insurance Training Certificate</span>
                               <table class="table table-bordered table-file-has-life_ins_cert" style="@if($agentData->life_ins_cert!='') display:block;@else display:none; @endif border: 1px solid #ccc;margin-top:7px;">
                                    <thead style="">
                                        <tr>
                                            <th style="width:70%;"><span id="life_ins_cert_name"><?=$agentData->life_ins_cert;?></span></th>
                                            <th style="width:30%;padding: 2px 11px 0px 18px;">
                                              <a class="btn btn-dark btn-icon mg-r-5" download target="_blank" href="<?=$assetUrl.'tranning_certificates/'.$agentData->life_ins_cert;?>"><div><i class="fas fa-file-download"></i></div></a>
                                              <a class="btn btn-danger btn-icon btn-remove-file mg-r-5" href="#" data-doc="life_ins_cert"><div><i class="fas fa-trash-alt"></i></div></a>
                                            </th>
                                        </tr>
                                    </thead>
                                </table>
                                
                                <table class="table table-bordered table-file-choose-life_ins_cert" style="@if($agentData->life_ins_cert!='') display:none;@else display:block; @endif border: 1px solid #ccc;margin-top:7px;">
                                     <thead class="">
                                        <tr>
                                           <th style="width:90%;padding: 0px;"><input type="file" class="form-control" name="new_life_ins_cert" id="new_life_ins_cert" /></th>
                                           <th style="width:10%;padding: 2px 5px 2px 10px;"><a class="btn btn-success btn-icon mg-r-5 uploadattach" data-doc="life_ins_cert" href="#"  ><div><i class="fas fa-check-square"></i></div></a></th>
                                        </tr>
                                        <tr>
                                            <th>
                                                <div class="progress" id="myprogress-container-life_ins_cert" style="display:none;">
                                                   <div class="progress-bar myprogress-life_ins_cert" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                                                </div>
                                            </th>
                                        </tr>
                                     </thead>
                               </table>
                           
                               
                               
                            </div>
                            
                            <div class="col-lg-6 col-md-6">
                                <span>General Insurance Tranning Certificate</span>
                               <table class="table table-bordered table-file-has-general_ins_cert" style="@if($agentData->general_ins_cert!='') display:block;@else display:none; @endif border: 1px solid #ccc;margin-top:7px;">
                                    <thead style="">
                                        <tr>
                                            <th style="width:70%;"><span id="general_ins_cert_name"><?=$agentData->general_ins_cert;?></span></th>
                                            <th style="width:30%;padding: 2px 11px 0px 18px;">
                                              <a class="btn btn-dark btn-icon mg-r-5" download target="_blank" href="<?=$assetUrl.'tranning_certificates/'.$agentData->general_ins_cert;?>"><div><i class="fas fa-file-download"></i></div></a>
                                              <a class="btn btn-danger btn-icon btn-remove-file mg-r-5" href="#" data-doc="general_ins_cert"><div><i class="fas fa-trash-alt"></i></div></a>
                                            </th>
                                        </tr>
                                    </thead>
                                </table>
                                
                                <table class="table table-bordered table-file-choose-general_ins_cert" style="@if($agentData->general_ins_cert!='') display:none;@else display:block; @endif border: 1px solid #ccc;margin-top:7px;">
                                     <thead class="">
                                        <tr>
                                           <th style="width:90%;padding: 0px;"><input type="file" class="form-control" name="new_general_ins_cert" id="new_general_ins_cert" /></th>
                                           <th style="width:10%;padding: 2px 5px 2px 10px;"><a class="btn btn-success btn-icon mg-r-5 uploadattach" data-doc="general_ins_cert" href="#"  ><div><i class="fas fa-check-square"></i></div></a></th>
                                        </tr>
                                        <tr>
                                            <th>
                                                <div class="progress" id="myprogress-container-general_ins_cert" style="display:none;">
                                                   <div class="progress-bar myprogress-general_ins_cert" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                                                </div>
                                            </th>
                                        </tr>
                                     </thead>
                               </table>
                             
                               
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-5">
                                <label class="ckbox">
                                      <input type="checkbox" name="isTranningCompleted" id="isTranningCompleted">
                                        <span style="font-size: 13px;">Check here and allow posp to take cerification Test.</span>
                                    </label>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-primary btn-sm" id="isTranningCompletedBtn">Yes! Training Completed</button>
                            </div>
                        </div>
                    </div><!-- card-body -->
                  </div><!-- card -->
                  @endif
                  @endif
                      
            </div><!-- col-9 -->
        </div>
                 
     </div><!-- card-body -->
 </div>
         
         

      
@endsection