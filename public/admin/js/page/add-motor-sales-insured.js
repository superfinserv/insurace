$(function(){
    'use strict'
    
      jQuery.validator.addMethod("isamt", function(value, element) {
            if (/^\d*\.?\d*$/.test(value)) {
                return true;
            } else {
                return false;
            }
        }, 'Invalid Amount');
     
       $("#startDate").keypress(function(event) {event.preventDefault();});
       $("#endDate").keypress(function(event) {event.preventDefault();});
       $("#regDate").keypress(function(event) {event.preventDefault();});
       $("#loginDate").keypress(function(event) {event.preventDefault();});
       $('#startDate').datepicker({
           changeMonth: true,changeYear: true,dateFormat: 'dd/mm/yy'
        });
         $('#endDate').datepicker({
           changeMonth: true,changeYear: true,dateFormat: 'dd/mm/yy'
        });
         $('#regDate').datepicker({
           changeMonth: true,changeYear: true,dateFormat: 'dd/mm/yy',maxDate: 0
        });
        // $('#nomDate').datepicker({
        //   changeMonth: true,changeYear: true,dateFormat: 'dd/mm/yy'
        // });
     
     $("#MotorInsuredForm").validate({
        rules: {
                'policy_no': { required: true },
                'tranaction_no': { required: false},
                'customer_name':{ required:true},
                'customer_no':{ required:true},
                'vReg': { required: true },
                'vEngine': { required: true},
                'vChassis':{ required:true},
                'vIdv':{ required:true},
                'policyFor':{ required:true},
                'policyType':{ required:true},
                'vMake':{ required:true},
                'vModel':{ required:true},
                'insPartner':{ required:true},
                'startDate':{ required:true},
                'endDate':{ required:true},
                'pospId':{ required:true},
                
                'regDate':{ required:true},
                // 'addressLineOne':{ required:true},
                // 'addressLineTwo':{ required:true},
                // 'state':{ required:true},
                // 'city':{ required:true},
                // 'pincode':{ required:true,minlength:6,maxlength:6,number:true},
                // 'nomName':{ required:true},
                // 'nomDate':{ required:true},
                // 'nomRelation':{ required:true},
                
                'PA_OwnerDriverCoverAmt':{ required:"#PA_OwnerDriverCover:checked",isamt:true},
                'isPA_UNPassCoverAmt':{ required:"#isPA_UNPassCover:checked",isamt:true},
                'isPA_UNDriverCoverAmt':{ required:"#isPA_UNDriverCover:checked",isamt:true},
                'isLL_PaidDriverCoverAmt':{ required:"#isLL_PaidDriverCover:checked",isamt:true},
                'isLL_UNPassCoverAmt':{ required:"#isLL_UNPassCover:checked",isamt:true},
                'isLL_EmpCoverAmt':{ required:"#isLL_EmpCover:checked",isamt:true},
                'isCngKitCoverAmt':{ required:"#isCngKitCover:checked",isamt:true},
                'isElecAccCoverAmt':{ required:"#isElecAccCover:checked",isamt:true},
                'isNonElecAccCoverAmt':{ required:"#isNonElecAccCover:checked",isamt:true},
                'isBreakDownAsCoverAmt':{ required:"#isBreakDownAsCover:checked",isamt:true},
                'isPersonalBelongCoverAmt':{ required:"#isPersonalBelongCover:checked",isamt:true},
                'isKeyLockProCoverAmt':{ required:"#isKeyLockProCover:checked",isamt:true},
                'isPartDepProCoverAmt':{ required:"#isPartDepProCover:checked",isamt:true},
                'isConsumableCoverAmt':{ required:"#isConsumableCover:checked",isamt:true},
                'isEng_GearBoxProCoverAmt':{ required:"#isEng_GearBoxProCover:checked",isamt:true},
                'isCashAllowCoverAmt':{ required:"#isCashAllowCover:checked",isamt:true},
                'isTyreProCoverAmt':{ required:"#isTyreProCover:checked",isamt:true},
                'isRetInvCoverAmt':{ required:"#isRetInvCover:checked",isamt:true},
                'ncbDiscountAmt':{ required:"#ncbDiscount:checked",isamt:true},
                'ncbDiscountPercent':{ required:"#ncbDiscount:checked"},
                'otherDiscountAmt':{ required:"#otherDiscount:checked",isamt:true},
                'total_net':{ required:true,isamt:true},
                'total_tax':{ required:true,isamt:true},
                'total_gross':{ required:true,isamt:true},
                'netTP':{ required:true,isamt:true},
                'netOD':{ required:true,isamt:true},
                'policyFile':{ required:true}
            
        },

       submitHandler: function (form) {
             $('.savepolicyInfoBtn').loadButton('on',{ faClass:'fa',faIcon:'fa-spinner', doSpin:true, loadingText:'Submitting Information...'});
            // $.post(base_url+'/sales/save/new/policy',$(form).serialize(),function(result){
            //      $(".savepolicyInfoBtn").loadButton('off');
            //     if($.trim(result.status)=='success'){
            //       $('.agent-register-notify')._success(result.message);
            //       // $('#agentRegisterInfo')[0].reset();
            //     }else{
            //       $('.agent-register-notify')._error(result.message);  
            //     }
            // },'json')
            var form = $('#MotorInsuredForm')[0];
            var formData = new FormData(form);
            $.ajax({
                    url: base_url+'/sales/save/new/policy',
                    type: "POST",
                    dataType: "JSON",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data, status){
                        $(".savepolicyInfoBtn").loadButton('off');
                        if($.trim(data.status)=='success'){
                            $('.agent-register-notify')._success(data.message);  
                        }else{
                            $('.agent-register-notify')._error(data.message);  
                        }
                        
                    },
                    error: function (xhr, desc, err){
                        $('.agent-register-notify')._error(err.message);  
                    }
                });       
            return false;
        },
        highlight: function(element) {
             $(element).parent("td").addClass("has-error");
        },
        unhighlight: function(element) {
             $(element).parent("td").removeClass("has-error");
        },
        errorPlacement: function(error, element) {
          if(element.hasClass("addonAmt")) {
             // element.css('color','red');
            //error.appendTo( element.parent("div").next("div") );
          }else if(element.hasClass('select2-show-search') && element.next('.select2-container').length) {
             error.insertAfter(element.next('.select2-container'));
         }else{
            error.insertAfter(element);
          }
}

    });
    
     $('body').on('change','#state',function(e){
        let state = $(this).val();
        let stateID = state.split('-');
        $.get(base_url+"/get-cities/"+stateID[0],  function(result) {
            var newdata =result.data;
            $('#city').empty().trigger("change");
            var newState1 = new Option("choose City", "", true, true);
              $("#city").append(newState1); 
              
              jQuery.each(newdata, function (index, item) {
                 var newState = new Option(item['value'], item['id'], true, true);
                $("#city").append(newState);//.trigger('change');
              });
            $('#city').val('').trigger("change");
        },'json');
    });
    
    
    $('body').on('change','#policyFor',function(e){ 
        e.preventDefault();
       let val =  $(this).val();
          if(val!==""){
            $.get(base_url+'/get/list/make/'+val,function(result){
                        let newdata =result.data;
                        $('#vMake').empty().trigger("change");
                        let newState1 = new Option("Choose Make", "", true, true);
                          $("#vMake").append(newState1); 
                           jQuery.each(newdata, function (index, item) {
                             let newState = new Option(item['value'], item['id'], true, true);
                            $("#vMake").append(newState);//.trigger('change');
                          });
                        $('#vMake').val('').trigger("change");
                },'json')
          }else{
              $('#vMake').empty();
          }
    });
    
    $('body').on('change','#vMake',function(e){ 
        e.preventDefault();
       let val =  $(this).val();
       let forv =  $('#policyFor').val();
       if(val!=="" && forv!==""){
        $.get(base_url+'/get/list/model-with-varient/'+val+'/'+forv,function(result){
                    let newdata =result.data;
                    $('#vModel').empty().trigger("change");
                    let newState1 = new Option("Choose Model", "", true, true);
                      $("#vModel").append(newState1); 
                       jQuery.each(newdata, function (index, item) {
                         let newState = new Option(item['value'], item['id'], true, true);
                        $("#vModel").append(newState);//.trigger('change');
                      });
                    $('#vModel').val('').trigger("change");
            },'json')
       }else{
           $('#vModel').empty();
       }
    });
    
    $('body').on('click','.addon-check',function(e){ 
        let _this  = $(this);
        let id = _this.attr('id');
        if(id=='ncbDiscount'){
            if(_this.is(":checked")){
               $('#ncbDiscountPercent').attr('disabled',false);
               $('#ncbDiscountPercent').prop('disabled',false);
            }else{
                $('#ncbDiscountPercent').val('0');
               $('#ncbDiscountPercent').attr('disabled',true);
               $('#ncbDiscountPercent').prop('disabled',true);    
            }
        }
        if(_this.is(":checked")){
            $('#'+id+'Amt').attr('readonly',false);
            $('#'+id+'Amt').prop('readonly',false);
             $('#'+id+'Amt').val('');
             $('#'+id+'Amt').focus();
        }else{
            $('#'+id+'Amt').attr('readonly',true);
            $('#'+id+'Amt').prop('readonly',true);
            $('#'+id+'Amt').val('0.00');
        }
        
    })
});