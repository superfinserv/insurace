@extends('admin.layout.app')
@section('content')

  <div class="card bd-0 ">
     @include('admin.agents.agents_menu_header')
    <div class="card-body bd bd-t-0 rounded-bottom">
        <div class="row">
            <div class="col-md-3 col-lg-3">
                 @include('admin.agents.agents_menu')
            </div>
            
            <div class="col-md-9 col-lg-9 mg-t-20 mg-lg-t-0-force">
            <div class="agent-personal-notify"></div>
              <form class="form-group" method="post" enctype="multipart/form-data" action="{{url('agent/personal/infoupdate')}}" id="agentPersonalInfo" >
                <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                <input name="_agent" id="_agent" type="hidden" value="{{$agentData->id}}" />
                    <div class="row">
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                      <label class="form-control-label">Agent Name: <span class="tx-danger">*</span></label>
                                      <input class="form-control" type="text" id="agent_name" name="agent_name" value="{{$agentData->name}}" placeholder="Enter Agent Name">
                                    </div>
                               </div>
                               
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                      <label class="form-control-label">Agent Email address: <span class="tx-danger">*</span></label>
                                      <input class="form-control" type="text" id="email" name="email" value="{{$agentData->email}}" placeholder="Enter Agent Email">
                                    </div>
                               </div> 
                            </div> 
                            <div class="row">
                               <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                      <label class="form-control-label">Agent Mobile No: <span class="tx-danger">*</span></label>
                                      <input class="form-control" type="text" name="mobile_no" id="mobile_no" value="{{$agentData->mobile}}" placeholder="Enter Agent Mobile">
                                    </div>
                               </div>
                               <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                      <label class="form-control-label">Alternate Mobile: <span class="tx-muted">(optional)</span></label>
                                      <input class="form-control" type="text" id="alternate_mobile" name="alternate_mobile" value="{{$agentData->alternate_mobile}}" placeholder="Enter Alternate Email">
                                    </div>
                                   
                                 </div>
                            </div>
                                
                           
                            <div class="row">
                                 <div class="col-lg-6 col-md-6">
                                    <p><strong>Gender:</strong></p>
                                     <label class="rdiobox">
                                        <input type="radio" name="gender" id="genderMale" value="Male" @if("Male"==$agentData->sex) checked="" @endif><span>Male</span>
                                      </label>
                        
                                      <label class="rdiobox mg-t-15">
                                        <input type="radio" name="gender"  id="genderFeMale" value="Female" @if("Female"==$agentData->sex) checked="" @endif><span>Female</span>
                                      </label>
                                     
                                </div>
                                 <div class="col-lg-6 col-md-6">
                                      <p><strong>Merital Status:</strong></p>
                                      <label class="rdiobox">
                                        <input type="radio" id="marital_statusM" name="marital_status"  value="Married" @if("Married"==$agentData->marital_status) checked="" @endif><span>Married</span>
                                      </label>
                        
                                      <label class="rdiobox mg-t-15">
                                        <input type="radio" id="marital_statusS" name="marital_status"  value="Single" @if("Single"==$agentData->marital_status) checked="" @endif><span>Single</span>
                                      </label>
                                </div>
                                 
                            </div>
                        </div>
                        
                        <div class="col-md-3" style="text-align: center;">
                            <figure class="overlay0">
                              <img id="agentImagesrc" style="width:200px;height:200px;"
                                   data-src="<?=($agentData->profile!="")?asset("public/assets/agents/profile/".$agentData->profile):asset('public/assets/agents/profile/avatar.png');?>"
                                   src="<?=($agentData->profile!="")?asset("public/assets/agents/profile/".$agentData->profile):asset('public/assets/agents/profile/avatar.png');?>"
                                   class="img-fluid" alt="">
                                  
                            </figure>
                           <div class=" d-flex align-items-center justify-content-center">
                            <input type="file" name="agentImage" id="agentImage" class="inputfile" data-multiple-caption="{count} files selected" >
                            <label for="agentImage" class="tx-white bg-info">
                              <i class="icon ion-ios-upload-outline tx-24"></i>
                              <span>Choose a file...</span>
                            </label>
                          </div>
                          <br/>
                          <div class="progress mg-b-10 ht-10" id="myprogress-container" style="display:none;">
                            <div class="progress-bar myprogress" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                    </div>
                   
                   
                   
                    
                    <div class="row">
                       <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                              <label class="form-control-label">Address: <span class="tx-danger">*</span></label>
                              <input class="form-control" type="text" id="address" name="address" value="{{$agentData->address}}" placeholder="Enter Your Address">
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
                                   <option value="{{$state->id}}" @if($state->id==$agentData->state) selected @endif>{{$state->name}}</option>
                                 @endforeach
                                
                              </select>
                            </div>
                       </div>
                       <?php if($agentData->state!="" && $agentData->state>0){
                            $cities = DB::table('cities')->select('*')->where('state_id',$agentData->state)->get(); 
                       }?>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label class="form-control-label">City: <span class="tx-danger">*</span></label>
                                <select class="form-control select2-show-search" data-placeholder="Choose one" id="city" name="city" >
                                 <option value="">Choose city</option>
                                 @isset($cities)
                                   @foreach ($cities as $city)
                                     <option value="{{$city->id}}" @if($city->id==$agentData->city) selected @endif>{{$city->name}}</option>
                                   @endforeach
                                 @endisset
                              </select>
                            </div>
                       </div>
                       
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                              <label class="form-control-label">Pincode: <span class="tx-danger">*</span></label>
                              <input class="form-control" type="text" name="pincode" id="pincode" value="{{$agentData->pincode}}" placeholder="Enter Pincode">
                            </div>
                        </div>
                   </div>
                   
                    <div class="row">
                             <div class="col-lg-3 col-md-3">
                                 <button class="btn btn-info agentPersonalInfoBtn" type="submit">Update Info</button>
                            <div>
                        </div>
                    </div>
         </div>
                </form>
     </div><!-- card-body -->
 </div>
         
         

      
@endsection