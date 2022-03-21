@extends('pos.layouts.app')
  @section('content')
   <style>
  
      
    .payment-status-section{
       text-align: center;
       padding-top: 20px;
       box-shadow: 0px 1px 5px 0px rgba(0,0,0,0.2), 0px 2px 2px 0px rgba(0,0,0,0.14), 0px 3px 1px -2px rgba(0,0,0,0.12);
        border-radius: 10px;
        background: #fff;
        height:400px;
       }
       
    .payment-status-section .pay-icon{
        width: 120px;
    }
    .payment-status-section h4.pay-heading{ 
        font-size: 24px;
        font-weight: 700;
    }
    .payment-status-section .pay-heading.success-pay{ 
        color: #7ac042;
    }
    
    .payment-status-section  .pay-heading.error-pay{ 
        color: red;
    }
    
    .payment-status-section p.line1{ 
        margin: 10px;
       font-size: 15px;
    }
    
    .payment-status-section p.line1 .i{ 
           font-weight: 500;
            color: #ac0f09;
            text-decoration: underline;
    }
    
    .payment-status-section p.linemore{ 
        margin: 10px;
        font-size: 15px;
    }
    
    .payment-status-section p.linemore i.trno{ 
        font-weight: bold;
    text-decoration: underline;
    }
   .btn-home{
     background: #ac0f09;
    color: #ffff;
    font-size: 15px;
   padding: 8px;
    width: 25%;
    border-radius: 25px;
}
      
   </style>
    <main role="main">
        <section class="invest-long page-heading-h2">
            <div class="container">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="row payment-status-section pay-success">
                            <div class="col-md-12">
                                <img class="pay-icon" src="{{asset('images/pay-fail.png')}}"/>
                                <h4 class="pay-heading error-pay">Payment failed!</h4>
                                <p class="line1">Sorry! we are unable to process you application fee payment to <i>SuperSolutions Pvt. Ltd.</i></p>
                                <p class="linemore">Don't worry and  try again to proccess Application fee.</p>
                                <a href="{{url('profile/payment-process')}}" class="btn btn-home">Try again</a>
                                <a href="{{url('/profile')}}" class="btn btn-home">Profile</a>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
        </section>
    </main>
@endsection