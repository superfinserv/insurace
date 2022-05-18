 @extends('pos.layouts.app')
    @section('content')
   
<main role="main">
    <style>
        .r-btn{
            background: #AC0F0B;
            color: #fff;
            border:1px solid  #AC0F0B;
            border-radius:5px;
        }
        .b-btn{
            background-color: #2f3c46;
            color: #fff;
            border:1px solid  #2f3c46;
            border-radius:5px;
        }
        .pagebtn{
            padding: 5px 25px;
            font-size: 15px;
            font-weight: 700;
        }
        
        .fa-upload{
            font-size: 15px !important;
        }
        
        .progress-elem{
            display:none;
            width: 70%;
            margin: auto;
            border: 1px solid #ccc;
            padding: 8px 10px;
            padding: 8px 10px;
            box-shadow: 0px 0px 3px #ccc;
            margin-top: 20px;
        }
    </style>
    
  <section class="become-an-insurance">
    <div class="container find-con">
        @if($agent_info->videoFile=="")
        <div class="row ">
           <div class="col-md-12 text-center">
               <h3 class="h2" style="font-weight: 700;font-size: 30px;color:#C52118;letter-spacing: 1px;">Video Verification</h3>
               <h3 class="h2" style="padding:15px;letter-spacing: 2px;font-weight: 600;">CAPTURE VIDEO FOR IDENTITY VERIFICATION</h3>
                <p style="padding-left: 15%;padding-right: 15%;font-size:15px; "> Please proceed for video verification - You have to Say "<b>I am applying for POSP Certification with {{config('custom.site_name')}}</b>" By holding a valid ID Card. </p>
                <p style="padding-left: 15%;padding-right: 15%;  padding-bottom: 35px;font-size:15px;">By continuing you agree to share the your details with {{config('custom.site_short_name')}}. You also agree to {{config('custom.site_short_name')}} <a style="color:#ff6833 !important" target="_blank" href="{{url('/terms-conditions')}}">Terms and Conditions</a>.</p>
             </div>
        </div>
        <div class="row ">
            	<div class="col-md-12" id="previewElem" style="text-align:center;">
            	    <video id="preview" autoplay muted=false width='100%' style="width:50%;border: 3px solid #ccc;"></video>
            	    <div class="text-center"> 
            	        <button id="startButton"  class="r-btn pagebtn">Start</button> 
            	        <button id="stopButton"  class="b-btn pagebtn">Stop</button> 
            	   </div>
            	</div>
            	<div class="col-md-12" id="recorded"  style="display:none;text-align:center;">
            		<video id="recording"  width='100%' style="width:50%;border: 3px solid #ccc;" controls playsinline autoplay muted=false volume=1></video>
            		
            		<div class="text-center" style="margin-bottom:5px;">
            		    <button id="NewStartButton"  class="b-btn pagebtn"  data-url="{{url('profile/video-upload')}}">Start New Recording</button>
            		 </div>
            		 
            		 <div style="width: 50%;margin: auto;border: 1px solid #ccc;padding: 10px 10px;box-shadow: 1px 3px 5px #ccc;">
                		    <h4 style="font-size: 20px;font-weight: 600;">You can upload recorded video</h4>
                		    <p style="margin: 10px 2px;font-size: 15px;">Click below button to upload recorded video and proceed for verification</p>
            		        <button id="downloadButton"  class="r-btn pagebtn"  data-url="{{url('profile/video-upload')}}"><i class="fa fa-upload"></i> UPLOAD</button> 
            		        
            		        <div class="progress-elem" id="progress-elem">
            		            <p id="PTxt" style="font-weight: 600;margin-bottom: 0px;font-size: 15px;">File:<span style="font-weight:200;">uploading...</span></p>
            		            <div class="progress" style="height:10px;margin-bottom: 0px;">
                                  <div class="myprogress progress-bar" role="progressbar" aria-valuenow="0"
                                       aria-valuemin="0" aria-valuemax="100" style="width:0%;">
                                  </div>
                                </div>
            		        </div>
            		         
            	     </div>
            		
            	</div>
        </div>
        @else
         <div class="row ">
           <div class="col-md-12 text-center">
               <h3 class="h2" style="font-weight: 700;font-size: 30px;color:#C52118;letter-spacing: 1px;">Video Verification</h3>
               <h3 class="h2" style="padding:15px;letter-spacing: 2px;font-weight: 600;">Your Profile is under verification status.</h3>
                 <a href="{{url('/profile')}}"  class="b-btn pagebtn">Back to Profile</a> 
            </div>
        </div>
        @endif
          
    </div>
  </section>
</main>
     
     
     @endsection
