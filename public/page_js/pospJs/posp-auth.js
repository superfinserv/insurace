$(document).ready(function(){
    'use strict';
     var _token = $('meta[name="csrf-token"]').attr('content'); 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': _token
        }
    });
    
jQuery.validator.addMethod("fullname", function(value, element) {
  if (/^([a-zA-Z]{2,}\s[a-zA-z]{1,}'?-?[a-zA-Z]{2,}\s?([a-zA-Z]{1,})?)/.test(value)) {
    return true;
  } else {
    return false;
  };
}, 'Please enter your full name.');

 jQuery.validator.addMethod("strongpass", function(value, element) {
            var number = /([0-9])/;
            var alphabets = /([a-zA-Z])/;
            var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
        
            if (value.match(number) && value.match(alphabets) && value.match(special_characters)) { 
                return true;
            }else{
                return false;
            }
            
}, 'Should include alphabets, numbers and special characters');

 jQuery.validator.addMethod("pan_no", function(value, element) {
             var regex = /([A-Z]){3}(P){1}([A-Z]){1}([0-9]){4}([A-Z]){1}$/;
            if (regex.test(value)) {
                return true;
            } else {
                return false;
            }
        }, 'Please Enter valid PAN number');  

$("#RegisterForm").validate({   
        rules: {
           
            'panNo':{
                required: true,
                pan_no:true,
                minlength:10,
                maxlength:10,
                 remote:{               
                    url: base_url+'/isuserexistmobile',
                    type: "post",
                    data:{
                        panNo: function(){
                            return $('#panNo').val();
                        },
                    }
                }
            }
            
        },
        messages: {
           
            'panNo':{
                required: "PAN number is required!",
                remote:"PAN number already exist. Please sign-in",
            }
            
        },

        submitHandler: function (form) {
           var mobileno=$('#mobile').val();
            $.ajax({
                type: "POST",
                url: base_url + "/sendotp",
                data: $(form).serialize(),
                dataType:'json',
                
                success: function (data) {
                      //console.log(data);
                        var str = $.trim(data.status);
                        if($.trim(data.status)=='success'){
                           $("#mobileForm").hide("slide", { direction: "left" }, 1000);
                           $('#ajax_response')._success(data.msg);
                           setTimeout(function(){  
                             $("#otpbased").show("slide", { direction: "right" }, 1000); 
                           }, 1000);
                           $("#pfts").text(mobileno);
                        }else{
                           $('#ajax_response')._error(data.msg);  
                        } 
                    // if(str == 'success') {
                    //   $("#mobileForm").hide("slide", { direction: "left" }, 1000);
                    //     setTimeout(function(){  
                    //         $("#otpbased").show("slide", { direction: "right" }, 1000); 
                    //     }, 1000);
                    //     setTimeout(function(){  
                    //       $('#ajax_response').html('<div class="alert alert-success alert-bordered"><span class="text-semibold"><strong>Success ! </strong>'+data.msg+'</div>')
                    //     }, 1200);
                    //   $("#pfts").text(mobileno);
                    //   setTimeout(function(){ $('#ajax_response').html(''); }, 5000);
                    // }else{
                    //     $("#mobileForm").show();
                    //     $('#otpbased').hide();
                    //     $('#ajax_response').html('<div class="alert alert-warning alert-bordered"><span class="text-semibold">Opps ! </span> '+data.msg+'</div>')
                    // }
                },
                error: function () { }
            });
            return false;
        }
    });
    
$(".resend").on('click',function() {
     var mobile=$('#mobile').val();
       $.ajax({
                type: "POST",
                url: base_url + "/sendotp/",
                data:{mobile:mobile},
                dataType:'json',
                
                success: function (data) {
                    console.log(data);
                     $('#ajax_response').html('');
                        //var str = $.trim(data.status);
                        if($.trim(data.status)=='success'){
                           $("#mobileForm").hide("slide", { direction: "left" }, 1000);
                           $('#ajax_response')._success(data.msg);
                           setTimeout(function(){  
                             $("#otpbased").show("slide", { direction: "right" }, 1000); 
                           }, 1000);
                           $("#pfts").text(mobileno);
                        }else{
                           $('#ajax_response')._error(data.msg);  
                        } 
                    // if (str == 'success') {
                        
                    //   //$("#otp-modal").modal();
                    //   // $('#ajax_response').html('<div class="alert alert-success alert-bordered"><span class="text-semibold"><strong>Warning! </strong>'+data.msg+'</div>')
                    //  $('#ajax_response').html('');
                    //  setTimeout(function(){  
                    //       $('#ajax_response').html('<div class="alert alert-success alert-bordered"><span class="text-semibold"><strong>Success ! </strong>'+data.msg+'</div>')
                    //     }, 1200);
                    //   setTimeout(function(){ $('#ajax_response').html(''); }, 5000);
                            
                    // } else if(str == 'exist'){
                    //     $('.ajax_response').html('');
                    //     $('.ajax_response').html('<div class="alert alert-warning alert-bordered"><span class="text-semibold">Opps ! </span> Email Alerady exist !.</div>')
                    // }else{
                    //     $('.ajax_response').html('');
                    //     $('.ajax_response').html('<div class="alert alert-danger alert-bordered"><span class="text-semibold">Opps Error ! </span>Internal error try again!.</div>')
                    // }
                },
                error: function () { }
            });
    });
    
$("#verifyotp").submit(function(e) {
     e.preventDefault();
     
       var mobile=$('#mobile').val();
        $.ajax({
                type: "POST",
                url: base_url + "/verifyotp",
                data: $('#verifyotp').serialize()+"&mobile="+mobile,
                dataType:'json',
                success: function (data) {
                    $('#ajax_response').html('');
                    var str = $.trim(data.status);
                    if (str == "success"){
                       $('#ajax_response').html('<div class="alert alert-success alert-bordered"><span class="text-semibold"><strong>Success! </strong>'+data.msg+'</div>')
                           $("#otpbased").hide("slide", { direction: "left" }, 1000);
                           setTimeout(function(){ $("#information").show("slide", { direction: "right" }, 1000);}, 1000);
                            $('#mobiles').val(mobile);
                            setTimeout(function(){ $(".alert").hide(); }, 5000);
                    } else{
                        $('#ajax_response').html('<div class="alert alert-danger alert-bordered"><strong>Error! </strong><span class="text-semibold">'+data.msg+'</div>')
                        setTimeout(function(){ $(".alert").hide(); }, 5000);
                    }
                },
                error: function () { }
            });
    });
 
$("#agentDetails").validate({   

        rules: {
            'mobile':{
                required: true,
                number:true,
                minlength:10,
                maxlength:10,
            },
            'name':{
                required: true,
                fullname: true
            },
            'stateID':{
                required: true,
            },
             'city':{
                required: true,
            },
            'email':{
                required: true,
                email:true,
                remote:{               
                    url: base_url+'/isuserexist',
                    type: "post",
                    data:{
                        email: function(){
                            return $('#email').val();
                        },
                    }
                }
            },
            'password': {
                required: true,
                minlength: 6,
                strongpass:true
            },
            'conform_password': {
                equalTo: '#password'
            },
             'pincode':{
                required: true,
                number:true,
            }
        },
        messages: {
           
            'name':{
                required: "Name is required!",
               custom_fullname : "Your Name should be entered like: fullname lastname  (or) fullname-lastname"
            },
            'city':{
                required: "City is required!",
              
            },
             'stateID':{
                required: "state is required!",
              
            },
            'email': {
                required: "Email is required.",
                email:"Enter valid email.",
                remote:"Email alredy exist."
            },
            
            'pincode':{
                required: "Pincode is required!",
                number:"Enter valid Pincode number.",
            },
            'password': {
                required: " password field is mandatory!",
                minlength: "Please enter  at least 5 characters!",
                
        
            },

            'conform_password': {

                equalTo: "Passwords don't match!"

            },

            'mobile':{
                required: "Mobile number is required!",
                number:"Enter valid mobile number.",
            }
        },
        errorPlacement: function(error, element) {
                            if(element.attr("name") == "city"){
                                error.appendTo('#errorCity');
                                return;
                            }

                            if(element.attr("name") == "stateID"){
                                    error.appendTo('#errorState');
                                    return;
                            }
                            if(element.attr("name") == "age"){
                                    error.appendTo('#errorss');
                                    return;
                            }else {
                                error.insertAfter(element);
                            }
                       },

        submitHandler: function (form) {
           
            $.confirm({
                            title: 'Terms & Conditions',
                            content: '<span style="color:#0E3679">By submitting your contact number and email ID, you authorize <b>Super Finserv Private Limited </b> to call, send SMS, messages over internet-based messaging application like WhatsApp and email and offer you information and services for the product(s) you have opted for as well as other products/services offered by <b>Super Finserv Private Limited </b> <br>'+
                                      'Please note that such authorization will be over and above any registration of the contact number on TRAI’s NDNC registry.</span>',
                            icon: 'fa fa-info-circle',
                            animation: 'scale',
                            closeAnimation: 'scale',
                            backgroundDismiss: false,
                            opacity: 0.5,
                            buttons: {
                                'confirm': {
                                    text: 'I Agree',
                                    btnClass: 'btn-red btn-agree',
                                    action: function(){
                                        //console.log('Agredd');
                                        $('#agentDetails').find('button').attr('disabled',true);
                                        $('#agentDetails').find('button').prop('disabled',true);
                                        $('#agentDetails').find('button').html('Submitting....');
                                        $.ajax({
                                                type: "POST",
                                                url: base_url + "/become-agent/agentDetails/",
                                                data: $('#agentDetails').serialize(),
                                                dataType:'json',
                                                success: function (data) {
                                                    $('.ajax_response').html('');
                                                    var str = $.trim(data.status);
                                                    if (str == 'success') {
                                                        window.location.href = base_url + "/profile";
                                                    }else{
                                                        $('#agentDetails').find('button').attr('disabled',false);
                                                        $('#agentDetails').find('button').prop('disabled',false);
                                                        $('#agentDetails').find('button').html('Get Started');
                                                        $('.ajax_response').html('<div class="alert alert-danger alert-bordered"><span class="text-semibold">Opps Error ! </span>'+data.msg+'.</div>')
                                                    }
                                                },
                                                error: function () { 
                                                        $('#agentDetails').find('button').attr('disabled',false);
                                                        $('#agentDetails').find('button').prop('disabled',false);
                                                        $('#agentDetails').find('button').html('Get Started');
                                                }
                                            });
                                    }
                                },
                                cancel: function(){
                                   // $.alert("we can't procced without aggree eith terms and conditions.");
                                },
                                
                            }
                        });      
            return false;
        }
    });

$("#loginDetails").validate({   

        rules: {
            'mobile':{
                required: true,
                number:true,
                minlength:10,
                maxlength:10,
            },
            
            'password': {
                required: true,
                minlength: 5,
            }
        },
        messages: {
           
            
            'password': {
                required: " password field is mandatory!",
                minlength: "Please enter  at least 5 characters!",
        
            },

            'mobile':{
                required: "Mobile number is required!",
                number:"Enter valid mobile number.",
            }
        },
       

             submitHandler: function (form) {
              $.ajax({
                type: "POST",
                url: base_url + "/auth-agent/",
                data: $(form).serialize(),
                dataType:'json',
               
                success: function (data) {
                    console.log(data);
                        var str = $.trim(data.statusCode);
                    if (str == 200) {
                        window.location.href = base_url + "/profile";
                    } else if(str == 400){
                        setInterval(function(){ $(".alert").hide(); }, 5000);
                        $(".abc").show();
                        $('#otpbased').hide();
                        $('.ajax_responsea').html('');
                        $('.ajax_responsea').html('<div class="alert alert-danger alert-bordered"><span class="text-semibold">Opps ! </span> '+data.msg+'!.</div>')
                    }else{
                        setInterval(function(){ $(".alert").hide(); }, 5000);
                        $(".abc").show();
                        $('#otpbased').hide();
                        $('.ajax_responsea').html('');
                        $('.ajax_responsea').html('<div class="alert alert-danger alert-bordered"><span class="text-semibold">Opps ! </span> '+data.msg+'!.</div>')
                    }
                },
                error: function () { }
            });
            return false;
        }
    });

$("#ForgotForm").validate({   
        rules: {
            'mobile':{
                required: true,
                number:true, minlength:10, maxlength:10,
                 remote:{               
                    url: base_url+'/isuserexistmobilecheck',
                    type: "post",
                    data:{
                        mobile: function(){
                            return $('#mobile').val();
                        },
                    }
                }
            }
            
        },
        messages: {
            'mobile':{
                required: "Mobile number is required!",
                number:"Enter valid mobile number.",
                remote:"This mobile no not exist. Please enter currect mobile no!",
            }
            
        },
        submitHandler: function (form) {
              $.ajax({
                type: "POST",
                url: base_url + "/password-reset-email/",
                data: $(form).serialize(),
                dataType:'json',
                
                success: function (data) {
                    console.log(data);
                        var str = $.trim(data.statusCode);
                    if (str == 200) {
                       setInterval(function(){ $(".alert").hide(); }, 5000);
                        $(".abc").show();
                        $('#otpbased').hide();
                        $('.ajax_responsea').html('');
                        $('#mobile').val('');
                         $('.ajax_responsea').html('<div class="alert alert-success alert-bordered"><span class="text-semibold">Password reset mail sent successfully </span></div>')
                    } else if(str == 400){
                        setInterval(function(){ $(".alert").hide(); }, 5000);
                        $(".abc").show();
                        $('#otpbased').hide();
                        $('.ajax_responsea').html('');
                         $('.ajax_responsea').html('<div class="alert alert-success alert-bordered"><span class="text-semibold">Password reset mail sent successfully </span></div>')
                    }else{
                        setInterval(function(){ $(".alert").hide(); }, 5000);
                        $(".abc").show();
                        $('#otpbased').hide();
                        $('.ajax_responsea').html('');
                        $('.ajax_responsea').html('<div class="alert alert-danger alert-bordered"><span class="text-semibold">Opps ! </span> '+data.msg+'!.</div>')
                    }
                },
                error: function () { }
            });
            return false;
        }
    });
    
$("#resetpasswordForm").validate({   
        rules: {
            'password': {
                required: true,
                minlength: 6,
            },
            'confirm_password': {
                equalTo: '#password'
            },
             
        },
        messages: {
            'password': {
                required: " password field is mandatory!",
                minlength: "Please enter  at least 6 characters!",
            },
            'confirm_password': {
                equalTo: "Passwords don't match!"
            }
        },
        submitHandler: function (form) {
              $.ajax({
                type: "POST",
                url: base_url + "/reset-password/",
                data: $(form).serialize(),
                dataType:'json',
                success: function (data) {
                      var str = $.trim(data.status);
                    if (str == 'success') {
                         $('.ajax_responsea').html('');
                         $('.ajax_responsea').html('<div class="alert alert-success alert-bordered"><span class="text-semibold">Success! </span>'+data.message+'</div>')
                         setTimeout(function(){  $('.ajax_responsea').html(''); window.location.href=base_url+'/sign-in'; }, 4000);
                    }else{
                        $('.ajax_responsea').html('');
                        $('.ajax_responsea').html('<div class="alert alert-danger alert-bordered"><span class="text-semibold">Opps Error ! </span>'+data.message+'</div>')
                        setTimeout(function(){  $('.ajax_responsea').html(''); }, 4000);
                    }
                },
                error: function () { 
                    $('.ajax_responsea').html('');
                    $('.ajax_responsea').html('<div class="alert alert-danger alert-bordered"><span class="text-semibold">Opps Error ! </span>Internal error try again!.</div>')
                    setTimeout(function(){  $('.ajax_responsea').html(''); }, 4000);
                }
            });
            return false;
        }
    });



}); 


