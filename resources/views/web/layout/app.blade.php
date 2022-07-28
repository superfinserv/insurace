<!DOCTYPE html>
<html class="no-js" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>{{ ($subtitle)?$subtitle:$title }}</title>
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Expires" content="0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
        <meta name="viewport" content="user-scalable=no, width=device-width, height=device-height, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui" />
        
        <meta name="theme-color" content="#056EB9" />
        <meta name="msapplication-navbutton-color" content="#056EB9" />
        <meta name="apple-mobile-web-app-status-bar-style" content="#056EB9" />
        <meta name="description" content="Super Finserv - Super Finserv Pvt. Ltd..."/>
        <meta name="keywords"    content="Super Finserv, Finserv,Super Finserv Pvt. Ltd is a financial product distribution company that has been started by two seasoned insurance professionals. "/>
        <meta name="viewport"    content="width=device-width"/>
        <link rel="shortcut icon" href="{{asset('site_assets/logo/ico/favicon.ico')}}"/>
        <link rel="apple-touch-icon" sizes="72x72" href="{{asset('site_assets/logo/ico/apple-icon-72x72.png')}}"/>
      

        <link rel="stylesheet" href="{{asset('css/cdn/aos.css')}}" />
        <link rel='stylesheet' href="{{asset('css/cdn/all.css')}}" >
        @if($subtitle!="Plan List" )
          <link href="{{asset('css/cdn/bootstrap-combined.no-icons.min.css')}}" rel="stylesheet"/>
        @endif
        
        <link href="{{asset('css/cdn/font-awesome.css')}}" rel="stylesheet"/>
        <link rel="stylesheet" href="{{asset('css/jquery-ui.css')}}">
  
        <link rel="apple-touch-icon" sizes="114x114" href="{{asset('site_assets/logo/ico/apple-icon-114x114.png')}}"/>
        <link rel="stylesheet" href="{{asset('js/confirm/css/jquery-confirm.css')}}" type="text/css"/>
        <link rel="stylesheet" href="{{asset('css/animate.min.css')}}"/>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,800" rel="stylesheet"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" type="text/css" media="all" />
        <link rel="stylesheet" href="{{asset('js/src/loading.css')}}" type="text/css">
        <link rel="stylesheet" href="{{asset('css/newupdates.css')}}" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet"/>
        <link href="{{asset('css/cdn/font-awesome.min.css')}}" rel="stylesheet"/>
        
        <link href="{{asset('css/cdn/jquery.loading.min.css')}}" rel="stylesheet">
        <link href="{{asset('js/toast/jquery.toast.css')}}" type="text/css" rel="stylesheet"/>
        <link href="{{asset('js/toastr/toastr.min.css')}}" type="text/css" rel="stylesheet"/>

        <link rel="stylesheet" href="{{asset('css/critical.min.css')}}" type="text/css">
        <?php if($title!='Insurance' && $title!='About Us' && $title!='Artical' && $title!='Contact Us'){ ?>
            <link rel="stylesheet" href="{{asset('css/cdn/bootstrap.min.css')}}">
            <link rel="stylesheet" href="{{asset('css/color-2.min.css')}}" type="text/css">
        <?php } if($title=='Home'){ ?>
            <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}"/>
        <?php }else{ ?>
            <link rel="stylesheet" href="{{asset('css/style.min.css')}}" type="text/css"/> 
        <?php }  ?>
        
         <link href="{{asset('css/jquery-ui.css')}}" type="text/css" rel="stylesheet"/>
        <link href="{{asset('css/cdn/select2.min.css')}}" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="{{asset('css/responsive.css')}}"/>
        <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}"/>
        <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,800" rel="stylesheet"/> 
        
        <link href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css" rel="stylesheet">
      <link href="https://cdn.datatables.net/fixedcolumns/4.1.0/css/fixedColumns.dataTables.min.css" rel="stylesheet">
        <link href="{{asset('js/ion-rangeslider/css/ion.rangeSlider.css')}}" rel="stylesheet">
        <link href="{{asset('js/ion-rangeslider/css/ion.rangeSlider.skinFlat.css')}}" rel="stylesheet">
        <link href="{{asset('css/preloader.css')}}" rel="stylesheet">
        <!--<link rel="stylesheet" href="asset('plugins/selectize/css/selectize.css')">-->
		 <link rel="stylesheet" href="{{asset('plugins/selectize/css/selectize.bootstrap4.css')}}">
	
        <style type="text/css">
            label .error {
                color: #dc3545 !important;
                border-color: #dc3545 !important;
               letter-spacing: 0.8px;
               font-weight: 500;
            }
            
            #PlanListContainer{
                margin-top: 35px;
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
            

         
.inline-loader {
    height : 8px;
    width  : 36px; /* (6 * <margin: 2px>) + (3 * <width: 8px>) */
}

