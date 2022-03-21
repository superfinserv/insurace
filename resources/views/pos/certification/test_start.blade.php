 @extends('pos.layouts.app')
    @section('content')
    
    
    
    
               <main role="main">

				<section class="invest-long page-heading-h3">
					<div class="container">
						<div class="row">
					       <div class="col-md-2 col-sm-2"></div>
					       <div class="col-md-8 col-sm-8 invest-long-bg">
					       	
					       	<div class="row">
					       		<div class="col-md-1"></div>
					       		<div class="col-md-8">
					       			
							<!-- <form method="post" id="questionForm" > -->
                                <div id="qustion_answers">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100" style="width:5%">
                                      1/20
                                    </div>
                                  </div>
                                   <input type="hidden" id="question_id"  name="question_id" value="{{$randomquestions->id}}">
                                <h2>1. {{$randomquestions->question_en}} </h2>
                                <?php foreach ($answers as $value) { ?>
                                     <p>
                                    <input type="radio" id="test{{$value->id}}"  name="answers" value="{{$value->id}}">
                                    <label for="test{{$value->id}}"><span class="ans-wer">{{$value->ans_en}}</span></label>
                                  </p>
                                <?php } ?>
                                 
                                 
                                    <button id="submit_question" href="#" class="btn btn-default btn-lg btn-dfault-amt become-sign-btn " style="width:25%; font-weight:100; margin-top:30px;">Next</button>
								</div>
					     <!--  </form> -->
					       		</div>
					       		<div class="col-md-3">
                                    <div id="timers"></div>                  
                                </div>
					       		
					       	</div>
					      
					       </div>
					       <div class="col-md-2 col-sm-2"></div>
					      
						</div>
					</div>
				</section>
				
			  </main>
	 
<script type="text/javascript">
         var div = document.getElementById('timers');
         function CountDown(duration, display) {
            var timer = duration, minutes, seconds;
            var interVal=  setInterval(function () {
                        minutes = parseInt(timer / 60, 10);
                        seconds = parseInt(timer % 60, 10);
                        minutes = minutes < 10 ? "0" + minutes : minutes;
                        seconds = seconds < 10 ? "0" + seconds : seconds;
                display.innerHTML ="<b>" + minutes + "m : " + seconds + "s" + "</b>";
                        if (timer > 0) {
                           --timer;
                        }else{
                   clearInterval(interVal)
                            SubmitFunction();
                         }

                   },1000);

            }

          function SubmitFunction(){
            var quationcontent="";
           $('.invest-long-bg').empty();
            quationcontent+='<div style="text-align:center"><div style="width:100%"> <img src="'+base_url+'/img/time_out.png" style=" height: 120px; /* width: 127px; */ margin-top: 40px; "></div><h2 style="padding-bottom: 10px;padding-top: 10px;"> TEST TIME OUT</h2><p>You need to exam complete 20 minutes</p><button class="btn btn-default btn-lg btn-dfault-amt become-sign-btn" style="width:25%; font-weight:100; margin-top:30px;" id="restart-test">Restart test</button></div>';
            $(quationcontent).appendTo('.invest-long-bg');

           }
         CountDown(1200,div);
       
       
       
</script>
    
    
    
<style>
.progress-bar {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    -ms-flex-pack: center;
    justify-content: center;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    background-color: #dc3545;
    transition: width .6s ease;
}
.progress {
    display: -ms-flexbox;
    display: flex;
    height: 2rem;
    overflow: hidden;
    font-size: 1.75rem;
    font-weight: 600;
    background-color: #e9ecef;
    border-radius: .25rem;
    margin-top: 25px;
}
div#timers {
    font-size: 22px;
    margin-top: 17px;
    border: 1px solid;
    border-radius: 10px;
    text-align: center;
    line-height: 37px;
    box-shadow: 0px 1px 1px 1px #e9ecef;
    background: #194580;
    color: #fff;
}
.invest-long-bg h2 {
    color: #194581 !important;
    font-size: 22px;
    letter-spacing: 0.5px;
    font-weight: 600;
}
section.invest-long.page-heading-h3 h2 {
    padding-top: 35px;
    padding-bottom: 25px;
}
span.ans-wer {
    margin-left: 18px;
    font-size: 16px;
    float: right;
}





[type="radio"]:checked,
[type="radio"]:not(:checked) {
    position: absolute;
    left: -9999px;
}
[type="radio"]:checked + label,
[type="radio"]:not(:checked) + label
{
    position: relative;
    padding-left: 28px;
    cursor: pointer;
    line-height: 20px;
    display: inline-block;
    color: #666;
}
[type="radio"]:checked + label:before,
[type="radio"]:not(:checked) + label:before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    width:28px;
    height:28px;
    border: 1px solid #194581;
    border-radius: 100%;
    background: #fff;
}
[type="radio"]:checked + label:after,
[type="radio"]:not(:checked) + label:after {
    content: '';
    width:20px;
    height:20px;
    background: #e12c30;
    position: absolute;
    top: 4px;
    left: 4px;
    border-radius: 100%;
    -webkit-transition: all 0.2s ease;
    transition: all 0.2s ease;
}
[type="radio"]:not(:checked) + label:after {
    opacity: 0;
    -webkit-transform: scale(0);
    transform: scale(0);
}
[type="radio"]:checked + label:after {
    opacity: 1;
    -webkit-transform: scale(1);
    transform: scale(1);
}
</style>    
    

    
    
    
    @endsection