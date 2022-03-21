$(function(){
    'use strict'
   $("#agentDocInfo").validate({
        rules: {
            'pan_card_no': { required: true, },
            'address_proff': { required: true },
           
        },

        submitHandler: function (form) {
             $('.agentDocInfoBtn').loadButton('on',{ faClass:'fa',faIcon:'fa-spinner', doSpin:true, loadingText:'Updating Information...'});
             $.post(base_url+'/agent/update/documentInfo',$(form).serialize(),function(result){
                 $(".agentBankInfoBtn").loadButton('off');
                if($.trim(result.status)=='success'){
                   $('.agent-doc-notify')._success(result.message); 
                }else{
                   $('.agent-doc-notify')._error(result.message);  
                }
            },'json')
            return false;
        }

    });
    
    $(document).on('click', '.btn-remove-file', function (e) { 
        var id =$('#_agent').val();
        var doc = $(this).attr('data-doc');
        var path = "";
        if(doc=='pan_card'){ path ="/agents/files/remove/pan_card/";}
        if(doc=='adhaar_card'){ path ="/agents/files/remove/adhaar_card/";}
        if(doc=='adhaar_card_back'){ path ="/agents/files/remove/adhaar_card_back/";}
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
                         $('.agent-doc-notify')._success(resp.message); 
                    }else{
                       $('.table-file-has-'+doc).show();
                        $('.agent-doc-notify')._error(resp.message); 
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
            if(doc=='pan_card'){  myfile = $('#new_pan_card').val();}
            if(doc=='adhaar_card'){  myfile = $('#new_adhaar_card').val();}
            if(doc=='adhaar_card_back'){  myfile = $('#new_adhaar_card_back').val();}
            
            if(myfile == '') {
                alert('Please enter file name and select file');
                return;
            }
            $('#myprogress-container-'+doc).show();
            $('.myprogress-'+doc).css('width', '0');
            var formData = new FormData();
            if(doc=='pan_card'){  formData.append('new_pan_card', $('#new_pan_card')[0].files[0]);}
            if(doc=='adhaar_card'){  formData.append('new_adhaar_card', $('#new_adhaar_card')[0].files[0]);}
            if(doc=='adhaar_card_back'){ formData.append('new_adhaar_card_back', $('#new_adhaar_card_back')[0].files[0]);}
           // formData.append('new_passbook_statement', $('#new_passbook_statement')[0].files[0]);
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
                        $('.agent-doc-notify')._success(data.message); 
                        if(data.filename){ $('#'+doc+'_name').text(data.filename);}
                    }else{
                       $('.agent-doc-notify-'+doc)._error(data.message); 
                    }
                    
                }
            });
            
        });
        

    
});
    
    
    
    