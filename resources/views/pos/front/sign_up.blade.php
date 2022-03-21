<!DOCTYPE html>
<html class="no-js" lang="en"
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Super Finserv|| {{ ($title)?$title:$subtitle }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta name="viewport" content="user-scalable=no, width=device-width, height=device-height, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui" />
    <meta name="theme-color" content="#056EB9" />
    <meta name="msapplication-navbutton-color" content="#056EB9" />
    <meta name="apple-mobile-web-app-status-bar-style" content="#056EB9" />
    
    <link rel="shortcut icon" href="{{asset('img/ico/favicon.png')}}">
        <link rel="apple-touch-icon" href="{{asset('img/apple-touch-icon.png')}}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{asset('img/apple-touch-icon-72x72.png')}}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{asset('img/apple-touch-icon-114x114.png')}}">
        <!-- Critical styles================================================== -->
        <link rel="stylesheet" href="{{asset('css/critical.min.css')}}" type="text/css">
        <?php if($title=='Home'){ ?>
            <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
        <?php }else{ ?>
            <link rel="stylesheet" href="{{asset('css/style.min.css')}}" type="text/css"> 
        <?php }?>
        
        <link rel="stylesheet" type="text/css" href="{{asset('css/responsive.css')}}">
        <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,800" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
         <link rel="stylesheet" href="{{asset('js/confirm/css/jquery-confirm.css')}}" type="text/css">
        <style type="text/css">
        body{ font-size: 16px !important}
       .custom-btn.wide {width: 100%;margin-top: 0px;}
       .otp-1 input[type=tel] {
            /*height: 45px;*/
            /*width: 45px;*/
            /*font-size: 25px;*/
            /*text-align: center;*/
            /*border: 1px solid #000000;*/
             width: 15%;
    font-size: 20px;
    font-weight: 600;
    min-height:40px !important;
    text-align: center;
    border: none;
    border-bottom: 3px solid #dc3545;
    border-radius: 0px;
     box-shadow: none;
       }
       
      .otp-1 input[type=tel]:focus {
        box-shadow: none;
        outline: 0;
}

.custom-btn.wide {
    width: 100%;
    margin-top: 0px;
    margin-left: -52px;
}

@media only screen and (max-width: 480px){
    .custom-btn {
        line-height: 0;
        margin-bottom: 20px;
        margin-left: 0px !important;
    }
    a.custom-btn.custom-btn--medium.custom-btn--style-3 {
        line-height: 12px;
    }

}

.d-xl-flex.flex-xl-row.flex-xl-wrap.align-items-xl-center a {
 background: #AC0F0B;
    color: #fff !important;
    padding: 10px;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    text-align: center;
    line-height: 10px;
    font-weight: 400;
    margin-top: 20px;
}
.d-xl-flex.flex-xl-row.flex-xl-wrap.align-items-xl-center i {
    font-size: 16px;
    margin-top: -4px;
    font-weight: initial;
    text-align: -webkit-center;
    margin-left: -1px;
}
.close{opacity: inherit;
text-shadow: inherit;
}
.close:not(:disabled):not(.disabled):focus, .close:not(:disabled):not(.disabled):hover{opacity: inherit;}
  .btn-agree {
          background-color: #ac0e0b !important;
  } 
  
  .error{
      font-weight:600;
  }
  
  .textfield--grey::-webkit-input-placeholder { /* Edge */
  color: #6e6d6d !important;
}

.textfield--grey:-ms-input-placeholder { /* Internet Explorer 10-11 */
  color: #6e6d6d !important;
}

.textfield--grey::placeholder {
  color: #6e6d6d !important;
}

.textfield--grey{
    color: #6e6d6d !important; 
}
    </style>
    </head>
    <body>
    <div id="app">
        <header class=" " data-nav-anchor="true" style="padding: 15px">
            <div class="top-bar__inner">
                <div class="container-fluid">
                    <div class="row align-items-center no-gutters">
                        <a class="top-bar__logo site-logo" href="{{url('/')}}">
                            <img class="img-fluid" src="{{get_site_settings('site_logo')}}" alt="Super Finserv">
                        </a>
                           
                        <div class="top-bar__collapse">
                            <div id="top-bar__action" class="top-bar__action">
                                <div class="d-xl-flex flex-xl-row flex-xl-wrap align-items-xl-center">
                                    <a href="{{url('/')}}" class="close pull-right"><i class="fa fa-close"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <main role="main">
            
            <section class="section abc" style="padding-top: 80px;padding-bottom: 80px;" id="">
                <div class="container">
                    <div class="row justify-content-lg-between align-items-md-center">
                        <div class="col-12 col-md-7 col-lg-6 col-xl-5">
                           <div id="ajax_response" style="padding: 0px 21px;"></div>
                            <div id="mobileForm">
                                <div class="section-heading" style="margin-bottom:20px;">
                                    <h3 style="font-size: 20px;font-weight: 900;color: #AC0F0B !important;padding-left: 20px;">Start your Journey towards a rewarding career</h3></div>
                                {{ Form::open(array('url' => '#' ,'style'=>"margin: 0;",'class'=>"card-sm form-group",'enctype'=>"multipart/form-data", 'id'=>"RegisterForm",'method'=>"post" )) }}
                                    <div class="row no-gutters">
                                        <div class="col-12 col-sm">
                                            <div class="input-wrp">
                                                <!--onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));"-->
                                                <input class="textfield word-uppercase textfield--grey" placeholder="PAN Number" name="panNo" maxlength="10" id="panNo"  autocomplete="off" />
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-auto">
                                            <button class="custom-btn custom-btn--medium custom-btn--style-1 wide" type="submit" role="button" style="">Get Started</button>
                                        </div>
                                    </div>
                                {{ Form::close() }}
                                <a href="{{url('sign-in')}}" id="forgot_pswd" style="float:right;" >Sign-in account?</a>
                            </div>
                            <div id="otpbased" style="display:none;">@include('pos.front.otp_section')</div>
                            <div id="information" style="display:none;"> @include('pos.front.full_information')</div>
                        </div>
                        <div class="spacer py-5 d-md-none"></div>
                        <div class="col-12 col-md-5 col-lg-6">
                                <figure class="image-container">
                                    <img class="img-fluid" style="width:100%" src="https://i.pinimg.com/originals/d8/8f/a4/d88fa43aa79db7dfd147f459b4c71d00.png" alt="Super Finserv" />
                                </figure>
                            </div>
                    </div>
                </div>
            </section>
        </main>

        </div>



        <div id="btn-to-top-wrap">

            <a id="btn-to-top" class="circled" href="javascript:void(0);" data-visible-offset="800"></a>

        </div>



   

        <script type="text/javascript"  src="{{asset('js/jquery.min.js')}}"></script>

        <script type="text/javascript" src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script> 

        <script type="text/javascript"  src="{{asset('js/bootstrap.min.js')}}"></script>
        <script type="text/javascript"  src="{{asset('page_js/app-comman.js')}}"></script>



        <script type="text/javascript" src="{{asset('js/main.min.js')}}"></script>

        <script type="text/javascript" src="{{asset('js/validation/jquery.validate.min.js')}}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
<script type="text/javascript" src="{{asset('js/confirm/js/jquery-confirm.js')}}"></script>
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

        @foreach($scripts as $_script)

            <script src="{{$_script}}" ></script> 

         @endforeach

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