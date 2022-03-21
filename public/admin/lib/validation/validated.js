$(document).ready(function () {

    $.validator.addMethod("alfa", function (value, element) {
        return this.optional(element) || /^[a-zA-Z]*$/i.test(value);
    }, "Please choise a username with only a-z A-Z.");

    $.validator.addMethod("gstno", function (value, element) {
        return this.optional(element) || /^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/i.test(value);
    }, "Please Enter valid GSTIN No.");

    $.validator.addMethod('minStrict', function (value, el, param) {
        return value > param;
    });
    $.validator.addMethod('minStrict1', function (value, el, param) {
        return value >= param;
    });
    $.validator.addMethod("dmy", function (value, element) {
        return value.match(/^\d\d?\/\d\d?\/\d\d\d\d$/);
    }, "Please enter the format as  dd/mm/yyyy."
            );
    $.validator.addMethod("mdy", function (value, element) {
        return value.match(/^\d\d?\/\d\d?\/\d\d\d\d$/);
    }, "Please enter the format as  mm/dd/yyyy."
            );
            
    $.validator.addMethod('usaphone', function (value, element) {
        return this.optional(element) || /^\d{3}-\d{3}-\d{4}$/.test(value);
    }, "Please enter a valid phone number");
    
    $.validator.addMethod("panno", function (value, element) {
        return this.optional(element) || /^[A-Z]{5}\d{4}[A-Z]{1}$/.test(value);
    }, "Invalid Pan Number");
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
        
    
    
        
    $.validator.setDefaults({
            errorElement: "span",
            errorClass: "error",
            highlight: function (element, errorClass, validClass) {
                 var elm = $(element);
                 
                var group = elm.closest('.form-group');
                 elm.removeClass('is-valid')
                     .addClass('is-invalid');

                
            },
            unhighlight: function (element, errorClass, validClass) {
                var elm = $(element);
                var group = elm.closest('.form-group');
                elm.removeClass('is-invalid')
                     .addClass('is-valid');
            },
            errorPlacement: function (error, element) {

               var elm = $(element);

                if (elm.parent('.form-group').length || elm.parent('.input-group').length || elm.parent('.input-group-custom').length) {
                    elm.parent().css('margin-bottom',"1px");
                    error.insertAfter(elm.parent());
                }
                else if (elm.prop('type') === 'checkbox' || elm.prop('type') === 'radio') {
                    error.appendTo(elm.closest(':not(input, label, .checkbox, .radio)').first());
                } else {
                    error.insertAfter(elm.parent());
                }
            }
        });

});
    
    



