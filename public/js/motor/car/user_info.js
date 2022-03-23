
var  enQId;
$(window).on('load', function(){
    enQId  = $('#enQId').val();
    $.get(base_url+'/get-enquiry-details/'+enQId,function(result){
        localStorage.setItem("carInfo", JSON.stringify(result.data));
    },'json');
});


//$('#car_number').mask('SS00SS0000');
$('.dob-mask').mask('00-00-0000');
$(document).ready(function() {
    $('#choosePolicyFile').bind('change', function () {
          var filename = $("#choosePolicyFile").val();
          if (/^\s*$/.test(filename)) {
            $(".file-upload").removeClass('active');
            $("#noFile").text("No file chosen..."); 
          }
          else {
            $(".file-upload").addClass('active');
            $("#noFile").text(filename.replace("C:\\fakepath\\", "")); 
          }
        });
});


function uploadFile(ref,deviceToken){  //upload policy copy
            if($('#choosePolicyFile').val()!==""){
                var formData = new FormData();
                formData.append('enc', ref);
                formData.append('deviceToken', deviceToken);
                // Attach file
                formData.append('policy_doc', $('#choosePolicyFile')[0].files[0]);
                    $.ajax({
                        url: base_url + "/car-insurance/upload-files/"+ref,
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            
                        },
                        error: function(response) {
                        
                        }
                    });
                return true;
            }else{
               return false; 
            }
        }

