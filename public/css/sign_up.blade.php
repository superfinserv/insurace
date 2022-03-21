

<!DOCTYPE html>

<html class="no-js" lang="en">



<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>

		<title>BUYPOLICY</title>

		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">



		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />

		<meta name="viewport" content="user-scalable=no, width=device-width, height=device-height, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui" />



		<meta name="theme-color" content="#FF7441" />

		<meta name="msapplication-navbutton-color" content="#FF7441" />

		<meta name="apple-mobile-web-app-status-bar-style" content="#FF7441" />



		

		<link rel="shortcut icon" href="{{asset('img/favicon.ico')}}">

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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Forgot password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
            <div class="form-group">
            <small>New Password</small>
            <input type="New Password" class="form-control" id="New Password" aria-describedby="New Password" placeholder="New Password">
            </div> 

            <div class="form-group">
            <small>Confirm Password</small>
            <input type="Confirm Password" class="form-control" id="Confirm Password" aria-describedby="Confirm Password" placeholder="Confirm Password">
            </div>  
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger p-1">Save changes</button>
      </div>
    </div>
  </div>
</div>
		<div id="app">

			

			<main role="main">

				

				



				

				<script>

					(function(w, d){

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

								callback_error: function(element) {

									element.src = "https://placeholdit.imgix.net/~text?txtsize=21&txt=Image%20not%20load&w=200&h=200";

								}

							};

						s.type = 'text/javascript';

						s.async = false; // This includes the script as async. See the "recipes" section for more information about async loading of LazyLoad.

						s.src = "https://cdn.jsdelivr.net/npm/vanilla-lazyload@" + v + "/dist/lazyload.min.js";

						m.appendChild(s);

						// m.insertBefore(s, m.firstChild);

						w.lazyLoadOptions = o;

					}(window, document));

				</script>



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

							<a href="#"><img src="{{asset('img/site_logo/logo_5.png')}}" style="width: 300px; margin: 0 auto; margin-bottom:100px"></a>

						</div>

							<form action="" method="post">

      

						       <div class="input-wrp">

										<input class="textfield textfield--grey" placeholder="user name" name="name" type="text">

								</div>

						       <div class="input-wrp">

										<input class="textfield textfield--grey" placeholder="password" name="name" type="password">

								</div>

						       <button class="custom-btn custom-btn--medium custom-btn--style-1 wide" type="submit" role="button" data-toggle="modal" data-target="#otp-modal" href="#" style="width:100%;margin-bottom:30px;">Get Started</button>    

						        <a href="#" id="forgot_pswd" data-toggle="modal" data-target="#exampleModal">Forgot password?</a>  <a href="{{url('login')}}" id="forgot_pswd" style=" float: right; ">Don`t Have Account?</a>  

						    </form>

						</div>

						<div class="col-md-4"></div>

					</div>

				</div>

			</section>

				<section class="find-enter-email my-acount-otp-mt">

					<div class="container">

						<div class="row">

							<div class="col-md-2 col-sm-2"></div>

							<div class="col-md-6 col-sm-6">

								<div class="modal text-center log-popup" id="otp-modal" tabindex="-1" role="dialog">

							<div class="modal-dialog input-m-0" role="document">

								<div class="modal-content bodr-none">



									<input class="my-otp" type="text" name="login opt" placeholder="Enter Otp...">



								<div class="modal-footer">

								<a href=""  class="btn btn-default btn-block btn-lg btn-dfault-amt otp-submit">Verify</a>

							    </div>

							    <p></p>

						        </div>

					            </div>

				            </div>

							</div>

							<div class="col-md-4 col-sm-4"></div>

						</div>

					</div>

				</section>

				

			</main>

		</div>



		<div id="btn-to-top-wrap">

			<a id="btn-to-top" class="circled" href="javascript:void(0);" data-visible-offset="800"></a>

		</div>



		<script src="js/jquery.min.js"></script>

		



		<script src="{{asset('js/bootstrap.min.js')}}" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

		<script type="text/javascript" src="{{asset('js/health.js')}}"></script>



		<script type="text/javascript" src="{{asset('js/main.min.js')}}"></script>

		

	</body>





</html>