<!DOCTYPE html>
<html class="no-js" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Expires" content="0">
        <title>{{ ($title)?$title:$subtitle }} | {{ ($subtitle)?$subtitle:$title }}</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
        <meta name="viewport" content="user-scalable=no, width=device-width, height=device-height, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui" />
        <meta name="theme-color" content="#056EB9" />
        <meta name="msapplication-navbutton-color" content="#056EB9" />
        <meta name="apple-mobile-web-app-status-bar-style" content="#056EB9" />
        <link rel="shortcut icon" href="{{asset('site_assets/logo/ico/favicon.ico')}}"/>
        <link rel="apple-touch-icon" sizes="72x72" href="{{asset('site_assets/logo/ico/apple-icon-72x72.png')}}"/>
          <link rel="stylesheet" href="{{asset('css/cdn/aos.css')}}" />
        <link rel='stylesheet' href="{{asset('css/cdn/all.css')}}" >
        <link href="{{asset('css/cdn/bootstrap-combined.no-icons.min.css')}}" rel="stylesheet"/>
        <link rel="stylesheet" href="{{asset('css/animate.min.css')}}"/>'
        <!--<link rel="stylesheet" href="{{asset('css/app.css')}}"/>-->
         <link rel="stylesheet" href="{{asset('css/jquery-ui.css')}}"/>
         <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,800" rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet"/>
        <!-- Critical styles================================================== -->
        <link rel="stylesheet" href="{{asset('css/critical.min.css')}}" type="text/css"/>
        <?php //if($title!='Home' && $title!='About Us' && $title!='Artical' && $title!='Contact Us'){ ?>
            <link rel="stylesheet" href="{{asset('css/cdn/bootstrap.min.css')}}">
            <link rel="stylesheet" href="{{asset('css/color-2.min.css')}}" type="text/css"/>
        <?php //} if($title=='Home'){ ?>
            <link rel="stylesheet" type="text/css" href="{{asset('css/posp/style.css')}}"/>
        <?php //}else{ ?>
            <link rel="stylesheet" href="{{asset('css/posp/style.min.css')}}" type="text/css"/> 
        <?php //} ?>
         <link rel="stylesheet" href="{{asset('css/newupdates.css')}}" type="text/css">
        <link href="{{asset('css/cdn/select2.min.css')}}" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="{{asset('css/responsive.css')}}"/>
        <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}"/>
        
          <link href="{{asset('css/cdn/jquery.loading.min.css')}}" rel="stylesheet"/>
        
        <link href="{{asset('js/toast/jquery.toast.css')}}" type="text/css" rel="stylesheet"/>
        <link href="{{asset('css/jquery-ui.css')}}" type="text/css" rel="stylesheet"/>
      
        <link rel="stylesheet" href="{{asset('js/confirm/css/jquery-confirm.css')}}" type="text/css"/>
        <link rel="stylesheet" href="{{asset('js/src/loading.css')}}" type="text/css"/>
        <link rel="stylesheet" href="{{asset('css/posp/jquery.steps.css')}}" type="text/css"/>
        <link href="{{asset('js/toastr/toastr.min.css')}}" rel="stylesheet" type="text/css"/>
         <link href="{{asset('js/DataTables/datatables.min.css')}}" rel="stylesheet" type="text/css"/>
          <link href="{{asset('js/ion-rangeslider/css/ion.rangeSlider.css')}}" rel="stylesheet">
        <link href="{{asset('js/ion-rangeslider/css/ion.rangeSlider.skinFlat.css')}}" rel="stylesheet">
         <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,800" rel="stylesheet"/>
          <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">-->
          
           <link rel="stylesheet" href="{{asset('css/croppie.css')}}">
           
        <script type="text/javascript" src="{{asset('js/device.min.js')}}"></script>
        <script type="text/javascript"  src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
        
        
        <style type="text/css">
        
          .error { color: red; border-color: red !important;}
           #loading{ display: none;  }
           .footer { position: inherit !important; }    
           .loading-indicater-btn i{ font-size: 20px;}
            @keyframes spinner {
                to {transform: rotate(360deg);}
            }
            
           .error {
                color: red;
                border-color: red !important;
            }
            
        
            td.new.day {
                color: #000 !important;
            }
            
            .btn-ss{
                font-size: 15px;
                background: #2d3a49;
                border: 1px solid #2d3a49;
                max-width: 100%;
                padding: 8px 25px;
                color: #fff;
            }
            
            .btn-ss:hover{
                color:#fff;
                background: #AC0F0B;
            }
            #btn-step-3 .fa-spinner{
                    font-size: 20px;
            }
            .btn-ss i.right{
                font-size: 12px;
                margin-left: 12px;
            }
            .btn-ss i.left{
                font-size: 12px;
                margin-right: 12px;
            }
            .spinner,
            .spinner:before {
                 width: 40px;
                height: 40px;
                box-sizing: border-box;
            }
            
            .spinner:before {
                  content: '';
                display: block;
                border-radius: 50%;
                border: 3px solid #ccc;
                border-top-color: #ac0f0a;
                animation: spinner .6s linear infinite;
            }

                .spinner-absolute {
                  position: absolute;
                  top: 40%;
                  left: 45%;
                  margin-top: -10px;
                  margin-left: -10px;
                }
                
                /* Animations */
                
                .spinner-add,
                .spinner-remove {
                  animation-fill-mode: both;
                  animation-duration: .4s;
                }
                
                .spinner-add {
                  animation-name: spinner-add;
                }
                
                @keyframes spinner-add {
                  from {transform: scale(0);}
                  to {transform: scale(1);}
                }
                
                .spinner-remove {
                  animation-name: spinner-remove;
                }
                
                @keyframes spinner-remove {
                  to {transform: scale(0);}
                }
                
                
                 
         .inline-loader {
    height : 8px;
    width  : 36px; /* (6 * <margin: 2px>) + (3 * <width: 8px>) */
}

