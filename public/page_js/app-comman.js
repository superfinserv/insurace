 'use strict';
 $(document).ready(function(){
     
  var _token = $('meta[name="csrf-token"]').attr('content'); 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': _token
        }
    });
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
  _success:function(msg){
      var r = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
      var success = '<div id="success-'+r+'" class="alert alert-bordered alert-success" role="alert">'
                        +'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'
                          +'<span aria-hidden="true">×</span>'
                        +'</button>'
                        +'<strong class="d-block d-sm-inline-block-force">Well done!</strong> '+msg+'.'
                      +'</div>';
          jQuery(success).appendTo(this);
          setTimeout(function(){ $('#success-'+r).remove();}, 10000);
  },
  
   _error:function(msg){
         var r = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
        var error = '<div id="danger-'+r+'" class="alert alert-bordered alert-danger" role="alert">'
                        +'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'
                          +'<span aria-hidden="true">×</span>'
                        +'</button>'
                        +'<strong class="d-block d-sm-inline-block-force">Error!</strong> '+msg+'.'
                      +'</div>';
        jQuery(error).appendTo(this);
      setTimeout(function(){ $('#danger-'+r).remove();}, 10000);
  },
});