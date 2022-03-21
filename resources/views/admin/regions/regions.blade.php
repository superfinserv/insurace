@extends('admin.layout.app')
@section('content')
  <style>
      .dataTables_filter{
          display:none;
      }
  </style> 
       <div class="" >
           <div class="region-notify"></div>
           <form class="form-group" method="post" enctype="multipart/form-data" action="#" id="RegionsForm" >
                <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                
            <div class="row mg-b-25" data-select2-id="11">
              <div class="col-lg-3">
                    <div class="form-group">
                      <label class="form-control-label">Region Name: <span class="tx-danger">*</span></label>
                      <input class="form-control" type="text" name="regionName" id="regionName" placeholder="Enter Region name" >
                    </div>
              </div><!-- col-4 -->
              <div class="col-lg-7">
                    <div class="form-group">
                      <label class="form-control-label">Description: <span class="tx-danger">*</span></label>
                      <input class="form-control" type="text" name="regionDesc" id="regionDesc" placeholder="Enter description about Region" >
                    </div>
              </div><!-- col-4 -->
              
              <div class="col-lg-2 pd-t-30">
                  <button type="submit" id="saveRegionInfobtn" class="btn btn-info btn-block">Submit</button>
            </div><!-- row -->
            </div>
          </form>
        </div>
        <div class="card bd-0 ">
    <div class="card-header tx-medium bd-0 tx-white bg-danger">
       Region's List
    </div><!-- card-header -->
    <div class="card-body bd bd-t-0 rounded-bottom">
         <div class="table-wrapper">
            <table class="table table-bordered filter-table ">
                            <tr>
                                <td style="width:40%"></td>
                                <td style="width:30%">
                                    <div class="input-group">
                                     <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                                       <input id="table-0" class="form-control search-input-text" data-column="0" type="text" placeholder="Region Name" data-original-title="" title="">
                                    </div>
                               </td>
                               <td style="width:30%">
                                    <div class="input-group">
                                     <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                                       <input id="table-1" class="form-control search-input-text" data-column="1" type="text" placeholder="Search by Description" data-original-title="" title="">
                                    </div>
                               </td>
                              
                            </tr>
                            
                        </table>
            <table id="region-datatable" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Region Name</th>
                  <th>Description</th>
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