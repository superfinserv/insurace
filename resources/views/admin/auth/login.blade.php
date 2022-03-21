<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- Required meta tags -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{asset('admin/images/favicon.png')}}" />

    <title>Administrator</title>

    <!-- vendor css -->
    <link href="{{asset('admin/lib/%40fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin//lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet">

    <!-- Bracket CSS -->
    <link rel="stylesheet" href="{{asset('admin/css/bracket.css')}}">
    <style>
        .error{
            color: red;
            font-size: 12px;
        }
    </style>
  </head>

  <body>

    <div class="d-flex align-items-center justify-content-center ht-100v">
      <img src="{{asset('/admin/images/loginbg.jpg')}}" class="wd-100p ht-100p object-fit-cover" alt="">
      <div class="overlay-body bg-black-6 d-flex align-items-center justify-content-center">
        <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 rounded bd bd-white-2 bg-black-7---" style="background-color: #fff;">
          <div class="signin-logo tx-center tx-28 tx-bold tx-white">
              <!--<span class="tx-normal">[</span> -->
              <!-- bracket <span class="tx-info">plus</span>-->
              <!--<span class="tx-normal">]</span>-->
              <img src="{{get_site_settings('site_logo')}}" class="wd-100p ht-100p object-fit-cover" alt="">
            </div>
          <div class="tx-black-5 tx-center mg-b-60 mg-t-10 ">Welcome Back to supersolutions.</div>
          
          <div id="loginResp"></div>
          <form method="POST" action="" id="loginAuth">
              @csrf
          <div class="form-group">
            <input id="email" type="email" style="border: 1px solid #0b0b0b;color: black;" class="form-control fc-outline-dark @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
          </div><!-- form-group -->
          <div class="form-group">
           <input id="password" style="border: 1px solid #0b0b0b;color: black;" type="password" class="form-control fc-outline-dark @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
            @error('password')
               <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                                @enderror
            <a href="#" class="tx-info tx-12 d-block mg-t-10 app-color">Forgot password?</a>
          </div><!-- form-group -->
          <button type="submit" class="btn btn-info btn-block app-btn">Sign In</button>
           </form>
          <div class="mg-t-60 tx-center">Copyright © {{date('Y')}}. <br/><a href="#" class="tx-info app-color">Supersolutions Advisory Services Pvt Ltd.</a> <br/> All Rights Reserved</div>
        </div><!-- login-wrapper -->
      </div><!-- overlay-body -->
    </div><!-- d-flex -->

    <script src="{{asset('/admin/lib/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('/admin/lib/validation/jquery.validate.min.js')}}"  type="text/javascript"></script>
    <script src="{{asset('/admin/lib/jquery-ui/ui/widgets/datepicker.js')}}"></script>
    <script src="{{asset('/admin/lib/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
      <script> var base_url = "{{url('/')}}"; </script>  
<script>
    $(document).ready(function(){
    'use strict';
     var _token = $('meta[name="csrf-token"]').attr('content'); 
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': _token
            }
        });
      $("#loginAuth").validate({   

        rules: {
            
            'email':{
                required: true,
                email:true,
            },
            'password':{
                required: true,
            }
            
        },
        messages: {
           
            'email':{
                required: "Email address is required!",
                email:"Enter valid email address.",
            },
            'password':{
                required: "Password is required!",
            }
            
        },

        submitHandler: function (form) {
           var mobileno=$('#mobile').val();
            $.ajax({
                type: "POST",
                url: base_url + "/login/",
                data: $(form).serialize(),
                dataType:'json',
               
                success: function (data) {
                    console.log(data);
                     var str = $.trim(data.status);
                     if(str == 'success'){
                        $('#loginResp').html('<div class="alert alert-bordered alert-success" role="alert" style="padding: 9px 12px;position: relative;font-size: 12px;">'
                                         +'Authentication success. Redirecting...'
                                    +'</div>');
                                    
                        setTimeout(function(){ window.location.href=base_url+'/home' }, 3000);
                    }else{
                         $('#loginResp').html('<div class="alert alert-bordered alert-danger" role="alert" style="padding: 9px 12px;position: relative;font-size: 12px;">'
                                         +'Invalid email or password!'
                                    +'</div>');
                    }
                },
                error: function () { }
            });
            return false;
        }
    });
    })
</script>
  </body>
</html>
