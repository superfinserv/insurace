 @extends('web.layout.app')
    @section('content')
   
    <div id="start-screen" class="start-screen start-screen--full-height start-screen--style-1" >
                <div class="start-screen__bg-container">
                    
                    <div class="start-screen__bg" style="background-position: center bottom;"></div>
                </div>

                <div class="start-screen__content-container home-title-top-men">
                    
                    <div class="start-screen__content__item align-items-center"  style="background: url({{asset('/site_assets/img/167.webp')}});background-repeat: no-repeat;color: #fff;background-size: 100% 100%;">
                        <div class="container">
                            
                            <div class="row">
                                <div class="col-12 col-md-7 col-lg-7 col rdn txtclr">
                                    
                                  

                                    <div class="spacer py-2 py-sm-4"></div>

                                    
                                </div>
                                <div class="col-md-5 col-lg-5 col">
                                    @include('web.home.homeRightProducts')
                                     <h2 class="animated slideInLeft" style="font-size: 30px;"><span style="color: #fff;font-weight: 600;letter-spacing: 1px;font-size: 25px;">Your Trusted Insurance Partner</span></h2>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
   
            <!-- end start screen -->

            <!-- start main -->
            <main role="main">
               
                <!-- start section -->
                <section id="services" class="section" style="padding-top: 30px;" >
                    <div class="container">
                        <div class="section-heading section-heading--center wow fadeInRight">
                            <img src="{{asset('/site_assets/logo/irda-logo.png')}}" style="width: 25%;">
                            <h2 class="__title" style="font-size:26px;color:#003585;">LICENSED BY IRDAI</span></h2>

                        </div>
                        <div class="row">
                            <div class="col-12">
                                <!-- start services -->
                                <div class="services services--s6">
                                    <div class="__inner">
                                        <div class="row">
                                            <!-- start item -->
                                            <div class=" col-md-12  text-center">
                                               
                                               <h4 class="__subtitle" style=" color:#003585 !important;  font-size:20px; margin-top:10px;"><b>IRDAI Registration No. {{get_site_settings('irda_reg_no')}}</b></h4>
                                                
                                            </div>
                                            <div class=" col-md-12 text-center">
                                                

                                                <div class="section-heading section-heading--white section-heading--left fclr">
                                                    

                                                    <h2 class="__title" style="font-size: 25px;margin-top:10px; color:#003585 !important;font-size:20px;text-align:center; ">CIN: {{get_site_settings('corporate_identity_no')}}</b></h2>

                                                
                                                    
                                                </div>
                                                
                                               
                                            </div>
                                           
                                            <!-- end item -->
                                    </div>
                                </div>
                                <!-- end services -->

                            </div>
                        </div>
                    </div>
                 </div>
                </section>
                <!-- end section -->
                
                <!-- start section -->
                <section class="section section--light-blue-bg" style="padding-top:70px;padding-bottom: 20px; /*background:#4169e1;*/background-color: #FBFBFB;">
                <div class="container">
                    
                    
                    <div class="row">
                        <div class="col-12">
                            <!-- start services -->
                            <div class="services services--s1 p-text-clr">
                                <div class="">
                                    <div class="row">
                                     <!-- start item -->
                                        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-6" class="item" data-aos="fade-right">
                                                <div class="__item" style="box-shadow: 0 0 12px 6px rgb(0 0 0 / 3%);background: #fff;color: #000;padding:50px;border-radius: 10px;">
                                                    <i class="icon-box icon-box--circled" style="background-color: #f8effa">
                                                        <img src="{{asset('/site_assets/img/offer-1.png')}}" style="width:50px;">
                                                    </i>
                                                    
                                                     <h4 class="__title" style="color: #0E3679;">Online Quote</h4>
                                                     <p style="letter-spacing: 0.1px;color: #4D4D4D;font-size: 16px;font-weight: 300;">Information about all policies at a click.</p>
                                                </div>
                                        </div>
                                        <!-- end item -->
                                        <!-- start item -->
                                        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-6" class="item" data-aos="slide-up">
                                                <div class="__item" style="box-shadow: 0 0 12px 6px rgb(0 0 0 / 3%);background: #fff;color: #000;padding:50px;border-radius: 10px;">
                                                    <i class="icon-box icon-box--circled" style="background-color: #f8effa">
                                                        <img src="{{asset('/site_assets/img/offer-2.png')}}" style="width:50px;">
                                                    </i>
                                                    
                                                     <h4 class="__title" style="color: #0E3679;">Policy Issuance</h4>
                                                     <p style="letter-spacing: 0.1px;color: #4D4D4D;font-size: 16px;font-weight: 300;">Paper-free Instant Policy Issuance.</p>
                                                </div>
                                        </div>
                                        <!-- end item -->
                                        <!-- start item -->
                                        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-6" class="item" data-aos="fade-left">
                                                <div class="__item" style="box-shadow: 0 0 12px 6px rgb(0 0 0 / 3%);background: #fff;color: #000;padding:50px;border-radius: 10px;">
                                                    <i class="icon-box icon-box--circled" style="background-color: #f8effa">
                                                        <img src="{{asset('/site_assets/img/offer-3.png')}}" style="width:50px;">
                                                       
                                                    </i>
                                                     <h4 class="__title" style="color: #0E3679;">Manage Renewals</h4>
                                                     <p style="letter-spacing: 0.1px;color: #4D4D4D;font-size: 16px;font-weight: 300;margin-bottom:0px;">Manage Renewals via Super Finserv App.</p>
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
            </section>
               <!-- end section -->

                <!-- start section -->
                <section  class="section " style="padding-top: 40px;padding-bottom: 20px;">
                    <div class="container">
                        <div class="row align-items-md-center">
                            <div class="col-12 col-lg-6"class="item" data-aos="flip-left">
                                <div class="section-heading">
                                     <h2 class="__title" style="font-size:26px;color:#0E3679;font-weight: 700;">Why Choose <span style="color:#AC0F0B;font-weight:700;">{{config('custom.site_short_name')}}</span></h2>
                                </div>
                                <div>
                                    <ul class="check-list my-md-6">
                                        <li>
                                            <h5 style="text-transform: uppercase;margin-bottom:10px;"><i class="ico-checked fontello-ok"></i>EASIEST WAY TO GET INSURED </h5>
                                            <p style="margin-top:0px; color: #272727; font-size:16px; text-align:justify;">As you set out achieve the dreams of your life, we help you realize your financial goals. We decode the complex terms and conditions of the policies and match them with your requirements to accommodate your needs.</p>
                                        </li>
                                        <li>
                                            <h5 style="text-transform: uppercase;margin-bottom:10px;"><i class="ico-checked fontello-ok"></i>HASSLE FREE BUYING </h5>
                                            <p style="margin-top:0px; color: #272727; font-size:16px; text-align:justify;">In a world where time is money, we help you save both time and money. Insurance is just a click away as we help you get your policy in your inbox in minutes.</p>
                                        </li>
                                        
                                       
                                    </ul>
                                </div>
                            </div>

                            <div class="spacer py-4 d-lg-none"></div>

                            <div class="col-12 col-lg-6  text-center text-lg-right" class="item" data-aos="flip-right">
                                <!-- start video -->
                                    <div class="video-box video-box--s1">
                                        <figure class="">
                                    <img class="lazy" src="{{asset('site_assets/img/why-choose.webp')}}" data-src="{{asset('site_assets/img/why-choose.webp')}}" alt="{{env('APP_NAME')}}" />

                                   
                            </figure>
                                    </div>
                                <!-- end video -->
                            </div>
                        </div>
                    </div>
                </section>
                <!-- end section -->
                
                <!-- end section -->
                <section class="data-security mt-40 mb-40">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 col-sm-6" class="item" data-aos="fade-right"><img src="{{asset('site_assets/img/security.webp')}}" style=""></div>
                            <div class="col-md-6 col-sm-6" class="item" data-aos="fade-left">
                                <div class="secure page-heading-h2" style="margin-bottom:10px">
                                  <!--<h3 class="text-primary">SECURE</h3>  -->
                                  <h2 style="color:#0E3679;">Robust Data Security</h2>
                                  <p style="margin-top:0px; font-size:16px; color: #272727; text-align:justify;">
                                     The confidentiality, privacy and security of your data is our topmost priority .
                                     We respect your privacy and your data would be safe with us and stored only in government approved data centres.
                                     We would neither sell it to anyone nor  share it without your consent.</p>
                                </div>
                                <script language="JavaScript" type="text/javascript">
                                TrustLogo("https://superfinserv.in/public/positivessl_trust_seal_md_167x42.png", "CL1", "none");
                                </script>
                            <a  href="https://www.instantssl.com/" id="comodoTL">Essential SSL</a>
                            </div>
                        </div>
                    </div>
                </section>
                 <section class="data-security mt-40 mb-40">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 col-sm-6" class="item" data-aos="fade-right">
                                <div class="secure page-heading-h2">
                                  <h2 style="color:#0E3679;">Claim Assistance</h2>
                                  <p style="margin-top:0px; font-size:16px; color: #272727; text-align:justify;">
                                      We provide assistance at every step in the Claim Settlement Journey. 
                                      We will be there to guide your loved ones do all the paper work and verify it. 
                                      We are backed by an expert Claim Support Team which  will also ensure that your rights are protected.</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6" class="item" data-aos="fade-left"><img src="{{asset('site_assets/img/claim.webp')}}" style=""></div>
                        </div>
                    </div>
                </section>
               


                 <!-- start section -->