//  $(document).ready(function($){
//     $('#state_id').change(function(){
//      var option= $(this).val()
//         $.get(base_url+"/dropdown/"+option, 
        
//         function(data) {
            
//             $('#city').empty();
//             $('#city').append("<option value=''>Select City</option>");
//             $.each(data, function(key, element) {
//                  localData = JSON.parse(localStorage.getItem('customersDetails'));
//                 var city =localData.city;
//                 if( city==element.id){
//                     $('#city').append("<option value='" + element.id +"' selected>" + element.name + "</option>");
//                 }else{
//                 $('#city').append("<option value='" + element.id +"'>" + element.name + "</option>");
//             }
                
//             });
//         });
       
//         $('#city').val(city).prop('selected', true);
//     });
// });


$('body').on('change','#stateID',function(e){
    var stateID = $(this).val();
    $.get(base_url+"/get-cities/"+stateID,  function(result) {
        var newdata =result.data;
        $('#city').empty().trigger("change");
        var newState1 = new Option("Select city", "", true, true);
          $("#city").append(newState1); 
          
          jQuery.each(newdata, function (index, item) {
              console.log("item",item);
            var newState = new Option(item['value'], item['id'], true, true);
            $("#city").append(newState);//.trigger('change');
          });
        $('#city').val('').trigger("change");
    },'json');
})





function getCodeBoxElement(index) {
        return document.getElementById('codeBox' + index);
      }
      function onKeyUpEvent(index, event) {
        const eventCode = event.which || event.keyCode;
        if (getCodeBoxElement(index).value.length === 1) {
          if (index !== 4) {
            getCodeBoxElement(index+ 1).focus();
          } else {
            getCodeBoxElement(index).blur();
            // Submit code
            console.log('submit code ');
          }
        }
        if (eventCode === 8 && index !== 1) {
          getCodeBoxElement(index - 1).focus();
        }
      }
      function onFocusEvent(index) {
        for (item = 1; item < index; item++) {
          const currentElement = getCodeBoxElement(item);
          if (!currentElement.value) {
              currentElement.focus();
              break;
          }
        }
      }
