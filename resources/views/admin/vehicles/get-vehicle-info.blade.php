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
         <div class="card shadow-base bd-0">
            <div class="card-header tx-medium bd-0 tx-white">
               <h6 class="mg-b-0 tx-14 tx-white">ADD NEW RTO</h6>
    
            </div>
            <div class="card-body bd bd-t-0 rounded-bottom"> 
               <form id="GetVehicleInfo">
                
                 <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                         <input class="form-control" type="text" required="" id="vNumber"  name="rtoTwHdfc" placeholder="Enter Vehicle Number">
                        </div>
                    </div>
                     <div class="col-md-3" style="margin-top: 30px;">
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit" id="btnCreateRtocode">Get Info</button>
                        </div>
                     </div>
                </div>
                
            </form>
            </div>
       </div>
       </hr>
        
      
@endsection