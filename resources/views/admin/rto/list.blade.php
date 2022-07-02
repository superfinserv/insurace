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
               <h6 class="mg-b-0 tx-14 tx-white">ADD NEW RTO</h6>
                <div class="card-option tx-24">
                  <a href="{{url('rto-vehicle-info')}}" class="btn btn-dark  btn-sm tx-white mg-l-10"><i class="fas fa-arrows-alt lh-0"></i> Get Vehicle Info</a>
                </div>
            </div>
            <div class="card-body bd bd-t-0 rounded-bottom"> 
            <form id="createNewRtoForm">
                 <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                          <label class="form-control-label">RTO Code: <span class="tx-danger">*</span></label>
                          <input class="form-control" type="text" required="" id="rtoCode"  name="rtoCode" placeholder="RTO Code">
                        </div>
                    </div>
                     <div class="col-md-3">
                        <div class="form-group">
                          <label class="form-control-label">RTO Text: <span class="tx-danger">*</span></label>
                          <input class="form-control" type="text" required="" id="rtoTxt"  name="rtoTxt" placeholder="RTO Text">
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="form-group">
                          <label class="form-control-label">RTO State: <span class="tx-danger">*</span></label>
                          <select class="form-control select2-show-search" id="rtoState" name="rtoState">
                              <option value="">Choose State</option>
                              @foreach($states as $state)
                                <option value="{{$state->id}}">{{$state->name}}</option>
                              @endforeach
                          </select>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="form-group">
                          <label class="form-control-label">RTO City: <span class="tx-danger">*</span></label>
                           <select class="form-control select2-show-search" id="rtoCity"  name="rtoCity">
                              <option value="">Choose City</option>
                             
                          </select>
                        </div>
                    </div>
                    
                </div>
                 <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                          <label class="form-control-label">HDFC ERGO TW Code: <span class="tx-danger">*</span></label>
                          <input class="form-control" type="text" required="" id="rtoTwHdfc"  name="rtoTwHdfc" placeholder="HDFC ERGO TW Code">
                        </div>
                    </div>
                     <div class="col-md-3">
                        <div class="form-group">
                          <label class="form-control-label">HDFC ERGO CAR Code: <span class="tx-danger">*</span></label>
                          <input class="form-control" type="text" required="" id="rtoCarhdfc"  name="rtoCarhdfc" placeholder="HDFC ERGO CAR Code">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                          <label class="form-control-label">Status: <span class="tx-danger">*</span></label>
                           <select class="form-control select2-show-search" id="rtoStatus"  name="rtoStatus">
                              <option value="Active">Active</option>
                              <option value="Inactive">Inactive</option>
                             
                          </select>
                        </div>
                    </div>
                     <div class="col-md-3" style="margin-top: 30px;">
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit" id="btnCreateRtocode">SAVE</button>
                        </div>
                     </div>
                </div>
            </form>
            </div>
       </div>
       </hr>
        <div class="table-wrapper mg-t-20">
                     
                     <table class="table table-bordered filter-table " style="background: #fff;">
                         <tr>
                    <td style="width:40%">
                        
                   </td>
                    <td style="width:20%">
                        <div class="input-group">
                           <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                           <input id="table-0" class="form-control search-input-text" data-column="0" type="text" placeholder="Rto code" data-original-title="" title="">
                        </div>
                   </td>
                    <td style="width:20%">
                        <div class="input-group">
                           <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                           <input id="table-1" class="form-control search-input-text" data-column="1" type="text" placeholder="City Name" data-original-title="" title="">
                        </div>
                   </td>
                   <td style="width:20%">
                        <div class="input-group">
                           <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                           <input id="table-2" class="form-control search-input-text" data-column="2" type="text" placeholder="State Name" data-original-title="" title="">
                        </div>
                   </td>
                   <!--<td style="width:20%">-->
                   <!--     <div class="input-group">-->
                   <!--        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>-->
                   <!--        <input id="table-3" class="form-control search-input-text" data-column="3" type="text" placeholder="Main Code" data-original-title="" title="">-->
                   <!--     </div>-->
                   <!--</td>-->
                   
                </tr>
                     </table>
                    <table id="rto-datatable" class="table table-bordered table-colored table-dark">
                      <thead>
                        <tr>
                          <!--<th>#</th>-->
                          <th>RTO Code</th>
                           <th>Text</th>
                           <th>City</th>
                          <th>State</th>
                          <th>HDFC Tw Code</th>
                          <th>HDFC Car Code</th>
                          <th>Status</th>
                        </tr>
                        
                      </thead>
                      <tbody></tbody>
                    </table>
                
         
         

      
@endsection