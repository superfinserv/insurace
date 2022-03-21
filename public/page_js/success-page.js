// $(document).ready(function() {
//       window.history.pushState(null, "", window.location.href);        
//       window.onpopstate = function() {
//           window.history.pushState(null, "", window.location.href);
//       };
//   });
  
 // window.onbeforeunload = function() { return "Your work will be lost."; };
 
 history.pushState(null, null, location.href);
    window.onpopstate = function () {
        history.go(1);
    };
    
    
$(document).ready(function(){
    'use strict';
     var _token = $('meta[name="csrf-token"]').attr('content'); 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': _token
        }
    });
    
     $('body').on('click',"#getPolicyDoc", function(e) {
         e.preventDefault();
         var loader = '<span class="inline-loader"><span class="inline-loader-box"></span><span class="inline-loader-box"></span><span class="inline-loader-box"></span></span>';
   
         var policyid = $(this).attr('data-id');
         var opt = $(this).attr('data-opt');
         
         var td = $('#'+opt+'DocTd');
         
         var clone = $(this).clone();
         td.html(loader);
        $.post(base_url+"/get-policy-document",{id:policyid,opt:opt},function(result){
              var st = $.trim(result.status);
              
              if(st=='success'){
                   if(result.provider=="MANIPAL_CIGNA"){ 
                       if(opt=="Receipt"){
                            $('#ReceiptDocTd').html('<a  style="color:#C52118" target="_blank" href="'+result.data.receiptPath+'">'
                                          +'<i style="font-size: 16px;" class="fa fa-download"></i>'
                                          +'Download Transaction Receipt'
                                      +'</a>'); 
                       }else{
                          td.html('<a  style="color:#C52118" target="_blank" href="'+result.data.path+'">'
                                          +'<i style="font-size: 16px;" class="fa fa-download"></i>'
                                          +'Download Policy PDF'
                                      +'</a>');  
                       }
                       
                   }else{
                      td.html('<a  style="color:#C52118" target="_blank" href="'+result.data.path+'">'
                                          +'<i style="font-size: 16px;" class="fa fa-download"></i>'
                                          +'Download Policy PDF'
                                      +'</a>'); 
                   }
                    
                    if(result.provider=="DIGIT" && result.type=="HEALTH"){
                       $('#ProposalDocTd').html('<a  style="color:#C52118" target="_blank" href="'+result.data.pathProposal+'">'
                                          +'<i style="font-size: 16px;" class="fa fa-download"></i>'
                                          +'Download Policy Proposal'
                                      +'</a>'); 
                       $('#eCardDocTd').html('<a  style="color:#C52118" target="_blank" href="'+result.data.pathEcard+'">'
                                          +'<i style="font-size: 16px;" class="fa fa-download"></i>'
                                          +'Download Policy eCard'
                                      +'</a>'); 
                    }
                  toastr.success(result.message,'Success');
              }else{
                  td.html(clone);
                  toastr.error(result.message,'Error');
              }
        },'json');
    });
    
     $('body').on('click',"#getPolicyStatus", function(e) {
         e.preventDefault();
         var loader = 'Please Wait <span class="inline-loader"><span class="inline-loader-box"></span><span class="inline-loader-box"></span><span class="inline-loader-box"></span></span>';
        var _this =$(this); 
         var enQid = $(this).attr('data-enq');
         
         var clone = $(this).clone();
          $(this).html(loader);
          $.post(base_url+"/get-policy-status",{enq:enQid},function(result){
              var st = $.trim(result.status);
              
              if(st=='success'){
                   _this.html(clone);
                  toastr.success(result.message,'Success');
              }else{
                   _this.html(clone);
                  toastr.error(result.message,'Error'); 
              }
          },'json');
     })
});