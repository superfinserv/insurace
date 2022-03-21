$(function(){
    'use strict'
    $("#agentPersonalInfo").validate({
        rules: {
            'agent_name': { required: true },
            
            'mobile_no': { required: true,number:true,minlength:10},
            
            'email':{ required:true, email:true},
            
            'gender':{ required:true,},
            
            'marital_status':{ required:true,},
            
            'address':{ required:true,},
             
            'state':{ required:true,},
            
            'city':{ required:true,},
             
            'pincode':{ required:true,number:true,minlength:6 },

        },

       submitHandler: function (form) {
             $('.agentPersonalInfoBtn').loadButton('on',{ faClass:'fa',faIcon:'fa-spinner', doSpin:true, loadingText:'Updating Information...'});
            $.post(base_url+'/agent/update/personalInfo',$(form).serialize(),function(result){
                 $(".agentPersonalInfoBtn").loadButton('off');
                if($.trim(result.status)=='success'){
                   $('.agent-personal-notify')._success(result.message); 
                }else{
                   $('.agent-personal-notify')._error(result.message);  
                }
            },'json')
            return false;
        }

    });
    
    $("body").on('change',"#agentImage", function(){
        var fileUpload = $("#agentImage")[0];
        
        //Check whether the file is valid Image.
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(.jpg|.png|.jpeg)$");
        if (regex.test(fileUpload.value.toLowerCase())) {
            console.log("regex match");
            //Check whether HTML5 is supported.
            if (typeof (fileUpload.files) != "undefined") {
                 console.log("typeof match");
                //Initiate the FileReader object.
                var reader = new FileReader();
                //Read the contents of Image File.
                reader.readAsDataURL(fileUpload.files[0]);
                
                reader.onload = function (e) {
                    console.log("reader match");
                    //Initiate the JavaScript Image object.
                    var image = new Image();
                    //Set the Base64 string return from FileReader as source.
                    image.src = e.target.result;
                    image.onload = function () {
                        console.log("image match");
                        //Determine the Height and Width.
                        var height = this.height;
                        var width = this.width;
                        if (height > 1 || width >1) {
                             console.log("height-width match");
                             $('#agentImagesrc').attr('src', image.src);
                             
                             uplpoadAgentImage();
                            // return true; 
                        }else{
                             console.log("height-width not match");
                              $('.agent-personal-notify')._error("Profile image Height and Width must be 200px.");  
                            //return false;
                        }
                        
                    };
                }
            } else {
                $('.agent-personal-notify')._error('This browser does not support.');
                 //return false;
            }
        } else {
            $('.agent-personal-notify')._error('Please select a valid Image file.');
            //return false;
        }
        
    });
    
    function uplpoadAgentImage(){  
                   var myfile = $('#agentImage').val();
                    if(myfile == '') {
                         $('.agent-personal-notify')._error('Please enter file name and select file');
                        return;
                    }
                    $('#myprogress-container').show();
                    $('.myprogress').css('width', '0');
                    var formData = new FormData();
                    formData.append('agentImage', $('#agentImage')[0].files[0]);
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
                                $('.agent-personal-notify')._success(data.message); 
                            }else{
                               $('.agent-personal-notify')._error(data.message); 
                            }
                            
                        }
                    });
                }
    
    $('body').on('change','#state',function(e){
        var stateID = $(this).val();
        $.get(base_url+"/get-cities/"+stateID,  function(result) {
            var newdata =result.data;
            $('#city').empty().trigger("change");
            var newState1 = new Option("choose city", "", true, true);
              $("#city").append(newState1); 
              
              jQuery.each(newdata, function (index, item) {
                 var newState = new Option(item['value'], item['id'], true, true);
                $("#city").append(newState);//.trigger('change');
              });
            $('#city').val('').trigger("change");
        },'json');
    });
    
});