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
                 <ul class="list-group list-group-striped list-sortable sortable-car" >
                     @foreach ($pvtCars as $car)
                        <li class="list-group-item list-item-car rounded-top-0" id="item-{{$car->id}}" data-serial="{{$car->serial_no}}" data-id="{{$car->id}}">
                          <p class="mg-b-0"><span class="tx-success mg-r-8">{{$car->serial_no}}.</span>
                          <strong class="tx-inverse tx-medium">{{trim($car->make)}}</strong> 
                          <a data-toggle="tooltip" data-placement="top" title="Sort Modals of {{trim($car->make)}}" href="{{url('/vehicles/modal/sortable/')}}/{{$car->id}}" style="float: right;"><i class="fa fa-angle-right "></i></a>
                          </p>
                          
                        </li>
                   @endforeach
              </ul>
            </div><!-- card-body -->
         </div>
      </div>
      <div class="col-md-4">
           <div class="card bd-0 ">
            <div class="card-header tx-medium bd-0 tx-white bg-danger">
             MoterBike & scooter Sortable
            </div><!-- card-header -->
            <div class="card-body bd bd-t-0 rounded-bottom card-sortable">
                <ul class="list-group list-group-striped list-sortable sortable-bike" >
                     @foreach ($bikes as $bike)
                        <li class="list-group-item list-item-bike rounded-top-0" id="item-{{$bike->id}}" data-serial="{{$bike->serial_no}}" data-id="{{$bike->id}}">
                          <p class="mg-b-0"><span class="tx-success mg-r-8">{{$bike->serial_no}}.</span>
                          <strong class="tx-inverse tx-medium">{{trim($bike->make)}}-({{$bike->vehicle_type}})</strong> 
                           <a data-toggle="tooltip" data-placement="top" title="Sort Modals of {{trim($bike->make)}}" href="{{url('/vehicles/modal/sortable/')}}/{{$bike->id}}" style="float: right;"><i class="fa fa-angle-right "></i></a>
                          </p>
                        </li>
                   @endforeach
              </ul> 
            </div><!-- card-body -->
         </div>
      </div>
      <div class="col-md-4">
           <div class="card bd-0 ">
            <div class="card-header tx-medium bd-0 tx-white bg-danger">
              Passenger Carraying Sortable
            </div><!-- card-header -->
            <div class="card-body bd bd-t-0 rounded-bottom card-sortable">
                  <ul class="list-group list-group-striped list-sortable sortable-pc" >
                     @foreach ($pcs as $pc)
                        <li class="list-group-item list-item-pc rounded-top-0" id="item-{{$pc->id}}" data-serial="{{$pc->serial_no}}" data-id="{{$pc->id}}">
                          <p class="mg-b-0"><span class="tx-success mg-r-8">{{$pc->serial_no}}.</span>
                          <strong class="tx-inverse tx-medium">{{trim($pc->make)}}</strong> 
                           <a data-toggle="tooltip" data-placement="top" title="Sort Modals of {{trim($pc->make)}}" href="{{url('/vehicles/modal/sortable/')}}/{{$pc->id}}" style="float: right;"><i class="fa fa-angle-right "></i></a>
                          </p>
                        </li>
                   @endforeach
              </ul>
            </div><!-- card-body -->
         </div>
      </div>
  </div>
   </br> </hr></br>
  <div class="row">
       <div class="col-md-4">
            <div class="card bd-0 ">
              <div class="card-header tx-medium bd-0 tx-white bg-danger">
             Goods Carrying Sortable
            </div><!-- card-header -->
              <div class="card-body bd bd-t-0 rounded-bottom card-sortable">
                 <ul class="list-group list-group-striped list-sortable sortable-gc" >
                     @foreach ($gcs as $gc)
                        <li class="list-group-item list-item-gc rounded-top-0" id="item-{{$gc->id}}" data-serial="{{$gc->serial_no}}" data-id="{{$gc->id}}">
                          <p class="mg-b-0"><span class="tx-success mg-r-8">{{$gc->serial_no}}.</span>
                          <strong class="tx-inverse tx-medium">{{trim($gc->make)}}</strong> 
                           <a data-toggle="tooltip" data-placement="top" title="Sort Modals of {{trim($gc->make)}}" href="{{url('/vehicles/modal/sortable/')}}/{{$gc->id}}" style="float: right;"><i class="fa fa-angle-right "></i></a>
                          </p>
                        </li>
                   @endforeach
              </ul>
            </div><!-- card-body -->
         </div>
       </div>
  </div>
       
        
@endsection