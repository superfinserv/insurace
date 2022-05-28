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

$("#personalinfo").validate({   

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
             'city':{
                required: true,
               
            },
             'state':{
                required: true,
               
            },
            'address':{
                required: true,
               
            },
            'sex':{
                required: true,
               
            },
            'marital_status':{
                required: true,
               
            },
            'email':{
                required: true,

                email:true,
                
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
             'state':{
                required: "state is required!",
              
            },
            'address':{
                required: "Address is required!",
              
            },
            'sex':{
                required: "Gender is required!",
              
            },
            'marital_status':{
                required: "Marital Status is required!",
              
            },
            'email': {
                required: "Email is required.",
                email:"Enter valid email.",
            },
            
            'pincode':{
                required: "Pincode is required!",
                number:"Enter valid Pincode number.",
            },
            'mobile':{
                required: "Mobile number is required!",
                number:"Enter valid mobile number.",
            }
        },
        errorPlacement: function(error, element) {
                            if(element.attr("name") == "city"){
                                error.appendTo('#error');
                                return;
                            }

                            if(element.attr("name") == "state"){
                                    error.appendTo('#errors');
                                    return;
                            }
                             if(element.attr("name") == "sex"){
                                    error.appendTo('#errorsss');
                                    return;
                            }
                            if(element.attr("name") == "marital_status"){
                                    error.appendTo('#errorss');
                                    return;
                            }else {
                                error.insertAfter(element);
                            }
                       },

             submitHandler: function (form) {
              $.ajax({
                type: "POST",
                url: base_url + "/user/personalinfo/",
                data: $(form).serialize(),
                dataType:'json',
                
                success: function (data) {
                    console.log(data);
                        var str = $.trim(data.statusCode);
                    if (str == 200) {
                       $.notify({
                            type: 'success', 
                            message:'<strong>Success</strong> Your Details has been saved!'
                        });
                    } else if(str == 'exist'){
                        $(".abc").show();
                        $('#otpbased').hide();
                        $('.ajax_responsea').html('');
                        $('.ajax_responsea').html('<div class="alert alert-warning alert-bordered"><span class="text-semibold">Opps ! </span> Email Alerady exist !.</div>')
                    }else{
                         $(".abc").show();
                         $('#otpbased').hide();
                        $('.ajax_responsea').html('');
                        $('.ajax_responsea').html('<div class="alert alert-danger alert-bordered"><span class="text-semibold">Opps Error ! </span>Internal error try again!.</div>')
                    }
                },
                error: function () { }
            });
            return false;
        }
    });
    
    $('body').on('click','.getPolicyPdf',function(e){
         var _this = $(this);
         var loader = '<span class="inline-loader"><span class="inline-loader-box"></span><span class="inline-loader-box"></span><span class="inline-loader-box"></span></span>';
         var clone = $(this).clone();
         _this.html(loader);
         var policyid = $(this).attr('data-id');
         //_this.find('div').find('.fa').removeClass('fa-globe').addClass('fa-spinner fa-spin');
         
          $.post(base_url+"/get-policy-document",{id:policyid,opt:""},function(result){
              var st = $.trim(result.status);
              if(st=="success"){
                 _this.html('Download')
                 _this.attr('href',result.data.path);
                  _this.removeAttr("data-id");
                  //notification('success',result.message); 
                }else{
                  _this.html('Get Pdf')
                 //_this.find('div').find('.fa').removeClass('fa-spinner fa-spin').addClass('fa-globe');
                 // notification('error',result.message); 
                }
          },'json')
    });
    
    
    
 });
  $(document).ready(function() {
      var table = $('#myBusinessTable').DataTable({ordering:false});
//     var table = $('#myBusinessTable').DataTable( {
//         scrollY:        "50vh",
//         scrollX:        true,
//         scrollCollapse: true,
//         paging:         false,
//         ordering:false,
//         fixedColumns:   {
//             left: 1,
//             right: 1
//         }
  //  } );
} );