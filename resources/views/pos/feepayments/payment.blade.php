@extends('pos.layouts.app')
  @section('content')
  <style>
      .list-group-item{
       line-height: 30px !important;
      }
       .list-group-item small {
           font-size:12px;
       }
       .payment-elem button{
           width: 100%;
background: #AC0F0B;
color: #fff;
border: 1px solid #AC0F0B;
border-radius: 5px;
line-height: 40px;
       }
  </style>
    
    <main role="main">
        <section class="invest-long page-heading-h2">
            <div class="container">
                <h2>Application Fee</h2>
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                         <input type="hidden" name="pospName" id="pospName" value="{{Auth::guard('agents')->user()->name}}">
                        <input type="hidden" name="email" id="email_address" value="{{Auth::guard('agents')->user()->email}}">
                        <input type="hidden" name="contact" id="contact_address" value="{{Auth::guard('agents')->user()->mobile}}">
                         <ul class="list-group mb-3 payment-elem" >
                                <li class="list-group-item d-flex justify-content-between lh-condensed">
                                  <div>
                                    <h4 class="my-0">Fee</h4>
                                    <small class="text-muted">Payable fee without tax</small>
                                  </div>
                                  <span class="text-muted">₹{{$fee['totalActualPrice']}}/-</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between lh-condensed">
                                  <div>
                                    <h4 class="my-0">IGST</h4>
                                    <small class="text-muted">Tax(18%)</small>
                                  </div>
                                  <span class="text-muted">₹{{$fee['igst']}}/-</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between lh-condensed">
                                  <div>
                                    <h4 class="my-0">CGST</h4>
                                    <small class="text-muted">Tax(9%)</small>
                                  </div>
                                  <span class="text-muted">₹{{$fee['cgst']}}/-</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between lh-condensed">
                                  <div>
                                    <h4 class="my-0">SGST</h4>
                                    <small class="text-muted">Tax(9%)</small>
                                  </div>
                                  <span class="text-muted">₹{{$fee['sgst']}}/-</span>
                                </li>
                               
                                <li class="list-group-item d-flex justify-content-between">
                                  <span>Total (INR)</span>
                                  <strong>₹{{$fee['totalAmount']}}/-</strong>
                                </li>
                               <li class="list-group-item d-flex justify-content-between">
                                    <button type="button" id="btnPayFee">Pay Now</button>
                                </li>
                              </ul>
                        
                    </div><!--payment options-->
                    <div class="col-md-4"></div>
                </div>
            </div>
        </section>
    </main>
@endsection