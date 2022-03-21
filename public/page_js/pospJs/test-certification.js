$(document).ready(function(){
    'use strict';
     var _token = $('meta[name="csrf-token"]').attr('content'); 
     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': _token
        }
     });
});

$('body').on('click','.starttest',function(){
    $.get(base_url+"/is-allow-certification-test", function(data) {
        var str = $.trim(data.status);
        if (str == "success") {
            $.confirm({
                   title: data.title,
                   content: "<h4>Now you can start certification.</h4><p>Test Time :20 minutes.<p><p>Questions :20 <p><p>Marks :100<p>",
                   buttons: {
                            formSubmit: {
                                text: "START",
                                btnClass: 'btn-danger',
                                action: function () {  window.location.href = base_url + "/test-start"; }
                            },
                            LATER: function () { },
                    },
            });
        }else{
            $.confirm({
                    title: '<span style="color:#C52118">'+data.title+'</span>',
                    icon:'fa fa-exclamation-triangle',
                    content: '<p style="color:#0E3679">'+data.msg+'</p>',
                    buttons: {
                        formSubmit: {
                            text: 'OK',
                            btnClass: 'btn-danger',
                            action: function () {
                                 window.location.href = base_url + "/profile";
                            }
                        },
                        LATER: function () {},
                    },
            });
        }
  },'json');
})
$('body').on('click','#restart-test',function(){
 window.location.href = base_url + "/test-start";
});

$('body').on('click','#submit_question',function(){
        var question_id=$('#question_id').val();
        var answers_id ="";
        if($("input[name='answers']:checked").val()){
            answers_id=$("input[name='answers']:checked").val()
        }else{
            answers_id=0;
        }
        var quationcontent='';var questionData=[];var addItem="";var question_ids="";
        pushIt(answers_id,question_id);
        cartPos = JSON.parse(localStorage.getItem('cartPos'));
        addItem = Object.keys(cartPos).length;
        total_question= parseInt(addItem)+1;
        progressbar=parseInt(total_question)*5;
        $.each(cartPos, function (key, valData) { var questionfdgfd=key+','; question_ids+=[questionfdgfd]; });
        
        $.get(base_url+"/questions/"+question_ids, function(data) {
            var questions=data.randomquestions; var answers=data.answers;
            var str = $.trim(data.statusCode);
            $('#qustion_answers').empty();
            
            if (str == 200) {
                quationcontent+='<div class="progress">'
                                 +'<div class="progress-bar" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="width:'+progressbar+'%">'
                                   +total_question+'/20'
                                 +'</div>'
                                +'</div>'
                                +'<h2>'+total_question+'. '+questions.question_en+' </h2><input type="hidden" id="question_id"  name="question_id" value="'+questions.id+'">';
                 $.each(answers, function (key, valData) {
                  quationcontent+='<p>'
                   +' <input type="radio" id="test'+valData.id+'" name="answers" value="'+valData.id+'">'
                   +' <label for="test'+valData.id+'"><span class="ans-wer">'+valData.ans_en+' </span></label>'
                  +'</p>';
                }); 
                if(total_question<20){
                    quationcontent+='<button class="btn btn-default btn-lg btn-dfault-amt become-sign-btn" style="width:25%; font-weight:100; margin-top:30px;" id="submit_question">Next</button>';
                }else{
                   quationcontent+='<button class="btn btn-default btn-lg btn-dfault-amt become-sign-btn" style="width:25%; font-weight:100; margin-top:30px;" id="submit_all_question">Submit</button>';
                }
              $(quationcontent).appendTo('#qustion_answers');
           }
        },'json');
      }); 





function pushIt(answers_id,question_id) {
  var cartPos = {};
    if (localStorage.getItem('cartPos')){
       cartPos = JSON.parse(localStorage.getItem('cartPos'));
    }
    cartPos[question_id] = {question_id:question_id,answers_id:answers_id};
    localStorage.setItem("cartPos", JSON.stringify(cartPos));
}
$(window).on("unload", function(e) {
  localStorage.removeItem('cartPos');
});

$('body').on('click','#submit_all_question',function(){
var $tocken=$('meta[name="csrf-token"]').attr('content');
var question_id=$('#question_id').val();
var answers_id ="";
if($("input[name='answers']:checked").val()){  answers_id=$("input[name='answers']:checked").val() }else{ answers_id=0; }
    pushIt(answers_id,question_id);
    var postdata={ cartPos:JSON.parse(localStorage.getItem('cartPos')),_token: $tocken };
        $.ajax({
                type: "POST",
                url: base_url+'/submit_question',
                data:postdata,
                dataType:'json',
                success: function (data) {
                    localStorage.removeItem('cartPos');
                    var str = $.trim(data.statusCode);
                    if (str == 200) {
                        window.location.href = base_url + "/exam-result/"+data.certification_id;
                    } else if(str == 'exist'){
                        $(".abc").show();
                        $('#otpbased').hide();
                        $('.ajax_responsea').html('');
                        $('.ajax_responsea').html('<div class="alert alert-warning alert-bordered"><span class="text-semibold">Opps ! </span> Email Alerady exist !.</div>')
                    }else{
                        $(".abc").show();
                        $('#otpbased').hide();
                        $('.ajax_responsea').html('');
                        $('.ajax_responsea').html('<div class="alert alert-danger alert-bordered"><span class="text-semibold">Opps Error ! </span>Internal error try again!.</div>')
                    }
                },
                error: function () { }
            });
      });