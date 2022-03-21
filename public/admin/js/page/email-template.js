$(function(){
    'use strict'
    if($('#editor1').length>0){
        // CKEDITOR.replace( 'editor1' ); 
          ClassicEditor
        .create( document.querySelector( '#editor1' ) )
        .catch( error => {
            console.error( error );
        } );
        //     CKEDITOR.replace( 'editor1', {
        //     on: {
        //         contentDom: function( evt ) {
        //             // Allow custom context menu only with table elemnts.
        //             evt.editor.editable().on( 'contextmenu', function( contextEvent ) {
        //                 var path = evt.editor.elementPath();
        
        //                 if ( !path.contains( 'table' ) ) {
        //                     contextEvent.cancel();
        //                 }
        //             }, null, null, 5 );
        //         }
        //      }
        //   } );
    }
    
    
    
    var emailtemptable = $('#emailtemp-datatable').DataTable( {
         scrollX: false,
         bLengthChange: false,
         responsive: true,
         order: [[0, "desc" ]],
         autoWidth: false,
                "processing": true,
                "serverSide": true,
               "ajax": {
                    "url": base_url+"/notification/template/email/datatable",
                     "type": "POST",
                },
                "columns": [
                    { "data": "sno","orderable":true},
                    {"data" : "subject_line","orderable":true},
                    {"data" : "mail_body","orderable":false},
                    {"data" : "status","orderable":false},
                    { "data": "action" ,"orderable":false}
                ],
                "columnDefs": [
                    { "width": "5%", "targets": 0 },
                    { "width": "20%", "targets": 1 },
                    { "width": "25%", "targets": 2 },
                    { "width": "15%", "targets": 3 },
                    { "width": "12%", "targets": 4 }
                    
                  ],
            } );
 
    $('.search-input-text').on( 'keyup change', function () {   // for text boxes
        var i =$(this).attr('data-column');  // getting column index
        var v =$(this).val();  // getting search input value
        emailtemptable.columns(i).search(v).draw();
   });
    emailtemptable.on( 'draw', function () { 
         $('[data-toggle="tooltip"]').tooltip({
            template: '<div class="tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
          });
   });
   
   $('body').on('click','.view-body',function(e){
      var id = $(this).attr('id'); 
       var title = $(this).attr('data-subject'); 
       $.dialog({
                icon: 'icon ion-ios-list-outline',
                title:title,
                content: "url:"+base_url+"/notification/templates/getBody/email/"+id,
                type: 'red',
                animation: 'scale',
                columnClass: 'medium',
                closeAnimation: 'scale',
                backgroundDismiss: false,
                
            });
   });
  
   
   
    $("#emailTemplateForm").validate({
        rules: {
            'subject_line': { required: true },
            'mail_body': { required: true},
       },

       submitHandler: function (form) {
             $('.emailTemplateSaveBtn').loadButton('on',{ faClass:'fa',faIcon:'fa-spinner', doSpin:true, loadingText:'Submitting Information...'});
            $.post(base_url+'/notification/templates/email/save/',$(form).serialize(),function(result){
                 $(".emailTemplateSaveBtn").loadButton('off');
                if($.trim(result.status)=='success'){
                   $('.email-template-notify')._success(result.message);
                  if($.trim(result.param)=='Created'){
                   $('#emailTemplateForm')[0].reset();
                  }
                }else{
                   $('.email-template-notify')._error(result.message);  
                }
                
            },'json')
            return false;
        }

    });
    
   
    
   $.fn.clearForm = function() {
          return this.each(function() {
            var type = this.type, tag = this.tagName.toLowerCase();
            console.log(type);
            if (tag == 'form')
              return $(':input',this).clearForm();
            if (type == 'text' || type == 'password' || tag == 'textarea')
              $(this).val('');
            else if (type == 'checkbox' || type == 'radio')
              this.checked = false;
            else if (tag == 'select')
              this.selectedIndex = -1;
          });
};
    // if($('#userRegisterInfo').length>0){
    //       $('#userRegisterInfo').clearForm();
    //  }
    
   
 });
