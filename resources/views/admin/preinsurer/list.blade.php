@extends('admin.layout.app')
@section('content')
  <style>
      .dataTables_filter{
          display:none;
      }
  </style> 
        <div class="card bd-0 ">
        
        <div class="card-header bg-danger d-flex  align-items-center justify-content-between pd-y-5">
          <h6 class="mg-b-0 tx-14 tx-white"> Previous Insurer's List</h6>
          <div class="card-option tx-24">
            <a href="#" class="btn btn-dark btn-sm tx-white mg-l-10" id="addNewInsurer"><i class="icon ion-plus-circled lh-0"></i> ADD NEW Insurer</a>
         </div><!-- card-option -->
      </div>
        <div class="card-body bd bd-t-0 rounded-bottom">
         <div class="table-wrapper">
            <table class="table table-bordered filter-table ">
                            <tr>
                                <td style="width:70%"></td>
                                <td style="width:30%">
                                    <div class="input-group">
                                     <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                                       <input id="table-0" class="form-control search-input-text" data-column="0" type="text" placeholder="Search" data-original-title="" title="">
                                    </div>
                               </td>
                            </tr>
                            
                        </table>
            <table id="pre-insurer-table" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Insurer Name</th>
                  <th>Digit code</th>
                  <th>Insurer Type</th>
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