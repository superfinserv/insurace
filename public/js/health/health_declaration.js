$(window).on('load', function(){
    var pageURL = $(location).attr("href");
      //alert(pageURL);
       var parts = pageURL.split("/");
       var enqid = parts[parts.length-1];
       enqid  = enqid.replace('#', '');
       $.get(base_url+"/health-insurance/get-pay-data/"+enqid,function(result){ 
                if($.trim(result.status)=='success'){
                  $('#proposalNum').val(result.proposal);
               }else{
                  $('#btnPaynow').remove(); 
               }
       }); 
});

function getPaymentForm(enqId){
     $.post(base_url+"/health-insurance/get-payment-form",{enqId:enqId},function(result){
         $('#declearationInfoFormBox').html(result);
         $('.btnPaynow').actionOnAttr(false,'disabled');
                    
     })
}

$('body').on('click','.addon-label',function(e){
        
        if($(".addon-label").length>0){
              var healthInfo = JSON.parse(localStorage.getItem('healthInfo'));
               var enqId =healthInfo.enq; 
               var amt =  $('.'+enqId+'-premium-amount').text();
             
              $('.'+healthInfo.enq+'-premium-amount').html('<span class="inline-loader"><span class="inline-loader-box"></span><span class="inline-loader-box"></span><span class="inline-loader-box"></span></span>');
              $('.btnPaynow').actionOnAttr(true,'disabled');
              var AddOns = "";
              
              $(".addon-label" ).each(function( index ) {
                  if($(this).prop("checked") == true){
                    AddOns = (AddOns!="")?AddOns+","+ $(this).val(): $(this).val();
                  }
              });
           
            healthInfo.AddOns = AddOns;
            localStorage.setItem("healthInfo", JSON.stringify(healthInfo));
            var postData = JSON.parse(localStorage.getItem('healthInfo'));
           
            
            $.post(base_url+"/health-insurance/update-premium-info",{enqId:enqId,addons:AddOns},function(result){ 
                console.log(result);
                if($.trim(result.status)=='success'){
                    $('#declearationInfoFormBox').empty();
                    getPaymentForm(enqId);
                    $('.'+enqId+'-premium-amount').text(result.data.amount);
                }else{
                    $('.btnPaynow').actionOnAttr(false,'disabled');
                     $('.'+enqId+'-premium-amount').text(result.data.amount);
                }
            },'json'); 
       }
});


$('body').on('click','#terms_conditions',function(e){ 
    if($('#terms_conditions').prop("checked") == true){
        $('#span-error').text("");
     }else{
         $('#span-error').text("Please agree with term & conditions.");
     }
});

$('body').on('click','.btnPaynow',function(e){ 
     $('#span-error').text("");
     if($('#terms_conditions').prop("checked") == true){
         $('#PAYMENTFORM').submit();
     }else{
         $('#span-error').text("Please agree with term & conditions.");
     }
     
});


 $("body").on("click","#copyClipboard",function(e){
      e.preventDefault();
      var copyText = document.getElementById("input-payment-link");
            copyText.focus();
            copyText.type="text";
	        copyText.select();
	        navigator.clipboard.writeText(copyText.value);
	        copyText.type = 'hidden';
	        document.execCommand('copy');
	                $.toast({
                       text: 'Link copied to clipbord',
                       showHideTransition: 'slide',
                       position:'bottom-right',
                       hideAfter:6000,
                       allowToastClose:false
                    });
                    
                    
        
 })

$("body").on("click","#GenratePaymentLink",function(e) {
        e.preventDefault();
        var enc = $(this).attr('data-enc');
        
        
         var loader = 'Sending <span class="inline-loader"><span class="inline-loader-box"></span><span class="inline-loader-box"></span><span class="inline-loader-box"></span></span>';
        
         var _this = $(this);
         var _html = _this.html();
            _this.attr('disabled',true);
            _this.prop('disabled',true);
         
            _this.html(loader);
        _this.css('height', '45px');
        $.post(base_url + "/health-insurance/genrate-payment-link/",{enquiryID:enc}, function (resp) {
             
              if(resp.status===true){
                   _this.html(_html);_this.attr('disabled',false);_this.prop('disabled',false);
                   toastr.success(resp.message,"Success",{positionclass:'toast-bottom-right'});
              }else{
                  _this.html(_html); _this.attr('disabled',false);_this.prop('disabled',false);
                  toastr.error(resp.message,"Error",{positionclass:'toast-bottom-right'});
              }
               
        },'json');
});


// $(document ).ready(function() {
//     var healthInfo = JSON.parse(localStorage.getItem('healthInfo')); 
//      healthInfo.enq = enqid;
// });