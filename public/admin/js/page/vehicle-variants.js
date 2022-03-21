$(function(){
    'use strict'
     var _token = $('meta[name="csrf-token"]').attr('content'); 
    $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': _token
         }
    });
    
    var Varienttable = $('#varients-datatable').DataTable( {
        "scrollX": false,
         bLengthChange: false,
         responsive: true,
        "autoWidth": false,
                "processing": true,
                "serverSide": true,
               "ajax": {
                    "url": base_url+"/vehicle/variants/getVariantsdatatable",
                     "type": "POST",
                },
                "columns": [
                    {"data" : "variant","orderable":false},
                    {"data" : "model","orderable":false},
                    {"data" : "brand","orderable":false},
                    {"data" : "seat","orderable":false},
                    {"data" : "wheels","orderable":false},
                    {"data" : "fuel","orderable":false},
                    {"data" : "body","orderable":false},
                    {"data" : "Digit_code","orderable":false,'className':'vcode'},
                    {"data" : "FG_code","orderable":false,'className':'vcode'},
                    {"data" : "status","orderable":false},
                    { "data": "action" ,"orderable":false}
                ],
                "columnDefs": [
                    { "width": "15%", "targets": 0 },
                    { "width": "10%", "targets": 1 },
                    { "width": "10%", "targets": 2 },
                    { "width": "5%", "targets": 3 },
                    { "width": "5%", "targets": 4 },
                    { "width": "8%", "targets": 5 },
                    { "width": "10%", "targets": 6 },
                    { "width": "10%", "targets": 7 },
                    { "width": "10%", "targets": 8 },
                    { "width": "5%", "targets": 9 },
                    { "width": "5%", "targets": 9 },
                  ],
            } );
 
    $('.search-input-text').on( 'keyup change', function () {   // for text boxes
        var i =$(this).attr('data-column');  // getting column index
        var v =$(this).val();  // getting search input value
        Varienttable.columns(i).search(v).draw();
   });
   
   $("#VarientForm").validate({
        rules: {
            'VariantName': { required: true },
            'brand': { required: true,},
            'model': { required: true,},
            'fuelType': { required: true,},
            'bodyType': { required: true,},
            'no_of_wheels': { required: true,},
            'no_of_seating': { required: true,},
            'DigitCode': { required: true,},
            //'FgCode': { required: true,},
        },   
        submitHandler: function (form) {
             $('.variantSaveBtn').loadButton('on',{ faClass:'fa',faIcon:'fa-spinner', doSpin:true, loadingText:'Submitting...'});
             $.post(base_url+'/vehicle/variants/save',$(form).serialize(),function(result){
                 $(".variantSaveBtn").loadButton('off');
                   if($.trim(result.status)=='success'){
                    //$('#VarientForm')[0].reset();
                    $('#VariantName').val("");$('#DigitCode').val("");$('#FgCode').val("");
                    $('.variant-notify')._success(result.message);
                    Varienttable.ajax.reload();
                }else{
                   $('.variant-notify')._error(result.message);  
                }
            },'json')
            return false;
        }

    });
   
    $('body').on('change','#brand',function(e){
        var typ = $(this).val();
        if(typ!=""){
           $.get(base_url+"/get-models-by-brand/"+typ,  function(result) {
            var newdata =result.data;
            $('#model').empty().trigger("change");
            var newState1 = new Option("Choose one", "", true, true);
              $("#model").append(newState1);
              jQuery.each(newdata, function (index, item) {
                 var newState = new Option(item['value'], item['id'], true, true);
                $("#model").append(newState);//.trigger('change');
              });
            $('#model').val('').trigger("change");
        },'json');
        }else{
           $('#model').empty().trigger("change"); 
        }
    });
   var codeModal =""; 
    $('body').on('click','.edit-code',function(e){
        e.preventDefault();
        var typ = $(this).attr('data-typ');
        var vid = $(this).attr('data-vid');
        var codeModal = $.dialog({
                icon: 'icon ion-key',
                title:'vehicle Code ('+typ+')',
                content: "url:"+base_url+"/vehicle/variants/update-code/modal/"+typ+"/"+vid,
                type: 'red',
                animation: 'scale',
                columnClass: 'small',
                closeAnimation: 'scale',
                backgroundDismiss: false,
                
            });
    });
    
    $('body').on('click','.vehicleVarCodeUpdateBtn',function(e){
      $("#vehicleVarCodeForm").validate();
        $('#InputvehicleCode').rules("add",  {required: true });
        if($('#vehicleVarCodeForm').valid() === true) {
              var formData = $('#vehicleVarCodeForm').serialize();
              $.post(base_url+"/vehicle/varients/update-code/",formData,function(result){
                  var st = $.trim(result.status);
                   notification($.trim(result.status),result.message);
                   if(st=="success"){
                      codeModal.close();
                      Varienttable.ajax.reload(null, false);
                    }
              },'json')
        }else{
              
        }
            
    });
    
    $('body').on('click', '.btn-status', function (e) { 
        var name =$(this).attr('data-name');
        var id =$(this).attr('data-id');
        var st =$(this).attr('data-status');
        var msg ="";var status="";var typ="";
        if(st==1){
          status =0;typ="red";
          msg = "<p style='color:red;'>Sure you want to <i> Disable </i> <strong>"+name+"</strong>? </p>";
        }else{
          status =1;typ="green";
          msg = "<p style='color:green;'>Sure you want to <i>Enable </i> <strong>"+name+"</strong>? </p>";
        }

        $.confirm({
          title: 'Confirmation',
          content: msg,
          type: typ,
          typeAnimated: true,
          buttons: {
              confirm: function () {
                $.get(base_url+"/vehicle/variant/status-update/"+id+"/"+status,function(resp) {
                    if(resp.status=='success'){
                             if(status==1){
                                $('.variant-notify')._success(name+" is disabled successfully."); 
                             }else{
                                $('.variant-notify')._success(name+" is enabled successfully."); 
                             }
                         Varienttable.ajax.reload(null, false);
                    }
                },'json');
              },
              cancel: function () {
                  // $.alert('Canceled!');
              }
          }
      });
 
    });
    
    $('body').on('click', '.btn-delete', function (e) { 
        var name =$(this).attr('data-name');
        var id  = $(this).attr('data-id');
        $.confirm({
          icon :'icon ion-trash-a tx-danger',
          title: 'Confirmation!',
          content: "<p style='color:red;'>Sure you want to delete <strong>"+name+"</strong>? </p>",
          type: 'red',
          typeAnimated: true,
          buttons: {
              confirm: function () {
                $.get(base_url+"/vehicle/delete/variant/"+id,function(resp) {
                    if(resp.status=='success'){
                        $('.variant-notify')._success(name+" is deleted successfully."); 
                         Varienttable.ajax.reload(null, false);
                    }else{
                        $('.variant-notify')._error("Something went wrong while deleting!"); 
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
