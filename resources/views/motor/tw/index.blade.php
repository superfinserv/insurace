 @extends('web.layout.app')
    @section('content')
      <style>
        .shake-text {
  /* Start the shake animation and make the animation last for 0.5 seconds */
  animation: shake 0.5s;

  /* When the animation is finished, start again */
  animation-iteration-count: infinite;
}

@keyframes shake {
  0% { transform: translate(1px, 1px) rotate(0deg); }
  10% { transform: translate(-1px, -2px) rotate(-1deg); }
  20% { transform: translate(-3px, 0px) rotate(1deg); }
  30% { transform: translate(3px, 2px) rotate(0deg); }
  40% { transform: translate(1px, -1px) rotate(1deg); }
  50% { transform: translate(-1px, 2px) rotate(-1deg); }
  60% { transform: translate(-3px, 1px) rotate(0deg); }
  70% { transform: translate(3px, 1px) rotate(-1deg); }
  80% { transform: translate(-1px, -1px) rotate(1deg); }
  90% { transform: translate(1px, 2px) rotate(0deg); }
  100% { transform: translate(1px, -2px) rotate(-1deg); }
}
@media only screen and (max-width: 600px) {
    .term-baner-animation{
    max-height: 600px;
   }
}
    </style>
<main role="main">
				
				<section class="term-baner-animation">
					<div class="containe">
						<div class="row ptb">
							<div class="col-md-3 col-sm-3">
								  <div class="wrapper">
								  	<div class="animatable bounceInLeft">
								  		<div class="bike-banner-animat">
								  			<img src="{{asset('site_assets/img/icon/bike.png')}}" width="200" style="margin-top:16px;">
								  		</div>
								  	</div>
								  	  </div>
							</div>
							<div class="col-md-6 col-sm-6 bulet-bike top-br respon-30 page-heading-h2">
							    <h2 class="text-center">Get Your <span style="color:#C52118;font-weight:600">"2 wheeler"</span><br/> The Protection it deserves</h2>
									 @include('web.mobile_number_form')
							</div>
							<div class="col-md-3 col-sm-3">&nbsp;
							</div>
						</div>
					</div>
				</section>
				<section class="view-btn ptb">
					<div class="container">
						<div class="row text-center">
							<a href="{{url('twowheeler-insurance-detail')}}" class="view-btn">VIEW DETAIL</a>
						</div>
					</div>
				</section>
				

			</main>
			<style type="text/css">
            	.btn.btn-lg.btn-success {
                margin-top: 0;
                background: #db3f3c;
                font-size: 18px;
                border-color: #db3f3c !important;
                color: #fff !important;
                /* right: 6px; */
                left: -6px;
                margin-left: -3px;
            }
</style>
@endsection