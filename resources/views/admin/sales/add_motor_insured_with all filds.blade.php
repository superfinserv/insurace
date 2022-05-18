@extends('admin.layout.app')
@section('content')
   <style>
       .table input.form-control{
           border-radius: 0px;
           height: calc(2.6125rem + 8px);
           border: 0;
       }
       .table td{
                color: #574f4f;
                font-size: 12px;
       }
       
       .has-error{
           border: 1px solid #c71a1a !important;
       }
       .has-error input{
           color:#c71a1a;
       }
   </style>
  <div class="card bd-0 ">
    <!--<div class="card-header tx-medium bd-0 tx-white bg-danger">-->
     
    <!--</div><!-- card-header -->
     <div class="card-header bg-danger d-flex   align-items-center justify-content-between pd-y-5">
          <h6 class="mg-b-0 tx-14 tx-white">{{$subtitle}}</h6>
          <div class="card-option tx-24">
            <a href="{{url('/sales/insured')}}" class="btn btn-dark  btn-sm tx-white mg-l-10"><i class="icon ion-arrow-left-a lh-0"></i> Back</a>
           </div><!-- card-option -->
      </div>
    <div class="card-body bd bd-t-0 rounded-bottom">
            <div class="agent-register-notify"></div>
            <form class="form-group" method="post" enctype="multipart/form-data" action="#" id="MotorInsuredForm" >
               <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                           <div class="row">
                                <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                      <label class="form-control-label">Policy No: <span class="tx-danger">*</span></label>
                                      <input class="form-control" type="text" id="policy_no" name="policy_no" value="" placeholder="">
                                    </div>
                               </div>
                                <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                      <label class="form-control-label">Transaction No: <span class="tx-danger">*</span></label>
                                      <input class="form-control" type="text" id="tranaction_no" name="tranaction_no" value="" placeholder="">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                      <label class="form-control-label">Customer Name: <span class="tx-danger">*</span></label>
                                      <input class="form-control" type="text" name="customer_name" id="customer_name" value="" placeholder="">
                                    </div>
                               </div>
                    
                                <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                      <label class="form-control-label">Customer Mobile: <span class="tx-danger">*</span></label>
                                      <input class="form-control" type="text" id="customer_no" name="customer_no" value="" placeholder="">
                                    </div>
                               </div>
                         </div>
                         <div class="row">
                                <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                      <label class="form-control-label">Registration No: <span class="tx-danger">*</span></label>
                                      <input class="form-control" type="text" id="vReg" name="vReg" value="" placeholder="">
                                    </div>
                               </div>
                                <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                      <label class="form-control-label">Engine No: <span class="tx-danger">*</span></label>
                                      <input class="form-control" type="text" id="vEngine" name="vEngine" value="" placeholder="">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                      <label class="form-control-label">Chassis No.: <span class="tx-danger">*</span></label>
                                      <input class="form-control" type="text" name="vChassis" id="vChassis" value="" placeholder="">
                                    </div>
                               </div>
                    
                                <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                      <label class="form-control-label">IDV: <span class="tx-danger">*</span></label>
                                      <input class="form-control" type="text" id="vIdv" name="vIdv" value="" placeholder="">
                                    </div>
                               </div>
                         </div>
                           <div class="row">
                               <div class="col-lg-2 col-md-2">
                                    <div class="form-group">
                                      <label class="form-control-label">Policy For: <span class="tx-danger">*</span></label>
                                         <select class="form-control select2-show-search" data-placeholder="Choose one" name="policyFor" id="policyFor">
                                            <option value="">Choose</option>
                                            <option value="CAR">CAR</option>
                                            <option value="BIKE">2W</option>
                                        </select>
                                    </div>
                               </div>
                               <div class="col-lg-2 col-md-2">
                                    <div class="form-group">
                                      <label class="form-control-label">Policy Type: <span class="tx-danger">*</span></label>
                                       <select class="form-control select2-show-search" data-placeholder="Choose one" name="policyType" id="policyType">
                                            <option value="">Choose</option>
                                            <option value="COM">Comprehensive</option>
                                            <option value="TP">Third Party</option>
                                            <option value="SAOD">Standalone OD</option>
                                        </select>
                                    </div>
                               </div>
                               <div class="col-lg-2 col-md-2">
                                    <div class="form-group">
                                      <label class="form-control-label">Registration Date: <span class="tx-danger">*</span></label>
                                      <input class="form-control" type="text" id="regDate" name="regDate" value="" placeholder="">
                                    </div>
                               </div>
                               <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                      <label class="form-control-label">Make: <span class="tx-danger">*</span></label>
                                      <select class="form-control select2-show-search" data-placeholder="Choose one" name="vMake" id="vMake">
                                         <option value="">Choose Make</option>
                                      </select>
                                    </div>
                               </div>
                               <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                      <label class="form-control-label">Model: <span class="tx-danger">*</span></label>
                                         <select class="form-control select2-show-search" data-placeholder="Choose one" name="vModel" id="vModel">
                                            <option value="">Choose Model</option>
                                        </select>
                                    </div>
                               </div>
                               
                         </div>
                           <div class="row">
                                 <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                      <label class="form-control-label">Insurer: <span class="tx-danger">*</span></label>
                                      <select class="form-control select2-show-search" data-placeholder="Choose one" name="insPartner" id="insPartner">
                                         <option value="">Choose Insurer</option>
                                         @foreach ($insurer as $r)
                                           <option value="{{$r->shortName}}">{{$r->name}}</option>
                                         @endforeach
                                      </select>
                                    </div>
                               </div>
                              <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                      <label class="form-control-label">Policy Start Date: <span class="tx-danger">*</span></label>
                                      <input class="form-control" type="text" id="startDate" name="startDate" value="" placeholder="">
                                    </div>
                               </div>
                               <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                      <label class="form-control-label">Policy End Date: <span class="tx-danger">*</span></label>
                                      <input class="form-control" type="text" id="endDate" name="endDate" value="" placeholder="">
                                    </div>
                               </div>
                               <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                      <label class="form-control-label">POSP: <span class="tx-danger">*</span></label>
                                       <select class="form-control select2-show-search" data-placeholder="Choose one" name="pospId" id="pospId">
                                         <option value="">Choose</option>
                                         @foreach ($posps as $posp)
                                           <option value="{{$posp->id}}">{{$posp->name}} ({{$posp->posp_ID}})</option>
                                         @endforeach
                                      </select>
                                    </div>
                               </div>
                        </div>
                    
                           <div class="row">
                                <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                      <label class="form-control-label">Address Line One: <span class="tx-danger">*</span></label>
                                      <input class="form-control" type="text" id="addressLineOne" name="addressLineOne" value="" placeholder="House No/Name">
                                    </div>
                               </div>
                               <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                      <label class="form-control-label">Address Line Two: <span class="tx-danger">*</span></label>
                                      <input class="form-control" type="text" id="addressLineTwo" name="addressLineTwo" value="" placeholder="Street Name,Road Name">
                                    </div>
                               </div>
                               
                               
                                <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                      <label class="form-control-label">State: <span class="tx-danger">*</span></label>
                                      <select class="form-control select2-show-search" data-placeholder="Choose one" name="state" id="state">
                                         <option value="">Choose State</option>
                                         @foreach ($states as $state)
                                           <option value="{{$state->id}}-{{$state->name}}">{{$state->name}}</option>
                                         @endforeach
                                      </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                      <label class="form-control-label">City: <span class="tx-danger">*</span></label>
                                      <select class="form-control select2-show-search" data-placeholder="Choose one" name="city" id="city">
                                         <option value="">Choose City</option>

                                      </select>
                                    </div>
                               </div>
                    
                                
                         </div>
                         
                            <div class="row">
                               <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                      <label class="form-control-label">Pincode: <span class="tx-danger">*</span></label>
                                      <input class="form-control" type="text" id="pincode" name="pincode" value="" placeholder="">
                                    </div>
                               </div>
                                <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                      <label class="form-control-label">Nominee Name: <span class="tx-danger">*</span></label>
                                      <input class="form-control" type="text" id="nomName" name="nomName" value="" placeholder="">
                                    </div>
                               </div>
                                <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                      <label class="form-control-label">Nominee DOB: <span class="tx-danger">*</span></label>
                                      <input class="form-control" type="text" id="nomDate" name="nomDate" value="" placeholder="">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                      <label class="form-control-label">Nominee Relation: <span class="tx-danger">*</span></label>
                                      <select class="form-control select2-show-search" data-placeholder="Choose one" name="nomRelation" id="nomRelation">
                                         <option value="">Choose Relation</option>
                                         @foreach ($relations as $rel)
                                           <option value="{{$rel->value}}">{{$rel->label}}</option>
                                         @endforeach
                                      </select>
                                    </div>
                               </div>
                    
                               
                         </div>
                         
                           <div class="row">
                            <div class="bd rounded table-responsive">
                                 <table class="table table-bordered">
                                    <thead class="thead-colored thead-light">
                                       <tr><th colspan="8" class="text-center ">Selected addons</th></tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                              <table class="">
                                                  
                                                  <tbody>
                                                       <tr>
                                                           <th style="width:3%" class="text-center">#</th>
                                                           <th style="width:45%" class="text-center">Addons</th>
                                                           <th style="width:20%" class="text-center">SI</th>
                                                           <th style="width:32%" class="text-center">Amount</th>
                                                        </tr>
                                                        <tr><th class="text-center" colspan="4">PA Cover</th></tr>
                                                         <tr>
                                                            <td class="text-center">
                                                                <label class="ckbox">
                                                                  <input type="checkbox" class="addon-check" value="1" name="PA_OwnerDriverCover" id="PA_OwnerDriverCover" >
                                                                  <span></span>
                                                                </label>
                                                            </td>
                                                            <td class="text-center">PA Owner Driver Cover</td>
                                                            <td class="text-center"></td>
                                                            <td class="text-center" style="padding: 0px;vertical-align: middle;">
                                                                <input class="form-control addonAmt" name="PA_OwnerDriverCoverAmt" id="PA_OwnerDriverCoverAmt" readonly  type="text" value="0.00"  placeholder="">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center">
                                                                <label class="ckbox">
                                                                  <input type="checkbox" class="addon-check" value="1" id="isPA_UNPassCover" name="isPA_UNPassCover">
                                                                  <span></span>
                                                                </label>
                                                            </td>
                                                            <td class="text-center">Unnammed PA Cover</td>
                                                            <td class="text-center"></td>
                                                            <td class="text-center" style="padding: 0px;vertical-align: middle;">
                                                                <input class="form-control addonAmt" id="isPA_UNPassCoverAmt" name="isPA_UNPassCoverAmt" readonly  type="text" value="0.00"   placeholder="">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center">
                                                                <label class="ckbox">
                                                                  <input type="checkbox" class="addon-check" value="1" name="isPA_UNDriverCover" id="isPA_UNDriverCover" >
                                                                  <span></span>
                                                                </label>
                                                            </td>
                                                            <td class="text-center">PA Cover for Paid Driver</td>
                                                            <td class="text-center"></td>
                                                            <td class="text-center" style="padding: 0px;vertical-align: middle;">
                                                                <input class="form-control addonAmt" name="isPA_UNDriverCoverAmt" id="isPA_UNDriverCoverAmt" readonly  type="text" value="0.00" placeholder="">
                                                            </td>
                                                        </tr>
                                                        <tr><th class="text-center" colspan="4">Legal Liability Cover</th></tr>
                                                        <tr>
                                                            <td class="text-center">
                                                                <label class="ckbox">
                                                                  <input type="checkbox" class="addon-check" value="1" name="isLL_PaidDriverCover" id="isLL_PaidDriverCover">
                                                                  <span></span>
                                                                </label>
                                                            </td>
                                                            <td class="text-center">Legal Liability to Paid Driver</td>
                                                            <td class="text-center"></td>
                                                           <td class="text-center" style="padding: 0px;vertical-align: middle;">
                                                                <input class="form-control addonAmt" name="isLL_PaidDriverCoverAmt" id="isLL_PaidDriverCoverAmt" readonly  type="text" value="0.00" placeholder="">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                           <td class="text-center">
                                                                <label class="ckbox">
                                                                  <input type="checkbox" class="addon-check" value="1" name="isLL_UNPassCover" id="isLL_UNPassCover">
                                                                  <span></span>
                                                                </label>
                                                            </td>
                                                            <td class="text-center">Legal Liability to Unnamed Passanger</td>
                                                            <td class="text-center"></td>
                                                            <td class="text-center" style="padding: 0px;vertical-align: middle;">
                                                                <input class="form-control addonAmt" name="isLL_UNPassCoverAmt" id="isLL_UNPassCoverAmt" readonly  type="text" value="0.00" placeholder="">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                           <td class="text-center">
                                                                <label class="ckbox">
                                                                  <input type="checkbox" class="addon-check" value="1" name="isLL_EmpCover" id="isLL_EmpCover">
                                                                  <span></span>
                                                                </label>
                                                            </td>
                                                            <td class="text-center">Legal Liability to Employees</td>
                                                            <td class="text-center"></td>
                                                           <td class="text-center" style="padding: 0px;vertical-align: middle;">
                                                                <input class="form-control addonAmt" name="isLL_EmpCoverAmt" id="isLL_EmpCoverAmt" readonly  type="text" value="0.00" placeholder="">
                                                            </td>
                                                        </tr>
                                                        
                                                        <tr><th class="text-center" colspan="4">Accessories covers</th></tr>
                                                        <tr>
                                                           <td class="text-center">
                                                                <label class="ckbox">
                                                                  <input type="checkbox" class="addon-check" value="1" name="isCngKitCover" id="isCngKitCover">
                                                                  <span></span>
                                                                </label>
                                                            </td>
                                                            <td class="text-center">CNG Kit Cover </td>
                                                            <td class="text-center"></td>
                                                            <td class="text-center" style="padding: 0px;vertical-align: middle;">
                                                                <input class="form-control addonAmt" name="isCngKitCoverAmt" id="isCngKitCoverAmt" readonly  type="text" value="0.00" placeholder="">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                           <td class="text-center">
                                                                <label class="ckbox">
                                                                  <input type="checkbox" class="addon-check" value="1" name="isElecAccCover" id="isElecAccCover">
                                                                  <span></span>
                                                                </label>
                                                            </td>
                                                            <td class="text-center">Electrical Accessories</td>
                                                            <td class="text-center"></td>
                                                            <td class="text-center" style="padding: 0px;vertical-align: middle;">
                                                                <input class="form-control addonAmt" name="isElecAccCoverAmt" id="isElecAccCoverAmt" readonly  type="text" value="0.00" placeholder="">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center">
                                                                <label class="ckbox">
                                                                  <input type="checkbox" class="addon-check" value="1" name="isNonElecAccCover" id="isNonElecAccCover">
                                                                  <span></span>
                                                                </label>
                                                            </td>
                                                            <td class="text-center">Non Electrical Accessories</td>
                                                            <td class="text-center"></td>
                                                            <td class="text-center" style="padding: 0px;vertical-align: middle;">
                                                                <input class="form-control addonAmt" name="isNonElecAccCoverAmt" id="isNonElecAccCoverAmt" readonly  type="text" value="0.00" placeholder="">
                                                            </td>
                                                        </tr>
                                                  </tbody>
                                              </table>
                                              
                                            </td>
                                            <td>
                                               <table class="">
                                                  <tbody>
                                                     <tr>
                                                            <th style="width:3%" class="text-center">#</th>
                                                           <th style="width:45%" class="text-center">Addons</th>
                                                           <th style="width:20%" class="text-center">SI</th>
                                                           <th style="width:32%" class="text-center">Amount</th>
                                                        </tr> 
                                                            <tr><th class="text-center" colspan="4">Motor Own Damage -  Add Ons</th> </tr>
                                                             <tr>
                                                             <td class="text-center">
                                                                <label class="ckbox">
                                                                  <input type="checkbox" class="addon-check" value="1" name="isBreakDownAsCover" id="isBreakDownAsCover">
                                                                  <span></span>
                                                                </label>
                                                            </td>
                                                                <td class="text-center">Road Side Assistance</td>
                                                                <td class="text-center"></td>
                                                                <td class="text-center" style="padding: 0px;vertical-align: middle;">
                                                                <input class="form-control addonAmt" name="isBreakDownAsCoverAmt" id="isBreakDownAsCoverAmt" readonly  type="text" value="0.00" placeholder="">
                                                            </td>
                                                            </tr>
                                                             <tr>
                                                                <td class="text-center">
                                                                <label class="ckbox">
                                                                  <input type="checkbox" class="addon-check" value="1" name="isPersonalBelongCover" id="isPersonalBelongCover">
                                                                  <span></span>
                                                                </label>
                                                            </td>
                                                                <td class="text-center">Personal Belongings</td>
                                                                <td class="text-center"></td>
                                                                <td class="text-center" style="padding: 0px;vertical-align: middle;">
                                                                <input class="form-control addonAmt"  name="isPersonalBelongCoverAmt" id="isPersonalBelongCoverAmt" readonly  type="text" value="0.00" placeholder="">
                                                            </td>
                                                            </tr>
                                                             <tr>
                                                                   <td class="text-center">
                                                                        <label class="ckbox">
                                                                          <input type="checkbox" class="addon-check" value="1" name="isKeyLockProCover" id="isKeyLockProCover">
                                                                          <span></span>
                                                                        </label>
                                                                    </td>
                                                                <td class="text-center">Key and Lock Protect</td>
                                                                <td class="text-center"></td>
                                                               <td class="text-center" style="padding: 0px;vertical-align: middle;">
                                                                <input class="form-control addonAmt" name="isKeyLockProCoverAmt" id="isKeyLockProCoverAmt" readonly  type="text" value="0.00"  placeholder="">
                                                            </td>
                                                            </tr>
                                                             <tr>
                                                               <td class="text-center">
                                                                <label class="ckbox">
                                                                  <input type="checkbox" class="addon-check" value="1" name="isPartDepProCover" id="isPartDepProCover">
                                                                  <span></span>
                                                                </label>
                                                            </td>
                                                                <td class="text-center">Zero Dep</td>
                                                                <td class="text-center"></td>
                                                                <td class="text-center" style="padding: 0px;vertical-align: middle;">
                                                                <input class="form-control addonAmt" name="isPartDepProCoverAmt" id="isPartDepProCoverAmt" readonly type="text" value="0.00"  placeholder="">
                                                            </td>
                                                            </tr>
                                                             <tr>
                                                               <td class="text-center">
                                                                <label class="ckbox">
                                                                  <input type="checkbox" class="addon-check"  value="1" name="isConsumableCover" id="isConsumableCover">
                                                                  <span></span>
                                                                </label>
                                                            </td>
                                                                <td class="text-center">Consumable cover</td>
                                                                <td class="text-center"></td>
                                                                <td class="text-center" style="padding: 0px;vertical-align: middle;">
                                                                  <input class="form-control addonAmt" name="isConsumableCoverAmt" id="isConsumableCoverAmt" readonly  type="text" value="0.00" placeholder="">
                                                                </td>
                                                            </tr>
                                                             <tr>
                                                                 <td class="text-center">
                                                                <label class="ckbox">
                                                                  <input type="checkbox" class="addon-check" value="1" name="isEng_GearBoxProCover" id="isEng_GearBoxProCover">
                                                                  <span></span>
                                                                </label>
                                                            </td>
                                                                <td class="text-center">Engine and Gear Box Protect</td>
                                                                <td class="text-center"></td>
                                                                 <td class="text-center" style="padding: 0px;vertical-align: middle;">
                                                                  <input class="form-control addonAmt" name="isEng_GearBoxProCoverAmt" id="isEng_GearBoxProCoverAmt" readonly  type="text" value="0.00"  value="0.00"  placeholder="">
                                                                </td>
                                                            </tr>
                                                             <tr>
                                                                <td class="text-center">
                                                                <label class="ckbox">
                                                                  <input type="checkbox" class="addon-check" value="1" name="isCashAllowCover" id="isCashAllowCover">
                                                                  <span></span>
                                                                </label>
                                                            </td>
                                                                <td class="text-center">Cash Allowance Cover</td>
                                                                <td class="text-center"></td>
                                                                 <td class="text-center" style="padding: 0px;vertical-align: middle;">
                                                                  <input class="form-control addonAmt" name="isCashAllowCoverAmt" id="isCashAllowCoverAmt" readonly  type="text" value="0.00" placeholder="">
                                                                </td>
                                                             <tr>
                                                                <td class="text-center">
                                                                <label class="ckbox">
                                                                  <input type="checkbox" class="addon-check" value="1" name="isTyreProCover" id="isTyreProCover">
                                                                  <span></span>
                                                                </label>
                                                            </td>
                                                                <td class="text-center">Tyre Protect</td>
                                                                <td class="text-center"></td>
                                                                 <td class="text-center" style="padding: 0px;vertical-align: middle;">
                                                                  <input class="form-control addonAmt"  name="isTyreProCoverAmt" id="isTyreProCoverAmt" readonly  type="text" value="0.00"  placeholder="">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-center">
                                                                <label class="ckbox">
                                                                  <input type="checkbox" class="addon-check" value="1" name="isRetInvCover" id="isRetInvCover">
                                                                  <span></span>
                                                                </label>
                                                            </td>
                                                                <td class="text-center">Return to Invoice</td>
                                                                <td class="text-center"></td>
                                                                 <td class="text-center" style="padding: 0px;vertical-align: middle;">
                                                                  <input class="form-control addonAmt" name="isRetInvCoverAmt" id="isRetInvCoverAmt" readonly  type="text" value="0.00" placeholder="">
                                                                </td>
                                                            </tr>
                                                  </tbody> 
                                                </table>
                                            </td>
                                        </tr>
                                       
                                        
                                    </tbody>
                                               </table>
                                             </td>
                                         </tr>
                                    </tbody>
                                 </table>
                               </div>
                          </div>
                          
                          
                           <div class="row">
                            <div class="bd rounded table-responsive">
                                 <table class="table table-bordered">
                                    <thead class="thead-colored thead-light">
                                       <tr><th colspan="8" class="text-center ">Discounts</th></tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                              <table class="">
                                                  <tbody>
                                                         <tr>
                                                            <td class="text-center">
                                                                <label class="ckbox">
                                                                  <input type="checkbox" class="addon-check" value="1" name="ncbDiscount" id="ncbDiscount" >
                                                                  <span></span>
                                                                </label>
                                                            </td>
                                                            <td class="text-center">NCB Discount</td>
                                                            <td class="text-center"></td>
                                                            <td class="text-center" style="padding: 0px;vertical-align: middle;">
                                                                <input class="form-control" name="ncbDiscountAmt" id="ncbDiscountAmt" readonly  type="text" value="0.00" placeholder="">
                                                            </td>
                                                        </tr>
                                                  </tbody>
                                              </table>
                                              
                                            </td>
                                            <td>
                                               <table class="">
                                                  <tbody>
                                                     
                                                            <tr>
                                                             <td class="text-center">
                                                                <label class="ckbox">
                                                                  <input type="checkbox" class="addon-check" value="1" name="otherDiscount" id="otherDiscount">
                                                                  <span></span>
                                                                </label>
                                                            </td>
                                                                <td class="text-center">Other Discount</td>
                                                                <td class="text-center"></td>
                                                                <td class="text-center" style="padding: 0px;vertical-align: middle;">
                                                                <input class="form-control" name="otherDiscountAmt" id="otherDiscountAmt" readonly  type="text" value="0.00" placeholder="">
                                                            </td>
                                                            </tr>
                                                  </tbody> 
                                                </table>
                                            </td>
                                        </tr>
                                       
                                        
                                    </tbody>
                                               </table>
                                             </td>
                                         </tr>
                                    </tbody>
                                 </table>
                               </div>
                          </div>
                      
                      <div class="row row mg-t-20">
                            <div class="col-lg-2 col-md-2">
                                    <div class="form-group">
                                      <label class="form-control-label">Net OD<span class="tx-danger">*</span></label>
                                      <input class="form-control" type="text" id="netOD" name="netOD" value="" placeholder="">
                                    </div>
                           </div>
                           <div class="col-lg-2 col-md-2">
                                <div class="form-group">
                                  <label class="form-control-label">Net TP<span class="tx-danger">*</span></label>
                                  <input class="form-control" type="text" id="netTP" name="netTP" value="0.00"  placeholder="">
                                </div>
                           </div>  
                               <div class="col-lg-2 col-md-2">
                                    <div class="form-group">
                                      <label class="form-control-label">Total Net<span class="tx-danger">*</span></label>
                                      <input class="form-control" type="text" id="total_net" name="total_net" value=""  placeholder="">
                                    </div>
                               </div>
                               <div class="col-lg-2 col-md-2">
                                    <div class="form-group">
                                      <label class="form-control-label">Total Tax<span class="tx-danger">*</span></label>
                                      <input class="form-control" type="text" id="total_tax" name="total_tax" value=""  placeholder="">
                                    </div>
                               </div>
                               <div class="col-lg-2 col-md-2">
                                    <div class="form-group">
                                      <label class="form-control-label">Total Gross<span class="tx-danger">*</span></label>
                                      <input class="form-control" type="text" id="total_gross" name="total_gross" value=""  placeholder="">
                                    </div>
                               </div>
                                
                           </div>
                           
                           <div class="row row mg-t-20">
                                <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                      <label class="form-control-label">Policy Copy<span class="tx-danger">*</span></label>
                                      <input class="form-control" type="file" id="policyFile" name="policyFile" value="" placeholder="">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3">
                                   <button class="btn btn-primary savepolicyInfoBtn" style="margin-top:28px;" type="submit">Save</button>
                                </div>
                            </div>
                    
                
            </form>
         </div>
    </div><!-- card-body -->

@endsection