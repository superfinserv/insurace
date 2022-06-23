@extends('admin.layout.app')
@section('content')
<style>
    .list-sortable {
    height: 550px;
    overflow: scroll;
    overflow-x: hidden;
}
.card-sortable{
    padding: 0px;
}
</style>
  <div class="row">
      <div class="col-md-4">
           <div class="card bd-0 ">
            <div class="card-header tx-medium bd-0 tx-white bg-danger">
              Pvt Car Sortable
            </div><!-- card-header -->
            <div class="card-body bd bd-t-0 rounded-bottom card-sortable">
                 <ul class="list-group list-group-striped list-sortable sortable-vehicle" data-type="{{$vtype}}">
                     @foreach ($Makes as $mk)
                        <li class="list-group-item list-item-car rounded-top-0" id="item-{{$mk->id}}" data-serial="{{$mk->serial_no}}" data-id="{{$mk->id}}">
                          <p class="mg-b-0"><span class="tx-success mg-r-8">{{$mk->serial_no}}.</span>
                          <strong class="tx-inverse tx-medium">{{trim($mk->make)}}</strong> 
                          <a data-toggle="tooltip" data-placement="top" title="Sort Modals of {{trim($mk->make)}}" href="{{url('/vehicles/modal/sortable/'.$mk->id.'/'.$vtype)}}" style="float: right;"><i class="fa fa-angle-right "></i></a>
                          </p>
                          
                        </li>
                   @endforeach
              </ul>
            </div><!-- card-body -->
         </div>
      </div>
  </div>
   
        
@endsection