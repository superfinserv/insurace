$(function(){
    'use strict'
    
    
    
    var smstemptable = $('#smstemp-datatable').DataTable( {
         scrollX: false,
         bLengthChange: false,
         responsive: true,
         order: [[0, "desc" ]],
         autoWidth: false,
                "processing": true,
                "serverSide": true,
               "ajax": {
                    "url": base_url+"/notification/template/sms/datatable",
                     "type": "POST",
                },
                "columns": [
                    { "data": "sno","orderable":true},
                    {"data" : "title","orderable":true},
                    {"data" : "body","orderable":false},
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
        smstemptable.columns(i).search(v).draw();
   });
    smstemptable.on( 'draw', function () { 
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
                content: "url:"+base_url+"/notification/templates/getBody/sms/"+id,
                type: 'red',
                animation: 'scale',
                columnClass: 'medium',
                closeAnimation: 'scale',
                backgroundDismiss: false,
                
            });
   });
  
   
   
    $("#smsTemplateForm").validate({
        rules: {
            'title': { required: true },
            'msg_body': { required: true},
       },

       submitHandler: function (form) {
             $('.smsTemplateSaveBtn').loadButton('on',{ faClass:'fa',faIcon:'fa-spinner', doSpin:true, loadingText:'Submitting Information...'});
            $.post(base_url+'/notification/templates/sms/save/',$(form).serialize(),function(result){
                 $(".smsTemplateSaveBtn").loadButton('off');
                if($.trim(result.status)=='success'){
                   $('.sms-template-notify')._success(result.message);
                  if($.trim(result.param)=='Created'){
                   $('#smsTemplateForm')[0].reset();
                  }
                }else{
                   $('.sms-template-notify')._error(result.message);  
                }
                
            },'json')
            return false;
        }

    });
 });
