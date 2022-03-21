$(function(){
    'use strict'
    
    
   
   $('body').on('change','.select-temp-setting',function(e){
       var id = $(this).attr('data-id');
       var typ = $(this).attr('data-typ');
       var val = $(this).val();
       var  FORMDATA = {id:id,typ:typ,val:val}
       var title = $(this).attr('data-subject'); 
      $.post(base_url+'/notification/template/settings/update',FORMDATA,function(result){
         if($.trim(result.status)){
             //$('.notify-template-notify')._success(result.message);
             notification('success',result.message); 
         }else{
            // $('.notify-template-notify')._error(result.message);
             notification('error',result.message); 
         } 
      },'json');
   });
  
   
   
    
   
 });
