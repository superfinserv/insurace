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
          <h6 class="mg-b-0 tx-14 tx-white"> POSP Trash List</h6>
          <div class="card-option tx-24">
            
            <a href="#" class="btn btn-dark  btn-sm tx-white mg-l-10 reload-table"><i class="fas fa-sync-alt lh-0"></i> Refresh</a>
            <a href="{{url('agents/')}}" class="btn btn-success  btn-sm tx-white mg-l-10"><i class="icon ion-clipboard lh-0"></i> View active POSP</a>
            
           </div><!-- card-option -->
      </div>
    <div class="card-body bd bd-t-0 rounded-bottom">
         <div class="table-wrapper">
            <table class="table table-bordered filter-table ">
                <tr>
                    <td style="width:20%">
                        <div class="input-group">
                         <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                           <input id="table-0" class="form-control search-input-text" data-column="0" type="text" placeholder="POSP Name/Email/Mobile No" data-original-title="" title="">
                        </div>
                   </td>
                    <td style="width:20%">
                        <div class="input-group">
                         <div class="input-group-prepend"><span class="input-group-text">SS/POSP/</span></div>
                           <input id="table-1" class="form-control search-input-text" data-column="1" type="text" placeholder="POSP ID" data-original-title="" title="">
                        </div>
                   </td>
                   <td style="width:20%">
                        <div class="input-group">
                         <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                           <select id="table-2" class="form-control search-input-text" data-column="2">
                                <option value="">-Profile Status-</option>
                                <option value="VERIFIED">verified</option>
                                <option value="UNDR_VRF">Under verification</option>
                                <!--<option value="FEE_PEND">Fee Pending</option>-->
                                <option value="OTHR">OTHR</option>
                            </select>
                        </div>
                   </td>
                   <td style="width:20%">
                        <div class="input-group">
                         <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                           <select id="table-2" class="form-control search-input-text" data-column="3">
                                <option value="">-Test Status-</option>
                                <option value="ALLOWED">Allowed</option>
                                <option value="BLOCKED">Blocked</option>
                                <option value="UNDR_TRN">Under Tranning</option>
                            </select>
                        </div>
                   </td>
                </tr>
            </table>
            <table id="agent-datatable" class="table table-bordered">
              <thead>
                <tr>
                  <th class="wd-5p">#</th>
                  <th class="wd-15p">Name</th>
                  <th class="wd-10p">Mobile</th>
                  <th class="wd-20p">Email</th>
                  <th class="wd-12p">POSP ID</th>
                  <th class="wd-10p">Certificate</th>
                  <th class="wd-10p">Allow Test</th>
                  <th class="wd-8p">Status</th>
                  <th class="wd-10p">Action</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
        </div><!-- table-wrapper -->
     </div><!-- card-body -->
 </div>
         
         

      
@endsection