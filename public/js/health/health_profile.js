var healthInfo = [];
$(window).on('load', function(){
    if(localStorage.getItem("healthInfo")) { 
       healthInfo = JSON.parse(localStorage.getItem('healthInfo'));
       addedItem = Object.keys(healthInfo).length;
       if(addedItem){
          $('#name').val(healthInfo.selfName);
          $('#email').val(healthInfo.selfEmail);
          if(healthInfo.gender=="MALE"){
              $("#gender_M").attr('checked', true);
              $("#gender_M").prop('checked', true);
          }else{
              $("#gender_F").attr('checked', true);
              $("#gender_F").prop('checked', true);
          }
       }
    }
});

$(document).ready(function() {
   
        $("#healthProfileTable-1").validate({
            rules: {
                'gender': { required: true,},
                'name': { required: true,},
                'email': { required: true,email:true},
                'mobile': {
                    required:{
                          depends: function(element) {
                               return $('#mobile').length >= 0;
                          }
                    },
                    maxlength:10,
                    number:{
                         depends: function(element) {
                               return $('#mobile').length > 0;
                          }
                    },
                },
            },
            messages: {
                'gender': { required: 'Please tell us your gender',},
                'name':  { required: 'Please enter your name',},
                'email': { required: 'Please enter your email',email:'Please enter valid email'},
                
            },
            errorPlacement: function (error, element) {
                if (element.attr("type") == "radio") {
                    error.insertAfter(element.parent('.form-group'));
                } else {
                     error.insertAfter(element);
                }
            },
            submitHandler: function(form) {
                 var gender = $("input[name='gender']:checked").val();
                 if(gender){ 
                    var selfname = $('#name').val();
                    var selfemail = $('#email').val();
                    
                    var mobile = ($('#mobile').length>0)?$('#mobile').val():$('#mobileNumber').val();
                    
                    var NAME = selfname.split(" ");
                    var selfFname = (NAME[0])?NAME[0]:"";var selfLname = NAME[1]?NAME[1]:""; 
                    healthInfo= {gender:gender,selfName:selfname,selfEmail:selfemail,selfFname:selfFname,selfLname:selfLname,selfMobile:mobile}
                    localStorage.setItem("healthInfo", JSON.stringify(healthInfo));
                    window.location.href = base_url + "/health-insurance/health-profile-members";
                 }else{
                      toastr.error("Please select gender");
                }
                
            }
        });
});

