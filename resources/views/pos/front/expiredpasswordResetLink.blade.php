<!DOCTYPE html>
<html class="no-js" lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
	<title>SuperSolutions || {{ ($title)?$title:$subtitle }}</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<meta name="viewport" content="user-scalable=no, width=device-width, height=device-height, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui" />
	<meta name="theme-color" content="#FF7441" />
	<meta name="msapplication-navbutton-color" content="#FF7441" />
	<meta name="apple-mobile-web-app-status-bar-style" content="#FF7441" />
	<link rel="shortcut icon" href="{{asset('img/ico/favicon.png')}}">
	<link rel="apple-touch-icon" href="{{asset('img/apple-touch-icon.png')}}">
	<link rel="apple-touch-icon" sizes="72x72" href="{{asset('img/apple-touch-icon-72x72.png')}}">
	<link rel="apple-touch-icon" sizes="114x114" href="{{asset('img/apple-touch-icon-114x114.png')}}">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{asset('css/critical.min.css')}}" type="text/css">
	<link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/responsive.css')}}">
	<link rel="stylesheet" href="{{asset('css/style.min.css')}}" type="text/css">
	<script type="text/javascript" src="{{asset('js/device.min.js')}}"></script>
<style>
	.row.justify-content-lg-between.align-items-md-center a {
    background:#AC0F0B;
    color: #fff !important;
    padding: 10px;
    border-radius: 50%;
    width:30px;
    height:30px;
    text-align: center;
    line-height: 10px;
    font-weight: 400;
    margin-top: 20px;
}
.close{opacity: inherit;
text-shadow: inherit;
}
.close:not(:disabled):not(.disabled):focus, .close:not(:disabled):not(.disabled):hover{opacity: inherit;}
.row.justify-content-lg-between.align-items-md-center i {
    font-size: 16px;
    margin-top: -4px;
    font-weight: initial;
    text-align: -webkit-center;
    margin-left:-1px;
}
</style>
	</head>
	<body>
		<div id="app">
		    <main role="main">
				<section class="" >
					<div class="container">
						<div class="row justify-content-lg-between align-items-md-center">
							<div class="col-12 col-md-12 col-lg-12 col-xl-12">
								<a href="{{url('/')}}" class="close pull-right"><i class="fa fa-close"></i></a>
								</div>
							</div>
						</div>
			   </section>
			   <section class="signup">
				<div class="container">
					<div class="row">
						<div class="col-md-4"></div>
						<div class="col-md-4">
							<div class="sighup-logo">
						  	  <a href="#"><img src="https://insurance.supersolutions.in/img/site_logo/logo_5.png" style="width: 300px; margin: 0 auto; margin-bottom:100px"></a>
					 	   </div>     
                                   
                                <img src="{{asset('img/expired_llink.png')}}" style="width: 100%; padding-bottom: 60px;">
                                <a href="{{url('/forgot-password')}}" class="custom-btn custom-btn--medium custom-btn--style-1 wide"  style=" margin-left:0px;">Resend link</a> 
                              
						</div>

						<div class="col-md-4"></div>
					</div>
				</div>
			</section>
			</main>
		</div>
		<div id="btn-to-top-wrap">
			<a id="btn-to-top" class="circled" href="javascript:void(0);" data-visible-offset="800"></a>
		</div>
		<script type="text/javascript"  src="{{asset('js/jquery.min.js')}}"></script>
        <script type="text/javascript"  src="{{asset('js/bootstrap.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/main.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/validation/jquery.validate.min.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
        <script>
            (function (w, d) {
                var m = d.getElementsByTagName('main')[0],
                    s = d.createElement("script"),
                    v = !("IntersectionObserver" in w) ? "8.17.0" : "11.0.6",
                    o = {
                          elements_selector: ".lazy",
                                    threshold: 500,
                                    callback_enter: function (element) {},

                                    callback_load: function (element) { },
                                    callback_set: function (element) {
                                        oTimeout = setTimeout(function (){
                                            clearTimeout(oTimeout);
                                            AOS.refresh();
                                        }, 1000);
                                    },
                                    callback_error: function (element) {
                                        element.src = "https://placeholdit.imgix.net/~text?txtsize=21&amp;txt=Image%20not%20load&amp;w=200&amp;h=200";
                                    }

                                };
                        s.type = 'text/javascript';
                        s.async = false; 
                        s.src = "https://cdn.jsdelivr.net/npm/vanilla-lazyload@" + v + "/dist/lazyload.min.js";
                        m.appendChild(s);
                        w.lazyLoadOptions = o;
                    }(window, document));
                </script>

                <script type="text/javascript">

            WebFontConfig = {

                google: { families: [ 'Nunito+Sans:400,400i,700,700i,800,800i,900,900i', 'Quicksand:300,400,700'] }

            };

            (function() {
                var wf = document.createElement('script');
                wf.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
                wf.type = 'text/javascript';
                wf.async = 'true';
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(wf, s);
            })();
        </script>
         <script> var base_url = "{{url('/')}}"; </script>  
        @isset($scripts) 
             @foreach($scripts as $_script)<script src="{{$_script}}" ></script> @endforeach
        @endisset
        <script type="text/javascript">
            var _html = document.documentElement,
                isTouch = (('ontouchstart' in _html) || (navigator.msMaxTouchPoints > 0) || (navigator.maxTouchPoints));
            _html.className = _html.className.replace("no-js","js");
            _html.classList.add( isTouch ? "touch" : "no-touch");
            $(document).ready(function() {
               $('.invest-month').select2();
            });
        </script>
        <script type="text/javascript" src="{{asset('js/device.min.js')}}"></script>
    </body>
</html>