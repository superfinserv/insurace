@extends('admin.layout.app')
@section('content')
  <style>
      .dataTables_filter{
          display:none;
      }
  </style> 
       <div class="" >
           <div class="branch-notify"></div>
           <form class="form-group" method="post" enctype="multipart/form-data" action="#" id="BranchForm" >
                <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                
            <div class="row mg-b-5">
              <div class="col-lg-3">
                    <div class="form-group">
                      <label class="form-control-label">Branch Name: <span class="tx-danger">*</span></label>
                      <input class="form-control" type="text" name="name" id="name" placeholder="Enter Branch Name" >
                    </div>
              </div><!-- col-3 -->
              <div class="col-lg-2">
                    <div class="form-group">
                      <label class="form-control-label">Branch Code: <span class="tx-danger">*</span></label>
                      <input class="form-control" type="text" name="code" id="code" placeholder="Enter Branch Code" >
                    </div>
              </div><!-- col-2 -->
              <div class="col-lg-2">
                    <div class="form-group">
                      <label class="form-control-label">State: <span class="tx-danger">*</span></label>
                      <select class="form-control select2-show-search" id="state" name="state">
                         <option value="">choose state</option>
                        @foreach($states as $st)
                         <option value="{{$st->id}}">{{$st->name}}</option>
                        @endforeach
                       </select>
                    </div>
              </div><!-- col-2 -->
              <div class="col-lg-2">
                    <div class="form-group">
                      <label class="form-control-label">City: <span class="tx-danger">*</span></label>
                       <select class="form-control select2-show-search" id="city" name="city">
                        <option value="">choose city</option>
                       </select>
                    </div>
              </div><!-- col-2 -->
              <div class="col-lg-3">
                    <div class="form-group">
                      <label class="form-control-label">Region: <span class="tx-danger">*</span></label>
                       <select class="form-control select2-show-search" id="regionId" name="regionId">
                        <option value="">-select-</option>
                        @foreach($regions as $rg)
                         <option value="{{$rg->id}}">{{$rg->name}}</option>
                         @endforeach
                       </select>
                    </div>
              </div><!-- col-3 -->
            </div><!-- row-->
            <div class="row mg-b-5">
              <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label">Branch Address: <span class="tx-danger">*</span></label>
                      <input class="form-control" type="text" name="address" id="address" placeholder="Enter Branch address" >
                    </div>
              </div><!-- col-6 -->
              <div class="col-lg-3">
                    <div class="form-group">
                      <label class="form-control-label">Branch Pincode: <span class="tx-danger">*</span></label>
                      <input class="form-control" type="text" name="pincode" id="pincode" placeholder="Enter Branch Pincode" >
                    </div>
              </div><!-- col-3 -->
               <div class="col-lg-2 pd-t-30">
                  <button type="submit" class="btn btn-info btn-block saveBranchInfoBtn">Submit</button>
              </div><!-- row -->
            </div>
          </form>
        </div>
        <div class="card bd-0 ">
    <div class="card-header tx-medium bd-0 tx-white bg-danger">
       Branch's List
    </div><!-- card-header -->
    <div class="card-body bd bd-t-0 rounded-bottom">
         <div class="table-wrapper">
            <table class="table table-bordered filter-table ">
                            <tr>
                                <td style="width:10%"></td>
                                <td style="width:30%">
                                    <div class="input-group">
                                     <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                                       <input id="table-0" class="form-control search-input-text" data-column="0" type="text" placeholder="Branch Name" data-original-title="" title="">
                                    </div>
                               </td>
                               <td style="width:30%">
                                    <div class="input-group">
                                     <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                                       <input id="table-1" class="form-control search-input-text" data-column="1" type="text" placeholder="Region Name" data-original-title="" title="">
                                    </div>
                               </td>
                               <td style="width:30%">
                                    <div class="input-group">
                                     <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                                       <input id="table-2" class="form-control search-input-text" data-column="2" type="text" placeholder="State Name" data-original-title="" title="">
                                    </div>
                               </td>
                              
                            </tr>
                            
                        </table>
            <table id="branch-datatable" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Branch Name</th>
                  <th>Code</th>
                  <th>Region</th>
                  <th>Address</th>
                   <th>City</th>
                   <th>State</th>
                  <th>Pincode</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
        </div><!-- table-wrapper -->
     </div><!-- card-body -->
 </div>
         
         

      
@endsection