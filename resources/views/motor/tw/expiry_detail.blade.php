  @extends($layout)
    @section('content')
       <main role="main">
        <section class="invest-long page-heading-h2">
			<div class="container invest-long-bg text-center">
                <h2> Just one more step to view quotes </h2>
                 	<!-- <p>Select Years</p> -->
					<form class="form-group"  enctype="multipart/form-data"  id="registrationdetailsForm" method="post" >
                        <input name="_token" type="hidden" value="{{ csrf_token() }}"  />
						<div class="row mt-3">
						   <div class="col-md-1 col-sm-1"></div>
						   <div class="col-md-4 col-sm-4">
						 <!--    <h2> Your <span style="color:#C52118;font-weight:600" >2W</span></h2>-->
							<!--<p></p>-->
							<!--<img src="{{asset('site_assets/img/icon/bike.png')}}" width="200px">-->
							<!--<br/>-->
							<!--<h3 id="heading" style="margin-top: 14px;"><span style="font-weight: 700;font-size: 15px;letter-spacing:0.1" id="bike-info"></span></h3>-->
							<!--<p id="details"> </p>-->
							
							
							<div class="vehicleInfoDetails-element text-center">
        						     <h2> Your <span style="color:#C52118;font-weight:600" >2W</span></h2>
        							<p></p>
        							<img src="{{asset('site_assets/img/icon/bike.png')}}" width="200px" style="text-center">
        							<br/>
						    	</div>
							    <div id="ext-v-info" class=" text-center">
							      	<h3 id="heading" style=" margin-top: 14px;margin-bottom: 0px;"><span style="font-family: Nunito,sans-serif !important;font-weight: 700;font-size: 11px;letter-spacing: 0.5px;text-transform: revert;" id="bike-info"></span></h3>
        							<p id="othr-info" style="margin-top: 0px;margin-top: 0px;font-size: 12px;font-weight: 500;font-family: Nunito,sans-serif !important;">
        							    <span></span>
        							 </p>
        							 <p >
        							     <a href="#" id="link-change-v-info" style="text-align: center;color: #C52118 !important;font-size: 13px;font-family: Nunito,sans-serif !important;">Not your 2w?</a>
        							 </p>   
							    </div>
							    <div id="change-v-info" style="display:none;">
							        <div class="row ">
							        	<div class="col-md-12 col-sm-12">
        							        <select class="select2" id="vMake" style="width:100%">
        							            <option value="">Choose Make</option>
        							            
        							            @foreach($makeList as $mk)
        							               <option value="{{$mk->id}}-{{$mk->make}}">{{$mk->make}}</option>
        							            @endforeach
        							        </select>
        							     </div>
        							     
        							     <div class="col-md-12 col-sm-12" style="margin-top:12px;">
        							        <select class="select2"  id="vModel" style="width:100%">
        							            <option value="">Choose Model</option>
        							        </select>
        							     </div>
        							     
        							     <div class="col-md-12 col-sm-12" style="margin-top:12px;">
        							        <select class="select2"  id="vVar" style="width:100%">
        							            <option value="">Choose Varint</option>
        							        </select>
        							     </div>
        							     
        							 </div>
							        <div class="row text-center term-iso-mt health-pro-a">

        			              <div class="col-md-6 col-sm-6">
        			                <a href="#" id="updateVinfo" style="width: 50% !important;" class="smoke-annual">Update</a>
        			              </div>
        
        			              <div class="col-md-6 col-sm-6">
        			                <button  class="smoke-annual2" id="cancelChngVinfo"  style="width: 50% !important;" >Cancel</button>
        			              </div>
        
        			         </div>
							         
							    </div>
						</div>
						<div class="col-md-5 col-sm-5">
							<h3 class="mt-3" style="letter-spacing: 1px;">Tell us if your previous policy has expired:</h3>
							<div class="row ">
								<div class="col-md-6 col-sm-6">
									<div class="inputGroup br-all alig-20">
									<input id="isExp" name="previousInsurerInfo" class="invest-selector " type="radio" data-rowid="row-year" data-text="per year" value="Expired">
									<label for="isExp" class="f-12">Expired</label>
								</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="inputGroup br-all alig-20">
    									<input checked id="isNotExp" name="previousInsurerInfo" class="invest-selector " type="radio" data-rowid="row-lumpsum" data-text="lumpsum" value="Not Expired">
    									<label for="isNotExp" class="f-12">Not Expired</label>
    								</div>
								</div>
								<div class="col-md-12 col-sm-12" id="errors" class="error"></div>
		
								<div class="col-md-12 col-sm-12 bike_policy_details__expitem" style="display: none;margin-top:25px;width: 100%;text-align: left;">
									<div class="w--radio ">
										<div class="w--radio__label">When did it expire?</div>
										<div class="w--radio__options">
												<div class="custom-control custom-radio" style="width: 100%;margin-bottom: 10px;">
												  <input data-date="<?=$exp['more_than_90'];?>" type="radio" class="custom-control-input exp-radio" id="defaultChecked" name="expire_date" value="+90">
												  <label class="custom-control-label" for="defaultChecked">Expired, more than 90 days ago</label>
											</div>
											<div class="custom-control custom-radio " style="width: 100%;margin-bottom: 10px;">
											      <input data-date="<?=$exp['btwn_45_to_90'];?>" type="radio" class="custom-control-input" id="defaultChecked1" name="expire_date" value="45-90">
												  <label class="custom-control-label" for="defaultChecked1">Expired, between 45 to 90 days ago</label>
											</div>
											<div class="custom-control custom-radio " style="width: 100%;margin-bottom: 10px;">
											      <input data-date="<?=$exp['less_than_45'];?>" type="radio" class="custom-control-input" id="defaultChecked2" name="expire_date" value="-45">
												  <label class="custom-control-label" for="defaultChecked2">Expired, less than 45 days ago</label>
											</div>
											
											<div class="custom-control custom-radio" style="width: 100%;">
											   	  <input data-date="<<?=$exp['note_sure'];?>" type="radio" class="custom-control-input exp-radio" id="defaultChecked4" name="expire_date" value="0">
												  <label class="custom-control-label" for="defaultChecked4">I'm not sure when it expired</label>
											</div>
											
										</div>
									</div>
								</div>
								<div class="col-md-12 col-sm-12" id="errorss" class="error"></div>
								
								<div class="col-md-12 col-sm-12 pre-insurance-data" style="margin-top:25px;width: 100%;text-align: left;">
									 <label >Previous policy type</label>
								
									 <div  style="width: 100%;text-align: left;">
											<div class="custom-control custom-radio" style="width: 50%;float: left;">
												  <input type="radio" class="custom-control-input" id="comprehensive" name="previous_policy_type" value="COM" checked>
												  <label class="custom-control-label" for="comprehensive" >Comprehensive</label>
											</div>
											<div class="custom-control custom-radio" style="width: 50%;float: left;">
												  <input type="radio" class="custom-control-input" id="third_party" name="previous_policy_type" value="TP">
												  <label class="custom-control-label" for="third_party">Third Party</label>
											</div>
										</div>
								</div>
								<div class="col-md-12 col-sm-12" id="errors2" class="error"></div>
								<div class="col-md-12 col-sm-12 pre-insurance-data on-tp-hide" style="margin-top:25px;width: 100%;text-align: left;">
									 <label >Made any claims in previous year?</label>
									 <div  style="width: 100%;text-align: left;">

											<div class="custom-control custom-radio" style="width: 50%;float: left;">
												  <input type="radio" class="custom-control-input" id="claims_no" name="hasPreClaim" value="no" checked>
												  <label class="custom-control-label" for="claims_no">No</label>
											</div>
											<div class="custom-control custom-radio" style="width: 50%;float: left;">
												  <input type="radio" class="custom-control-input" id="claims_yes" name="hasPreClaim" value="yes">
												  <label class="custom-control-label" for="claims_yes">Yes</label>
											</div>
										</div>
								</div>
								<div class="col-md-12 col-sm-12 pre-insurance-data on-tp-hide" style="margin-top:25px;width: 100%;text-align: left;" >
									 <div  style="">

											<select class="form-control select2" name="claimNcb" id="claimNcb">
												<option value="">Select NCB on previous policy</option>
												<option value="ZERO" selected>0%</option>
												<option value="TWENTY">20%</option>
												<option value="TWENTY_FIVE">25%</option>
												<option value="THIRTY_FIVE">35%</option>
												<option value="FORTY_FIVE">45%</option>
												<option value="FIFTY">50%</option>
											</select>
											
										</div>
								</div>
								<div class="col-md-12 col-sm-12" id="errors4" class="error"></div>
								
								<input type="hidden" class="custom-control-input" id="product_code" name="product_code" value="20201">
							</div>

						</div>

						<div class="col-md-2 col-sm-2"></div>

						</div>

						<div class="row text-center term-iso-mt health-pro-a">

			              <div class="col-md-6 col-sm-6">

			                <a href="{{url('twowheeler-insurance/registration-year/')}}" class="smoke-annual">Back</a>

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
.bike_policy_details__expitem{
    background: #eaeef1;
    padding: 10px 20px;
    margin: 0 auto;
    border-radius: 5px;
    box-shadow: 0px 2px 2px 0px #b9b9b9;
}
.bike_policy_details__expitem:after {
    bottom: 100%;
    left: 11%;
    border: solid transparent;
    content: " ";
    height: 0;
    width: 0;
    position: absolute;
    pointer-events: none;
    border-color: rgba(136, 183, 213, 0);
    border-bottom-color: #eaeef0;
    border-width: 8px;
    margin-left: -8px;
}
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
			      .error {
					    text-align: left !important;
					    color: red !important;
					    font-size: 13px;
					    float: left;
					}
					div#errors {
					    text-align: left !important;
					    color: red !important;
					    font-size: 13px;
					    float: left;
					}
			</style>

@endsection