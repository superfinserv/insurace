@extends('admin.layout.app')
@section('content')
  <style>
      .table-bordered tbody tr th {
            border: 1px solid #dee2e6;
            padding: 5px 5px;
            text-align: center;
            vertical-align: middle;
            background: #1d2939;
            color: #fff;
        }
    .table-bordered thead tr th {
            text-align: center;
            background: #ccc;
            vertical-align: middle;

        }
  </style> 
   <div class="notify-template-notify"></div>
  <div class="card bd-0 ">
    <!--<div class="card-header tx-medium bd-0 tx-white bg-danger">-->
     
    <!--</div><!-- card-header -->
     <div class="card-header bg-danger d-flex  align-items-center justify-content-between pd-y-5">
          <h6 class="mg-b-0 tx-14 tx-white">  Notification Templates Settings</h6>
          <div class="card-option tx-24">
            <a href="{{url('/notification/templates/email/create')}}" class="btn btn-dark  btn-sm tx-white mg-l-10"><i class="icon ion-plus-circled lh-0"></i> ADD Email Templates</a>
            <a href="{{url('/notification/templates/sms/create')}}" class="btn btn-dark  btn-sm tx-white mg-l-10"><i class="icon ion-plus-circled lh-0"></i> ADD Sms Templates</a>
            <!--<a href="#" class="btn btn-dark  btn-sm tx-white mg-l-10 reload-table"><i class="icon ion-loop lh-0"></i> Refresh</a>-->
           </div><!-- card-option -->
      </div>
    <div class="card-body bd bd-t-0 rounded-bottom">
         <div class="table-wrapper">
            <table class="table table-bordered display responsive">
              <thead>
                <tr>
                  <th style="width:2%;">#</th>
                  <th style="width:15%;">Title</th>
                  <th style="width:25%;">Email Template</th>
                  <th style="width:10%;">Email Status</th>
                  <th style="width:25%;">SMS Template</th>
                  <th style="width:10%;">SMS Status</th>
                  
                </tr>
              </thead>
              <tbody>
                  <?php $i=1;?>
                  @foreach($settings as $row)
                   <tr>
                       <th>{{$i}}</th>
                       <th>{{$row->title}}</th>
                       <td>
                           <select class="select2-show-search select-temp-setting" data-id="{{$row->id}}" data-typ="email_template" style="width:100%">
                               <option value="">None</option>
                               @foreach($email_templates as $em)
                                 <option value="{{$em->id}}" @if($em->id==$row->email_template) selected @endif>{{$em->subject}}</option>
                               @endforeach
                           </select>
                        </td>
                       <td>
                           <select class="select2-show-search select-temp-setting" data-id="{{$row->id}}" data-typ="email_status" style="width:100%">
                               <option value="ACTIVE" @if($row->email_status=='ACTIVE') selected @endif>ACTIVE</option>
                               <option value="INACTIVE" @if($row->email_status=='INACTIVE') selected @endif>INACTIVE</option>
                           </select>
                       </td>
                       <td><select class="select2-show-search select-temp-setting" data-id="{{$row->id}}" data-typ="sms_template" style="width:100%">
                               <option value="">None</option>
                               @foreach($sms_templates as $sm)
                                 <option value="{{$sm->id}}" @if($sm->id==$row->sms_template) selected @endif>{{$sm->title}}</option>
                               @endforeach
                           </select>
                        </td>
                       <td>
                           <select class="select2-show-search select-temp-setting" data-id="{{$row->id}}" data-typ="sms_status" style="width:100%">
                                <option value="ACTIVE" @if($row->sms_status=='ACTIVE') selected @endif>ACTIVE</option>
                               <option value="INACTIVE" @if($row->sms_status=='INACTIVE') selected @endif>INACTIVE</option>
                           </select>
                       </td>
                   </tr>
                   <?php $i++;?>
                  @endforeach
              </tbody>
            </table>
        </div><!-- table-wrapper -->
     </div><!-- card-body -->
 </div>
         
         

      
@endsection