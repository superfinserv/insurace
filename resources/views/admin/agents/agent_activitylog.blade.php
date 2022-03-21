@extends('admin.layout.app')
@section('content')
<?php  $assetUrl = "https://supersolutions.in/insassets/agents/";?>
  <div class="card bd-0 ">
     <style> .clr{  color: #0a4b55 !important;}</style>
     @include('admin.agents.agents_menu_header')
    <div class="card-body bd bd-t-0 rounded-bottom">
        <div class="row">
            <div class="col-md-3 col-lg-3">
                 @include('admin.agents.agents_menu')
            </div>
              
            <div class="col-md-9 col-lg-9 mg-t-20 mg-lg-t-0-force">
                
                <div class="card mg-b-20">
                    <div class="card-header d-flex align-items-center justify-content-between ">
                        <h6 class="mg-b-0 tx-14 tx-inverse">{{$agentData->name}}'s activity log</h6>
                           <div class="card-option tx-12"></div>
                    </div><!-- card-header -->
                    <div class="card-body">
                        <div class="row">
                            <ul class="list-group" style="width: 100%;">
                                @foreach($logs as $log)
                                <?php $date_ = date_create($log->created_at);$date = date_format($date_, 'd  M, Y \a\t\ h:i A');?>
                                  <li class="list-group-item rounded-top-0">
                                    <p class="mg-b-0">
                                      <i class="icon ion-compose tx-info mg-r-8"></i>
                                      <strong class="tx-inverse tx-medium" style="font-weight:300">{{$log->message}} on </strong>
                                      <span class="text-muted" style="font-size: 12px;">{{$date}}</span>
                                    </p>
                                  </li>
                                  @endforeach
                                  <!-- add more here -->
                                </ul>
                            
                        </div>
                    </div>
                </div>
                    
                     
            </div><!-- col-9 -->
        </div>
                 
     </div><!-- card-body -->
 </div>
         
         

      
@endsection