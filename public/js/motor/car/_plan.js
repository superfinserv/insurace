var bikeInfo = [];
$(function(){
        'use strict';
        
        if(localStorage.getItem("twInfo")){ 
           bikeInfo = JSON.parse(localStorage.getItem('bikeInfo'));
           //bikeInfo.isPA_OwnerDriverCover =0;
           bikeInfo.subcovers.isPA_UNPassCover = 0;
           bikeInfo.subcovers.isPA_UNDriverCover = 0;
           bikeInfo.subcovers.isLL_PaidDriverCover = 0;
           bikeInfo.subcovers.isLL_UNPassCover = 0;
           bikeInfo.subcovers.isLL_EmpCover = 0;
           bikeInfo.subcovers.isBreakDownAsCover=0;
           bikeInfo.subcovers.isTyreProCover=0;
           bikeInfo.subcovers.isPartDepProCover=0;
           bikeInfo.subcovers.isConsumableCover=0;
           bikeInfo.subcovers.isEng_GearBoxProCover=0;
           bikeInfo.subcovers.isRetInvCover=0;
           bikeInfo.subcovers.isRimProCover=0;
        
           bikeInfo.subcovers.isCngKitCover=0;
           bikeInfo.subcovers.isElecAccCover=0;
           bikeInfo.subcovers.isNonElecAccCover=0;
           if(bikeInfo.productCode=="COM" || bikeInfo.productCode=="TP"){
                   bikeInfo.subcovers.isPA_OwnerDriverCover =1;
                   $('#ODdetails').hide();}
               else{
                   bikeInfo.subcovers.isPA_OwnerDriverCover =0;
                   $('#ODdetails').show();
               }
    
           localStorage.setItem("bikeInfo", JSON.stringify(bikeInfo));
           var addedItem = Object.keys(bikeInfo).length;
           if(addedItem){
                $('#span-make_name').text(bikeInfo.brand.name);
                $('#span-model_name').text(bikeInfo.model.name);
                $('#span-varient_name').text(bikeInfo.varient.name);
                $('#span-regYear').text(bikeInfo.regYear);
                $('#span-FuleType').text(bikeInfo.fueltype);
                $('#span-RTO').text(bikeInfo.rto_code);
                $("#planType").val(bikeInfo.productCode);
                //$("#planType").prop("disabled",true); $("#planType").attr("disabled",true);
                manageSideBar(bikeInfo.productCode);
           
               
                if(bikeInfo.subcovers.isPA_OwnerDriverCover==1){  
                   $("#isPA_OwnerDriverCover").prop("checked", true);$("#isPA_OwnerDriverCover").attr("checked", true);
                   $("#notPA_OwnerDriverCover").prop("checked", false);$("#notPA_OwnerDriverCover").attr("checked", false); 
                }else{
                   $("#isPA_OwnerDriverCover").prop("checked", false);$("#isPA_OwnerDriverCover").attr("checked", false);
                   $("#notPA_OwnerDriverCover").prop("checked", true);$("#notPA_OwnerDriverCover").attr("checked", true); 
                }
               
                 var customerData = JSON.parse(localStorage.getItem('customersDetails'));
                 var deviceToken = localStorage.getItem('deviceToken');
                 var HasPAcover = (bikeInfo.subcovers.isPA_OwnerDriverCover=="1")?"Added":"N/A";
                 var HasZeroDep = (bikeInfo.subcovers.isPartDepProCover=="1")?"Added":"N/A";
                 if(bikeInfo.productCode=="OD"){
                    if(typeof(bikeInfo.TP)!= "undefined" && bikeInfo.TP!== null) { loadPlans('firstCall');$('#IdvCurrentValue').text("Lowest"); }else{TPModal();}
                 }else{
                     loadPlans('firstCall');
                     $('#IdvCurrentValue').text("Lowest");
                 }
         }
    }
    
    
    var tpModal = "";
    function TPModal(){
       tpModal =$.dialog({
                    title: 'Just few details to go...',
                    titleClass:'tp-title',
                    content: 'url:'+base_url+"/common/load-tp-details-modal/bike",
                    animation: 'scale',
                    columnClass: 'medium',
                    closeAnimation: 'scale',
                    backgroundDismiss: false,
                    closeIcon:false,
                    onContentReady: function(){
                         var bikeInfo = JSON.parse(localStorage.getItem('bikeInfo'));
                         console.log(bikeInfo.TP);
                         if(bikeInfo.TP){
                             if(bikeInfo.TP.TPstatus=='NO'){
                                 $('#TPstatusNExp').prop('checked', true);$('#TPstatusNExp').attr('checked', true);
                             }else{
                                 $('#TPstatusExp').prop('checked', true);$('#TPstatusExp').attr('checked', true);
                             }
                             
                             $('#TPInsurer').val(bikeInfo.TP.TPInsurer).trigger('change');
                             $('#TP_policyno').val(bikeInfo.TP.TP_policyno);
                             $('#TPpolicyStartDate').val(bikeInfo.TP.TPpolicyStartDate);
                             $('#TPpolicyEndDate').val(bikeInfo.TP.TPpolicyEndDate);
                             $('#prePolicyType').val(bikeInfo.TP.prePolicyType);
                         }
                        $('.jconfirm-content').css('overflow','hidden');
                        $('.tp-title').css({'color':'#AC0F0B','border-bottom':'1px solid #ccc','margin-bottom':'6px','line-height': '10px',});
                        //$("#TpDetailsForm").validate();
                    }
                });  
    }
    
    $('body').on('click','#TpDetailsFormClose',function(e){
      e.preventDefault();
       tpModal.close();
        var carInfo = JSON.parse(localStorage.getItem('carInfo'));
        $('.planType').val(carInfo.productCode);
        
    });
 
    $('body').on('submit','#TpDetailsForm',function(e){
      e.preventDefault();
       loadPlaceholder();
       manageSideBar('OD');
        $("#TpDetailsForm").validate();
        $('#TPInsurer').rules("add",  {required: true });
        $('#TPInsurer').rules("add",  {required: true });
        $('#TP_policyno').rules("add", {required: true});
        $('#TPpolicyStartDate').rules("add", {required: true,});
        $('#TPpolicyEndDate').rules("add", {required: true});
        $('#prePolicyType').rules("add", {required: true});
        
        if($('#TpDetailsForm').valid() === true) {
            var formData = $('#TpDetailsForm').serializeObject();
            var bikeInfo = JSON.parse(localStorage.getItem('bikeInfo'));
            
            
            bikeInfo.productCode = "OD";
            bikeInfo.TP  = formData;
            localStorage.setItem("bikeInfo", JSON.stringify(bikeInfo));
            tpModal.close();
            loadPlans('firstCall');
            
        }
    });
    
   
    $('body').on('click','#ODdetails',function() {
        // $('#PlanListContainer').loading({
        //         message: 'Fetching best plans for you...'
        //      });
        // loadPlaceholder();
        TPModal();
    })
    $('body').on('change','.planType',function() {
         var selValue = $(this).val(); 
         
        //  $('#PlanListContainer').loading({
        //     message: 'Fetching best plans for you...'
        //  });
        // loadPlaceholder();
        // manageSideBar(selValue);
        
        var bikeInfo = JSON.parse(localStorage.getItem('bikeInfo'));
            bikeInfo.productCode = selValue;
            if(selValue=='TP'|| selValue=='COM'){
                loadPlaceholder();
                manageSideBar(selValue);
                bikeInfo.subcovers.isPA_OwnerDriverCover =1;
                $("#isPA_OwnerDriverCover").prop("checked", true);$("#isPA_OwnerDriverCover").attr("checked", true);
                $('#ODdetails').hide();
            }else{
                $('#ODdetails').show();
                 $("#isPA_OwnerDriverCover").prop("checked", false);$("#isPA_OwnerDriverCover").attr("checked", false);  
            }
           localStorage.setItem("bikeInfo", JSON.stringify(bikeInfo));
           if(selValue=='OD'){
                if(typeof(bikeInfo.TP)!= "undefined" && bikeInfo.TP!== null) { loadPlans('firstCall'); }else{TPModal();}
            }else{
                loadPlans('firstCall');
            }
           
        
    });
    
    $('body').on('click','.PACover',function(e) {
            var bikeInfo = JSON.parse(localStorage.getItem('bikeInfo'));
        
            //  $('#PlanListContainer').loading({
            //     message: 'Fetching best plans for you...'
            //  });
            loadPlaceholder();
            var isPACover = $("input[name='PA_OwnerDriverCover']:checked").val();
             bikeInfo.subcovers.isPA_OwnerDriverCover =isPACover;
             localStorage.setItem("bikeInfo", JSON.stringify(bikeInfo));
             loadPlans('recalculate');
        
        
     });
    
     $('body').on('click','.pa-unnamed',function(e) {
        var bikeInfo = JSON.parse(localStorage.getItem('bikeInfo'));
        var name = $(this).attr('data-name');
        if ($(this).is(":checked")) { 
            $('#'+name+'-elem').show();
        }else{
            //  $('#PlanListContainer').loading({
            //     message: 'Fetching best plans for you...'
            //  });
            loadPlaceholder();
             $('#'+name+'-elem').hide();
             var isPA_UNPassCover=($('input[name=isPA_UNPassCover]:checked').val()==1)?1:0; 
              bikeInfo.subcovers.isPA_UNPassCover =  isPA_UNPassCover;
              localStorage.setItem("bikeInfo", JSON.stringify(bikeInfo));
              loadPlans('recalculate');
        }
        
     });
     $('body').on('click','#btn-pa-unnamed-passanger',function() {
        var bikeInfo = JSON.parse(localStorage.getItem('bikeInfo'));
        var val = $('#pa-unnamed-passanger-value').val();
        var unpno = 0;//$('#pa-unnamed-passanger-no').val();
        var isPA_UNPassCover=($('input[name=isPA_UNPassCover]:checked').val()==1)?1:0; 
        bikeInfo.subcovers.isPA_UNPassCover =  isPA_UNPassCover;
        bikeInfo.subcovers.PA_UNPassCoverval = val;
        bikeInfo.subcovers.PA_UNPassCoverNo = unpno;
        localStorage.setItem("bikeInfo", JSON.stringify(bikeInfo));
        //  $('#PlanListContainer').loading({
        //     message: 'Fetching best plans for you...'
        //  });
        loadPlaceholder();
        loadPlans('recalculate');
    })
    
     $('body').on('click','.addonZeroDepCover',function() { 
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
                            var bikeInfo = JSON.parse(localStorage.getItem('bikeInfo'));
                            bikeInfo.subcovers.isPartDepProCover =  1;
                            localStorage.setItem("bikeInfo", JSON.stringify(bikeInfo));
                            //  $('#PlanListContainer').loading({
                            //     message: 'Fetching best plans for you...'
                            //  });
                            loadPlaceholder();
                            loadPlans('recalculate'); 
                            
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
             var bikeInfo = JSON.parse(localStorage.getItem('bikeInfo'));
            bikeInfo.subcovers.isPartDepProCover = 0;
            localStorage.setItem("bikeInfo", JSON.stringify(bikeInfo));
            
            loadPlaceholder();
            loadPlans('recalculate'); 
         }
         
     })
    
    
    $('body').on('click','.addonCover',function(e) {
        // $('#PlanListContainer').loading({
        //     message: 'Fetching best plans for you...'
        //  });
         loadPlaceholder();
        var isPA_OwnerDriverCover =  ($('input[name=PA_OwnerDriverCover]:checked').val()==1)?1:0; 
        var isPA_UNPassCover=  ($('input[name=isPA_UNPassCover]:checked').val()==1)?1:0; 
        var isPA_UNDriverCover=  ($('input[name=isPA_UNDriverCover]:checked').val()==1)?1:0; 
        var isLL_PaidDriverCover =  ($('input[name=isLL_PaidDriverCover]:checked').val()==1)?1:0; 
        var isLL_UNPassCover =  ($('input[name=isLL_UNPassCover]:checked').val()==1)?1:0; 
        var isLL_EmpCover =  ($('input[name=isLL_EmpCover]:checked').val()==1)?1:0; 
        console.log("isPA_OwnerDriverCover",isPA_OwnerDriverCover);
        var isBreakDownAsCover=($('input[name=isBreakDownAsCover]:checked').val()==1)?1:0; 
        var isTyreProCover=($('input[name=isTyreProCover]:checked').val()==1)?1:0;
        var isPartDepProCover=($('input[name=isPartDepProCover]:checked').val()==1)?1:0; 
        var isConsumableCover=($('input[name=isConsumableCover]:checked').val()==1)?1:0; 
        var isEng_GearBoxProCover=($('input[name=isEng_GearBoxProCover]:checked').val()==1)?1:0; 
        var isRetInvCover=($('input[name=isRetInvCover]:checked').val()==1)?1:0; 
        var isRimProCover=($('input[name=isRimProCover]:checked').val()==1)?1:0; 
          
        var isCngKitCover=($('input[name=isCngKitCover]:checked').val()==1)?1:0;
        var isElecAccCover=($('input[name=isElecAccCover]:checked').val()==1)?1:0; 
        var isNonElecAccCover=($('input[name=isNonElecAccCover]:checked').val()==1)?1:0;
        
        
        bikeInfo = JSON.parse(localStorage.getItem('bikeInfo'));
       
        bikeInfo.subcovers.isPA_OwnerDriverCover = isPA_OwnerDriverCover;
        bikeInfo.subcovers.isPA_UNPassCover = isPA_UNPassCover;
        bikeInfo.subcovers.isPA_UNDriverCover = isPA_UNDriverCover;
        bikeInfo.subcovers.isLL_PaidDriverCover = isLL_PaidDriverCover;
        bikeInfo.subcovers.isLL_UNPassCover = isLL_UNPassCover;
        bikeInfo.subcovers.isLL_EmpCover = isLL_EmpCover;
        
        bikeInfo.subcovers.isBreakDownAsCover=isBreakDownAsCover;
        bikeInfo.subcovers.isTyreProCover=isTyreProCover;
        bikeInfo.subcovers.isPartDepProCover=isPartDepProCover;
        bikeInfo.subcovers.isConsumableCover=isConsumableCover;
        bikeInfo.subcovers.isEng_GearBoxProCover=isEng_GearBoxProCover;
        bikeInfo.subcovers.isRetInvCover=isRetInvCover;
        bikeInfo.subcovers.isRimProCover=isRimProCover;
    
        bikeInfo.subcovers.isCngKitCover=isCngKitCover;
        bikeInfo.subcovers.isElecAccCover=isElecAccCover;
        bikeInfo.subcovers.isNonElecAccCover=isNonElecAccCover;
        
        
        localStorage.setItem("bikeInfo", JSON.stringify(bikeInfo));
         loadPlans('recalculate');
       
    });
    
    function manageSideBar(cover){
            if(cover=='TP'){
                $('.cardIdvSet').hide();
                $('.com-cover').prop("disabled", false); $(".com-cover").attr("disabled", false);
                $('.moter-OD').prop("disabled", true); $(".moter-OD").attr("disabled", true);
                $('.access-cover').prop("disabled", true); $(".access-cover").attr("disabled", true);
            }else if(cover=='OD'){
                
                $('.cardIdvSet').show();
                $('.com-cover').prop("disabled", true); $(".com-cover").attr("disabled", true);
                $('.moter-OD').prop("disabled", false); $(".moter-OD").attr("disabled", false);
                $('.access-cover').prop("disabled", false); $(".access-cover").attr("disabled", false);
                $('.com-cover').prop("checked", false); $(".com-cover").attr("checked", false);
                
            }else{
                $('.cardIdvSet').show();
                $('.com-cover').prop("disabled", false); $(".com-cover").attr("disabled", false);
                $('.moter-OD').prop("disabled", false); $(".moter-OD").attr("disabled", false);
                $('.access-cover').prop("disabled", false); $(".access-cover").attr("disabled", false);
            }
   }
    
    function loadPlans(param){
              $('.com-cover').prop("disabled", true); $(".com-cover").attr("disabled", true);
              $('.moter-OD').prop("disabled", true); $(".moter-OD").attr("disabled", true);
              $('.access-cover').prop("disabled", true); $(".access-cover").attr("disabled", true);
             getDigitPlans(param);
             $('.ph-item-fgi_m').remove();
             $('.ph-item-hdfcergo_m').remove();
            //  getFgiPlans(param);
            //  getHdfcPlans(param);
           
    }
    
    function loadPlaceholder(){
                var elm =  '<div class="ph-item ph-item-digit_m">'
                                            +'<div class="ph-col-2">'
                                              +'<div class="ph-picture" style="height: 70px;"></div>'
                                            +'</div>'
                                            +'<div>'
                                              +'<div class="ph-row">'
                                                +'<div class="ph-col-6"></div>'
                                                +'<div class="ph-col-6 empty"></div>'
                                                +'<div class="ph-col-2"></div>'
                                                +'<div class="ph-col-10 empty"></div>'
                                                +'<div class="ph-col-8"></div>'
                                                +'<div class="ph-col-4 empty"></div>'
                                                +'<div class="ph-col-12"></div>'
                                              +'</div>'
                                            +'</div>'
                                        +'</div>'
                                        +'<div class="ph-item ph-item-fgi_m">'
                                            +'<div class="ph-col-2">'
                                              +'<div class="ph-picture" style="height: 70px;"></div>'
                                            +'</div>'
                                            +'<div>'
                                              +'<div class="ph-row">'
                                                +'<div class="ph-col-6"></div>'
                                                +'<div class="ph-col-6 empty"></div>'
                                                +'<div class="ph-col-2"></div>'
                                                +'<div class="ph-col-10 empty"></div>'
                                                +'<div class="ph-col-8"></div>'
                                                +'<div class="ph-col-4 empty"></div>'
                                                +'<div class="ph-col-12"></div>'
                                              +'</div>'
                                            +'</div>'
                                        +'</div>'
                                        +'<div class="ph-item ph-item-hdfcergo_m">'
                                            +'<div class="ph-col-2">'
                                              +'<div class="ph-picture" style="height: 70px;"></div>'
                                            +'</div>'
                                            +'<div>'
                                              +'<div class="ph-row">'
                                                +'<div class="ph-col-6"></div>'
                                                +'<div class="ph-col-6 empty"></div>'
                                                +'<div class="ph-col-2"></div>'
                                                +'<div class="ph-col-10 empty"></div>'
                                                +'<div class="ph-col-8"></div>'
                                                +'<div class="ph-col-4 empty"></div>'
                                                +'<div class="ph-col-12"></div>'
                                              +'</div>'
                                            +'</div>'
                                        +'</div>';
            $('#PlanListContainer').empty();
            $('#PlanListContainer').append(elm);
    }
    
    function getDigitPlans(param){
           var _this = $('#planType');
          _this.prop("disabled",true); _this.attr("disabled",true);
       
           var url =  (param=='recalculate')?"/bike-insurance/load-bike-plans-recalculate/":"/bike-insurance/load-bike-plans/";
           var bikeInfo = JSON.parse(localStorage.getItem('bikeInfo'));
           var customerData = JSON.parse(localStorage.getItem('customersDetails'));
           var deviceToken = localStorage.getItem('deviceToken');
           $.ajax({
              url: base_url + url,
              type: "POST",
              dataType: "json",
              data:{supp:'DIGIT',deviceToken:deviceToken,bikeInfo:bikeInfo,customerData:customerData},
              success: function (data, status, jqXHR) {
                 var status = $.trim(data.status);
                 var planList = data.plans;
                 var len =  planList.length;
                  if(status=="success" && len>0){
                      uiPlanList(planList);
                     _this.prop("disabled",false); _this.attr("disabled",false);
                  }else{
                      $('.ph-item-digit_m').remove();
                  }
              },
              error: function (jqXHR, status, err) {
                  $('.ph-item-digit_m').remove();
                //$('.ph-item-'+value.supplier.toLowerCase()).remove();
              },
              complete: function (jqXHR, status) {
                 // _this.prop("disabled",false); _this.attr("disabled",false);
                //alert("Local completion callback.");
                
              }
            });
           
        
    }
    
    function getFgiPlans(param){
        //   var _this = $('#planType');
        //   _this.prop("disabled",true); _this.attr("disabled",true);
       
        //   var url =  (param=='recalculate')?"/bike-insurance/load-bike-plans-recalculate/":"/bike-insurance/load-bike-plans/";
        //   var bikeInfo = JSON.parse(localStorage.getItem('bikeInfo'));
        //   var customerData = JSON.parse(localStorage.getItem('customersDetails'));
        //   var deviceToken = localStorage.getItem('deviceToken');
        //   $.ajax({
        //       url: base_url + url,
        //       type: "POST",
        //       dataType: "json",
        //       data:{supp:'FGI',deviceToken:deviceToken,bikeInfo:bikeInfo,customerData:customerData},
        //       success: function (data, status, jqXHR) {
        //          var status = $.trim(data.status);
        //          var planList = data.plans;
        //          var len =  planList.length;
        //           if(status=="success" && len>0){
        //               uiPlanList(planList);
        //              _this.prop("disabled",false); _this.attr("disabled",false);
        //           }else{
        //               $('.ph-item-fgi_m').remove();
        //           }
        //       },
        //       error: function (jqXHR, status, err) {
        //         $('.ph-item-fgi_m').remove();
        //       },
        //       complete: function (jqXHR, status) {
        //         //alert("Local completion callback.");
        //       }
        //     });
            
            
        
    }
    
    function getHdfcPlans(param){
           var _this = $('#planType');
          _this.prop("disabled",true); _this.attr("disabled",true);
       
           var url =  (param=='recalculate')?"/bike-insurance/load-bike-plans-recalculate/":"/bike-insurance/load-bike-plans/";
           var bikeInfo = JSON.parse(localStorage.getItem('bikeInfo'));
           var customerData = JSON.parse(localStorage.getItem('customersDetails'));
           var deviceToken = localStorage.getItem('deviceToken');
           $.ajax({
              url: base_url + url,
              type: "POST",
              dataType: "json",
              data:{supp:'HDFCERGO',deviceToken:deviceToken,bikeInfo:bikeInfo,customerData:customerData},
              success: function (data, status, jqXHR) {
                 var status = $.trim(data.status);
                 var planList = data.plans;
                 var len =  planList.length;
                  if(status=="success" && len>0){
                      uiPlanList(planList);
                     _this.prop("disabled",false); _this.attr("disabled",false);
                  }else{
                      $('.ph-item-hdfcergo_m').remove();
                  }
              },
              error: function (jqXHR, status, err) {
                $('.ph-item-hdfcergo_m').remove();
              },
              complete: function (jqXHR, status) {
                
              }
            });
        
    }
    
    function uiPlanList(planList){
        
         
         var bikeInfo = JSON.parse(localStorage.getItem('bikeInfo'));
         var HasPAcover = (bikeInfo.subcovers.isPA_OwnerDriverCover==1)?"Added":"N/A";
         var HasZeroDep = (bikeInfo.subcovers.isPartDepProCover==1)?"Added":"N/A";
         $.each(planList, function(key,value) { //each..loop
                var isComprehansive = (bikeInfo.productCode=="COM" || bikeInfo.productCode=="OD")?'<h5 class="idv">IDV:'+value.idv+'/-</h5>':'<h5 class="idv">Third Party</h5>';
                     var grossPrice = parseFloat(value.grossamount)+parseFloat(value.discount);
                     var netPrice = parseFloat(value.grossamount);
                     var zeroDepTxt = (value.supplier=='FGI_M')?'Additional benefits:-Theft or loss of keys,Loss of personal belongings,Road side assistance':'';
                     var planEach = '<div class="card plan-card elem-'+value.supp_logo+'" id="plan-'+value.id+'">'+
						'<div class="card-body">'+
						    '<div class="row">'+
						        '<div class="provider-logo col-md-4 col-lg-3 col-xs-12">'+
						            '<img src="'+value.supp_logo+'"/>'+
						        '</div>'+
						        '<div class="col-md-3 col-lg-3 col-xs-12">'+
						            '<div class="column-2" >'+
						                 isComprehansive+
						                 '<h5 class="plan-deatil-link"><a href="#" class="Premium-Breakup" data-ref="'+value.id+'">Plan Break-down</a></h5>'+
						            '</div>'+
						           
						        '</div>'+
						         '<div class="col-md-3 col-lg-3 col-xs-12">'+
						             '<div class="column-3" >'+
    						             '<h5 data-toggle="tooltip" title="'+zeroDepTxt+'">Zero Dep:'+HasZeroDep+'</h5>'+
    						             '<h5 >PA:'+HasPAcover+'</h5>'+
						            ' </div>'+
						          '</div>'+
						        '<div class="col-md-3 col-lg-3 col-xs-12">'+
						            '<div class="column-4">'+
						              '<h5 style="" class="grosspremium"><span class="fa fa-inr"></span> '+parseFloat(grossPrice).toFixed(2)+'/-</h5>'+
						              '<button style="" class="btn btn-netpremiumn selectPlan" data-provider="'+value.supplier+'"  data-ref="'+value.id+'"><span class="fa fa-inr"></span> '+parseFloat(netPrice).toFixed(2)+' <i style="" class="fa fa-angle-double-right" aria-hidden="true"></i> </button>'+
						            '</div>'+
						        '</div>'+
						    '</div>'+
						'</div>'+
					'</div>';
					$('.ph-item-'+value.supplier.toLowerCase()).remove();
                   
					$('#PlanListContainer').prepend(planEach);
					
					 $('[data-toggle="tooltip"]').tooltip();
                 
        });
        
        allowClickIdvedit();
        //loadminMaxassValue();
        $('.com-cover').prop("disabled", false); $(".com-cover").attr("disabled", false);
        $('.moter-OD').prop("disabled", false); $(".moter-OD").attr("disabled", false);
        $('.access-cover').prop("disabled", false); $(".access-cover").attr("disabled", false);
    }
    
    
     $('body').on('click','.selectPlan',function(e) {
         e.preventDefault();
         var id = $(this).attr('data-ref');
          var provider = $(this).attr('data-provider');
          $('#plan-'+id).loading({
            message: 'Preparing your request....'
          });
          
           var bikeInfo = JSON.parse(localStorage.getItem('bikeInfo'));
           var customerData = JSON.parse(localStorage.getItem('customersDetails'));
           var deviceToken = localStorage.getItem('deviceToken');
          $.post(base_url + "/bike-insurance/create-enquiry/",{provider:provider,id:id,deviceToken:deviceToken,bikeInfo:bikeInfo,customerData:customerData}, function (resp) {
            var status = $.trim(resp.status);
             if(status=='success'){
                var encId = resp.data.enq;
                window.location.href=base_url+"/bike-insurance/users-information/"+encId;
             }else{
                $('#plan-'+id).loading('stop');
               // alert("Something went wrong while preparing your request, try again!");
             }
           },'json');
     });
     
     
    function allowClickIdvedit(){
        //  var bikeInfo = JSON.parse(localStorage.getItem('bikeInfo'));
        //  bikeInfo.idv = { isLowest:"YES",value:0}
        //  localStorage.setItem("bikeInfo", JSON.stringify(bikeInfo));
        $('.idv-edit-th').attr('id','open-idv-modal');
        // $.get(base_url + "/bike-insurance/get-idv/", function (resp) {
        //     var st = $.trim(resp.status);
        //     if(st=='success'){
        //         $('#idvRange').attr('min',resp.min);
        // 	    $('#idvRange').attr('max',resp.max);
        // 	    $('#span-minIdv').text('Min:'+resp.min);
        // 	    $('#span-maxIdv').text('Max:'+resp.max)
        //     }
        // },'json');
        
    }
   
    var idvModal ="";
    $('body').on('click','#open-idv-modal', function(){
        var deviceToken = localStorage.getItem('deviceToken');
       idvModal =  $.dialog({
            title: '',
            content: 'url:'+base_url+"/common/load-idv-modal/BIKE/token",
            animation: 'scale',
            columnClass: 'medium',
            closeAnimation: 'scale',
            backgroundDismiss: true,
        });
    });

    $('body').on('click','.idvRadio', function(){
        val = $('input[name=idvRadio]:checked').val();
        if(val=='LOWEST'){
            var min = $('#idvRange').attr('min');
            $('#inputIdvValue').val(min);
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
       var bikeInfo = JSON.parse(localStorage.getItem('bikeInfo'));
       var val = $('input[name=idvRadio]:checked').val();
       var min = parseInt($('#idvRange').attr('min'));
       var max = parseInt($('#idvRange').attr('max'));
       var input = parseInt($('#inputIdvValue').val());
       if(val=='LOWEST'){ 
           bikeInfo.idv = { isLowest:"YES",value:min}
           $('#IdvCurrentValue').text("Lowest price");
           valid = true;
       }else{
           if(input>=min && input<=max){
               $('#error-text').text("");
               bikeInfo.idv = { isLowest:"NO",value:$('#inputIdvValue').val()}
               $('#IdvCurrentValue').text("₹"+$('#inputIdvValue').val());
               valid = true;
            }else{
               $('#error-text').text("Idv value should me in range.");
               valid = false;
            }
           
       }
        if(valid){
           localStorage.setItem("bikeInfo", JSON.stringify(bikeInfo));
           idvModal.close();
        //   $('#PlanListContainer').loading({ message: 'Fetching best plans for you...' });
        loadPlaceholder();
             loadPlans('recalculate');
                
        }
    });
    $('body').on('click','.Premium-Breakup', function(e){
        e.preventDefault();
        var ref = $(this).attr('data-ref');
           $.dialog({
                title: '',
                content: 'url:'+base_url+"/common/load-moter-premiumbreakup-modal/quote/"+ref,
                animation: 'scale',
                columnClass: 'medium',
                closeAnimation: 'scale',
                backgroundDismiss: true,
            });
    });


function updateAssesoriesValue(){
         loadPlaceholder();
         loadPlans('recalculate');
        
}

$('body').on('click','.btn-update-assVal',function(e) {
    var bikeInfo = JSON.parse(localStorage.getItem('bikeInfo'));
    var coverName = $(this).attr('id');
    if(coverName=="nonelectrical_ass_val"){
       var val =  $('#non_electrical_ass_Range').val();
         bikeInfo.subcovers.isNonElecAccCover=1;
         bikeInfo.subcovers.isNonElecAccCoverVal=val;
    
    }
    if(coverName=="electrical_ass_val"){
        var val =  $('#electrical_ass_Range').val();
        bikeInfo.subcovers.isElecAccCover=1;
        bikeInfo.subcovers.isElecAccCoverVal=val;
        $('#electrical_ass_Range').attr('value',val);
        $('#electrical_ass_val').find('span').text(val);
    }
    
    if(coverName=="cng_ass_val"){
        var val =  $('#cng_ass_Range').val();
        bikeInfo.subcovers.isCngKitCover=1;
        bikeInfo.subcovers.isCngKitCoverVal=val;
    }
    
    localStorage.setItem("bikeInfo", JSON.stringify(bikeInfo));
    updateAssesoriesValue();
})

 $('body').on('click','.addonAssCover',function(e) {
      var bikeInfo = JSON.parse(localStorage.getItem('bikeInfo'));
        var addonName = $(this).attr('name');
         if ($(this).is(":checked")) { 
              $('.'+addonName+'-elem').show();
         }else{ 
             $('.'+addonName+'-elem').hide();
              var isElecAccCover=($('input[name=isElecAccCover]:checked').val()==1)?1:0; 
              var isNonElecAccCover=($('input[name=isNonElecAccCover]:checked').val()==1)?1:0;
              bikeInfo.subcovers.isNonElecAccCover =  isNonElecAccCover;
              bikeInfo.subcovers.isElecAccCover=isElecAccCover;
              localStorage.setItem("bikeInfo", JSON.stringify(bikeInfo));
              updateAssesoriesValue();
         }
   });


var cng_ass_Range = $("#cng_ass_Range");
 cng_ass_Range.ionRangeSlider(
     {min: 10000,max: 80000,prefix: '₹',
       onFinish: function(data) {
           $("#cng_ass_val").find('span').text("₹"+data.from);
           //console.log(data.from)
       },
     });
//var cng_ass_rangeData = cng_ass_Range.data("ionRangeSlider");


 //var electrical_ass_Range = $("#electrical_ass_Range");

 var electrical_ass_Range = $("#electrical_ass_Range");
 electrical_ass_Range.ionRangeSlider(
     {min: 75,max: 3500,prefix: '₹',
       onFinish: function(data) {
           $("#electrical_ass_val").find('span').text("₹"+data.from);
           //console.log(data.from)
       },
     });
var electrical_ass_rangeData = $("#electrical_ass_Range").data("ionRangeSlider");


var nonelectrical_ass_Range = $("#non_electrical_ass_Range");
 nonelectrical_ass_Range.ionRangeSlider(
     {min: 75,max: 3500,prefix: '₹',
       onFinish: function(data) {
           $("#nonelectrical_ass_val").find('span').text("₹"+data.from);
           //console.log(data.from)
       },
     });
var nonelectrical_ass_rangeData = nonelectrical_ass_Range.data("ionRangeSlider");

function loadminMaxassValue(){
      var deviceToken = localStorage.getItem('deviceToken');
      $.get(base_url + "/commomn/load-min-max-value/bike/"+deviceToken, function (resp) {
         
          if(resp.electrical){
              
               $('.isElecAccCover-elem').find('table').find('.min-assval').text(resp.electrical.min);
               $('.isElecAccCover-elem').find('table').find('.max-assval').text(resp.electrical.max);
               $('#electrical_ass_Range').attr('min',resp.electrical.min);
               $('#electrical_ass_Range').attr('max',resp.electrical.max);
               $('#electrical_ass_Range').attr('value',resp.electrical.min);
               $('#electrical_ass_val').find('span').text(resp.electrical.min);
               electrical_ass_rangeData.update({min: resp.electrical.min,max: resp.electrical.max,from:resp.electrical.min});
          }
          if(resp.nonelectrical){
              $('.isNonElecAccCover-elem').find('table').find('.min-assval').text(resp.nonelectrical.min);
               $('.isNonElecAccCover-elem').find('table').find('.max-assval').text(resp.nonelectrical.max);
               $('#non_electrical_ass_Range').attr('min',resp.nonelectrical.min);
               $('#non_electrical_ass_Range').attr('max',resp.nonelectrical.max);
               $('#non_electrical_ass_Range').attr('value',resp.nonelectrical.min); 
               
               $('#nonelectrical_ass_val').find('span').text(resp.nonelectrical.min);
                nonelectrical_ass_rangeData.update({min: resp.nonelectrical.min,max: resp.nonelectrical.max,from:resp.nonelectrical.min});
          }
          
      },'json');
}


});



