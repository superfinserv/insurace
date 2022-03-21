 @extends('web.layout.app')
    @section('content')
<main role="main">
			
				
				
				<section class="section" style="padding-top: 140px;padding-bottom:50px;">
					<div class="container">
						<div class="row flex-md-row-reverse justify-content-sm-center align-items-md-center">
							<div class="col-12 col-md-6">
								<div class="section-heading">
									<h6 style="font-size: 26px; color:#AC0F0B;">About us</h6>

									<h2 class="__title animated slideInRight"></h2>
								</div>

								<div>
									<p class="animated slideInRight" style=" text-align: justify;font-size: smaller;color:#0E3679 ">
									
										{{get_site_settings('site_name')}} is a financial product distribution company that has been started by two seasoned insurance professionals. 
										<br/> What gives the company a distinct competitive edge is the deep knowledge and understanding of the financial products that the promoters have acquired. It believes in giving priority to customer satisfaction and delight. Its youthful energy and the culture of knowledge creation and inquisitiveness set it apart from the other companies in the market. It has the professional knowledge base of a matured company and the zeal of a start-up.</p>

									<!--<p class="mt-9">-->
										
									<!--	<button class="button11 animated slideInRight"><span>More About</span></button>-->
									<!--</p>-->
								</div>
							</div>

							<div class="spacer py-4 d-md-none"></div>

							<div class="col-12 col-md-6  text-center text-md-left" data-aos="flip-right">

								<!-- <figure class="image-container js-tilt animated slideInLeft" data-tilt-speed="600" data-tilt-max="15" data-tilt-perspective="700">
									<img class="img-fluid lazy" width="381" height="424" src="{{asset('img/blank.gif')}}" data-src="{{asset('img/img_1.png')}}" data-srcset="img/img_1.png 1x, img/img_1@2x.png 2x" alt="demo" />
								</figure> -->
								<img src="{{asset('site_assets/img/about.jpeg')}}">

							</div>
						</div>

						<div class="spacer py-9"></div>

						<div class="row">
							<div class="col-12">

								
								<div class="brands-list">
									<div class="__inner">
										<div class="row justify-content-sm-around align-items-center">
											
											
											
												</div>
											</div>
											
											
												</div>
											</div>
											
										</div>
									</div>
								</div>
							

							</div>
						</div>
					</div>
				</section>
				
				
</main>
@endsection