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
          <h6 class="mg-b-0 tx-14 tx-white"> Users Details</h6>
          <div class="card-option tx-24">
            <a href="{{url('/users/')}}" class="btn btn-dark  btn-sm tx-white mg-l-10"><i class="icon ion-chevron-left lh-0"></i> Back</a>
          </div><!-- card-option -->
      </div>
    <div class="card-body bd bd-t-0 rounded-bottom">
         <div class="table-wrapper">
             <table class="table display responsive ">
              
              <tbody>
                <tr>
                  <td  style="width:15%;background: #d5d3d3;">NAME</td>
                  <td  style="width:35%">{{$user->name}}</td>
                  <td  style="width:15%;background: #d5d3d3;">EMAIL</td>
                  <td  style="width:35%">{{$user->email}}</td>
                </tr>
                <tr>
                  <td  style="width:15%;background: #d5d3d3;">MOBILE</td>
                  <td  style="width:35%">{{$user->mobile}}</td>
                  <td  style="width:15%;background: #d5d3d3;">ALTERNATE NO</td>
                  <td  style="width:35%">{{$user->alternate_mobile}}</td>
                </tr>
                
                <tr>
                  <td  style="width:15%;background: #d5d3d3;">GENDER</td>
                  <td  style="width:35%">{{$user->gender}}</td>
                  <td  style="width:15%;background: #d5d3d3;">MERITAL STATUS</td>
                  <td  style="width:35%">{{$user->marital_status}}</td>
                </tr>
                
                <tr>
                  <td  style="width:15%;background: #d5d3d3;">REGION</td>
                  <td  style="width:35%">{{$region}}</td>
                  <td  style="width:15%;background: #d5d3d3;">BRANCH</td>
                  <td  style="width:35%">{{$branch}}</td>
                </tr>
               <tr>
                  <td  style="width:15%;background: #d5d3d3;">ROLE</td>
                  <td  style="width:35%" colspan="3">{{$role}}</td>
                  
                </tr>
                 <tr>
                  <td  style="width:15%;background: #d5d3d3;">ADDRESS</td>
                  <td  style="width:35%" colspan="3">{{$user->address}}</td>
                </tr>
                <tr>
                  <td  style="width:15%;background: #d5d3d3;">STATE</td>
                  <td  style="width:35%">{{$state}}</td>
                  <td  style="width:15%;background: #d5d3d3;">CITY</td>
                  <td  style="width:35%">{{$city}}</td>
                </tr>
                <tr>
                  <td  style="width:15%;background: #d5d3d3;">PINCODE</td>
                  <td  style="width:35%">{{$user->pincode}}</td>
                  
                </tr>
                
              </tbody>
            </table>
         </div>
         <hr/>
         <div class="card">
            <div class="card-header tx-medium">
              List POSP's 
            </div><!-- card-header -->
            <div class="card-body">
            <div class="bd bd-gray-300 rounded table-responsive">
            <table class="table table-bordered mg-b-0">
              <thead>
                <tr>
                  <th>POSP ID</th>
                  <th>Name</th>
                  <th>Mobile</th>
                  <th>Email</th>
                </tr>
              </thead>
              <tbody>
                  @isset($posps)
                  @foreach($posps as $posp)
                    <tr>
                      <td>{{$posp->posp_ID}}</td>
                      <td>{{$posp->name}}</td>
                      <td>{{$posp->mobile}}</td>
                      <td>{{$posp->email}}</td>
                    </tr>
                 @endforeach
                 @endisset
              </tbody>
            </table>
          </div>
            </div><!-- card-body -->
          </div>
     </div><!-- card-body -->
 </div>
         
         

      
@endsection