.inline-loader-box {
    display                   : inline-block;
    height                    : 8px;
    width                     : 8px;
    margin                    : 0px 2px;
    background-color          : rgb(172, 15, 11); 
    animation-name            : inlinefadeOutIn;
    animation-duration        : 500ms;
    animation-iteration-count : infinite;
    animation-direction       : alternate;
}

.inline-loader-box:nth-child(1) { animation-delay: 250ms; } /* (1/2) * <animation-duration: 500ms */
.inline-loader-box:nth-child(2) { animation-delay: 500ms; } /* (2/2) * <animation-duration: 500ms */
.inline-loader-box:nth-child(3) { animation-delay: 750ms; } /* (3/2) * <animation-duration: 500ms */

@keyframes inlinefadeOutIn {
    0%   { background-color : rgb(231, 183, 181); }
    100% { background-color : rgb(172, 15, 11); }
}
        </style>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,700i,800,800i,900,900i%7CQuicksand:300,400,700" media="all">
    </head>
        <body>
        <div id="app">
            <!-- start header -->
            @include('pos.layouts.header')
            <!-- start start screen -->
              @yield('content')
            <!-- end main -->
            <!-- start footer -->
            <!--<div class="under-development" style="    margin-top: 20px;margin-bottom:12px;text-align: center;border: 1px dashed red;padding: 12px 12px;color: #f25353;background: #ffdada8c;">-->
            <!--    <marquee><strong>Public Notice :</strong> The website is under development, till now we have not sourced any Insurance policy through this website.</marquee>-->
            <!--</div>-->
          <footer class="footer footer--s5 footer--color-dark">
                <div class="footer__line footer__line--first">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="footer__item">
                                    <a class="footer__logo" href="{{url('/')}}">
                                        <img class="img-fluid lazy" 
                                             src="{{asset('site_assets/logo/'.config('custom.site_logo'))}}"
                                             data-src="{{asset('site_assets/logo/'.config('custom.site_logo'))}}"   alt="{{config('custom.site_short_name')}}" />
                                    </a>

                                </div>

                                 <div class="footer__item text-center">
                                    <div class="s-btns s-btns--md s-btns--dark s-btns--rounded">
                                         <ul class="d-flex flex-row flex-wrap align-items-center">
                                            <li><a class="f" target="_blank" href="{{config('custom.facebook_url')}}"><i class="fontello-facebook"></i></a></li>
                                            <li><a class="t" target="_blank" href="{{config('custom.twitter_url')}}"><i class="fontello-twitter"></i></a></li>
                                            <li><a class="y" target="_blank" href="{{config('custom.linkedin_url')}}"><i class="fa fa-linkedin" style="font-size:18px;"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-1"></div>

                            <div class="col col-md-6 col-lg-3">
                                <div class="footer__item">
                                    <h4 class="footer__item__title">Contact Info</h4>

                                    <address class="footer__address footer__address--s3">
                                        <p style="margin-top:0px; color: #272727; font-size:16px; text-align:justify;"><strong>Phone:</strong>{{config('custom.contact_phone')}}</a></p>
                                        
                                        <p style="margin-top:0px; color: #272727; font-size:16px; text-align:justify;"><strong>Email:</strong> <a href="mailto:{{config('custom.contact_email')}}">{{config('custom.contact_email')}}</a></p>
                                    </address>
                                </div>
                            </div>

                            

                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="footer__item">
                                    <h4 class="footer__item__title">Address info</h4>

                                    <address class="footer__address footer__address--s3">
                                        <p style="margin-top:0px; color: #272727; font-size:16px; line-height: 27px;">{{config('custom.contact_address')}}</p>
                                    </address>
                                </div>

                               
                            </div>
                        </div>
                    </div>
                </div>
            
                    <section class="footer-end fep">
                    <div class="container">
                        <p class="text-center">{{config('custom.site_name')}} (Previously Supersolutions Advisory Services Private Limited)</p>
                        <div class="row">
                            <div class="col-md-1 col-sm-12 wh-100">
                                <img src="{{asset('site_assets/logo/irda-logo.png')}}" width="100%">
                            </div>
                            <div class="col-md-4 col-sm-12 wh-100 bordrl">
                                <p>IRDAI CORPORATE AGENCY REGISTRATION NUMBER: <br>{{config('custom.irda_reg_no')}} (License Category: Composite)</p>
                            </div>
                            
                            <div class="col-md-2 col-sm-12 wh-100 bordrl">
                                <p>VALID TILL:<br>{{config('custom.irda_valid_till')}}</p>
                            </div>
                            <div class="col-md-3 col-sm-12 wh-100 bordrl">
                                <p>CORPORATE IDENTITY NUMBER (CIN):
                                    <br>{{config('custom.corporate_identity_no')}}</p>
                            </div>
                            <div class="col-md-2 col-sm-12 wh-100 bordrl">
                                <p>PRINCIPAL OFFICER<br> {{config('custom.principal_officer')}}  </p>
                            </div>
                        </div>
                        
                    </div>
                </section>
                <section class="footer-last-end">
                    <div class="container">
                        <div class="botom-bord">&nbsp;</div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                 <ul class="text-center">
                                    <li><a href="{{url('/shipping')}}">Shipping & Delivery Policy</a></li>
                                    <li><a href="{{url('/privacy-policy')}}">Privacy Policy</a></li>
                                    <li><a href="{{url('/disclaimer')}}">Disclaimer</a></li>
                                    <li><a href="{{url('/terms-conditions')}}">Terms & Conditions</a></li>
                                </ul>
                            </div>
                
                            <div class="col-md-6 col-sm-6">
                                <p style= "text-align: end;font-size: small;">{{config('custom.copyright_content')}}</p>
                            </div>
                        </div>
                    </div>
                </section>

                <div class="footer__waves-container">
                    <svg class="footer__wave js-wave" data-wave='{"height": 40, "bones": 5, "amplitude": 70, "color": "rgba(215, 219, 224, 0.2)", "speed": 0.3}' width="100%" height="100%" version="1.1" xmlns="http://www.w3.org/2000/svg"><defs></defs><path class="wave-1" d=""/></svg>

                    <svg class="footer__wave js-wave" data-wave='{"height": 60, "bones": 4, "amplitude": 90, "color": "rgba(215, 219, 224, 0.2)", "speed": 0.35}' width="100%" height="100%" version="1.1" xmlns="http://www.w3.org/2000/svg"><defs></defs><path class="wave-2" d=""/></svg>
                </div>
            </footer>
            <!-- end footer -->
        </div>
        <div id="btn-to-top-wrap">
            <a id="btn-to-top" class="circled" href="javascript:void(0);" data-visible-offset="800"></a>
        </div>
        <script type="text/javascript"  src="{{asset('js/bootstrap.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/validation/jquery.validate.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/main.min.js')}}"></script>
        <script src="{{asset('js/jquery-ui.js')}}"></script>
           <script src="{{asset('js/cdn/jquery.easing.min.js')}}"></script>
        <script src="{{asset('js/cdn/popper.min.js')}}"></script>
        <script src="{{asset('js/cdn/select2.min.js')}}"></script>
        
        <script src="{{asset('js/cdn/bootstrap-datepicker.js')}}"></script>
         <script type="text/javascript" src="{{asset('js/posp_config.js')}}"></script>
          <script rel="stylesheet" href="{{asset('js/src/loading.js')}}" ></script>
         <script src="{{asset('js/todolist.js')}}"></script>
         <script src="{{asset('js/toastDemo.js')}}"></script>
         <script type="text/javascript" src="https://checkout.razorpay.com/v1/razorpay.js"></script>
        <script type="text/javascript" src="{{asset('js/confirm/js/jquery-confirm.js')}}"></script>
       <script src="{{asset('js/loading-btn/jquery.loadButton.js')}}"></script>
         <script src="{{asset('js/toastr/toastr.min.js')}}"  type="text/javascript"></script>
         <script src="{{asset('js/input-mask/jquery.mask.js')}}"  type="text/javascript"></script>
          <script src="{{asset('js/cdn/jquery.loading.min.js')}}"></script>
            <script src="{{asset('js/DataTables/datatables.min.js')}}"></script>
            <script src="{{asset('js/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>
          <script src="{{asset('js/croppie.js')}}"></script>
   
      <script src="{{asset('js/jquery-ui.min.js')}}"></script>
         <script> var base_url = "{{url('/')}}"; </script>  
            @isset($scripts)@foreach($scripts as $_script)<script src="{{$_script}}" ></script>@endforeach @endisset
            <?php if(session()->has('message')): ?>
                    <script type="text/javascript">
                         $.toast({
                              heading: 'Success',
                              text: "Successfully Added Record",
                              showHideTransition: 'slide',
                              icon: 'success',
                              loaderBg: '#f96868',
                              position: 'top-right'
                            })
                   </script>
    <?php endif ?>
    <?php if(session()->has('updatemessage')): ?>
        <script type="text/javascript">
           $.toast({
              heading: 'Success',
              text: "Successfully Update Record",
              showHideTransition: 'slide',
              icon: 'success',
              loaderBg: '#f96868',
              position: 'top-right'
            })
        </script>
    <?php endif ?>
    <?php if(session()->has('mailsend')): ?>
        <script type="text/javascript">
            $.toast({
                  heading: 'Success',
                  text: "Successfully Mail Send",
                  showHideTransition: 'slide',
                  icon: 'success',
                  loaderBg: '#f96868',
                  position: 'top-right'
                })
        </script>
    <?php endif ?>
    <?php if(session()->has('delete')): ?>
        <script type="text/javascript">
            $.toast({
                  heading: 'Success',
                  text: "Successfully Deleted Record",
                  showHideTransition: 'slide',
                 icon: 'success',
                  loaderBg: '#f96868',
                  position: 'top-right'
                })
        </script>
    <?php endif ?>
    <?php if(session()->has('error')): ?>
        <script type="text/javascript">
             $.toast({
                  heading: 'Success',
                  text: "Somethink Issues",
                  showHideTransition: 'slide',
                  icon: 'success',
                  loaderBg: '#f96868',
                  position: 'top-right'
                })
        </script>
    <?php endif ?>
    <?php if(session()->has('emailexist')): ?>
        <script type="text/javascript">
             $.toast({
                  heading: 'Success',
                  text: "Email Aready exist",
                  showHideTransition: 'slide',
                 icon: 'success',
                  loaderBg: '#f96868',
                  position: 'top-right'
                })
        </script>
    <?php endif ?>    
        <script type="text/javascript">
            var _html = document.documentElement,
               isTouch = (('ontouchstart' in _html) || (navigator.msMaxTouchPoints > 0) || (navigator.maxTouchPoints));
            _html.className = _html.className.replace("no-js","js");
            _html.classList.add( isTouch ? "touch" : "no-touch");
        </script>
       
            

