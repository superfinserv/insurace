  var bikeInfo = [];
$(window).on('load', function(){
  
    if(localStorage.getItem("carInfo")){ 
       carInfo = JSON.parse(localStorage.getItem('carInfo'));
       addedItem = Object.keys(carInfo).length;
       if(addedItem){
           carInfo = JSON.parse(localStorage.getItem('carInfo'));
           
           $('#bike-info').text(carInfo.vehicle.brand.name+"-"+carInfo.vehicle.model.name+"("+carInfo.vehicle.varient.name+")");
           $('#othr-info').find('span').text(carInfo.vehicle.fueltype+'-'+carInfo.vehicle.cc+'cc');
            if(carInfo.previousInsurance!==undefined){
           if(carInfo.previousInsurance.isExp!==undefined){
               if(carInfo.previousInsurance.isExp=="Expired"){ 
                      $('#isExp').attr('checked',true);
                       $('#isExp').prop('checked',true);
                   $('.bike_policy_details__expitem').show();
                     if(carInfo.previousInsurance.exp=="+90"){ 
                         $('#defaultChecked').attr('checked',true);
                         $('#defaultChecked').prop('checked',true); 
                     }else if(carInfo.previousInsurance.exp=="45-90"){ 
                          $('#defaultChecked1').attr('checked',true);
                         $('#defaultChecked1').prop('checked',true); 
                     }else if(carInfo.previousInsurance.exp=="-45"){
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
     var  carInfo = JSON.parse(localStorage.getItem('carInfo'));
   $('.elm-right').addClass('elem-overlay');
   $('#ext-v-info').hide();
   $('#change-v-info').show();
   $('#vMake').val(carInfo.vehicle.brand.id+"-"+carInfo.vehicle.brand.name).trigger('change');
})

$(document).on('change', '#vMake', function(e) {
    
    var  carInfo = JSON.parse(localStorage.getItem('carInfo'));
    var make = $(this).val();
    var MK  = make.split("-");
     GetVehicleModel('car',MK[0],$('#vModel'),carInfo.vehicle.model.id+"-"+carInfo.vehicle.model.name);

});

$(document).on('change', '#vModel', function(e) {
    var  carInfo = JSON.parse(localStorage.getItem('carInfo'));
    var model = $(this).val();
    var MD = model.split("-");
     GetVehicleVarient('car',MD[0],$('#vVar'),carInfo.vehicle.varient.id+"@"+carInfo.vehicle.varient.name+"@"+carInfo.vehicle.fueltype+"@"+carInfo.vehicle.cc);

});

$(document).on('click', '#cancelChngVinfo', function(e){
    e.preventDefault();
     $('.elm-right').removeClass('elem-overlay');
     $('#change-v-info').hide();
     $('#ext-v-info').show();
});

$(document).on('click', '#updateVinfo', function(e){
    e.preventDefault();
       var  carInfo = JSON.parse(localStorage.getItem('carInfo'));
       var make = $('#vMake').val();
       var MK = make.split("-");
       
       var model = $('#vModel').val();
       var MD = model.split("-");
       
       var varient = $('#vVar').val();
       var VR = varient.split("@");
       
       carInfo.vehicle.brand.id = MK[0]; carInfo.vehicle.brand.name = MK[1];
       carInfo.vehicle.model.id = MD[0]; carInfo.vehicle.model.name = MD[1];
       carInfo.vehicle.varient.id = VR[0]; carInfo.vehicle.varient.name = VR[1];
       carInfo.vehicle.fueltype = VR[2];carInfo.vehicle.cc = VR[3]; 
       localStorage.setItem("carInfo", JSON.stringify(carInfo));  
      
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
        $('.bike_policy_details__expitem').hide();
    }
});

$(document).on('click change', "input[name='expire_date']", function(e) {
    var val = $("input[name='expire_date']:checked").val();
    if(val === '0') { //if(val === '0' || val=='+90') {
       $('.pre-insurance-data').hide();
    } else {
        $('.pre-insurance-data').show();
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
            required: "Car registration details  is required!",
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
            var date =  ("0" + (today.getDate() + 1)).slice(-2)+'-' +("0" + (today.getMonth() + 1)).slice(-2)+ '-' +  today.getFullYear();
            expire_date = date;
            policyType = $("input[name='previous_policy_type']:checked").val();
            hasPreClaim = $("input[name='hasPreClaim']:checked").val();
            ncb = ($("input[name='hasPreClaim']:checked").val()=='no')?$("#claimNcb").val():"ZERO";
            
            
        }else if (previousInsurerInfo == "Expired") {
            expire_date = $("input[name='expire_date']:checked").attr('data-date');
            exp = $("input[name='expire_date']:checked").val();
           if(exp!="0"){
              policyType = $("input[name='previous_policy_type']:checked").val();
              hasPreClaim = $("input[name='hasPreClaim']:checked").val();
              ncb = ($("input[name='hasPreClaim']:checked").val()=='no')?$("#claimNcb").val():"ZERO"; 
           }
        } else {
            expire_date = "0";
        }
        var  carInfo = JSON.parse(localStorage.getItem('carInfo'));
        if(carInfo.previousInsurance!==undefined){
                carInfo.previousInsurance = { 
                           isExp:previousInsurerInfo,
                           expDate:(carInfo.previousInsurance.expDate!=="")?carInfo.previousInsurance.expDate:expire_date,
                           exp:exp,
                           insurer:(carInfo.previousInsurance.insurer!=="")?carInfo.previousInsurance.insurer:"",
                           policyType:policyType,
                           hasPreClaim:hasPreClaim,
                           ncb : ncb,
                           policyNo:(carInfo.previousInsurance.policyNo!=="")?carInfo.previousInsurance.policyNo:""
                   }
        }else{
              
                carInfo.previousInsurance = { 
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
        
             
            localStorage.setItem("carInfo", JSON.stringify(carInfo));
            window.location.href = base_url + "/car-insurance/plans";
    }
});
});

$(document).on('click', '#backmodelYear', function(e) {
    var carInfo = JSON.parse(localStorage.getItem('carInfo'));
    window.location.href = base_url + "/car-insurance/variant/" + carInfo.vehicle.model.name;
})