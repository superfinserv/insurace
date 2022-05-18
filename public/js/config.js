//$(window).load(function() {
$(window).on('load', function(){
    $('#pre-loader').css('display','none');
})


$(document).ready(function() {
    'use strict';
     $('[data-toggle="tooltip"]').tooltip();
     
    if(localStorage.getItem('deviceToken')==null){
       var token = generateDeviceToken();
       localStorage.setItem('deviceToken',token);
    }
    var _token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': _token }
    });
    $.validator.addMethod("chars", function (value, element) {
        return this.optional(element) || /^[a-zA-Z]*$/i.test(value);
    }, "Please choise a username with only a-z A-Z.");

    $.validator.addMethod("isValidNumber", function(value1, element1) {
            var pan_value = value1.toUpperCase();
            var formData = JSON.parse(localStorage.getItem('customersDetails'));
          if(formData.bikenew==1){
            var reg = /^[a-zA-Z]{2}[0-9]{2}$/;
            if (this.optional(element1)) { return true; }
            if (pan_value.match(reg)) { return true; } else { return false; }
          }else{
             var reg = /^[a-zA-Z]{2}[0-9]{2}[a-zA-Z]{2}[0-9]{4}$/;
             if (this.optional(element1)) {  return true; }
             if (pan_value.match(reg)) {return true;  } else { return false;   }
        }
      }, "Please enter your Bike Number Example:MH02BX0377");
     
    $.validator.addMethod("mobile", function(value, element) {
         var x = value;var ch = parseInt(x.charAt(0));
         return (ch==9 || ch==8 || ch==7 || ch==6)?true:false;
       }, 'Please enter valid mobile number.');
     
    jQuery.validator.addMethod("fullname", function(value, element) {
            if (/^([a-zA-Z]{2,}\s[a-zA-z]{1,}'?-?[a-zA-Z]{2,}\s?([a-zA-Z]{1,})?)/.test(value)) {
                return true;
            } else {
                return false;
            }
        }, 'Please Enter valid fullname');
        
    jQuery.validator.addMethod("rtono", function(value, element) {
          return this.optional(element) || /^[a-zA-Z]{2}[0-9]{2}[a-zA-Z]{2}[0-9]{4}$/.test(value);
        }, 'valid RTO number required.');
        
          
    jQuery.validator.addMethod("gst_number", function(value, element) {
           //new RegExp('^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$');
            var gstinformat = /^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/;
            if (gstinformat.test(value)) {
                return true;
            } else {
                return false;
            }
        }, 'Please Enter valid GSTIN');
        
        jQuery.validator.addMethod("pan_no", function(value, element) {
             var regex = /([A-Z]){3}(P){1}([A-Z]){1}([0-9]){4}([A-Z]){1}$/;
            if (regex.test(value)) {
                return true;
            } else {
                return false;
            }
        }, 'Please Enter valid PAN number');
        
        jQuery.validator.addMethod("ifsc", function(value, element) {
          return this.optional(element) || /^[a-zA-Z]{4}[0-9]{7}$/.test(value);
        }, 'valid IFSC code required.');  
        
      jQuery.validator.addMethod("alphanumeric", function(value, element) {
            return this.optional(element) || /^\w+$/i.test(value);
        }, "Letters, numbers, and underscores only please");
    
    $('.select2').select2();
      $('.single-select2').select2();
    
    $(".selectize-single").selectize({
          create: true,
          sortField: "text",
        });
   
// on first focus (bubbles up to document), open the menu
// $(document).on('focus', '.select2-selection.select2-selection--single', function (e) {
//   $(this).closest(".select2-container").siblings('select:enabled').select2('open');
// });

// steal focus during close - only capture once and stop propogation
// $('select.select2').on('select2:closing', function (e) {
//   $(e.target).data("select2").$selection.one('focus focusin', function (e) {
//     e.stopPropagation();
//   });
// });

   
    $.fn.serializeObject = function() {    
        var o = {};
        var a = this.serializeArray();
        $.each(a, function() {
            if (o[this.name]) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    };
    
    jQuery.fn.extend({
        actionOnAttr: function (bool,param) {
            if($(this).length>0){
            if(bool){
               $(this).attr(param,true);
               $(this).prop(param,true);
            }else{
                $(this).attr(param,false);
                $(this).prop(param,false);
            }
         }
        },
        
        
        
        
        
   });
      //called when key is pressed in textbox
    $('body').on("keypress",".number-only",function (e) {
         //if the letter is not digit then display error and don't type anything
         if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            //display error message
            $(this).css("border-color","red");
            return false;
        }else{
             $(this).css("border-color","#ccc");
        }
      });
   });


    $('body').on("keypress",".char-only",function (e) {
        var keyCode = e.keyCode || e.which;
 
          //  $("#lblError").html("");
 
            //Regex for Valid Characters i.e. Alphabets.
            var regex = /^[A-Za-z]+$/;
 
            //Validate TextBox value against the Regex.
            var isValid = regex.test(String.fromCharCode(keyCode));
            if (!isValid) {
                //$("#lblError").html("Only Alphabets allowed.");
            }
 
            return isValid;
        // var $th = $(this);
        // $th.val( $th.val().replace(/[^a-zA-Z]/g, function(str) { return ''; } ) );
    });
    
    $('body').on("keypress",".alpha-only",function (e) {
        var keyCode = e.keyCode || e.which;
 
          //  $("#lblError").html("");
 
            //Regex for Valid Characters i.e. Alphabets.
            var regex = /^[a-zA-Z ]+$/;
 
            //Validate TextBox value against the Regex.
            var isValid = regex.test(String.fromCharCode(keyCode));
            if (!isValid) {
                //$("#lblError").html("Only Alphabets allowed.");
            }
 
            return isValid;
        // var $th = $(this);
        // $th.val( $th.val().replace(/[^a-zA-Z]/g, function(str) { return ''; } ) );
    });
    

   function setEventLog(eventInfo){
       //console.log(eventInfo)
       var defer = $.Deferred(); 
     
          $.ajax({ 
            url: base_url + "/enQ-log-event",
            dataType: 'json', 
            method:"POST",
            data:{eventInfo:eventInfo},
            success: function(response) { 
              defer.resolve(response) 
            }, 
            error: function(req, status, err) { 
              defer.reject(err); 
            } 
          }); 
      return defer.promise(); 
   }


