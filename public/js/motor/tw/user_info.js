
var  enQId;
$(window).on('load', function(){
    enQId  = $('#enQId').val();
    $.get(base_url+'/get-enquiry-details/'+enQId,function(result){
        localStorage.setItem("twInfo", JSON.stringify(result.data));
    });
});


//$('#bike_number').mask('SS00SS0000');
$('.dob-mask').mask('00-00-0000');

function createPolicy(enQId){
           $.post(base_url + "/twowheeler-insurance/create-proposal/"+enQId,{enc:enQId}, 
               function (resp){
                   $('#btn-step-3').loadButton('off');
                    var status = $.trim(resp.status);
                    if(status=='success'){
                        var enc = resp.data.enc;
                        window.location.href=base_url+"/twowheeler-insurance/plan-summary/"+enc;
                     }else{
                         $('#btn-step-3').loadButton('off');
                         toastr.error(resp.message,'Error',);
                         
                     }
              }).fail(function() {
                    $('#btn-step-3').loadButton('off');
                    toastr.error("Internal server error",'Error');
               });
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
    
    if($('#nominee_relation').length){
        $("#nominee_relation").selectize({
          create: false,
          sortField: "text",
        });
    }
    
    $("body").on("click","#btn-step-1",function() {
        var form = $("#profile_form");
        form.validate({
            errorElement: 'span',
            errorClass: 'error',
               ignore: ':hidden:not([class~=selectized]),:hidden > .selectized, .selectize-control .selectize-input input',
             errorPlacement: function(error, element) {
            
             if(element.attr("name")=='gender'){
                error.insertAfter(element.parent().parent('.form-group'));
             }else if(element.attr("name")=='first_name'){
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
            var twInfo = JSON.parse(localStorage.getItem('twInfo'));
            
            if(twInfo.customer!==undefined){
                twInfo.customer.salutation =  $('#salutation').val();
                twInfo.customer.first_name = $('#first_name').val();
                twInfo.customer.last_name = $('#last_name').val();
                twInfo.customer.email = $('#email').val();
                twInfo.customer.mobile = $('#mobile').val();
                twInfo.customer.dob = $('#dob').val();
                twInfo.customer.gender = $("input[name='gender']:checked").val();
            }else{
               var customer = {} 
                customer.salutation =  $('#salutation').val();
                customer.first_name = $('#first_name').val();
                customer.last_name = $('#last_name').val();
                customer.email = $('#email').val();
                customer.mobile = $('#mobile').val();
                customer.dob = $('#dob').val();
                customer.gender = $("input[name='gender']:checked").val();
                twInfo.customer = customer;
            }
            twInfo.vehicle.hypothecationAgency= $('#hypothecationAgency').val();
             var nominee = {}
                    nominee.name= $('#nominee_name').val();
                    nominee.dob= $('#nominee_dob').val();
                    nominee.relation = $('#nominee_relation').val();
                    
            twInfo.nominee = nominee;
            localStorage.setItem("twInfo", JSON.stringify(twInfo));
            var postInfo = JSON.parse(localStorage.getItem('twInfo'));
            $.post(base_url+"/twowheeler-insurance/update-info/"+enQId,{enqId:enQId,param:postInfo,step:'personal'},function(result){ 
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
            ignore: ':hidden:not([class~=selectized]),:hidden > .selectized, .selectize-control .selectize-input input',
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
                 addressLineOne: {
                    required: true,
                    minlength: 2,
                },
                addressLineTwo: {
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
               addressLineOne: {
                    required: "Your House No/Building Name is required!",
                },
                addressLineTwo:{
                    required: "Your Street/Road Name is required!",
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
            var twInfo = JSON.parse(localStorage.getItem('twInfo'));
               var address = {}
               address.addressLineOne= $('#addressLineOne').val();
               address.addressLineTwo= $('#addressLineTwo').val();
                address.pincode = $('#pincode').val();
                address.city = $('#city_id').val();
                address.state = $('#state_id').val();
                twInfo.address   = address;   
           
            localStorage.setItem("twInfo", JSON.stringify(twInfo));
            var postInfo = JSON.parse(localStorage.getItem('twInfo'));
            $.post(base_url+"/twowheeler-insurance/update-info/"+enQId,{enqId:enQId,param:postInfo},function(result){ 
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
               ignore: ':hidden:not([class~=selectized]),:hidden > .selectized, .selectize-control .selectize-input input',
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
                bike_number: {
                    required: {
                        depends: function () { return $('#bike_number').length>0; }
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
                 bike_number: {
                    required: "Bike Registration number required!",
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
              
                    $('#btn-step-3').loadButton('on',{faClass:'fa fa-sm',faIcon:'fa-spinner', doSpin:true,loadingText:'Submitting...', });
                    var twInfo = JSON.parse(localStorage.getItem('twInfo'));
                    if($('#bike_number').length>0){
                        var vnumber = $('#bike_number').val();
                        var rto = vnumber.substring(0, 4);
                        
                        
                        twInfo.vehicle.vehicleNumber = vnumber.toUpperCase();
                        twInfo.vehicle.rtoCode   = rto.toUpperCase();
                        twInfo.previousInsurance.policyNo = ($('#policy_no').length>0)?$('#policy_no').val():"";
                        twInfo.previousInsurance.insurer = ($('#previousInsurer').length>0)?$('#previousInsurer').val():"";
                        twInfo.previousInsurance.expDate = ($('#policy_exp_date').length>0)?$('#policy_exp_date').val():"";
                    }else{
                        twInfo.vehicle.rtoCode = twInfo.vehicle.rtoCode;
                    }
                    if($('#company_name').length>0){ 
                        twInfo.customer.company = $('#company_name').val();
                        twInfo.customer.gstin = $('#gstin_number').val();
                    }
                    
                       twInfo.vehicle.engineNumber = $('#e_number').val();
                       twInfo.vehicle.chassisNumber = $('#chassis_number').val();
                       
                       var dmyreg = $('#reg_date').val();
                       var DT = dmyreg.split("-");
                        
                        twInfo.vehicle.regDate = DT[0];
                        twInfo.vehicle.regYear = DT[2];
                        twInfo.vehicle.regMonth = DT[1];
                        twInfo.vehicle.regDMY = dmyreg;
                        if($('#TPpolicyEndDate').length>0){
                            
                            twInfo.TP.TPInsurer = $('#TPInsurer').val();
                            twInfo.TP.TP_policyno = $('#TP_policyno').val();
                            twInfo.TP.prePolicyType = $('#TPprePolicyType').val();
                            twInfo.TP.TPpolicyEndDate = $('#TPpolicyEndDate').val();
                            twInfo.TP.TPpolicyStartDate = $('#TPpolicyStartDate').val();
                        }
                      localStorage.setItem("twInfo", JSON.stringify(twInfo));
                     $("#vehicle_data").addClass('active-step');
                     var twInfo = JSON.parse(localStorage.getItem('twInfo'));
                     $.post(base_url+"/twowheeler-insurance/update-info/"+enQId,{enqId:enQId,param:twInfo,step:'policy'},function(result){ 
                         if($.trim(result.status)=='success'){
                              createPolicy(enQId);
                        }
                      }).fail(function() {
                            $('#btn-step-3').loadButton('off');
                            toastr.error("Internal server error",'Error');
                       });
             
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
    
    // $("body").on("change","#state_id",function() {
    //   var state = $(this).val();
    //   var stateID = state.split('-');
    //   var twInfo = JSON.parse(localStorage.getItem('twInfo'));
    //     $.get(base_url + "/get-cities/"+stateID[0], function (resp) {
    //           if(resp.status=='success'){
    //              var citydata =resp.data;
    //              $("#city_id").empty();
    //               var newState_ = new Option("Select City", "", false, false);
    //               $("#city_id").append(newState_);//.trigger('change');
    //               jQuery.each(citydata, function (index, item) {
    //                 var newState = new Option(item['value'], item['id'], false, false);
    //                   $("#city_id").append(newState);//.trigger('change');
    //               });
    //               if(twInfo.hasOwnProperty('address')){
    //                 $('#city_id').val(twInfo.address.city).trigger('change');
    //               } else{
    //                  $('#city_id').val('').trigger("change");
    //               }
    //           }
    //     });
    // });
    
   
     
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
     
      
     $('body').on('change','#reg_date', function(e){
        var str =  $(this).val();
        $('#span_reg_date').text(str.split("-")[2]);
     })
     
     $('body').on('keyup','#bike_number', function(e){
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

	var xhr;
				var select_state, $select_state;
				var select_city, $select_city;
                var select_pincode,$select_pincode;
				$select_state = $('#state_id').selectize({
					onChange: function(value) {
						if (!value.length) return;
						 var state = value;
                         var stateID = state.split('-');
						//select_city.disable();
						 select_city.clearOptions();
						select_city.load(function(callback){
							xhr && xhr.abort();
							xhr = $.ajax({
								url: base_url + "/get-cities/"+stateID[0],
								success: function(results) {
								   
									//select_city.enable();
									callback(results.data);
								},
								error: function() {
									callback();
								}
							})
						});
					}
				});

				$select_city = $('#city_id').selectize({
					valueField: 'id',
					labelField: 'value',
					searchField: ['value'],
					onChange: function(value) { 
					    // select_pincode.clearOptions();
					}
					    
					
				});
                 
			   
			
                
			//	select_city.disable();
			
// 			$select_pincode = $("#pincode").selectize({
//                   valueField: "value",
//                   labelField: "label",
//                   searchField: ["value"],
//                  // create: false,
//                   load: function (query, callback) {
//                     if (!query.length) return callback();
//                     $.ajax( {
//                           url:  base_url+"/get-city-pincode",
//                           dataType: "json",
//                           data: {
//                             term:encodeURIComponent(query),city:$('#city_id').val()
//                           },error: function () {
//                             callback();
//                           },
//                           success: function( res ) {
//                               callback(res);
//                              //callback(res.repositories.slice(0, 10));
//                           },
//                         } );
//                   },
//                 });
                
                
              select_city    = $select_city[0].selectize;
			select_state   = $select_state[0].selectize;
             // select_pincode = $select_pincode[0].selectize;  
           
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
      
      
      
      
     
    //   $("body").on("change","#city_id",function() {
    //       var city = $(this).val();
    //       if(city!=""){
    //         $('#pincode').attr('disabled',false);
    //         $('#pincode').prop('disabled',false);
    //      }else{
    //           $('#pincode').val('') ;
    //           $('#pincode').attr('disabled',true);
    //           $('#pincode').attr('disabled',true);
    //      }
    // })
      
      
      
      
   
 
  });