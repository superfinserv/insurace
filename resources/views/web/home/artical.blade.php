 @extends('web.layout.app')
    @section('content')
<main role="main" >
			
				<section class="section section--light-blue-bg">
					<div class="container">
						<div class="section-heading section-heading--center">
							<h6 class="__subtitle">our projects</h6>
						</div>

						<div class="spacer py-6"></div>

						<div class="row">
							<div class="col-12">

								
								<div class="projects projects--s3 projects--s3-b">
									<div class="__inner">
										<ul class="__filter js-isotope-sort text-center">
											<li><a class="selected" data-cat="*" href="#">All</a></li>
											<li><a data-cat="category-1" href="#">Protection</a></li>
											<li><a data-cat="category-2" href="#">Savings</a></li>
											<li><a data-cat="category-3" href="#">Ulip</a></li>
											<li><a data-cat="category-4" href="#">Child Plan</a></li>
											<li><a data-cat="category-4" href="#">Mediclaim</a></li>
											<li><a data-cat="category-4" href="#">Accidental</a></li>
											<li><a data-cat="category-4" href="#">Cancer</a></li>
											<li><a data-cat="category-4" href="#">Critical</a></li>
											<li><a data-cat="category-4" href="#">Car</a></li>
											<li><a data-cat="category-4" href="#">Bike</a></li>
											<li><a data-cat="category-4" href="#">Taxi</a></li>
											<li><a data-cat="category-4" href="#">Travel</a></li>
										</ul>

										<div class="row no-gutters js-isotope"
											data-isotope-options='{
												"itemSelector": ".js-isotope__item",
												"transitionDuration": "0.8s",
												"percentPosition": true,
												"masonry": { "columnWidth": ".js-isotope__sizer" }
											}'>

											<div class="col-12 col-sm-1  js-isotope__sizer"></div>

											<div class="col-12 col-sm-6 col-lg-3  js-isotope__item  category-4">
												<div class="__item" data-x="1" data-y="1">
													<figure class="__image">
														<img class="lazy" width="527" height="549" src="{{asset('img/blank.gif')}}" data-src="{{asset('img/projects_img/s2_4.jpg')}}" alt="demo"/>
													</figure>

													<div class="__content">
														<div>
															<a href="{{asset('img/projects_img/s2_4.jpg')}}" class="__link" data-fancybox="projects--s3-b"></a>

															<div class="__title h3">Term Life </span></div>
														</div>
													</div>
												</div>
											</div>
											
											<div class="col-12 col-sm-6 col-lg-3  js-isotope__item category-2">
												<div class="__item" data-x="1" data-y="1">
													<figure class="__image">
														<img class="lazy" width="567" height="710" src="{{asset('img/blank.gif')}}" data-src="{{asset('img/projects_img/s2_5.jpg')}}" alt="demo"/>
													</figure>

													<div class="__content">
														<div>
															<a href="{{asset('img/projects_img/s2_5.jpg')}}" class="__link" data-fancybox="projects--s3-b"></a>

															<div class="__title h3">Health</div>
														</div>
													</div>
												</div>
											</div>
									
											<div class="col-12 col-sm-6  js-isotope__item  category-1">
												<div class="__item" data-x="1" data-y="1">
													<figure class="__image">
														<img class="lazy" width="834" height="626" src="{{asset('img/blank.gif')}}" data-src="{{asset('img/projects_img/s2_1.jpg')}}" alt="demo"/>
													</figure>

													<div class="__content">
														<div>
															<a href="{{asset('img/projects_img/s2_1.jpg')}}" class="__link" data-fancybox="projects--s3-b"></a>

															<div class="__title h3">Car <br><span>Project</span></div>

															
														</div>
													</div>
												</div>
											</div>
											
											<div class="col-12 col-sm-6  js-isotope__item  category-3">
												<div class="__item" data-x="1" data-y="1">
													<figure class="__image">
														<img class="lazy" width="637" height="580" src="{{asset('img/blank.gif')}}" data-src="{{asset('img/projects_img/s2_3.jpg')}}" alt="demo"/>
													</figure>

													<div class="__content">
														<div>
															<a href="{{asset('img/projects_img/s2_3.jpg')}}" class="__link" data-fancybox="projects--s3-b"></a>

															<div class="__title h3">Travel</div>

															
														</div>
													</div>
												</div>
											</div>
										
											<div class="col-12 col-sm-12 col-lg-6  js-isotope__item  category-2">
												<div class="__item" data-x="2" data-y="1">
													<figure class="__image">
														<img class="lazy" width="692" height="404" src="{{asset('img/blank.gif')}}" data-src="{{asset('img/projects_img/s2_2.jpg')}}" alt="demo"/>
													</figure>

													<div class="__content">
														<div>
															<a href="{{asset('img/projects_img/s2_2.jpg')}}" class="__link" data-fancybox="projects--s3-b"></a>

															<div class="__title h3">Health life</div>

															
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