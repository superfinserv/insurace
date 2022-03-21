 @extends('web.layout.app')
    @section('content')
    <link rel="stylesheet" type="text/css" href="{{asset('/css/sign-in-style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/css/sign-in-theme.css')}}">
    <style>
        div#inputs input {
    /* padding: 18px; */
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

div#inputs input:focus {
        box-shadow: none;
        outline: 0;
}
    </style>
<main role="main" >
	<section class="section" >
	    <div class="form-body without-side" style="background-color: #01367c;">
      
        <div class="row">
           
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items" id="loginContainer" >
                        <h3>Login to account</h3>
                        <p>To sign in enter your mobile number below.</p>
                        {{ Form::open(array('url' => '#' ,'style'=>"margin: 0;",'class'=>"",'enctype'=>"multipart/form-data", 'id'=>"customerLoginForm",'method'=>"post" )) }}
                            <input class="form-control" id="mobile" type="text" name="mobile" placeholder="Mobile Number" required="">
                            
                            <div class="form-button">
                                <button id="sendOtpBtn" type="submit" class="ibtn">Send OTP to Login</button>
                            </div>
                        {{ Form::close()}}
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
					
	</section>
</main>
@endsection