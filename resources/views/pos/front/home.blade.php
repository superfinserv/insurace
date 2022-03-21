 @extends('pos.layouts.app')
    @section('content')
    <style>
        .text-black{
            color: #000 !important;
        }
    
           .h4-title{
                font-weight: 700;
                font-size: 16px;
           }
           
           .item-desc{
                  margin-bottom: 0px;
                margin-top: 4px;
                font-size: 14px;
           }
       </style>
        <main role="main">
				<section class="becom-agen" >
					<div class="container">
						<div class="row">
							<div class="col-md-8 col-sm-12">
							</div>
							<div class="col-md-4 col-sm-12" data-aos="fade-left">
								<div class="become-tit">
								    <h1>Sell Insurance Online</h1>
									<h2 class="text-white" style="font-size: 34px;"> Anytime Anywhere</h2>
									<div class="row mt-60">
										<div class="col-md-6 col-sm-6 text-right"><a href="{{url('register')}}" style="padding: 15px 25px;" class="btn btn-default btn-lg btn-dfault-amt become-sign-btn">Sign Up</a></div>
										<div class="col-md-6 col-sm-6">
										<?php /*	<a href="#"><img src="{{asset('site_assets/img/icon-google-play.svg')}}"></a> */?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
        <section class="pops-title">
            <div class="container page-heading-h2">
                <p></p>
                 <h2 class="__title" style="font-size:26px;font-weight:500;">What is a POSP ?</h2>
                <div class="row">
                    <div class="col-md-6 col-sm-6" data-aos="fade-right">
                        <p>In 2015, the Insurance Regulatory and Development Authority of India (IRDAI) allowed a new type of insurance intermediary called the “Point Of Sale Person (POSP)”.</p>
                    </div>
                    <div class="col-md-6 col-sm-6" data-aos="fade-left">
                        <p>It refers to an individual who possesses the required qualifications, has undergone training, passed the examination as specified in IRDAI POSP Guidelines and solicits and markets products as specified by the Authority (IRDAI).</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="agent-allow">
           <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 agent-bac">
                       <div class="agent-box-men page-heading-h2">
                         <h2 class="text-link" style="font-size: 18px;">Point of Sales Person (POSP)</h2>
                        <p class="text-center" style="font-size: 15px;">Can sell over the counter simple plain vanilla type of products which are easy to understand and serviced.</p>
                        <h4>“The benefits of such products are“</h4>

                <div class="row text-center" style="margin-top:30px;">
                   <!--  <div class="col-md-1"></div> -->
                        <div class="col-md-4" data-aos="fade-right">
                        <div class="__item">
                            <i class="icon-box icon-box--circled">
                            <img src="{{asset('site_assets/img/posp/agent-3.png')}}">
                            </i>
                        </div>
                         <h5 class="text-center">Simple to understand</h5>
                        </div>
                         <div class="col-md-4" data-aos="fade-up">
                        <div class="__item">
                            <i class="icon-box icon-box--circled">
                            <img src="{{asset('site_assets/img/posp/agent-4.png')}}">
                            </i>
                        </div>
                        <h5 class="text-center">Stated upfront clearly</h5>
                        </div>
                         <div class="col-md-4" data-aos="fade-left">
                        <div class="__item">
                            <i class="icon-box icon-box--circled">
                            <img src="{{asset('site_assets/img/posp/agent-5.png')}}">
                            </i>
                        </div>
                        <h5 class="text-center">Fixed pre-defined</h5>
                        </div>
                      <!--   <div class="col-md-1"></div> -->
                    </div>
                       </div>

                </div>
           

                <div class="col-md-6 col-sm-6 agent-bac">
                   <div class="agent-box-men page-heading-h2">
                     <h2 style="font-size: 18px;">IRDAI has allowed</h2>
                     <p class="text-center" style="font-size: 15px;">Point of sales person can sell and service various categories of insurance products.</p>
                    
                      
                    <h4 class="text-center">“Point of sales person“</h4>
                     <div class="row text-center agent-responm0" style="margin-top:30px;">
                        <div class="col-md-3" data-aos="fade-right">
                        <div class="__item">
                            <i class="icon-box icon-box--circled">
                            <img src="{{asset('site_assets/img/posp/agent-6.png')}}">
                            </i>
                        </div>
                        <h5 class="text-center">Life</h5>
                        </div>
                           <div class="col-md-3" data-aos="fade-down">
                        <div class="__item">
                            <i class="icon-box icon-box--circled">
                           <img src="{{asset('site_assets/img/posp/agent-7.png')}}">
                            </i>
                        </div>
                        <h5 class="text-center">Health</h5>
                        </div>
                           <div class="col-md-3" data-aos="fade-up">
                        <div class="__item">
                            <i class="icon-box icon-box--circled">
                            <img src="{{asset('site_assets/img/posp/agent-1.png')}}">
                            </i>
                        </div>
                        <h5 class="text-center">Motor</h5>
                        </div>
                           <div class="col-md-3" data-aos="fade-left">
                        <div class="__item">
                            <i class="icon-box icon-box--circled" >
                           <img src="{{asset('site_assets/img/posp/agent-2.png')}}">
                            </i>
                        </div>
                        <h5 class="text-center">Accident</h5>
                        </div>
                    </div>
                   </div>
                    
                </div>
            </div>
        </div>
       </section>
       
               
                <section class="section section--light-blue-bg" style="padding-top: 20px;padding-bottom: 20px; background:#FBFBFB; margin-top:40px">
                <div class="container page-heading-h2">
                 <h2 class="text-center alig-20" style="">What you get</h2>
                    
                    <div class="row">
                        <div class="col-12">
                            <!-- start services -->
                            <div class="services services--s1 p-text-clr ">
                                <div class="__inner">
                                    <div class="row">
                                     <!-- start item -->
                                        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-6 " data-aos="fade-right">
                                                <div class="__item" style="box-shadow: 0 0 12px 6px rgb(0 0 0 / 3%);background: #fff;color: #000;padding: 50px;border-radius: 10px;">
                                                    <i class="icon-box icon-box--circled" style="background-color: #f8effa">
                                                        <img src="{{asset('site_assets/img/offer-3.png')}}">
                                                    </i>
                                                    
                                                     <h4 class="text-black mt-2 h4-title" >Online Quote</h4>
                                                     <p class="text-black item-desc">All Kinds of Insurance Policies</p>
                                                </div>
                                        </div>
                                        <!-- end item -->
                                        <!-- start item -->
                                        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-6" data-aos="fade-up">
                                                <div class="__item" style="box-shadow: 0 0 12px 6px rgb(0 0 0 / 3%);background: #fff;color: #000;padding: 50px;border-radius: 10px;">
                                                    <i class="icon-box icon-box--circled" style="background-color: #f8effa">
                                                        <img src="{{asset('site_assets/img/offer-3.png')}}">
                                                    </i>
                                                    
                                                    <h4 class="text-black mt-2 h4-title">Policy Issuance</h4>
                                                     <p class="text-black item-desc">Paper-free  policy issuance.</p>
                                                </div>
                                        </div>
                                        <!-- end item -->
                                        <!-- start item -->
                                        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-6" data-aos="fade-right">
                                                <div class="__item" style="box-shadow: 0 0 12px 6px rgb(0 0 0 / 3%);background: #fff;color: #000;padding: 50px;border-radius: 10px;">
                                                    <i class="icon-box icon-box--circled" style="background-color: #f8effa">
                                                        <img src="{{asset('site_assets/img/offer-3.png')}}">
                                                       
                                                    </i>
                                                     <h4 class="text-black mt-2 h4-title">Manage renewals</h4>
                                                     <p class="text-black item-desc">Manage via app.</p>
                                                <div> <div class="divider-10 d-none d-lg-block"></div></div>
                                        </div>
                                        <!-- end item -->
                                     </div>
                                 </div>
                            </div>
                                            <!-- end services -->

                        </div>
                     </div>
                </div>
                    <?php /*<div class="row" style="margin-top:25px">
                        <div class="col-12">
                            <!-- start services -->
                            <div class="services services--s1 p-text-clr ">
                                <div class="__inner">
                                    <div class="row">
                                     <!-- start item -->
                                        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-6 " data-aos="fade-right">
                                                <div class="__item" style="box-shadow: 0 0 12px 6px rgb(0 0 0 / 3%);background: #fff;color: #000;padding: 50px;border-radius: 10px;">
                                                    <i class="icon-box icon-box--circled" style="background-color: #f8effa">
                                                        <img src="{{asset('site_assets/img/offer-3.png')}}">
                                                    </i>
                                                    
                                                     <h4 class="text-black mt-2 h4-title">Claims via app.</h4>
                                                     <p class="text-black item-desc">Manage via app.</p>
                                                </div>
                                        </div>
                                        <!-- end item -->
                                        <!-- start item -->
                                        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-6" data-aos="fade-up">
                                                <div class="__item" style="box-shadow: 0 0 12px 6px rgb(0 0 0 / 3%);background: #fff;color: #000;padding: 50px;border-radius: 10px;">
                                                    <i class="icon-box icon-box--circled" style="background-color: #f8effa">
                                                        <img src="{{asset('site_assets/img/offer-3.png')}}">
                                                    </i>
                                                    
                                                     <h4 class="text-black mt-2 h4-title">Timely</h4>
                                                     <p class="text-black item-desc">Timely payouts</p>
                                                </div>
                                        </div>
                                        <!-- end item -->
                                        <!-- start item -->
                                        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-6" data-aos="fade-right">
                                                <div class="__item" style="box-shadow: 0 0 12px 6px rgb(0 0 0 / 3%);background: #fff;color: #000;padding: 50px;border-radius: 10px;">
                                                    <i class="icon-box icon-box--circled" style="background-color: #f8effa">
                                                        <img src="{{asset('site_assets/img/offer-3.png')}}">
                                                       
                                                    </i>
                                                     <h4 class="text-black mt-2 h4-title">Training</h4>
                                                     <p class="text-black item-desc">Training for latest products.</p>
                                                <div> <div class="divider-10 d-none d-lg-block"></div></div>
                                        </div>
                                        <!-- end item -->
                                     </div>
                                 </div>
                            </div>
                                            <!-- end services -->

                        </div>
                     </div>
                </div> */?>
            </div>
        </section>
       <section class="agent-person">
           <div class="container page-heading-h2">
            <p></p>
            <h2 class="__title" style="font-size:26px;font-weight:500;">Product solicited and marketed by<br>“Point of sales person”</h2>
            <div class="row">
                <div class="col-md-6 col-sm-6" data-aos="fade-right">
                    <h3 style="color:#C52118">Life insurance</h3>
                    <p>The “point of sales person” can sell life insurance products filed with and approved by the authority, which may be</p>
                    <li>Pure term insurance product with or without return of premium</li>
                    <li>Non-linked (Non-Participating) endowment product</li>
                    <li>Immediate annuity product</li>
                    <li>Any other product / product category, if permitted by the authority.</li>
                    <p>Detailed guidelines with regard to point of sale – life insurance products are issued separately.</p>
                </div>
                <div class="col-md-6 col-sm-6" data-aos="fade-left">
                    <h3 style="color:#C52118">Non - life insurance</h3>
                    <p>The “point of sales person-non life” can sell only the following pre-underwritten products</p>
                    <li>Motor Comprehensive Insurance Package Policy for Two-wheeler, Private Car and Commercial Vehicles.</li>
                    <li>Third party liability (Act only) policy for two-wheeler, private car and commercial vehicles.</li>
                    <li>Indemnity health insurance (Sum Insured upto Rs 5 lacs)</li>
                    <li>Personal accident policy</li>
                    <li>Travel insurance policy</li>
                    <li>Home insurance policy</li>
                    <li>Any other policy specifically approved by the authority</li>
                    <p>Detailed guidelines with regard to point of sale – non life insurance products have been issued separately.</p>
                </div>
            </div>
           </div>
       </section>
       <section class="agent-can">
           <div class="container page-heading-h2">
            <p></p>
            <h2 class="__title" style="font-size:26px;font-weight:500;">Who can become a POSP?</h2>
            <div class="row psg-title">
                <div class="col-md-6 col-sm-6">
                    <p class="agent-title-btn" data-aos="fade-right">MINIMUM 18 YEARS OF AGE (MAJOR)</p>
                    <p></p>
                    <p class="agent-title-btn" data-aos="fade-right">CLEARED 10TH STANDARD.</p>
                </div>
                <div class="col-md-6 col-sm-6">
                    <p class="agent-title-btn" data-aos="fade-left">15 HOURS OF TRAINING FOLLOEWD BY EXAMINATION</p>
                    <p></p>
                    <p class="agent-title-btn" data-aos="fade-left">NO AGENCY WITH ANY INSURER / INTERMEDIARY</p>
                </div>
            </div>
           </div>
       </section>
       
       
          
            
          
       
            <?php /*
			<section id="team" class="pb-5 mt-60" >
                    <div class="container page-heading-h2">
                         <h2 class="__title" style="font-size:26px;font-weight:500;">What posp's Are Saying</h2>
                        <div class="row">
                            <!-- Team member -->
                            <div class="col-xs-12 col-sm-6 col-md-4" data-aos="fade-right">
                                <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                                    <div class="mainflip">
                                        <div class="frontside">
                                            <div class="card">
                                                <div class="card-body text-center">
                                                    <p><img class=" img-fluid" src="{{asset('site_assets/img/posp/review_img/3.jpg')}}" alt="card image"></p>
                                                    <h4 class="card-title">Sunlimetech</h4>
                                                    <p class="card-text">This is basic card with image on top, title, description and button.</p>
                                                    <a href="#" class="btn btn-primary btn-sm become-team-btn"><i class="fa fa-plus"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="backside">
                                            <div class="card">
                                                <div class="card-body text-center mt-4">
                                                    <h4 class="card-title">Sunlimetech</h4>
                                                    <p class="card-text">This is basic card with image on top, title, description and button.This is basic card with image on top, title, description and button.This is basic card with image on top, title, description and button.</p>
                                                    <ul class="list-inline">
                                                       <span class="fa fa-star checked"></span>
                    									<span class="fa fa-star checked"></span>
                    									<span class="fa fa-star checked"></span>
                    									<span class="fa fa-star"></span>
                    									<span class="fa fa-star"></span>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ./Team member -->
                            <!-- Team member -->
                            <div class="col-xs-12 col-sm-6 col-md-4" data-aos="fade-up">
                                <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                                    <div class="mainflip">
                                        <div class="frontside">
                                            <div class="card">
                                                <div class="card-body text-center">
                                                    <p><img class=" img-fluid" src="{{asset('site_assets/img/posp/review_img/1.jpg')}}" alt="card image"></p>
                                                    <h4 class="card-title">Sunlimetech</h4>
                                                    <p class="card-text">This is basic card with image on top, title, description and button.</p>
                                                    <a href="#" class="btn btn-primary btn-sm become-team-btn"><i class="fa fa-plus"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="backside">
                                            <div class="card">
                                                <div class="card-body text-center mt-4">
                                                    <h4 class="card-title">Sunlimetech</h4>
                                                    <p class="card-text">This is basic card with image on top, title, description and button.This is basic card with image on top, title, description and button.This is basic card with image on top, title, description and button.</p>
                                                    <ul class="list-inline">
                                                          <span class="fa fa-star checked"></span>
                    									<span class="fa fa-star checked"></span>
                    									<span class="fa fa-star checked"></span>
                    									<span class="fa fa-star"></span>
                    									<span class="fa fa-star"></span>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ./Team member -->
                            <!-- Team member -->
                            <div class="col-xs-12 col-sm-6 col-md-4" data-aos="fade-left">
                                <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                                    <div class="mainflip">
                                        <div class="frontside">
                                            <div class="card">
                                                <div class="card-body text-center">
                                                  <p><img class=" img-fluid" src="{{asset('site_assets/img/posp/review_img/2.jpg')}}" alt="card image"></p>
                                                    <h4 class="card-title">Sunlimetech</h4>
                                                    <p class="card-text">This is basic card with image on top, title, description and button.</p>
                                                    <a href="#" class="btn btn-primary btn-sm become-team-btn"><i class="fa fa-plus"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="backside">
                                            <div class="card">
                                                <div class="card-body text-center mt-4">
                                                    <h4 class="card-title">Sunlimetech</h4>
                                                    <p class="card-text">This is basic card with image on top, title, description and button.This is basic card with image on top, title, description and button.This is basic card with image on top, title, description and button.</p>
                                                    <ul class="list-inline">
                                                         <span class="fa fa-star checked"></span>
                    									<span class="fa fa-star checked"></span>
                    									<span class="fa fa-star checked"></span>
                    									<span class="fa fa-star"></span>
                    									<span class="fa fa-star"></span>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                            </div>
                            <!-- ./Team member -->

                        </div>
                    </div>
                    </section>
            */?>
            <?php /*
            <section class="becomr-botm">
            	<div class="container">
            		<div class="row">
            			<div class="col-md-3 col-sm-3"></div>
            			<div class="col-md-6 col-sm-6 text-center"data-aos="fade-up">
            				<div class="becom-link">
            					<ul>
            						<p><img class="img-fluid lazy loaded" src="{{get_site_settings('site_logo')}}"  alt="{{get_site_settings('site_name')}}" data-src="{{get_site_settings('site_logo')}}" width="159" height="45"></p>
            						<li><a href="#">Become an Insurance agent</a></li>
            						<li>Download Mobile App</li>
                                    <p></p>
            						<a href="#" ><img src="{{asset('site_assets/img/icon-google-play.svg')}}"></a>

            					</ul>
            				</div>
            				
            			</div>
            			<div class="col-md-3 col-sm-3"></div>
            		</div>
            	</div>
            </section>
            */?>
            <style>
                .term-d-box2:hover {
                    background:#AC0F0B;
                    transition: 0.5s;
                    color: #fff;
                    border-color: #b83a3b;
                }
                .footer--s5 .footer__wave{display: none;}
                .term-d-box2 {
                    border: 1px solid #007bff;
                    padding: 20px 20px;
                    min-height: 167px;
                }
                section.becomr-title .jumbotron .term-d-box2 img {
                    border: 2px solid #fff;
                    padding: 11px;
                    width: 65px;
                    height: 65px;
                    border-radius: 50%;
                }  
</style>
<!-- Team -->
</main>
@endsection