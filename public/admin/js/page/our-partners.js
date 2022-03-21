 $(function(){
    'use strict'
    $("#OurPartnerForm").validate({
        rules: {
            'pname': { required: true },
            
            'plogo': { required: true},

        },

       submitHandler: function (form) {
           
            var formData = new FormData();
                    formData.append('plogo', $('#plogo')[0].files[0]);
                    formData.append('pname', $('#pname').val());
                    $.ajax({
                        url: base_url+'/our-partners/save/',
                        data: formData,
                        processData: false,
                        contentType: false,
                        type: 'POST',
                        dataType:"json",
                        success: function (data) {
                            if($.trim(data.status)=="success"){
                                $('#row-partners').append(data.data_html);
                                $('.our-partners-notify')._success(data.message); 
                                $('#OurPartnerForm').get(0).reset();
                                
                            }else{
                              $('.our-partners-notify')._error(data.message); 
                            }
                            
                        }
                    });

             return false;
         }

    });
    

  $("body").on('change',"#plogo", function(){
        var fileUpload = $("#plogo")[0];
        
        //Check whether the file is valid Image.
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(.jpg|.png|.jpeg)$");
        if (regex.test(fileUpload.value.toLowerCase())) {
            console.log("regex match");
            //Check whether HTML5 is supported.
            if (typeof (fileUpload.files) != "undefined") {
                // console.log("typeof match");
                //Initiate the FileReader object.
                var reader = new FileReader();
                //Read the contents of Image File.
                reader.readAsDataURL(fileUpload.files[0]);
                
                reader.onload = function (e) {
                   // console.log("reader match");
                    //Initiate the JavaScript Image object.
                    var image = new Image();
                    //Set the Base64 string return from FileReader as source.
                    image.src = e.target.result;
                    image.onload = function () {
                        
                        //Determine the Height and Width.
                        var height = parseInt(this.height);
                        var width = parseInt(this.width);
                         console.log(height,width);
                        if (height == 200 && width ==200) {
                            $('#plogo-error').text("");
                            $('#saveOurPartnerInfoBtn').attr('disabled',false);$('#saveOurPartnerInfoBtn').prop('disabled',false);
                            //console.log("image height-width match");
                            //$('#agentImagesrc').attr('src', image.src);
                            //uplpoadAgentImage();
                            // return true; 
                        }else{
                            //console.log("height-width not match");
                            $('#plogo-error').text("Logo Height and Width must be 200X200px."); 
                             $('#saveOurPartnerInfoBtn').attr('disabled',true);$('#saveOurPartnerInfoBtn').prop('disabled',true);
                            //return false;
                        }
                        
                    };
                }
            } else {
                $('#plogo-error').text('This browser does not support.');
                $('#saveOurPartnerInfoBtn').attr('disabled',true);$('#saveOurPartnerInfoBtn').prop('disabled',true);
                 //return false;
            }
        } else {
            $('#plogo-error').text('Please select a valid Image file.');
            $('#saveOurPartnerInfoBtn').attr('disabled',true);$('#saveOurPartnerInfoBtn').prop('disabled',true);
            //return false;
        }
    });
    
  $('body').on('click', '.btn-delete', function (e) { 
        var name =$(this).attr('data-name');
        var id =$(this).attr('data-id');
        $.confirm({
          icon:'icon ion-trash-a',
          title: 'Confirmation',
          content: "Sure you want to delete <strong>"+name+"</strong>?",
          type: 'red',
          typeAnimated: true,
          buttons: {
              confirm: function () {
                $.post(base_url+"/our-partners/delete/",{id:id},function(resp) {
                    if($.trim(resp.status)=='success'){
                         $('#col-figure-'+id).remove()
                         notification($.trim(resp.status),resp.message);
                    }else{
                        notification($.trim(resp.status),resp.message);
                    }
                },'json');
              },
              cancel: function () {
                  // $.alert('Canceled!');
              }
          }
      });
 
    });
    
  $("body").on('click', '.btn-status', function (e) { 
        var name =$(this).attr('data-name');
        var id =$(this).attr('data-id');
        
        var msg ="";var status="";var typ="";
        var status =$(this).attr('data-status');
        if(status=="ACTIVE"){
          status ="INACTIVE";typ="red";
          msg = "<p style='color:red;'>Sure you want <strong>"+name+"</strong> is mark as disabled? </p>";
        }else{
          status ="ACTIVE";typ="green";
          msg = "<p style='color:green;'>Sure you want to <strong>"+name+"</strong> is mark as enable? </p>";
        }
       var _this = $(this);
        $.confirm({
          title: 'Confirmation',
          content: msg,
          type: typ,
          typeAnimated: true,
          buttons: {
              confirm: function () {
                $.get(base_url+"/our-partners/update-status/"+id+"/"+status,function(resp) {
                    if(resp.status=='success'){
                            _this.attr('data-status',status);
                               
                             if(status=="ACTIVE"){
                                 _this.attr('data-original-title','Click to disable');
                                $('.our-partners-notify')._success(name+" is marked enabled"); 
                             }else{
                               _this.attr('data-original-title','Click to enable');
                               $('.our-partners-notify')._success(name+" is marked as disabled"); 
                             }
                    }else{
                      $('.our-partners-notify')._error(resp.message); 
                    }
                },'json');
              },
              cancel: function () {
                  // $.alert('Canceled!');
              }
          }
      });
 
    });
 });