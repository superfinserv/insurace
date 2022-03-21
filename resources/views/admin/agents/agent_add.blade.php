@extends('admin.layout.app')
@section('content')
 
  <div class="card bd-0 ">
    <!--<div class="card-header tx-medium bd-0 tx-white bg-danger">-->
     
    <!--</div><!-- card-header -->
     <div class="card-header bg-danger d-flex   align-items-center justify-content-between pd-y-5">
          <h6 class="mg-b-0 tx-14 tx-white">Register New POSP</h6>
          <div class="card-option tx-24">
            <a href="{{url('agents')}}" class="btn btn-dark  btn-sm tx-white mg-l-10"><i class="icon ion-arrow-left-a lh-0"></i> Back</a>
           </div><!-- card-option -->
      </div>
    <div class="card-body bd bd-t-0 rounded-bottom">
            <div class="agent-register-notify"></div>
            <form class="form-group" method="post" enctype="multipart/form-data" action="#" id="agentRegisterInfo" >
               <input name="_token" type="hidden" value="{{ csrf_token() }}" />
               <div class="row">
                       <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                              <label class="form-control-label">Agent Name: <span class="tx-danger">*</span></label>
                              <input class="form-control" type="text" id="agent_name" name="agent_name" value="" placeholder="Enter Agent Name">
                            </div>
                       </div>
                       
                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                              <label class="form-control-label">Agent Mobile No: <span class="tx-danger">*</span></label>
                              <input class="form-control" type="text" name="mobile_no" id="mobile_no" value="" placeholder="Enter Agent Mobile">
                            </div>
                       </div>
                       
                       
                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                              <label class="form-control-label">Agent Email address: <span class="tx-danger">*</span></label>
                              <input class="form-control" type="text" id="email" name="email" value="" placeholder="Enter Agent Email">
                            </div>
                       </div>
                       <div class="col-lg-3 col-md-2">
                            <div class="form-group">
                              <label class="form-control-label">Alternate Mobile: <span class="tx-muted">(optional)</span></label>
                              <input class="form-control" type="text" id="alternate_mobile" name="alternate_mobile" value="" placeholder="Enter Alternate Email">
                            </div>
                        </div>
                   </div>
                   
                <div class="row" style="margin-bottom: 1rem;">
                        <div class="col-lg-4 col-md-4">
                            <p style="margin-bottom: 0px;"><strong>Gender:</strong></p>
                               <div class="form-check-inline">
                                    <label class="rdiobox form-check-label">
                                      <input type="radio" class="form-check-input" name="gender" id="genderMale" value="Male" checked><span>Male</span>
                                   </label>
                                </div>
                                <div class="form-check-inline">
                                   <label class="rdiobox form-check-label">
                                     <input type="radio"  class="form-check-input" name="gender"  id="genderFeMale" value="Female" ><span>Female</span>
                                  </label>
                                </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                               <p style="margin-bottom: 0px;"><strong>Merital Status:</strong></p>
                               <div class="form-check-inline">
                                    <label class="rdiobox form-check-label">
                                      <input type="radio" class="form-check-input" name="marital_status" id="marital_statusM" value="Married" checked><span>Married</span>
                                   </label>
                                </div>
                                <div class="form-check-inline">
                                   <label class="rdiobox form-check-label">
                                     <input type="radio"  class="form-check-input" name="marital_status"  id="marital_statusS" value="Single" ><span>Single</span>
                                  </label>
                               </div>
                              
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <p style="margin-bottom: 0px;"><strong>User Type:</strong></p>
                            
                            
                               <div class="form-check-inline">
                                    <label class="rdiobox form-check-label">
                                      <input type="radio" class="form-check-input" name="userType" id="userTypePOSP" value="POSP" checked><span>POSP</span>
                                   </label>
                                </div>
                                <div class="form-check-inline">
                                   <label class="rdiobox form-check-label">
                                     <input type="radio"  class="form-check-input" name="userType"  id="userTypeSP" value="SP" ><span>SP</span>
                                  </label>
                               </div>
                             
                        </div>
                    </div>
                    
                <div class="row mg-t-10">
                       <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                              <label class="form-control-label">Address: <span class="tx-danger">*</span></label>
                              <input class="form-control" type="text" id="address" name="address" value="" placeholder="Enter Your Address">
                            </div>
                       </div>
                      
                    </div>
                    
                <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                              <label class="form-control-label">State: <span class="tx-danger">*</span></label>
                              <select class="form-control select2-show-search" data-placeholder="Choose one" name="state" id="state">
                                 <option value="">Choose state</option>
                                 @foreach ($states as $state)
                                   <option value="{{$state->id}}">{{$state->name}}</option>
                                 @endforeach
                                
                              </select>
                            </div>
                       </div>
                       
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label class="form-control-label">City: <span class="tx-danger">*</span></label>
                                <select class="form-control select2-show-search" data-placeholder="Choose one" id="city" name="city" >
                                 <option value="">Choose city</option>
                              </select>
                            </div>
                       </div>
                       
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                              <label class="form-control-label">Pincode: <span class="tx-danger">*</span></label>
                              <input class="form-control" type="text" name="pincode" id="pincode" value="" placeholder="Enter Pincode">
                            </div>
                        </div>
                </div>
                   
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                              <label class="form-control-label">Password: <span class="tx-danger">*</span></label>
                              <input class="form-control" type="password" id="agent_pass" name="agent_pass" value="" placeholder="Enter Password here" autocomplete="off">
                            </div>
                       </div>
                       
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                              <label class="form-control-label">Confirm Password: <span class="tx-danger">*</span></label>
                              <input class="form-control" type="password" name="agent_cpass" id="agent_cpass" value="" placeholder="Repeat Password" autocomplete="off">
                            </div>
                       </div>
                    <div class="col-lg-3 col-md-3">
                        <button class="btn btn-info agentRegisterInfoBtn" style="margin-top:28px;" type="submit">Register</button>
                    </div>
                </div>
            </form>
         </div>
    </div><!-- card-body -->

@endsection