$(document).ready(function() {
    
    
    if($('.select2-hypothecationAgency').length){ 
         
         $('.select2-hypothecationAgency').select2({
                      ajax: { 
                           url: base_url + "/get-financiers",
                           type: "get",
                           dataType: 'json',
                         
                           data: function (params) {
                            return {
                              searchTerm: params.term // search term
                            };
                           },
                           processResults: function (response) {
                             return {
                                results: response.data
                             };
                           },
                           cache: true
                          }
        });
     }
    
    
    $("body").on("click","#btn-step-1",function() {
        var form = $("#profile_form");
        form.validate({
            errorElement: 'span',
            errorClass: 'error',
            errorPlacement: function(error, element) {
            console.log(element);
            if(element.attr("name")=='gender'){
                error.insertAfter(element.parent().parent('.form-group'));
            }else{
                error.insertAfter(element.parent('.form-group'));
            }
            },
            highlight: function(element, errorClass, validClass) {
                $(element).closest('.form-group').addClass("has-error");
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).closest('.form-group').removeClass("has-error");
            },
            
            rules: {
                first_name: {
                    required: {
                            depends: function () { return ($('#first_name').length>0)?true:false; }
                        },
                    minlength: 3,
                    chars: true,
                },
                last_name: {
                   required: {
                            depends: function () { return ($('#last_name').length>0)?true:false; }
                        },
                    minlength: 3,
                    chars: true,
                },
                email: {
                    required: {
                            depends: function () { return ($('#email').length>0)?true:false; }
                        },
                    email: true,
                },
                dob:{
                    required: {
                            depends: function () { return ($('#dob').length>0)?true:false; }
                        },
                },
                gender: {
                    required: {
                            depends: function () { return ($('.gender-input').length>0)?true:false; }
                        },
                },
                mobile: {
                    number:true,
                    minlength:10,
                    maxlength:10,
                    required: {
                            depends: function () { return ($('#mobile').length>0)?true:false; }
                        },
                },
                nominee_name: {
                    required: {
                            depends: function () { return ($('#nominee_name').length>0)?true:false; }
                        },
                    fullname: true,
                },
                nominee_relation: {
                    required: {
                            depends: function () { return ($('#nominee_relation').length>0)?true:false; }
                        },
                }
            },
         
        });
        if (form.valid() === true) {
            var carInfo = JSON.parse(localStorage.getItem('carInfo'));
            
            if(carInfo.customer!==undefined){
                carInfo.customer.salutation =  $('#salutation').val();
                carInfo.customer.first_name = $('#first_name').val();
                carInfo.customer.last_name = $('#last_name').val();
                carInfo.customer.email = $('#email').val();
                carInfo.customer.mobile = $('#mobile').val();
                carInfo.customer.dob = $('#dob').val();
                carInfo.customer.gender = $("input[name='gender']:checked").val();
            }else{
               var customer = {} 
                customer.salutation =  $('#salutation').val();
                customer.first_name = $('#first_name').val();
                customer.last_name = $('#last_name').val();
                customer.email = $('#email').val();
                customer.mobile = $('#mobile').val();
                customer.dob = $('#dob').val();
                customer.gender = $("input[name='gender']:checked").val();
                carInfo.customer = customer;
            }
            carInfo.vehicle.hypothecationAgency= $('#hypothecationAgency').val();
             var nominee = {}
                    nominee.name= $('#nominee_name').val();
                    nominee.dob= $('#nominee_dob').val();
                    nominee.relation = $('#nominee_relation').val();
                    
            carInfo.nominee = nominee;
            localStorage.setItem("carInfo", JSON.stringify(carInfo));
            var postInfo = JSON.parse(localStorage.getItem('carInfo'));
            $.post(base_url+"/car-insurance/update-info/"+enQId,{enqId:enQId,param:postInfo,step:'personal'},function(result){ 
                if($.trim(result.status)=='success'){
                     $("#owner_data").removeClass('active-step');
                     $("#communication_address").addClass('active-step');
                     $("#progress-step-1").removeClass('active').addClass('completed');
                     $("#progress-step-2").addClass('active');
                     $('html, body').animate({ scrollTop: 0 }, 1200);
                }
            });
           
        }
    });
    
    $("body").on("click","#btn-step-2",function() {
        var form = $("#address_form");
        form.validate({
            errorElement: 'span',
            errorClass: 'error',
            highlight: function(element, errorClass, validClass) {
                $(element).closest('.form-group').addClass("has-error");
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).closest('.form-group').removeClass("has-error");
            },
            errorPlacement: function(error, element) {
                error.insertAfter(element.parent('.form-group'));
            },
            rules: {
                pincode: {
                    required: true,
                    minlength: 6,
                    maxlength: 6,
                },
                address: {
                    required: true,
                    minlength: 3,
                },
                city_id: {
                    required: true,
                },
                state_id: {
                    required: true,
                    
                },
            },
            messages: {
                pincode: {
                    required: "Area pincode is required!",
                    minlength:"Enter valid pincode number",
                    maxlength:"Enter valid pincode number",
                },
                address: {
                    required: "Your address  is required!",
                },
                city_id: {
                    required: "Your city is required!",
                },
                state_id: {
                    required: "Your State provision is required!",
                },
            }
        });
        if (form.valid() === true) {
            var carInfo = JSON.parse(localStorage.getItem('carInfo'));
            var address = {}
            address.addressLine= $('#address').val();
            address.pincode = $('#pincode').val();
            address.city = $('#city_id').val();
            address.state = $('#state_id').val();
            carInfo.address   = address;   
            
            localStorage.setItem("carInfo", JSON.stringify(carInfo));
            var postInfo = JSON.parse(localStorage.getItem('carInfo'));
            $.post(base_url+"/car-insurance/update-info/"+enQId,{enqId:enQId,param:postInfo},function(result){ 
                if($.trim(result.status)=='success'){
                        $("#owner_data").removeClass('active-step');
                        $("#communication_address").removeClass('active-step');
                        $("#vehicle_data").addClass('active-step');
                        $("#progress-step-1").removeClass('active').addClass('completed');
                        $("#progress-step-2").removeClass('active').addClass('completed');
                        $("#progress-step-3").addClass('active');
                        $('html, body').animate({ scrollTop: 0 }, 1200);
                }
            });
            
        }
    });
    
    $("body").on("click","#btn-back-step-2",function() {
            $("#communication_address").removeClass('active-step');
            $("#vehicle_data").removeClass('active-step');
            $("#owner_data").addClass('active-step');
            $("#progress-step-2").removeClass('active').removeClass('completed');
            $("#progress-step-3").removeClass('active').removeClass('completed');
            $("#progress-step-1").addClass('active');
            $('html, body').animate({ scrollTop: 0 }, 1200);
    });
    
    $("body").on("click","#btn-step-3",function() {
        var ref = $(this).attr('data-ref');
        var form = $("#vehicle_form");
        form.validate({
            errorElement: 'span',
            errorClass: 'error',
            highlight: function(element, errorClass, validClass) {
                $(element).closest('.form-group').addClass("has-error");
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).closest('.form-group').removeClass("has-error");
            },
            rules: {
                chassis_number: {
                    required: true,
                    minlength: 6,
                    maxlength:20
                },
                e_number: {
                    required: true,
                    minlength: 6,
                    maxlength:20
                },
                reg_date: {
                    required: true,
                },
                car_number: {
                    required: {
                        depends: function () { return $('#car_number').length>0; }
                    },
                    rtono: {
                        depends: function () { return $('#car_number').length>0; }
                    }
                    
                },
                policy_no: {
                    required: {
                        depends: function () { return $('#policy_no').length>0; }
                    }
                },
                policy_exp_date: {
                    required: {
                        depends: function () { return $('#policy_exp_date').length>0; }
                    }
                },
                previousInsurer: {
                    required: {
                        depends: function () { return $('#previousInsurer').length>0; }
                    }
                },
                
                
                 TP_policyno: {
                    required: {
                        depends: function () { return $('#TP_policyno').length>0; }
                    }
                },
                 TPInsurer: {
                    required: {
                        depends: function () { return $('#TPInsurer').length>0; }
                    }
                },
                TPprePolicyType: {
                   required: {
                        depends: function () { return $('#TPprePolicyType').length>0; }
                    }
                },
                 TPpolicyStartDate: {
                    required: {
                        depends: function () { return $('#TPpolicyStartDate').length>0; }
                    }
                },
                TPpolicyEndDate: {
                   required: {
                        depends: function () { return $('#TPpolicyEndDate').length>0; }
                    }
                }
               
            },
            messages: {
                chassis_number: {
                    required: "Classic number required!",
                },
                e_number: {
                    required: "Engine number required",
                },
                reg_date: {
                    required: "Registration date required!",
                },
                 car_number: {
                    required: "Bike Registration number required!",
                    rtono:"Enter valid RTO number."
                },
                policy_no: {
                    required: "Please enter policy number",
                },
                policy_exp_date: {
                    required: "Please enter policy expiry date",
                },
                 previousInsurer: {
                    required: "Choose your prevoius insurer.",
                },
                
                TP_policyno: {
                    required: "ThirdParty Policy no is required",
                },
                 TPInsurer: {
                    required: "ThirdParty Insurer is required",
                },
                TPprePolicyType: {
                    required: "ThirdParty policy type is required",
                },
                 TPpolicyStartDate: {
                    required: "Choose Start Date",
                },
                TPpolicyEndDate: {
                    required: "Choose End Date",
                }
            }
        });

 
        if (form.valid() === true ) {
                var isValid  = true;
                // if($('#choosePolicyFile').length>0){
                //  var isValid = uploadFile(enQId,"twss");
                // }else{
                //   var isValid  = true;
                // }
             if(isValid){
                    $('#btn-step-3').loadButton('on',{faClass:'fa fa-sm',faIcon:'fa-spinner', doSpin:true,loadingText:'Submitting...', });
                    var carInfo = JSON.parse(localStorage.getItem('carInfo'));
                    if($('#car_number').length>0){
                        var vnumber = $('#car_number').val();
                        var rto = vnumber.substring(0, 4);
                        
                        
                        carInfo.vehicle.vehicleNumber = vnumber.toUpperCase();
                        carInfo.vehicle.rtoCode   = rto.toUpperCase();
                        carInfo.previousInsurance.policyNo = ($('#policy_no').length>0)?$('#policy_no').val():"";
                        carInfo.previousInsurance.insurer = ($('#previousInsurer').length>0)?$('#previousInsurer').val():"";
                        carInfo.previousInsurance.expDate = ($('#policy_exp_date').length>0)?$('#policy_exp_date').val():"";
                    }else{
                        carInfo.vehicle.rtoCode = carInfo.vehicle.rtoCode;
                    }
                    if($('#company_name').length>0){ 
                        carInfo.customer.company = $('#company_name').val();
                        carInfo.customer.gstin = $('#gstin_number').val();
                    }
                    
                       carInfo.vehicle.engineNumber = $('#e_number').val();
                       carInfo.vehicle.chassisNumber = $('#chassis_number').val();
                       
                       var dmyreg = $('#reg_date').val();
                       var DT = dmyreg.split("-");
                        
                        carInfo.vehicle.regDate = DT[0];
                        carInfo.vehicle.regYear = DT[2];
                        carInfo.vehicle.regMonth = DT[1];
                        carInfo.vehicle.regDMY = dmyreg;
                        
                        if($('#TPpolicyEndDate').length>0){
                            
                            carInfo.TP.TPInsurer = $('#TPInsurer').val();
                            carInfo.TP.TP_policyno = $('#TP_policyno').val();
                            carInfo.TP.prePolicyType = $('#TPprePolicyType').val();
                            carInfo.TP.TPpolicyEndDate = $('#TPpolicyEndDate').val();
                            carInfo.TP.TPpolicyStartDate = $('#TPpolicyStartDate').val();
                        }
                        
                      localStorage.setItem("carInfo", JSON.stringify(carInfo));
                    $("#vehicle_data").addClass('active-step');
                     var carInfo = JSON.parse(localStorage.getItem('carInfo'));
                     $.post(base_url + "/car-insurance/create-proposal/"+enQId,{enc:enQId,carInfo:carInfo}, 
                       function (resp){
                           $('#btn-step-3').loadButton('off');
                            var status = $.trim(resp.status);
                            var breakInCase = $.trim(resp.isBreakIn);
                            if(status=='success'){
                                var enc = resp.data.enc;
                                if(breakInCase=='Yes'){
                                     window.location.href=base_url+"/car-insurance/inspection/"+enc;
                                }else{
                                     window.location.href=base_url+"/car-insurance/plan-summary/"+enc;
                                }
                                
                               
                             }else{
                                 toastr.error(resp.message,'Error');
                                 
                             }
                      },'json').fail(function() {
                        $('#btn-step-3').loadButton('off');
                        toastr.error("Internal server error",'Error');
                      });
             }else{
                $.toast({
                  text: 'Please your previous policy document.',
                  showHideTransition: 'slide',
                  position:'bottom-right',
                  hideAfter:6000,
                  allowToastClose:false
                }); 
           }
        }
    });
    
    $("body").on("click","#btn-back-step-3",function() {
            $("#vehicle_data").removeClass('active-step');
            $("#owner_data").removeClass('active-step');
            $("#communication_address").addClass('active-step');
            
            $("#progress-step-1").removeClass('active').addClass('completed');
            $("#progress-step-3").removeClass('active').removeClass('completed');
            $("#progress-step-2").addClass('active');
    });
    
    $(document).on('click change', "input[name='gender']", function(e) {
        var val = $("input[name='gender']:checked").val();
        if(val === 'Male') { //if(val === '0' || val=='+90') {
           $('#salutation').val('Mr');
        } else {
            $('#salutation').val('Ms');
        }
    });
    
    $("body").on("change","#state_id",function() {
       var state = $(this).val();
       var stateID = state.split('-');
       var carInfo = JSON.parse(localStorage.getItem('carInfo'));
        $.get(base_url + "/get-cities/"+stateID[0], function (resp) {
              if(resp.status=='success'){
                 var citydata =resp.data;
                 $("#city_id").empty();
                  var newState_ = new Option("Select City", "", false, false);
                  $("#city_id").append(newState_);//.trigger('change');
                  jQuery.each(citydata, function (index, item) {
                    var newState = new Option(item['value'], item['id'], false, false);
                      $("#city_id").append(newState);//.trigger('change');
                   });
                  if(carInfo.address.city!== undefined){ 
                    $('#city_id').val(carInfo.address.city).trigger('change');
                  } else{
                     $('#city_id').val('').trigger("change");
                  }
              }
        });
    });
    
    $("body").on("change","#city_id",function() {
       var city = $(this).val();
       if(city!=""){
         var CT = city.split('-');
         $.post(base_url + "/get-city-pincode/",{city:CT[1]}, function (resp) { 
              if(resp.status=="success"){
                  $('#pincode').val(resp.pincode);
                //   availableTags = resp.data;
                //   console.log(availableTags);
              }
          },'json');
       }else{
          $('#pincode').val('') 
       }
    })
     
    var start = new Date();
    var default_end = new Date(start.getFullYear()-80, start.getMonth(), start.getDate());
    var end = new Date(start.getFullYear()-18, start.getMonth(), start.getDate());
    
     var start = new Date();
    var default_end = new Date(start.getFullYear()-80, start.getMonth(), start.getDate());
    var end = new Date(start.getFullYear()-18, start.getMonth(), start.getDate());
    
    $("#nominee_dob").datepicker({
        changeMonth: true, changeYear: true,
        yearRange: "-100:+0",
        minDate : default_end,maxDate: end,
        dateFormat: 'dd-mm-yy', autoclose: true,
     });
     $("#dob").datepicker({
        changeMonth: true, changeYear: true,
        yearRange: "-100:+0",
        minDate : default_end,maxDate: end,
        dateFormat: 'dd-mm-yy', autoclose: true,
     });
     
     $("#reg_date").datepicker({
       changeMonth: true, changeYear: true,
        maxDate: 0,dateFormat: 'dd-mm-yy', autoclose: true,
     });
     
     $("#policy_exp_date").datepicker({
        changeMonth: true, changeYear: true,
        dateFormat: 'dd-mm-yy', autoclose: true,
     });
     
     $("#TPpolicyStartDate").datepicker({
       changeMonth: true, changeYear: true,
        maxDate: 0,dateFormat: 'dd-mm-yy', autoclose: true,
     });
     
      $("#TPpolicyEndDate").datepicker({
       changeMonth: true, changeYear: true,
        minDate: 0,dateFormat: 'dd-mm-yy', autoclose: true,
     });
     
      
     $('body').on('change','#reg_date', function(e){
        var str =  $(this).val();
        $('#span_reg_date').text(str.split("-")[2]);
     })
     
     $('body').on('keyup','#car_number', function(e){
        var str =  $(this).val();
        $('#span_rto_no').text(str.toUpperCase()); 
     })
 
});

