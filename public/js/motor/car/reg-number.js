var carInfo = [];
var custInfo =[];
$(window).on('load', function(){
    if(localStorage.getItem("carInfo")) { 
       carInfo = JSON.parse(localStorage.getItem('carInfo'));
      // custInfo  = JSON.parse(localStorage.getItem('customersDetails'));
       addedItem = Object.keys(carInfo).length;
       if(addedItem){
          $('#carnumber').val(carInfo.carnumber);
       }
    }
});

function RedirectToBrands(){
                                             var carnumber = $('#carnumber').val();carnumber= carnumber.toUpperCase();
                 
                                             var regionCode = carnumber.substring(0, 4);regionCode.toUpperCase();
                                             var today = new Date();
                                              
                                             var regYear = today.getFullYear();regYear=regYear.toString();
                                             var regMonth = ("0" + (today.getMonth() + 1)).slice(-2);
                                             var regDate = ("0" + (today.getDate())).slice(-2);
                                             var date   =  ("0" + (today.getDate())).slice(-2)+'-' +("0" + (today.getMonth() + 1)).slice(-2)+ '-' +  today.getFullYear();
                                              carInfo= { 
                                                         type:'CAR',
                                                         planType:'COM',
                                                         vehicle:{ vehicleNumber:carnumber,isBrandNew:"false",hasvehicleNumber:"true",rtoCode:regionCode,
                                                                  regYear:regYear,regMonth:regMonth,regDate:regDate,regDMY:date,policyHolder:'IND'
                                                                },
                                                         subcovers : { isPA_OwnerDriverCover:"true",isPA_UNPassCover:"false",isPA_UNDriverCover:"false", 
                                                                      isLL_PaidDriverCover:"false",isLL_UNPassCover:"false",
                                                                      isLL_EmpCover:"false",isBreakDownAsCover:"false",
                                                                      isPersonalBelongCover:"false",isKeyLockProCover:"false",isTyreProCover:"false",
                                                                      isRetInvCover:"false",isRimProCover:"false",
                                                                      isPartDepProCover:"false",isConsumableCover:"false",
                                                                      isEng_GearBoxProCover:"false",isElecAccCover:"false",isCngKitCover:false,
                                                                      isNonElecAccCover:"false" ,isCashAllowCover:"false"
                                                                      },
                                                        coverValues:{
                                                            PA_UNPassCoverval:10000,partDepCoverval:'0', PA_OwnerDriverCoverval:1
                                                        }
                                                     }
                                            if($('#mobileNumber').length > 0){ 
                                                carInfo.customer ={ mobile:$('#mobileNumber').val()} 
                                            }else{
                                                carInfo.customer ={mobile:custInfo.mobile}   
                                            }
                                             localStorage.setItem("carInfo", JSON.stringify(carInfo));
                                            window.location.href = base_url + "/car-insurance/brand";
}
//$('#carnumber').mask('SS00SS0000');
$(document).ready(function() {
   
        $("#carnumberForm").validate({
            rules: {
                'carnumber': {
                    required: true,
                },
                'mobileNumber': {
                    required:{
                          depends: function(element) {
                               return $('#mobileNumber').length >= 0;
                          }
                    },
                    number:{
                         depends: function(element) {
                               return $('#mobileNumber').length > 0;
                          }
                    },
                },
            },
            messages: {
                'carnumber': {
                    required: "Car number is required!",
                },
            },
            submitHandler: function(form) {
                //console.log(form);
                 var _thisBtn = $('#submitBtn');
                 _thisBtn.html('<i style="font-size:20px;" class="fa fa-circle-o-notch fa-spin"></i>');
                 _thisBtn.prop('disabled',true);_thisBtn.attr('disabled',true);
                 var _isvalid = GetVehicleInfo('CAR',$('#carnumber').val()) 
                                .then(function(response) { 
                                    if(response.status===true){
                                        //console.log(response.data);
                                        var result = response.data;
                                             var carnumber = result.vehicleNumber;carnumber= carnumber.toUpperCase();
                 
                                             var regionCode = carnumber.substring(0, 4);regionCode.toUpperCase();
                                             var today = new Date();
                                              
                                             var regYear  = result.regYear;
                                             var regMonth = result.regMonth;
                                             var regDate  = result.regDate;
                                             var date     = result.regDMY;
                                              carInfo= { 
                                                         type:'CAR',
                                                         planType:'COM',
                                                         vehicle:{ vehicleNumber:carnumber,isBrandNew:"false",hasvehicleNumber:"true",rtoCode:regionCode,
                                                                  regYear:regYear,regMonth:regMonth,regDate:regDate,regDMY:date,policyHolder:'IND',
                                                                  brand:result.brand, model:result.model, varient:result.varient,
                                                                  engineNumber:result.engine,fueltype:result.fueltype,hypothecationAgency:result.rcFinancer,
                                                                  chassisNumber:result.chassis,cc:result.cc,regPincode:result.address.pincode,
                                                                },
                                                         address:result.address,
                                                         subcovers : { isPA_OwnerDriverCover:"true",isPA_UNPassCover:"false",isPA_UNDriverCover:"false", 
                                                                       isLL_PaidDriverCover:"false",isLL_UNPassCover:"false",
                                                                       isLL_EmpCover:"false",isBreakDownAsCover:"false",
                                                                       isPersonalBelongCover:"false",isKeyLockProCover:"false",isTyreProCover:"false",
                                                                       isRetInvCover:"false",isRimProCover:"false",
                                                                       isPartDepProCover:"false",isConsumableCover:"false",
                                                                       isEng_GearBoxProCover:"false",isElecAccCover:"false",isCngKitCover:false,
                                                                       isNonElecAccCover:"false" ,isCashAllowCover:"false"
                                                                      },
                                                        coverValues:{
                                                            PA_UNPassCoverval:10000,partDepCoverval:'0', PA_OwnerDriverCoverval:1
                                                        },
                                                        previousInsurance:result.previousInsurance
                                                     };
                                            if($('#mobileNumber').length > 0){ 
                                                carInfo.customer ={ mobile:$('#mobileNumber').val()} 
                                            }else{
                                                carInfo.customer ={mobile:"",first_name:result.customer.first_name,last_name:result.customer.last_name}   
                                            }
                                             localStorage.setItem("carInfo", JSON.stringify(carInfo));
                                              window.location.href = base_url + "/car-insurance/expiry-detail";
                                            //  setEventLog(carInfo).then(function(rs){ 
                                            //       window.location.href = base_url + "/car-insurance/expiry-detail";
                                            //   });
                                    }else{
                                        
                                            RedirectToBrands();
                                            //  setEventLog(carInfo).then(function(rs){ 
                                            //      window.location.href = base_url + "/car-insurance/brand";
                                            //   });                          
                                                                    
                                }
                              }).fail(function(err) { 
                                    _thisBtn.html('Continue <i style="font-size: 14px;" class="right fa fa-chevron-right "></i>');
                                    _thisBtn.prop('disabled',false);_thisBtn.attr('disabled',false);
                                    RedirectToBrands();
                                     return false;
                                });
            }
        });
});



 

