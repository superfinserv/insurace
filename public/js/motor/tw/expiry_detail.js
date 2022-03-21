  var bikeInfo = [];
$(window).on('load', function(){
  
    if(localStorage.getItem("twInfo")){ 
       twInfo = JSON.parse(localStorage.getItem('twInfo'));
       addedItem = Object.keys(twInfo).length;
       if(addedItem){
           twInfo = JSON.parse(localStorage.getItem('twInfo'));
           
           
           $('#bike-info').text(twInfo.vehicle.brand.name+"-"+twInfo.vehicle.model.name+"("+twInfo.vehicle.varient.name+")");
           $('#othr-info').find('span').text(twInfo.vehicle.fueltype+'-'+twInfo.vehicle.cc+'cc');
            if(twInfo.previousInsurance!==undefined){
           if(twInfo.previousInsurance.isExp!==undefined){
               if(twInfo.previousInsurance.isExp=="Expired"){ 
                      $('#isExp').attr('checked',true);
                       $('#isExp').prop('checked',true);
                   $('.bike_policy_details__expitem').show();
                     if(twInfo.previousInsurance.exp=="+90"){ 
                         $('#defaultChecked').attr('checked',true);
                         $('#defaultChecked').prop('checked',true); 
                     }else if(twInfo.previousInsurance.exp=="45-90"){ 
                          $('#defaultChecked1').attr('checked',true);
                         $('#defaultChecked1').prop('checked',true); 
                     }else if(twInfo.previousInsurance.exp=="-45"){
                         $('#defaultChecked2').attr('checked',true);
                         $('#defaultChecked2').prop('checked',true); 
                     }else{
                         $('#defaultChecked4').attr('checked',true);
                         $('#defaultChecked4').prop('checked',true); 
                     }
                   
               }
           }
          }
           
           
           
       }
    }
});



$('body').on('click','#link-change-v-info',function(e){
    e.preventDefault();
     var  twInfo = JSON.parse(localStorage.getItem('twInfo'));
   $('.elm-right').addClass('elem-overlay');
   $('#ext-v-info').hide();
   $('#change-v-info').show();
   $('#vMake').val(twInfo.vehicle.brand.id+"-"+twInfo.vehicle.brand.name).trigger('change');
})

$(document).on('change', '#vMake', function(e) {
    
    var  twInfo = JSON.parse(localStorage.getItem('twInfo'));
    var make = $(this).val();
    var MK  = make.split("-");
     GetVehicleModel('tw',MK[0],$('#vModel'),twInfo.vehicle.model.id+"-"+twInfo.vehicle.model.name);

});

$(document).on('change', '#vModel', function(e) {
    var  twInfo = JSON.parse(localStorage.getItem('twInfo'));
    var model = $(this).val();
    var MD = model.split("-");
     GetVehicleVarient('tw',MD[0],$('#vVar'),twInfo.vehicle.varient.id+"@"+twInfo.vehicle.varient.name+"@"+twInfo.vehicle.fueltype+"@"+twInfo.vehicle.cc);

});

$(document).on('click', '#cancelChngVinfo', function(e){
    e.preventDefault();
     $('.elm-right').removeClass('elem-overlay');
     $('#change-v-info').hide();
     $('#ext-v-info').show();
});

$(document).on('click', '#updateVinfo', function(e){
    e.preventDefault();
       var  twInfo = JSON.parse(localStorage.getItem('twInfo'));
       var make = $('#vMake').val();
       var MK = make.split("-");
       
       var model = $('#vModel').val();
       var MD = model.split("-");
       
       var varient = $('#vVar').val();
       var VR = varient.split("@");
       
       twInfo.vehicle.brand.id = MK[0]; twInfo.vehicle.brand.name = MK[1];
       twInfo.vehicle.model.id = MD[0]; twInfo.vehicle.model.name = MD[1];
       twInfo.vehicle.varient.id = VR[0]; twInfo.vehicle.varient.name = VR[1];
       twInfo.vehicle.fueltype = VR[2];twInfo.vehicle.cc = VR[3]; 
       localStorage.setItem("twInfo", JSON.stringify(twInfo));  
      
         $('#bike-info').text(MK[1]+"-"+MD[1]+"("+VR[1]+")");
        $('#othr-info').find('span').text(VR[2]+'-'+VR[3]+'cc');
      
      
       $('.elm-right').removeClass('elem-overlay');
       $('#change-v-info').hide();
       $('#ext-v-info').show();
});



$(document).on('click', "input[name='previousInsurerInfo']", function(e) {
    if ($(this).val() == "Expired") {
        $('.bike_policy_details__expitem').show();
    } else {
         $('.pre-insurance-data').show();
         if($("input[name='previous_policy_type']:checked").val()=="TP"){
             $('.on-tp-hide').hide();
         }
         $('.bike_policy_details__expitem').hide();
    }
});

$(document).on('click', "input[name='previous_policy_type']", function(e) {
    if ($(this).val() == "TP") {
        $('.on-tp-hide').hide();
    } else {
         $('.on-tp-hide').show();
    }
});

$(document).on('click change', "input[name='expire_date']", function(e) {
    var val = $("input[name='expire_date']:checked").val();
    if(val === '0') { //if(val === '0' || val=='+90') {
       $('.pre-insurance-data').hide();
    } else {
        $('.pre-insurance-data').show();
    }
        if($("input[name='previous_policy_type']:checked").val()=="TP"){
             $('.on-tp-hide').hide();
         }
});

