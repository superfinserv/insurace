@extends('admin.layout.app')
@section('content')

  <div class="card bd-0 ">
      @include('admin.agents.agents_menu_header')
    <div class="card-body bd bd-t-0 rounded-bottom">
        <div class="row">
            <div class="col-md-3 col-lg-3">
                 @include('admin.agents.agents_menu')
            </div>
             <?php  $assetUrl = "https://supersolutions.in/insurance/agents/";?>
            <div class="col-md-9 col-lg-9 mg-t-20 mg-lg-t-0-force">
                <div class="agent-identity-notify"></div>
              <form class="form-group" method="post" enctype="multipart/form-data" action="#" id="agentEducationalInfo" >
                <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                <input name="_agent" type="hidden" id="_agent" value="{{$agentData->id}}" />
                  <div class="row row-sm mg-t-20">
                      
                      <div class="col-sm-6 col-lg-6">
                        
                        <?php if($agentData->payment_status==1){?>
                        <?php $pay = DB::table('agent_payments')->where('agent_id',$agentData->id)->first();
                              $paydate= date("j F ,Y h:i A", strtotime($pay->transaction_date));?>
                            <div class="card shadow-base bd-0">
                              <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                                <h6 class="card-title tx-uppercase tx-12 mg-b-0">Application fee paid</h6>
                                <span class="tx-12 tx-uppercase"><?=$paydate;?></span>
                              </div><!-- card-header -->
                              <div class="card-body d-xs-flex justify-content-between align-items-center">
                                <h4 class="mg-b-0 tx-inverse tx-lato tx-bold">₹<?=$pay->total_amount;?>/-</h4>
                                <p class="mg-b-0 tx-sm"><span class="tx-success"><i class="fa fa-arrow-up"></i> <?=$pay->transaction_id;?></span></p>
                              </div><!-- card-body -->
                              <div class="card-footer">
                                   <button type="button" data-id="{{$agentData->id}}" class="btn btn-sm btn-success pay-modify">Update</button>
                              </div>
                            </div><!-- card -->
                        <?php }else{ ?>
                         <div class="card shadow-base bd-0">
                              <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                                <h6 class="card-title tx-uppercase tx-12 mg-b-0">Application fee due</h6>
                                <span class="tx-12 tx-uppercase tx-danger">Not received yet</span>
                              </div><!-- card-header -->
                              <div class="card-body d-xs-flex justify-content-between align-items-center">
                                <h4 class="mg-b-0 tx-inverse tx-lato tx-bold">₹<?="399";?>/-</h4>
                                <button type="button" data-id="{{$agentData->id}}" class="btn btn-sm btn-success pay-modify">Update</button>
                              </div><!-- card-body -->
                            </div><!-- card -->
                        <?php } ?>
                      </div><!-- col6-->
                      
                      <div class="col-sm-6 col-lg-6 mg-t-20 mg-sm-t-0"></div>
                    </div>
             </form>
     </div><!-- card-body -->
 </div>
         
         

      
@endsection