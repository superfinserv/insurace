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
   
   var TopArr = ["SBIN","PUNB_R","ICIC","UTIB","HDFC"];
   var topBanks = [];
   var isupiActive =false;
   var BankList = [];
   if(_payData.key){
   var razorpay = new Razorpay({
       key: _payData.key,//'rzp_live_TCKGzAhT4oF1F4',
       image: _payData.logo,//'https://insurance.supersolutions.in/img/site_logo/logo_5.png',
   });
   }
   
     razorpay.once('ready', function(response) {
      console.log(response);
    });
    ;(function($) {
    'use strict';
    var PAY_JS = {
        	init:function(){
        	    this._cardPayment();
        	    this._paymentMethods();
                this._upiPayment();
                this._netBankingPayment();
                
        	},
        	
        	_orderTotal:function(){
        	    var total = 0;
        	   //  return  total = function () {
            //             var tmp = null;
            //             $.ajax({
            //                 'async': false,
            //                 'type': "GET",
            //                 'global': false,
            //                 'dataType': 'json',
            //                 'url': base_url+"/get/load-feeinfo/", 
            //                 'success': function (result) { 
            //                     tmp = parseInt(result.data.fee);
            //                     console.log("_data",result)
            //                     console.log("Fee",result.data.fee)
            //                 }
            //             });
            //             return tmp;
            //           }(); 
                
        	    total=parseInt(_payData.fee);
                return total;
        	 },//Total AMOUNT
        	 
        	 _getUserInfo:function(){
        	     var contact=$('#contact_address').val();
                 var email=$('#email_address').val();
                 var info = { "contact": contact, "email": email }
                 return  info;
        	 },//user info
        	 
            _paymentMethods:function(){
        	     if($('.payment-list').length>0 && $('.payment-type').length>0 && $('.payment-elem').length>0){
        	          $('body').on('click','.payment-type',function(e) {
        	              e.preventDefault();
        	              var typ= $(this).attr("data-type");
        	               $(".payment-type").each(function() {
                               $(this).removeClass('active');
                            });
                            
                            $(".payment-elem").each(function() {
                               $(this).removeClass('active');
                            });
                            
                            $(this).addClass('active');
                            $('.'+typ.toLowerCase()+'-payment-elem').addClass('active');
        	          });
        	     }
        	},//tiggele paymwnts methods
        	
        	_initOrder:function(amount){
        	    
        	     var content = function () {
                        var tmp = null;
                        $.ajax({
                            'async': false,
                            'type': "POST",
                            'global': false,
                            'dataType': 'html',
                            'data':{amount:amount},
                            'url': base_url+"/payment/initOrder", 
                            'success': function (data) { 
                                tmp = JSON.parse(data);
                            }
                        });
                        return tmp;
                      }();
                 return content;
        	    
        	},// order
        	
        	_createOrder:function(mode,paymentId,respData){
        	    var postData ={  mode:mode,paymentId:paymentId, respData:respData } 
                $.post(base_url+"/payment/create-payment",postData,function(result){
                    var str = $.trim(result.status);
                    if(str=='success'){
                        window.location.href=base_url+"/payment/success";
                    }else{
                         window.location.href=base_url+"/payment/fail";
                    }
                    console.log("_createOrder",result)
                },"json");
        	},// Create Order
        	
        	_initPayment:function(method,data){
        	    //razorpay.createPayment(data, { gpay: true });
        	    razorpay.createPayment(data);
                            razorpay.on('payment.success', function(resp) {
                                if(method=="CARD"){
                                     var respInfo = {
                                            amount: data.amount, card_owner: $('#name_on_card').val(),card_no: $('#card_number').val(), card_cvv: $('#cvv').val(),
                                            card_month: $('#expiry_month').val(),card_year: $('#expiry_year').val()
                                    };
                                    PAY_JS._createOrder(method,resp.razorpay_payment_id,respInfo);
                                }else if(method=="NETBANKING"){
                                    var respInfo = { amount:data.amount };
                                    PAY_JS._createOrder(method,resp.razorpay_payment_id,respInfo);
                                 }else if(method=="UPI"){
                                      var respInfo = { amount:data.amount,vpa:$('#vpa_addrs').val() };
                                      PAY_JS._createOrder(method,resp.razorpay_payment_id,respInfo);
                                 }
                                 else if(method=="WELLET"){
                                      var respInfo = { amount:data.amount };
                                      PAY_JS._createOrder(method,resp.razorpay_payment_id,respInfo);
                                 }
                             }); 
                            razorpay.on('payment.error', function(resp){
                              //alert(resp.error.description)
                               $('.payment-message-'+method.toLowerCase()).empty().append('<div class="alert-box error-alert">'
                                                              +'<strong>Error!</strong> '+resp.error.description
                                                        +'</div>'); 
                          }); // will pass error object to error handler
        	},//init pay
        	
        	_cardPayment:function(){
        	   if($('.card-pay-btn-section').length>0){
        	     $('body').on("click","#btnCardPay",function(e){ 
        	         var valid = cardFormValidate();
        	        if(valid){
            	        var total = PAY_JS._orderTotal();
            	        var user = PAY_JS._getUserInfo();
            	        if(total){
            	          var initData = PAY_JS._initOrder(total);
            	          var initSt = $.trim(initData.status);
            	          if(initSt=="success"){
            	            var data = {
                                amount: initData.data.amount,email:user.email,contact:user.contact, method: 'card', 'card[name]': $('#name_on_card').val(),
                                'card[number]': $('#card_number').val(), 'card[cvv]': $('#cvv').val(),
                                'card[expiry_month]': $('#expiry_month').val(),'card[expiry_year]': $('#expiry_year').val()
                            };
                             
                             PAY_JS._initPayment('CARD',data);
                           }else{
                               alert("order init fail");
                           }
            	         }else{ alert("invalid total amount");}
        	        }else{
        	            $('.payment-message-card').empty().append('<div class="alert-box error-alert">'
                                                              +'<strong>Error!</strong> Please Enter Valid card details to make payment.'
                                                        +'</div>');
        	        }
        	      });
        	    }// has btn
        	},// Card Payment
        	
        	_netBankingPayment:function(){
        	   if($('.list-banks').length>0){
        	       $(document).on("click",".netbank_selector",function(e){ 
        	         e.preventDefault();
        	         $('.payment-message-netbanking').empty();
        	           var radioValue = $("input[name='bank_selector']:checked").val();
            	       $('#select_bank_name').val(radioValue);
                       $('#select_bank_name').select2().trigger('change');
            	     })
        	   }
        	   
        	   if($('.netbank-pay-btn-section').length>0){
        	     $(document).on("click","#btnNetBankPay",function(e){ 
        	         e.preventDefault();
        	          $('.payment-message-netbanking').empty();
        	         var bankName = $('#select_bank_name').val();//$("input[name='bank_selector']:checked").val();
        	         if(bankName){
                         var total = PAY_JS._orderTotal();
                         var user = PAY_JS._getUserInfo();
            	         if(total){
                	          var initData = PAY_JS._initOrder(total);
                	          var initSt = $.trim(initData.status);
                	          if(initSt=="success"){ 
                	              var data = {
                                            amount: initData.data.amount,email:user.email ,
                                            contact: user.contact, order_id: initData.data.id,
                                            method: 'netbanking', bank: bankName
                                        };

                                PAY_JS._initPayment("NETBANKING",data);
                	          }else{ 
                	              $('.payment-message-netbanking').empty().append('<div class="alert-box error-alert">'
                                  +'<strong>Error!</strong> Internal server error occur, try again!.'
                                 +'</div>');
                	          }
            	         }else{ 
            	             $('.payment-message-netbanking').empty().append('<div class="alert-box error-alert">'
                                  +'<strong>Error!</strong> Invalid total payable amount., try again!.'
                            +'</div>');
            	         }
                     }else{ //else empty value
                           $('.payment-message-netbanking').empty().append('<div class="alert-box error-alert">'
                                  +'<strong>Error!</strong> Please select your preferred bank to make transaction.'
                            +'</div>');
                     }
        	     });
        	    }
        	 },//Net Banbanking
        	
        	_upiPayment:function(){
              if($('.upi-payment-elem').length>0 && $('.listuipoptions').length>0){
                    var total = PAY_JS._orderTotal();
                     if(total){
                         $('body').on("click","#btnPayUpi",function(e){ 
                              e.preventDefault();
                          $('.payment-message-upi').empty();
                          var vpa  = $('#vap_address').val();
                          var user = PAY_JS._getUserInfo();
                          
                          if(vpa!=""){
                               razorpay.verifyVpa(vpa).then((resp) => { 
                	                   var initData = PAY_JS._initOrder(total);
                        	           var initSt = $.trim(initData.status);
                                        if(initSt=="success"){
                                            
                            	              var data = {
                                                amount: initData.data.amount,email: user.email,
                                                contact: user.contact, order_id: initData.data.id,
                                                method: 'upi', vpa: vpa
                                            };
                                            PAY_JS._initPayment("UPI",data);
                        	            }else{ 
                        	                 $('.payment-message-upi').empty().append('<div class="alert-box error-alert">'
                                                              +'<strong>Error!</strong>'+initData.message
                                                        +'</div>'); 
                        	            }
                	                }).catch((err) => {
                	                    console.log("catch-err",err);
                	                    if(err.error){
                	                         $('.payment-message-upi').empty().append('<div class="alert-box error-alert">'
                                                              +'<strong>Error!</strong> '+err.error.description
                                                        +'</div>'); 
                	                    }else{
                	                         $('.payment-message-upi').empty().append('<div class="alert-box error-alert">'
                                                              +'<strong>Error!</strong> Something went wrong.Check before'
                                                        +'</div>'); 
                	                    }
                	                   
                	                    
                	                });
                              
                              
                          }else{
                               $('.payment-message-upi').empty().append('<div class="alert-box error-alert">'
                                                              +'<strong>Error!</strong> Plaase Enter Valid UPI addres eg:7676654443@upi etc.'
                                                        +'</div>');
                          }
                         });
                     }else{
                         $('.payment-message-upi').empty().append('<div class="alert-box error-alert">'
                                  +'<strong>Error!</strong> Invalid total payable amount., try again!.'
                            +'</div>');
                     }
                 }
             },// UPI INIT
            
            _welletPayment:function(){
              if($('.wellet-payment-elem').length>0 && $('.listwelletoptions').length>0){
                  if(isupiActive){
                    var upisHtml = "";
                    var total = PAY_JS._orderTotal();
                     if(total){
                        $(document).on("click","#btnPayWellet",function(e){ 
                          e.preventDefault();
                          
                          var user = PAY_JS._getUserInfo();
                          var welletValue = $("input[name='select-wellet']:checked").val();
                          if(welletValue){
                             var initData = PAY_JS._initOrder(total);
                             var initSt = $.trim(initData.status);
                             if(initSt=="success"){ 
                                var data = {
                                           amount: initData.data.amount,email: user.email,
                                            contact: user.contact, order_id: initData.data.id,
                                            method: 'wellet', wellet: welletValue
                                        };
                                PAY_JS._initPayment("WELLET",data);
                            }else{ alert("order init fail");}
                          }else{
                               alert("Please checked any wellet");
                          }
                         });
                     }
                  }
             }
             },// WELLET INIT
    }
	window.onload = function () {	PAY_JS.init();	}
    })(window.Zepto || window.jQuery, window, document);
    
    function cardFormValidate(){
    	var cardValid = 0;
    	  
    	//card number validation
    	$('#card_number').validateCreditCard(function(result){ 
    	    //console.log(result);
    		var cardType = (result.card_type == null)?'':result.card_type.name;
    		if(cardType == 'Visa'){
    			var backPosition = result.valid?'2px -163px, 260px -87px':'2px -163px, 260px -61px';
    		}else if(cardType == 'visa_electron'){
    			var backPosition = result.valid?'2px -205px, 260px -87px':'2px -163px, 260px -61px';
    		}else if(cardType == 'MasterCard'){
    			var backPosition = result.valid?'2px -247px, 260px -87px':'2px -247px, 260px -61px';
    		}else if(cardType == 'Maestro'){
    			var backPosition = result.valid?'2px -289px, 260px -87px':'2px -289px, 260px -61px';
    		}else if(cardType == 'Discover'){
    			var backPosition = result.valid?'2px -331px, 260px -87px':'2px -331px, 260px -61px';
    		}else if(cardType == 'Amex'){
    			var backPosition = result.valid?'2px -121px, 260px -87px':'2px -121px, 260px -61px';
    		}else{
    			var backPosition = result.valid?'2px -121px, 260px -87px':'2px -121px, 260px -61px';
    		}
    		$('#card_number').css("background-position", backPosition);
    		if(result.valid){
    			$("#card_type").val(cardType);
    			$("#card_number").removeClass('required');
    			cardValid = 1;
    		}else{
    			$("#card_type").val('');
    			$("#card_number").addClass('required');
    			cardValid = 0;
    		}
    	});
    	  
    	//card details validation
    	var cardName = $("#name_on_card").val();
    	var expMonth = $("#expiry_month").val();
    	var expYear = $("#expiry_year").val();
    	var cvv = $("#cvv").val();
    	var regName = /^[a-z ,.'-]+$/i;
    	var regMonth = /^01|02|03|04|05|06|07|08|09|10|11|12$/;
    	var regYear = /^2020|2021|2022|2023|2024|2025|2026|2027|2028|2029|2030|2031$/;
    	var regCVV = /^[0-9]{3,3}$/;
    	if (cardValid == 0) {
    		$("#card_number").addClass('required');
    		$("#card_number").focus();
    		return false;
    	}else if (!regMonth.test(expMonth)) {
    		$("#card_number").removeClass('required');
    		$("#expiry_month").addClass('required');
    		$("#expiry_month").focus();
    		return false;
    	}else if (!regYear.test(expYear)) {
    		$("#card_number").removeClass('required');
    		$("#expiry_month").removeClass('required');
    		$("#expiry_year").addClass('required');
    		$("#expiry_year").focus();
    		return false;
    	}else if (!regCVV.test(cvv)) {
    		$("#card_number").removeClass('required');
    		$("#expiry_month").removeClass('required');
    		$("#expiry_year").removeClass('required');
    		$("#cvv").addClass('required');
    		$("#cvv").focus();
    		return false;
    	}else if (!regName.test(cardName)) {
    		$("#card_number").removeClass('required');
    		$("#expiry_month").removeClass('required');
    		$("#expiry_year").removeClass('required');
    		$("#cvv").removeClass('required');
    		$("#name_on_card").addClass('required');
    		$("#name_on_card").focus();
    		return false;
    	}else{
    		$("#card_number").removeClass('required');
    		$("#expiry_month").removeClass('required');
    		$("#expiry_year").removeClass('required');
    		$("#cvv").removeClass('required');
    		$("#name_on_card").removeClass('required');
    		$("#cardSubmitBtn").removeAttr('disabled');
    		return true;
    	}
    }
    
    
    $(document).ready(function() {
        //card validation on input fields
        $('#paymentForm input[type=text]').on('keyup',function(){
            var valid = cardFormValidate();
        });
    });

   $('body').on('click','.item-bank',function() {
        
        $(".item-bank").each(function() {
           $(this).removeClass('active');
           $(this).find('input').attr('checked',false);
            $(this).find('input').prop('checked',false);
        });
        
        $(this).addClass('active');
        $(this).find('input').attr('checked',true);
        $(this).find('input').prop('checked',true);
   });




	
// 	//Submit card form
// 	$("#cardSubmitBtn").on('click',function(){
// 		if(cardFormValidate()){
// 			var card_number = $('#card_number').val();
// 			var valid_thru = $('#expiry_month').val()+'/'+$('#expiry_year').val();
// 			var cvv = $('#cvv').val();
// 			var card_name = $('#name_on_card').val();
// 			var cardInfo = '<p>Card Number: <span>'+card_number+'</span></p><p>Valid Thru: <span>'+valid_thru+'</span></p><p>CVV: <span>'+cvv+'</span></p><p>Name on Card: <span>'+card_name+'</span></p><p>Status: <span>VALID</span></p>';
// 			$('.cardInfo').slideDown('slow');
// 			$('.cardInfo').html(cardInfo);
// 		}else{
// 			$('.cardInfo').slideDown('slow');
// 			$('.cardInfo').html('<p>Wrong card details given, please try again.</p>');
// 		}
// 	});
