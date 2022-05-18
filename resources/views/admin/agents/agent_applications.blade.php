@extends('admin.layout.app')
@section('content')
  <style>
      .dataTables_filter{
          display:none;
      }
      
      #agent-datatable.dataTable td.reorder {
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
          <h6 class="mg-b-0 tx-14 tx-white"> POSP Application List</h6>
          <div class="card-option tx-24">
            <a href="#" class="btn btn-dark  btn-sm tx-white mg-l-10 reload-table"><i class="fas fa-sync-alt lh-0"></i> Refresh</a>
          </div><!-- card-option -->
      </div>
    <div class="card-body bd bd-t-0 rounded-bottom">
         <div class="table-wrapper">
            <table class="table table-bordered filter-table ">
                <tr>
                    <td style="width:20%"> </td>
                    <td style="width:20%">
                        <div class="input-group">
                         <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                           <input id="table-0" class="form-control search-input-text" data-column="0" type="text" placeholder="Name/Email/Mobile No" data-original-title="" title="">
                        </div>
                   </td>
                    <td style="width:20%">
                        <div class="input-group">
                         <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                           <input id="table-1" class="form-control search-input-text" data-column="1" type="text" placeholder="Application ID" data-original-title="" title="">
                        </div>
                   </td>
                   <td style="width:20%">
                        <div class="input-group">
                         <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                           <select id="table-2" class="form-control search-input-text" data-column="2">
                                <option value="">-Status-</option>
                                <option value="Pending">Pending</option>
                                <option value="Inforce">Approved</option>
                                <option value="Declined">Declined</option>
                            </select>
                        </div>
                   </td>
                   
                </tr>
            </table>
            <table id="agent-application-datatable" class="table table-bordered display">
              <thead>
                <tr>
                  <th rowspan="2" class="text-center th-v-middle">#</th>
                  <th rowspan="2" class="text-center th-v-middle">Name</th>
                  <th rowspan="2" class="text-center th-v-middle">Contact</th>
                  <th colspan="2" class="text-center th-v-middle">Address</th>
                  <th rowspan="2" class="text-center th-v-middle">Status</th>
                  <th rowspan="2" class="text-center th-v-middle">Action</th>
                </tr>
                <tr>
                    <th class="text-center th-v-middle" style="border-left: 1px solid #ccc;">City</th>
                    <th class="text-center th-v-middle">State</th>
                </tr>
              </thead>
              
              <tbody>
                  
              </tbody>
            </table>
        </div><!-- table-wrapper -->
     </div><!-- card-body -->
 </div>
         
         

      
@endsection