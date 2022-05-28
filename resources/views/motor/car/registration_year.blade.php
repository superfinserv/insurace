 @extends($layout)
    @section('content')
    <style>
 .wrapper-policy-type{
  /*display: inline-flex;*/
  /*background: #fff;*/
  /*height: 100px;*/
  /*width: 400px;*/
  /*align-items: center;*/
  /*justify-content: space-evenly;*/
  /*border-radius: 5px;*/
  /*padding: 20px 15px;*/
  /*box-shadow: 5px 5px 30px rgba(0,0,0,0.2);*/
}
.wrapper-policy-type .option{
  background: #fff;
  height: 100%;
  /*width: 100%;*/
  display: flex;
  align-items: center;
  justify-content: space-evenly;
  margin: 10px 10px;
  border-radius: 5px;
  cursor: pointer;
  padding: 0 10px;
  border: 2px solid lightgrey;
  transition: all 0.3s ease;
}
.wrapper-policy-type .option .dot{
  height: 20px;
  width: 20px;
  background: #d9d9d9;
  border-radius: 50%;
  position: relative;
}
.wrapper-policy-type .option .dot::before{
  position: absolute;
  content: "";
  top: 4px;
  left: 4px;
  width: 12px;
  height: 12px;
  background: #AC0F0B;
  border-radius: 50%;
  opacity: 0;
  transform: scale(1.5);
  transition: all 0.3s ease;
}
.wrapper-policy-type input[type="radio"]{
  display: none;
}
.wrapper-policy-type #option-1:checked:checked ~ .option-1,
.wrapper-policy-type #option-2:checked:checked ~ .option-2{
  border-color: #AC0F0B;
  background: #AC0F0B;
}
.wrapper-policy-type #option-1:checked:checked ~ .option-1 .dot,
.wrapper-policy-type .wrapper-policy-type #option-2:checked:checked ~ .option-2 .dot{
  background: #fff;
}
.wrapper-policy-type #option-1:checked:checked ~ .option-1 .dot::before,
.wrapper-policy-type #option-2:checked:checked ~ .option-2 .dot::before{
  opacity: 1;
  transform: scale(1);
}
.wrapper-policy-type  .option span{
  font-size: 17px;
  color: #808080;
}
.wrapper-policy-type #option-1:checked:checked ~ .option-1 span,
.wrapper-policy-type #option-2:checked:checked ~ .option-2 span{
  color: #fff;
}
    </style>
<main role="main">

				<section class="invest-long page-heading-h2">
					<div class="container invest-long-bg ">
						<h2 class="text-center" id="headText">Which year was it registered? </h2>
						<!-- <p>Select Years</p> -->
						<form class="form-group"  enctype="multipart/form-data"  id="regYearForm" method="post" >
                            <input name="_token" type="hidden" value="{{ csrf_token() }}"  />
                              <div class="row mt-3 wrapper-policy-type">
        
    						    <div class="col-lg-4 col-xl-4 col-md-3 col-sm-12 col-12 "></div>
    						    <div class="col-lg-4 col-xl-2 col-md-3 col-sm-6 col-6">
    						        <input type="radio" value="IND"  name="policyHolderType" id="option-1" checked>
                                       <label for="option-1" class="option option-1">
                                         <div class="dot"></div>
                                          <span>Individual</span>
                                        </label>
                                
    						    </div>
        						<div class="col-lg-4 col-xl-2 col-md-3 col-sm-6 col-6">
        						      <input type="radio" value="COR" name="policyHolderType" id="option-2">
                                        <label for="option-2" class="option option-2">
                                         <div class="dot"></div>
                                          <span>Corporate</span>
                                       </label>
        						       
        							
        						</div>
        					
        						<div class="col-lg-4 col-xl-4 col-md-3 col-sm-12 col-12"></div>
						     </div>
						     <div class="row mt-5" >
						         <div class="col-md-4 col-sm-4"></div>
        						 <div class="col-md-4 col-sm-4">
        						     <input type="text" placeholder="Enter pincode" value="" name="pincode" id="pincode" class="form-control">
        						     <div id="pincode-errors"></div>
        						 </div>
        						 <div class="col-md-4 col-sm-4"></div>
						     </div>
        					 <div class="row mt-5 reg-dmy-elem" >
        						<div class="col-md-3 col-sm-3"></div>
        						<div class="col-md-3 col-sm-3">
        							<select class="car-registen-year br-all invest-month" id="regYear" name="regYear">
        								<option value="">Select year </option>
        								<?php $curYear = date('Y');  for ($i=$curYear; $i > $curYear-25; $i--) { ?>
        									
        								<option value="<?php echo $i;?>"><?php echo $i;?> </option>
        								<?php }
        								?>
        							</select>
        							<div id="regYear-errors"></div>
        						</div>
        						<div class="col-md-3 col-sm-3">
        							<select class="car-registen-month br-all invest-month" id="regMonth" name="regMonth">
        								<option value="">Select Month </option>
        								
        							</select>
        							<div id="regMonth-errors"></div>
        						</div>
        						<div class="col-md-3 col-sm-3"></div>
						</div>
					     	<div class="row mt-3">
                              <div class="col-lg-4 col-xl-3 col-md-3 col-sm-12"></div>
    			              <div class="col-lg-4 col-xl-3 col-md-3 col-sm-6 mb-4">
            			         <a href="#" id="backmodelYear" class="btnSF btn-blue">Back</a>
            			      </div>
    			              <div class="col-lg-4 col-xl-3 col-md-3 col-sm-6">
    			                <button type="submit"  class="btnSF btn-blue" style="margin-top:0px;">Next</button>
    			              </div>
            			       <div class="col-lg-4 col-xl-3 col-md-3 col-sm-12"></div>
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
					
			</style>
@endsection