$('body').on('click','.Premium-Breakup', function(e){
    e.preventDefault();
    var ref = $(this).attr('data-ref');
       $.dialog({
            title: '',
            content: 'url:'+base_url+"/moter-insurance/load-moter-premium/breakup-modal/enq/"+ref,
            animation: 'scale',
            columnClass: 'medium',
            closeAnimation: 'scale',
            backgroundDismiss: true,
        });
});

 $( function() {
      
           $( "#pincode" ).autocomplete({
                      source: function(request,response){
                          $.ajax( {
                          url:  base_url+"/get-city-pincode",
                          dataType: "json",
                          data: {
                            term: request.term,city:$('#city_id').val()
                          },
                          success: function( data ) {
                            response( data );
                          },
                        } );
                      },
                      minLength: 1,
                      select: function( event, ui ) {
                        //alert( "Selected: " + ui.item.value + " aka " + ui.item.label );
                        // window.location.href = ui.item.url;
                      }
                });
      
      
      
      
     
       $("body").on("change","#city_id",function() {
          var city = $(this).val();
          if(city!=""){
            $('#pincode').attr('disabled',false);
            $('#pincode').prop('disabled',false);
         }else{
              $('#pincode').val('') ;
              $('#pincode').attr('disabled',true);
              $('#pincode').attr('disabled',true);
         }
    })
      
      
      
      
   
 
  });