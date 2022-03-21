$(function(){
    'use strict'
    
     var isDone = "";
     $('#agent-certificates-table').DataTable();
     localStorage.removeItem("cartTest");
     $(document).on('click', '#btn-next-question', function (e) {
          var testBody =$('.testbodyContainer');
          var ansId = 0;
          var count = parseInt(testBody.find('#test-que-count').val())+1;
          var queId = testBody.find('#test-que-id').val();
          var radioValue = testBody.find("input[name='test-answer']:checked").val();
          if(radioValue){  ansId = radioValue;}
         
            var cartTest = {};
            if(localStorage.getItem('cartTest')){ cartTest = JSON.parse(localStorage.getItem('cartTest'));}
            if(cartTest[queId]){ }else{ cartTest[queId] = {queId:queId,ansid:ansId}; }
            localStorage.setItem("cartTest", JSON.stringify(cartTest));
            isDone = (isDone!="")?isDone+","+queId:queId;
            
              $.post(base_url+"/certificate/getQuestion/",{count:count,isDone:isDone},function(result){
                  $('.test-progress').text(count+"/20");
                  var width = parseInt(count)*parseInt(5);
                  $('.test-progress').css('width',width+'%');
                  $('.testbodyContainer').empty();
                  $('.testbodyContainer').append(result);
              }) 
     });
     
     $(document).on('click', '#btn-submit-test', function (e) {
         $("#overlay").fadeIn(300);　
         $(this).attr('disabled',true);$(this).prop('disabled',true);
          var testBody =$('.testbodyContainer');
          var ansId = 0;
          var count = parseInt(testBody.find('#test-que-count').val())+1;
          var queId = testBody.find('#test-que-id').val();
          var radioValue = testBody.find("input[name='test-answer']:checked").val();
          if(radioValue){  ansId = radioValue;}
         
            var cartTest = {};
            if(localStorage.getItem('cartTest')){ cartTest = JSON.parse(localStorage.getItem('cartTest'));}
            if(cartTest[queId]){ }else{ cartTest[queId] = {queId:queId,ansid:ansId}; }
             localStorage.setItem("cartTest", JSON.stringify(cartTest));
             isDone = (isDone!="")?isDone+","+queId:queId;
             var testData = JSON.parse(localStorage.getItem('cartTest'));
             var postData = {count:count,id:$('#testAgentId').val(),testData:testData};
             
             $.post(base_url+"/certificate/submitTest/",postData,function(result){
               if($.trim(result.status)=='success'){
                   location.reload();
               }else{
                   location.reload();
               }
            },'json') 
     });
    $(document).on('click', '.take-test', function (e) { 
          var agentid =$(this).attr('data-id');
         localStorage.removeItem("cartTest");
         isDone="";
            $.dialog({
                icon: 'icon ion-ios-bookmarks-outline',
                title:'Start Test',
                content: "url:"+base_url + "/certificate/start/model/"+agentid,
                type: 'red',
                animation: 'scale',
                columnClass: 'medium',
                closeAnimation: 'scale',
                backgroundDismiss: false,
                onContentReady: function () {
                     $.post(base_url+"/certificate/getQuestion/",{count:1,isDone:''},function(result){
                         $('.testbodyContainer').append(result);
                         
                     })   
                        
                }
            });
 
    });
    
     $('body').on('click', '#regenerate_cert', function (e) {
         var _this = $(this);
         _this.find('i').addClass('fa-spin');
         var id = $(this).attr('data-id')
         $.post(base_url+"/certificate/regenerate/",{id:id},function(result){
              var st = $.trim(result.status);
              notification(st,result.message)
              _this.find('i').removeClass('fa-spin');
              $('#download-link').attr('href',result.path);
              //toastr.success('Have fun storming the castle!', 'Miracle Max Says')
         },'json');
     });
    
    
 });
