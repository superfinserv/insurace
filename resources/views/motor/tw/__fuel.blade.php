 @extends('web.layout.app')

    @section('content')

			<main role="main">



				<section class="invest-long page-heading-h2">

					<div class="container invest-long-bg text-center">

						<h2> What is the fuel type? </h2>

						<!--<p>TOP BIKE</p>-->

						<form class="form-group"  enctype="multipart/form-data"  id="fueltypeForm" method="post" >

                           <input name="_token" type="hidden" value="{{ csrf_token() }}"  />

						<div class="row mt-3 text-center">

							<div class="col-md-4 col-sm-4"></div>

							<div class="col-md-4 col-sm-4">

								<div class="inputGroup br-all alig-20">

										    <input id="radio3" name="fueltype" class="invest-selector" type="radio" data-rowid="row-lumpsum" data-text="Yearly" value="Petrol">

										    <label for="radio3">Petrol</label>

										  </div>
										  <div id="errors"></div>

							</div>

							<!-- <div class="col-md-3 col-sm-3 ">

								<div class="inputGroup br-all alig-20">

										    <input id="radio2" name="fueltype" class="invest-selector" type="radio" data-rowid="row-year" data-text="Monthly" value="Diesel">

										    <label for="radio2">Diesel</label>

										  </div>

							</div>
 -->
							

							<div class="col-md-4 col-sm-4"></div>

						</div>

						<div class="row text-center term-iso-mt health-pro-a">

			              <div class="col-md-6 col-sm-6">

			                <a  class="smoke-annual" id="backs">Back</a>

			              </div>

			              <div class="col-md-6 col-sm-6">

			                 <button  class="smoke-annual2">Next</button>

			              </div>

			            </div>

					 </form>

					</div>

				</section>



			</main>

			<style type="text/css">

				.datepicker-dropdown {

					    top: 0;

					    left: 0;

					    font-size: 12px;

					}

					.datepicker .datepicker-switch {

					    width: 220px;

					    /* font-size: 23px; */

					}

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

			</style>

@endsection