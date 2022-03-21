@extends('pos.layouts.app')
  @section('content')
   <style>
  
   .payment-section{
       box-shadow: 0px 1px 5px 0px rgba(0,0,0,0.2), 0px 2px 2px 0px rgba(0,0,0,0.14), 0px 3px 1px -2px rgba(0,0,0,0.12);
        border-radius: 10px;
        background: #fff;
        height:600px;
       }
   .payment-step{
     padding-left: 0px;
    padding-right: 0px;
     border-right: 1px solid#ccc;
   }
  .payment-step ul.payment-list {
    padding: 0;
    margin: 0;
    list-style-type: none;
}
.payment-step  ul.payment-list li.payment-type {
    list-style: none;
    /*display: inline-block;*/
    font-size: 16px;
    /*line-height: 6.5;*/
    color: #fff;
    font-weight: 600;
    cursor: pointer;
    position: relative;
    width: 100%;
    text-align: center;
    background: #ac0f0a;
    padding: 12px 12px;
    border-bottom: 1px solid #ccc;
   
}

ul.payment-list li.active{
    color:#ac0f0a !important;
    background: #fff !important;
}

ul.payment-list li:first-child{
    border-top-left-radius: 10px;
}
ul.payment-list li:last-child{
    border-bottom-left-radius: 10px;
}

.payment-elem{
    padding:12px;
    display:none;
}
.payment-elem.active{
    display:block;
}
.required{border: 1px solid #EA4335;}
.btn-pay{
    background: #ac0f09;
    color: #ffff;
    font-size: 15px;
    padding: 10px;
}
.btn-pay i{
    font-size: 20px;
    vertical-align: middle
}

form #card_number {
    background-image: url("http://demos.codexworld.com/credit-card-number-validation-jquery/css/images.png"), url("http://demos.codexworld.com/credit-card-number-validation-jquery/css/images.png");
    background-position: 2px -121px, 260px -61px;
    background-repeat: no-repeat;
    background-size: 120px 361px, 120px 361px;
    padding-left: 54px;
    width: 300px;
}

.list-banks .item-bank {
      padding: 12px;
      height: 65px;
      margin-bottom: 12px;
      position: relative;
      overflow: hidden;
      border:1px solid #fff;
      box-shadow: 0 2px 2px rgba(0, 0, 0, 0.2);
    }

    .item-bank:hover{
       box-shadow: 0 2px 2px rgba(0, 0, 0, 0.2);
       border:1px solid #30435e;
       cursor:pointer;
    }
    .list-banks .item-bank.active h4 {
      color: white;
    } 
    .list-banks .item-bank.active .circle{
         background:#fff;
    }
    .list-banks .item-bank.active{
        background:#30435e;
    }
    .item-bank:before {
      content: '';
      width: 100%;
      height: 100%;
      display: block;
      background: white;
      position: absolute;
      top: 0;
      left: 0;
      z-index: -1;
    }
    .item-bank .circle {
      width: 40px;
      height: 40px;
      background: #ccc;
      border-radius: 9999px;
      display: inline-block;
      vertical-align: middle;
      margin-right: 12px;
      position: relative;
      z-index: 1;
      overflow: hidden;
    }
    .item-bank .circle img {
      width: 100%;
    }
    .item-bank h4 {
     display: inline-block;
       /*// font-family: "Roboto", Helvetica, sans-serif;*/
        font-weight: 300;
        font-size: 14px;
        margin: 0;
        vertical-align: middle;
        position: relative;
        color: #4b65a0;
        z-index: 1;
        transition: all .5s;
    }
    .item-bank input {
      vertical-align: middle;
      display: none;
    }
    .item-bank input + label {
      display: inline-block;
      background: #ccc;
      width: 24px;
      height: 24px;
      border-radius: 2px;
      position: absolute;
      right: 20px;
      top: 20px;
      text-align: center;
      /*padding-top: 3px;*/
      color: transparent;
      cursor: pointer;
      transition: all .2s;
    }
    .item-bank input + label:after {
      content: '';
      background: rgba(3, 169, 244, 0.5);
      width: 10px;
      height: 10px;

      right: 8px;
      top: 8px;
      border-radius: 9999px;
      transition: all 0.3s ease-in;
      z-index: -1;
    }
    .item-bank input:checked + label {
      background: white;
      color: #4b65a0;
    }
    .item-bank label i{
        font-size: 25px;
    }
    
    
    
    /* upi*/
