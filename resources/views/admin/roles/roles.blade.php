@extends('admin.layout.app')
@section('content')
  <style>
      .dataTables_filter{
          display:none;
      }
  </style> 
       <div class="" >
           <div class="role-notify"></div>
           <form class="form-group" method="post" enctype="multipart/form-data" action="#" id="RoleForm" >
           <input name="_token" type="hidden" value="{{ csrf_token() }}" />
             <div class="row mg-b-5">
                <div class="col-lg-3"></div>
                <div class="col-lg-4">
                    <div class="form-group">
                      <label class="form-control-label">Role Name: <span class="tx-danger">*</span></label>
                      <input class="form-control" type="text" name="roleName" id="roleName" placeholder="Enter Role Name" >
                    </div>
              </div>
              <div class="col-lg-2 pd-t-30">
                  <button type="submit" class="btn btn-info btn-block saveRoleInfoBtn">Submit</button>
              </div>
              <div class="col-lg-3"></div>
            </div>
          </form>
        </div>
        <div class="card bd-0 ">
    <div class="card-header tx-medium bd-0 tx-white bg-danger">
       Role's List
    </div><!-- card-header -->
    <div class="card-body bd bd-t-0 rounded-bottom">
         <div class="table-wrapper">
            <table class="table table-bordered filter-table ">
                            <tr>
                                <td style="width:70%"></td>
                                <td style="width:30%">
                                    <div class="input-group">
                                     <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                                       <input id="table-0" class="form-control search-input-text" data-column="0" type="text" placeholder="Role Name" data-original-title="" title="">
                                    </div>
                               </td>
                            </tr>
                            
                        </table>
            <table id="role-datatable" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Role Name</th>
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