<script type="text/javascript">
    $(document).ready(function(){
    $('.customer-logos').slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1500,
        arrows: false,
        dots: false,
        pauseOnHover: false,
        responsive: [{ breakpoint: 768,settings: { slidesToShow: 4}}, 
                    {breakpoint: 520, settings: { slidesToShow: 3}}]
    });
});
</script>
<script type="text/javascript">
    $(document).ready(function () {
    $(".datepicker").datepicker({
        dateFormat: 'dd-mm-yy'
    })
});
        </script>
         <script type="text/javascript">
            var _html = document.documentElement,
                isTouch = (('ontouchstart' in _html) || (navigator.msMaxTouchPoints > 0) || (navigator.maxTouchPoints));
               _html.className = _html.className.replace("no-js","js");
               _html.classList.add( isTouch ? "touch" : "no-touch");
            
             $(document).ready(function(){
                    $('.customer-logos').slick({
                        slidesToShow: 6,slidesToScroll: 1,
                        autoplay: true, autoplaySpeed: 1500,
                        arrows: false,dots: false,
                        pauseOnHover: false,
                        responsive: [{
                            breakpoint: 768,
                            settings: { slidesToShow: 4}
                           }, 
                           { 
                            breakpoint: 520,
                            settings: { slidesToShow: 3 }
                        }]
                    });
                });

        </script>
    </body>
</html>