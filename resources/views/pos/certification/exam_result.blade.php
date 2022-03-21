 @extends('pos.layouts.app')
    @section('content')
    <main role="main">
		<section class="invest-long page-heading-h3">

					<div class="container">

						<div class="row">

					       <div class="col-md-2 col-sm-2"></div>

					       <div class="col-md-8 col-sm-8 invest-long-bg">

					       	

					       	<div class="row">

					       		<div class="col-md-2"></div>

					       		<div class="col-md-8">

					       			
							<?php   if($result->percentage>=$result->required_marks){ ?>
                                      <div style="text-align: center;">

                                         <img src="{{asset('img/achievement.png')}}" style=" height: 120px; /* width: 127px; */ margin-top: 40px; ">

                                         <h2>You got {{$result->percentage}}% marks. </h2>

                                         <h1>Congrats!</h1>

                                         <h2>You just pass the test level.</h2>

                                         <a  href="{{url('/profile')}}/" class="btn btn-default btn-lg btn-dfault-amt become-sign-btn " style=" font-weight:600; margin-top:30px;">Finish</a>

                                        <a  href="{{url('/exam-review')}}/{{$id}}" class="btn btn-default btn-lg btn-dfault-amt become-sign-btn " style=" font-weight:600; margin-top:30px;">Review Test</a>

                                    </div>



                                <?php }else{ ?>
                                      <div style="text-align: center;">

                                     <img src="{{asset('img/failed.png')}}" style=" height: 120px; /* width: 127px; */ margin-top: 40px; ">

                                     <h2>You got {{$result->percentage}}% marks. </h2>

                                     <h1 style="color: red !IMPORTANT;">Failed!</h1>

                                     <h2>You are failed in this test, Try Again.</h2>
                                     <table >
                                         <tr>
                                             <td style=" text-align: left; ">Currect answer</td><td style=" text-align: right; "><?php $currect=$result->obtained_marks/5; echo $currect;?></td>
                                         </tr>
                                          <tr>
                                             <td style=" text-align: left; ">Incurrect answer</td><td style=" text-align: right; "><?php $incurrect=20-$currect; echo $incurrect;?></td>
                                         </tr>
                                          <tr>
                                             <td style=" text-align: left; ">Passing Marks</td><td style=" text-align: right; ">50%</td>
                                         </tr>
                                          <tr>
                                             <td style=" text-align: left; ">Your Marks</td><td style=" text-align: right; ">{{$result->percentage}}%</td>
                                         </tr>
                                     </table>
                                    <a  href="{{url('/test-start')}}" class="btn btn-default btn-lg btn-dfault-amt become-sign-btn " style=" font-weight:600; margin-top:30px;">Attempt Again</a>

                                    <a  href="{{url('/exam-review')}}/{{$id}}" class="btn btn-default btn-lg btn-dfault-amt become-sign-btn " style=" font-weight:600; margin-top:30px;">Review Test</a>

                                </div>


                            <?php } ?>

                              
					  

					       		</div>

					       		<div class="col-md-2"></div>

					       		

					       	</div>

					      

					       </div>

					       <div class="col-md-2 col-sm-2"></div>

					      

						</div>

					</div>

				</section>
    </main>

	 



    

    

    

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

.invest-long-bg h1 {

    color: #28a745 !important;

    font-size: 40px;

    letter-spacing: 0.5px;

    font-weight: 600;

    padding-top: 10px;

    padding-bottom: 10px;

}

.invest-long-bg h2 {

    color: #194581 !important;

    font-size: 22px;

    letter-spacing: 0.5px;

    font-weight: 600;

}

section.invest-long.page-heading-h3 h2 {

    padding-top: 10px;

    padding-bottom: 10px;

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