$('body').on("click","#hasNewCar",function(e) {
    
    var hasError = false;
    if($('#mobileNumber').length > 0){ hasError= ($('#mobileNumber').val()!=="")?false:true;  $('#mobileNumber-error').remove(); }
    if(hasError){
        $('#mobileNumber').after('<label id="mobileNumber-error" class="error" for="mobileNumber">Customer mobile number is required!</label>') ;
    }else{
        
         var today = new Date();
         //today.setDate( today.getDate() - 11 );
         var regYear = today.getFullYear();regYear=regYear.toString();
         var regMonth =  (("0" + (today.getMonth() + 1)).slice(-2));
         var regDate  =  (("0" + (today.getDate())).slice(-2));
         var date     =  (("0" + (today.getDate())).slice(-2))+'-' +(("0" + (today.getMonth() + 1)).slice(-2))+ '-' +  today.getFullYear();
                  carInfo= { 
                             type:'CAR',
                             planType:'COM',
                             vehicle:{ vehicleNumber:"",isBrandNew:"true",hasvehicleNumber:"false",rtoCode:"",
                                       regYear:regYear,regMonth:regMonth,regDate:regDate,regDMY:date,policyHolder:'IND'
                                    },
                              subcovers : { isPA_OwnerDriverCover:"true",isPA_UNPassCover:"false",isPA_UNDriverCover:"false", 
                                           isLL_PaidDriverCover:"false",isLL_UNPassCover:"false",
                                           isLL_EmpCover:"false",isBreakDownAsCover:"false",
                                           isPersonalBelongCover:"false",isKeyLockProCover:"false",isTyreProCover:"false",
                                           isRetInvCover:"false",isRimProCover:"false",
                                           isPartDepProCover:"false",isConsumableCover:"false",
                                           isEng_GearBoxProCover:"false",isElecAccCover:"false",isCngKitCover:false,
                                           isNonElecAccCover:"false",isCashAllowCover:"false" 
                                          },
                            coverValues:{
                                PA_UNPassCoverval:10000,partDepCoverval:'0', PA_OwnerDriverCoverval:1
                            }
                         }
              if($('#mobileNumber').length > 0){
                    carInfo.customer ={mobile:$('#mobileNumber').val()} 
              }
      localStorage.setItem("carInfo", JSON.stringify(carInfo));
      window.location.href = base_url + "/car-insurance/registration-location";
    }
});

