$(document).ready(function() {
    'use strict';
    var TOKEN = Math.floor(1000000000 + Math.random() * 9000000000)+Math.random().toString(36).substring(2, 10) +"-"+ Math.random().toString(36).substring(2, 15) +"-"+ Math.random().toString(36).substring(2, 10);
     if(localStorage.getItem('deviceToken')==null){
       localStorage.setItem('deviceToken',TOKEN);
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
      
    jQuery.validator.addMethod("fullname", function(value, element) {
            if (/^([a-zA-Z]{2,}\s[a-zA-z]{1,}'?-?[a-zA-Z]{2,}\s?([a-zA-Z]{1,})?)/.test(value)) {
                return true;
            } else {
                return false;
            };
        }, 'Please Enter valid fullname');
        
    jQuery.validator.addMethod("gst_number", function(value, element) {
           //new RegExp('^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$');
            var gstinformat = /^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/;
            if (gstinformat.test(value)) {
                return true;
            } else {
                return false;
            };
        }, 'Please Enter valid GSTIN');
        
      
    jQuery.validator.addMethod("strongpass", function(value, element) {
            var number = /([0-9])/;
            var alphabets = /([a-zA-Z])/;
            var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
        
            if (value.match(number) && value.match(alphabets) && value.match(special_characters)) { 
                return true;
            }else{
                return false;
            }
            
}, 'Should include alphabets, numbers and special characters');
        
    jQuery.validator.addMethod("rtono", function(value, element) {
          return this.optional(element) || /^[a-zA-Z]{2}[0-9]{2}[a-zA-Z]{2}[0-9]{4}$/.test(value);
        }, 'valid RTO number required.');
        
    jQuery.validator.addMethod("ifsc", function(value, element) {
          return this.optional(element) || /^[a-zA-Z]{4}[0-9]{7}$/.test(value);
        }, 'valid IFSC code required.');
       
       $('.select2').select2();
       $('.single-select2').select2();
       
       $(".datepicker").datepicker({
          dateFormat: 'dd-mm-yy'
        });
        
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
        // console.log($(this));
        }
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
     //$('select').select2();
     $('.customer-logos').slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1500,
        arrows: false,
        dots: false,
        pauseOnHover: false,
        responsive: [{
            breakpoint: 768,
            settings: {
                slidesToShow: 4
            }
        }, {
            breakpoint: 520,
            settings: {
                slidesToShow: 3
            }
        }]
    });
    
    
    

});

function docIdvalid(elem,type,string){
    //  console.log(elem,type);
    //  console.log(elem,string);
    var isvalid =  false;
    if(type=="PAN_CARD"){
        
         var string =  string.toUpperCase();
           //console.log('UPR',string);
       var regex = /([A-Z]){5}([0-9]){4}([A-Z]){1}$/;
        if(!regex.test(string)) { 
            elem.focus();
            elem.css('color','red');
            isvalid = false;
        }else{
            elem.css('border','black');
            isvalid = true;
        }
    }else if(type=='VOTER_ID_CARD'){
        
    }else if(type=='DRIVING_LICENSE'){
        
    }else if(type=='PASSPORT'){
        
    }
    
    return isvalid;
}

function notification(typ,message){
       toastr.options = {
                closeButton: true,
                positionClass:'toast-top-center',
            };
    if(typ=='success'){
      toastr.success(message)
    }else if(typ=='error'){
      toastr.error(message)
    }else if(typ=='info'){
      toastr.info(message)
    }else if(typ=='warning'){
      toastr.warning(message)
    }
    
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

function callbackEffect() {
      setTimeout(function() {
        $( "#effect" ).removeAttr( "style" ).hide().fadeIn();
      }, 1000 );
     };
$('body').on("keyup",".uppercase",function(e) {
   $(this).val($(this).val().toUpperCase());
});
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
