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
    
    .payment-status-section p.line1 i{ 
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

      
   </style>
    <main role="main">
        <section class="invest-long page-heading-h2">
            <div class="container">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="row payment-status-section pay-success">
                            <div class="col-md-12">
                                <img class="pay-icon" src="{{asset('site_assets/img/pay-success.png')}}"/>
                                <h4 class="pay-heading success-pay">Payment successfull!</h4>
                                <p class="line1">You have successfully paid POSP application fee of ₹<?=number_format((float)$info->total_amount, 2, '.', '');?>/- to <b style="color:#AC0F0B">{{config('custom.site_name')}}</b></p>
                                <p class="linemore">Your Application fee payment reference no. <b class="trno">#<?=$info->invoice_no;?></b></p>
                                <?php if(!$info->total_amount){?>
                                <a href="{{url('/profile/details/')}}" class="btnSF btn-red" style="width: unset;">Continue for identity verification</a>
                                <?php } ?>
                                <!--<a href="{{url('/profile')}}" class="btn btn-home">Profile</a>-->
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
        </section>
    </main>
@endsection