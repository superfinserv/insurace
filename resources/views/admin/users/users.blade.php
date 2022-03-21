@extends('admin.layout.app')
@section('content')
  <style>
      .dataTables_filter{
          display:none;
      }
  </style> 
   <div class="agent-list-notify"></div>
  <div class="card bd-0 ">
    <!--<div class="card-header tx-medium bd-0 tx-white bg-danger">-->
     
    <!--</div><!-- card-header -->
     <div class="card-header bg-danger d-flex  align-items-center justify-content-between pd-y-5">
          <h6 class="mg-b-0 tx-14 tx-white"> Users List</h6>
          <div class="card-option tx-24">
            <a href="{{url('/users/manage/register')}}" class="btn btn-dark  btn-sm tx-white mg-l-10"><i class="icon ion-plus-circled lh-0"></i> ADD NEW USER</a>
            <a href="#" class="btn btn-dark  btn-sm tx-white mg-l-10 reload-table"><i class="icon ion-loop lh-0"></i> Refresh</a>
           </div><!-- card-option -->
      </div>
    <div class="card-body bd bd-t-0 rounded-bottom">
         <div class="table-wrapper">
            <table class="table table-bordered filter-table ">
                <tr>
                    <td style="width:30%">
                        <div class="input-group">
                         <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                           <input id="table-0" class="form-control search-input-text" data-column="0" type="text" placeholder="User Name/Email/Mobile No" data-original-title="" title="">
                        </div>
                   </td>
                   <td style="width:20%">
                        <div class="input-group">
                         <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                           <select id="table-1" class="form-control search-input-text select2-show-search " data-column="1" style="width: 85%;">
                                <option value="">-All Roles-</option>
                                @foreach($roles as $role)
                                <option value="{{$role->id}}">{{$role->role}}</option>
                                @endforeach
                            </select>
                        </div>
                   </td>
                   <td style="width:20%">
                        <div class="input-group">
                         <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                           <select id="region" class="form-control select2-show-search search-input-text" data-column="2" style="width: 85%;">
                                <option value="">-All Region-</option>
                                 @foreach($regions as $rg)
                                <option value="{{$rg->id}}">{{$rg->name}}</option>
                                @endforeach
                            </select>
                        </div>
                   </td>
                   <td style="width:20%">
                        <div class="input-group">
                         <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                           <select id="branch" class="form-control select2-show-search search-input-text" data-column="3" style="width:85%">
                                <option value="">-Choose Branch-</option>
                            </select>
                        </div>
                   </td>
                </tr>
            </table>
            <table id="users-datatable" class="table display responsive">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Mobile</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Branch</th>
                  <th>Region</th>
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