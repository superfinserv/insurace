<form class="form-group" style="top: 10px;margin: 10px;" enctype="multipart/form-data"  id="educationinfo" method="post">
    <input name="_token" type="hidden" value="{{ csrf_token() }}" />
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="inputEmail4" class="h4" >Educational Qualification</label>
         </div>
         <div class="form-group col-md-6">
           <select class="form-control profile-input single-select2" id="educational_qualification" name="educational_qualification" >
             <option value="">Select Educational Qualification</option>
              <option value="10th standard" <?php if('10th standard'==$agent->educational_qualification){ echo 'selected';}?>>10th standard</option>
              <option value="12th standard" <?php if('12th standard'==$agent->educational_qualification){ echo 'selected';}?>>12th standard</option>
              <option value="Graduation" <?php if('Graduation'==$agent->educational_qualification){ echo 'selected';}?>>Graduation</option>
              <option value="Post Graduation" <?php if('Post Graduation'==$agent->educational_qualification){ echo 'selected';}?>>Post Graduation</option>
           </select>
           <div id="educational_qualification_error"></div>
          </div>
          <div class="form-group col-md-4">
            <label for="inputPassword4" class="h4">Upload Certificate</label>
         </div>
          <div class="form-group col-md-6">
            
            <!--<div class="form-group" id="not-hasEdu-element" style="display:">-->
            <!--    <input type="file"  class="form-control-file" name="education_certificate" id="education_certificate" accept="application/pdf,image/jpeg, image/png">-->
            <!--</div>-->
            <div class="form-group" id="not-hasEdu-element" style="display:<?=($agent->education_certificate=="")?"block":"none";?>">
                <div class="input-group mb-3">
                  <input type="file" class="form-control "   name="education_certificate" id="education_certificate" accept="application/pdf,image/jpeg, image/png">
                  <div class="input-group-append profile-input-upload" data-name="education_certificate" data-refClass="education-section" data-form="educationinfo" data-elem="hasEdu-element">
                    <span class="input-group-text">
                        <i class="fa fa-check" style="color:#C52118;font-size: 20px;"></i>
                    </span>
                  </div>
                </div>
            </div>
          
            <div class="form-group" id="hasEdu-element" style="display:<?=($agent->education_certificate!="")?"block":"none";?>">
                <input type="text" class="form-control" name="has_edu_certificate" id="has_edu_certificate" readonly="" style=" width: 90%;float: left;" value="{{$agent->education_certificate}}"/>
                      <i class="fa fa-trash remove-certificate" style="cursor: pointer;width: 10%;color: red;font-size: 25px;padding-top:0px;padding-left: 10px;" 
                      data-id="{{$agent->id}}" data-name="{{$agent->education_certificate}}"></i>
            </div>
           
          </div>
        </div>
        
       <!-- <div class="form-group col-md-10"style=" margin-bottom: 10%; top: 15px; bottom: 19px; ">-->
       <!--   <button type="submit" class="btn btn-primary">update</button>-->
       <!--</div>-->
</form>