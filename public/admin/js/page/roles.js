$(function(){
    'use strict'
     var _token = $('meta[name="csrf-token"]').attr('content'); 
    $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': _token
         }
    });
    
    var roletable = $('#role-datatable').DataTable( {
        "scrollX": false,
         bLengthChange: false,
         responsive: true,
        "order": [[0, "desc" ]],
        "autoWidth": false,
                "processing": true,
                 "serverSide": true,
               "ajax": {
                    "url": base_url+"/role/getdatatable",
                     "type": "POST",
                },
                "columns": [
                    { "data": "sno"},
                    {"data" : "role"},
                    {"data" : "status","orderable":false},
                    { "data": "action" ,"orderable":false}
                ],
                "columnDefs": [
                    { "width": "1%", "targets": 0 },
                    { "width": "40%", "targets": 1},
                    { "width": "10%", "targets": 2},
                    { "width": "20%", "targets": 3},
                 
                  ],
            } );
 
    $('.search-input-text').on( 'keyup change', function () {   // for text boxes
        var i =$(this).attr('data-column');  // getting column index
        var v =$(this).val();  // getting search input value
        roletable.columns(i).search(v).draw();
   });
   
    $(document).on('click', '.btn-status', function (e) { 
        var name =$(this).attr('data-name');
        var id =$(this).attr('data-id');
        var status =parseInt($(this).attr('data-status'));
        var msg ="";var st=status;var typ="";
        if(status==1){
          st =0;typ="red";
          msg = "<p style='color:red;'>Sure you want to <i> Disable Role </i> <strong>"+name+"</strong>? </p>";
        }else{
          st =1;typ="green";
          msg = "<p style='color:green;'>Sure you want to <i>Enable Role </i> <strong>"+name+"</strong>? </p>";
        }

        $.confirm({
          title: 'Confirmation',
          content: msg,
          type: typ,
          typeAnimated: true,
          buttons: {
              confirm: function () {
                $.get(base_url+"/role/status/update/"+id+"/"+st,function(resp) {
                    if($.trim(resp.status)=='success'){
                             if(st==0){
                               $('.role-notify')._success(" Role "+name+" is disabled successfully"); 
                             }else{
                               $('.role-notify')._success(" Role "+name+" is enabled successfully"); 
                             }
                         roletable.ajax.reload();
                    }else{
                      $('.role-notify')._error(resp.message); 
                    }
                },'json');
              },
              cancel: function () {
                  // $.alert('Canceled!');
              }
          }
      });
 
    });
   
    $("#RoleForm").validate({
        
        rules: {
            'roleName': { required: true }
        },
        submitHandler: function (form) {
             $('.saveRoleInfoBtn').loadButton('on',{ faClass:'fa',faIcon:'fa-spinner', doSpin:true, loadingText:'Submitting...'});
            $.post(base_url+'/role/save/',$(form).serialize(),function(result){
                 $(".saveRoleInfoBtn").loadButton('off');
                if($.trim(result.status)=='success'){
                   $('.role-notify')._success(result.message);
                   $('#RoleForm')[0].reset();
                    roletable.ajax.reload();
                }else{
                   $('.role-notify')._error(result.message);  
                }
            },'json')
            return false;
        }

    });
    
   
 });
