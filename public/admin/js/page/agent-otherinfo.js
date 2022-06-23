$(function(){
    'use strict'
   
    
     $(document).on('click', '.agent-hdfc-btn', function (e) { 
         e.preventDefault();
          var _this = $(this);
           
          $('#hdfc_id-error').remove();
         var hdfc_id = $('#hdfc_id').val();
         if(hdfc_id!=""){
            // $('.agent-hdfc-btn').loadButton('on',{ faClass:'fa',faIcon:'fa-spinner clr', doSpin:true, loadingText:''});
            _this.find('.fas').removeClass('fa-check');
           _this.find('.fas').addClass("fa-circle-notch fa-spin");
            $.post(base_url+'/agent/update/otherInfo',{hdfc_id:hdfc_id,_agent:$('#_agent').val()},function(result){
                 _this.find('.fas').removeClass("fa-circle-notch fa-spin");
                      _this.find('.fas').addClass('fa-check');
               if($.trim(result.status)=='success'){
                   $('.agent-other-notify')._success(result.message); 
                }else{
                   $('.agent-other-notify')._error(result.message);  
                } 
            },'json')  
         }else{
             $('#hdfc_id').parent().after('<span id="hdfc_id-error" class="error">This filed is required.</span>');
         }
     });
     
     
     $(document).on('keyup', '#hdfc_id', function (e) { 
        e.preventDefault();
        var hdfc_id = $(this).val(); 
        if(hdfc_id==""){
            $('#hdfc_id').parent().after('<span id="hdfc_id-error" class="error">This filed is required.</span>');
        }else{
            $('#hdfc_id-error').remove();
        }
        
    });
    
    $(document).on('keyup', '.tr-field', function (e) { 
        e.preventDefault();
        var val = $(this).val();
        var id = $(this).attr('id');
        if(val==""){
            $('#'+id).parent().after('<span id="'+id+'-error" class="error">This filed is required.</span>');
        }else{
            $('#'+id+'-error').remove();
        }
        
    });
    
    
    $(document).on('click', '.btn-send-tr-crd', function (e) { 
         e.preventDefault();
          $('#tr_username-error').remove();$('#tr_pass-error').remove();
          var isValid = 0;
          if($('#tr_username').val()===""){ isValid++;  $('#tr_username').parent().after('<span id="tr_username-error" class="error">This filed is required.</span>'); }
          if($('#tr_pass').val()===""){ isValid++;  $('#tr_pass').parent().after('<span id="tr_pass-error" class="error">This filed is required.</span>');}
          if(isValid===0){
               $('.btn-send-tr-crd').loadButton('on',{ faClass:'fa',faIcon:'fa-spinner', doSpin:true, loadingText:'Sending..'});
               $.post(base_url+'/agent/send/tranning_info',{username:$('#tr_username').val(),pass:$('#tr_pass').val(),_agent:$('#_agent').val()},function(result){
                       $(".btn-send-tr-crd").loadButton('off');
                       if($.trim(result.status)=='success'){
                           $('.agent-other-notify')._success(result.message); 
                        }else{
                           $('.agent-other-notify')._error(result.message);  
                        } 
            },'json')
          }
         
            
    });
    
    
    $(document).on('change', '#sp_id', function (e) { 
        e.preventDefault();
        var spId = $(this).val(); 
        if(spId==""){
            $('#sp_id').parent().after('<span id="sp_id-error" class="error">Please choose Specified Person to map POSP.</span>');
        }else{
            $('#sp_id-error').remove();
        }
        
    });
    
    
    
    
     $(document).on('click', '.agentSpMapBtn', function (e) { 
         e.preventDefault();
          $('#sp_id-error').remove();
           var _this = $(this);
          
         var spId = $('#sp_id').val();
         
         if(spId!==""){
              _this.find('.fas').removeClass('fa-check');
           _this.find('.fas').addClass("fa-circle-notch fa-spin");
           // $('.agentSpMapBtn').loadButton('on',{ faClass:'fa',faIcon:'fa-spinner', doSpin:true, loadingText:''});
                $.post(base_url+'/agent/update/otherInfo',{sp_id:spId,_agent:$('#_agent').val()},function(result){
                   
                      _this.find('.fas').removeClass("fa-circle-notch fa-spin");
                      _this.find('.fas').addClass('fa-check');
                    if($.trim(result.status)=='success'){
                       $('.agent-other-notify')._success(result.message); 
                    }else{
                       $('.agent-other-notify')._error(result.message);  
                    }
                },'json');
         }else{
             $('#sp_id').parent().after('<span id="sp_id-error" class="error">Please choose Specified Person to map POSP.</span>')
         }
     })
    
    $(document).on('click', '#isTranningCompletedBtn', function (e) { 
          var id =$('#_agent').val();
          let st = "No"
          if($('#isTranningCompleted').is(":checked")){
              st = "Yes"
          }
                   $.post(base_url+"/agent/internal/status/manage/",{id:id,'param':'testStatus','status':st},function(resp) {
                    if($.trim(resp.status)=='success'){
                         notification($.trim(resp.status),resp.message);
                    }else{
                        notification($.trim(resp.status),resp.message);
                    }
                },'json');
        //   }else{
        //       notification('error',"Please check the checkbox to allow certification test.");
        //   }
    })
    
   
    $(document).on('click', '.btn-remove-file', function (e) { 
        var id =$('#_agent').val();
        var doc = $(this).attr('data-doc');
        var path = "";
        if(doc=='life_ins_cert'){ path ="/agents/files/remove/life_ins_cert/";}
        if(doc=='general_ins_cert'){ path ="/agents/files/remove/general_ins_cert/";}
        $.confirm({
          title: 'Confirmation',
          content: "Sure you want to remove file?",
          typeAnimated: true,
          buttons: {
              confirm: function () {
                $.get(base_url+path+id,function(resp) {
                    if(resp.status=='success'){
                        $('.table-file-has-'+doc).hide();
                        $('.table-file-choose-'+doc).show();
                         $('.agent-other-notify')._success(resp.message); 
                    }else{
                       $('.table-file-has-'+doc).show();
                        $('.agent-other-notify')._error(resp.message); 
                    }
                },'json');
              },
              cancel: function () {
                 
              }
          }
      });
 
    });
    
    $('body').on('click','.uploadattach',function () {
           var doc = $(this).attr('data-doc');
           var myfile = "";
            if(doc=='life_ins_cert'){  myfile = $('#new_life_ins_cert').val();}
            if(doc=='general_ins_cert'){  myfile = $('#new_general_ins_cert').val();}
            
            if(myfile == '') {
                alert('Please enter file name and select file');
                return;
            }
            $('#myprogress-container-'+doc).show();
            $('.myprogress-'+doc).css('width', '0');
            var formData = new FormData();
            if(doc=='life_ins_cert'){  formData.append('new_life_ins_cert', $('#new_life_ins_cert')[0].files[0]);}
            if(doc=='general_ins_cert'){  formData.append('new_general_ins_cert', $('#new_general_ins_cert')[0].files[0]);}
            formData.append('id', $('#_agent').val());
            $.ajax({
                url: base_url+'/agent/files/upload/',
                data: formData,
                processData: false,
                contentType: false,
                type: 'POST',
                dataType:"json",
                // this part is progress bar
                xhr: function () {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function (evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                            percentComplete = parseInt(percentComplete * 100);
                            if(percentComplete>=50){
                                $('.myprogress-'+doc).addClass('bg-success');
                            }
                            $('.myprogress-'+doc).text(percentComplete + '%');
                            $('.myprogress-'+doc).css('width', percentComplete + '%');
                        }
                    }, false);
                    return xhr;
                },
                success: function (data) {
                    console.log(data);
                     $('#myprogress-container-'+doc).hide();
                    if($.trim(data.status)=="success"){
                        $('.myprogress-'+doc).css('width', '0');
                        $('.table-file-choose-'+doc).hide();
                        $('.table-file-has-'+doc).show();
                        $('.agent-other-notify')._success(data.message); 
                        if(data.filename){ $('#'+doc+'_name').text(data.filename);}
                    }else{
                       $('.agent-other-notify-'+doc)._error(data.message); 
                    }
                    
                }
            });
            
        });
    
    
});