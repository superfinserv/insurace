$(document).ready(function(){
    'use strict';
     var _token = $('meta[name="csrf-token"]').attr('content'); 
     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': _token
        }
    });
    
     $('.profile-input').on('change',function(e){
        e.preventDefault();
        var _this = $(this);
        var _typ = "text";
        if (_this.is("input")) { _typ = $(this).attr('type'); } 
        else if (_this.is("select")) { _typ="select";} 
        else if (_this.is("textarea")) {_typ="textarea";}
        var val = $(this).val();
       
        if ($(this).valid() === true ) {
            if(_typ=="text" || _typ=="textarea" || _typ=="select"){
                
                $(this).parent().addClass('has-feedback');
               
                if(!$(this).parent().find('label').length){
                     $(this).parent().find(_this).after('<span style=" top:0px;" class="form-control-feedback fa fa-circle-o-notch fa-spin">');
                }else{
                     $(this).parent().find(_this).after('<span class="form-control-feedback fa fa-circle-o-notch fa-spin">');
                }
                
           }else{
            // $(this).parent().find('label').addClass('spinner');
           }
            var name = $(this).attr('name');
            var refClass = $(this).attr('data-refClass');//personal-section
            
            $.post(base_url+'/update-posp-info/',{name:name,ref:refClass,val:val,_typ:_typ},function(resp){
                    alertconfig(resp.data.iscomplete,"profile");
                    if(resp.data.ispersonal==1){
                        $('.'+refClass).html("").html('<span>Done</span>');  
                    }else{
                        $('.'+refClass).html("").html('<span class="required">Required</span>'); 
                  }
                 _this.parent().removeClass('has-feedback');
                 _this.parent().find('span.form-control-feedback').remove();
                  if($.trim(resp.status)=='success'){
                     
                  }else{
                     $.toast({heading: 'Error',text: resp.message,
                              showHideTransition: 'slide',icon: 'error',
                              loaderBg: '#f96868', position: 'top-right'
                            }) 
                  }
            })
        }
     });
     
     $('body').on('click','.profile-input-upload',function(e){
                var formID = $(this).attr('data-form');
                var pElm = $(this).attr('data-elem');
                var name = $(this).attr('data-name');
                var _this = $(this);
                //var formv = $('#'+formID)[0];
                var refClass = $(this).attr('data-refClass');//personal-section
               // var formData = new FormData(formv);
                var formData = new FormData();
                //formData.append("name", input.files[0]);
               formData.append(name, $('#'+name)[0].files[0]);
                console.log(name);
                formData.append("_typ", 'file');
                  $.ajax({
                    type: "POST",
                    url: base_url + "/update-posp-info/",
                     mimeType: "multipart/form-data",
                     cache: false,
                     contentType: false,
                     processData: false,
                     data: formData,
                     dataType:'json',
                     success: function (resp) {
                         var str = $.trim(resp.status);
                         if(resp.data.iseducation==1){
                             $('.'+refClass).html("").html('<span>Done</span>');  
                            }else{
                              $('.'+refClass).html("").html('<span class="required">Required</span>'); 
                          }
                            alertconfig(resp.data.iscomplete,"profile");
                         if(str == "success") {
                             if(resp.name!=""){
                                 $("#"+pElm).find('input').val(resp.name);
                                 $("#"+pElm).show();
                                 $('#not-'+pElm).hide();
                             }
                             
                               
                          }else{
                             $.toast({heading: 'Error',text: resp.message,
                              showHideTransition: 'slide',icon: 'error',
                              loaderBg: '#f96868', position: 'top-right'
                            }) 
                            
                        }
                        
                        
    
                    },
                    error: function () { }
                });
     })
    
    jQuery.validator.addMethod("fullname", function(value, element) {
      if (/^([a-zA-Z]{2,}\s[a-zA-z]{1,}'?-?[a-zA-Z]{2,}\s?([a-zA-Z]{1,})?)/.test(value)) {
        return true;
      } else {
        return false;
      };
    }, 'Please enter your full name.');
     
    $.validator.addMethod("pan", function(value1, element1) {
        var pan_value = value1.toUpperCase();
        var reg = /^[a-zA-Z]{3}[PCHFATBLJG]{1}[a-zA-Z]{1}[0-9]{4}[a-zA-Z]{1}$/;
        var pan = {
          C: "Company",
          P: "Personal",
          H: "Hindu Undivided Family (HUF)",
          F: "Firm",
          A: "Association of Persons (AOP)",
          T: "AOP (Trust)",
          B: "Body of Individuals       (BOI)",
          L: "Local Authority",
          J: "Artificial Juridical Person",
          G: "Govt"
        };
        pan = pan[pan_value[3]];
        if (this.optional(element1)) { return true;}
        if (pan_value.match(reg)) { return true;}
        else { return false;  }
      }, "Please specify a valid PAN Number");
    
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
                    required: true
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
                    fullname : "Your Name should be entered like: fullname lastname  (or) fullname-lastname"
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
                   $('.is-visible').loading({
                       message: 'Updating presonal information...'
                   });
                   $("#profile-update-btn").loadButton('on', {
                        faClass:'fa',faIcon:'fa-cog',doSpin:true,
                        loadingText: 'Updating Inforamtion...',
                        loadingBackground: 'darkred !important',
                        loadingForeground: 'white'
                      });
                  $.ajax({
                    type: "POST",
                    url: base_url + "/personalinfo/",
                    data: $(form).serialize(),
                    dataType:'json',
                    success: function (data) {
                        var str = $.trim(data.status);
                         $('.is-visible').loading('stop');
                         
                         alertconfig(data.data.iscomplete,"profile");
                         if(data.data.ispersonal==1){
                             $('.personal-section').html("").html('<span>Done</span>');  
                            }else{
                              $('.personal-section').html("").html('<span class="required">Required</span>'); 
                           }
                        if (str == "success") {  
                                $("#profile-update-btn").loadButton('off');
                                 $('.tab-nav .active .ribbon span').removeClass('required');
                                  $('.tab-nav .active .ribbon span').text('Done');
                                 $.toast({
                                      heading: 'Success',
                                      text: "<strong>Success</strong> Your Details has been saved!",
                                      showHideTransition: 'slide',
                                      icon: 'success',
                                      loaderBg: '#f96868',
                                      position: 'top-right'
                                    })
                        } else{
                            $("#profile-update-btn").loadButton('off');
                            $.toast({
                               heading: 'Error',
                                  text: "<p> "+data.msg+"</p>",
                                  showHideTransition: 'slide',
                                  icon: 'error',
                                  loaderBg: '#f96868',
                                  position: 'top-right'
    
                                })
                        }
                      
                    },
                    error: function () { }
                });
                return false;
            }
    
        });
    
    $("#educationinfo").validate({   
            rules: {
                'educational_qualification':{
                    required: true,
                },
                  'education_certificate':{
                    required: true,
                },
            },
            messages: {
                'educational_qualification':{
                    required: "Education Qualification is required!",
                },
    
                'education_certificate':{
                    required: "education certificate is required!",
                }
            },
    
            errorPlacement: function(error, element) {
                                if(element.attr("name") == "educational_qualification"){
                                    error.appendTo('#educational_qualification_error');
                                    return;
                                }
                           },
    
            submitHandler: function (form) {
                 var formv = $('#educationinfo')[0];
                 var formData = new FormData(formv);
                 $('.is-visible').loading();
                  $.ajax({
                    type: "POST",
                    url: base_url + "/educationinfo/",
                     mimeType: "multipart/form-data",
                     cache: false,
                     contentType: false,
                     processData: false,
                     data: formData,
                     dataType:'json',
                     success: function (resp) {
                         var str = $.trim(resp.status);
                         if(resp.data.iseducation==1){
                             $('.education-section').html("").html('<span>Done</span>');  
                            }else{
                              $('.education-section').html("").html('<span class="required">Required</span>'); 
                           }
                            alertconfig(resp.data.iscomplete,"profile");
                         if(str == "success") {
                             if(resp.name!="" && resp.data.iseducation==1){
                                 $("#hasEdu-element").find('input').val(resp.name);
                                 $("#hasEdu-element").show();
                                 $('#not-hasEdu-element').hide();
                             }
                                $.toast({
                                      heading: 'Success',
                                      text: resp.msg,
                                      showHideTransition: 'slide',
                                      icon: 'success',
                                      loaderBg: '#f96868',
                                      position: 'top-right'
                                });;
                        } else{
                            $('.is-visible').loading('stop');
                            $.toast({
                                  heading: 'Error',
                                  text: resp.msg,
                                  showHideTransition: 'slide',
                                  icon: 'error',
                                  loaderBg: '#f96868',
                                  position: 'top-right'
                            })
                        }
                        
                        $('.is-visible').loading('stop');  
    
                    },
                    error: function () { $('.is-visible').loading('stop'); }
                });
    
                return false;
    
            }
    
        });
    
    $("#bankinfo").validate({   
            rules: {
                'account_number':{
                    required: true,
                     number:true,
                     minlength:10,
                     maxlength:16,
                     remote:{               
                        url: base_url+'/posp/is-posp-exist/acnumber',
                        type: "post",
                        data:{
                            term: function(){ return $('#account_number').val();},
                        }
                    }
                },
                'account_number_confirm':{
                    equalTo:"#account_number"
                },
                'bank_name':{
                    required: true,
                },
    
                'account_holder_name':{
                    required: true,
                },
    
                'ifsc_code':{
                    required: true,
                    ifsc:true
                },
    
                'passbook_statement':{
                    required: true,
                },
            },
    
            messages: {
                'account_number':{
                    required: "Account number is required!",
                     minlength:"Enter valid account number",
                     maxlength:"Enter valid account number",
                     remote:'A/C number already exist.'
                },
                'account_number_confirm':{
                    equalTo:"Account number mismatch!"
                },
                'bank_name':{
                    required: "Bank name is required!",
                },
                'account_holder_name':{
                    required: "Account holder name is required!",
                },
    
                'ifsc_code':{
                    required: "IFSC code is required!",
                    ifsc:"Enter valid IFSC code"
                },
    
                'passbook_statement':{
                    required: "bank statement is required!",
                },
            },
             errorPlacement: function(error, element) {
                    if(element.attr("name") == "bank_name"){
                        error.appendTo('#bank-error');
                        return;
                    }else {
                        error.insertAfter(element);
                     }
              },
    
            submitHandler: function (form) {
                var formv = $('#bankinfo')[0];
                var formData = new FormData(formv);
                $('.is-visible').loading({message:"Updating Bank Information"});
    
                $.ajax({
                    type: "POST",
                    url: base_url + "/bankinfo/",
                    data: formData,
                    mimeType: "multipart/form-data",
                     cache: false,
                    contentType: false,
                    processData: false,
                    dataType:'json',
                    success: function (resp) {
                        var str = $.trim(resp.status);
                        if(resp.data.isbank==1){
                             $('.bank-section').html("").html('<span>Done</span>');  
                            }else{
                              $('.bank-section').html("").html('<span class="required">Required</span>'); 
                           }
                            alertconfig(resp.data.iscomplete,"profile");
                         if(str == "success") {
                             if(resp.name!="" && resp.data.isbank==1){
                                 $("#hasPassbook-element").find('input').val(resp.name);
                                 $("#hasPassbook-element").show();
                                 $('#not-hasPassbook-element').hide();
                             }
                                 $.toast({
                                      heading: 'Success',
                                      text: resp.msg,
                                      showHideTransition: 'slide',
                                      icon: 'success',
                                      loaderBg: '#f96868',
                                      position: 'top-right'
                                  })
                        } else{
                            $.toast({
                              heading: 'Error',
                              text: resp.msg,
                              showHideTransition: 'slide',
                              icon: 'error',
                              loaderBg: '#f96868',
                              position: 'top-right'
                            })
                        }
                         $('.is-visible').loading('stop');
                       
                    },
                    error: function () {  $('.is-visible').loading('stop'); }
    
                });
                return false;
            }
        });
    
    $("#documentinfo").validate({   
            rules: {
                'pan_card':{
                    required: true,
                },
    
                'pan_card_number':{
                    required: true,
                    pan: true,
                    remote:{               
                        url: base_url+'/posp/is-posp-exist/pancard',
                        type: "post",
                        data:{
                            term: function(){ return $('#pan_card_number').val();},
                        }
                    }
                },
    
                 'adhaar_card_number':{
                    required: true,
                     minlength:12,
                     maxlength:12,
                    remote:{               
                        url: base_url+'/posp/is-posp-exist/aadhar',
                        type: "post",
                        data:{
                            term: function(){ return $('#adhaar_card_number').val();},
                        }
                    }
                },
    
                'adhaar_card':{
                    required: true, 
                },
    
                 'adhaar_card_back':{
                    required: true, 
                },
                 'profile':{
                    required: true,
                }
            },
    
            messages: {
                'pan_card_number':{
                    required: "pan card number is required!",
                     remote:"Pan Number already exist."
                },
                'pan_card':{
                    required: "pan card is required!",
                   
                },
                 'adhaar_card_number':{
                    required: "Adhaar card number is required!",
                    remote : "Aadhar number already exist."
                },
                'adhaar_card': {
                    required: " Adhaar card is required.",
                },
                'adhaar_card_back': {
                    required: " Adhaar card back is required.",
                },
            },
           submitHandler: function (form) {
                    $('.is-visible').loading({message:"Updating required document"});
                     var formv = $('#documentinfo')[0];
                     var formData = new FormData(formv);
                    $.ajax({
                        type: "POST",
                        url: base_url + "/documentinfo/",
                        data: formData,
                        dataType:'json',
                        cache: false,
                        contentType: false,
                        processData: false,
                       
                       success: function (resp) {
                        var str = $.trim(resp.status);
                        
                        if(resp.data.isdocument==1){
                              $('.document-section').html("").html('<span>Done</span>');  
                            }else{
                              $('.document-section').html("").html('<span class="required">Required</span>'); 
                           }
                            alertconfig(resp.data.iscomplete,"profile");
                         if(str == "success") {
                             if(resp.pan!="" && resp.pan!=null){
                                 $("#hasPan-element").find('input').val(resp.pan);
                                 $("#hasPan-element").show();
                                 $('#not-hasPan-element').hide();
                             }
                             if(resp.aadhar!="" && resp.aadhar!=null){
                                 $("#hasAadhar-element").find('input').val(resp.aadhar);
                                 $("#hasAadhar-element").show();
                                 $('#not-hasAadhar-element').hide();
                             }
                             if(resp.aadharback!="" && resp.aadharback!=null){
                                 $("#hasAaharBack-element").find('input').val(resp.aadharback);
                                 $("#hasAaharBack-element").show();
                                 $('#not-hasAaharBack-element').hide();
                             }
                                 $.toast({
                                      heading: 'Success',
                                      text: resp.msg,
                                      showHideTransition: 'slide',
                                      icon: 'success',
                                      loaderBg: '#f96868',
                                      position: 'top-right'
                                  })
                        } else{
                            $.toast({
                              heading: 'Error',
                              text: resp.msg,
                              showHideTransition: 'slide',
                              icon: 'error',
                              loaderBg: '#f96868',
                              position: 'top-right'
                            })
                        }
                         $('.is-visible').loading('stop');
                       
                    },
                    error: function () {  $('.is-visible').loading('stop'); }
    
                });
    
                return false;
    
            }
    
        });
    
    $("#businessinfo").validate({   
                 rules: {
                   agency_health:{
                      required: function (element) {
                         if($("input[name=is_agency_health]").is(':checked')){
    
                             var e = document.getElementById("agency_health");
    
                             return e.options[e.selectedIndex].value=="" ;                            
    
                         }
    
                         else
    
                         {
    
                             return false;
    
                         }  
    
                      }  
    
                   },
    
                   agency_life:{
    
                      required: function (element) {
    
                         if($("input[name=is_agency_life]").is(':checked')){
    
                             var e = document.getElementById("agency_life");
    
                             return e.options[e.selectedIndex].value=="" ;                            
    
                         }
    
                         else
    
                         {
    
                             return false;
    
                         }  
    
                      }  
    
                   },
    
                   agency_gerenal:{
    
                      required: function (element) {
    
                         if($("input[name=is_agency_gerenal]").is(':checked')){
    
                             var e = document.getElementById("agency_gerenal");
    
                             return e.options[e.selectedIndex].value=="" ;                            
    
                         }
    
                         else
    
                         {
    
                             return false;
    
                         }  
    
                      }  
    
                   },
    
                   surveyor:{
    
                      required: function (element) {
    
                         if($("input[name=is_surveyor]").is(':checked')){
    
                             var e = document.getElementById("surveyor");
    
                             return e.options[e.selectedIndex].value=="" ;                            
    
                         }
    
                         else
    
                         {
    
                             return false;
    
                         }  
    
                      }  
    
                   },
    
                   pos_life:{
    
                      required: function (element) {
    
                         if($("input[name=is_pos_life]").is(':checked')){
    
                            
    
                             return document.getElementById("pos_life").value=="" ;                            
    
                         }
    
                         else
    
                         {
    
                             return false;
    
                         }  
    
                      }  
    
                   },
    
                   pos_gerenal:{
    
                      required: function (element) {
    
                         if($("input[name=is_pos_gerenal]").is(':checked')){
    
                            
    
                             return document.getElementById("pos_gerenal").value=="" ;                            
    
                         }
    
                         else
    
                         {
    
                             return false;
    
                         }  
    
                      }  
    
                   },
    
                  
    
                'experience':{
    
                    required: true,
    
                   
    
                },
    
                'income':{
    
                    required: true,
    
    
    
                },
    
                 'experience':{
    
                    required: true,
    
                   
    
                },
    
                
    
                 
    
            },
    
            messages: {
    
               
    
                'experience':{
    
                    required: "Experience is required!",
    
                  
    
                },
    
                'income':{
    
                    required: "Income is required!",
    
                  
    
                },
    
                'agency_health':{
    
                    required: "Agency health is required!",
    
                  
    
                },
    
                'agency_life':{
    
                    required: "Agency life is required!",
    
                  
    
                },
    
                'agency_gerenal':{
    
                    required: "Agency gerenal is required!",
    
                  
    
                },
    
                'surveyor':{
    
                    required: "Surveyor is required!",
    
                  
    
                },
    
                'pos_life':{
    
                    required: "POS life is required!",
    
                  
    
                },
    
                'pos_gerenal':{
    
                    required: "Agency gerenal is required!",
    
                  
    
                },
    
                
    
                
    
            },
    
           
    
    
    
                 submitHandler: function (form) {
    
                    $('.is-visible').loading();
    
                  $.ajax({
    
                    type: "POST",
    
                    url: base_url + "/businessinfo/",
    
                    data: $(form).serialize(),
    
                    dataType:'json',
    
                    
    
                    success: function (data) {
    
                       
    
                            var str = $.trim(data.statusCode);
    
                         if (str == 200) {
    
                            setTimeout(function() {
    
                                 $('.is-visible').loading('stop');
    
                                 $.toast({
    
                                              heading: 'Success',
    
                                              text: "<strong>Success</strong> Your Details has been saved!",
    
                                              showHideTransition: 'slide',
    
                                              icon: 'success',
    
                                              loaderBg: '#f96868',
    
                                              position: 'top-right'
    
                                            })
    
                                   
    
                            }, 3000);
    
                           
    
                        } else if(str == 300){
    
                             $('.is-visible').loading('stop');
    
                            $.toast({
    
    
    
                                              heading: 'Error',
    
                                              text: "<p> "+data.msg+"</p>",
    
                                              showHideTransition: 'slide',
    
                                              icon: 'error',
    
                                              loaderBg: '#f96868',
    
                                              position: 'top-right'
    
                                            })
    
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
        
    $("body").on("change","#state",function() {
       var state = $(this).val();
       var stateID = state.split('-');
        $.get(base_url + "/get-cities/"+stateID[0], function (resp) {
              if(resp.status=='success'){
                 var citydata =resp.data;
                 $("#city").empty();
                  var newState_ = new Option("Select City", "", false, false);
                  $("#city").append(newState_);//.trigger('change');
                  jQuery.each(citydata, function (index, item) {
                    var newState = new Option(item['value'], item['id'], false, false);
                      $("#city").append(newState);//.trigger('change');
                   });
                  if(bikeInfo.addressInfo.city){ 
                    $('#city').val(bikeInfo.addressInfo.city).trigger('change');
                  } else{
                     $('#city').val('').trigger("change");
                  }
              }
        });
    });
    
    $('.remove-certificate').on('click',function(e){
        e.preventDefault();
        var id = $(this).attr('data-id');
           $('.is-visible').loading({
               message: 'Updating educational information...'
           });
        $.get(base_url+"/deletecertificate/"+id, function(res) {
            var st  = $.trim(res.status);
             alertconfig(res.data.iscomplete,"profile");
            if(st=="success") {
               $("#hasEdu-element").hide();
               $('#not-hasEdu-element').show();
               $.toast({
                  heading: 'Success',
                  text: res.msg,
                  showHideTransition: 'slide',
                  icon: 'success',
                  loaderBg: '#f96868',
                  position: 'top-right'
                })
            } else{
                $.toast({
                      heading: 'Error',
                      text: res.msg,
                      showHideTransition: 'slide',
                      icon: 'success',
                      loaderBg: '#f96868',
                      position: 'top-right'
                })
             }
            $('.is-visible').loading('stop');
            if(res.data.iseducation==1){
             $('.education-section').empty().html('<span>Done</span>');  
            }else{
              $('.education-section').empty().html('<span class="required">Required</span>'); 
            }
            
      },'json');
    });
    
    $('.remove-passbook').on('click',function(e){
        e.preventDefault();
        var id = $(this).attr('data-id');
           $('.is-visible').loading({
               message: 'Updating bank information...'
           });
        $.get(base_url+"/deletebankstatement/"+id, function(res) {
            var st  = $.trim(res.status);
             alertconfig(res.data.iscomplete,"profile");
            $('.is-visible').loading('stop');
            if(st=="success") {
               $("#hasPassbook-element").hide();
               $('#not-hasPassbook-element').show();
               $.toast({
                  heading: 'Success',
                  text: res.msg,
                  showHideTransition: 'slide',
                  icon: 'success',
                  loaderBg: '#f96868',
                  position: 'top-right'
                })
            } else{
                $.toast({
                      heading: 'Error',
                      text: res.msg,
                      showHideTransition: 'slide',
                      icon: 'error',
                      loaderBg: '#f96868',
                      position: 'top-right'
                })
             }
            
            if(res.data.isbank==1){
             $('.bank-section').empty().html('<span>Done</span>');  
            }else{
              $('.bank-section').empty().html('<span class="required">Required</span>'); 
            }
            
      },'json');
    });
    
    $('.remove-pancard').on('click',function(e){
        e.preventDefault();
        var id = $(this).attr('data-id');
           $('.is-visible').loading({
               message: 'Removing pan card copy..'
           });
        $.get(base_url+"/deletepan_card/"+id, function(res) {
            var st  = $.trim(res.status);
             alertconfig(res.data.iscomplete,"profile");
            $('.is-visible').loading('stop');
            if(st=="success") {
               $("#hasPan-element").hide();
               $('#not-hasPan-element').show();
               $.toast({
                  heading: 'Success',
                  text: res.msg,
                  showHideTransition: 'slide',
                  icon: 'success',
                  loaderBg: '#f96868',
                  position: 'top-right'
                })
            } else{
                $.toast({
                      heading: 'Alert',
                      text: res.msg,
                      showHideTransition: 'slide',
                      icon: 'error',
                      loaderBg: '#f96868',
                      position: 'top-right'
                })
             }
            
            if(res.data.document==1){
             $('.document-section').empty().html('<span>Done</span>');  
            }else{
              $('.document-section').empty().html('<span class="required">Required</span>'); 
            }
            
      },'json');
    });
    
    $('.remove-aadharcard').on('click',function(e){
        e.preventDefault();
        var id = $(this).attr('data-id');
           $('.is-visible').loading({
               message: 'Removing pan card copy..'
           });
        $.get(base_url+"/deleteadhaar_card/"+id, function(res) {
            var st  = $.trim(res.status);
            $('.is-visible').loading('stop');
             alertconfig(res.data.iscomplete,"profile");
            if(st=="success") {
               $("#hasAadhar-element").hide();
               $('#not-hasAadhar-element').show();
               $.toast({
                  heading: 'Success',
                  text: res.msg,
                  showHideTransition: 'slide',
                  icon: 'success',
                  loaderBg: '#f96868',
                  position: 'top-right'
                })
            } else{
                $.toast({
                      heading: 'Error',
                      text: res.msg,
                      showHideTransition: 'slide',
                      icon: 'success',
                      loaderBg: '#f96868',
                      position: 'top-right'
                })
             }
            
            if(res.data.document==1){
             $('.document-section').empty().html('<span>Done</span>');  
            }else{
              $('.document-section').empty().html('<span class="required">Required</span>'); 
            }
            
      },'json');
    });
    
    $('.remove-aadharcard-back').on('click',function(e){
        e.preventDefault();
        var id = $(this).attr('data-id');
           $('.is-visible').loading({
               message: 'Removing pan card copy..'
           });
        $.get(base_url+"/deleteadhaar_card_back/"+id, function(res) {
            var st  = $.trim(res.status);
             alertconfig(res.data.iscomplete,"profile");
            $('.is-visible').loading('stop');
            if(st=="success") {
               $("#hasAaharBack-element").hide();
               $('#not-hasAaharBack-element').show();
               $.toast({
                  heading: 'Success',
                  text: res.msg,
                  showHideTransition: 'slide',
                  icon: 'success',
                  loaderBg: '#f96868',
                  position: 'top-right'
                })
            } else{
                $.toast({
                      heading: 'Error',
                      text: res.msg,
                      showHideTransition: 'slide',
                      icon: 'success',
                      loaderBg: '#f96868',
                      position: 'top-right'
                })
             }
            
            if(res.data.document==1){
             $('.document-section').empty().html('<span>Done</span>');  
            }else{
              $('.document-section').empty().html('<span class="required">Required</span>'); 
            }
            
      },'json');
    });


 }); 

 function alertconfig(iscom,param=""){
    $('.alert-section').html("");
    $.get(base_url+"/get-alert-notification/", function(res) {
        var st = $.trim(res.status);
        if(st=="success"){
            if(res.data.iscomplete==0 && res.data.isProceedSign==0 && res.data.payment_status==0){
                   
                   $('.alert-section').html('<div class="myprofile alert-profile-complete"  style="background: #fff;border: 1px solid #ac0f0a;color: #aa0f0a;margin: 10px 0px;padding: 15px 48px;    box-shadow: 0px 1px 5px 0px rgba(0,0,0,0.2), 0px 2px 2px 0px rgba(0,0,0,0.14), 0px 3px 1px -2px rgba(0,0,0,0.12);border-radius: 10px;">'+
                                          '<span><strong>Alert! </strong> Profile Information is not Complete. Fill all required details to get paid quickly.</span>'+
                                         '</div>'); 
            }
            
            if(res.data.iscomplete==1 && res.data.isProceedSign==0 && res.data.payment_status==0){
              
                   $('.alert-section').html('<div class="myprofile alert-process-payment" style="background: #fff; border: 1px solid #ac0f0a;color: #aa0f0a;margin: 10px 0px;    padding: 15px 48px;    box-shadow: 0px 1px 5px 0px rgba(0,0,0,0.2), 0px 2px 2px 0px rgba(0,0,0,0.14), 0px 3px 1px -2px rgba(0,0,0,0.12);border-radius: 10px;">'+
                                      '<span><strong>Congratulations! </strong> Profile Information is Complete. Proceed for the Payment of the Application fee.</span>'+
                                     '<button type="submit" class="btn btn-primary"style=" background: #ac0f0b !important; float: right !important; padding: 5px 15px !important; border-radius: 3px !important; box-shadow: 0 16px 24px 2px rgba(0, 0, 0, .14), 0 6px 30px 5px rgba(0, 0, 0, .12), 0 8px 10px -5px rgba(0, 0, 0, .2) !important; margin-top: -4px !important; border: 0px !important; color: #fff !important; font-size: 14px !important; " id="payment_process">Paynow'+ 
                                     '<span class="fa fa-arrow-right"></span></button>'+
                                   '</div>');
            }
            
            if(res.data.iscomplete==1 && res.data.isProceedSign==0 && res.data.payment_status==1){
                $('.alert-section').html('<div class="myprofile alert-process-verification" style="background: #fff; border: 1px solid #ac0f0a;color: #aa0f0a;margin: 10px 0px;    padding: 15px 48px;    box-shadow: 0px 1px 5px 0px rgba(0,0,0,0.2), 0px 2px 2px 0px rgba(0,0,0,0.14), 0px 3px 1px -2px rgba(0,0,0,0.12);border-radius: 10px;">'+
                                      '<span><strong>Congratulations! </strong>You have paid application fee successfully. please proceed for verification, after verification you can not  update any details.</span>'+
                                     '<button type="submit" class="btn btn-primary"style=" background: #ac0f0b !important; float: right !important; padding:3px 10px !important; border-radius: 3px !important; box-shadow: 0 16px 24px 2px rgba(0, 0, 0, .14), 0 6px 30px 5px rgba(0, 0, 0, .12), 0 8px 10px -5px rgba(0, 0, 0, .2) !important; margin-top: -4px !important; border: 0px !important; color: #fff !important; font-size: 14px !important; " id="sing_process_video">Paynow'+ 
                                     '<span class="fa fa-arrow-right"></span></button>'+
                                   '</div>');
            }
        }
    },'json');
 }

  $(document).ready(function() {

  $('.checkbox').click(function() {

      if($('#is_agency_health').is(':checked')) { 

            $('#agency_health_div').show();

       }else{

        $('#agency_health_div').hide();

       }

       if($('#is_agency_life').is(':checked')) { 

            $('#agency_life_div').show();

       }

       else{

        $('#agency_life_div').hide();

       }

       if($('#is_agency_gerenal').is(':checked')) { 

            $('#agency_gerenal_div').show();

       }

       else{

        $('#agency_gerenal_div').hide();

       }

       if($('#is_pos_gerenal').is(':checked')) { 

            $('#pos_gerenal_div').show();

       }else{

        $('#pos_gerenal_div').hide();

       }

       if($('#is_pos_life').is(':checked')) { 

            $('#pos_life_div').show();

       }else{

        $('#pos_life_div').hide();

       }

       if($('#is_surveyor').is(':checked')) { 

            $('#surveyor_div').show();

       }else{

        $('#surveyor_div').hide();

       }

       if($('#noneCheck').is(':checked')) { 

        

            $('#agency_gerenal_div').hide();

            $('#surveyor_div').hide();

            $('#pos_life_div').hide();

            $('#pos_gerenal_div').hide();

            $('#agency_health_div').hide();

            $('#agency_life_div').hide();

            $('#is_pos_gerenal').attr('disabled', 'disabled');

            $('#is_surveyor').attr('disabled', 'disabled');

            $('#is_pos_life').attr('disabled', 'disabled');

            $('#is_agency_health').attr('disabled', 'disabled');

            $('#is_agency_life').attr('disabled', 'disabled');

            $('#is_agency_gerenal').attr('disabled', 'disabled');





            $('#is_pos_gerenal').prop('checked', false);

            $('#is_surveyor').prop('checked', false);

            $('#is_pos_life').prop('checked', false);

            $('#is_agency_health').prop('checked', false);

            $('#is_agency_life').prop('checked', false);

            $('#is_agency_gerenal').prop('checked', false);

            

       }else{

            $('#is_pos_gerenal').removeAttr('disabled', 'disabled');

            $('#is_surveyor').removeAttr('disabled', 'disabled');

            $('#is_pos_life').removeAttr('disabled', 'disabled');

            $('#is_agency_health').removeAttr('disabled', 'disabled');

            $('#is_agency_life').removeAttr('disabled', 'disabled');

            $('#is_agency_gerenal').removeAttr('disabled', 'disabled');





       }

    

  });



})







$(window).on('unload',function(){

  localStorage.removeItem('cartPos');



});

$('body').on('click','#submit_all_question',function(){

var $tocken=$('meta[name="csrf-token"]').attr('content');

var question_id=$('#question_id').val();

        var answers_id ="";

        if($("input[name='answers']:checked").val()){

            answers_id=$("input[name='answers']:checked").val()

        }else{

            answers_id=0;

        }

         pushIt(answers_id,question_id);



        var postdata={

                    cartPos:JSON.parse(localStorage.getItem('cartPos')),

                     _token: $tocken

                    };

                 $.ajax({

                type: "POST",

                url: base_url+'/submit_question',

                data:postdata,

                dataType:'json',

                success: function (data) {

                    localStorage.removeItem('cartPos');

                        var str = $.trim(data.statusCode);

                    if (str == 200) {

                      window.location.href = base_url + "/exam-result/"+data.certification_id;

                                                   

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

               

        



      }); 

// var readURL = function(input) {
//         if (input.files && input.files[0]) {
//             var reader = new FileReader();
//             reader.onload = function (e) {
//                 $('.customerProfileImage').attr('src', e.target.result);
//                 //console.log(e.target.result);
//             }
//             reader.readAsDataURL(input.files[0]);
//         }
//     }
    
    
    
//     $('#upload-customer-profile').submit(function(e){
//             e.preventDefault(); 
//             // $('.p-loader').css('display', 'block');
//              addSpinner($('.p-image'));
//              $.ajax({
//                  url:base_url+"/profile/updateprofile",
//                  type:"post",
//                  data:new FormData(this),
//                  processData:false,
//                  contentType:false,
//                  dataType:'json',
//                  cache:false,
//                  async:false,
//                  success: function(data){
//                      var st = $.trim(data.status);
//                       alertconfig(data.data.iscomplete,"profile");
//                       if(data.data.ispersonal==1){
//                              $('.personal-section').html("").html('<span>Done</span>');  
//                             }else{
//                               $('.personal-section').html("").html('<span class="required">Required</span>'); 
//                           }
//                      if(st=="success"){
//                         setTimeout(function(){ 
//                           $.toast({
//                                   heading: 'Success',
//                                   text: data.msg,
//                                   showHideTransition: 'slide',
//                                   icon: 'success',
//                                   loaderBg: '#f96868',
//                                   position: 'top-right'
//                                 })
//                         removeSpinner($('.p-image'))
//                         }, 3000);
//                     }else{
//                       setTimeout(function(){  
//                           $.toast({
//                                   heading: 'Error',
//                                   text:data.msg,
//                                   showHideTransition: 'slide',
//                                   icon: 'error',
//                                   loaderBg: '#f96868',
//                                   position: 'top-right'
//                                 })
//                         removeSpinner($('.p-image'))
//                       }, 3000);
//                     }
                  
//                 }
//             });
//     }); 
    
//     function addSpinner(el, static_pos){
//       var spinner = el.children('.spinner');
//       if (spinner.length && !spinner.hasClass('spinner-remove')) return null;
//       !spinner.length && (spinner = $('<div class="spinner' + (static_pos ? '' : ' spinner-absolute') + '"/>').appendTo(el));
//       animateSpinner(spinner, 'add');
//     }
    
//     function removeSpinner(el, complete){
//       var spinner = el.children('.spinner');
//       spinner.length && animateSpinner(spinner, 'remove', complete);
//     }
    
//     function animateSpinner(el, animation, complete){
//       if (el.data('animating')) {
//         el.removeClass(el.data('animating')).data('animating', null);
//         el.data('animationTimeout') && clearTimeout(el.data('animationTimeout'));
//       }
//       el.addClass('spinner-' + animation).data('animating', 'spinner-' + animation);
//       el.data('animationTimeout', setTimeout(function() { animation == 'remove' && el.remove(); complete && complete(); }, parseFloat(el.css('animation-duration')) * 1000));
//     }


  
//     $(".file-upload").on('change', function(){
        
//         var fileUpload = $(".file-upload")[0];
 
//         //Check whether the file is valid Image.
//         var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(.jpg|.png|.jpeg)$");
//         if (regex.test(fileUpload.value.toLowerCase())) {
//             //Check whether HTML5 is supported.
//             if (typeof (fileUpload.files) != "undefined") {
//                 //Initiate the FileReader object.
//                 var reader = new FileReader();
//                 //Read the contents of Image File.
//                 reader.readAsDataURL(fileUpload.files[0]);
                
//                 reader.onload = function (e) {
//                     //Initiate the JavaScript Image object.
//                     var image = new Image();
//                     //Set the Base64 string return from FileReader as source.
//                     image.src = e.target.result;
//                     image.onload = function () {
//                         //Determine the Height and Width.
//                         var height = this.height;
//                         var width = this.width;
//                         if (height == 200 || width == 200) {
//                              //alert("Uploaded image has valid Height and Width.");
//                              $('.customerProfileImage').attr('src', image.src);
//                              $('#upload-customer-profile').submit();
//                              return true; 
//                         }else{
//                             $('.ImageError').text('Height and Width must be 200px.')
//                             return false;
//                         }
                        
//                     };
//                 }
//             } else {
//                  $('.ImageError').text('This browser does not support.');
//                  return false;
//             }
//         } else {
//             $('.ImageError').text('Please select a valid Image file.')
//             return false;
//         }
//         // readURL(this);
//         // 
//     });

       
//     $("#upload-profile-button").on('click', function() {
//       $(".file-upload").click();
//     });

$('body').on('click','#restart',function(){

    location.reload();

});
 $('body').on('click',"#payment_process", function(){
    window.location.href = base_url + "/profile/payment-process"; 
  });
  
$('body').on('click',"#sing_process_video", function(){
    window.location.href = base_url + "/profile/details/"; 
 });

 $('body').on('click','#upload-video-btn',function(e){
        $(this).attr('disabled',true);$(this).prop('disabled',true);
        var myfile = $('#identityVideo').val();
            if(myfile == '') {
                alert('Please enter file name and select file');
                return;
            }
            $('#myprogress-container').show();
            $('.myprogress').css('width', '0');
            var formData = new FormData();
            formData.append('identityVideo', $('#identityVideo')[0].files[0]);
            //formData.append('id', $('#_agent').val());
            $.ajax({
                url:base_url+"/profile/video-upload",
                data: formData,
                processData: false,
                contentType: false,
                type: 'POST',
                dataType:"json",
                // this part is progress bar
                xhr: function () {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function (evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                            percentComplete = parseInt(percentComplete * 100);
                            if(percentComplete>=50){
                                $('.myprogress').css('background-color','green');
                            }
                            $('.myprogress').text(percentComplete + '%');
                            $('.myprogress').css('width', percentComplete + '%');
                        }
                    }, false);
                    return xhr;
                },
                success: function (data) {
                    console.log(data);
                    
                     $('#myprogress-container').hide();
                    if($.trim(data.status)=="success"){
                        $('.myprogress').css('width', '0');
                        $('.table-file-choose').hide();
                        $('.table-file-has').show();
                        $('#upload-video-btn').attr('disabled',true);$('#upload-video-btn').prop('disabled',true);
                        $('#identity-notify').append('<div class="alert alert-success">'
                                  +'<strong>Success!</strong> Identity video uploaded successfully <a href="#" class="alert-link"> Redirecting in 5 seconds...</a>.'
                        +'</div>'); 
                       setTimeout(function(){  window.location.href = base_url + "/profile"; },6000);
                    }else{
                        $('#upload-video-btn').attr('disabled',false);$('#upload-video-btn').prop('disabled',false);
                        $('#identity-notify').append('<div class="alert alert-success">'
                                  +'<strong>Error!</strong> Error while upload video <a href="#" class="alert-link">Try again..</a>.'
                                 +'</div>'); 
                    }
                    
                }
            });
})
   
    

      
    $("#upload-profile-video").on('click', function() {
        $(".file-uploads").click();
    });