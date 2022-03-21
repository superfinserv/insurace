  @extends($layout)
    @section('content')
    <style>
        	.brand-section  .brands{
				    padding: 20px;
				    border:1px solid #ccc;
				}
				.select2-container--default .select2-selection--single .select2-selection__rendered {
			           color: #AC0F0B;
			       }
			       .select2-container--default .select2-selection--single {
                        background-color: #fff;
                        border: 1px solid #AC0F0B;
			       }
    </style>
     <main role="main">
         <section class="invest-long page-heading-h2">
            <div class="container invest-long-bg text-center">
                 <h2> Get policy in 5 minutes.</h2>
                     <p>Select Your vehicle's brand</p>
							<div class="row mt-3 text-center">
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <select class="select2 select-choose-make" style="width:100%">
                                        <option value="">Choose Make</option>
                                        @foreach($brands as $_value)
                                         <option value="{{$_value->id}}">{{trim(ucwords(strtolower($_value->make)))}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4"></div>
                            </div>

						   <div class="row text-center">

							<div class="col-md-1 col-sm-1"></div>

							<div class="col-md-10 col-sm-10">

								 <div class="kpx_login text-center" style="margin-top: 25px;">
								     <p class="text-center" style="margin-bottom: 8px;color: #0E3679;">Top Brands</p>
                                    <div class="row brand-section">
                                         
								 	
								 		<?php foreach ($brands10 as $value) { 
						 		$img = ($value->image!='')?asset('assets/vehicles/tw/'.$value->image):asset('site_assets/logo/small-icon-logo.png');?>
						 			<div class="col-4 col-md-2 col-sm-4 hvrani animate animated slideInRight brands" data-animation="fadeInDown" data-delay="100" data-name="{{$value->make}}" data-id="{{$value->id}}">
								     		<img src="{{$img}}" style="width:100%" />
								 		
								 	</div>
						 		<?php } ?>

								 	

							          

							    </div>

							    

								</div>

								<div id="errors" style="color: red"></div>

							    </div>



							<div class="col-md-1 col-sm-1"></div>



							

						</div>

		         	       <div class="row text-center term-iso-mt health-pro-a">

              <div class="col-md-6 col-sm-6">

                <a  class="smoke-annual backto">Back</a>

              </div>

              <div class="col-md-6 col-sm-6">

                <a href="#" class="smoke-annual2 next">Next</a>

              </div>

            </div>

			</div>
		</section>
    </main>

			<style type="text/css">

				.col-md-2.col-sm-2.hvrani.animate.animated.slideInRight {

				    padding: 20px;

				}

				.col-md-2.col-sm-2.hvrani.animate.animated.slideInRight.brands.active {

				    box-shadow: 2px 3px 9px 5px #ccc;

				    transition: 0.5s;

				}

				button{

                  		background: #30435e;

			           /* float: right; */

			           width: 46% !important;

			           padding: 5px 0px;

			           border-radius: 3px;

			           box-shadow: 0 16px 24px 2px rgba(0, 0, 0, .14), 0 6px 30px 5px rgba(0, 0, 0, .12), 0 8px 10px -5px rgba(0, 0, 0, .2);

			             margin-top: 0px !important;

			           border: 0px;

			           color: #fff;

			       }

			</style>

@endsection