.inline-loader-box {
    display                   : inline-block;
    height                    : 8px;
    width                     : 8px;
    margin                    : 0px 2px;
    border-radius: 50%;
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

body::-webkit-scrollbar {
  width: 9px;               /* width of the entire scrollbar */
}

body::-webkit-scrollbar-track {
  background: #0E3679;        /* color of the tracking area */
}

body::-webkit-scrollbar-thumb {
    background-color: #a5150d;
    border-radius: 40px;
    border: 0px solid #a5150d  
}

.page-title{
     color: #0E3679;
    font-size: 20px;
    font-weight: 600;
}
input[type=number]::-webkit-outer-spin-button,
input[type=number]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

input[type=number] {
    -moz-appearance:textfield;
}



        </style>
        
        
<script type="text/javascript"> //<![CDATA[ 
var tlJsHost = ((window.location.protocol == "https:") ? "https://secure.trust-provider.com/" : "http://www.trustlogo.com/");
document.write(unescape("%3Cscript src='" + tlJsHost + "trustlogo/javascript/trustlogo.js' type='text/javascript'%3E%3C/script%3E"));
//]]>
</script>


    </head>

        <body>
         @include('preloader')
        <div id="app">
            <!-- start header -->
             @include('web.layout.header')
             
            <!-- start start screen -->
              @yield('content')
            <!-- end main -->

            <!-- start footer -->
            
           
          <footer class="footer footer--s5 footer--color-dark" >
                <div class="footer__line footer__line--first" style="background-color:#fff">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="footer__item">
                                    <a class="footer__logo" href="{{url('/')}}">
                                        <img class="img-fluid lazy" 
                                             src="{{asset('site_assets/logo/'.config('custom.site_logo'))}}"
                                             data-src="{{asset('site_assets/logo/'.config('custom.site_logo'))}}" alt="{{config('custom.site_short_name')}}" />
                                    </a>

                                </div>

                                 <div class="footer__item text-center">
                                    <div class="s-btns s-btns--md s-btns--dark s-btns--rounded">
                                         <ul class="d-flex flex-row flex-wrap align-items-center">
                                            <li><a class="f" target="_blank" href="{{config('custom.facebook_url')}}"><i class="fa fa-facebook" style="font-size: 18px;line-height: 2.1;"></i></a></li>
                                            <li><a class="t" target="_blank" href="{{config('custom.twitter_url')}}"><i class="fa fa-twitter"  style="font-size: 18px;line-height: 2.1;"></i></a></li>
                                            <li><a class="y" target="_blank" href="{{config('custom.linkedin_url')}}"><i  class="fa fa-linkedin" style="font-size:18px;line-height: 2.1;"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-1"></div>

                            <div class="col col-md-6 col-lg-3">
                                <div class="footer__item">
                                    <h4 class="footer__item__title">Contact Info</h4>

                                    <address class="footer__address footer__address--s3">
                                        <p style="margin-top:0px; color: #272727; font-size:16px; text-align:justify;"><strong>Phone:</strong>
                                        <a href="tel:{{config('custom.contact_phone')}}">{{config('custom.contact_phone')}}</a>
                                        </p>
                                        
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
                <?php /*
                 <section class="footer-end fep">
                    <div class="container">
                        <p class="text-center">{{config('custom.site_name')}} (Previously Supersolutions Advisory Services Private Limited)</p>
                        <div class="row">
                            <div class="col-md-1 col-sm-12 wh-100">
                                <img src="{{asset('site_assets/logo/irda-logo-border.png')}}" width="100%">
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
                </section> */?>
                
                 <section class="footer-end fep">
                    <div class="container">
                        <p class="text-center">{{config('custom.site_name')}} (Previously Supersolutions Advisory Services Private Limited)</p>
                        <div class="row">
                            <div class="col-xl-1 col-lg-1 col-md-6 col-sm-12 col-xs-12 col-12 wh-100">
                                <img src="{{asset('site_assets/logo/irda-logo-border.png')}}" width="100%">
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 wh-100 bordrl">
                                <p>IRDAI CORPORATE AGENCY REGISTRATION NUMBER: <br>{{config('custom.irda_reg_no')}} (License Category: Composite)</p>
                            </div>
                            
                            <div class="col-xl-2 col-lg-2 col-md-6 col-sm-12 col-xs-12 col-12 wh-100 bordrl">
                                <p>VALID TILL:<br>{{config('custom.irda_valid_till')}}</p>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 col-12 wh-100 bordrl">
                                <p>CORPORATE IDENTITY NUMBER (CIN):
                                    <br>{{config('custom.corporate_identity_no')}}</p>
                            </div>
                            <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-xs-12 col-12 wh-100 bordrl">
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
            <a id="btn-to-top" class="circled" href="javascript:void(0);" data-visible-offset="800" style=" background-image: url('{{asset('site_assets/img/Umbrella.png')}}');background-size: 60px;
    background-position: center;">
                
            </a>
        </div>
         <script type="text/javascript" src="{{asset('js/device.min.js')}}"/></script>
        <script src="{{asset('js/cdn/aos.js')}}"/></script>
        <script type="text/javascript"  src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
        
        <script rel="stylesheet" href="{{asset('js/src/loading.js')}}" ></script>
       
        <script src="{{asset('js/cdn/jquery.easing.min.js')}}"></script>
        <script src="{{asset('js/cdn/popper.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/validation/jquery.validate.min.js')}}"></script>
         <script src="{{asset('js/jquery-ui.min.js')}}"></script>
        <script type="text/javascript"  src="{{asset('js/bootstrap.min.js')}}"></script>
        <script type="text/javascript"  src="{{asset('js/rengeslider.js')}}"></script>
        <script src="{{asset('js/loading-btn/jquery.loadButton.js')}}"></script>
        <script src="{{asset('js/toast/jquery.toast.js')}}"></script>
        <script src="{{asset('js/toastr/toastr.min.js')}}"></script>
        <script src="{{asset('plugins/selectize/js/standalone/selectize.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/main.min.js')}}"></script>
        
        <script src="{{asset('js/confirm/js/jquery-confirm.js')}}"></script>
        
        <script src="{{asset('js/config.js?v=0.01')}}"></script>
        <script src="{{asset('page_js/mobileOtpForm.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/common.js')}}"></script>
        <script src="{{asset('js/cdn/jquery.loading.min.js')}}"></script>
        <script src="{{asset('js/input-mask/jquery.mask.js')}}"></script>
        <script src="{{asset('js/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>
        <script src="{{asset('js/cdn/select2.min.js')}}"></script>
       <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
       <script src="https://cdn.datatables.net/fixedcolumns/4.1.0/js/dataTables.fixedColumns.min.js"></script>
          <script>
          
            

                    (function (w, d) {
                        var m = d.getElementsByTagName('main')[0],
                                s = d.createElement("script"),
                                v = !("IntersectionObserver" in w) ? "8.17.0" : "11.0.6",
                                o = {
                                    elements_selector: ".lazy",
                                    threshold: 500,
                                    callback_enter: function (element) {

                                    },
                                    callback_load: function (element) {

                                    },
                                    callback_set: function (element) {

                                        oTimeout = setTimeout(function ()
                                        {
                                            clearTimeout(oTimeout);

                                            AOS.refresh();
                                        }, 1000);
                                    },
                                    callback_error: function (element) {
                                        
                                    }
                                };
                        s.type = 'text/javascript';
                        s.async = false; 
                      
                        m.appendChild(s);
                       
                        w.lazyLoadOptions = o;
                    }(window, document));
                </script>
      

         <script> var base_url = "{{url('/')}}"; </script>  
        @isset($scripts)
            @foreach($scripts as $_script) <script src="{{$_script}}" ></script> @endforeach
        @endisset
        @isset($scriptss)
            @foreach($scriptss as $_scripts) <script src="{{$_scripts}}" ></script>  @endforeach
        @endisset
         
        <!-- start footer common -->
            @include('web.layout.footer_common')
        <!-- start footer common -->
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











$(document).ready(function() {
    var table = $('#example').DataTable( {
        scrollY:        "100vh",
        scrollX:        true,
        scrollCollapse: true,
        fixedHeader: true,
        paging:         false,
        ordering: false,
        searching: false, 
        info: false,
        bInfo : false,
        // columnDefs: [
            
        //     { width:  "20%", targets: 0 },
        //     { width:  "20%", targets: 1 },
        //     { width:  "20%", targets: 2 },
        //     { width:  "20%", targets: 3 },
        //     { width:  "20%", targets: 4 },
        // ],
        //fixedColumns: true
        fixedColumns:   {
            left: 1,
        },
        oLanguage: {
        "sEmptyTable": "Comparison Points"
      }
    } );
} );
        </script>
         
         
         
         

           
    </body>


</html>