$(function(){
    'use strict'
     var _token = $('meta[name="csrf-token"]').attr('content'); 
    $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': _token
         }
    });
    $(document).on('click', '#btnClearCache', function (e) { 
        e.preventDefault();
        $.get(base_url+"/clear-cache",function(resp) { 
            notification('success',resp)
        })
     });
    
     jQuery.validator.addClassRules('site-settings', {
       required: true
   })
    
     $("#settingsFormData").validate({
         highlight: function(element, errorClass) {
             $(element).addClass('has-error');
            
          },
          unhighlight: function(element, errorClass) {
             $(element).removeClass('has-error');
             
          },
          errorPlacement: function(error, element) {} ,
         submitHandler: function (form) {
             $('#btnSaveSettingsiNfo').loadButton('on',{ faClass:'fa',faIcon:'fa-spinner', doSpin:true, loadingText:'Updating...'});
             $.post(base_url+'/settings/site-settings/save-change/',$(form).serialize(),function(result){
                 $("#btnSaveSettingsiNfo").loadButton('off');
                if($.trim(result.status)=='success'){
                  notification($.trim(result.status),result.message);
                }else{
                    notification($.trim(result.status),result.message);
                }
            },'json')
            return false;
        }

    });
    
    
//     function validateInput(name){
//           if($('#'+name).val()!=""){
//               return true;
//           }else{
//               return false;
//           } 
//         }
     
//      $('body').on('input change','.input-fields', function(e) {     
//       $(this).css('border-color','#ced4da');
//       var id = $(this).attr('id');
//       $('#span-'+id).remove();
//      })

    
    
//     $(document).on('click', '.btn-update-site-settings', function (e) { 
//         e.preventDefault();
//         var _this=$(this);
//       var field = $(this).attr('data-key');
//       var type = $(this).attr('data-type');
//       if(validateInput(field)){
//             // var formData = $('#siteSettingsForm').serialize() ;
//             if(type=='file'){
                
//                 var formData = new FormData();
//                     formData.append('uploadFile', $('#'+field)[0].files[0]);
//                     formData.append('key', field);
//                     formData.append('type', type);
//                     $.ajax({
//                         url: base_url+'/site/settings/update/',
//                         data: formData,
//                         processData: false,
//                         contentType: false,
//                         type: 'POST',
//                         dataType:"json",
//                         success: function (data) {
//                             if($.trim(data.status) =='success'){
//                                 $('#src-path-'+field).attr('src',data.path);
//                                 $('#help-block-'+field).text(data.updateOn);
//                                 notification($.trim(data.status),data.message)
//                             }else{
//                                 $('#help-block-'+field).text(data.updateOn);
//                                 notification($.trim(data.status),data.message)
//                             }
                            
//                         }
//                     });
            
//           }else{
//               var formData = { key:field,type:type,value:$('#'+field).val()};
//                     $.post(base_url+"/site/settings/update/",formData,function(resp) {
//                         if($.trim(resp.status) =='success'){
//                             $('#help-block-'+field).text(resp.updateOn);
//                              notification($.trim(resp.status),resp.message)
//                         }else{
//                             $('#help-block-'+field).text(resp.updateOn);
//                             notification($.trim(resp.status),resp.message)
//                         }
//                     },'json');
                
//           }
//       }else{
//           $('#'+field).css('border-color','red');
//           $('#'+field ).parent().append('<sapn id="span-'+field+'" class="error">This field is required!</span>');
//       }
//     });
   
   
//   $("#ipForm").validate({
//         rules: {
//             'ip_address': { required: true },
//         },

//       submitHandler: function (form) {
           
//           var formData = $('#ipForm').serialize();
//             $.post(base_url+"/settings/save-ip/",formData,function(resp) {
//                 if($.trim(resp.status)=="success"){
//                                 $( ".ip-tbody-inner" ).prepend('<tr id="tr'+resp.data.id+'">'
//                                                              +'<td style="padding:12px 12px;"><span class="ipTr-span"></span></td>'
//                                                              +'<td style="padding:12px 12px;">'+resp.data.ip+'</td>'
//                                                              +'<td style="padding:12px 12px;">'
//                                                                 +'<a class="btn-delete-ip" data-ip="'+resp.data.ip+'" style="color:red;font-size: 20px;" href="#"  data-id="'+resp.data.id+'"><i class="icon ion-ios-trash"></i></a>'
//                                                              +'</td>'
//                                                           +'</tr>' );
//                                 var _i=1;$(".ipTr-span").each(function( ) {
//                                       $(this).text(_i);
//                                       _i++;
//                                     });
//                   notification($.trim(resp.status),resp.message);
//                   $('#ipForm').get(0).reset();
                    
//                 }else{
//                   notification($.trim(resp.status),resp.message); 
//                 }
//             },'json');

//              return false;
//          }

//     });
    
   
   
//     $('body').on('click', '.btn-delete-ip', function (e) { 
//         var ip =$(this).attr('data-ip');
//         var id =$(this).attr('data-id');
//         $.confirm({
//           icon:'icon ion-trash-a',
//           title: 'Confirmation',
//           content: "Sure you want to delete IP:<strong>"+ip+"</strong>?",
//           type: 'red',
//           typeAnimated: true,
//           buttons: {
//               confirm: function () {
//                 $.post(base_url+"/settings/delete-ip/",{id:id},function(resp) {
//                     if($.trim(resp.status)=='success'){
//                          $('#tr'+id).remove();
//                          var _in=1;
//                          $( ".ipTr-span" ).each(function( index ) {
//                               $(this).text(_in);
//                               _in++;
//                             });
//                          notification($.trim(resp.status),resp.message);
//                     }else{
//                         notification($.trim(resp.status),resp.message);
//                     }
//                 },'json');
//               },
//               cancel: function () {
//                   // $.alert('Canceled!');
//               }
//           }
//       });
 
//     })
   
 });