$('body').on("click","#withoutCarNo",function(e) {
     var hasError = false;
    if($('#mobileNumber').length > 0){ hasError= ($('#mobileNumber').val()!=="")?false:true;  $('#mobileNumber-error').remove(); }
    if(hasError){
        $('#mobileNumber').after('<label id="mobileNumber-error" class="error" for="mobileNumber">Customer mobile number is required!</label>') ;
    }else{
       
       
         var today = new Date();
         var regYear = today.getFullYear();regYear=regYear.toString();
         var regMonth = ("0" + (today.getMonth() + 1)).slice(-2);
         var regDate = ("0" + (today.getDate())).slice(-2);
         var date   =  ("0" + (today.getDate())).slice(-2)+'-' +("0" + (today.getMonth() + 1)).slice(-2)+ '-' +  today.getFullYear();
          carInfo= { 
                     type:'CAR',
                     planType:'COM',
                     vehicle:{ vehicleNumber:"",isBrandNew:"false",hasvehicleNumber:"false",rtoCode:"",
                               regYear:regYear,regMonth:regMonth,regDate:regDate,regDMY:date,policyHolder:'IND'
                            },
                     subcovers : { isPA_OwnerDriverCover:"true",isPA_UNPassCover:"false",isPA_UNDriverCover:"false", 
                                           isLL_PaidDriverCover:"false",isLL_UNPassCover:"false",
                                           isLL_EmpCover:"false",isBreakDownAsCover:"false",
                                           isPersonalBelongCover:"false",isKeyLockProCover:"false",isTyreProCover:"false",
                                           isRetInvCover:"false",isRimProCover:"false",
                                           isPartDepProCover:"false",isConsumableCover:"false",
                                           isEng_GearBoxProCover:"false",isElecAccCover:"false",isCngKitCover:false,
                                           isNonElecAccCover:"false",isCashAllowCover:"false"
                                          },
                            coverValues:{
                                PA_UNPassCoverval:10000,partDepCoverval:'0', PA_OwnerDriverCoverval:1
                            }
                 }
       
       
       if($('#mobileNumber').length > 0){
                    carInfo.customer ={mobile:$('#mobileNumber').val()} 
       }
     localStorage.setItem("carInfo", JSON.stringify(carInfo));
     window.location.href = base_url + "/car-insurance/registration-location";
    }
});
