
// $(window).load(function() {
//     var pageURL = $(location).attr("href");
//       //alert(pageURL);
//       var parts = pageURL.split("/");
//       var enqid = parts[parts.length-1];
//       enqid  = enqid.replace('#', '');
//       var healthInfo = JSON.parse(localStorage.getItem('healthInfo')); 
//       healthInfo.enq = enqid;
//       healthInfo.AddOns ="";
//       localStorage.setItem("healthInfo", JSON.stringify(healthInfo));
// });

// function checkValidate(formData,localData){
//         var mArr =  localData.members;
//         if( mArr.some(item => item.type === 'wife')){
//             if(formData.self_mstatus=="Single"){
//               return "One of insurer has spouse, can't choose single"; 
//             }else{
//                 return "";
//             }
//         }else{
//             return "";
//         }
//     }

var isMobile = {
Android: function() {
  return navigator.userAgent.match(/Android/i);
},
BlackBerry: function() {
  return navigator.userAgent.match(/BlackBerry/i);
},
iOS: function() {
  return navigator.userAgent.match(/iPhone|iPad|iPod/i);
},
Opera: function() {
  return navigator.userAgent.match(/Opera Mini/i);
},
Windows: function() {
  return navigator.userAgent.match(/IEMobile/i);
},
any: function() {
  return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
}
};

$("#planSumInsured").selectize({
          create: true,
          sortField: "value",
        });


$('body').on('click','#wp-button',function(e){
    var text = $(this).attr("data-message");
    var phone = $('#shareMobileNo').val();
    console.log(phone,text);
    if(phone!=""){
       phone = '91'+$('#shareMobileNo').val();
        var message = encodeURIComponent(text);
        
        if( isMobile.any() ) {
             //mobile device
            var whatsapp_API_url = "whatsapp://send";
             window.open(whatsapp_API_url+'?phone=' + phone + '&text=' + message, '_blank');
           // $('#wplink').attr( 'href', whatsapp_API_url+'?phone=' + phone + '&text=' + message );
            $('#whatsAppElemInit').css('display','table-row');
             $('#whatsAppElem').css('display','none');
        } else {
            //desktop
            var whatsapp_API_url = "https://web.whatsapp.com/send";
            window.open(whatsapp_API_url+'?phone=' + phone + '&text=' + message, '_blank');
             $('#whatsAppElemInit').css('display','table-row');
             $('#whatsAppElem').css('display','none');
          //  $('#wplink').attr( 'href', whatsapp_API_url+'?phone=' + phone + '&text=' + message );
        }
    }else{
       $('#shareMobileNo').css('border-color','#c42f2f'); 
    }
});

$('body').on('keyup','#shareMobileNo',function(){
    $('#shareMobileNo').css('border-color','#cccccc'); 
})

$('body').on('click','#shareOnWp',function(e){
    e.preventDefault(); 
    $('#whatsAppElemInit').css('display','none');
    $('#whatsAppElem').css('display','table-row');
})



