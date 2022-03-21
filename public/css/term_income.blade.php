 @extends('layout.app')

    @section('content')

<main role="main">

				

				<section class="">

					<div class="container">

						<div class="row">

							

						</div>

					</div>

				</section>

				<section class="do-smoke ptb">

					<h1>  We have found 13 plans for you starting at ₹ 519/month </h1>

					<p>Just one more step to view quotes</p>

					<div class="container do-smoke-bg">

						<form  enctype="multipart/form-data"  id="incomeForm" method="post">

                            <input name="_token" type="hidden" value="{{ csrf_token() }}" />

						<div class="row">

							<div class="col-md-6 col-sm-6">

								<div class="do-smoke-tit">

									<h1>2/2 What's your annual income?</h1>

								</div>

							</div>

							<div class="col-md-4 col-sm-4">

								

									<div class="form-group">



		                          <!--   <select class="smoke-income-se invest-month" name="income" id="income">

		                            	<option value="">Select income</option>

		                            	<?php for ($i =1; $i <= 50; $i++) {  ?> 

		                                   <option value="<?php echo $i;?>" ><?php echo $i;?> lakh</option>

		                                  <?php } ?>

		                            	

		                            </select> -->
		                            <!-- <input type="number" class="form-control" name="Please select income of per annum" placeholder="Rs.5,000 /-"> -->
		                            <div class="range-slider">
									  <input class="range-slider__range" type="range" value="250" min="0" max="10000" step="50">
									  <span class="range-slider__value">0</span>
									</div>

		                           

								</div>

							</div>

							<p class="smoke-inp text-center"> Enter your approximate annual income (CTC). We need this to determine your maximum cover<br> eligibility which is 30 times of your annual income</p>

							

							</div>



							<div class="row term-iso-mt">

									<div class="col-md-6 col-sm-6">

										<a href="{{url('term-insurance/do-skome')}}" class="smoke-annual">Back</a>

									</div>

									<div class="col-md-6 col-sm-6">

										<button type="submit" href="#" class="smoke-annual2">Done</button>

									</div>

							</div>





				    </div>

				</section>

				<section class="smoke-inkem">

					<div class="container do-smoke-bg">

						

					</div>

				</section>





			</main>

<style type="text/css">

    button{

               background: #30435e;

        /* float: right; */

        width: 20% !important;

        padding: 5px 0px;

        border-radius: 3px;

        box-shadow: 0 16px 24px 2px rgba(0, 0, 0, .14), 0 6px 30px 5px rgba(0, 0, 0, .12), 0 8px 10px -5px rgba(0, 0, 0, .2);

          margin-top: 0px !important;

        border: 0px;

        color: #fff;

    }

    span.select2-selection.select2-selection--single {

    text-align: left;

    padding-left: 7px;

}


</style>

    @endsection