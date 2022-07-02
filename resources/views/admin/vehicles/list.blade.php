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
        
        table.dataTable thead .sorting_desc , table.dataTable thead .sorting_asc,table.dataTable thead .sorting {
            background-image: unset;
         }
         
        table thead th {
            vertical-align: middle !important;
        }
        .vcode input{
            width: 103px;
        }
        
        table tbody tr td{
           font-size: 13px;
           letter-spacing: 0.5px;
        }
         
  </style> 
       
        <div class="card bd-0 ">
           <div class="card-header bg-danger d-flex  align-items-center justify-content-between pd-y-5">
                  <h6 class="mg-b-0 tx-14 tx-white"> Vehicles List</h6>
                  <div class="card-option tx-24">
                       <a href="{{url('/vehicles/make/sortable/'.$prm)}}" class="btn btn-dark  btn-sm tx-white mg-l-10"><i class="fas fa-arrows-alt lh-0"></i> Sort {{$prm}} Vehicle</a>
                    <a href="{{url('/fgi-vehicles-models/'.$prm)}}" class="btn btn-dark  btn-sm tx-white mg-l-10">FGI Models</a>
                    <a href="{{url('/hdfc-vehicles-models/'.$prm)}}" class="btn btn-dark  btn-sm tx-white mg-l-10">HDFC ERGO Models</a>
                    <a href="{{url('/vehicles/'.$prm.'/export')}}" class="btn btn-success  btn-sm tx-white mg-l-10"><i style="color:#fff" class="fa fa-file-excel-o"></i> Export</a>
                     
                   </div><!-- card-option -->
              </div>
            <div class="card-body bd bd-t-0 rounded-bottom">
                 <div class="table-wrapper">
                     <table class="table table-bordered filter-table ">
                <tr>
                    <td style="width:20%">
                        <div class="input-group">
                           <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                           <input id="table-0" class="form-control search-input-text" data-column="0" type="text" placeholder="Make Name" data-original-title="" title="">
                        </div>
                   </td>
                    <td style="width:20%">
                        <div class="input-group">
                           <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                           <input id="table-1" class="form-control search-input-text" data-column="1" type="text" placeholder="Model Name" data-original-title="" title="">
                        </div>
                   </td>
                   <td style="width:20%">
                        <div class="input-group">
                           <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                           <input id="table-2" class="form-control search-input-text" data-column="2" type="text" placeholder="Varient Name" data-original-title="" title="">
                        </div>
                   </td>
                   <td style="width:20%">
                        <div class="input-group">
                           <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                           <input id="table-3" class="form-control search-input-text" data-column="3" type="text" placeholder="Fuel Type" data-original-title="" title="">
                        </div>
                   </td>
                   <td style="width:20%">
                        <div class="input-group">
                           <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                           <input id="table-3" class="form-control search-input-text" data-column="4" type="text" placeholder="Cubic Capacity" data-original-title="" title="">
                        </div>
                   </td>
                </tr>
            </table>
                    <table id="vehicles-datatable" class="table table-bordered display">
                      <thead>
                        <tr>
                          <th colspan="4" class="text-center th-v-middle">MMVs</th>
                          
                          <th rowspan="2" class="text-center th-v-middle">Fuel Type</th>
                          <th rowspan="2" class="text-center th-v-middle">Digit</th>
                          <th rowspan="2" class="text-center th-v-middle">FGI</th>
                          <th colspan="2" class="text-center th-v-middle">HDFC</th>
                        </tr>
                        <tr>
                             <th  class="text-center th-v-middle">Make</th>
                             <th  class="text-center th-v-middle">Modal</th>
                             <th  class="text-center th-v-middle"> Varient</th>
                             <th  class="text-center th-v-middle">CC</th>
                            
                             <th style="border-left: 1px solid #ccc;" class=" text-center th-v-middle">MakeID</th>
                             <th class="text-center th-v-middle">ModelID</th>
                        </tr>
                        
                      </thead>
                      <tbody></tbody>
                    </table>
                </div><!-- table-wrapper -->
            </div><!-- card-body -->
         </div>
         
         

      
@endsection