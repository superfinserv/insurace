       <!--<div class="card-header tx-medium bd-0 tx-white bg-danger ">-->
     
    <!--</div>-->
    <!-- card-header -->
      <div class="card-header bg-danger d-flex   align-items-center justify-content-between pd-y-5">
           <h6 class="mg-b-0 tx-14 tx-white">{{$agentData->name}}</h6>
          <div class="card-option tx-24">
            <a href="{{url('agents')}}" class="btn btn-dark  btn-sm tx-white mg-l-10"><i class="icon ion-arrow-left-a lh-0"></i> Back</a>
            <a href="{{url('agentinfo/'.$agentData->id)}}" class="btn btn-success  btn-sm tx-white mg-l-10">View Deails</a></a>
          </div><!-- card-option -->
      </div>