.list-upis {
         display: flex;
         flex-flow: row wrap;
      }
      .list-upis > .item-upi {
         /*flex: 1;*/
         padding: 0.5rem;
      }
       .list-upis > .item-upi input[type="radio"] {
         display: none;
      }
       .list-upis > .item-upi input[type="radio"]:not(:disabled) ~ label {
         cursor: pointer;
      }
       .list-upis > .item-upi input[type="radio"]:disabled ~ label {
         color: rgba(188, 194, 191, 1);
         border-color: rgba(188, 194, 191, 1);
         box-shadow: none;
         cursor: not-allowed;
      }
       .list-upis > .item-upi label {
         /*height: 100%;*/
         display: block;
         background: white;
         border: 2px solid #db3f3c;
         border-radius: 20px;
         padding: 1rem;
         margin-bottom: 1rem;
         text-align: center;
         box-shadow: 0px 3px 10px -2px rgba(161, 170, 166, 0.5);
         position: relative;
      }
      .list-upis > .item-upi label img{
           width: 65%;
      }
       .list-upis > .item-upi input[type="radio"]:checked + label {
         background: rgb(226, 221, 217);
         color: rgba(255, 255, 255, 1);
         /*box-shadow: 0px 0px 20px rgb(245, 134, 54);*/
      }
       .list-upis > .item-upi input[type="radio"]:checked + label::after {
      color: #db3f3c;
          font-family: FontAwesome;
          border: 2px solid #db3f3c;
          content: "\f00c";
          font-size: 15px;
          position: absolute;
          top: 8px;
          right: 0;
          transform: translateX(-50%);
          height: 25px;
          width: 25px;
          line-height: 22px;
          text-align: center;
          border-radius: 50%;
          background: white;
          box-shadow: 0px 2px 5px -2px rgba(0, 0, 0, 0.25);
      }
       .list-upis > .item-upi input[type="radio"]#control_05:checked + label {
         background: red;
         border-color: red;
      }
      .list-upis > .item-upi  p {
         font-weight: 900;
      }
       @media  only screen and (max-width: 700px) {
         .list-upis {
           flex-direction: column;
        }
      }
      
      .payment-message .alert-box{
            padding: 12px 12px;
            border: 1px solid #ccc;
            margin: 5px 1px;
            border-radius: 6px;
            font-size: 13px;
            
      }
      .payment-message .alert-box.success-alert{
          border-color: #ac0f09;
          color: #ac0f09;
      }
      .payment-message .alert-box.error-alert{
          border-color: #e60a0a;
          color: #e60a0a;
      }
      .payment-message .alert-box.warning-alert{
            border-color: #f19306;
           color: #f19306;
      }
      
     
      
   </style>
     <?php $assetRoot = "https://supersolutions.in/insurance/";?>
    <main role="main">
        <section class="invest-long page-heading-h2">
            <div class="container">
                <h2>Payment</h2>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <input type="hidden" name="email" id="email_address" value="{{Auth::guard('agents')->user()->email}}">
                        <input type="hidden" name="contact" id="contact_address" value="{{Auth::guard('agents')->user()->mobile}}">
                        <div class="row payment-section">
                            <div class="col-md-4 payment-step" style="">
                                <ul class="payment-list">
                                    <li data-type="CARD" class="payment-type active">
                                        Credit/Debit Card
                                    </li>
                                    <li data-type="NETBANKING" class="payment-type ">
                                        Net Banking
                                    </li>
                                    <li data-type="WELLET" class="payment-type ">
                                          Other Wallets
                                         </li>
                                    <li data-type="UPI" class="payment-type">
                                        Pay using UPI
                                         </li>
                                 </ul>
                            </div>
                            <div class="col-md-8" >
                                
                                   <!-- <div class="alert-box success-alert">-->
                                   <!--       <strong>Success!</strong> Indicates a successful or positive action.-->
                                   <!--</div>-->
                                   <!--<div class="alert-box error-alert">-->
                                   <!--       <strong>Error!</strong> Indicates a successful or positive action.-->
                                   <!--</div>-->
                                   <!--<div class="alert-box warning-alert">-->
                                   <!--       <strong>Alert!</strong> Indicates a successful or positive action.-->
                                   <!--</div>-->
                               
                                <div class="payment-elem card-payment-elem active">
                                   <h5>Fill required details and pay</h5>
                                   <div class="payment-message payment-message-card"></div>
                                   <form method="post" id="paymentForm">
                                      <div class="form-row">
                                       <div class="form-group col-md-12">
                                            <label for="card_number" class="h4">Card number</label>
                                            <input type="text" class="form-control number-only" name="card_number" id="card_number" placeholder="1234 5678 9012 3456">
                                        </div>
                                          
                                        <div class="form-group col-md-12">
                                            <label for="card_number" class="h4">Name on Card </label>
                                            <input type="text" class="form-control" id="name_on_card" name="name_on_card" placeholder="Card Holder Name" >
                                        </div> 
                                    </div>
                                    
                                      <div class="form-row">
                                        
                                        <div class="form-group col-md-4">
                                            <label for="expiry_month" class="h4">Month</label>
                                            <input type="text" class="form-control number-only" maxlength="2" id="expiry_month" name="expiry_month" placeholder="month">
                                        </div>
                                        
                                        <div class="form-group col-md-4">
                                            <label for="expiry_year" class="h4">Year</label>
                                            <input type="text" class="form-control number-only" maxlength="4" id="expiry_year" name="expiry_year" placeholder="Year">
                                        </div>
                                        
                                        <div class="form-group col-md-4">
                                            <label for="cvv" class="h4">CVV</label>
                                            <input type="text" class="form-control number-only" maxlength="3" id="cvv" name="cvv" placeholder="cvv code">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12 card-pay-btn-section" >
                                            <button type="button" id="btnCardPay" class="btn btn-block btn-pay">Procced to Pay ₹ {{number_format((float)$fee, 2, '.', '')}}/- <i class="fa fa-angle-double-right" aria-hidden="true"></i></button>
                                        </div>
                                    </div>
                                    
                                    </form>
                                    
                                    
                                </div>
                                
                                <div class="payment-elem netbanking-payment-elem">
                                   <h5>Select Your bank to make net banking payment</h5>
                                    <div class="payment-message payment-message-netbanking"></div>
                                   <form method="post" id="netpaymentForm">
                                       <div class="list-banks row">
                                           <?php foreach($topBanks as $top){?>
                                             <div class="col-md-12">
                                                 <div class="item-bank netbank_selector">
                                                 <div class="circle"><img src="{{$assetRoot.'banklogo/'.strtolower($top->icon)}}" /></div>
                                                   <h4>{{$top->name}}</h4><input class="" id="bank-{{$top->short}}" value="{{$top->short}}" type="radio" name="bank_selector"  />
                                                  <label for="bank-{{$top->short}}"><i class="fa fa-check"></i></label>
                                                </div>
                                           </div>
                                           <?php }?>
                                       </div>
                                       <hr/>
                                       <div class="row">
                                           <div class="col-md-12">
                                                <select type="text" class="form-control invest-month" id="select_bank_name" name="select_bank_name">
                                                    <option value="">Other Banks</option>
                                                     <?php foreach($otherBanks as $othr){?>
                                                     <option value="{{$othr->short}}">{{$othr->name}}</option>
                                                     <?php } ?>
                                                </select>
                                           </div>
                                       </div>
                                       
                                        <div class="form-row" style="margin-top:12px;">
                                            <div class="form-group col-md-12 netbank-pay-btn-section" >
                                                <button type="button" class="btn btn-block btn-pay" id="btnNetBankPay">Procced to Pay ₹ {{number_format((float)$fee, 2, '.', '')}}/- <i class="fa fa-angle-double-right" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                       
                                       
                                   </form>
                                </div>
                                
                                <div class="payment-elem wellet-payment-elem" >
                                   <h5>Select Your wellet to make wellet payment</h5>
                                   <div class="payment-message payment-message-wellet"></div>
                                   <form method="post" id="welletpaymentForm">
                                       <div class="row list-upis listwelletoptions">
                                              <div class="item-upi col-md-6">
                                                <input type="radio" id="select-wellet01" name="select-wellet" value="freecharge" checked="">
                                                <label for="select-wellet01">
                                                    <img src="https://image4.owler.com/logo/freecharge_owler_20190323_120936_original.png" style="width: 60%;height: 28px;">
                                                 
                                                </label>
                                              </div>
                                              
                                              <div class="item-upi col-md-6">
                                                <input type="radio" id="select-wellet02" name="select-wellet" value="payzapp">
                                                <label for="select-wellet02">
                                                      <img src="https://inetonlineexam.com/payimg/3.png" style="width: 60%;height: 28px;">
                                                </label>
                                              </div>
                                        </div>
                                         <div class="form-row">
                                            <div class="form-group col-md-12 wellet-pay-btn-section" >
                                                <button type="button" id="btnPayWellet" class="btn btn-block btn-pay">Procced to Pay ₹ {{number_format((float)$fee, 2, '.', '')}}/- <i class="fa fa-angle-double-right" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                   </form>
                                </div>
                                
                                <div class="payment-elem upi-payment-elem" >
                                   <h5>Select Your UPI to make upi payment</h5>
                                    <div class="payment-message payment-message-upi"></div>
                                   <form method="post" id="upipaymentForm">
                                       <div class="row list-upis listuipoptions">
                                              <div class="item-upi col-md-6">
                                                <input type="radio" id="control_01" name="select" value="1" checked="">
                                                <label for="control_01">
                                                    <img src="https://d2407na1z3fc0t.cloudfront.net/Banner/upi_gpay.png" style=" width: 25%;">
                                                 
                                                </label>
                                              </div>
                                              
                                              <div class="item-upi col-md-6">
                                                <input type="radio" id="control_03" name="select" value="3">
                                                <label for="control_03">
                                                      <img src="https://d2407na1z3fc0t.cloudfront.net/Banner/more_upi_v2.png">
                                                </label>
                                              </div>
                                        </div>
                                        <div class="form-row">
                                           <div class="form-group col-md-12">
                                                <input type="text" class="form-control" name="vap_address" id="vap_address" placeholder="VPA address (Ex.7657565884@upi,7657565884@hdfc)">
                                            </div>
                                        </div>
                                         <div class="form-row">
                                            <div class="form-group col-md-12 upi-pay-btn-section" >
                                                <button type="button" id="btnPayUpi" class="btn btn-block btn-pay">Procced to Pay ₹ {{number_format((float)$fee, 2, '.', '')}}/- <i class="fa fa-angle-double-right" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                   </form>
                                </div>
                                
                            </div><!--col-8-->
                        </div>
                        
                    </div><!--payment options-->
                    <div class="col-md-2"></div>
                </div>
            </div>
        </section>
    </main>
@endsection