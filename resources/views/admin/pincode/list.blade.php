@extends('admin.layout.app')
@section('content')
  <style>
      .dataTables_filter{
          display:none;
      }
       td.details-control {
            background: url('https://insurance.supersolutions.in/icons/datatable_open.png') no-repeat center center;
            cursor: pointer;
        }
        tr.shown td.details-control {
            background: url('https://insurance.supersolutions.in/icons/datatable_close.png') no-repeat center center;
        }
        #vehicles-datatable.dataTable td.reorder {
            text-align: center;
            cursor: move;
        }
  </style> 
       
        <div class="card bd-0 ">
           <div class="card-header bg-danger d-flex  align-items-center justify-content-between pd-y-5">
                  <h6 class="mg-b-0 tx-14 tx-white"> Pincode List</h6>
                  <div class="card-option tx-24">
                    
                    <!--<a href="#" class="btn btn-dark  btn-sm tx-white mg-l-10"><i class="fas fa-arrows-alt lh-0"></i> Sort Brands</a>-->
                     
                   </div><!-- card-option -->
              </div>
            <div class="card-body bd bd-t-0 rounded-bottom">
                 <div class="table-wrapper">
                     <table class="table table-bordered filter-table ">
                <tr>
                    <td style="width:20%">
                        <div class="input-group">
                           <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                           <input id="table-0" class="form-control search-input-text" data-column="0" type="text" placeholder="Pincode" data-original-title="" title="">
                        </div>
                   </td>
                    <td style="width:20%">
                        <div class="input-group">
                           <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                           <input id="table-1" class="form-control search-input-text" data-column="1" type="text" placeholder="District" data-original-title="" title="">
                        </div>
                   </td>
                   <td style="width:20%">
                        <div class="input-group">
                           <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                           <input id="table-2" class="form-control search-input-text" data-column="2" type="text" placeholder="State Txt" data-original-title="" title="">
                        </div>
                   </td>
                   <td style="width:20%">
                        <div class="input-group">
                           <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                           <input id="table-3" class="form-control search-input-text" data-column="3" type="text" placeholder="State" data-original-title="" title="" readonly>
                        </div>
                   </td>
                   <td style="width:20%">
                        <div class="input-group">
                           <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                           <input id="table-3" class="form-control search-input-text" data-column="4" type="text" placeholder="City" data-original-title="" title="" readonly>
                        </div>
                   </td>
                </tr>
            </table>
                    <table id="pincode-datatable" class="table table-bordered display">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Pincode</th>
                          <th>District</th>
                          <th>TxtState</th>
                          <th>State</th>
                          <th>City</th>
                        </tr>
                        
                      </thead>
                      <tbody></tbody>
                    </table>
                </div><!-- table-wrapper -->
            </div><!-- card-body -->
         </div>
         
         

      
@endsection