function generateDeviceToken(){
    var stringLength = 200;
    var stringArray = ['0','1','2','3','4','5','6','7','8','9','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
    var rndString = "";
	for (var i = 1; i < stringLength; i++) { 
		var rndNum = Math.ceil(Math.random() * stringArray.length) - 1;
          if(i==25){rndString = rndString +":"; }
          if(i==100){rndString = rndString +"_"; }
          if(i==175){rndString = rndString +"-"; }
    	  rndString = rndString + stringArray[rndNum];
    };
    
    return rndString;
}

    function callbackEffect() {
      setTimeout(function() {
        $( "#effect" ).removeAttr( "style" ).hide().fadeIn();
      }, 1000 );
     };
     
     $('.isChecked').click(function(){
            var id =  $(this).attr('id');
            if($(this).is(":checked")){
               $("label[for='"+id+"']").css('color',"#000");
            }
            else if($(this).is(":not(:checked)")){
                $("label[for='"+id+"']").css('color',"red");
            }
        });

function docIdvalid(elem,type,string){
    var isvalid =  false;
    if(type=="PAN_CARD"){
         var string =  string.toUpperCase();
       //var regex = /([A-Z]){5}([0-9]){4}([A-Z]){1}$/;
       var regex = /([A-Z]){3}(P){1}([A-Z]){1}([0-9]){4}([A-Z]){1}$/;
        if(!regex.test(string)) { 
            elem.focus();
            elem.css('color','red');
            isvalid = false;
        }else{
            elem.css('border','black');
            isvalid = true;
        }
    }else if(type=='VOTER_ID_CARD'){
        isvalid = true;
    }else if(type=='DRIVING_LICENSE'){
        isvalid = true;
    }else if(type=='PASSPORT'){
        var string =  string.toUpperCase();
       var regex = /([A-Z]){1}([0-9]){7}$/;
        if(!regex.test(string)) { 
            elem.focus();
            elem.css('color','red');
            isvalid = false;
        }else{
            elem.css('border','black');
            isvalid = true;
        }
    }
    
    return isvalid;
}

function calculateAge(DOB) {
    var today = new Date();
    var birthDate = new Date(DOB);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age = age - 1;
    }
    return age;
}

$('body').on('submit','.js-contact-form',function(e){
    e.preventDefault();
   var formData = $(this).serialize();
   $('.js-contact-form-message').removeClass('success-msg error-msg').empty();
   $.post(base_url+"/contact/send-mail",formData,function(result){
       var status = $.trim(result.status);
       if(status=="success"){
           $('.js-contact-form-message').addClass('success-msg').html(result.message);
           $(".js-contact-form")[0].reset();
       }else{
           $('.js-contact-form-message').addClass('error-msg').html(result.message);
       }
   },'json');
})

