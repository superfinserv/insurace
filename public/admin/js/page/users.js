$(function(){
    'use strict'
     
    
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
    
    
    var userstable = $('#users-datatable').DataTable( {
         scrollX: false,
         bLengthChange: false,
         responsive: true,
         order: [[0, "desc" ]],
         autoWidth: false,
                "processing": true,
                "serverSide": true,
               "ajax": {
                    "url": base_url+"/users/datatable",
                     "type": "POST",
                },
                "columns": [
                    { "data": "userID","orderable":true},
                    {"data" : "name","orderable":true},
                    {"data" : "mobile","orderable":true},
                    {"data" : "email","orderable":true},
                    {"data" : "role","orderable":true},
                    {"data" : "branch","orderable":true},
                    {"data" : "region","orderable":true},
                    {"data" : "status","orderable":false},
                    { "data": "action" ,"orderable":false}
                ],
                "columnDefs": [
                    { "width": "5%", "targets": 0 },
                    { "width": "12%", "targets": 1 },
                    { "width": "12%", "targets": 2 },
                    { "width": "15%", "targets": 3 },
                    { "width": "12%", "targets": 4 },
                    { "width": "10%", "targets": 5 },
                    { "width": "10%", "targets": 6 },
                    { "width": "7%", "targets": 7 },
                    { "width": "10%", "targets": 8 },
                    
                  ],
            } );
 
    $('.search-input-text').on( 'keyup change', function () {   // for text boxes
        var i =$(this).attr('data-column');  // getting column index
        var v =$(this).val();  // getting search input value
        userstable.columns(i).search(v).draw();
   });
    userstable.on( 'draw', function () { 
         $('[data-toggle="tooltip"]').tooltip({
            template: '<div class="tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
          });
   })
    $('body').on('click', '.reload-table', function (e) {
       userstable.ajax.reload();
   });
   
   $('body').on('click', '.user-vf', function (e) {
       var id = $(this).attr('data-id');
       var _this = $(this);
       var st = ($(this).find('span').hasClass('text-success'))?1:0;
        $.post(base_url+"/user/update-status/",{id:id,st:st},  function(result) { 
            if($.trim(result.status)=='success'){
                notification('success',result.message);
                if(parseInt(st)==1){
                    _this.find('span').removeClass('text-success');
                    _this.find('span').addClass('text-danger');
                    _this.find('span').text('unverified');
                }else{
                    _this.find('span').removeClass('text-danger');
                    _this.find('span').addClass('text-success');
                    _this.find('span').text('verified');
                }
                userstable.ajax.reload(null, false);
            }else{
                notification('error',result.message);
            }
        },'json');
   });
   
    $('body').on('change','#region',function(e){
        var regionID = $(this).val();
        if(regionID!=""){
                $.get(base_url+"/get-branch-by-region/"+regionID,  function(result) {
                    var newdata =result.data;
                    $('#branch').empty();
                    var newState1 = new Option("Choose Branch", "", true, true);
                      $("#branch").append(newState1); 
                      
                      jQuery.each(newdata, function (index, item) {
                         var newState = new Option(item['value'], item['id'], true, true);
                        $("#branch").append(newState);//.trigger('change');
                      });
                    $('#branch').val('').trigger("change");
                },'json');
        }else{
             $('#branch').empty();
              var newState1 = new Option("All Branch", "", true, true);
              $("#branch").append(newState1); 
             $('#branch').val('').trigger("change");
        }
    });
   
    $("#userRegisterInfo").validate({
        rules: {
            'user_name': { required: true },
            'mobile_no': { required: true,number:true,minlength:10},
            'alternate_mobile': { number:true,minlength:10},
            
            'user_email':{ required:true, email:true},
            'gender':{ required:true,},
            'region':{ required:true,},
            'branch':{ required:true,},
            'role':{ required:true,},
            'marital_status':{ required:true,},
            'address':{ required:true,},
            'state':{ required:true,},
            'city':{ required:true,},
            'pincode':{ required:true,number:true,minlength:6,maxlength:6 },
            'user_pass':{ required:true,minlength:6 },
            'user_cpass':{ required:true,equalTo:'#user_pass', },

        },

       submitHandler: function (form) {
             $('.userRegisterInfoBtn').loadButton('on',{ faClass:'fa',faIcon:'fa-spinner', doSpin:true, loadingText:'Submitting Information...'});
            $.post(base_url+'/users/new/saveInfo/',$(form).serialize(),function(result){
                 $(".userRegisterInfoBtn").loadButton('off');
                if($.trim(result.status)=='success'){
                   $('.user-register-notify')._success(result.message);
                  if($.trim(result.param)=='register'){
                   $('#userRegisterInfo')[0].reset();
                  }
                }else{
                   $('.user-register-notify')._error(result.message);  
                }
                
            },'json')
            return false;
        }

    });
    
   
    var resetModal ="";
   
    $('body').on('click', '.reset-password', function (e) { 
          var userid =$(this).attr('data-id');
        
    resetModal = $.dialog({
                icon: 'icon ion-key',
                title:'Reset Password',
                content: "url:"+base_url+"/users/reset-password/modal/"+userid,
                type: 'red',
                animation: 'scale',
                columnClass: 'medium',
                closeAnimation: 'scale',
                backgroundDismiss: false,
                onContentReady: function () {
                //   $("#agentPaymentupdateInfo").validate();
                 }
            });
 
    });
    
      $('body').on('click','.userResetPasswordBtn',function(e){
        $("#userResetPasswordForm").validate();
        $('#userPass').rules("add",  {required: true,minlength:6 });
        $('#usercPass').rules("add", {required: true,equalTo:'#userPass'});
       
        if($('#userResetPasswordForm').valid() === true) {
              var formData = $('#userResetPasswordForm').serialize();
              $.post(base_url+"/users/update/password/info/",formData,function(result){
                  var st = $.trim(result.status);
                  if(st=="success"){
                      //setTimeout(function(){ location.reload(); }, 3000);
                      resetModal.close();
                      notification('success',result.message);
                    }else{
                       $('.resetpass-notify')._error(result.message);  
                      // notification('success',result.message);  
                    }
              },'json')
        }
        
            
    });
    
    
   $.fn.clearForm = function() {
          return this.each(function() {
            var type = this.type, tag = this.tagName.toLowerCase();
            console.log(type);
            if (tag == 'form')
              return $(':input',this).clearForm();
            if (type == 'text' || type == 'password' || tag == 'textarea')
              $(this).val('');
            else if (type == 'checkbox' || type == 'radio')
              this.checked = false;
            else if (tag == 'select')
              this.selectedIndex = -1;
          });
};
    // if($('#userRegisterInfo').length>0){
    //       $('#userRegisterInfo').clearForm();
    //  }
    
   
 });