<style>
                    .customer-logos .slide img:hover {
  -webkit-filter: grayscale(100%); /* Ch 23+, Saf 6.0+, BB 10.0+ */
  filter: grayscale(100%); /* FF 35+ */
}
                </style>

                <section class="">
                    <div class="container page-heading-h2">
                        <h2 class="text-center">Industry-leading insurance providers</h2>
                       <section class="customer-logos slider">
                           @isset($partners)
                           @foreach($partners as $pt)
                          <div class="slide"><img src="{{asset('assets/partners/'.$pt->logo_image)}}" style="width:80%" title="{{$pt->name}}"></div>
                          @endforeach
                          @endisset
                         
                       </section>

                    </div>
                </section>
    <style>
              .d-flex {
    display: flex!important;
}

.font-size-xs {
   font-size: 12px;
    /*font-weight: 900;*/
}
.ml4 p{
    font-family: system-ui;
    text-align:left;
    color: #000;
}
.mb-1, .my-1 {
    margin-bottom: .25rem!important;
}
.align-items-center {
    align-items: center!important;
}

.govt-startup-img{
            width:100%
        }
        .govt-digilocker-img{
            width:100%;
        }
        
        .regNo{
            font-family: system-ui;text-align: left;padding-left: 14px;color: #000;font-size: 13px;
            margin-top:0px;
        }

