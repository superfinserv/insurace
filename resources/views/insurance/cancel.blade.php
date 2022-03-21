<?php $host = request()->getHttpHost(); //@extends('web.layout.app')?>
 @extends(($host=="superfinserv.co.in") ? 'web.layout.app' : 'pos.layouts.app');
    @section('content')
      <main role="main">
         <section class="term-smoke ptb">
            <div class="container ">
              <div class="row">
                  <div class="col-md-3"></div>
                  <div class="col-md-6 text-center">
                      <p><i class="fa fa-exclamation-triangle" style="font-size: 117px;color: #b81b1b;"></i></p>
                      <h4 style="font-size: 24px;font-weight: 600;color#000;">Transaction Failed</h4>
                      <p>Your transaction was decalied</p>
                      <p><a href="{{url('/twowheeler-insurance/plan-summary/'.$info->enquiry_id)}}">Try again</a></p>
                  </div>
                  <div class="col-md-3"></div>
              </div>
            </div>
         </section>
      </main>
            
    
    @endsection