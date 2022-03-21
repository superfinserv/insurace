@extends('admin.layout.app')
@section('content')
  <style>
      .dataTables_filter{
          display:none;
      }
  </style> 
   <div class="agent-list-notify"></div>
  <div class="card bd-0 ">
    <!--<div class="card-header tx-medium bd-0 tx-white bg-danger">-->
     
    <!--</div><!-- card-header -->
     <div class="card-header bg-danger d-flex  align-items-center justify-content-between pd-y-5">
          <h6 class="mg-b-0 tx-14 tx-white"> Email Templtes List</h6>
          <div class="card-option tx-24">
            <a href="{{url('/notification/templates/email/create')}}" class="btn btn-dark  btn-sm tx-white mg-l-10"><i class="icon ion-plus-circled lh-0"></i> ADD NEW Templates</a>
            <!--<a href="#" class="btn btn-dark  btn-sm tx-white mg-l-10 reload-table"><i class="icon ion-loop lh-0"></i> Refresh</a>-->
           </div><!-- card-option -->
      </div>
    <div class="card-body bd bd-t-0 rounded-bottom">
         <div class="table-wrapper">
            <table class="table table-bordered filter-table ">
                <tr>
                    <td style="width:30%">
                        <div class="input-group">
                         <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                           <input id="table-0" class="form-control search-input-text" data-column="0" type="text" placeholder="Email subject keyword" data-original-title="" title="">
                        </div>
                   </td>
                   <td style="width:30%">
                        <div class="input-group">
                         <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                           <input id="table-1" class="form-control search-input-text" data-column="1" type="text" placeholder="Email body keyword" data-original-title="" title="">
                        </div>
                   </td>
                   
                </tr>
            </table>
            <table id="emailtemp-datatable" class="table display responsive">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Subject</th>
                  <th>Body</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
        </div><!-- table-wrapper -->
     </div><!-- card-body -->
 </div>
         
         

      
@endsection