@extends('admin.layout.app')
@section('content')

  <div class="card bd-0 ">
      @include('admin.agents.agents_menu_header')
    <div class="card-body bd bd-t-0 rounded-bottom">
        <div class="row">
            <div class="col-md-3 col-lg-3">
                 @include('admin.agents.agents_menu')
            </div>
             <?php  $assetUrl = "https://supersolutions.in/insurance/agents/";?>
            <div class="col-md-9 col-lg-9 mg-t-20 mg-lg-t-0-force">
                <div class="agent-educational-notify"></div>
              <form class="form-group" method="post" enctype="multipart/form-data" action="#" id="agentEducationalInfo" >
                <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                <input name="_agent" type="hidden" id="_agent" value="{{$agentData->id}}" />
                   <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                              <label class="form-control-label">Educational Qualification: <span class="tx-danger">*</span></label>
                              <select class="form-control select2-show-search"  data-placeholder="Choose one" id="qualification" name="qualification" >
                                  <option value="">Choose Qualification </option>
                                 <option value="10th standard" @if($agentData->educational_qualification=="10th standard") selected @endif>10th standard </option>
                                 <option value="12th standard"  @if($agentData->educational_qualification=="12th standard") selected @endif>12th standard</option>
                                 <option value="Graduation"  @if($agentData->educational_qualification=="Graduation") selected @endif>Graduation</option>
                                 <option value="Post Graduation"  @if($agentData->educational_qualification=="Post Graduation") selected @endif>Post Graduation</option>
                                
                              </select>
                            </div>
                       </div>
                       
                        <div class="col-lg-6 col-md-6">
                           <table class="table table-bordered table-file-has" style="@if($agentData->education_certificate!='') display:block;@else display:none; @endif border: 1px solid #ccc;margin-top: 28px;">
                              <thead style="">
                                  <tr>
                                      <th style="width:70%;"><span id="education_certificate_name"><?=$agentData->education_certificate;?></span></th>
                                      <th style="width:30%;padding: 2px 11px 0px 18px;">
                                          <a class="btn btn-dark btn-icon mg-r-5" download target="_blank" href="<?=$assetUrl.'education_certificate/'.$agentData->education_certificate;?>"><div><i class="fas fa-file-download"></i></div></a>
                                          <a class="btn btn-danger btn-icon btn-remove-file mg-r-5" href="#" ><div><i class="fas fa-trash-alt"></i></div></a>
                                      </th>
                                     
                                  </tr>
                              </thead>
                           </table>
                           
                            <table class="table table-bordered table-file-choose" style="@if($agentData->education_certificate!='') display:none;@else display:block; @endif border: 1px solid #ccc;margin-top: 28px;">
                              <thead class="">
                                  
                                  <tr>
                                      <th style="width:90%;padding: 0px;"><input type="file" class="form-control" name="new_educational_cert" id="new_educational_cert" /></th>
                                      <th style="width:10%;padding: 2px 5px 2px 10px;"><a class="btn btn-success btn-icon mg-r-5"  href="#" id="uploadEduCert" data-type="eduction" ><div><i class="fas fa-check-square"></i></div></a></th>
                                  </tr>
                                  <tr>
                                      <th>
                                          <div class="progress" id="myprogress-container" style="display:none;">
                                              <div class="progress-bar myprogress"role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                                          </div>
                                      </th>
                                  </tr>
                              </thead>
                           </table>
                       </div>
                       
                   </div>
                   
                    <div class="row">
                             <div class="col-lg-3 col-md-3">
                                 <button class="btn btn-info agentEducationalInfoBtn" type="submit">Update Info</button>
                            <div>
                        </div>
                    </div>
         </div>
             </form>
     </div><!-- card-body -->
 </div>
         
         

      
@endsection