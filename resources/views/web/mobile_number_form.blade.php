<div class="block animatable bounceInRight">
			<!--card card-sm						-->
			<form class=" form-group" action="#" style="margin: 0;" enctype="multipart/form-data"  id="mobileOtpForm" method="post">
					 <input name="_token" type="hidden" value="{{ csrf_token() }}" /> 
                    <div class="card-body row no-gutters ">
                        <div class="col">
                            <input class="form-control form-control-lg form-control-borderless integer-mobile" style="height: 50px!important;font-size: 15px !important;font-weight: bold;" 
                                   type="number" placeholder="Mobile Number..." 
                                   name="mobile" id="mobile" autocomplete="off">
                        </div>
                     <input type="hidden" name="insurance_type" id="insurance_type" value="{{ collect(request()->segments())->last() }}">
                        <div class="col-auto">
                           <button style="padding: 11PX;"  class="btn btn-lg btn-success btn-mobile-no-submit" type="button">Find Plans</button>

                        </div>
                    <br> 
                    </div>
                </form>
			</div>
			<div class="form-check" id="effect">
            <input type="checkbox" class="form-check-input" id="agreeConsent" checked>
            <label style="margin-left: 18px;font-size: 13px;" class="form-check-label" for="agreeConsent">By providing Mobile number, I hereby give my consent to contact me on my above mobile number for my insurance needs.</label>