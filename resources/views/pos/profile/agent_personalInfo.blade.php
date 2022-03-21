<div class="form-row">
    <div class="form-group col-md-4">
   
    <div class="p-image">
        <!--dirname(getcwd(),1)-->
        <!--//$_SERVER["DOCUMENT_ROOT"].'/insassets/agents/profile/';-->
      <img class="mb-3  shadow-sm mt-1 customerProfileImage" 
         src="{{asset('assets/agents/profile/'.$agent->profile)}}" 
         alt=""/>
      <br><a class="btn btn-primary" id="upload-profile-button"><i class="fa fa-edit"></i> Change profile </a>
     
      <form action="#" method="post" enctype="multipart/form-data" id="upload-customer-profile">
         <input name="_token" type="hidden" value="{{ csrf_token() }}" />
         <input class="file-upload" name="custimage" id="custimage" type="file" accept="image/jpeg, image/png"/>
      </form> 
       <!--<h4 class="help-block" style="font-size: 16px;color: black;margin-top: 8px; text-decoration: underline;">Upload Passport Size Image</h4>-->
       <span class="ImageError" style="color:red;font-size: 13px;font-weight: 700;"></span>
    </div>
    
    
  </div>
  <style>

  </style>
    <div class="form-group col-md-8">
        <form class="form-group" style="top: 10px;margin: 10px;" enctype="multipart/form-data"  id="personalinfo" method="post">
            <input name="_token" type="hidden" value="{{ csrf_token() }}" />
            
            <div class="form-row">
                <!--has-success -->
                <div class="form-group  col-md-6">
                    <label for="name" class="h4">Full name </label>
                    <input type="text" class="form-control profile-input" data-refClass="personal-section" name="name" id="name" placeholder="Full Name" value="{{$agent->name}}">
                </div>
                  
                <div class="form-group  col-md-6">
                        <label for="email" class="h4">Email</label>
                        <input type="email" class="form-control profile-input" data-refClass="personal-section" id="email" name="email" placeholder="Email" value="{{$agent->email}}" readonly="">
                </div>
              
            </div>
            
            <div class="form-row">
                
               <div class="form-group col-md-6">
                    <label for="inputEmail4" class="h4">Mobile</label>
                    <input type="text" class="form-control number-only" id="mobile" maxlength="10" name="mobile" placeholder="Mobile" value="{{$agent->mobile}}" readonly="">
                </div>
                <div class="form-group has-feedback-- col-md-6">
                    <label for="alternate_mobile" class="h4">Alternate Mobile</label>
                    <input type="text" class="form-control number-only profile-input" data-refClass="personal-section" id="alternate_mobile" name="alternate_mobile" maxlength="10" placeholder="Alternate Mobile" value="{{$agent->alternate_mobile}}" maxlength="10" minlength="10">
                    <!--<span class="fa fa-check form-control-feedback"></span>-->
                </div>
              
            </div>
            
            <div class="form-row">
                <div class="form-group  col-md-6">
                    <label for="address" class="h4">Address</label>
                    <input type="text" class="form-control profile-input" data-refClass="personal-section" id="address" name="address" placeholder="Address" value="{{$agent->address}}">
                </div>
                <div class="form-group  col-md-6">
                    <label for="pincode" class="h4">Pincode</label>
                    <input type="text" class="form-control number-only profile-input" data-refClass="personal-section" maxlength="6" id="pincode" name="pincode" placeholder="Pincode" value="{{$agent->pincode}}">
                 </div>
            </div>
            
            <div class="form-row">
                <div class="form-group  col-md-6">
                  <label for="state" class="h4">State</label>
                  <select type="text" class="form-control profile-input single-select2" id="state" name="state">
                    <option value="">Select State</option>
                    <?php foreach ($states as  $value) {?>
                      <option value="{{$value->id}}" <?php if($value->id==$agent->state){ echo 'selected';}?>>{{$value->name}}</option>
                   <?php } ?>
                  </select>
                  <div id="errors"></div>
                </div>
                
                <div class="form-group col-md-6">
                  <label for="inputAddress" class="h4">City</label>
                  <select type="text" class="form-control profile-input single-select2" id="city" name="city">
                    <option value="">Select City</option>
                    <?php if(isset($cities)){ foreach ($cities as  $value) {?>
                      <option class="form-control" value="{{$value->id}}" <?php if($value->id==$agent->city){ echo 'selected';}?>>{{$value->name}}</option>
                   <?php } } ?>
                  </select>
                  <div id="error"></div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputAddress" class="h4">Gender</label><br>
                  <div>
                  <div class="custom-control custom-radio">
                      <input type="radio" class="custom-control-input profile-input" id="GenderM" name="sex" value="Male" <?php if('Male'==$agent->sex){ echo 'checked';}?> >
                      <label class="custom-control-label h4" for="GenderM">Male</label>
                    </div>

                    <!-- Default checked -->
                    <div class="custom-control custom-radio">
                      <input type="radio" class="custom-control-input profile-input" id="GenderF" name="sex" value="Female" <?php if('Female'==$agent->sex){ echo 'checked';}?> >
                      <label class="custom-control-label h4" for="GenderF">Female</label>
                    </div>
                     <div id="errorsss"></div>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputAddress" class="h4">Marital Status</label><br>
                    <div>
                        <div class="custom-control custom-radio">
                              <input type="radio" class="custom-control-input profile-input" id="Single" name="marital_status" value="Single" <?php if('Single'==$agent->marital_status){ echo 'checked';}?> >
                              <label class="custom-control-label h4" for="Single">Single</label>
                        </div>

                        <!-- Default checked -->
                        <div class="custom-control custom-radio">
                          <input type="radio" class="custom-control-input profile-input" id="Married" name="marital_status" value="Married" <?php if('Married'==$agent->marital_status){ echo 'checked';}?> >
                          <label class="custom-control-label h4" for="Married">Married</label>
                        </div>
                        <div id="errorss"></div>
                   </div>
                </div>
            </div>
            <!--<div class="form-group col-md-12"style=" margin-bottom: 10%; top: 15px; bottom: 19px; ">-->
            <!--     <button id="profile-update-btn" type="submit" class="btn btn-primary loading-indicater-btn">Update</button>-->
            <!-- </div>-->
            
            
        </form>
    </div>
</div>

<!-- This is the modal -->
<div class="modal" tabindex="-1" role="dialog" id="uploadimageModal" style="left:50%;bottom: unset;">
    <div class="modal-dialog" role="document" >
        <div class="modal-content">
            <div class="modal-header" style="background: #C52118;color: #fff;">
                <h5 class="modal-title" style="font-size:20px;">Upload Your Profile Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div id="upload-demo"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary crop_image" style="background:#0E3679;border: 1px solid #C52118;font-size: 14px;border-radius: 0px;">Crop and Save</button>
                <button type="button" class="btn btn-secondary" style="font-size: 14px;border-radius: 0px;" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>