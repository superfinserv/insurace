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
         <div class="card bd-0">
            <div class="card-header bg-danger d-flex  align-items-center justify-content-between pd-y-5">
               <h6 class="mg-b-0 tx-14 tx-white">Enter Vehicle Number to get details</h6>
                <div class="card-option tx-24">
                  <a href="{{url('rto-master')}}" class="btn btn-dark  btn-sm tx-white mg-l-10"><i class="fas fa-arrows-alt lh-0"></i> Back</a>
                </div>
            </div>
            <div class="card-body bd bd-t-0 rounded-bottom"> 
          
                <div class="row no-gutters bd">
                    <div class="col-md-3 bg-gray-100">
                      <div class="pd-30">
                        <label class="tx-uppercase tx-10 tx-medium tx-spacing-1 tx-gray-600">Enter Vehicle RTO No</label>
                            <form id=""> 
                              <div class="form-group">
                               <input class="form-control is-valid" style="text-transform: uppercase;" id="vehicleNumber" name="vehicleNumber" placeholder="Rto No" type="text">
                             </div>
                             <button class="btn btn-info btn-block" id="btnRtoinfo">Get Details</button>
                          </form>
                      </div>
                    </div><!-- col-3 -->
                    <div class="col-md-9">
                      <div id="VinfoCode" style="background-color: #282a36 !important;color: #f8f8f2 !important;border: none;height: 300px;overflow-x: scroll;"></div>
                    </div><!-- col-9 -->
                </div><!-- row -->
             
            </div>
       </div>
          
@endsection