function getPlanData(act){
    var loader = '<span class="inline-loader"><span class="inline-loader-box"></span><span class="inline-loader-box"></span><span class="inline-loader-box"></span></span>';
    //var healthInfo = JSON.parse(localStorage.getItem('healthInfo')); 
    //var enqId =healthInfo.enq;
    var enqId = $('#enQId').val();
    var termYear = $("input[name='planYear']:checked").val();
    var sumInsured = $("#planSumInsured").val();
    // if($('.addon-ncb').length>0){ 
    //     if(parseInt(sumInsured)>5){
              
    //     }else{
            
           
    //     }
    // }
    // if($('#enQ-'+enqId).attr('data-product')=='CAREWITHNCB' && sumInsured>5){
    //     
    // }
    
    
    
    var FormData = {enqId:enqId,termYear:termYear,sumInsured:sumInsured,action:act};
    var AddOns = "";
        if($(".addon-label").length>0){ 
             $(".addon-label" ).each(function( index ) {
                  if($(this).prop("checked") === true){
                    AddOns = (AddOns!=="")?AddOns+","+ $(this).val(): $(this).val();
                    if($(this).val()=="OPDCC1122"){
                         
                         AddOns = AddOns+","+ $("input[name='OPDCC1122']:checked").val();
                    }
                  }
              });
          FormData.addons = AddOns;
        }
    if($(".updateZone").length>0){
      var zoneType = $("input[name='zoneType']:checked").val();
        FormData.zoneType = zoneType;
    }
    $('.card-body').loading();
    $('#'+enqId+'-planYear_1').html(loader);
    $('#'+enqId+'-planYear_2').html(loader);
    $('#'+enqId+'-planYear_3').html(loader);
    //if(AddOns!==""){
        
    //}
    $.post(base_url + "/health-insurance/update-quote",FormData, function (resp) { 
       if(resp.status===true){
             $('#'+resp.data.enq+'-termYear').text(resp.data.termYear);
             $('#'+resp.data.enq+'-sumInsured').text(resp.data.sumInsured);
             $('#'+resp.data.enq+'-planTitle').text(resp.data.title); //((resp.data.extParam=="" && resp.data.SI<=5) ||
             if(resp.data.partner!="1967"){
                 if((resp.data.partner=="608" || resp.data.partner=="611")  &&
                     (  ( (resp.data.extParam=="" || resp.data.extParam=="CAREWITHNCB") && parseInt(resp.data.SI)>=7) || (resp.data.extParam=="" && parseInt(resp.data.SI)<=5)) ){
                     if($('#addOn4').length===0){ 
                         $('.addon-container').append('<input id="addOn4" value="CAREWITHNCB" name="addOn4" type="checkbox" class="addon-ncb addonInput addon-label"/><label style="margin-top: 20px;" class="addon-ncb" for="addOn4">NCB Super</label>');
                     }
                         
                 }else{
                  $('.addon-ncb').remove();
                 }
            }
            $.each(resp.data.amt, function(i, item) { 
               // console.log(i, item);
              
                if(i==resp.data.termYear){
                    $.each(item, function(str, val) {
                           if(str=="Addons"){
                               //console.log("--Addons",val);
                               $('.TRaddonElem').remove();
                               
                               if(val.length){
                                   
                                   $('#noAddonsTr').remove();
                                   $.each(val, function(ad, addon) {
                                        //console.log(ad,addon);
                                        //if(addon.premium!="Added")
                                        var adP = new Intl.NumberFormat('en-IN', { 
                                                style: 'currency', 
                                                currency: 'INR' 
                                            }).format(addon.premium);
                                            console.log(adP);
                                       adP = (adP=='₹0.00')?'Added':adP;
                                   var TR = '<tr class="TRaddonElem">'
                                              +'<td style="font-size: 13px;color: #000;padding: 15px 10px;">'+addon.title+'</td>'
                                              +'<td style="font-weight: 700;font-size: 13px;color: #000;padding: 15px 10px;">'
                                                      +'<span id="'+resp.data.enq+'-addonElem">'+adP+'</span></td>'
                                            +'</tr>';
                                     $('#rightPlanSummaryTbl tr#addonsBeforeTr').before(TR);
                                   });
                               }else{
                                 $('.TRaddonElem').remove();
                                 if(!$('#noAddonsTr').length){
                                 $('#rightPlanSummaryTbl tr#addonsBeforeTr').before('<tr id="noAddonsTr">'
                                    +'<td style="font-size: 13px;color: #000;padding: 15px 10px;">No-addons selected</td>'
                                    +'<td style="font-weight: 700;font-size: 13px;color: #000;padding: 15px 10px;">'
                                    +'<span>₹0.00</span></td>'
                                  +'</tr>');
                                 }
                                 
                               }
                            }else{
                                var x = new Intl.NumberFormat('en-IN', { 
                                    style: 'currency', 
                                    currency: 'INR' 
                                }).format(val);
                              $('#'+resp.data.enq +'-'+str).text($.trim(x));
                            }
                    }) 
                }
                //     console.log(item);
                    var BaseP = new Intl.NumberFormat('en-IN', { 
                        style: 'currency', 
                        currency: 'INR' 
                    }).format(item.Base_Premium);
                    $('#'+resp.data.enq+'-planYear_'+i).text(BaseP);
                //}
                $('.plan-title').text(resp.data.title);
            })
        }
         $('.card-body').loading('stop');
    })
}


$('body').on('click','.updateQuote',function(e){
    if($('.section-planYear').length>1){
       getPlanData('TermYear');
    }
})
$('body').on('change','#planSumInsured',function(e){
     getPlanData('sumInsured');
});

$('body').on('click','.updateZone',function(e){
    if($(".updateZone").length>0){
       getPlanData('zone');
    }
});

