@extends('admin.layout.app')
@section('content')
  <style>
      .dataTables_filter{
          display:none;
      }
      #categories-datatable th,#categories-datatable td{
          text-align:center;
      }
  </style> 
       <div class="card bd-0 ">
            <div class="card-header tx-medium bd-0 tx-white bg-danger">
               Categories List
            </div><!-- card-header -->
            <div class="card-body bd bd-t-0 rounded-bottom">
                 <div class="table-wrapper">
                    <table id="categories-datatable" class="table table-bordered">
                      <thead>
                        <tr>
                          <th rowspan="2">Category</th>
                         <th rowspan="2">Icon</th>
                          <th rowspan="2">Type</th>
                          
                          <th colspan="2">Serial Order</th>
                          <th rowspan="2">Website Home</th>
                          <th rowspan="2">App Icon</th>
                          <th rowspan="2">Status</th>
                          <th rowspan="2">Action</th>
                        </tr>
                        <tr>
                            <th style="border-left: 1px solid #ccc;">Web</th>
                            <th>App</th>
                        </tr>
                      </thead>
                      <tbody></tbody>
                    </table>
                </div><!-- table-wrapper -->
             </div><!-- card-body -->
        </div>
         
         

      
@endsection