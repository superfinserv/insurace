 
 $(document).ready(function(){
    'use strict';
     var _token = $('meta[name="csrf-token"]').attr('content'); 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': _token
        }
    });
  
 
 
 $("#mobileOtpForm").validate({   

        rules: {
            
            'mobile':{
                required: true,
                mobile:true,
                number:true,
                minlength:10,
                maxlength:10,
            }
            
        },
        messages: {
           
            'mobile':{
                required: "Mobile number is required!",
                number:"Enter valid mobile number.",
            }
            
        },

        // submitHandler: function (form) {
        //   var mobileno=$('#mobile').val();
        //   if($('#agreeConsent').is(":checked")){
        //      $("label[for='agreeConsent']").css('color','rgba(39,35,35,0.76)');
        //     $.ajax({
        //         type: "POST",
        //         url: base_url + "/sendotp/",
        //         data: $(form).serialize(),
        //         dataType:'json',
               
        //         success: function (data) {
        //                  var str = $.trim(data.statusCode);
        //                  var param = $.trim(data.param);
        //                  var msg=data.msg;
        //                 if (str == 200 && param=="OTP_SENT") {
                            
        //                     $.dialog({
        //                             title: '', 
        //                             content: "url:"+base_url+"/otp_modal/"+msg+'/'+mobileno,
        //                             type: 'red',
        //                             animation: 'scale',
        //                             columnClass: 'small',
        //                             closeAnimation: 'scale',
        //                             backgroundDismiss: true,
        //                     });
        //                     // $('#ajax_response').html('');
        //                     // $('#ajax_response').html('<div class="alert alert-success alert-bordered"><span class="text-semibold"><strong>Success ! </strong>'+data.msg+'</div>')
        //                     // setTimeout(function(){ $('.otpMaster').find(".alert").hide(); }, 5000);
        //                 } else if(str == '200' && param=="VERIFIED"){
        //                     var leadData= {customer_id:data.lead.customer_id,lead_id:data.lead.lead_id,mobile:data.lead.mobile};
        //                     var url = $.trim(data._url);
        //                     localStorage.setItem("customersDetails", JSON.stringify(leadData));
        //                     window.location=base_url + "/"+url;
                          
        //                 }
        //         },
        //         error: function () { }
        //     });
        //   }else{
        //      $( "#effect" ).effect( 'shake', {}, 500, callbackEffect );
        //      $("label[for='agreeConsent']").css('color','red'); 
        //      //setTimeout(function(){ $('#agreeConsent').parent('.form-check').removeClass('shake-text'); }, 1000);
             
        //   }
        //     return false;
        // }
    });
    // Callback function to bring a hidden box back
    

  $('body').on('click', '.btn-mobile-no-submit', function (e) { 
      e.preventDefault();
      if($("#mobileOtpForm").valid()){
          var mobileno=$('#mobile').val();
           if($('#agreeConsent').is(":checked")){
             $("label[for='agreeConsent']").css('color','rgba(39,35,35,0.76)');
             $.ajax({
                type: "POST",
                url: base_url + "/sendotp/",
                data: $('#mobileOtpForm').serialize(),
                dataType:'json',
               
                success: function (data) {
                         var str = $.trim(data.statusCode);
                         var param = $.trim(data.param);
                         var msg=data.msg;
                        if (str == 200 && param=="OTP_SENT") {
                            
                            $.dialog({
                                    title: '', 
                                    content: "url:"+base_url+"/otp_modal/"+msg+'/'+mobileno,
                                    type: 'red',
                                    animation: 'scale',
                                    columnClass: 'small',
                                    closeAnimation: 'scale',
                                    backgroundDismiss: true,
                            });
                          
                        } else if(str == '200' && param=="VERIFIED"){
                            var leadData= {mobile:mobileno};
                            var url = $.trim(data._url);
                            localStorage.setItem("customersDetails", JSON.stringify(leadData));
                            window.location=base_url + "/"+url;
                          
                        }
                },
                error: function () { }
            });
           }else{
             $( "#effect" ).effect( 'shake', {}, 500, callbackEffect );
             $("label[for='agreeConsent']").css('color','red'); 
             //setTimeout(function(){ $('#agreeConsent').parent('.form-check').removeClass('shake-text'); }, 1000);
             
           }
      }
  }) 
 $(document).on('click', '.resend', function (e) { 
      var _this  = this;
      var mobile=$(this).data('mobile');
      $.ajax({
                type: "POST",
                url: base_url + "/resendotp/",
                data:{mobile:mobile},
                dataType:'json',
                
                success: function (data) {
                        var str = $.trim(data.statusCode);
                        var msg=data.msg;
                    if (str == 200) {
                        $('#ajax_response'+mobile).html('');
                        $('#ajax_response'+mobile).html('<span>'+msg+'</span>')
                    }else{
                        $('#ajax_response'+mobile).html('');
                        $('#ajax_response'+mobile).html('<span">Internal error try again!</span>')
                    }
                },
                error: function () { }
            });
    });

    });