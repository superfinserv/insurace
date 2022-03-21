 @extends($layout)
    @section('content')
    	<style type="text/css">
				#carnumber{ 
				          text-transform: uppercase;font-weight:600;margin-bottom: 0;height: 50px !important;
                         border: 2px solid #cccc;}
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
			           width: 80% !important;
			           padding: 5px 0px;
			           border-radius: 3px;
			           box-shadow: 0 16px 24px 2px rgba(0, 0, 0, .14), 0 6px 30px 5px rgba(0, 0, 0, .12), 0 8px 10px -5px rgba(0, 0, 0, .2);
			             margin-top: 0px !important;
			           border: 0px;
			           color: #fff;
			       }
			       
			       
			</style>
<main role="main">

				<section class="invest-long page-heading-h2">
					<div class="container invest-long-bg">
						<h2>Insure your <span style="color:#C52118;font-weight:600">"Car"</span> Instantly</h2>
						<form class="form-group"  enctype="multipart/form-data"  id="carnumberForm" method="post" autocomplete="off">
						    @csrf
                          @if($uType=='customer')
						<div class="row">
							<div class="col-md-3 col-sm-3"></div>
							<div class="col-md-6 col-sm-6">
							    <!--<div class="input-group">-->
           <!--                           <input type="text" class="form-control" placeholder="Search for...">-->
           <!--                           <span class="input-group-btn">-->
           <!--                             <button class="btn btn-default" type="submit">-->
           <!--                                 <i class="fa fa-arrow-right"></i>-->
           <!--                             </button>-->
           <!--                           </span>-->
           <!--                         </div>-->

								<input type="text" class="form-control vehicleRegNumber text-center" name="carnumber" id="carnumber" placeholder="Enter Car Number (eg.-MH02BX0377)" class="car-nmbr">
								<div id="errors" style="color: red"></div>
								<a href="#" style="width: 50%;display: inline-block;font-weight: 600;" id="hasNewCar" class="car-btn1">Bought a new Car? <span class="car-btn3">Click here</span></a>
								<a href="#" style="width:50%;display: inline-block;float: right;text-align: right;font-weight: 600;" id="withoutCarNo" class="car-btn1" style=""><span class="car-btn3">Proceed without Car Number <i style="font-size: 15px;" class="fa fa-angle-right" aria-hidden="true"></i></span></a>
								<br>
                            </div>
							<div class="col-md-6 col-sm-6"></div>
							
						</div>
						
						@else
						 <div class="row">
    							<div class="col-md-2 col-sm-12"></div>
    							<div class="col-md-4 col-sm-12">
    							    <input type="text" name="mobileNumber" id="mobileNumber" class="form-control" placeholder="Customer Mobile No.">  
    							</div>
    							<div class="col-md-4 col-sm-12">
    								<input class="form-control vehicleRegNumber" type="text" name="carnumber" id="carnumber" placeholder="Enter Car Number (MH02BX0377)" >
    								<div id="errors"></div>
    								<br>
    							</div>
    							<div class="col-md-2 col-sm-12"></div>
    						</div>
    						<div class="row">
    						 <div class="col-md-2 col-sm-12"></div>
    						 	<div class="col-md-8 col-sm-12">
            						<a href="#" style="width:50%;display: inline-block;" id="hasNewcar" class="car-btn1">Bought a new car? <span class="car-btn3">Click here</span></a>
            						<a href="#" style="width: 50%;float: right;text-align: right; display: inline-block;" id="withoutCarNo" class="car-btn1" style=""><span class="car-btn3">Proceed without Car Number <i style="font-size: 15px;" class="fa fa-angle-right" aria-hidden="true"></i></span></a>
    						    </div>
    						 <div class="col-md-2 col-sm-12"></div>
    						</div>	
						@endif
						<div class="row text-center health-pro-a" style="padding: 20px 0 0px;">
			              <div class="col-md-5 col-sm-12"></div>
			              <div class="col-md-2 col-sm-12">
			                <button id="submitBtn" type="submit" style="height: 50px;font-weight: 600;width: 165px !important;">
			                    Continue <i style="font-size: 14px;" class="right fa fa-chevron-right "></i>
			                  </button>
			              </div>
			              <div class="col-md-5 col-sm-12"></div>
			            </div>
			        </form>
					</div>
				</section>

			</main>
		
@endsection