@extends('pos.layouts.app')
  @section('content')
  
  <style>
     .steps--s2 .image-box .br-section-wrapper{
              box-shadow: 0px 1px 5px 0px rgba(0,0,0,0.2), 0px 2px 2px 0px rgba(0,0,0,0.14), 0px 3px 1px -2px rgba(0,0,0,0.12);
            text-align: center;
            border-radius: 10px;
            padding: 15px;
            background-color: #f8f9fa;
            width: 100%;
      }
      
       
      
      .steps--s2 .image-box .br-section-wrapper img{
         width: 40px;
    height: 45px;
      }
      
      .steps--s2 .image-box .br-section-wrapper p{
          font-size: 15px;
          color: #AC0F0B;
      }
      
      .steps--s2 .image-box .br-section-wrapper:hover{
           cursor:pointer;
       }
       
    /*  .steps--s2 .tab-nav__link:hover {*/
    /*background: #AC0F0B;*/
    /*transition: -0.5s;*/
    /*color: #fff !important;*/
    /*  }*/
    @media only screen and (max-width: 600px) {
     .col-sm-4 {
        width: 50%;
     }
    }
 .ribbon-wrapper-red {
  width: 50px;
height: 50px;
overflow: hidden;
position: absolute;
top: 0px;
right: 16px;

}
.ribbon-red {
    font: bold 15px Sans-Serif;
    color: #fff;
    text-align: center;
    text-shadow: rgba(255,255,255,0.5) 0px 1px 0px;
    -webkit-transform: rotate(45deg);
    -moz-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    -o-transform: rotate(45deg);
    position: relative;
    padding: 2px 0;
left: -10px;
top: 15px;
width: 75px;
    background-color: #ea181e;
    background-image: -webkit-gradient(linear, left top, left bottom, from(#ea181e), to(#b90005));
    background-image: -webkit-linear-gradient(top, #ea181e, #b90005);
    background-image: -moz-linear-gradient(top, #BFDC7A, #8EBF45);
    background-image: -ms-linear-gradient(top, #BFDC7A, #8EBF45);
    background-image: -o-linear-gradient(top, #BFDC7A, #8EBF45);
    color: #fff;
    -webkit-box-shadow: 0px 0px 3px rgba(0,0,0,0.3);
    -moz-box-shadow: 0px 0px 3px rgba(0,0,0,0.3);
    box-shadow: 0px 0px 3px rgba(0,0,0,0.3);
}
  </style>
    <main role="main">
        <section class="become-an-insurance" style="background:unset";>
            <div class="container">
                <div class="row ">
                      @if(Auth::guard('agents')->user()->userType=="POSP")
                        @if($status!='Inforce')
                        <div class="col-md-12 col-sm-12">
                            <div class="myprofile alert-profile-complete"  style="background: #fff;border: 1px solid #ac0f0a;color: #aa0f0a;margin: 10px 0px;    padding: 15px 48px;    box-shadow: 0px 1px 5px 0px rgba(0,0,0,0.2), 0px 2px 2px 0px rgba(0,0,0,0.14), 0px 3px 1px -2px rgba(0,0,0,0.12);border-radius: 10px;">
                              <span><strong>Alert! </strong> Please complete your POSP certification.</span>
                           </div>
                        </div>
                        @endif
                    @else
                        @if($status!='Inforce')
                            <div class="col-md-12 col-sm-12">
                                <div class="myprofile alert-profile-complete"  style="background: #fff;border: 1px solid #ac0f0a;color: #aa0f0a;margin: 10px 0px;    padding: 15px 48px;    box-shadow: 0px 1px 5px 0px rgba(0,0,0,0.2), 0px 2px 2px 0px rgba(0,0,0,0.14), 0px 3px 1px -2px rgba(0,0,0,0.12);border-radius: 10px;">
                                  <span><strong>Alert! </strong> Your profile is in {{$status}} state.</span>
                               </div>
                            </div>
                            @endif
                    @endif
                    <?php  $isPass =($status==='Inforce')?true:false;?>
                      <div class="col-12">
                         <div class="col-md-12 col-sm-12 myprofile section-heading">
                             <h2 style="color: #003379;font-size: 18px;margin-bottom: 0;letter-spacing: 0.5px;font-weight: 700;">Live Products</h2>
                        </div>
                        
                        <div class="steps steps--s2">
                          <div class="container ">
                            <div class="create row">
                                  <a href="@if($isPass) {{url('/health-insurance/health-profile')}} @else {{url('#')}} @endif"  class="col-sm-4 col-md-2 mb-3 tx-center image-box" data-toggle="tooltip" data-placement="top" title="Health Insurance">
                                        <div class="br-section-wrapper pd-10 bg-gray-100">
                                           <i class="fa fa-heartbeat" aria-hidden="true" style="color: #AC0F0B;"></i>
                                           <p>Mediclaim</p>
                                        </div><!-- br-section-wrapper -->
                                  </a>
                                  
                                  <a href="@if($isPass) {{url('/twowheeler-insurance/registration-number')}} @else {{url('#')}} @endif"  class="col-sm-4 col-md-2 mb-3 tx-center image-box" data-toggle="tooltip" data-placement="top" title="2w Insurance">
                                        <div class="br-section-wrapper pd-10 bg-gray-100">
                                           <i class="fa fa-motorcycle" aria-hidden="true" style="color: #AC0F0B;"></i>
                                           <p>2w</p>
                                        </div><!-- br-section-wrapper -->
                                  </a>
                                  
                                  <a href="@if($isPass) {{url('/car-insurance/registration-number')}} @else {{url('#')}} @endif"  class="col-sm-4 col-md-2 mb-3 tx-center image-box" data-toggle="tooltip" data-placement="top" title="Car Insurance">
                                        <div class="br-section-wrapper pd-10 bg-gray-100">
                                           <i class="fa fa-car" aria-hidden="true" style="color: #AC0F0B;"></i>
                                           <p>Car</p>
                                        </div><!-- br-section-wrapper -->
                                  </a>
                            </div>
                          </div>
                        </div>
                        
                     </div>
                     
                     <div class="col-12">
                         <div class="col-md-12 col-sm-12 myprofile section-heading">
                             <h2 style="color: #003379;font-size: 18px;margin-bottom: 0;letter-spacing: 0.5px;font-weight: 700;">Coming Soon</h2>
                        </div>
                        
                        <div class="steps steps--s2">
                          <div class="container ">
                            <div class="create row">
                                  <a href="#"  class="col-sm-4 col-md-2 mb-3 tx-center image-box" data-toggle="tooltip" data-placement="top" title="#">
                                        <div class="br-section-wrapper pd-10 bg-gray-100">
                                           <i class="fa fa-bus" aria-hidden="true" style="color: #AC0F0B;"></i>
                                           <p>Bus</p>
                                        </div><!-- br-section-wrapper -->
                                  </a>
                                  
                                  <a href="#"  class="col-sm-4 col-md-2 mb-3 tx-center image-box" data-toggle="tooltip" data-placement="top" title="#">
                                        <div class="br-section-wrapper pd-10 bg-gray-100">
                                           <i class="fa fa-medkit" aria-hidden="true" style="color: #AC0F0B;"></i>
                                           <p>Super Topup</p>
                                        </div><!-- br-section-wrapper -->
                                  </a>
                                  
                                   <a href="#"  class="col-sm-4 col-md-2 mb-3 tx-center image-box" data-toggle="tooltip" data-placement="top" title="#">
                                        <div class="br-section-wrapper pd-10 bg-gray-100">
                                           <i class="fa fa-plane" aria-hidden="true" style="color: #AC0F0B;"></i>
                                           <p>Travel</p>
                                        </div><!-- br-section-wrapper -->
                                  </a>
                                  
                                  <a href="#"  class="col-sm-4 col-md-2 mb-3 tx-center image-box" data-toggle="tooltip" data-placement="top" title="#">
                                        <div class="br-section-wrapper pd-10 bg-gray-100">
                                           <i class="fa fa-ambulance" aria-hidden="true" style="color: #AC0F0B;"></i>
                                           <p>Accidental</p>
                                        </div><!-- br-section-wrapper -->
                                  </a>
                                  
                                  <a href="#"  class="col-sm-4 col-md-2 mb-3 tx-center image-box" data-toggle="tooltip" data-placement="top" title="#">
                                        <div class="br-section-wrapper pd-10 bg-gray-100">
                                           <i class="fa fa-money" aria-hidden="true" style="color: #AC0F0B;"></i>
                                           <p>Savings</p>
                                        </div><!-- br-section-wrapper -->
                                  </a>
                            </div>
                          </div>
                        </div>
                        
                     </div>
                     
                     
                     
                  </div>

                  </div>

               </div>

            </section>

           

      </main>

      <style type="text/css">
.steps--s2 .create .__item {
    color: #333 !important;
}
.create i.fa ,.create i.fas{
    font-size: 40px;
    padding: 5px 10px;
}
.steps--s2 .tab-nav__link {
    /* color: inherit; */
    text-decoration: none;
    box-shadow: 0px 1px 5px 0px rgba(0,0,0,0.2), 0px 2px 2px 0px rgba(0,0,0,0.14), 0px 3px 1px -2px rgba(0,0,0,0.12);
    border-radius: 10px;
    text-align: center !important;
    padding: 15px;
    width: 100%;
    margin-bottom: 5px;
    background: #ffffff;
    color: #333 !important;
    border-color: #fff !important;
}
.steps--s2 .tab-nav__link:hover {
    background: #AC0F0B;
    transition: -0.5s;
    color: #fff !important;
}
.myprofile {

    /* padding: 15px 0px; */

    padding-top: 20px;

    padding-bottom: 25px;

}
input.select2-search__field{
  padding: 19px 10px !important;
  font-size: 15px !important;
}

.integer-mobile::-webkit-inner-spin-button, 
.integer-mobile::-webkit-outer-spin-button { 
-webkit-appearance: none; 
margin: 0; }
      </style>

     @endsection

