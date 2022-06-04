$(document).ready(function(){
    'use strict';
     var _token = $('meta[name="csrf-token"]').attr('content'); 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': _token
        }
    });
    
    $("#formClaimAssistance").validate({   

        rules: {
            
            'insuranceType':{
                required: true,
            },
            'PolicyNumber':{
                required:true
            },
            'name':{
                required:true
            },
            'MobileNumber':{
                 required:true,
                 number:true
            },
            'email':{
                 required:true,
                 email:true
            },
            'comment':{
                 required:true
            }
            
        },
        messages: {
           
            'insuranceType':{
                required: "Insurance type is required!",
             },
            'PolicyNumber':{
                required: "Policy Number is required!",
            },
            'name':{
               required: "Your Name is required!", 
            },
            'MobileNumber':{
                 required:"Mobile Number is required.",
                 number:"Enter valid mobile number."
            },
            'email':{
                 required:"Email is required.",
                 email:"Enter valid email address."
            },
            'comment':{
                 required:"Description is required."
            }
            
        },
        highlight: function(element) {
           $(element).css('margin-bottom','0px');
        },
        unhighlight: function(element) {
           $(element).css('margin-bottom','10px');
        },
        errorPlacement: function(error, element) {
            if(element.attr("name") == "insuranceType"){ 
               error.insertAfter(element.next('.select2-container'));
             }else{ 
                error.insertAfter(element); 
             }  
        },
        submitHandler: function (form) {
            $('#formClaimAssistance').find('button').loadButton('on',{
                faClass:'fa',
                faIcon:'fa-spinner',
                doSpin:true,
                loadingText:'Submitting...',
              });
            $.ajax({
                type: "POST",
                url: base_url + "/request-my-claim/",
                data: $(form).serialize(),
                dataType:'json',
               
                success: function (result) {
                     //console.log(data);
                     if($.trim(result.status)=='success'){
                        toastr.success(result.message, 'Success'); 
                        $('#formClaimAssistance')[0].reset();
                        $('#formClaimAssistance').find('button').loadButton('off');
                     }else{
                       $('#formClaimAssistance').find('button').loadButton('off');
                        toastr.error(result.message, 'Error');
                     }
                },
                error: function () {
                    $('#formClaimAssistance').find('button').loadButton('off');
                     toastr.error('Something went wrong', 'Error');}
            });
            return false;
        }
    });
    
    
})