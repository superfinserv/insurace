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
       $("#loginDate").keypress(function(event) {event.preventDefault();});
       $('#startDate').datepicker({
           changeMonth: true,changeYear: true,dateFormat: 'dd/mm/yy'
        });
         $('#endDate').datepicker({
           changeMonth: true,changeYear: true,dateFormat: 'dd/mm/yy'
        });
         $('#loginDate').datepicker({
           changeMonth: true,changeYear: true,dateFormat: 'dd/mm/yy',maxDate: 0
        });
       
     
     $("#HealthInsuredForm").validate({
        rules: {
                'policy_no': { required: true },
                'tranaction_no': { required: false},
                'customer_name':{ required:true},
                'customer_no':{ required:true},
                'loginDate': { required: true },
                //'policyFor':{ required:true},
                'policyType':{ required:true},
                'vMake':{ required:true},
                'vModel':{ required:true},
                'insPartner':{ required:true},
                'startDate':{ required:true},
                'endDate':{ required:true},
                'pospId':{ required:true},
                'total_net':{ required:true,isamt:true},
                'total_tax':{ required:true,isamt:true},
                'total_gross':{ required:true,isamt:true},
                'policyFile':{ required:true},
                'termYear':{ required:true},
                'sumInsured':{ required:true}
            
        },

       submitHandler: function (form) {
             $('.savepolicyInfoBtn').loadButton('on',{ faClass:'fa',faIcon:'fa-spinner', doSpin:true, loadingText:'Submitting...'});
            // $.post(base_url+'/sales/save/new/policy',$(form).serialize(),function(result){
            //      $(".savepolicyInfoBtn").loadButton('off');
            //     if($.trim(result.status)=='success'){
            //       $('.agent-register-notify')._success(result.message);
            //       // $('#agentRegisterInfo')[0].reset();
            //     }else{
            //       $('.agent-register-notify')._error(result.message);  
            //     }
            // },'json')
            var _form = $('#HealthInsuredForm')[0];
            var formData = new FormData(_form);
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
                            $('html, body').animate({ scrollTop: 0 }, 1200);
                            setTimeout(function () {
                               location.reload(true);
                              }, 5000);
                        }else{
                            $('.agent-register-notify')._error(data.message);  
                            $('html, body').animate({ scrollTop: 0 }, 1200);
                        }
                        
                    },
                    error: function (xhr, desc, err){
                        $('.agent-register-notify')._error(err.message);  
                         $('html, body').animate({ scrollTop: 0 }, 1200);
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
    
     $('body').on('change','#insPartner',function(e){
        let partner = $(this).val();
        $.get(base_url+"/get-plans-for-partner/"+partner,  function(result) {
            var newdata =result.data;
            $('#policyPlan').empty().trigger("change");
            var newState1 = new Option("Choose Plan", "", true, true);
              $("#policyPlan").append(newState1); 
              
              jQuery.each(newdata, function (index, item) {
                 var newState = new Option(item['value'], item['id'], true, true);
                $("#policyPlan").append(newState);//.trigger('change');
              });
            $('#policyPlan').val('').trigger("change");
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
    
});