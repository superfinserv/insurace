$(function(){
    'use strict'
    
    var agenttable = $('#agent-datatable').DataTable( {
        "scrollX": false,
         bLengthChange: false,
         responsive: true,
        "autoWidth": false,
                "processing": true,
                "serverSide": true,
               "ajax": {
                    "url": base_url+"/agents/trash/getAgentsdatatable",
                     "type": "POST",
                },
                "columns": [
                    { "data": "sno","orderable":false},
                    {"data" : "name","orderable":false},
                    {"data" : "mobile","orderable":false},
                    {"data" : "email","orderable":false},
                    {"data" : "code","orderable":false},
                    {"data" : "certificate_link","orderable":false},
                    {"data" : "isTestAllow","orderable":false},
                    {"data" : "status","orderable":false},
                    { "data": "action" ,"orderable":false}
                ],
                "columnDefs": [
                    { "width": "5%", "targets": 0 },
                    { "width": "15%", "targets": 1 },
                    { "width": "10%", "targets": 2 },
                    { "width": "20%", "targets": 3 },
                    { "width": "12%", "targets": 4 },
                    { "width": "10%", "targets": 5 },
                    { "width": "10%", "targets": 6 },
                    { "width": "8%", "targets": 7 },
                    { "width": "10%", "targets": 8 },
                 
                  ],
            } );
 
    $('.search-input-text').on( 'keyup change', function () {   // for text boxes
        var i =$(this).attr('data-column');  // getting column index
        var v =$(this).val();  // getting search input value
        agenttable.columns(i).search(v).draw();
   });
   
   agenttable.on( 'draw', function () { 
         $('[data-toggle="tooltip"]').tooltip({
            template: '<div class="tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
          });
   })
   $('body').on('click', '.reload-table', function (e) {
       $(this).find('i').addClass('fa-spin');
       agenttable.ajax.reload();
       $(this).find('i').removeClass('fa-spin');
   });
   
   $('body').on('click','.agentResetPasswordBtn',function(e){
     console.log("clicked");
       $("#agentResetPasswordForm").validate();
        $('#agentPass').rules("add",  {required: true,minlength:6 });
        $('#agentcPass').rules("add", {required: true,equalTo:'#agentPass'});
       
        if($('#agentResetPasswordForm').valid() === true) {
              var formData = $('#agentResetPasswordForm').serialize();
              $.post(base_url+"/agent/update/password/info/",formData,function(result){
                  var st = $.trim(result.status);
                  if(st=="success"){
                      setTimeout(function(){ location.reload(); }, 3000);
                      $('.resetpass-notify')._success(result.message); 
                    }else{
                       $('.resetpass-notify')._error(result.message);  
                    }
              },'json')
        }else{
           $('.resetpass-notify')._error("All field are required!");    
        }
            
    });
   
    $('body').on('click', '.reset-password', function (e) { 
          var agentid =$(this).attr('data-id');
        
            $.dialog({
                icon: 'icon ion-key',
                title:'Reset Password',
                content: "url:"+base_url+"/agent/reset-password/modal/"+agentid,
                type: 'red',
                animation: 'scale',
                columnClass: 'medium',
                closeAnimation: 'scale',
                backgroundDismiss: false,
                onContentReady: function () {
                   $("#agentPaymentupdateInfo").validate();
                 }
            });
 
    });
   
    $('body').on('click', '.btn-trash', function (e) { 
        var name =$(this).attr('data-name');
        var id =$(this).attr('data-id');
        $.confirm({
          icon:'icon ion-trash-a',
          title: 'Confirmation',
          content: "Sure you want to undo trash to <strong>"+name+"</strong>?",
          type: 'red',
          typeAnimated: true,
          buttons: {
              confirm: function () {
                $.post(base_url+"/agents/trash/process",{id:id,'param':'undo'},function(resp) {
                    if($.trim(resp.status)=='success'){
                         notification($.trim(resp.status),resp.message);
                         agenttable.ajax.reload(null, false);
                    }else{
                      location.reload(true);
                    }
                },'json');
              },
              cancel: function () {
                  // $.alert('Canceled!');
              }
          }
      });
 
    });
   
    
 });
