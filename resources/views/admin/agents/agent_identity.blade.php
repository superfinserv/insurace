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
                <div class="agent-identity-notify"></div>
              <form class="form-group" method="post" enctype="multipart/form-data" action="#" id="agentEducationalInfo" >
                <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                <input name="_agent" type="hidden" id="_agent" value="{{$agentData->id}}" />
                
                   <div class="row">
                       <div class="col-lg-12 col-md-12">
                           <?php //print_r($profile['complete']);?>
                            <?php if($profile['complete']==100){ ?>
                            <?php if($agentData->isProceedSign==1 && $agentData->videoFile!=""){?>
                              <div class="card pd-30 shadow-base bd-0 mg-t-20">
                                  <div class="d-lg-flex justify-content-lg-between align-items-lg-center">
                                    <div class="mg-b-20 mg-lg-b-0">
                                      <h4 class="tx-normal tx-roboto tx-inverse mg-b-5">Identity Video is already uploded.</h4>
                                      <p class="tx-13 mg-b-0">click watch now button to view and <a href="#" id="btn-remove-file" class="tx-primary">Click here to remove video.</a></p>
                                    </div>
                                    <a target="_blank" href="{{asset('assets/agents/profile/'.$agentData->videoFile)}}" class="btn btn-info btn-oblong pd-x-25 tx-11 tx-uppercase pd-y-12 tx-mont tx-semibold">Watch Now <i class="fa fa-angle-right mg-l-10"></i></a>
                                  </div><!-- row -->
                              </div>
                              <div class="card pd-30 shadow-base bd-0 mg-t-20 text-center">
                                  <video id="videoplayer1" width="340" height="160" controls>
                                    <source id="video_res_1" src="{{asset('assets/agents/profile/'.$agentData->videoFile)}}" type="video/mp4">
                                 </video>
                            </div>
                            <?php } ?>
                            </br>
                            <div class="card widget-12 shadow-base">
                                <div class="card-header">
                                    <?php if($agentData->isProceedSign==1 && $agentData->videoFile!=""){?>
                                      <div class="card-title tx-danger">While upload new view will remove already uploaded video.</div>
                                  <?php }else{?>
                                    <div class="card-title tx-danger"><?=$agentData->name;?>, did not uploaded video yet!</div>
                                   <?php } ?>
                                </div><!-- card-header -->
                                <div class="card-body">
                                   <div class="row">
                                        <div class="col-lg-4">
                                          <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="newVideo" id="newVideo">
                                            <label class="custom-file-label" for="newVideo">Choose file</label>
                                          </div>
                                        </div><!-- col -->
                                        <div class="col-lg-4 mg-t-40 mg-lg-t-0">
                                           <button class="btn btn-info " id="uplodNewVideo" type="button">upload</button>
                                        </div><!-- col -->
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="progress" id="myprogress-container" style="display:none;margin-top: 15px;">
                                              <div class="progress-bar myprogress"role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                                          </div>
                                        </div>
                                    </div>
                                </div><!-- card-body -->
                            </div>
                            <?php }else{?> 
                              <div class="alert alert-bordered alert-danger" role="alert">
                                <strong class="d-block d-sm-inline-block-force">Sorry!</strong> Please upload all required deatils before upload identity video.
                              </div>
                         <?php } ?>
                        </div>
                    </div>
               
                    
                   
                   
                </form>
     </div><!-- card-body -->
 </div>
         
         

      
@endsection