$(function(){
    'use strict'
    
    var pretable = $('#pre-insurer-table').DataTable( {
        "scrollX": false,
         bLengthChange: false,
         responsive: true,
        "order": [[1, "asc" ]],
        "autoWidth": false,
                "processing": true,
                "serverSide": true,
               "ajax": {
                    "url": base_url+"/pre-insurers/datatable/",
                     "type": "POST",
                },
                "columns": [
                    { "data": "sno"},
                    {"data" : "name"},
                    {"data" : "digit_code"},
                    {"data" : "type"},
                    {"data" : "status"},
                    { "data": "action" ,"orderable":false}
                ],
                "columnDefs": [
                    { "width": "1%", "targets": 0 },
                    { "width": "39%", "targets": 1},
                    { "width": "15%", "targets": 2},
                    { "width": "15%", "targets": 3},
                    { "width": "15%", "targets": 4},
                    { "width": "15%", "targets": 5},
                 
                  ],
            } );
 
    $('.search-input-text').on( 'keyup change', function () {   // for text boxes
        var i =$(this).attr('data-column');  // getting column index
        var v =$(this).val();  // getting search input value
        pretable.columns(i).search(v).draw();
   });
   var createEditModal="";
   $('body').on('click','.edit-insurer',function(e){
      var id = $(this).attr('data-id'); 
      createEditModal = $.dialog({
                icon: 'icon ion-ios-list-outline',
                title:"Update Insurer",
                content: "url:"+base_url+"/pre-insurer/model/edit/"+id,
                type: 'red',
                animation: 'scale',
                columnClass: 'medium',
                closeAnimation: 'scale',
                backgroundDismiss: false,
                
            });
   });
   
    $('body').on('click','#addNewInsurer',function(e){
      createEditModal = $.dialog({
                icon: 'icon ion-ios-list-outline',
                title:"Create New Insurer",
                content: "url:"+base_url+"/pre-insurer/model/create/",
                type: 'red',
                animation: 'scale',
                columnClass: 'medium',
                closeAnimation: 'scale',
                backgroundDismiss: false,
                
            });
   });
   
   
   
   $('body').on('click','.insurerSaveChangeBtn',function(e){
        $("#add_editInsrerForm").validate();
        $('#insurer_name').rules("add",  {required: true });
        $('#insurer_digit_code').rules("add", {required: true});
        $('#insurer_type').rules("add", {required: true,});
        $('#insurer_status').rules("add", {required: true});
        if($('#add_editInsrerForm').valid() === true) {
            $('.insurerSaveChangeBtn').loadButton('on',{ faClass:'fa',faIcon:'fa-spinner', doSpin:true, loadingText:'Submitting...'});
             var formData = $('#add_editInsrerForm').serialize();
              $.post(base_url+"/pre-insurer/manage/save/",formData,function(result){
                  $(".smsTemplateSaveBtn").loadButton('off');
                  var st = $.trim(result.status);
                  if(st=="success"){
                      createEditModal.close();
                      pretable.ajax.reload(null, false);
                      notification('success',result.message);
                    }else{
                      notification('error',result.message);  
                    }
              },'json')
        }
        
            
    });
   
 });
