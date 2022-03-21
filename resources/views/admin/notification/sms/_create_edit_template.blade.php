@extends('admin.layout.app')
@section('content')
 
  <div class="card bd-0 ">
    <!--<div class="card-header tx-medium bd-0 tx-white bg-danger">-->
     
    <!--</div><!-- card-header -->
     <div class="card-header bg-danger d-flex   align-items-center justify-content-between pd-y-5">
          <h6 class="mg-b-0 tx-14 tx-white">@if(!isset($temp)) Add New @else Update @endif  template @if(isset($temp))[ {{$temp->subject}} ] @endif</h6>
          <div class="card-option tx-24">
            <a href="{{url('notification/templates/sms/')}}" class="btn btn-dark  btn-sm tx-white mg-l-10"><i class="icon ion-arrow-left-a lh-0"></i> Back</a>
           </div><!-- card-option -->
      </div>
    <div class="card-body bd bd-t-0 rounded-bottom">
            <div class="sms-template-notify"></div>
            <form class="form-group" method="post" enctype="multipart/form-data" action="#" id="smsTemplateForm" autocomplete="off">
               <input name="_token" type="hidden" value="{{ csrf_token() }}" />
               <div class="row">
                       <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                              <label class="form-control-label">SMS Title: <span class="tx-danger">*</span></label>
                              <input class="form-control" type="text" id="title" name="title" value="{{isset($temp)?$temp->title:''}}" placeholder="Enter Sms title">
                            </div>
                       </div>
                       
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                              <label class="form-control-label">SMS Body: <span class="tx-danger">*</span></label>
                              <textarea class="form-control" name="msg_body" id="msg_body">{{isset($temp)?$temp->body:''}}</textarea>
                            </div>
                       </div>
                       
                       
                        
                   </div>
                   
                   
                   <div class="row">
                      <!--<div class="col-lg-4 col-md-4">-->
                      <!--      <div class="form-group">-->
                      <!--        <label class="form-control-label">State: <span class="tx-danger">*</span></label>-->
                      <!--        <select class="form-control select2-show-search" data-placeholder="Choose one" name="state" id="state">-->
                      <!--           <option value="">Choose Sender Email</option>-->
                      <!--        </select>-->
                      <!--      </div>-->
                      <!-- </div>-->
                    <div class="col-lg-3 col-md-3">
                        @if(isset($temp))
                          <input type="hidden" name="temp_id" id="temp_id" value="{{$temp->id}}" >
                        @endif
                        <button class="btn btn-info smsTemplateSaveBtn" style="margin-top:28px;" type="submit">@if(isset($temp)) Update Template @else Create Template @endif</button>
                    </div>
                </div>
            </form>
         </div>
    </div><!-- card-body -->
 </div>
         
         

      
@endsection