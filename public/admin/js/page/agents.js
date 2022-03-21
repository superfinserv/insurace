$(function(){
    'use strict'
   $(document).on('click', '#go_hdfc_plan', function (e) { 
       var formData = {ssoID:$('#ssoID').val()}
        $.ajax({
                type: "post",
                url:base_url + "/agents/hdfc-route",
                data : formData,
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    var str = $.trim(data.status);
                    if (str == 'success'){
                        if($.trim(data.data.token)!="" && $.trim(data.data.uid)!=""){
                           var url ="https://salesdiary.hdfclife.com/TEBTParPortal/integrate.do?_actionid=ext.tebt.launch&userid="+data.data.uid+"&partnerintegration=Y&hdfcsecuritytoken="+data.data.token+"&subchannel=SuperSolutions";
                           window.open(url);
                        }else{
                            alert("Invalid authentication");
                        }
                    }else{
                         alert("Invalid authentication");
                    }
                  }
                });
      
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
    
    
    var agenttable = $('#agent-datatable').DataTable( {
        "scrollX": false,
         bLengthChange: false,
         responsive: true,
        "autoWidth": false,
                "processing": true,
                "serverSide": true,
               "ajax": {
                    "url": base_url+"/agents/getAgentsdatatable",
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
                    { "width": "3%", "targets": 0 },
                    { "width": "15%", "targets": 1 },
                    { "width": "7%", "targets": 2 },
                    { "width": "20%", "targets": 3 },
                    { "width": "10%", "targets": 4 },
                    { "width": "10%", "targets": 5 },
                    { "width": "10%", "targets": 6 },
                    { "width": "10%", "targets": 7 },
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
   
   
   $("#agentRegisterInfo").validate({
        rules: {
            'agent_name': { required: true },
            'mobile_no': { required: true,number:true,minlength:10},
            'email':{ required:true, email:true},
            'gender':{ required:true,},
            'marital_status':{ required:true,},
            'address':{ required:true,},
            'state':{ required:true,},
            'city':{ required:true,},
            'pincode':{ required:true,number:true,minlength:6 },
            'agent_pass':{ required:true,minlength:6 },
            'agent_cpass':{ required:true,equalTo:'#agent_pass', },
        },

       submitHandler: function (form) {
             $('.agentRegisterInfoBtn').loadButton('on',{ faClass:'fa',faIcon:'fa-spinner', doSpin:true, loadingText:'Submitting Information...'});
            $.post(base_url+'/agent/new/saveInfo/',$(form).serialize(),function(result){
                 $(".agentRegisterInfoBtn").loadButton('off');
                if($.trim(result.status)=='success'){
                   $('.agent-register-notify')._success(result.message);
                   $('#agentRegisterInfo')[0].reset();
                }else{
                   $('.agent-register-notify')._error(result.message);  
                }
            },'json')
            return false;
        }

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
        }
        // else{
        //   $('.resetpass-notify')._error("All field are required!");    
        // }
            
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
   
   $('body').on('click', '.reload-table', function (e) {
       $(this).find('i').addClass('fa-spin');
       agenttable.ajax.reload();
        $(this).find('i').removeClass('fa-spin');
   });
   
   $(document).on('click', '.btn-testAllow', function (e) { 
        var name =$(this).attr('data-name');
        var id =$(this).attr('data-id');
        var isTestAllow =$(this).attr('data-isTestAllow');
        var msg ="";var status="";var typ="";
        if(isTestAllow==1){
          isTestAllow =0;typ="red";
          msg = "<p style='color:red;'>Sure you want to <i> Disable certifiction for </i> <strong>"+name+"</strong>? </p>";
        }else{
          isTestAllow =1;typ="green";
          msg = "<p style='color:green;'>Sure you want to <i>Enable certifiction for </i> <strong>"+name+"</strong>? </p>";
        }

        $.confirm({
          title: 'Confirmation',
          content: msg,
          type: typ,
          typeAnimated: true,
          buttons: {
              confirm: function () {
                $.get(base_url+"/agents/allowTest/"+id+"/"+isTestAllow,function(resp) {
                    if(resp.status=='success'){
                             if(isTestAllow==1){
                                $('.agent-list-notify')._success("Disabled certifiction for "+name); 
                             }else{
                               $('.agent-list-notify')._success("Enabled certifiction for "+name); 
                             }
                         agenttable.ajax.reload();
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
   
   $(document).on('click', '.btn-markVerify', function (e) { 
        var name =$(this).attr('data-name');
        var id =$(this).attr('data-id');
        var isVerified =$(this).attr('data-isVerified');
        var msg ="";var status="";var typ="";
        if(isVerified==1){
          isVerified =0;typ="red";
          msg = "<p style='color:red;'>Sure you want to <i> mark as un-verified to </i> <strong>"+name+"</strong>? </p>";
        }else{
          isVerified =1;typ="green";
          msg = "<p style='color:green;'>Sure you want to <i> mark as verified to </i> <strong>"+name+"</strong>? </p>";
        }

        $.confirm({
          title: 'Confirmation',
          content: msg,
          type: typ,
          typeAnimated: true,
          buttons: {
              confirm: function () {
                $.get(base_url+"/agents/agent-verification/"+id+"/"+isVerified,function(resp) {
                    if(resp.status=='success'){
                        if(isVerified==1){
                            $('.agent-list-notify')._success("Marked as un-verified to "+name); 
                         }else{
                           $('.agent-list-notify')._success("Mark as verified to "+name); 
                         }
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
   
    $('body').on('click', '.btn-trash', function (e) { 
        var name =$(this).attr('data-name');
        var id =$(this).attr('data-id');
        $.confirm({
          icon:'icon ion-trash-a',
          title: 'Confirmation',
          content: "Sure you want to Move trash to <strong>"+name+"</strong>?",
          type: 'red',
          typeAnimated: true,
          buttons: {
              confirm: function () {
                $.post(base_url+"/agents/trash/process",{id:id,'param':'move'},function(resp) {
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
