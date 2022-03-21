$(function(){
    'use strict'
     var _token = $('meta[name="csrf-token"]').attr('content'); 
    $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': _token
         }
    });
    
    var branchtable = $('#branch-datatable').DataTable( {
        "scrollX": false,
         bLengthChange: false,
         responsive: true,
        "order": [[0, "desc" ]],
        "autoWidth": false,
                "processing": true,
                 "serverSide": true,
               "ajax": {
                    "url": base_url+"/branch/getdatatable",
                     "type": "POST",
                },
                "columns": [
                    { "data": "sno"},
                    {"data" : "name"},
                    {"data" : "code"},
                    {"data" : "region"},
                    {"data" : "address", "orderable":false},
                    {"data" : "city"},
                    {"data" : "state"},
                    {"data" : "pincode"},
                    {"data" : "status","orderable":false},
                    { "data": "action" ,"orderable":false}
                ],
                "columnDefs": [
                    { "width": "5%", "targets": 0 },
                    { "width": "20%", "targets": 1},
                    { "width": "10%", "targets": 2},
                    { "width": "10%", "targets": 3},
                    { "width": "15%", "targets": 4},
                    { "width": "10%", "targets": 5},
                    { "width": "10%", "targets": 6},
                    { "width": "8%", "targets": 7},
                    { "width": "8%", "targets": 8},
                    { "width": "10%", "targets": 9}
                 
                  ],
            } );
 
    $('.search-input-text').on( 'keyup change', function () {   // for text boxes
        var i =$(this).attr('data-column');  // getting column index
        var v =$(this).val();  // getting search input value
        branchtable.columns(i).search(v).draw();
   });
   
    $(document).on('click', '.btn-status', function (e) { 
        var name =$(this).attr('data-name');
        var id =$(this).attr('data-id');
        var status =parseInt($(this).attr('data-status'));
        var msg ="";var st=status;var typ="";
        if(status==1){
          st =0;typ="red";
          msg = "<p style='color:red;'>Sure you want to <i> Disable Branch </i> <strong>"+name+"</strong>? </p>";
        }else{
          st =1;typ="green";
          msg = "<p style='color:green;'>Sure you want to <i>Enable Branch </i> <strong>"+name+"</strong>? </p>";
        }

        $.confirm({
          title: 'Confirmation',
          content: msg,
          type: typ,
          typeAnimated: true,
          buttons: {
              confirm: function () {
                $.get(base_url+"/branch/status/update/"+id+"/"+st,function(resp) {
                    if($.trim(resp.status)=='success'){
                             if(st==0){
                               $('.branch-notify')._success(" Branch "+name+" is disabled successfully"); 
                             }else{
                               $('.branch-notify')._success(" Branch "+name+" is enabled successfully"); 
                             }
                         branchtable.ajax.reload();
                    }else{
                      $('.branch-notify')._error(resp.message); 
                    }
                },'json');
              },
              cancel: function () {
                  // $.alert('Canceled!');
              }
          }
      });
 
    });
   
    $("#BranchForm").validate({
        
        rules: {
            'name': { required: true },
            'code': { required: true,},
            'state': { required: true,},
            'city': { required: true,},
            'regionId': { required: true,},
            'address': { required: true,},
            'pincode': { required: true,}
        },
        submitHandler: function (form) {
             $('.saveBranchInfoBtn').loadButton('on',{ faClass:'fa',faIcon:'fa-spinner', doSpin:true, loadingText:'Submitting...'});
            $.post(base_url+'/branch/save/',$(form).serialize(),function(result){
                 $(".saveBranchInfoBtn").loadButton('off');
                if($.trim(result.status)=='success'){
                   $('.branch-notify')._success(result.message);
                   $('#BranchForm')[0].reset();
                    branchtable.ajax.reload();
                }else{
                   $('.branch-notify')._error(result.message);  
                }
            },'json')
            return false;
        }

    });
    
    $('body').on('change','#state',function(e){
        var stateID = $(this).val();
        $.get(base_url+"/get-cities/"+stateID,  function(result) {
            var newdata =result.data;
            $('#city').empty().trigger("change");
            var newState1 = new Option("choose city", "", true, true);
              $("#city").append(newState1); 
              
              jQuery.each(newdata, function (index, item) {
                 var newState = new Option(item['value'], item['id'], true, true);
                $("#city").append(newState);//.trigger('change');
              });
            $('#city').val('').trigger("change");
        },'json');
    });
 });
