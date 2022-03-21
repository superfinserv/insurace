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
          $('#PAYMENTFORM').submit();
     }else{
           $( "#effect" ).effect( 'shake', {}, 500, callbackEffect );  
    }
 });
 

