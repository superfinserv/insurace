$(function(){
    'use strict'
   $("#agentEducationalInfo").validate({
        rules: {
            'qualification': { required: true },
        },

        submitHandler: function (form) {
             $('.agentEducationalInfoBtn').loadButton('on',{ faClass:'fa',faIcon:'fa-spinner', doSpin:true, loadingText:'Updating Information...'});
             $.post(base_url+'/agent/update/educationalInfo',$(form).serialize(),function(result){
                 $(".agentEducationalInfoBtn").loadButton('off');
                if($.trim(result.status)=='success'){
                   $('.agent-educational-notify')._success(result.message); 
                }else{
                   $('.agent-educational-notify')._error(result.message);  
                }
            },'json')
            return false;
        }

    });
    
    $(document).on('click', '.btn-remove-file', function (e) { 
        var id =$('#_agent').val();
      
        $.confirm({
          title: 'Confirmation',
          content: "Sure you want to remove file?",
          typeAnimated: true,
          buttons: {
              confirm: function () {
                $.get(base_url+"/agents/files/remove/education_certificate/"+id,function(resp) {
                    if(resp.status=='success'){
                        $('.table-file-has').hide();
                        $('.table-file-choose').show();
                         $('.agent-educational-notify')._success(resp.message); 
                    }else{
                       $('.table-file-has').show();
                        $('.agent-educational-notify')._error(resp.message); 
                    }
                },'json');
              },
              cancel: function () {
                 
              }
          }
      });
 
    });
    
    
    $('body').on('click','#uploadEduCert',function () {
                
                   
                    var myfile = $('#new_educational_cert').val();
                    if(myfile == '') {
                        alert('Please enter file name and select file');
                        return;
                    }
                    $('#myprogress-container').show();
                    $('.myprogress').css('width', '0');
                    var formData = new FormData();
                    formData.append('new_educational_cert', $('#new_educational_cert')[0].files[0]);
                    //formData.append('filename', filename);
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
                                        $('.myprogress').addClass('bg-success');
                                    }
                                    $('.myprogress').text(percentComplete + '%');
                                    $('.myprogress').css('width', percentComplete + '%');
                                }
                            }, false);
                            return xhr;
                        },
                        success: function (data) {
                            console.log(data);
                             $('#myprogress-container').hide();
                            if($.trim(data.status)=="success"){
                                $('.myprogress').css('width', '0');
                                $('.table-file-choose').hide();
                                $('.table-file-has').show();
                                $('.agent-educational-notify')._success(data.message); 
                                if(data.filename){ $('#education_certificate_name').text(data.filename);}
                            }else{
                               $('.agent-educational-notify')._error(data.message); 
                            }
                            
                        }
                    });
                });
        

    
});
    
    
    
    