$(document).ready(function() {
    
  $("#registrationdetailsForm").validate({
    rules: {
        'previousInsurerInfo': {
            required: true,
        },
        'expire_date': {
            required: function(element) {
                if ($("input[name='previousInsurerInfo']:checked").val()==='Expired') {
                    return true;
                } else {
                    return false;
                }
            }
        },
        'claims_type': {
            required: function(element) {
                if($("input[name='previousInsurerInfo']:checked").val()==='Expired' && parseInt($("input[name='expire_date']:checked").val())===0){
                     return false; 
                } else {
                    return true;
                }
            }
        },
        'previous_policy_type': {
            required: function(element) {
                   if($("input[name='previousInsurerInfo']:checked").val()==='Expired' && parseInt($("input[name='expire_date']:checked").val())===0){
                        return false;
                    }else{
                       return true; 
                    }
            }
        },
        
        
    },
    messages: {
        'previousInsurerInfo': {
            required: "2W registration details  is required!",
        },
        'expire_date': {
            required: "Expire days  is required!",
        },
        'claims_type': {
            required: "NCB claims is required!",
        },
        'previous_policy_type': {
            required: "Previous policy type is required!",
        },
        // 'previousinsurer': {
        //     required: "Previous insurer is required!",
        // },
        
        
    },
    errorPlacement: function(error, element) {
        if (element.attr("name") == "previousInsurerInfo") {
            error.appendTo('#errors');
            return;
        }
        if (element.attr("name") == "expire_date") {
            error.appendTo('#errorss');
           console.log('expire_date',error);
            return;
        }
        if (element.attr("name") == "previous_policy_type") {
            error.appendTo('#errors2');
           console.log('previous_policy_type',error);
            return;
        }
        if (element.attr("name") == "previousinsurer") {
            error.appendTo('#errors3');
            console.log('previousinsurer',error);
            return;
        }
        if (element.attr("name") == "claims_type") {
            error.appendTo('#errors4');
            console.log('claims_type',error);
            return;
        }
    },
    submitHandler: function(form) {
        var expire_date = ""; 
        var claims_type="";
        var policyType="";
        var hasPreClaim="";
        var ncb="0";
        var exp="";
        var previousInsurerInfo = $("input[name='previousInsurerInfo']:checked").val();
       
        if (previousInsurerInfo == "Not Expired") {
            var today = new Date();
            var date =  ("0" + (today.getDate())).slice(-2)+'-' +("0" + (today.getMonth() + 1)).slice(-2)+ '-' +  today.getFullYear();
            expire_date = date;
            policyType = $("input[name='previous_policy_type']:checked").val();
            if(policyType=="TP"){
                 ncb="ZERO";
                 hasPreClaim ="YES";
            }else{
                 ncb = ($("input[name='hasPreClaim']:checked").val()=='no')?$("#claimNcb").val():"ZERO";
                 hasPreClaim = $("input[name='hasPreClaim']:checked").val();
            }
           
           
            
        }else if (previousInsurerInfo == "Expired") {
            expire_date = $("input[name='expire_date']:checked").attr('data-date');
            exp = $("input[name='expire_date']:checked").val();
           if(exp!="0"){
              policyType = $("input[name='previous_policy_type']:checked").val();
              hasPreClaim = $("input[name='hasPreClaim']:checked").val();
             if(policyType=="TP"){
                 ncb="ZERO";
                 hasPreClaim ="YES";
            }else{
                 ncb = ($("input[name='hasPreClaim']:checked").val()=='no')?$("#claimNcb").val():"ZERO";
                 hasPreClaim = $("input[name='hasPreClaim']:checked").val();
            }
           }
        } else {
            expire_date = "0";
        }
        
        
               var  twInfo = JSON.parse(localStorage.getItem('twInfo'));
                if(twInfo.previousInsurance!==undefined){
                twInfo.previousInsurance = { 
                           isExp:previousInsurerInfo,
                           expDate:(twInfo.previousInsurance.expDate!=="")?twInfo.previousInsurance.expDate:expire_date,
                           exp:exp,
                           insurer:(twInfo.previousInsurance.insurer!=="")?twInfo.previousInsurance.insurer:"",
                           policyType:policyType,
                           hasPreClaim:hasPreClaim,
                           ncb : ncb,
                           policyNo:(twInfo.previousInsurance.policyNo!=="")?twInfo.previousInsurance.policyNo:""
                   }
        }else{
                twInfo.previousInsurance = { 
                           isExp:previousInsurerInfo,
                           expDate:expire_date,
                           exp:exp,
                           insurer:"",
                           policyType:policyType,
                           hasPreClaim:hasPreClaim,
                           ncb : ncb,
                           policyNo:""
                   }
        }
            localStorage.setItem("twInfo", JSON.stringify(twInfo));
            window.location.href = base_url + "/twowheeler-insurance/plans";
    }
});
});

$(document).on('click', '#backmodelYear', function(e) {
    var twInfo = JSON.parse(localStorage.getItem('twInfo'));
    window.location.href = base_url + "/twowheeler-insurance/variant/" + twInfo.vehicle.model.name;
})