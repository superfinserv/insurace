var twInfo = [];
$(window).on('load', function(){
    if(localStorage.getItem("twInfo")) { 
       twInfo = JSON.parse(localStorage.getItem('twInfo'));
       addedItem = Object.keys(twInfo).length;
    //   if(addedItem){
    //       $('#ownerName').text("").text(twInfo.customer.first_name+". "+twInfo.custome.last_name);
    //       $('#ownerEmail').text("").text(twInfo.customer.email);
    //       $('#ownerMobile').text("").text(twInfo.customer.mobile);
    //       $('#ownerDob').text("").text(twInfo.customer.dob);
    //       $('#ownerGender').text("").text(twInfo.customer.gender);
          
    //       $('#vehicleNo').text("").text(bikeInfo.vehicleInfo.bike_number);
    //       $('#vehicleReg').text("").text(bikeInfo.vehicleInfo.reg_date);
    //       $('#vehicleEngine').text("").text(bikeInfo.vehicleInfo.engine_number);
    //       $('#vehicleChassis').text("").text(bikeInfo.vehicleInfo.chassis_number);
    //       var CITY = bikeInfo.addressInfo.city;
    //       var STATE = bikeInfo.addressInfo.state;
    //       var c = CITY.split("-");
    //       var s = STATE.split("-");
    //       $('#ownerAddress').text("").text(bikeInfo.addressInfo.address);
    //       $('#ownerCity').text("").text((c[1])?c[1]:"-");
    //       $('#ownerState').text("").text((s[1])?s[1]:"-");
    //       $('#ownerPincode').text("").text(bikeInfo.addressInfo.pincode);
          
    //   }
    }
});

$("body").on("click",".readTermsConditions",function() {
            $.dialog({
                    title: 'Terms & Conditions',
                    //titleClass:'tp-title',
                    content: 'url:'+base_url+"/common/terms-and-conditions/car/DIGIT_M",
                    animation: 'scale',
                    columnClass: 'medium',
                    closeAnimation: 'scale',
                    backgroundDismiss: false,
                    closeIcon:true,
                }); 
    })
 $("body").on("click","#paynow_amount",function() {
     if($('#agreeTerms').is(":checked")){
         var loader = '<span class="inline-loader"><span class="inline-loader-box"></span><span class="inline-loader-box"></span><span class="inline-loader-box"></span></span>';
         var enc = $(this).attr('data-enc');
         var _this = $(this);
            _this.attr('disabled',true);
            _this.prop('disabled',true);
         var _html = _this.html();
            _this.html(loader);
        _this.css('height', '45px');
         if($('#payNowForm').length){
             $('#payNowForm').submit();
        }else{
          $.post(base_url + "/car-insurance/connect-to-insurer/",{enc:enc}, function (resp) {
            console.log(resp);
              if($.trim(resp.status)=='success'){
                   if(resp.data!==null){
                      window.location.href=resp.data;
                   }else{
                       _this.html(_html);
                       _this.attr('disabled',false);_this.prop('disabled',false);
                       toastr.error("Unable to connect to insurer try again!..","Error",{positionclass:'toast-bottom-right'});
                   }
              }else{
                  _this.html(_html);_this.attr('disabled',false);_this.prop('disabled',false);
                   toastr.error(resp.message,"Error",{positionclass:'toast-bottom-right'});
               }
               
        });
        }
     }else{
           $( "#effect" ).effect( 'shake', {}, 500, callbackEffect );  
    }
 });
 
//   $("body").on("click","#GenratePaymentLink",function(e) {
//       e.preventDefault();
//         var enc = $(this).attr('data-enc');
//         $.post(base_url + "/moter-insurance/genrate-payment-link/",{enquiryID:enc}, function (resp) {
//               $('.ajax_response').empty();
//               if(resp.status===true){
//                   $('.ajax_response').html(resp.data);
//               }else{
//                   $.toast({
//                       text: resp.message,
//                       showHideTransition: 'slide',
//                       position:'bottom-right',
//                       hideAfter:6000,
//                       allowToastClose:false
//                     });
//               }
               
//         },'json');
//  });

$("body").on("click","#GenratePaymentLink",function(e) {
        e.preventDefault();
        var enc = $(this).attr('data-enc');
        
        
         var loader = 'Sending <span class="inline-loader"><span class="inline-loader-box"></span><span class="inline-loader-box"></span><span class="inline-loader-box"></span></span>';
         var enc = $(this).attr('data-enc');
         var _this = $(this);
         var _html = _this.html();
            _this.attr('disabled',true);
            _this.prop('disabled',true);
         
            _this.html(loader);
        _this.css('height', '45px');
        $.post(base_url + "/moter-insurance/genrate-payment-link/",{enquiryID:enc}, function (resp) {
             
              if(resp.status===true){
                   _this.html(_html);_this.attr('disabled',false);_this.prop('disabled',false);
                   toastr.success(resp.message,"Success",{positionclass:'toast-bottom-right'});
              }else{
                  _this.html(_html); _this.attr('disabled',false);_this.prop('disabled',false);
                  toastr.error(resp.message,"Error",{positionclass:'toast-bottom-right'});
              }
               
        },'json');
});
 
 