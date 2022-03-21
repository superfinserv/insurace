 @extends($layout)
    @section('content')
<main role="main">
				
				
				<section class="">
					<div class="container">
						<div class="row">
							
						</div>
					</div>
				</section>
				<section class="term-smoke ptb">
					<div class="container smoke-bg">
					    <h1> We have found 13 plans for you starting at ₹ 3,554/year </h1>
                            <form class="card card-sm form-group" style="margin: 0;padding: 54px;" enctype="multipart/form-data"  id="usersDetails" method="post">
                                   <input name="_token" type="hidden" value="{{ csrf_token() }}" />
					                       <div class="row">
						                        <div class="col-md-6 col-sm-6">
                                                 <div class="form-group">
                                                     <label for="name">Full Name</label>
                                                     <input type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Full Name" name="name">
                                                   </div>
                                          <div class="row">
                                             <div class="col-md-6 col-sm-6">   
						                                    <div class="form-group">
                                                     <label for="city">State</label>
                                                      <select class="invest-month form-control" id="state_id" name="state_id">
                                                        <option value="">Select State</option>
                                                        <?php foreach ($states as $value) {?>
                                                              <option value="{{$value->id}}" ><?php echo ucfirst($value->name);?></option>
                                                        <?php } ?>
                                                        
                                                 </select>
                                                   </div>
                                             </div> 
                                             <div class="col-md-6 col-sm-6">   
                                                  <div class="form-group">
                                                     <label for="city">City</label>
                                                      <select class="invest-month form-control" id="city" name="city">
                                                        <option value="">Select City</option>
                                                       
                                                        
                                                 </select>
                                                   </div>
                                             </div> 
                                             </div>          		
                           
  						</div>
  						<div class="col-md-6 col-sm-6">	
  							<div class="form-group">
                                                        <label for="age">Your Age</label><br>
                                                        <select class="invest-month form-control" name="age" id="age">
                                                        	<option value="">Select Age</option>
                                                               <option value="-1">Less than 1</option>
                                                        	<?php for ($i =1; $i <= 50; $i++) {  ?> 
                                                                <option value="<?php echo $i;?>" ><?php echo $i;?> Year</option>
                                                               <?php } ?>
                                                        </select>
                                                 </div>
                                                 <div class="form-group alig-20">
                                                        <label for="pincode">Pin Code</label><br>
                                                        <input class="form-control integer-mobile" type="number" id="pincode" name="pincode" placeholder="Pin Code" onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));" autocomplete="off">
                                                 </div>
							
						</div>
							
					</div>
  				<!-- 	<div class="row text-center" style="padding: 40px 0px">
  							<div class="col-md-6 col-sm-6">
  								<a href="" class="smoke-annual">Back</a>
  							</div>
  							<div class="col-md-6 col-sm-6">
  								<button type="submit" class="smoke-annual2 ">Done</button>
  							</div>
					                           </div> -->
                            </form>
              <div class="row text-center term-iso-mt">
              <div class="col-md-6 col-sm-6">
                <a href="{{url('bike-insurance/registration-detail')}}" class="smoke-annual">Back</a>
              </div>
              <div class="col-md-6 col-sm-6">
                <a  href="#" class="smoke-annual2 smoke">Done</a>
              </div>
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
</style>
@endsection