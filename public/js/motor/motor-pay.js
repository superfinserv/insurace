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
           var connectUrl = ($('.link-section').attr('data-type')=="BIKE")?"/twowheeler-insurance/":"/car-insurance/";
          $.post(base_url + connectUrl+"connect-to-insurer/",{enc:enc}, function (resp) {
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
               
         }).fail(function() {
                   _this.html(_html);_this.attr('disabled',false);_this.prop('disabled',false);
                   toastr.error("Internal server error","Error",{positionclass:'toast-bottom-right'});
         });
        }
     }else{
           $( "#effect" ).effect( 'shake', {}, 500, callbackEffect );  
    }
 });
 

