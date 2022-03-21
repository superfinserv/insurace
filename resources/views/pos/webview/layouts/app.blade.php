<!doctype html>
<html lang="en" class="deeppurple-theme">
<head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, viewport-fit=cover, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="Maxartkiller">
    <title>SuperSolutions</title>
    <!-- Material design icons CSS -->
    <link rel="stylesheet" href="{{asset('app_assets/vendor/materializeicon/material-icons.css')}}">
    <!-- Roboto fonts CSS -->
    <link href="https://fonts.googleapis.com/css89ea.css?family=Roboto:300,400,500,700&amp;display=swap" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="{{asset('app_assets/vendor/bootstrap-4.4.1/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Swiper CSS -->
    <link href="{{asset('app_assets/vendor/swiper/css/swiper.min.css')}}" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{asset('app_assets/css/style.css')}}" rel="stylesheet">
</head>

<body>
    

    <div class="wrapper pb-0">
       

         <!-- start start screen -->
              @yield('content')
            <!-- end main -->
    </div>



    <!-- jquery, popper and bootstrap js -->
    <script src="{{asset('app_assets/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('app_assets/js/popper.min.js')}}"></script>
    <script src="{{asset('app_assets/vendor/bootstrap-4.4.1/js/bootstrap.min.js')}}"></script>

    <!-- swiper js -->
    <script src="{{asset('app_assets/vendor/swiper/js/swiper.min.js')}}"></script>
    
    <!-- cookie js -->
    <!--<script src="{{asset('app_assets/vendor/cookie/jquery.cookie.js"></script>-->

    <!-- template custom js -->
    <script src="{{asset('app_assets/js/main.js"></script>

    <!-- page level script -->
    <script>
        $(window).on('load', function() {
            /* swiper  */
            var swiper = new Swiper('.offer-slide', {
                slidesPerView: 'auto',
                spaceBetween: 0,
            });

        });

    </script>

</body>
</html>
