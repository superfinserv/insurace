$(document).ready(function(){
    'use strict';
     var _token = $('meta[name="csrf-token"]').attr('content'); 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': _token
        }
    });
$("#customerLoginForm").validate({   

        rules: {
            
            'mobile':{
                required: true,
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

        submitHandler: function (form) {
           var mobileno=$('#mobile').val();
            $.ajax({
                type: "POST",
                url: base_url + "/sendotp/",
                data: $(form).serialize(),
                dataType:'json',
               
                success: function (data) {
                    console.log(data);
                    
                  if(parseInt(data.statusCode)==200){
                      $.dialog({
                                    title: '', 
                                    content: "url:"+base_url+"/otp_modal/"+data.msg+'/'+mobileno,
                                    type: 'red',
                                    animation: 'scale',
                                    columnClass: 'small',
                                    closeAnimation: 'scale',
                                    backgroundDismiss: true,
                            });
                  }else{
                      toastr.error(data.msg);
                  } 
                },
                error: function () { }
            });
            return false;
        }
    });

/// $(".resend").on('click',function() {
     var mobile=$('#mobile').val();
 $.ajax({
                type: "POST",
                url: base_url + "/sendotp/",
                data:{mobile:mobile},
                dataType:'json',
               
                success: function (data) {
                    console.log(data);
                        var str = $.trim(data.statusCode);
                    if (str == 200) {
                        
                       $("#otp-modal").modal();
                       $('#ajax_response').html('<div class="alert alert-success alert-bordered"><span class="text-semibold"><strong>Warning! </strong>'+data.msg+'</div>')
                    setInterval(function(){ $(".alert").hide(); }, 5000);
                            
                    } else if(str == 'exist'){
                        $('.ajax_response').html('');
                        $('.ajax_response').html('<div class="alert alert-warning alert-bordered"><span class="text-semibold">Opps ! </span> Email Alerady exist !.</div>')
                    }else{
                        $('.ajax_response').html('');
                        $('.ajax_response').html('<div class="alert alert-danger alert-bordered"><span class="text-semibold">Opps Error ! </span>Internal error try again!.</div>')
                    }
                },
                error: function () { }
            });
    });
    
//  $("#customerOtpForm").submit(function(e) {
//      e.preventDefault();
//      var mobile=$('#mobile').val();
//      $.ajax({
//                 type: "POST",
//                 url: base_url + "/verifyotp/",
//                 data: $('#customerOtpForm').serialize(),
//                 dataType:'json',
               
//                 success: function (data) {
//                     console.log(data);
//                         var str = $.trim(data.statusCode);
//                         var email = $.trim(data.email);
//                     if (str == 200) {
//                       $('#ajax_response').html('');
//                       $('#ajax_response').html('<div class="alert alert-success alert-bordered"><span class="text-semibold"><strong>Warning! </strong>'+data.msg+'</div>')
//                       setTimeout(function(){ $(".alert").hide(); }, 5000);
                          
//                                 window.location.href = base_url + "/profile";
                           
                            
//                     } else if(str == '400'){
//                         $('#ajax_response').html('');
//                         $('#ajax_response').html('<div class="alert alert-warning alert-bordered"><span class="text-semibold"><strong>Warning! </strong>'+data.msg+'</div>')
//                     setTimeout(function(){ $(".alert").hide(); }, 5000);
//                     }else{
//                         $('#ajax_response').html('');
//                         $('#ajax_response').html('<div class="alert alert-danger alert-bordered"><span class="text-semibold">'+data.msg+'</div>')
//                      setTimeout(function(){ $(".alert").hide(); }, 5000);
//                     }
//                 },
//                 error: function () { }
//             });
//     });
    
//  function processInput(holder){
//   var elements = holder.children(), //taking the "kids" of the parent
//       str = ""; //unnecesary || added for some future mods
  
//   elements.each(function(e){ //iterates through each element
//     var val = $(this).val().replace(/\D/,""), //taking the value and parsing it. Returns string without changing the value.
//         focused = $(this).is(":focus"), //checks if the current element in the iteration is focused
//         parseGate = false;
    
//     val.length==1?parseGate=false:parseGate=true; 
//       /*a fix that doesn't allow the cursor to jump 
//       to another field even if input was parsed 
//       and nothing was added to the input*/
    
//     $(this).val(val); //applying parsed value.
    
//     if(parseGate&&val.length>1){ //Takes you to another input
//       var exist = elements[e+1]?true:false; //checks if there is input ahead
//       exist&&val[1]?( //if so then
//         elements[e+1].disabled=false,
//         elements[e+1].value=val[1], //sends the last character to the next input
//         elements[e].value=val[0], //clears the last character of this input
//         elements[e+1].focus() //sends the focus to the next input
//       ):void 0;
//     } else if(parseGate&&focused&&val.length==0){ //if the input was REMOVING the character, then
//       var exist = elements[e-1]?true:false; //checks if there is an input before
//       if(exist) elements[e-1].focus(); //sends the focus back to the previous input
//     }
    
//     val==""?str+=" ":str+=val;
//     console.log(val);
//   });
// }

// $("#inputs").on('input', function(){
//     $('#ajax_response'+$('#_mobileNUM').val()).html('');
//      var value = $(this).val();
//     if(value.length > 1)$(this).val(value.slice(0, 1)) ;
//     processInput($(this))
//     if($("input[name=codeBox4]").val()!=""){
//         return false;
//     }
    
    
// }); //still wonder how it worked out. But we are adding input listener to the parent... (omg, jquery is so smart...);

// $("#inputs").on('click', function(e) {   //making so that if human focuses on the wrong input (not first) it will move the focus to a first empty one.
//   var els = $(this).children(),
//       str = "";
//   els.each(function(e){
//     var focus = $(this).is(":focus");
//     var $this = $(this);
//     while($this.prev().val()==""){
//       $this.prev().focus();
//       $this = $this.prev();
//     }
//   })  
//  });
// });
 
 
