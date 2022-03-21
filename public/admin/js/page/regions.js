$(function(){
    'use strict'
     var _token = $('meta[name="csrf-token"]').attr('content'); 
    $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': _token
         }
    });
    
    var regiontable = $('#region-datatable').DataTable( {
        "scrollX": false,
         bLengthChange: false,
         responsive: true,
        "order": [[0, "desc" ]],
        "autoWidth": false,
                "processing": true,
                 "serverSide": true,
               "ajax": {
                    "url": base_url+"/regions/getdatatable",
                     "type": "POST",
                },
                "columns": [
                    { "data": "sno"},
                    {"data" : "name"},
                    {"data" : "desc","orderable":false},
                    {"data" : "status","orderable":false},
                    { "data": "action" ,"orderable":false}
                ],
                "columnDefs": [
                    { "width": "5%", "targets": 0 },
                    { "width": "25%", "targets": 1 },
                    { "width": "50%", "targets": 2 },
                    { "width": "20%", "targets": 3},
                 
                  ],
            } );
 
    $('.search-input-text').on( 'keyup change', function () {   // for text boxes
        var i =$(this).attr('data-column');  // getting column index
        var v =$(this).val();  // getting search input value
        regiontable.columns(i).search(v).draw();
   });
   
    $(document).on('click', '.btn-status', function (e) { 
        var name =$(this).attr('data-name');
        var id =$(this).attr('data-id');
        var status =parseInt($(this).attr('data-status'));
        var msg ="";var st=status;var typ="";
        if(status==1){
          st =0;typ="red";
          msg = "<p style='color:red;'>Sure you want to <i> Disable Region </i> <strong>"+name+"</strong>? </p>";
        }else{
          st =1;typ="green";
          msg = "<p style='color:green;'>Sure you want to <i>Enable Region </i> <strong>"+name+"</strong>? </p>";
        }

        $.confirm({
          title: 'Confirmation',
          content: msg,
          type: typ,
          typeAnimated: true,
          buttons: {
              confirm: function () {
                $.get(base_url+"/regions/status/update/"+id+"/"+st,function(resp) {
                    if($.trim(resp.status)=='success'){
                             if(st==0){
                               $('.region-notify')._success(" Region "+name+" is disabled successfully"); 
                             }else{
                               $('.region-notify')._success(" Region "+name+" is enabled successfully"); 
                             }
                         regiontable.ajax.reload();
                    }else{
                      $('.region-notify')._error(resp.message); 
                    }
                },'json');
              },
              cancel: function () {
                  // $.alert('Canceled!');
              }
          }
      });
 
    });
   
    $("#RegionsForm").validate({
        
        rules: {
            'regionName': { required: true },
            'regionDesc': { required: true,},
        },
        submitHandler: function (form) {
             $('.saveRegionInfobtn').loadButton('on',{ faClass:'fa',faIcon:'fa-spinner', doSpin:true, loadingText:'Submitting...'});
            $.post(base_url+'/regions/save',$(form).serialize(),function(result){
                 $(".saveRegionInfobtn").loadButton('off');
                if($.trim(result.status)=='success'){
                   $('.region-notify')._success(result.message);
                   $('#RegionsForm')[0].reset();
                    regiontable.ajax.reload();
                }else{
                   $('.region-notify')._error(result.message);  
                }
            },'json')
            return false;
        }

    });
 });
