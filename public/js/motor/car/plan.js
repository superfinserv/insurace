$(function(){
    'use strict';
     var loader = '<span class="inline-loader"><span class="inline-loader-box"></span><span class="inline-loader-box"></span><span class="inline-loader-box"></span></span>';
     var currentPlan = "COM";
     var jcModal;
    const planLib = {
           carInfo: JSON.parse(localStorage.getItem('carInfo')),
          digit: function(callTyp){
              var digitCard = $('.plan-card-digit_m');
               if(digitCard.length){
                      digitCard.find('button.btn-netpremiumn').html(loader);
                      digitCard.find('.error-span').remove();
                     var carInfo = JSON.parse(localStorage.getItem('carInfo'));
                     var url =  (callTyp=='recalculate')?"/car-insurance/load-plans-recalculate/":"/car-insurance/load-plans/";
                     $.ajax({
                      url: base_url + url,
                      type: "POST",
                      dataType: "json",
                      data:{supp:'DIGIT',carInfo:carInfo},
                      success: function (data, status, jqXHR) {
                          
                          if($.trim(data.status)=="success"){
                           
                            $('.idv-edit-th').attr('id','open-idv-modal');
                            $('.plan-card-digit_m').show();
                            var result = data.data;
                            
                             digitCard.find('.error-span').remove();   
                            digitCard.removeClass('cart-empty');
                            digitCard.find('a.Premium-Breakup').attr('data-ref',result.id);
                            if(carInfo.planType=="TP"){
                                digitCard.find('h5.idv').hide();
                            }else{
                                digitCard.find('h5.idv').show();
                                digitCard.find('h5.idv').html('IDV:'+result.idv+'/-');
                            }
                            digitCard.find('.column-2').attr('style',"");
                            digitCard.find('.column-3').attr('style',"");
                            if(carInfo.subcovers.isPA_OwnerDriverCover==="true"){ digitCard.find('.paCoverStatus-txt').text('Added');}else{ digitCard.find('.paCoverStatus-txt').text('N/A');}
                            if(carInfo.subcovers.isPartDepProCover==="true"){ digitCard.find('.zeroDepStatus-txt').text("Added");}else{ digitCard.find('.zeroDepStatus-txt').text('N/A');}
                            digitCard.find('button.btn-netpremiumn').attr('data-ref',result.id);
                            digitCard.find('button.btn-netpremiumn').html('<span class="fa fa-inr"></span> '+result.grossamount+' <i style="" class="fa fa-angle-double-right" aria-hidden="true"></i>');
                            digitCard.find('button.btn-netpremiumn').attr('disabled',false);
                            var addon =  result.addons.covers.addons;
                            if( addon.length){
                                var addonHtm = "";
                                $.each(addon, function (adkey, ad) {
                                   addonHtm +='<span class="addon-badge">'+ad.title+'</span>';
                                });
                                
                                $('.digit_m_addon').html(addonHtm);
                            }else{
                               $('.digit_m_addon').empty().text('No addon cover selected');   
                            }
                           
                          }else{
                               $('.plan-card-digit_m').find('.card-body').prepend('<span class="error-span">'+data.message+'</span>');
                               $('.plan-card-digit_m').find('button.btn-netpremiumn').html('0.00').attr('disabled',true);
                          }
                       },
                      error: function (jqXHR, status, err) {
                             $('.plan-card-digit_m').find('.card-body').prepend('<span class="error-span">Error while fetch quote</span>');
                             $('.plan-card-digit_m').find('button.btn-netpremiumn').html('0.00').attr('disabled',true);
                      },
                      complete: function (data,jqXHR, status) {
                        
                      }
                    });
               }
          },
        
          // divide(x,y) method
          hdfcErgo: function(callTyp){
              var hdfcergoCard = $('.plan-card-hdfcergo_m');
              if(hdfcergoCard.length){
                     $('.plan-card-hdfcergo_m').find('button.btn-netpremiumn').html(loader);
                     $('.plan-card-hdfcergo_m').find('.error-span').remove();
                     var carInfo = JSON.parse(localStorage.getItem('carInfo'));
                     var url =  (callTyp=='recalculate')?"/car-insurance/load-plans-recalculate/":"/car-insurance/load-plans/";
                     $.ajax({
                      url: base_url + url,
                      type: "POST",
                      dataType: "json",
                      data:{supp:'HDFCERGO',carInfo:carInfo},
                      success: function (data, status, jqXHR) {
                          if($.trim(data.status)=="success"){
                            $('.idv-edit-th').attr('id','open-idv-modal');
                            $('.plan-card-hdfcergo_m').show();
                            var result = data.data;
                            
                            hdfcergoCard.removeClass('cart-empty');
                            hdfcergoCard.find('a.Premium-Breakup').attr('data-ref',result.id);
                            hdfcergoCard.find('h5.idv').html('IDV:'+result.idv+'/-');
                            hdfcergoCard.find('.column-2').attr('style',"");
                            hdfcergoCard.find('.column-3').attr('style',"");
                            if(carInfo.subcovers.isPA_OwnerDriverCover==="true"){ hdfcergoCard.find('.paCoverStatus-txt').text('Added');}else{ hdfcergoCard.find('.paCoverStatus-txt').text('N/A');}
                            if(carInfo.subcovers.isPartDepProCover==="true"){ hdfcergoCard.find('.zeroDepStatus-txt').text("Added");}else{ hdfcergoCard.find('.zeroDepStatus-txt').text('N/A');}
                            hdfcergoCard.find('button.btn-netpremiumn').attr('data-ref',result.id);
                            hdfcergoCard.find('button.btn-netpremiumn').html('<span class="fa fa-inr"></span> '+result.grossamount+' <i style="" class="fa fa-angle-double-right" aria-hidden="true"></i>');
                            hdfcergoCard.find('button.btn-netpremiumn').attr('disabled',false);
                            var addon =  result.addons.covers.addons;
                            if( addon.length){
                                var addonHtm = "";
                                $.each(addon, function (adkey, ad) {
                                   console.log(ad);
                                   addonHtm +='<span class="addon-badge">'+ad.title+'</span>';
                                });
                                
                                $('.hdfcergo_m_addon').html(addonHtm);
                            }else{
                               $('.hdfcergo_m_addon').empty().text('No addon cover selected');  
                            }
                              
                          }else{
                                 // console.log('hdfcergo_m');
                               $('.plan-card-hdfcergo_m').find('.card-body').prepend('<span class="error-span">'+data.message+'</span>');
                               $('.plan-card-hdfcergo_m').find('button.btn-netpremiumn').html('0.00').attr('disabled',true);
                              //$('.plan-card-digit_m').hide();
                             // toastr.error(data.message, 'HdfcErgo Error!');
                          }
                       },
                      error: function (jqXHR, status, err) {
                             $('.plan-card-hdfcergo_m').find('.card-body').prepend('<span class="error-span">Error while fetch quote</span>');
                             $('.plan-card-hdfcergo_m').find('button.btn-netpremiumn').html('0.00').attr('disabled',true);
                            // toastr.error(err+' while fetch HDFC ERGO Quote', 'Error!')
                      },
                      complete: function (jqXHR, status) {}
                    });
              }
           
          },
          
          fgi: function(callTyp){
               var fgiCard = $('.plan-card-fgi_m');
             if(fgiCard.length){
                $('.plan-card-fgi_m').find('button.btn-netpremiumn').html(loader).attr('disabled',false);
                $('.plan-card-fgi_m').find('button.btn-netpremiumn').html(loader);
                $('.plan-card-fgi_m').find('.error-span').remove();
            
                 var carInfo = JSON.parse(localStorage.getItem('carInfo'));
                 var url =  (callTyp=='recalculate')?"/car-insurance/load-plans-recalculate/":"/car-insurance/load-plans/";
                 $.ajax({
                  url: base_url + url,
                  type: "POST",
                  dataType: "json",
                  data:{supp:'FGI',carInfo:carInfo},
                  success: function (data, status, jqXHR) {
                      var result = data.data;
                      if($.trim(data.status)=="success"){
                        $('.idv-edit-th').attr('id','open-idv-modal');
                        $('.plan-card-fgi_m').show();
                        
                       
                        fgiCard.removeClass('cart-empty');
                        fgiCard.find('a.Premium-Breakup').attr('data-ref',result.id);
                        if(twInfo.planType=="TP"){ fgiCard.find('h5.idv').hide();}else{  fgiCard.find('h5.idv').show(); fgiCard.find('h5.idv').html('IDV:'+result.idv+'/-');}
                        fgiCard.find('.column-2').attr('style',"");
                        fgiCard.find('.column-3').attr('style',"");
                        fgiCard.find('button.btn-netpremiumn').attr('data-ref',result.id);
                        if(twInfo.subcovers.isPA_OwnerDriverCover=="true"){
                           fgiCard.find('span.paCoverStatus-txt').text('Added');
                        }else{
                            fgiCard.find('span.paCoverStatus-txt').text('N/A');
                        }
                        fgiCard.find('button.btn-netpremiumn').html('<span class="fa fa-inr"></span> '+result.grossamount+' <i style="" class="fa fa-angle-double-right" aria-hidden="true"></i>');
                        var addon =  result.addons.covers.addons;
                         if( addon.length){
                            var addonHtm = "";
                            $.each(addon, function (adkey, ad) {
                               
                               addonHtm +='<span class="addon-badge">'+ad.title+'</span>';
                            });
                            
                            $('.fgi_m_addon').html(addonHtm);
                        }else{
                           $('.fgi_m_addon').empty().text('No addon cover selected');  
                        }
                    
                      }else{
                           fgiCard.addClass('cart-empty');
                           $('.plan-card-fgi_m').find('.card-body').prepend('<span class="error-span">'+data.message+'</span>');
                           $('.plan-card-fgi_m').find('button.btn-netpremiumn').html('0.00').attr('disabled',true);
                          
                      }
                   },
                  error: function (jqXHR, status, err) {
                        
                       $('.plan-card-fgi_m').find('.card-body').prepend('<span class="error-span">Error while fetch quote</span>');
                       $('.plan-card-fgi_m').find('button.btn-netpremiumn').html('0.00').attr('disabled',true);
                        
                      
                  },
                  complete: function (jqXHR, status) {}
                });
              }
           
          }
          
        
        };
        
    const configSetting={
            coverSetup:function(cover){
                 var carInfo = JSON.parse(localStorage.getItem('carInfo'));
                  currentPlan = cover;
                 if(cover=='TP'){
                        carInfo.vehicle.idv = "10000";
                        carInfo.subcovers.isBreakDownAsCover="false";
                        carInfo.subcovers.isTyreProCover="false";
                        carInfo.subcovers.isPartDepProCover="false";
                        carInfo.subcovers.isConsumableCover="false";
                        carInfo.subcovers.isEng_GearBoxProCover="false";
                        carInfo.subcovers.isRetInvCover="false";
                        carInfo.subcovers.isRimProCover="false";
                        carInfo.subcovers.isCashAllowCover="false";
                        $('.cardIdvSet').hide();
                        $('.moter-OD').prop('checked',false);$('.moter-OD').attr('checked',false);
                        $('.com-cover').prop("disabled", false); $(".com-cover").attr("disabled", false);
                        $('.moter-OD').prop("disabled", true); $(".moter-OD").attr("disabled", true);
                        $('.access-cover').prop("disabled", true); $(".access-cover").attr("disabled", true);
                        $('#zero-dep-elem').hide();
                        $('#ODdetails').hide();
                         $('.TPCovers').show();
                    }else if(cover=='SAOD'){
                           $('.cardIdvSet').show();
                           $('#ODdetails').show();
                           $('.com-cover').prop("checked", false); $(".com-cover").attr("checked", false);
                           $('.moter-OD').prop("disabled", false); $(".moter-OD").attr("disabled", false);
                           $('.com-cover').prop("disabled", true); $(".com-cover").attr("disabled", true);
                           $('.access-cover').prop("disabled", false); $(".access-cover").attr("disabled", false);
                          
                            carInfo.subcovers.isPA_UNPassCover="false";
                            carInfo.subcovers.isPA_UNDriverCover="false";
                            carInfo.subcovers.isLL_PaidDriverCover="false";
                            carInfo.subcovers.isLL_UNPassCover="false";
                            carInfo.subcovers.isLL_EmpCover="false";
                            carInfo.subcovers.isPA_OwnerDriverCover = "false";
                            $("#isPA_OwnerDriverCover").prop("checked", false);$("#isPA_OwnerDriverCover").attr("checked", false);
                            $("#notPA_OwnerDriverCover").prop("checked", true);$("#notPA_OwnerDriverCover").attr("checked", true);
                            $('.PACover').prop("disabled", true); $(".PACover").attr("disabled", true);
                            
                            $('.TPCovers').hide();
                    }else{
                         $('.cardIdvSet').show();
                         $('.com-cover').prop("disabled", false); $(".com-cover").attr("disabled", false);
                         $('.moter-OD').prop("disabled", false); $(".moter-OD").attr("disabled", false);
                         $('.access-cover').prop("disabled", false); $(".access-cover").attr("disabled", false);
                         $('#ODdetails').hide();
                         $('#isPA_OwnerDriverCover').prop('checked',true);$('#isPA_OwnerDriverCover').attr('checked',true);
                         $('.PACover').prop('disabled',false);$('.PACover').attr('disabled',false);
                          $('.TPCovers').show();
                    }
                    
                    if(carInfo.vehicle.policyHolder=="COR"){
                        carInfo.subcovers.isPA_OwnerDriverCover = "false";
                        $("#isPA_OwnerDriverCover").prop("checked", false);$("#isPA_OwnerDriverCover").attr("checked", false);
                        $("#notPA_OwnerDriverCover").prop("checked", true);$("#notPA_OwnerDriverCover").attr("checked", true);
                        $('.PACover').prop("disabled", true); $(".PACover").attr("disabled", true);
                    }else{
                        if(cover!='SAOD'){
                            carInfo.subcovers.isPA_OwnerDriverCover = "true";
                            $("#isPA_OwnerDriverCover").prop("checked", true);$("#isPA_OwnerDriverCover").attr("checked", true);
                            $("#notPA_OwnerDriverCover").prop("checked", false);$("#notPA_OwnerDriverCover").attr("checked", false);
                            $('.PACover').prop("disabled", false); $(".PACover").attr("disabled", false);
                        }
                    }
                    localStorage.setItem("carInfo", JSON.stringify(carInfo));
                   
        },
            addonsHandler:function(){
                 carInfo = JSON.parse(localStorage.getItem('carInfo'));
                 if(carInfo.vehicle.isBrandNew=="true"){ 
                     if(carInfo.subcovers.isPA_OwnerDriverCover=="true"){ 
                        $('#pa-owner-driver-elem').show();
                     }
                     
                    // $('.return-to-invoice-elem').show();
                 }else{
                    // $('.return-to-invoice-elem').hide(); 
                 }
                 
                  $.each(carInfo.subcovers, function(key, value) {
                      if(key!=="isPA_OwnerDriverCover"){
                            if(value=='true'){
                               $("#"+key).prop("checked", true);$("#"+key).attr("checked", true);
                               if(key=='isPartDepProCover'){
                                   $('#zero-dep-elem').show();
                               }else if(key=="isPA_UNPassCover"){
                                   $('#pa-unnamed-passanger-elem').show();
                               }
                            }else{
                               $("#"+key).prop("checked", false);$("#"+key).attr("checked", false);  
                               if(key=='isPartDepProCover'){
                                  $('#zero-dep-elem').hide();
                               }else if(key=="isPA_UNPassCover"){
                                  $('#pa-unnamed-passanger-elem').hide();
                               }
                            }
                      }
                    });
                
            }
    }
  
    var carInfo =[];
    if(localStorage.getItem("carInfo")){ 
      carInfo = JSON.parse(localStorage.getItem('carInfo'));
        $('#span-make_name').text(carInfo.vehicle.brand.name);
        $('#span-make_name').parent('a').attr('href',base_url+'/car-insurance/brand');
        
        $('#span-model_name').text(carInfo.vehicle.model.name);
        $('#span-model_name').parent('a').attr('href',base_url+'/car-insurance/model/'+carInfo.vehicle.model.name);
         
        $('#span-varient_name').text(carInfo.vehicle.varient.name);
        $('#span-model_name').parent('a').attr('href',base_url+'/car-insurance/variant/'+carInfo.vehicle.varient.name);
        
        
        $('#span-regYear').text(carInfo.vehicle.regYear);
        $('#span-FuleType').text(carInfo.vehicle.fueltype);
        $('#span-RTO').text(carInfo.vehicle.rtoCode);
        $("#planType").val(carInfo.planType);
        // carInfo.subcovers.isPA_OwnerDriverCover ='true';
        //  $("#isPA_OwnerDriverCover").prop("checked", true);$("#isPA_OwnerDriverCover").attr("checked", true);
        //  $("#notPA_OwnerDriverCover").prop("checked", false);$("#notPA_OwnerDriverCover").attr("checked", false); 
        // if(carInfo.vehicle.policyHolder=="COR"){
        //     carInfo.subcovers.isPA_OwnerDriverCover ='false';
            
        // }
        // localStorage.setItem("carInfo", JSON.stringify(carInfo));
        configSetting.coverSetup(carInfo.planType);
        configSetting.addonsHandler();
        
        planLib.digit('first-call');
        planLib.hdfcErgo('first-call');
        planLib.fgi('first-call');
    }
    
    
    function TPModal(preCover){
        var carInfo = JSON.parse(localStorage.getItem('carInfo'));
        var preCover =  carInfo.previousInsurance.policyType;
       jcModal = $.dialog({
                    title: 'Just few details to go...',
                    titleClass:'tp-title',
                    content: 'url:'+base_url+"/moter-insurance/load-tp-details-modal/car/"+preCover,
                    animation: 'scale',
                    columnClass: 'medium',
                    closeAnimation: 'scale',
                    backgroundDismiss: false,
                    closeIcon:true,
                    onContentReady: function(){
                        
                        //console.log(carInfo.TP);
                         if(carInfo.TP){
                             if(carInfo.TP.TPstatus=='NO'){
                                 $('#TPstatusNExp').prop('checked', true);$('#TPstatusNExp').attr('checked', true);
                             }else{
                                 $('#TPstatusExp').prop('checked', true);$('#TPstatusExp').attr('checked', true);
                             }
                             
                             $('#TPInsurer').val(carInfo.TP.TPInsurer).trigger('change');
                             $('#TP_policyno').val(carInfo.TP.TP_policyno);
                             $('#TPpolicyStartDate').val(carInfo.TP.TPpolicyStartDate);
                             $('#TPpolicyEndDate').val(carInfo.TP.TPpolicyEndDate);
                             $('#prePolicyType').val(carInfo.TP.prePolicyType);
                         }
                        $('.jconfirm-content').css('overflow','hidden');
                        $('.tp-title').css({'color':'#AC0F0B','border-bottom':'1px solid #ccc','margin-bottom':'6px','line-height': '10px',});
                        //$("#TpDetailsForm").validate();
                    },
                     onClose: function () {
                         //console.log('close - tp modal');
                        //carInfo.TP  = formData;
                       //carInfo.planType = "SAOD";
                       // currentPlan = "SAOD";
                        $('.planType').val(currentPlan); 
                       // localStorage.setItem("carInfo", JSON.stringify(carInfo)); 
                     },
                });  
    }
    
    
     $('body').on('submit','#TpDetailsForm',function(e){
      e.preventDefault();
        $("#TpDetailsForm").validate();
        $('#TPInsurer').rules("add",  {required: true });
        $('#TPInsurer').rules("add",  {required: true });
        $('#TP_policyno').rules("add", {required: true});
        $('#TPpolicyStartDate').rules("add", {required: true,});
        $('#TPpolicyEndDate').rules("add", {required: true});
        $('#prePolicyType').rules("add", {required: true});
        
        if($('#TpDetailsForm').valid() === true) {
            var formData = $('#TpDetailsForm').serializeObject();
            var carInfo = JSON.parse(localStorage.getItem('carInfo'));
            carInfo.TP  = formData;
            //carInfo.previousInsurance.expDate = formData.TPpolicyEndDate; 
            carInfo.previousInsurance.insurer = formData.TPInsurer; 
            carInfo.previousInsurance.policyNo = formData.TP_policyno;
            carInfo.planType = "SAOD";
            currentPlan = "SAOD";
            localStorage.setItem("carInfo", JSON.stringify(carInfo));
            configSetting.coverSetup(currentPlan);
            
            jcModal.close();
            $('#ODdetails').show();
             planLib.digit('firstCall');
             planLib.hdfcErgo('firstCall');
             planLib.fgi('firstCall');
        }
    });
    
    $('body').on('click','#ODdetails',function() {
         
          TPModal();
    })
    $('body').on('change','.planType',function() {
        var cover = $(this).val(); 
        var carInfo = JSON.parse(localStorage.getItem('carInfo'));
            
            if(cover=="SAOD"){
                TPModal();
            }else{
               currentPlan =  cover;// Manage Current plan in case SOAD.
               carInfo.planType = cover;
               localStorage.setItem("carInfo", JSON.stringify(carInfo));
               configSetting.coverSetup(cover);
               planLib.digit('firstCall');
               planLib.hdfcErgo('firstCall');
               planLib.fgi('firstCall');
            }
            // if(cover=='SAOD'){
            //   // if(typeof(carInfo.TP)!= "undefined" && carInfo.TP!== null) { loadPlans('firstCall'); }else{TPModal();}
            // }else{
               
            // }
           
        
    });
    
     $('body').on('click','.PACover',function(e) {
             carInfo = JSON.parse(localStorage.getItem('carInfo'));
             var isPACover = ($("input[name='PA_OwnerDriverCover']:checked").val()==1)?"true":"false";
             console.log(isPACover)
             if(carInfo.vehicle.isBrandNew=="true"){ 
                 if(isPACover=="true"){ 
                      $('#pa-owner-driver-elem').show();
                 }else{
                     $('#pa-owner-driver-elem').hide();
                 }
             }
            carInfo.subcovers.isPA_OwnerDriverCover =isPACover;
             carInfo.coverValues.PA_OwnerDriverCoverval =1;
            localStorage.setItem("carInfo", JSON.stringify(carInfo));
             planLib.digit('recalculate');
             planLib.hdfcErgo('recalculate');
             planLib.fgi('recalculate');
     });
     
     $('body').on('click','#btn-pa-owner-driver',function() {
        carInfo = JSON.parse(localStorage.getItem('carInfo'));
        var val = $('#pa-owner-driver-value').val();
        // var isPACover = ($("input[name='PA_OwnerDriverCover']:checked").val()==1)?"true":"false";
        // carInfo.subcovers.isPA_OwnerDriverCover =isPACover;
        carInfo.coverValues.PA_OwnerDriverCoverval = val;
        localStorage.setItem("carInfo", JSON.stringify(carInfo));
        planLib.digit('recalculate');
        planLib.hdfcErgo('recalculate');
        planLib.fgi('recalculate');
    })
     
     // PA UNNAMED
     $('body').on('click','.pa-unnamed',function(e) {
        carInfo = JSON.parse(localStorage.getItem('carInfo'));
        var name = $(this).attr('data-name');
        if ($(this).is(":checked")) { 
            $('#'+name+'-elem').show();
        }else{
             $('#'+name+'-elem').hide();
             var isPA_UNPassCover=($('input[name=isPA_UNPassCover]:checked').val()==1)?"true":"false"; 
             carInfo.subcovers.isPA_UNPassCover =  isPA_UNPassCover;
             localStorage.setItem("carInfo", JSON.stringify(carInfo));
             planLib.digit('recalculate');
             planLib.hdfcErgo('recalculate');
             planLib.fgi('recalculate');
        }
        
     });
     
     $('body').on('click','#btn-pa-unnamed-passanger',function() {
        carInfo = JSON.parse(localStorage.getItem('carInfo'));
        var val = $('#pa-unnamed-passanger-value').val();
        var isPA_UNPassCover=($('input[name=isPA_UNPassCover]:checked').val()==1)?"true":"false"; 
        carInfo.subcovers.isPA_UNPassCover =  isPA_UNPassCover;
        carInfo.coverValues.PA_UNPassCoverval = val;
        localStorage.setItem("carInfo", JSON.stringify(carInfo));
        planLib.digit('recalculate');
        planLib.hdfcErgo('recalculate');
        planLib.fgi('recalculate');
    })
    
    //Zero Dep
     $('body').on('click','.addonZeroDepCover',function() { 
         var elemName = $(this).attr('data-name');
         carInfo = JSON.parse(localStorage.getItem('carInfo'));
         if(carInfo.vehicle.isBrandNew=="false"){
             if($('#isPartDepProCover').is(":checked")){ 
                  $.confirm({
                    title: 'Confirm!',
                    titleClass:'zerodep-title',
                    type:'red',
                    content: '<h4 style="font-size: 13px;color: red;">Do you have Zero Depreciation cover in your Previous policy?</h4>',
                    btnClass: 'btn-red',
                    buttons: {
                        yes: {
                            text: 'Yes',
                            btnClass: 'btn-green',
                            action: function(){
                                $('#'+elemName+'-elem').show();
                              carInfo = JSON.parse(localStorage.getItem('carInfo'));
                              carInfo.subcovers.isPartDepProCover =  "true";
                              carInfo.coverValues.partDepCoverval = "2";
                              localStorage.setItem("carInfo", JSON.stringify(carInfo));
                              planLib.digit('recalculate'); 
                              planLib.hdfcErgo('recalculate');
                              planLib.fgi('recalculate');
                                
                            }
                        },
                        no: {
                            text: 'No',
                            btnClass: 'btn-red',
                            action: function(){
                              $("#isPartDepProCover").prop("checked", false);$("#isPartDepProCover").attr("checked", false);
                              $('#'+elemName+'-elem').hide();
                            }
                        }
                       
                    }
                });
             }else{
                carInfo = JSON.parse(localStorage.getItem('carInfo'));
                carInfo.subcovers.isPartDepProCover = "false";
                localStorage.setItem("carInfo", JSON.stringify(carInfo));
                 $('#'+elemName+'-elem').hide();
                planLib.digit('recalculate');
                planLib.hdfcErgo('recalculate');
                 planLib.fgi('recalculate');
             }
         }else{
            carInfo = JSON.parse(localStorage.getItem('carInfo'));
             if($('#isPartDepProCover').is(":checked")){ 
              carInfo.subcovers.isPartDepProCover =  "true";
                $('#'+elemName+'-elem').show();
              carInfo.coverValues.partDepCoverval = "2";
             }else{
                  $('#'+elemName+'-elem').hide();
                 carInfo.subcovers.isPartDepProCover =  "false";
             }
              localStorage.setItem("carInfo", JSON.stringify(carInfo));
              
              planLib.digit('recalculate'); 
              planLib.hdfcErgo('recalculate');
               planLib.fgi('recalculate');
         }
         
     });
     
    //  $('body').on('click','#btn-zero-dep-claim',function() {
    //     carInfo = JSON.parse(localStorage.getItem('carInfo'));
    //     var val = $('#zero-dep-value').val();
    //     var isPartDepProCover=($('input[name=isPartDepProCover]:checked').val()==1)?"true":"false"; 
    //     carInfo.subcovers.isPartDepProCover =  isPartDepProCover;
    //     carInfo.coverValues.partDepCoverval = val;
    //     localStorage.setItem("carInfo", JSON.stringify(carInfo));
    //     planLib.digit('recalculate');
    //     //planLib.hdfcErgo('recalculate');
   // });
    
    $('body').on('click','.addonCover',function(e) {
        var isPA_OwnerDriverCover =  ($('input[name=PA_OwnerDriverCover]:checked').val()==1)?"true":"false"; 
        var isPA_UNPassCover=  ($('input[name=isPA_UNPassCover]:checked').val()==1)?"true":"false"; 
        var isPA_UNDriverCover=  ($('input[name=isPA_UNDriverCover]:checked').val()==1)?"true":"false"; 
        var isLL_PaidDriverCover =  ($('input[name=isLL_PaidDriverCover]:checked').val()==1)?"true":"false"; 
        var isLL_UNPassCover =  ($('input[name=isLL_UNPassCover]:checked').val()==1)?"true":"false"; 
        var isLL_EmpCover =  ($('input[name=isLL_EmpCover]:checked').val()==1)?"true":"false"; 
        //console.log("isPA_OwnerDriverCover",isPA_OwnerDriverCover);
        var isBreakDownAsCover=($('input[name=isBreakDownAsCover]:checked').val()==1)?"true":"false"; 
        var isTyreProCover=($('input[name=isTyreProCover]:checked').val()==1)?"true":"false";
        var isPartDepProCover=($('input[name=isPartDepProCover]:checked').val()==1)?"true":"false"; 
        
        if($(this).attr('id')=="isPartDepProCover"){
            carInfo.coverValues.partDepCoverval = "0";
        }
        
        var isConsumableCover=($('input[name=isConsumableCover]:checked').val()==1)?"true":"false"; 
        var isEng_GearBoxProCover=($('input[name=isEng_GearBoxProCover]:checked').val()==1)?"true":"false"; 
        var isRetInvCover=($('input[name=isRetInvCover]:checked').val()==1)?"true":"false"; 
        var isRimProCover=($('input[name=isRimProCover]:checked').val()==1)?"true":"false"; 
        var isPersonalBelongCover=($('input[name=isPersonalBelongCover]:checked').val()==1)?"true":"false"; 
        var isKeyLockProCover=($('input[name=isKeyLockProCover]:checked').val()==1)?"true":"false"; 
        var isCashAllowCover = ($('input[name=isCashAllowCover]:checked').val()==1)?"true":"false"; 
          
        // var isCngKitCover=($('input[name=isCngKitCover]:checked').val()==1)?"true":"false";
        // var isElecAccCover=($('input[name=isElecAccCover]:checked').val()==1)?"true":"false"; 
        // var isNonElecAccCover=($('input[name=isNonElecAccCover]:checked').val()==1)?"true":"false";
        
        
        carInfo = JSON.parse(localStorage.getItem('carInfo'));
       
        carInfo.subcovers.isPA_OwnerDriverCover = isPA_OwnerDriverCover;
        carInfo.subcovers.isPA_UNPassCover = isPA_UNPassCover;
        carInfo.subcovers.isPA_UNDriverCover = isPA_UNDriverCover;
        carInfo.subcovers.isLL_PaidDriverCover = isLL_PaidDriverCover;
        carInfo.subcovers.isLL_UNPassCover = isLL_UNPassCover;
        carInfo.subcovers.isLL_EmpCover = isLL_EmpCover;
        
        carInfo.subcovers.isBreakDownAsCover=isBreakDownAsCover;
        carInfo.subcovers.isTyreProCover=isTyreProCover;
        carInfo.subcovers.isPartDepProCover=isPartDepProCover;
        carInfo.subcovers.isConsumableCover=isConsumableCover;
        carInfo.subcovers.isEng_GearBoxProCover=isEng_GearBoxProCover;
        carInfo.subcovers.isRetInvCover=isRetInvCover;
        carInfo.subcovers.isRimProCover=isRimProCover;
        carInfo.subcovers.isPersonalBelongCover=isPersonalBelongCover;
        carInfo.subcovers.isKeyLockProCover=isKeyLockProCover;
        carInfo.subcovers.isCashAllowCover=isCashAllowCover;
        
        // carInfo.subcovers.isCngKitCover=isCngKitCover;
        // carInfo.subcovers.isElecAccCover=isElecAccCover;
        // carInfo.subcovers.isNonElecAccCover=isNonElecAccCover;
        
        
        localStorage.setItem("carInfo", JSON.stringify(carInfo));
       planLib.digit('recalculate');
       planLib.hdfcErgo('recalculate');
        planLib.fgi('recalculate');  
    });
    
    $('body').on('click','.Premium-Breakup', function(e){
        e.preventDefault();
        var ref = $(this).attr('data-ref');
           $.dialog({
                title: '',
                content: 'url:'+base_url+"/moter-insurance/load-moter-premium/breakup-modal/quote/"+ref,
                animation: 'scale',
                columnClass: 'medium',
                closeAnimation: 'scale',
                backgroundDismiss: true,
            });
    });
    
    var idvModal ="";
    $('body').on('click','#open-idv-modal', function(){
       idvModal =  $.dialog({
            title: '',
            content: 'url:'+base_url+"/moter-insurance/load-idv-modal/CAR/token",
            animation: 'scale',
            columnClass: 'medium',
            closeAnimation: 'scale',
            backgroundDismiss: true,
            onContentReady: function () { 
                // var carInfo = JSON.parse(localStorage.getItem('carInfo'));
                 
                // if(carInfo.vehicle.idv.value!==undefined){
                //     $('#idvRange').val(carInfo.vehicle.idv.value);
                //     $('#inputIdvValue').val(carInfo.vehicle.idv.value)
                // }
            }
        });
    });
     
     
     $('body').on('click','.idvRadio', function(){
        
        var val = $('input[name=idvRadio]:checked').val();
        if(val=='LOWEST'){
            var min = $('#idvRange').attr('min');
            $('#inputIdvValue').val(min);
             $("#idvRange").val(min );
            
        }
    });
   
    
    $('body').on('keyup','#inputIdvValue', function(){
        var val = parseInt($(this).val());
        var min = parseInt($('#idvRange').attr('min'));
        var max = parseInt($('#idvRange').attr('max'));
        
        $("#idvlowest").prop("checked", false);
        $("#idvown").prop("checked", true);
        if(val>=min && val<=max){
           $('#error-text').text("");
        }else{
        
           $('#error-text').text("Idv value should me in range.");
           return false;
        }
        
    });
  
    $('body').on('click','.btn-update-idv', function(){
       $('#error-text').text("");
       var valid = false;
       var carInfo = JSON.parse(localStorage.getItem('carInfo'));
       var val = $('input[name=idvRadio]:checked').val();
       var min = parseInt($('#idvRange').attr('min'));
       var max = parseInt($('#idvRange').attr('max'));
       var input = parseInt($('#inputIdvValue').val());
       if(val=='LOWEST'){ 
           carInfo.vehicle.idv = { isLowest:"YES",value:min}
           $('#IdvCurrentValue').text("Lowest price");
           valid = true;
       }else{
           if(input>=min && input<=max){
               $('#error-text').text("");
               carInfo.vehicle.idv = { isLowest:"NO",value:$('#inputIdvValue').val()}
               $('#IdvCurrentValue').text("₹"+$('#inputIdvValue').val());
               valid = true;
            }else{
               $('#error-text').text("Idv value should me in range.");
               valid = false;
            }
           
       }
        if(valid){
           localStorage.setItem("carInfo", JSON.stringify(carInfo));
           idvModal.close();
           planLib.digit('recalculate');
           planLib.hdfcErgo('recalculate');
            planLib.fgi('recalculate');       
        }
    });
    
    $('body').on('click','.addonAssCover',function(e) {
          var carInfo = JSON.parse(localStorage.getItem('carInfo'));
          var isCngKitCover=($('input[name=isCngKitCover]:checked').val()==1)?"true":"false";
          var isElecAccCover=($('input[name=isElecAccCover]:checked').val()==1)?"true":"false"; 
          var isNonElecAccCover=($('input[name=isNonElecAccCover]:checked').val()==1)?"true":"false";
          var ID  = $(this).attr('id');
            if($(this).is(":checked")){ 
               $('#'+ID+'-elem').show();
               $('#'+ID+'-txt-val').show();
               loadAdssCover(ID);
               if(ID=="isCngKitCover"){
                    carInfo.subcovers.isCngKitCover="true";
                    carInfo.coverValues.cngCoverVal = $( "#slider-range-cng" ).slider( "value");
               }
               if(ID=="isElecAccCover"){
                    carInfo.subcovers.isElecAccCover="true";
                    carInfo.coverValues.elecCoverVal = $( "#slider-range-electric" ).slider( "value");
               }
               if(ID=="isNonElecAccCover"){
                    carInfo.subcovers.isNonElecAccCover="true";
                    carInfo.coverValues.nonElecCoverVal = $( "#slider-range-nonelectric" ).slider( "value");
               }
                localStorage.setItem("carInfo", JSON.stringify(carInfo));
                planLib.digit('recalculate');
                planLib.hdfcErgo('recalculate');
                   planLib.fgi('recalculate');
            }else{
                carInfo.subcovers.isCngKitCover=isCngKitCover;
                carInfo.subcovers.isElecAccCover=isElecAccCover;
                carInfo.subcovers.isNonElecAccCover=isNonElecAccCover;
                localStorage.setItem("carInfo", JSON.stringify(carInfo));
                planLib.digit('recalculate');
                planLib.hdfcErgo('recalculate');
                   planLib.fgi('recalculate');
                $('#'+ID+'-elem').hide();
                $('#'+ID+'-txt-val').hide();
            }
            
                
          
      })
    
    $('body').on('click','.selectPlan',function(e) {
         e.preventDefault();
         var id = $(this).attr('data-ref');
          var provider = $(this).attr('data-provider');
          var _this = $(this);
          _this.attr('disabled',true);
          _this.prop('disabled',true);
          var _html = _this.html();
          _this.html(loader);
           var carInfo = JSON.parse(localStorage.getItem('carInfo'));
          $.post(base_url + "/car-insurance/create-enquiry/",{provider:provider,id:id,carInfo:carInfo}, function (resp) {
             var status = $.trim(resp.status);
             if(status=='success'){
                var encId = resp.data.enq;
                window.location.href=base_url+"/car-insurance/users-information/"+encId;
             }else{
                _this.attr('disabled',false);
                _this.prop('disabled',false);
                _this.html(_html);
                toastr.error(resp.message, 'Error!');
             }
          },'json').fail(function() {
                _this.attr('disabled',false);
                _this.prop('disabled',false);
                _this.html(_html);
                toastr.error("Internal Server error.", 'Error!');
          });
     });
   

    $( "#slider-range-cng" ).slider({
      range: "min",
      value: 100,
      min: 100,
      max: 1000,
      step:500,
      slide: function( event, ui ) {
        $( "#isCngKitCover-txt-val" ).text( "₹"+ ui.value );
      },
      stop: function( event, ui ) {
        $( "#isCngKitCover-txt-val" ).text( "₹"+ ui.value );
        var carInfo = JSON.parse(localStorage.getItem('carInfo'));
        carInfo.subcovers.isCngKitCover="true";
       carInfo.coverValues.cngCoverVal = ui.value;
        localStorage.setItem("carInfo", JSON.stringify(carInfo));
        planLib.digit('recalculate');
        planLib.hdfcErgo('recalculate');
           planLib.fgi('recalculate');
      }
    });
   // $( "#isCngKitCover-txt-val" ).text( "₹" + $( "#slider-range-cng" ).slider( "value" ) );
    
    
    $( "#slider-range-electric" ).slider({
      range: "min",
      value: 100,
      min: 100,
      max: 700,
      step:500,
      slide: function( event, ui ) {
        $( "#isElecAccCover-txt-val" ).text( "₹"+ ui.value );
      },
      stop: function( event, ui ) {
        $( "#isElecAccCover-txt-val" ).text( "₹"+ ui.value );
        var carInfo = JSON.parse(localStorage.getItem('carInfo'));
        carInfo.subcovers.isElecAccCover="true";
        carInfo.coverValues.elecCoverVal = ui.value;
        localStorage.setItem("carInfo", JSON.stringify(carInfo));
        planLib.digit('recalculate');
        planLib.hdfcErgo('recalculate');
           planLib.fgi('recalculate');
      }
    });
  //  $( "#isElecAccCover-txt-val" ).text( "₹" + $( "#slider-range-electric" ).slider( "value" ) );
    
     
    $( "#slider-range-nonelectric" ).slider({
      range: "min",
      value: 100,
      min: 100,
      max: 700,
      step:500,
      slide: function( event, ui ) {
        $( "#isNonElecAccCover-txt-val" ).text( "₹"+ ui.value );
      },
      stop: function( event, ui ) {
        $( "#isNonElecAccCover-txt-val" ).text( "₹"+ ui.value );
        var carInfo = JSON.parse(localStorage.getItem('carInfo'));
        carInfo.subcovers.isNonElecAccCover="true";
        carInfo.coverValues.nonElecCoverVal = ui.value;
        localStorage.setItem("carInfo", JSON.stringify(carInfo));
        planLib.digit('recalculate');
        planLib.hdfcErgo('recalculate');
           planLib.fgi('recalculate');
      }
    });
   // $( "#isNonElecAccCover-txt-val" ).text( "₹" + $( "#slider-range-nonelectric" ).slider( "value" ) );
    
    
     
    
  } );
  
  function loadAdssCover(cover){
      var deviceToken = localStorage.getItem('deviceToken');
      $.get(base_url + "/commomn/load-min-max-value/car/"+deviceToken, function (resp) {
           if(cover=="isCngKitCover"){
             $("#slider-range-cng").slider("option", "min", resp.cng.min);
             $("#slider-range-cng").slider("option", "max", resp.cng.max); 
             $("#slider-range-cng").slider("option", "value", resp.cng.min);
             $( "#isCngKitCover-txt-val" ).text( "₹"+ resp.cng.min);
           }
            if(cover=="isElecAccCover"){
              $("#slider-range-electric").slider("option", "min", resp.electrical.min); 
              $("#slider-range-electric").slider("option", "max", resp.electrical.max); 
              $("#slider-range-electric").slider("option", "value", resp.electrical.min);
              $( "#isElecAccCover-txt-val" ).text( "₹"+ resp.electrical.min );
            }
             if(cover=="isNonElecAccCover"){
                $("#slider-range-nonelectric").slider("option", "min", resp.nonelectrical.min); 
                $("#slider-range-nonelectric").slider("option", "max", resp.nonelectrical.max); 
                $("#slider-range-nonelectric").slider("option", "value", resp.nonelectrical.min);
                $( "#isNonElecAccCover-txt-val" ).text( "₹"+ resp.electrical.min);
             }
      },'json');
  }



