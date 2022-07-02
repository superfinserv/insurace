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
main p {
    margin: 10px 0px;
}
      </style>
       <?php $assetRoot = "https://supersolutions.in/insassets/";?>
<main role="main">
  <section class="become-an-insurance">
    <div class="container find-con">
        <div class="row ">
           <div class="col-md-12">
                        <div class="card">

                            <div class="card-header">

                               <h3 class="h2">Personal Information</h3>
                            </div>

                            <div class="card-body">

                              <div class="row">
                                 <div class="col-xs-2 col-md-2" >

                                    <img src="{{asset('assets/agents/profile/'.$agent_info->profile)}}" style=" height: 160px; width: 150px; ">
                                 </div>
                                <div class="col-xs-5 col-md-5" >

                                    <p><span class="fa fa-user">  </span>  Name : {{$agent_info->name}}</p>
                                    <p><span class="fa fa-envelope">  </span> Email : {{$agent_info->email}}</p>
                                    <p><span class="fa fa-phone">  </span>  Mobile No: {{$agent_info->mobile}}</p>
                                    <p><span class="fa fa-mars-stroke">  </span> Gender : {{$agent_info->sex}}</p>
                                    <p> <span class="fa fa-male">  </span> Marital status : {{$agent_info->marital_status}}</p>
                                 </div>
                                 <div class="col-xs-5 col-md-5" >

                                    <p><span class="fa fa-compass">  </span> Address : {{$agent_info->address}}</p>
                                    <p><span class="fa fa-compass">  </span>  City : {{$agent_info->city_name}}</p>
                                    <p><span class="fa fa-compass">  </span>  State : {{$agent_info->state_name}}</p>
                                    <p><span class="fa fa-compass">  </span>  Pincode : {{$agent_info->pincode}}</p>
                                 </div>
                                
                          </div>

                           </div>
                      </div>
                       <div class="card">

                            <div class="card-header">

                               <h3 class="h2">Education Information</h3>
                            </div>

                            <div class="card-body">

                              <div class="row">
                                 <div class="col-xs-12 col-md-12" >

                                    <p><span class="fa fa-graduation-cap">  </span> Qualification  : {{$agent_info->educational_qualification}}</p>
                                    
                                 </div>
                                
                              </div>

                           </div>
                      </div>
                       <div class="card">

                            <div class="card-header">

                               <h3 class="h2">Bank Information</h3>
                            </div>

                            <div class="card-body">

                              <div class="row">
                                 <div class="col-xs-3 col-md-3">

                                    <p><span class="fa fa-university">  </span> Bank Name  : {{$agent_info->bank_name}}</p>
                                    
                                 </div>
                                 <div class="col-xs-3 col-md-3">

                                    <p><span class="fa fa-user">  </span> Account Holder  : {{$agent_info->account_holder_name}}</p>
                                    
                                 </div>
                                 <div class="col-xs-3 col-md-3" >

                                    <p><span class="fa fa-check">  </span> A/C Number : {{$agent_info->account_number}}</p>
                                    
                                 </div>
                                 <div class="col-xs-3 col-md-3" >

                                    <p><span class="fa fa-calendar-o">  </span> IFSC Code  : {{$agent_info->ifsc_code}}</p>
                                    
                                 </div>
                              </div>

                           </div>
                      </div>
                       <div class="card">

                            <div class="card-header">

                               <h3 class="h2">Document Information</h3>
                            </div>

                            <div class="card-body">

                              <div class="row">
                                 <div class="col-xs-12 col-md-12">

                                    <p><span class="fa fa-id-card ">  </span> Pan Card  : {{$agent_info->pan_card_number}}</p>
                                    
                                 </div>
                                 <div class="  col-md-12">

                                    <p><span class="fa fa-id-card">  </span> Adhaar Card  : {{$agent_info->adhaar_card_number}}</p>
                                    
                                 </div>
                              </div>

                           </div>
                      </div>
                      <div class="row">
                             <div class="col-lg-6 col-xl-6  col-md-6 col-sm-6 col-xs-6">
                              <a href="{{url('/profile')}}" class="btn btn-primary" style=" background: #2d3a49 !important;  padding: 5px 15px !important; border-radius: 3px !important; box-shadow: 0 16px 24px 2px rgba(0, 0, 0, .14), 0 6px 30px 5px rgba(0, 0, 0, .12), 0 8px 10px -5px rgba(0, 0, 0, .2) !important; margin-top: 0px !important; border: 0px !important; color: #fff !important; font-size: 16px !important; "><span class="fa fa-arrow-left"></span>    Back   </a>
                            </div>
                              <div class="col-lg-6 col-xl-6  col-md-6 col-xs-6" style="margin-top:5px;">
                              <a href="{{url('/profile/video-uploads')}}" class="btn btn-primary" style=" background: #ac0f0b !important; float: right !important; padding: 5px 15px !important; border-radius: 3px !important; box-shadow: 0 16px 24px 2px rgba(0, 0, 0, .14), 0 6px 30px 5px rgba(0, 0, 0, .12), 0 8px 10px -5px rgba(0, 0, 0, .2) !important; margin-top: 0px !important; border: 0px !important; color: #fff !important; font-size: 16px !important; ">Continue   <span class="fa fa-arrow-right"></span></a>
                            </div>
                    </div>
              </div>
                 
        </div>
    </div>
  </section>
</main>
     
     
     @endsection
