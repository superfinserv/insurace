 @extends('web.layout.app')
    @section('content')
    
    
            <main role="main">
            	<section class="becom-agen">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-8 col-sm-8"></div>
							<div class="col-md-4 col-sm-4">
								<div class="claim">
									<h2 class="text-center text-white">Claims Assistance</h2>
									<form class="claim-title" id="formClaimAssistance" method="post">
									    @csrf
										
										<div class="row">
											<div class="form-group col-md-6">
											<label class="text-white">What is the Claim For?</label>
								        	<select class="invest-month form-control select2-hidden-accessible" id="insuranceType" name="insuranceType" data-select2-id="city" tabindex="-1" aria-hidden="true">
        										 <option value="">Select Your Insurance Type</option>
        										<?php foreach($categories as $cat){?>
        										 <option value="{{$cat->name}}">{{$cat->name}} Insurance</option>
        										<?php } ?>
										    </select>
										</div>
										  
										 <div class="form-group col-md-6">
    						                 <label for="Pin code" class="text-white">Policy Number</label>
    						                 <input type="text" class="form-control integer-mobile" id="PolicyNumber" name="PolicyNumber" placeholder="Policy Number">
						                </div>
										 <div class="form-group col-md-6">
						                 <label for="Pin code" class="text-white">Your Name</label>
						                 <input type="text" class="form-control" id="name" name="name" aria-describedby="Your Name" placeholder="Enter your name">
						                </div>
						                <div class="form-group col-md-6">
						                 <label for="Pin code" class="
						                 text-white">Registered Mobile Number</label>
						                 <input type="text" class="form-control integer-mobile" id="MobileNumber" name="MobileNumber" placeholder="Mobile no. used while purchase">
						                </div>
						                <div class="form-group col-md-12">
						                 <label for="Pin code" class="
						                 text-white">Your Email id</label>
						                 <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email id">
						                </div>



										</div>
    									<div class="row"></div>
						               
						                 <div class="form-group">
										    <label for="exampleFormControlTextarea1" class="text-white">Tell us a little about what happened?</label>
										   <textarea id="textarea-small" style="height: 80px !important;" id="comment" name="comment" placeholder="Elaborate your situation..." rows="1" wrap="soft" class="form-control form-control-sm"></textarea>
										  </div>
                                          <button type="submit" class="btn btn-default btn-lg btn-dfault-amt become-sign-btn">Request Claim Assistance</button>
                                          <p class="text-white"><small>{{config('custom.site_short_name')}} is acting only as a facilitator and claims settlement shall be at the sole discretion of the Insurer.</small></p>
									</form>
								</div>
							</div>
						</div>
					</div>
				</section>
				
			</main>
	
    
    <style>
    	.men-claim{margin-top:50px;}
    	.smoke-annual{cursor: pointer;}
    	.claim{
    	 background:#194581;border-radius:10px;
    	}
    	.claim-title{
    	padding-top:10px;
    	padding-bottom:10px;
        padding:20px;
        padding-top: 0;
        }
        .claim h2 {
        letter-spacing: 0px;
        background: #AC0F0B;
        padding-top: 12px !important;
        margin-bottom: 27px;
        padding-bottom: 12px;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        }
        .become-tit h2 {
    margin-top: 30px;
    letter-spacing: 0px;
}
        .claim-box1 a i {
        font-size: 22px;
        margin-top:20px;
        }
        .claim-box1 a {
    color: #fff !important;
    text-decoration: none;
}
        .claim-box1 {
    border: 1px solid #fff;
    border-radius:50%;
    height: 90px;
    width: 90px;
}
.claim-box1:hover{background:#194581;
border-color: #194581;
}
section.claim-text h1 {
    text-align: center;
    margin: 0 auto;
    margin-top: 30px;
    color: #4169e1;
}
section.claim-text p {
    font-size: 23px;

    margin-bottom:40px;
}

form textarea {
     resize: inherit;
     min-height:inherit; 
     height: 100%; 
}
    </style>
    
    
    
    
    
    
    
    
    
    @endsection