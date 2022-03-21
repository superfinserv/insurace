@extends('admin.layout.app')
@section('content')
  <style>
      .dataTables_filter{
          display:none;
      }
  </style> 
   <div class="customer-list-notify"></div>
  <div class="card bd-0 ">
   
     <div class="card-header bg-danger d-flex   align-items-center justify-content-between">
          <h6 class="mg-b-0 tx-14 tx-white"> Customers List</h6>
      </div>
    <div class="card-body bd bd-t-0 rounded-bottom">
         <div class="table-wrapper">
            <table id="customers-datatable" class="table display responsive">
              <thead>
                <tr>
                  <th class="wd-5p">#</th>
                  <th class="wd-15p">Name</th>
                  <th class="wd-10p">Mobile</th>
                  <th class="wd-20p">Email</th>
                  <th class="wd-8p">Status</th>
                  <th class="wd-20p">Created At</th>
                  <th class="wd-10p">Action</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
        </div><!-- table-wrapper -->
     </div><!-- card-body -->
 </div>
@endsection