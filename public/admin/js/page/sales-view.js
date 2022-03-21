$(function(){
    'use strict'
     var _token = $('meta[name="csrf-token"]').attr('content'); 
    $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': _token
         }
    });
    
     
   $('body').on('click','.get-policy-doc',function(e){
         var _this = $(this);
         var policyid = $(this).attr('data-id');
         var provider = $(this).attr('data-provider');
         _this.find('div').find('.fa').removeClass('fa-globe').addClass('fa-spinner fa-spin');
          $.post(base_url+"/sales/insured/getpdf",{policyid:policyid},function(result){
              var st = $.trim(result.status);
              if(st=="success"){
                 _this.find('div').find('.fa').removeClass('fa-spinner fa-spin').addClass('fa-download');
                 _this.attr('href',result.filePath)
                 if(provider=='DIGIT'){
                     if(result.eCardPath!=""){
                         $('.file-eCard').find('div').find('.fa').removeClass('fa-spinner fa-spin').addClass('fa-download');
                         $('.file-eCard').attr('href',result.eCardPath);
                     }else{
                         $('.file-eCard').find('div').find('.fa').removeClass('fa-spinner fa-spin').addClass('fa-globe');
                     }
                     if(result.proposalPath!=""){
                         $('.file-Proposal').find('div').find('.fa').removeClass('fa-spinner fa-spin').addClass('fa-download');
                         $('.file-Proposal').attr('href',result.proposalPath);
                     }else{
                         $('.file-Proposal').find('div').find('.fa').removeClass('fa-spinner fa-spin').addClass('fa-globe');
                     }
                     
                 }
                 
                  notification('success',result.message); 
                }else{
                 _this.find('div').find('.fa').removeClass('fa-spinner fa-spin').addClass('fa-globe');
                  notification('error',result.message); 
                }
          },'json')
    });
   
  
 });
