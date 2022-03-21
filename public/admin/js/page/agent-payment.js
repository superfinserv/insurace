$(function(){
    'use strict'
    
    //  var isDone = "";
    //  $('#agent-certificates-table').DataTable();
    //  localStorage.removeItem("cartTest");
    //  $(document).on('click', '#btn-next-question', function (e) {
    //       var testBody =$('.testbodyContainer');
    //       var ansId = 0;
    //       var count = parseInt(testBody.find('#test-que-count').val())+1;
    //       var queId = testBody.find('#test-que-id').val();
    //       var radioValue = testBody.find("input[name='test-answer']:checked").val();
    //       if(radioValue){  ansId = radioValue;}
         
    //         var cartTest = {};
    //         if(localStorage.getItem('cartTest')){ cartTest = JSON.parse(localStorage.getItem('cartTest'));}
    //         if(cartTest[queId]){ }else{ cartTest[queId] = {queId:queId,ansid:ansId}; }
    //         localStorage.setItem("cartTest", JSON.stringify(cartTest));
    //         isDone = (isDone!="")?isDone+","+queId:queId;
            
    //           $.post(base_url+"/certificate/getQuestion/",{count:count,isDone:isDone},function(result){
    //               $('.test-progress').text(count+"/20");
    //               var width = parseInt(count)*parseInt(5);
    //               $('.test-progress').css('width',width+'%');
    //               $('.testbodyContainer').empty();
    //               $('.testbodyContainer').append(result);
    //           }) 
    //  });
     
    //  $(document).on('click', '#btn-submit-test', function (e) {
    //      $("#overlay").fadeIn(300);　
    //      $(this).attr('disabled',true);$(this).prop('disabled',true);
    //       var testBody =$('.testbodyContainer');
    //       var ansId = 0;
    //       var count = parseInt(testBody.find('#test-que-count').val())+1;
    //       var queId = testBody.find('#test-que-id').val();
    //       var radioValue = testBody.find("input[name='test-answer']:checked").val();
    //       if(radioValue){  ansId = radioValue;}
         
    //         var cartTest = {};
    //         if(localStorage.getItem('cartTest')){ cartTest = JSON.parse(localStorage.getItem('cartTest'));}
    //         if(cartTest[queId]){ }else{ cartTest[queId] = {queId:queId,ansid:ansId}; }
    //          localStorage.setItem("cartTest", JSON.stringify(cartTest));
    //          isDone = (isDone!="")?isDone+","+queId:queId;
    //          var testData = JSON.parse(localStorage.getItem('cartTest'));
    //          var postData = {count:count,id:$('#testAgentId').val(),testData:testData};
             
    //          $.post(base_url+"/certificate/submitTest/",postData,function(result){
    //           if($.trim(result.status)=='success'){
    //               location.reload();
    //           }else{
    //               location.reload();
    //           }
    //         },'json') 
    //  });
    $('body').on('click','.agentPaymentUpdateBtn',function(e){
             console.log("clicked");
               $("#agentPaymentupdateInfo").validate();
                $('#transactionID').rules("add", {required: true,
                                                  messages: { required: "Transaction ID is required"}
                                        });
                $('#transactionDate').rules("add", {required: true,
                                                    messages: { required: "Transaction Date is required"}
                                            });
                $('#transactionMode').rules("add", { required: true,
                                                     messages: { required: "Transaction Mode is required"}
                                            });
                if($('#agentPaymentupdateInfo').valid() === true) {
                      var formData = $('#agentPaymentupdateInfo').serialize();
                      $.post(base_url+"/agent/payment/update/info/",formData,function(result){
                          var st = $.trim(result.status);
                          if(st=="success"){
                              setTimeout(function(){ location.reload(); }, 3000);
                              $('.pay-notify')._success(result.message); 
                            }else{
                               $('.pay-notify')._error(result.message);  
                            }
                      },'json')
                }else{
                   $('.pay-notify')._error("All field are required!");    
                }
            
    });
    $(document).on('click', '.pay-modify', function (e) { 
          var agentid =$(this).attr('data-id');
        
            $.dialog({
                icon: 'icon ion-ios-bookmarks-outline',
                title:'Update Payment',
                content: "url:"+base_url + "/agent/payment/modal/info/"+agentid,
                type: 'red',
                animation: 'scale',
                columnClass: 'medium',
                closeAnimation: 'scale',
                backgroundDismiss: false,
                onContentReady: function () {
                    $('#transactionDate').datepicker({
                      selectOtherMonths: true,
                      dateFormat: 'yy-mm-dd',
                     });
                    $("#agentPaymentupdateInfo").validate();
                   
                    }
            });
 
    });
    
    
 });