$('body').on('click','.addon-label',function(e){
       
           if($(this).val()=="OPDCC1122"){
               if($(this).prop("checked") === true){
                    $('.addon-elem-OPDCC1122').show();
                   }else{
                    $('.addon-elem-OPDCC1122').hide();
                }
           }else{
                 $('.addon-elem-OPDCC1122').hide();
           }
            
       
        if($(".addon-label").length>0){ 
            getPlanData('addon');
        }
});
$('body').on('click',"input[name='OPDCC1122']",function(e){
     if($(".addon-label").length>0){ 
            getPlanData('addon');
        }
})

$('body').on('click','#proceed-proposal',function(e){ 
    e.preventDefault();
    //   var pageURL = $(location).attr("href");
    //   var parts = pageURL.split("/");
    //   var enqid = parts[parts.length-1];
    //   enqid  = enqid.replace('#', '');
      var enqid = $('#enQId').val();
      window.location.href = base_url+"/health-insurance/proposal/"+enqid
})

$('body').on('click','.downloadQuoteLink',function(e){ 
    e.preventDefault();
    var enQ = $('#enQId').val();
    window.location.href=base_url+"/download-quote/health-insurance/"+enQ;
})

// $('body').on('click','#btnUpdateZone',function(e){
//       var healthInfo = JSON.parse(localStorage.getItem('healthInfo')); 
    
//       $('.btn-next').actionOnAttr(true,'disabled');
//       $('.btn-pre').actionOnAttr(true,'disabled');
//       var enq =healthInfo.enq;
//       var zone = $('#input-zone').val();
//       $('#'+enq+'-premium-amount').html('<span class="inline-loader"><span class="inline-loader-box"></span><span class="inline-loader-box"></span><span class="inline-loader-box"></span></span>');
//       $('#page-proposal').loading({
//           theme: 'dark',
//           message: 'Loading...'
//         });
//     $.post(base_url + "/health-insurance/update-zone-quick-quote",{enq:enq,zone:zone}, function (resp) {
//             $('#page-proposal').loading('stop');
//             $('.btn-next').actionOnAttr(false,'disabled');
//             $('.btn-pre').actionOnAttr(false,'disabled');
//               if(resp.status=='success'){
//                   $('#'+enq+'-premium-amount').text(resp.data.amount);
//               }else{
//                   toastr.error(resp.message);
                   
//               }
//     },'json')
// });

// $('body').on('click','.addon-label',function(e){
        
//         if($(".addon-label").length>0){
//               var healthInfo = JSON.parse(localStorage.getItem('healthInfo'));
//               var enqId =healthInfo.enq; 
//               var amt =  $('.'+enqId+'-premium-amount').text();
//              $('.btn-next').loadButton('on',{
//                 faClass:'fa',
//                 faIcon:'fa-spinner',
//                 doSpin:true,
//                 loadingText:'Calculating...',
//               });
//               $('#'+healthInfo.enq+'-premium-amount').html('<span class="inline-loader"><span class="inline-loader-box"></span><span class="inline-loader-box"></span><span class="inline-loader-box"></span></span>');
//               //$('.btnPaynow').actionOnAttr(true,'disabled');
//               var AddOns = "";
              
//               $(".addon-label" ).each(function( index ) {
//                   if($(this).prop("checked") == true){
//                     AddOns = (AddOns!="")?AddOns+","+ $(this).val(): $(this).val();
//                   }
//               });
           
//             healthInfo.AddOns = AddOns;
//             localStorage.setItem("healthInfo", JSON.stringify(healthInfo));
//             // var postData = JSON.parse(localStorage.getItem('healthInfo'));
           
            
//             $.post(base_url+"/health-insurance/update-quick-quote-with-addons",{enqId:enqId,addons:AddOns},function(result){ 
//                 console.log(result);
//                 if($.trim(result.status)=='success'){
//                     // $('#declearationInfoFormBox').empty();
//                     // getPaymentForm(enqId);
//                      $('#'+enqId+'-premium-amount').text(result.amount);
//                       $('.btn-next').loadButton('off');
//                 }else{
//                     // $('.btnPaynow').actionOnAttr(false,'disabled');
//                       $('#'+enqId+'-premium-amount').text(result.amount);
//                         $('.btn-next').loadButton('off');
//                 }
               
//             },'json'); 
//       }
// });
 
 