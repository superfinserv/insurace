$(function(){
    'use strict'
 
    
    $("body").on('change',"#makeImage", function(){
        var fileUpload = $("#makeImage")[0];
        
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
                             $('#makeImagesrc').attr('src', image.src);
                             
                             uplpoadVehicleImage();
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
    
    function uplpoadVehicleImage(){  
                   var myfile = $('#makeImage').val();
                    if(myfile == '') {
                         $('.agent-personal-notify')._error('Please enter file name and select file');
                        return;
                    }
                    $('#myprogress-container').show();
                    $('.myprogress').css('width', '0');
                    var formData = new FormData();
                    formData.append('makeImage', $('#makeImage')[0].files[0]);
                    formData.append('id', $('#_makeId').val());
                    $.ajax({
                        url: base_url+'/vehicle/image/upload/make',
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
                                  notification('success',data.message);
                               }else{
                                 notification('error',data.message);
                            }
                            
                        }
                    });
                }
    
   
});