  var _payData = function () {
            var tmp = null;
            $.ajax({
                'async': false,
                'type': "GET",
                'global': false,
                'dataType': 'json',
                'url': base_url+"/get/load-feeinfo/", 
                'success': function (result) { 
                    tmp = result.data;
                }
            });
            return tmp;
          }(); 
   if(_payData.key){
       
       
        var options = {
                "key": _payData.key, // Enter the Key ID generated from the Dashboard
                "amount": parseInt(_payData.fee)*100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                "currency": "INR",
                "name": _payData.siteName,
                "description": "Posp application Fee",
                "image": "https://pos.superfinserv.co.in/public/site_assets/logo/small-icon-logo.png",
                "order_id": "", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                "handler": function (response){
                    // alert(response.razorpay_payment_id);
                    // alert(response.razorpay_order_id);
                    // alert(response.razorpay_signature)
                    console.log(response);
                    $.post(base_url+'/payment/create-payment',{amount:parseInt(_payData.fee)*100,paymentId:response.razorpay_payment_id},function(result){
                          window.location.href=base_url+"/payment/success";
                  },'json');
                },
                "modal": {
                    "ondismiss": function(){
                        console.log('Checkout form closed');
                        $('#btnPayFee').html('Pay Now');
                        $('#btnPayFee').attr('disabled',false);
                        $('#btnPayFee').prop('disabled',false);
                    }
                    
                },
                "prefill": {
                    "name": _payData.agent.name,
                    "email": _payData.agent.email,
                    "contact": _payData.agent.mobile
                },
                "notes": {
                    "address": _payData.siteAddress
                },
                "theme": {
                    "color": "#AC0F0B"
                }
            };
//   var razorpay = new Razorpay({
//       key: _payData.key,//'rzp_live_TCKGzAhT4oF1F4',
//       image: _payData.logo,//'https://insurance.supersolutions.in/img/site_logo/logo_5.png',
//   });
   }
   
    //  razorpay.once('ready', function(response) {
    //   console.log(response);
    // });
$(document).ready(function(){
    'use strict';
     var _token = $('meta[name="csrf-token"]').attr('content'); 
     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': _token
        }
     });
});


   $('body').on('click','#btnPayFee',function(e) {
            var loader = '<span class="inline-loader"><span class="inline-loader-box"></span><span class="inline-loader-box"></span><span class="inline-loader-box"></span></span>';
            var _this = $(this);
            _this.attr('disabled',true);
            _this.prop('disabled',true);
            _this.html(loader);
            var rzp1 = new Razorpay(options);
            rzp1.on('payment.failed', function (response){
                     console.log(response);
                    $('#btnPayFee').html('Pay Now');
                    $('#btnPayFee').attr('disabled',false);
                    $('#btnPayFee').prop('disabled',false);
                     toastr.error(response.error.description,"Error",{positionclass:'toast-bottom-right'});
                  //window.location.href=base_url+"/payment/fail";
                    // alert(response.error.code);
                    // alert(response.error.description);
                    // alert(response.error.source);
                    // alert(response.error.step);
                    // alert(response.error.reason);
                    // alert(response.error.metadata.order_id);
                    // alert(response.error.metadata.payment_id);
            });
           // document.getElementById('rzp-button1').onclick = function(e){
                rzp1.open();
                e.preventDefault();
           // }
   });



