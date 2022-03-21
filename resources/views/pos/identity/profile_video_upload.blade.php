 @extends('pos.layouts.app')
    @section('content')
    <style type="text/css">
    select, input[type="file"] {
     height:inherit !important; 
    line-height:inherit !important;
}

input[type="file" i]:after {
    transition: 200ms all ease;
    border-bottom: 3px solid rgba(0,0,0,.2);
    background: #3c5ff4;
    text-shadow: 0 2px 0 rgba(0,0,0,.2);
    color: #fff;
    font-size: 20px;
    text-align: center;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: block;
   
    line-height: 60px;
    border-radius: 5px;
}
.myprofile {
    /* padding: 15px 0px; */
    padding-top: 20px;
    padding-bottom: 25px;
}

.select2-search__field{
      padding: 08px 10px !important;
    font-size: 15px !important;
}
 
.ribbon::before,
.ribbon::after {
  position: absolute;
  z-index: -1;
  content: '';
  display: block;
  border: 5px solid #2980b9;
}
#upload-profile-button {
    color: #fff !important;
    background-color: #dc3545;
    border-color: #dc3545;
    font-size: 16px;
    font-weight: 600;
    text-align: center;
}
#upload-profile-button .fa{
  font-size: 18px
}
/* top left*/

.ribbon-top-left::before,
.ribbon-top-left::after {
  border-top-color: transparent;
  border-left-color: transparent;
}
.ribbon-top-left::before {
  top: 0;
  right: 0;
}
.ribbon-top-left::after {
  bottom: 0;
  left: 0;
}

.ribbon {
    width: 150px;
    height: 150px;
    overflow: hidden;
    position: absolute;
}
.ribbon-top-left {
    top: 0px;
    left: 0px;
}
.ribbon-top-left span {
    right: 0px;
    top: 12px;
    transform: rotate(-45deg);
}
.ribbon span {
    position: absolute;
    display: block;
    width: 266px;
    padding: 3px 0;
    background-color: #288810;
    box-shadow: 0 5px 10px rgba(0,0,0,.1);
    color: #fff;
    font: 700 10px/1 'Lato', sans-serif;
    text-shadow: 0 1px 1px rgba(0,0,0,.2);
    /* text-transform: uppercase; */
    text-align: center;
}
.ribbon .required {
   
    background-color: #fffefd !important;
  
    color: #923c13 !important;
  
}
.customerProfileImage {
    width: 120px;
    height: 125px;
    image-rendering: auto;
    vertical-align: middle;
    border-style: none;
        border: 1px solid #000;
}
.rounded-pill {
    border-radius: 50rem!important;
}
.p-image {
    position: relative;
       text-align: center;
    color: #ffc751;
    transition: all .3s cubic-bezier(.175, .885, .32, 1.275);
    cursor: pointer;
}
.file-upload {
    display: none !important;
}
      </style>
<main role="main">
  <section class="become-an-insurance">
    <div class="container find-con">
        <div class="row ">
           <div class="col-md-12 text-center">
                <h3 class="h2" style="font-weight: 700;font-size: 30px;color:#C52118;letter-spacing: 1px;">Video Verification</h3>
                           
                 <div class="row">
                    <div class="col-xs-12 col-md-12" >

                                   <h3 class="h2" style="padding:15px;letter-spacing: 2px;font-weight: 600;">CAPTURE VIDEO FOR IDENTITY VERIFICATION</h3>
                                    <p style="padding-left: 15%;padding-right: 15% "> Please proceed for video verification - You have to Say "I am applying for POSP Certification with {{config('custom.site_name')}}" By holding a valid ID Card. </p>
                                    <p style="padding-left: 15%;padding-right: 15%;  padding-bottom: 35px;">By continuing you agree to share the your details with {{config('custom.site_short_name')}}. You also agree to {{config('custom.site_short_name')}} <a style="color:#ff6833 !important" target="_blank" href="{{url('/terms-conditions')}}">Terms and Conditions</a>.</p>
                                 </div>
                 </div>
                 
                 <div class="row">
                    <div class="col-md-4" ></div>
                      
                    <div class="col-md-2 text-center" >
                        <a id="upload-profile-video" class="btn btn-primary pull-left" 
                           style="text-align:center; background: #2d3a49 !important;  padding: 5px 15px !important; border-radius: 3px !important;
                                  box-shadow: 0 16px 24px 2px rgba(0, 0, 0, .14), 0 6px 30px 5px rgba(0, 0, 0, .12), 0 8px 10px -5px rgba(0, 0, 0, .2) !important; 
                                  margin-top: 0px !important; border: 0px !important; color: #fff !important; font-size: 16px !important; ">Choose Video</a>
                        <form action="#" method="post" enctype="multipart/form-data" id="upload-customer-profile-video">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                            <input class="file-uploads" name="identityVideo" id="identityVideo" type="file" accept="video/*" style="display: none">
                        </form>
                     </div>
                      
                    <div class="col-md-2" ><button class="btn btn-success" id="upload-video-btn" style="font-size: 16px;">upload</button></div>
                    <div class="col-md-4"></div>
                </div>
                <div class="row" id="myprogress-container" style=" margin-top: 15px;display:none;">
                     <div class="col-md-3 col-sm-12 col-xs-12"></div>
                     <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="progress" style="height: 22px;">
                              <div class="myprogress progress-bar progress-bar-success" role="progressbar" aria-valuenow="0"
                              aria-valuemin="0" aria-valuemax="100" style="width:0%;font-size: 12px;">
                                uploading...
                              </div>
                            </div>
                    </div>
                    <div class="col-md-3 col-sm-12 col-xs-12"></div>
                </div>
                
                <div class="row">
                    <div class="col-md-3 col-sm-12 col-xs-12"></div>
                     <div class="col-md-6 col-sm-12 col-xs-12" id="identity-notify" style="margin-top: 12px;">
                        
                     </div>
                     <div class="col-md-3 col-sm-12 col-xs-12"></div>
                 </div>
              </div>
                 
        </div>
    </div>
  </section>
</main>
     
     
     @endsection
