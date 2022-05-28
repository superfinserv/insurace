$(function(){
    'use strict'
       $("#table-4").keypress(function(event) {event.preventDefault();});
       $('#table-4').datepicker({
           changeMonth: true,changeYear: true,dateFormat: 'dd/mm/yy',
        });
     var Rtable = $('#rules-datatable').DataTable({
        "scrollX": false,
         bLengthChange: false,
         responsive: true,
         //rowReorder: true,
         autoWidth: false,
                "processing": true,
                "serverSide": true,
                "pageLength":25,
                "order": [[ 0, "ASC" ]],
                "ajax": {
                    "url": base_url+"/rules/datatable",
                     "type": "POST",
                },
                "columns": [
                    {"data" : "ruleCode","orderable":true ,'className':''},
                    {"data" : "insurer","orderable":true,'className':''},
                     {"data" : "total","orderable":false,'className':'text-center'},
                    {"data" : "posp","orderable":true,'className':'vcode text-center'},
                    {"data" : "sp","orderable":true,'className':'vcode text-center'},
                    {"data" : "onamt","orderable":true,'className':'vcode text-center'},
                    {"data" : "vtype","orderable":true,'className':'text-center'},
                    {"data" : "dates","orderable":true,'className':''},
                    {"data" : "action","orderable":true,'className':'vcode text-center'}
                ],
                "columnDefs": [
                    { "width": "12%", "targets": 0 },
                    { "width": "25%", "targets": 1 },
                    { "width": "4%", "targets": 2 },
                    { "width": "4%", "targets": 3 },
                    { "width": "4%", "targets": 4 },
                    { "width": "5%", "targets": 5 },
                    { "width": "15%", "targets": 6},
                    { "width": "15%", "targets":7 },
                    { "width": "8%", "targets": 8 },
                    
                  ],
            } );
             $('.search-input-text').on( 'keyup change', function () {   // for text boxes
                var i =$(this).attr('data-column');  // getting column index
                var v =$(this).val();  // getting search input value
                Rtable.columns(i).search(v).draw();
           });
           
           
           var Modal="";
           $('body').on('click','.open-model',function(e){
              var param = $(this).attr('data-param'); 
              let title ="",url=base_url+"/rules/model/";
              if(param=='create'){
                  title =  "Create New Rule";
                  url=base_url+"/rules/model/create";
              }else{
                   let code = $(this).attr('data-code'); 
                   title =  "Update Rule : "+code;
                   url=base_url+"/rules/model/edit/"+code;
              }
              Modal = $.dialog({
                        icon: 'icon ion-ios-list-outline',
                        title:title,
                        content: "url:"+url,
                        type: 'red',
                        animation: 'scale',
                        columnClass: 'large',
                        closeAnimation: 'scale',
                        backgroundDismiss: false,
                        
                    });
           });
           
           $('body').on('click','.RuleSaveChangeBtn',function(e){
                    $("#add_editRuleForm").validate();
                    $('#insurer').rules("add",  {required: true });
                    $('#instype').rules("add", {required: true});
                    $('#policyType').rules("add", {required: true,});
                    $('#cTyp').rules("add", {required: true});
                    $('#fromDate').rules("add", {required: true});
                    $('#toDate').rules("add", {required: true});
                    $('#totalOut').rules("add", {required: true});
                    $('#pospOut').rules("add", {required: true});
                    $('#spOut').rules("add", {required: true});
                    if($('#add_editRuleForm').valid() === true) {
                        $('.RuleSaveChangeBtn').loadButton('on',{ faClass:'fa',faIcon:'fa-spinner', doSpin:true, loadingText:'Submitting...'});
                         var formData = $('#add_editRuleForm').serialize();
                          $.post(base_url+"/rules/manage/save/",formData,function(result){
                              $(".RuleSaveChangeBtn").loadButton('off');
                              var st = $.trim(result.status);
                              if(st=="success"){
                                  Modal.close();
                                  Rtable.ajax.reload(null, false);
                                  notification('success',result.message);
                                }else{
                                  notification('error',result.message);  
                                }
                          },'json')
                    }
                    
                        
                });
                
           $('body').on('click', '.btn-copy', function (e) { 
                    var code =$(this).attr('data-code');
                    $.confirm({
                      icon:'icon ion-ios-copy',
                      title: 'Copy Rule:'+code,
                      content: "Sure you want to copy rule " +code,
                      type: 'green',
                      typeAnimated: true,
                      buttons: {
                          confirm: function () {
                            $.post(base_url+"/rules/manage/copy/rule/",{code:code},function(resp) {
                                var st = $.trim(resp.status);
                              if(st=="success"){
                                  Rtable.ajax.reload(null, false);
                                  notification('success',resp.message);
                                }else{
                                  notification('error',resp.message);  
                                }
                            },'json');
                          },
                          cancel: function () {
                              // $.alert('Canceled!');
                          }
                      }
                  });
 
        });
})