<!doctype html>
<html class="no-js" lang="en">
    <head>
        <!-- META -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- SITE TITLE -->
        <title>Comming - soon</title>

        <!-- FAVICON -->
        <!--<link rel="icon" href="images/favicon.png">-->

        <!-- STYLE -->
        <link rel="stylesheet" href="{{asset('comming-soon/css/style.css')}}">

        

    </head>
    <body>
        <canvas id="c"></canvas>
        <div class="wrapper">

            <div class="main-section">
                

                <!-- TAB CONTENT -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade active in" id="home">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">

                                    <form class="subsribbe-box" action="{{url('/')}}">
                                        @csrf
                                        <div class="animation-container">
                                            <svg viewBox="0 205 600 600">
                                                <symbol id="text">
                                                    <text text-anchor="middle" x="50%" y="50%"> COMING SOON</text>
                                                </symbol>
                                                <use xlink:href="#text" class="text"></use>
                                                <use xlink:href="#text" class="text"></use>
                                                <use xlink:href="#text" class="text"></use>
                                                <use xlink:href="#text" class="text"></use>
                                            </svg>
                                        </div>
                                        <h1>{{$text}}</h1>
                                        <!--<div class="form-group">-->
                                        <!--    <input type="email" class="form-control" id="email" placeholder="Your Email">-->
                                        <!--</div>-->
                                        <input type="submit"  class="btn submit-btn" value="BACK TO HOME" />
                                    </form>
                                </div><!-- END OF /. COLUMN -->
                            </div><!-- END OF /. ROW -->
                        </div><!-- END OF /. CONTAINER FLUID -->
                    </div><!-- END OF /. HOME -->

                </div>

            <div class="footer-section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <p>Made with <i class="fa fa-heart"></i> by <a href="https://superfinserv.com/" target="_blank">Super Finserv</a>. All Rights Reserved</p> 
                        </div>
                    </div>
                </div>
            </div>
            </div><!-- END OF /. MAIN SECTION -->

        </div><!-- END OF /. WRAPPER -->


        <!-- JQUERY LIBEARY -->
        <script src="{{asset('comming-soon/js/vendor/jquery-3.6.0.min.js')}}"></script>
        <!-- BOOTSTRAP -->
        <script src="{{asset('comming-soon/js/vendor/bootstrap.min.js')}}"></script>
        <!-- CUSTOM JS -->
        <script src="{{asset('comming-soon/js/jquery.downCount.js')}}"></script>
        <!-- CUSTOM JS -->
        <script src="{{asset('comming-soon/js/rain.js')}}"></script>
        <script src="{{asset('comming-soon/js/custom.js')}}"></script>

    </body>
</html>