@media only screen and (max-width: 600px) {
  .font-size-xs {
           font-size: 11px;
            /*font-weight: 900;*/
        }
        .govt-startup-img{
            width:60%
        }
        .govt-digilocker-img{
            width:60%;
        }
        .DflaxBox{
          margin-bottom:12px;  
        }
        
        .regNo{
            font-family: system-ui;
            padding-left: 14px;color: #000;
            text-align: center;
            font-size: 13px;
            margin-top:0px;
        }
}
    </style>       
     <section class="section-w3ls text-center" style="    padding: 40px 0px;background-color: #f4f4f4e0;">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                   <div style="padding:25px 0px;">
                       <img  class="govt-startup-img" style="" src="{{asset('site_assets/logo/startupIndia.webp')}}"/>
                   </div>
                </div>
                <div class="col-md-2">
                   <div style="padding:25px 0px;">
                       <img  class="govt-digilocker-img" style="" src="{{asset('site_assets/logo/digiLocker.webp')}}"/>
                   </div>
                </div>
                <div class="col-md-4">
                    <div class="DflaxBox">
                       <div class="d-flex align-items-center">
                        <div style="width:15%" class="position-relative">
                            <img  style="width:100%" src="{{asset('site_assets/logo/Ashok-stambh-small.webp')}}" alt="" class="avatar-xl">
                        </div>
                        <div class="ml4">
                            <p class="mb-1 font-size-xs">Government of India Ministry of Commerce & Industry <br/> Department for Promotion of Industry and Internal Trade</p>
                         </div>
                     </div>
                      <p class="regNo" style="">Startup Registration :DIPP79411</p> 
                    </div>
                    
                </div>
                
                <div class="col-md-4">
                     <div class="DflaxBox">
                    <div class="d-flex align-items-center">
                                <div style="width:15%" class="position-relative">
                                    <img  style="width:100%" src="{{asset('site_assets/logo/Ashok-stambh-small.webp')}}" alt="" class=" avatar-xl">
                                </div>
                                <div class="ml4">
                                    <p class="mb-1 font-size-xs">Ministry of Electronics & Information <br/>Technology</p>
                                   </div>
                     </div>
                     <p class="regNo" >Digilocker  Registration :005208</p>
                    </div>
                </div>
               
               
            </div>
        </div>
    </section>
              

                <!-- end section -->
            </main>
            @endsection