@extends('admin.layout.app')
@section('content')
 
       <style>
           .dataTables_filter {
  display: block;
}
       </style>
       <div class="card shadow-base bd-0">
            <div class="card-header tx-medium bd-0 tx-white">
               <h6 class="mg-b-0 tx-14 tx-inverse">HDFC ERGO Vehicles Model List</h6>
                  
              </div>
            <div class="card-body bd bd-t-0 rounded-bottom">
                 <div class="table-wrapper">
                    
                    <table id="{{$prm}}-vehicles-datatable" class="table table-bordered display">
                      <thead>
                        <tr>
                          <!--<th>#</th>-->
                          <th>Model Name</th>
                          <th>Variant Name</th>
                          <th>Make ID</th>
                          <th>Model ID</th>
                          <th>Fuel Type</th>
                          <th>CubicCapacity</th>
                        </tr>
                        
                      </thead>
                      <tbody></tbody>
                    </table>
                </div><!-- table-wrapper -->
            </div><!-- card-body -->
         </div>
         
         

      
@endsection