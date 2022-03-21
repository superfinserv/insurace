  @extends($layout)
    @section('content')
    <style>
 
 .input-radio {
	 position: absolute;
	 visibility: hidden;
	 display: none;
}
 label.input-radio-label {
	 color: #9a929e;
	 display: inline-block;
	 cursor: pointer;
	 font-weight: bold;
	 padding: 5px 20px;
	 margin-bottom:0px;
}
 .input-radio:checked + label.input-radio-label {
	color: #fff;
    background: #AC0F0B;
}
/* label.input-radio-label + .input-radio + label.input-radio-label {*/
/*	 border-left: solid 3px #675f6b;*/
/*}*/
 .input-radio-group {
	 border: solid 2px #AC0F0B;
	 display: inline-block;
	 /*margin: 20px;*/
	 border-radius: 10px;
	 overflow: hidden;
}

.ncbTransferElem.display-none{
    display:none;
}
    </style>
<main role="main">

				<section class="invest-long page-heading-h2">
					<div class="container invest-long-bg ">
						<h2 class="text-center" id="headText">Previous Policy Details</h2>
						<!-- <p>Select Years</p> -->
						<form class="form-group"  enctype="multipart/form-data"  id="ncbTransferForm" method="post" >
						    @csrf
						    
						    
						  <div class="row">
						    <div class="col-md-4"></div>
                            <div class="col-md-2">
                                <h6 style="font-size: 15px;text-transform: none;color: black;line-height: 1.8;font-weight: 600;">NCB Transfer?</h6>
                            </div>
                            <div class="col-md-2">
                                <div class="input-radio-group">
                                     <input type="radio" value="Yes" class="input-radio hasNcbTransfer" id="hasNcbTransfer-Yes" name="hasNcbTransfer">
                                     <label for="hasNcbTransfer-Yes" class="input-radio-label ">Yes</label>
                                     <input type="radio"  value="No" class="input-radio hasNcbTransfer" id="hasNcbTransfer-No" name="hasNcbTransfer" checked>
                                     <label for="hasNcbTransfer-No" class="input-radio-label ">No</label>
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                        
                        <div class="row ncbTransferElem display-none" style="margin-top: 25px;">
                            <div class="col-md-2"></div>
                            <div class="col-md-4">
                                <label style="font-weight: 600;">NCB Certificate effective date</label>
                                <input type="text" class="form-control dob-mask" name="ncbCertEfDate" id="ncbCertEfDate" placeholder="NCB Certificate effective date" class="">
                            </div>
                            <div class="col-md-4">
                                <label style="font-weight: 600;">Eligible NCB %</label>
                                <select class="form-control select2" name="ncbPercent" id="ncbPercent">
												<option value="">Eligible NCB %</option>
												<option value="ZERO" selected>0%</option>
												<option value="TWENTY">20%</option>
												<option value="TWENTY_FIVE">25%</option>
												<option value="THIRTY_FIVE">35%</option>
												<option value="FORTY_FIVE">45%</option>
												<option value="FIFTY">50%</option>
												<option value="FIFTY_FIVE">55%</option>
												<option value="SIXTY_FIVE">65%</option>
											</select>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                        
                        <div class="row ncbTransferElem display-none" style="margin-top: 25px;">
                            <div class="col-md-2"></div>
                            <div class="col-md-4">
                                <label style="font-weight: 600;">NCB Certificate Issuer name</label>
                                <select class="br-all invest-month" id="ncbCertIssuer" name="ncbCertIssuer">
        								<option value="">Select Issuer </option>
        							     @foreach($previous_insurer as $pins)
        								 	<option value="{{$pins->id}}">{{$pins->name}}</option>
        							     @endforeach
        							</select>
                            </div>
                            <div class="col-md-4">
                                <label style="font-weight: 600;">Previous Policy Number</label>
                                <input type="text" class="form-control" name="policyNumber" id="policyNumber" placeholder="Policy Number">
                            </div>
                            <div class="col-md-2"></div>
                        </div>
					    
					    <div class="row text-center term-iso-mt health-pro-a">
			              <div class="col-md-6 col-sm-6">
			                <a href="#" id="backtoRegYear" class="smoke-annual">Back</a>
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