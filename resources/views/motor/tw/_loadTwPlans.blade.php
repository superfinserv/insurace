<div class="thumbnail">
	<div class="row">
		<div class="col-xs-12 col-md-4">
		    <img class="group list-group-image" src="{{asset('img/plan_image/digit.jpg')}}" alt="">
		</div>
		<div class="col-xs-12 col-md-5">
			<p>IDV : <span class="fa fa-inr"></span>
			    <?php  $vehicleIDV=number_format(intval(str_replace('INR', '', "INR 30000"))); echo $vehicleIDV;?>
			  </p>
			 <p><a data-id="godigit" id="plan_details_page">Plan Details </a><a></a></p>
		</div>
		<div class="col-xs-12 col-md-3">
			<p><a><del>
			    <span class="fa fa-inr"></span> 
			    <?php $grossPremium=number_format(intval(str_replace('INR', '', "INR 1200"))); echo $grossPremium;?>
			</del></a></p>
			<a class="smoke-annual2 recalculate">
			    <span class="fa fa-inr"></span>
			    <?php $netPremium=number_format(intval(str_replace('INR', '', "INR 1100"))); echo $netPremium;?>
			    <span class="fa fa-arrow-right pull-right"></span>
			</a>
		</div>
        <div class="col-xs-12 col-md-2">
         	<h3>Add Ons:</h3>
        </div>
		<div class="col-xs-12 col-md-8" style="text-align: left">
		    <?php  echo "None";?>
		</div>
	</div>
</div>