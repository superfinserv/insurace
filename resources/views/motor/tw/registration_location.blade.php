 @extends($layout)
    @section('content')
<main role="main">

				<section class="invest-long page-heading-h2">
					<div class="container invest-long-bg ">
						<h2 class="text-center">Where is your <span style="color:#C52118;font-weight:600">2W</span> registered?</h2>
						<!-- <p>Select Years</p> -->
						<form class="form-group"  enctype="multipart/form-data"  id="rtocodeForm" method="post" >
                            <input name="_token" type="hidden" value="{{ csrf_token() }}"  />
						<div class="row mt-3">
						<div class="col-md-3 col-sm-3"></div>
						<div class="col-md-6 col-sm-6">
						
							<select class="rto-location" id="rto_code" name="rto_code">
								<option value="">Select registration place </option>
                                  @foreach($rto_master as $rto)
                                   <option value="{{$rto->rtoCode}}">{{$rto->rtoCode}} {{$rto->text}}</option>
                                  @endforeach
							</select>
							<div id="rto_code-error"></div>
						</div>
						<div class="col-md-3 col-sm-3"></div>
						<!--<div class="col-md-3 col-sm-3"></div>-->
						<!--<div class="col-md-6 col-sm-6" style="margin-top: 10px;width: 100%;text-align: left;">-->
						<!--			 <label >I want to</label>-->
								
						<!--			 <div  style="width: 100%;text-align: left;">-->
						<!--					<div class="custom-control custom-radio" style="width: 50%;float: left;">-->
						<!--						  <input type="radio" class="custom-control-input" id="old" name="bikenew" value="0">-->
						<!--						  <label class="custom-control-label" for="old">Renew my policy</label>-->
						<!--					</div>-->
						<!--					<div class="custom-control custom-radio" style="width: 50%;float: left;">-->
						<!--						  <input type="radio" class="custom-control-input" id="new" name="bikenew" value="1">-->
						<!--						  <label class="custom-control-label" for="new">Buy policy for new Bike</label>-->
						<!--					</div>-->
						<!--				</div>-->
						<!--				<div id="bikenew-error"></div>-->
						<!--		</div>-->
						</div>
						<div class="row text-center term-iso-mt health-pro-a">
			              <div class="col-md-6 col-sm-6">
			                <a href="{{url('twowheeler-insurance/registration-number')}}" class="smoke-annual">Back</a>
			              </div>
			              <div class="col-md-6 col-sm-6">
			                <button class="smoke-annual2">Next</button>
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