$(function(){
    'use strict'
   
    
    $(document).on('click', '#btn-remove-file', function (e) { 
        var id =$('#_agent').val();
      
        $.confirm({
          title: 'Confirmation',
          content: "Sure you want to remove video?",
          typeAnimated: true,
          buttons: {
              confirm: function () {
                $.get(base_url+"/agents/files/remove/identity_video/"+id,function(resp) {
                    if(resp.status=='success'){
                       $('.agent-identity-notify')._success(resp.message); 
                       setTimeout(function(){ location.reload(true) }, 5000);
                    }else{
                       $('.agent-identity-notify')._error(resp.message); 
                       setTimeout(function(){ location.reload(true) }, 5000);
                    }
                },'json');
              },
              cancel: function () {
                 
              }
          }
      });
 
    });
    
    
    $('body').on('click','#uplodNewVideo',function () {
                
                   
                    var myfile = $('#newVideo').val();
                    if(myfile == '') {
                        alert('Please enter file name and select file');
                        return;
                    }
                    $('#myprogress-container').show();
                    $('.myprogress').css('width', '0');
                    var formData = new FormData();
                    formData.append('newVideo', $('#newVideo')[0].files[0]);
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
                                $('.agent-identity-notify')._success(data.message); 
                                 setTimeout(function(){ location.reload(true) }, 5000);
                            }else{
                               $('.agent-identity-notify')._error(data.message);
                                setTimeout(function(){ location.reload(true) }, 5000);
                            }
                            
                        }
                    });
                });
        

    
});
    
    
    
    