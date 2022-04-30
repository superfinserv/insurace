$(function(){
    'use strict';
     var loader = '<span class="inline-loader"><span class="inline-loader-box"></span><span class="inline-loader-box"></span><span class="inline-loader-box"></span></span>';
     var currentPlan = "COM";
     var jcModal;
    const planLib = {
           twInfo: JSON.parse(localStorage.getItem('twInfo')),
           digit: function(callTyp){
              var digitCard = $('.plan-card-digit_m');
              if(digitCard.length){
                  $('.plan-card-digit_m').find('button.btn-netpremiumn').html(loader);//.attr('disabled',false);
                  $('.plan-card-digit_m').find('.error-span').remove();
                  var twInfo = JSON.parse(localStorage.getItem('twInfo'));
                  var url =  (callTyp=='recalculate')?"/twowheeler-insurance/load-plans-recalculate/":"/twowheeler-insurance/load-plans/";
                 $.ajax({
                  url: base_url + url,
                  type: "POST",
                  dataType: "json",
                  data:{supp:'DIGIT',twInfo:twInfo},
                  success: function (data, status, jqXHR) {
                      console.log(data);
                      if($.trim(data.status)=="success"){
                        $('.idv-edit-th').attr('id','open-idv-modal');
                        $('.plan-card-digit_m').show();
                        var result = data.data;
                        
                        digitCard.removeClass('cart-empty');
                        digitCard.find('a.Premium-Breakup').attr('data-ref',result.id);
                        if(twInfo.planType=="TP"){
                            digitCard.find('h5.idv').hide();
                        }else{
                            digitCard.find('h5.idv').show();
                            digitCard.find('h5.idv').html('IDV:'+result.idv+'/-');
                        }
                        digitCard.find('.column-2').attr('style',"");
                        digitCard.find('.column-3').attr('style',"");
                        if(twInfo.subcovers.isPA_OwnerDriverCover==="true"){ digitCard.find('.paCoverStatus-txt').text('Added');}else{ digitCard.find('.paCoverStatus-txt').text('N/A');}
                        if(twInfo.subcovers.isPartDepProCover==="true"){ digitCard.find('.zeroDepStatus-txt').text("Added");}else{ digitCard.find('.zeroDepStatus-txt').text('N/A');}
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
                           digitCard.addClass('cart-empty');
                          
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
                       $('.plan-card-hdfcergo_m').find('button.btn-netpremiumn').html(loader);//.attr('disabled',false);
                       $('.plan-card-hdfcergo_m').find('button.btn-netpremiumn').html(loader);
                       $('.plan-card-hdfcergo_m').find('.error-span').remove();
                     
                     var twInfo = JSON.parse(localStorage.getItem('twInfo'));
                     var url =  (callTyp=='recalculate')?"/twowheeler-insurance/load-plans-recalculate/":"/twowheeler-insurance/load-plans/";
                     $.ajax({
                      url: base_url + url,
                      type: "POST",
                      dataType: "json",
                      data:{supp:'HDFCERGO',twInfo:twInfo},
                      success: function (data, status, jqXHR) {
                          var result = data.data;
                          if($.trim(data.status)=="success"){
                            $('.idv-edit-th').attr('id','open-idv-modal');
                            $('.plan-card-hdfcergo_m').show();
                            
                           
                            hdfcergoCard.removeClass('cart-empty');
                            hdfcergoCard.find('a.Premium-Breakup').attr('data-ref',result.id);
                            if(twInfo.planType=="TP"){ 
                                hdfcergoCard.find('h5.idv').hide();
                            }else{
                                hdfcergoCard.find('h5.idv').show();
                                hdfcergoCard.find('h5.idv').html('IDV:'+result.idv+'/-');
                            }
                            hdfcergoCard.find('.column-2').attr('style',"");
                            hdfcergoCard.find('.column-3').attr('style',"");
                            hdfcergoCard.find('button.btn-netpremiumn').attr('data-ref',result.id);
                            if(twInfo.subcovers.isPA_OwnerDriverCover=="true"){
                               hdfcergoCard.find('span.paCoverStatus-txt').text('Added');
                            }else{
                                hdfcergoCard.find('span.paCoverStatus-txt').text('N/A');
                            }
                            hdfcergoCard.find('button.btn-netpremiumn').html('<span class="fa fa-inr"></span> '+result.grossamount+' <i style="" class="fa fa-angle-double-right" aria-hidden="true"></i>');
                            var addon =  result.addons.covers.addons;
                             if( addon.length){
                                var addonHtm = "";
                                $.each(addon, function (adkey, ad) {
                                   
                                   addonHtm +='<span class="addon-badge">'+ad.title+'</span>';
                                });
                                
                                $('.hdfcergo_m_addon').html(addonHtm);
                            }else{
                               $('.hdfcergo_m_addon').empty().text('No addon cover selected');  
                            }
                        
                          }else{
                               hdfcergoCard.addClass('cart-empty');
                               $('.plan-card-hdfcergo_m').find('.card-body').prepend('<span class="error-span">'+data.message+'</span>');
                               $('.plan-card-hdfcergo_m').find('button.btn-netpremiumn').html('0.00').attr('disabled',true);
                              //$('.plan-card-digit_m').hide();
                             // toastr.error(data.message, 'HdfcErgo Error!') 
                          }
                       },
                      error: function (jqXHR, status, err) {
                            // console.log('Error');
                            // console.log(jqXHR);
                            // console.log(status);
                            // console.log(err);
                           //$('.plan-card-hdfcergo_m').hide();
                           $('.plan-card-hdfcergo_m').find('.card-body').prepend('<span class="error-span">Error while fetch quote</span>');
                           $('.plan-card-hdfcergo_m').find('button.btn-netpremiumn').html('0.00').attr('disabled',true);
                            
                          //toastr.error(err+' while fetch HDFC ERGO Quote', 'Error!')
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
            
                 var twInfo = JSON.parse(localStorage.getItem('twInfo'));
                 var url =  (callTyp=='recalculate')?"/twowheeler-insurance/load-plans-recalculate/":"/twowheeler-insurance/load-plans/";
                 $.ajax({
                  url: base_url + url,
                  type: "POST",
                  dataType: "json",
                  data:{supp:'FGI',twInfo:twInfo},
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
                 var twInfo = JSON.parse(localStorage.getItem('twInfo'));
                   currentPlan = cover;
                 if(cover=='TP'){
                        twInfo.vehicle.idv = "10000";
                        twInfo.subcovers.isBreakDownAsCover="false";
                        twInfo.subcovers.isTyreProCover="false";
                        twInfo.subcovers.isPartDepProCover="false";
                        twInfo.subcovers.isConsumableCover="false";
                        twInfo.subcovers.isEng_GearBoxProCover="false";
                        twInfo.subcovers.isRetInvCover="false";
                        twInfo.subcovers.isRimProCover="false";
                        twInfo.subcovers.isCashAllowCover="false";
                        $('.cardIdvSet').hide();
                        $('.moter-OD').prop('checked',false);$('.moter-OD').attr('checked',false);
                        $('.com-cover').prop("disabled", false); $(".com-cover").attr("disabled", false);
                        $('.moter-OD').prop("disabled", true); $(".moter-OD").attr("disabled", true);
                        $('.access-cover').prop("disabled", true); $(".access-cover").attr("disabled", true);
                        $('#zero-dep-elem').hide();
                         $('.TPCovers').show();
                    }else if(cover=='SAOD'){
                          $('.cardIdvSet').show();
                          $('#ODdetails').show();
                          $('#pa-unnamed-passanger-elem').hide();
                           $('.com-cover').prop("checked", false); $(".com-cover").attr("checked", false);
                           $('.moter-OD').prop("disabled", false); $(".moter-OD").attr("disabled", false);
                          $('.com-cover').prop("disabled", true); $(".com-cover").attr("disabled", true);
                          $('.access-cover').prop("disabled", false); $(".access-cover").attr("disabled", false);
                            twInfo.subcovers.isPA_UNPassCover="false";
                            twInfo.subcovers.isPA_UNDriverCover="false";
                            twInfo.subcovers.isLL_PaidDriverCover="false";
                            twInfo.subcovers.isLL_UNPassCover="false";
                            twInfo.subcovers.isLL_EmpCover="false";
                            twInfo.subcovers.isPA_OwnerDriverCover = "false";
                            $("#isPA_OwnerDriverCover").prop("checked", false);$("#isPA_OwnerDriverCover").attr("checked", false);
                            $("#notPA_OwnerDriverCover").prop("checked", true);$("#notPA_OwnerDriverCover").attr("checked", true);
                            $('.PACover').prop("disabled", true); $(".PACover").attr("disabled", true);
                            
                            $('.TPCovers').hide();
                    }else{
                        $('.cardIdvSet').show();
                        $('.com-cover').prop("disabled", false); $(".com-cover").attr("disabled", false);
                        $('.moter-OD').prop("disabled", false); $(".moter-OD").attr("disabled", false);
                        $('.access-cover').prop("disabled", false); $(".access-cover").attr("disabled", false);
                        $('.TPCovers').show();
                    }
                    
                    if(twInfo.vehicle.policyHolder=="COR"){
                        twInfo.subcovers.isPA_OwnerDriverCover = "false";
                        $("#isPA_OwnerDriverCover").prop("checked", false);$("#isPA_OwnerDriverCover").attr("checked", false);
                        $("#notPA_OwnerDriverCover").prop("checked", true);$("#notPA_OwnerDriverCover").attr("checked", true);
                        $('.PACover').prop("disabled", true); $(".PACover").attr("disabled", true);
                    }else{
                        if(cover!='SAOD'){
                            twInfo.subcovers.isPA_OwnerDriverCover = "true";
                            $("#isPA_OwnerDriverCover").prop("checked", true);$("#isPA_OwnerDriverCover").attr("checked", true);
                            $("#notPA_OwnerDriverCover").prop("checked", false);$("#notPA_OwnerDriverCover").attr("checked", false);
                            $('.PACover').prop("disabled", false); $(".PACover").attr("disabled", false);
                        }
                    }
                    localStorage.setItem("twInfo", JSON.stringify(twInfo));
                    //// else if(cover=='SAOD'){
                        
                    //     $('.cardIdvSet').show();
                    //     $('.com-cover').prop("disabled", true); $(".com-cover").attr("disabled", true);
                    //     $('.moter-OD').prop("disabled", false); $(".moter-OD").attr("disabled", false);
                    //     $('.access-cover').prop("disabled", false); $(".access-cover").attr("disabled", false);
                    //     $('.com-cover').prop("checked", false); $(".com-cover").attr("checked", false);
                        
                    // }
        },
            addonsHandler:function(){
                 twInfo = JSON.parse(localStorage.getItem('twInfo'));
                 if(twInfo.vehicle.isBrandNew=="true"){ 
                     if(twInfo.subcovers.isPA_OwnerDriverCover=="true"){ 
                        $('#pa-owner-driver-elem').show();
                     }
                     
                     $('.return-to-invoice-elem').show();
                 }else{
                     $('.return-to-invoice-elem').hide(); 
                 }
                 
                  $.each(twInfo.subcovers, function(key, value) {
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
  
    var twInfo =[];
    if(localStorage.getItem("twInfo")){ 
      twInfo = JSON.parse(localStorage.getItem('twInfo'));
        $('#span-make_name').text(twInfo.vehicle.brand.name);
        $('#span-model_name').text(twInfo.vehicle.model.name);
        $('#span-varient_name').text(twInfo.vehicle.varient.name);
        $('#span-regYear').text(twInfo.vehicle.regYear);
        $('#span-FuleType').text(twInfo.vehicle.fueltype);
        $('#span-RTO').text(twInfo.vehicle.rtoCode);
        $("#planType").val(twInfo.planType);
        // twInfo.subcovers.isPA_OwnerDriverCover ='true';
        //  $("#isPA_OwnerDriverCover").prop("checked", true);$("#isPA_OwnerDriverCover").attr("checked", true);
        //  $("#notPA_OwnerDriverCover").prop("checked", false);$("#notPA_OwnerDriverCover").attr("checked", false); 
        // if(twInfo.vehicle.policyHolder=="COR"){
        //     twInfo.subcovers.isPA_OwnerDriverCover ='false';
        //     $("#isPA_OwnerDriverCover").prop("checked", false);$("#isPA_OwnerDriverCover").attr("checked", false);$("#isPA_OwnerDriverCover").attr("disabled", true);
        //     $("#notPA_OwnerDriverCover").prop("checked", true);$("#notPA_OwnerDriverCover").attr("checked", true);$("#notPA_OwnerDriverCover").attr("disabled", true);
        // }
        // localStorage.setItem("twInfo", JSON.stringify(twInfo));
        configSetting.coverSetup(twInfo.planType);
        configSetting.addonsHandler();
        planLib.digit('first-call');
        planLib.hdfcErgo('first-call');
        planLib.fgi('first-call');
        
    }
    
    
     function TPModal(){
         var twInfo = JSON.parse(localStorage.getItem('twInfo'));
         //console.log("twInfo",twInfo.previousInsurance.policyType);
         var preCover =  twInfo.previousInsurance.policyType;
         var isBrandNew =  (twInfo.vehicle.isBrandNew=="true")?'new2w':"old2w";
         if(isBrandNew =="new2w"){
             var preCover =  'new';
         }else if( twInfo.previousInsurance.isExp==="Expired" &&  twInfo.previousInsurance.exp=="0"){
            var preCover =  'dontKnow'; 
         }
       jcModal = $.dialog({
                    title: 'Just few details to go...',
                    titleClass:'tp-title',
                    content: 'url:'+base_url+"/moter-insurance/load-tp-details-modal/bike/"+preCover+"/"+isBrandNew,
                    animation: 'scale',
                    columnClass: 'medium',
                    closeAnimation: 'scale',
                    backgroundDismiss: false,
                    closeIcon:true,
                    onContentReady: function(){
                        //var twInfo = JSON.parse(localStorage.getItem('twInfo'));
                        //console.log(carInfo.TP);
                         if(twInfo.TP){
                             if(twInfo.TP.TPstatus=='NO'){
                                 $('#TPstatusNExp').prop('checked', true);$('#TPstatusNExp').attr('checked', true);
                             }else{
                                 $('#TPstatusExp').prop('checked', true);$('#TPstatusExp').attr('checked', true);
                             }
                             
                             $('#TPInsurer').val(twInfo.TP.TPInsurer).trigger('change');
                             $('#TP_policyno').val(twInfo.TP.TP_policyno);
                             $('#TPpolicyStartDate').val(twInfo.TP.TPpolicyStartDate);
                             $('#TPpolicyEndDate').val(twInfo.TP.TPpolicyEndDate);
                             $('#prePolicyType').val(twInfo.TP.prePolicyType);
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
        if($('#prePolicyType').length){
             $('#prePolicyType').rules("add", {required: true});
         }else{ 
               $('#prePolicyType').rules("add", {required: false});
         }
        
        if($('#TpDetailsForm').valid() === true) {
            var formData = $('#TpDetailsForm').serializeObject();
            var twInfo = JSON.parse(localStorage.getItem('twInfo'));
            twInfo.TP  = formData;
            twInfo.previousInsurance.insurer = formData.TPInsurer; 
            twInfo.previousInsurance.policyNo = formData.TP_policyno;
            twInfo.planType = "SAOD";
            currentPlan = "SAOD";
            localStorage.setItem("twInfo", JSON.stringify(twInfo));
            jcModal.close();
            $('#ODdetails').show();
             configSetting.coverSetup(currentPlan);
             planLib.digit('firstCall');
             planLib.hdfcErgo('firstCall');
              planLib.fgi('first-call');
        }
    });
    
    $('body').on('click','#ODdetails',function() {
          TPModal();
    })
    
    $('body').on('change','.planType',function() {
        var cover = $(this).val(); 
        var twInfo = JSON.parse(localStorage.getItem('twInfo'));
           if(cover=="SAOD"){
                TPModal();
            }else{
                 $('#ODdetails').hide();
                currentPlan =  cover;// Manage Current plan in case SOAD.
               twInfo.planType = cover;
               localStorage.setItem("twInfo", JSON.stringify(twInfo));
              configSetting.coverSetup(cover);
              planLib.digit('firstCall');
              planLib.hdfcErgo('firstCall');
               planLib.fgi('firstCall');
            }
           
           
        
    });
    
     $('body').on('click','.PACover',function(e) {
             twInfo = JSON.parse(localStorage.getItem('twInfo'));
             var isPACover = ($("input[name='PA_OwnerDriverCover']:checked").val()==1)?"true":"false";
             console.log(isPACover)
             if(twInfo.vehicle.isBrandNew=="true"){ 
                 if(isPACover=="true"){ 
                      $('#pa-owner-driver-elem').show();
                 }else{
                     $('#pa-owner-driver-elem').hide();
                 }
             }
            twInfo.subcovers.isPA_OwnerDriverCover =isPACover;
             twInfo.coverValues.PA_OwnerDriverCoverval =1;
            localStorage.setItem("twInfo", JSON.stringify(twInfo));
             planLib.digit('recalculate');
             planLib.hdfcErgo('recalculate');
             planLib.fgi('recalculate');
              planLib.fgi('recalculate');
     });
     
     $('body').on('click','#btn-pa-owner-driver',function() {
        twInfo = JSON.parse(localStorage.getItem('twInfo'));
        var val = $('#pa-owner-driver-value').val();
        // var isPACover = ($("input[name='PA_OwnerDriverCover']:checked").val()==1)?"true":"false";
        // twInfo.subcovers.isPA_OwnerDriverCover =isPACover;
        twInfo.coverValues.PA_OwnerDriverCoverval = val;
        localStorage.setItem("twInfo", JSON.stringify(twInfo));
        planLib.digit('recalculate');
        planLib.hdfcErgo('recalculate');
    })
     
     // PA UNNAMED
     $('body').on('click','.pa-unnamed',function(e) {
        twInfo = JSON.parse(localStorage.getItem('twInfo'));
        var name = $(this).attr('data-name');
        if ($(this).is(":checked")) { 
            $('#'+name+'-elem').show();
        }else{
             $('#'+name+'-elem').hide();
             var isPA_UNPassCover=($('input[name=isPA_UNPassCover]:checked').val()==1)?"true":"false"; 
             twInfo.subcovers.isPA_UNPassCover =  isPA_UNPassCover;
             localStorage.setItem("twInfo", JSON.stringify(twInfo));
             planLib.digit('recalculate');
             planLib.hdfcErgo('recalculate');
              planLib.fgi('recalculate');
        }
        
     });
     
     $('body').on('click','#btn-pa-unnamed-passanger',function() {
        twInfo = JSON.parse(localStorage.getItem('twInfo'));
        var val = $('#pa-unnamed-passanger-value').val();
        var isPA_UNPassCover=($('input[name=isPA_UNPassCover]:checked').val()==1)?"true":"false"; 
        twInfo.subcovers.isPA_UNPassCover =  isPA_UNPassCover;
        twInfo.coverValues.PA_UNPassCoverval = val;
        localStorage.setItem("twInfo", JSON.stringify(twInfo));
        planLib.digit('recalculate');
        planLib.hdfcErgo('recalculate');
         planLib.fgi('recalculate');
    })
    
    //Zero Dep
     $('body').on('click','.addonZeroDepCover',function() { 
         var elemName = $(this).attr('data-name');
         twInfo = JSON.parse(localStorage.getItem('twInfo'));
         if(twInfo.vehicle.isBrandNew=="false"){
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
                               // $('#'+elemName+'-elem').show();
                              twInfo = JSON.parse(localStorage.getItem('twInfo'));
                              twInfo.subcovers.isPartDepProCover =  "true";
                              twInfo.coverValues.partDepCoverval = "Cover only 2 claims per year";
                              localStorage.setItem("twInfo", JSON.stringify(twInfo));
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
                            }
                        }
                       
                    }
                });
             }else{
                twInfo = JSON.parse(localStorage.getItem('twInfo'));
                twInfo.subcovers.isPartDepProCover = "false";
                localStorage.setItem("twInfo", JSON.stringify(twInfo));
                 $('#'+elemName+'-elem').hide();
                planLib.digit('recalculate');
                planLib.hdfcErgo('recalculate');
                  planLib.fgi('recalculate');
             }
         }else{
            twInfo = JSON.parse(localStorage.getItem('twInfo'));
             if($('#isPartDepProCover').is(":checked")){ 
              twInfo.subcovers.isPartDepProCover =  "true";
              twInfo.coverValues.partDepCoverval = "Cover only 2 claims per year";
             }else{
                twInfo.subcovers.isPartDepProCover =  "false";
             }
              localStorage.setItem("twInfo", JSON.stringify(twInfo));
              planLib.digit('recalculate'); 
              planLib.hdfcErgo('recalculate');
                planLib.fgi('recalculate');
         }
         
     });
     
    //  $('body').on('click','#btn-zero-dep-claim',function() {
    //     twInfo = JSON.parse(localStorage.getItem('twInfo'));
    //     var val = $('#zero-dep-value').val();
    //     var isPartDepProCover=($('input[name=isPartDepProCover]:checked').val()==1)?"true":"false"; 
    //     twInfo.subcovers.isPartDepProCover =  isPartDepProCover;
    //     twInfo.coverValues.partDepCoverval = val;
    //     localStorage.setItem("twInfo", JSON.stringify(twInfo));
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
            twInfo.coverValues.partDepCoverval = "0";
        }
        
        var isConsumableCover=($('input[name=isConsumableCover]:checked').val()==1)?"true":"false"; 
        var isEng_GearBoxProCover=($('input[name=isEng_GearBoxProCover]:checked').val()==1)?"true":"false"; 
        var isRetInvCover=($('input[name=isRetInvCover]:checked').val()==1)?"true":"false"; 
        var isRimProCover=($('input[name=isRimProCover]:checked').val()==1)?"true":"false"; 
        var isCashAllowCover = ($('input[name=isCashAllowCover]:checked').val()==1)?"true":"false"; 
        
        var isCngKitCover=($('input[name=isCngKitCover]:checked').val()==1)?"true":"false";
        var isElecAccCover=($('input[name=isElecAccCover]:checked').val()==1)?"true":"false"; 
        var isNonElecAccCover=($('input[name=isNonElecAccCover]:checked').val()==1)?"true":"false";
        
        
        twInfo = JSON.parse(localStorage.getItem('twInfo'));
       
        twInfo.subcovers.isPA_OwnerDriverCover = isPA_OwnerDriverCover;
        twInfo.subcovers.isPA_UNPassCover = isPA_UNPassCover;
        twInfo.subcovers.isPA_UNDriverCover = isPA_UNDriverCover;
        twInfo.subcovers.isLL_PaidDriverCover = isLL_PaidDriverCover;
        twInfo.subcovers.isLL_UNPassCover = isLL_UNPassCover;
        twInfo.subcovers.isLL_EmpCover = isLL_EmpCover;
        
        twInfo.subcovers.isBreakDownAsCover=isBreakDownAsCover;
        twInfo.subcovers.isTyreProCover=isTyreProCover;
        twInfo.subcovers.isPartDepProCover=isPartDepProCover;
        twInfo.subcovers.isConsumableCover=isConsumableCover;
        twInfo.subcovers.isEng_GearBoxProCover=isEng_GearBoxProCover;
        twInfo.subcovers.isRetInvCover=isRetInvCover;
        twInfo.subcovers.isRimProCover=isRimProCover;
        twInfo.subcovers.isCashAllowCover=isCashAllowCover;
        
        twInfo.subcovers.isCngKitCover=isCngKitCover;
        twInfo.subcovers.isElecAccCover=isElecAccCover;
        twInfo.subcovers.isNonElecAccCover=isNonElecAccCover;
        
        
        localStorage.setItem("twInfo", JSON.stringify(twInfo));
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
            content: 'url:'+base_url+"/moter-insurance/load-idv-modal/BIKE/token",
            animation: 'scale',
            columnClass: 'medium',
            closeAnimation: 'scale',
            backgroundDismiss: true,
            onContentReady: function () { 
                // var twInfo = JSON.parse(localStorage.getItem('twInfo'));
                 
                // if(twInfo.vehicle.idv.value!==undefined){
                //     $('#idvRange').val(twInfo.vehicle.idv.value);
                //     $('#inputIdvValue').val(twInfo.vehicle.idv.value)
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
       var twInfo = JSON.parse(localStorage.getItem('twInfo'));
       var val = $('input[name=idvRadio]:checked').val();
       var min = parseInt($('#idvRange').attr('min'));
       var max = parseInt($('#idvRange').attr('max'));
       var input = parseInt($('#inputIdvValue').val());
       if(val=='LOWEST'){ 
           twInfo.vehicle.idv = { isLowest:"YES",value:min}
           $('#IdvCurrentValue').text("Lowest price");
           valid = true;
       }else{
           if(input>=min && input<=max){
               $('#error-text').text("");
               twInfo.vehicle.idv = { isLowest:"NO",value:$('#inputIdvValue').val()}
               $('#IdvCurrentValue').text("₹"+$('#inputIdvValue').val());
               valid = true;
            }else{
               $('#error-text').text("Idv value should me in range.");
               valid = false;
            }
           
       }
        if(valid){
           localStorage.setItem("twInfo", JSON.stringify(twInfo));
           idvModal.close();
           planLib.digit('recalculate');
           planLib.hdfcErgo('recalculate');
            planLib.fgi('recalculate');
                
        }
    });
    
    $('body').on('click','.selectPlan',function(e) {
         e.preventDefault();
         var id = $(this).attr('data-ref');
          var provider = $(this).attr('data-provider');
          var _this = $(this);
          _this.attr('disabled',true);
          _this.prop('disabled',true);
          var _html = _this.html();
          _this.html(loader);
           var twInfo = JSON.parse(localStorage.getItem('twInfo'));
          $.post(base_url + "/twowheeler-insurance/create-enquiry/",{provider:provider,id:id,twInfo:twInfo}, function (resp) {
             var status = $.trim(resp.status);
             if(status=='success'){
                var encId = resp.data.enq;
                window.location.href=base_url+"/twowheeler-insurance/users-information/"+encId;
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
   
    
    

    
    
   

});



