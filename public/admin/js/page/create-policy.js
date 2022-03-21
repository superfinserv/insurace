$(function(){
    'use strict'
    
    // $('#wizard2').steps({
    //       headerTag: 'h3',
    //       bodyTag: 'section',
    //       autoFocus: true,
    //       titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>',
    //       onStepChanging: function (event, currentIndex, newIndex) {
    //         if(currentIndex < newIndex) {
    //           // Step 1 form validation
    //           if(currentIndex === 0) {
    //             var fname = $('#firstname').parsley();
    //             var lname = $('#lastname').parsley();

    //             if(fname.isValid() && lname.isValid()) {
    //               return true;
    //             } else {
    //               fname.validate();
    //               lname.validate();
    //             }
    //           }

    //           // Step 2 form validation
    //           if(currentIndex === 1) {
    //             var email = $('#email').parsley();
    //             if(email.isValid()) {
    //               return true;
    //             } else { email.validate(); }
    //           }
    //         // Always allow step back to the previous step even if the current step is not valid.
    //         } else { return true; }
    //       }
    //     });
    
    $('body').on('click','.policy-select',function () {
        var id = $(this).attr('data-id');
        $.get(base_url+'/create/policy/route/'+id,function(resp) {
                    if(resp.status=='success'){
                       notification("success",resp.message);
                       window.location.href= base_url+"/"+resp.url;
                    }else{
                      notification("error",resp.message);
                    }
        },'json');
    })
    
   
});