@extends('admin.layout.app')
@section('content')
  <style>
      .dataTables_filter{
          display:none;
      }
      
      #agent-payment-datatable.dataTable td.reorder {
            text-align: center;
            cursor: move;
        }
        
        table.dataTable thead .sorting_desc , table.dataTable thead .sorting_asc,table.dataTable thead .sorting {
            background-image: unset;
         }
         
        table thead th {
            vertical-align: middle !important;
        }
        
        table tbody tr td{
           font-size: 13px;
           letter-spacing: 0.5px;
           vertical-align: middle !important;
        }
  </style> 
   <div class="agent-list-notify"></div>
  
  <div class="card bd-0 ">
    <!--<div class="card-header tx-medium bd-0 tx-white bg-danger">-->
     
    <!--</div><!-- card-header -->
     <div class="card-header bg-danger d-flex  align-items-center justify-content-between pd-y-5">
          <h6 class="mg-b-0 tx-14 tx-white"> POSP's Paymemt List</h6>
          <div class="card-option tx-24">
            
           <a href="{{url('agents/')}}" class="btn btn-dark  btn-sm tx-white mg-l-10"><i class="icon ion-plus-circled lh-0"></i>POSP List</a>
            
          </div><!-- card-option -->
      </div>
    <div class="card-body bd bd-t-0 rounded-bottom">
         <div class="table-wrapper">
            <table class="table table-bordered filter-table ">
                <tr>
                    <td style="width:20%">
                       
                   </td>
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
                           <input id="table-0" class="form-control search-input-text" data-column="2" type="text" placeholder="Transaction ID" data-original-title="" title="">
                        </div>
                   </td>
                  
                </tr>
            </table>
            <table id="agent-payment-datatable" class="table table-bordered display">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Invoice NO</th>
                  <th>Payment ID</th>
                  <th>Posp Name</th>
                  <th>POSP ID</th>
                  <th>Amount</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
        </div><!-- table-wrapper -->
     </div><!-- card-body -->
 </div>
         
         

      
@endsection