$('body').on("keyup",".bikenumber",function(e) {
    $("#errors").html('');
    var validstr = '';
    var dInput = $(this).val().toUpperCase();;
    var numpattern = /^\d+$/;
    var alphapattern = /^[A-Z]+$/;
    for (var i = 0; i < dInput.length; i++) {
        if ((i == 2 || i == 3 || i == 6 || i == 7 || i == 8 || i == 9)) {
            if (numpattern.test(dInput[i])) {
                validstr += dInput[i];
            } else {
                $("#errors").html("Invalid Registration number. Ex.- MH02BX0377").show();
            }
        }
        if ((i == 0 || i == 1 || i == 4 || i == 5)) {
            if (alphapattern.test(dInput[i])) {
                validstr += dInput[i];
            } else {
                $("#errors").html("Invalid Registration number. Ex.- MH02BX0377").show();
            }
        }
    }
    $(this).val(validstr);
    return false;
});

$('body').on("keyup",".vehicleRegNumber",function(e) {
   var val =  $(this).val();
   //console.log("val",val);
  if(val!=""){
        var len =  val.length;
        //console.log("len",len);
        if(len<2){
            $(this).attr('type','text'); 
        }else if(len==2){
            $(this).attr('type','tel');
        }else if(len>2 && len<4){
            $(this).attr('type','tel');
        }else if(len==4){
            $(this).attr('type','text');
        }else if(len>4 && len<6){
            $(this).attr('type','text');
        }else if(len==6){
            $(this).attr('type','tel');
        }
        // else if(len>7){
        //     $(this).attr('type','tel');
        // }
  }else{
      $(this).attr('type','text'); 
  }
});

// function validatedPincode(_pincode,_city,_state){
//       var state = _state.split('-')[0];
//       var city = _city.split('-')[0];
//         $.post(base_url + "/valid-pincode/",{pin:_pincode,ct:city:st:state}, function (resp) {
// }

function validatedPincode(_pincode,_city,_state) { 
  var defer = $.Deferred(); 
     var state = _state.split('-')[0];
     var city = _city.split('-')[0];
     var formdata = { pin:_pincode,ct:city,st:state};
  $.ajax({ 
    url: base_url + "/get-validated-pincode",
    dataType: 'json', 
    data:formdata,
    success: function(response) { 
      defer.resolve(response) 
    }, 
    error: function(req, status, err) { 
      defer.reject(err); 
    } 
  }); 
   //console.log(defer);
  return defer.promise(); 
} 


function GetVehicleInfo(typ,_Vnumber) { 
    var defer = $.Deferred(); 
     
  $.ajax({ 
    url: base_url + "/get-vehicle-registerinfo",
    dataType: 'json', 
    method:"POST",
    data:{vehicleNumber:_Vnumber,type:typ},
    success: function(response) { 
      defer.resolve(response) 
    }, 
    error: function(req, status, err) { 
      defer.reject(err); 
    } 
  }); 
   //console.log(defer);
  return defer.promise(); 
}


function GetVehicleModel(param,_make,elemAppendTo,selected) { 
        $.post(base_url + "/motor/get-vehicle-models",{type:param,make:_make}, function (resp) {
              if(resp.status===true){
                  var result =resp.data;
                  elemAppendTo.empty();
                  var newState_ = new Option("Choose Model", "", false, false);
                  elemAppendTo.append(newState_);
                  jQuery.each(result, function (index, item) {
                    var newState = new Option(item['value'], item['id'], false, false);
                      elemAppendTo.append(newState);
                   });
                  elemAppendTo.val(selected).trigger("change");
                  
              }
    });
}
        
function GetVehicleVarient(param,_model,elemAppendTo,selected) { 
        $.post(base_url + "/motor/get-vehicle-varients",{type:param,model:_model}, function (resp) {
              if(resp.status===true){
                  var result =resp.data;
                  elemAppendTo.empty();
                  var newState_ = new Option("Choose Varient", "", false, false);
                  elemAppendTo.append(newState_);
                  jQuery.each(result, function (index, item) {
                    var newState = new Option(item['value'], item['id'], false, false);
                      elemAppendTo.append(newState);
                   });
                  elemAppendTo.val(selected).trigger("change");
                  
              }
    });
}
 

$('body').on("keyup",".word-uppercase",function(e) {
        $(this).val($(this).val().toUpperCase()); 
    // var charInput = e.keyCode;
    // console.log();
    // if((charInput >= 97) && (charInput <= 122)) { // lowercase
    //   if(!e.ctrlKey && !e.metaKey && !e.altKey) { // no modifier key
    //     var newChar = charInput - 32;
    //     var start = e.target.selectionStart;
    //     var end = e.target.selectionEnd;
    //     e.target.value = e.target.value.substring(0, start) + String.fromCharCode(newChar) + e.target.value.substring(end);
    //     e.target.setSelectionRange(start+1, start+1);
    //     e.preventDefault();
    //   }
    // }
});
