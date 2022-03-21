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
      <div class="col-md-12">
           <div class="card bd-0 ">
            <div class="card-header tx-medium bd-0 tx-white bg-danger">
              Pvt Car Sortable
            </div><!-- card-header -->
            <div class="card-body bd bd-t-0 rounded-bottom card-sortable">
                 <ul class="list-group list-group-striped list-sortable sortable-modals" data-make="{{$make->id}}">
                     @foreach ($data as $modal)
                        <li class="list-group-item list-item-modal rounded-top-0" id="item-{{$modal->id}}" data-serial="{{$modal->serial_no}}" data-id="{{$modal->id}}">
                          <p class="mg-b-0"><span class="tx-success mg-r-8">{{$modal->serial_no}}.</span>
                          <strong class="tx-inverse tx-medium">{{trim($modal->modal)}}</strong> 
                          </p>
                        </li>
                   @endforeach
              </ul>
            </div><!-- card-body -->
         </div>
      </div>
  </div>
       
        
@endsection