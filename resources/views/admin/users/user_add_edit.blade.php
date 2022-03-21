@extends('admin.layout.app')
@section('content')
 
  <div class="card bd-0 ">
    <!--<div class="card-header tx-medium bd-0 tx-white bg-danger">-->
     
    <!--</div><!-- card-header -->
     <div class="card-header bg-danger d-flex   align-items-center justify-content-between pd-y-5">
          <h6 class="mg-b-0 tx-14 tx-white">@if(!isset($user)) Register New @else Update @endif  user @if(isset($user))[ {{$user->name}} ] @endif</h6>
          <div class="card-option tx-24">
            <a href="{{url('users')}}" class="btn btn-dark  btn-sm tx-white mg-l-10"><i class="icon ion-arrow-left-a lh-0"></i> Back</a>
           </div><!-- card-option -->
      </div>
    <div class="card-body bd bd-t-0 rounded-bottom">
            <div class="user-register-notify"></div>
            <form class="form-group" method="post" enctype="multipart/form-data" action="#" id="userRegisterInfo" autocomplete="off">
               <input name="_token" type="hidden" value="{{ csrf_token() }}" />
               <div class="row">
                       <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                              <label class="form-control-label">User Full Name: <span class="tx-danger">*</span></label>
                              <input class="form-control" type="text" id="user_name" name="user_name" value="{{isset($user)?$user->name:''}}" placeholder="Enter User Name">
                            </div>
                       </div>
                       
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                              <label class="form-control-label">Mobile No: <span class="tx-danger">*</span></label>
                              <input class="form-control number-only" type="text" name="mobile_no" id="mobile_no" value="{{isset($user)?$user->mobile:''}}" placeholder="Enter Mobile Number">
                            </div>
                       </div>
                       
                       
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                              <label class="form-control-label">Email address: <span class="tx-danger">*</span></label>
                              <input class="form-control" type="text" id="user_email" name="user_email" value="{{isset($user)?$user->email:''}}" placeholder="Enter Email">
                            </div>
                       </div>
                   </div>
                   
                <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <p><strong>Gender:</strong></p>
                             <label class="rdiobox">
                                <input type="radio" name="gender" id="genderMale" value="Male" {{(isset($user) && $user->gender=='Male')?'checked':''}}><span>Male</span>
                              </label>
                
                              <label class="rdiobox mg-t-15">
                                <input type="radio" name="gender"  id="genderFeMale" value="Female" {{(isset($user) && $user->gender=='Female')?'checked':''}}><span>Female</span>
                              </label>
                             
                        </div>
                        <div class="col-lg-4 col-md-4">
                              <p><strong>Merital Status:</strong></p>
                              <label class="rdiobox">
                                <input type="radio" id="marital_statusM" name="marital_status"  value="Married" {{(isset($user) && $user->marital_status=='Married')?'checked':''}}><span>Married</span>
                              </label>
                
                              <label class="rdiobox mg-t-15">
                                <input type="radio" id="marital_statusS" name="marital_status"  value="Single" {{(isset($user) && $user->marital_status=='Single')?'checked':''}}><span>Single</span>
                              </label>
                        </div>
                         <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                              <label class="form-control-label">Alternate Mobile: <span class="tx-muted">(optional)</span></label>
                              <input class="form-control number-only" type="text" id="alternate_mobile" name="alternate_mobile" value="{{isset($user)?$user->alternate_mobile:''}}"  placeholder="Enter Alternate Mobile">
                            </div>
                           
                         </div>
                    </div>
                    
                    <div class="row" style="margin-top:10px;">
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                              <label class="form-control-label">Region: <span class="tx-danger">*</span></label>
                              <select class="form-control select2-show-search" data-placeholder="Choose one" name="region" id="region">
                                 <option value="">Choose Region</option>
                                 @foreach($regions as $rg)
                                <option value="{{$rg->id}}" {{(isset($user) && $branch->region_id==$rg->id)?'selected':''}}>{{$rg->name}}</option>
                                @endforeach
                                
                              </select>
                            </div>
                       </div>
                       
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label class="form-control-label">Branch: <span class="tx-danger">*</span></label>
                                <select class="form-control select2-show-search" data-placeholder="Choose one" id="branch" name="branch" >
                                 <option value="">Choose Branch</option>
                                 @if(isset($user) && isset($branches))
                                   @foreach($branches as $brnch)
                                    <option value="{{$brnch->id}}" {{(isset($user) && $user->branch_id==$brnch->id)?'selected':''}}>{{$brnch->name}}</option>
                                   @endforeach
                                 @endif
                              </select>
                            </div>
                       </div>
                       
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                              <label class="form-control-label">Role: <span class="tx-danger">*</span></label>
                             <select class="form-control select2-show-search" data-placeholder="Choose one" id="role" name="role" >
                                 <option value="">Choose Role</option>
                                  @foreach($roles as $role)
                                   <option value="{{$role->id}}"  {{(isset($user) && $user->role==$role->id)?'selected':''}}>{{$role->role}}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>
                </div>
                    
                   <div class="row">
                       <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                              <label class="form-control-label">Address: <span class="tx-danger">*</span></label>
                              <input class="form-control" type="text" id="address" name="address" value="{{isset($user)?$user->address:''}}" placeholder="Enter user Address">
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
                                   <option value="{{$state->id}}" {{(isset($user) && $user->state==$state->id)?'selected':''}}>{{$state->name}}</option>
                                 @endforeach
                                
                              </select>
                            </div>
                       </div>
                       
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label class="form-control-label">City: <span class="tx-danger">*</span></label>
                                <select class="form-control select2-show-search" data-placeholder="Choose one" id="city" name="city" >
                                 <option value="">Choose city</option>
                                 @if(isset($user) && isset($cities))
                                   @foreach($cities as $ct)
                                    <option value="{{$ct->id}}-{{$ct->name}}" {{(isset($user) && $user->city==$ct->id)?'selected':''}}>{{$ct->name}}</option>
                                   @endforeach
                                 @endif
                              </select>
                            </div>
                       </div>
                       
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                              <label class="form-control-label">Pincode: <span class="tx-danger">*</span></label>
                              <input class="form-control number-only"  type="text" name="pincode" id="pincode" value="{{isset($user)?$user->pincode:''}}" placeholder="Enter Pincode">
                            </div>
                        </div>
                </div>
                   
                <div class="row">
                      @if(!isset($user))
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                              <label class="form-control-label">Password: <span class="tx-danger">*</span></label>
                              <input class="form-control" type="password" id="user_pass" name="user_pass" value="" placeholder="Enter Password here" autocomplete="off">
                            </div>
                       </div>
                       
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                              <label class="form-control-label">Confirm Password: <span class="tx-danger">*</span></label>
                              <input class="form-control" type="password" name="user_cpass" id="user_cpass" value="" placeholder="Repeat Password" autocomplete="off">
                            </div>
                       </div>
                       @else
                       <input type="hidden" name="user_id" id="user_id" value="{{$user->id}}" >
                       @endif
                    <div class="col-lg-3 col-md-3">
                        <button class="btn btn-info userRegisterInfoBtn" style="margin-top:28px;" type="submit">Register</button>
                    </div>
                </div>
            </form>
         </div>
    </div><!-- card-body -->
 </div>
         
         

      
@endsection