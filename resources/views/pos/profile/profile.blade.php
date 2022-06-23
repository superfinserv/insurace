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
    width: 200px;
    height:200px;
    image-rendering: auto;
    vertical-align: middle;
    border-style: none;
    /*border: 2px solid #ab0f0a;*/
    /*border-radius: 9px;*/
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
.ss-label-success{
    float: right;font-size: 15px;border: 1px solid #ac0f0b;background: #ac0f0b;color: #fff;padding: 4px 6px;font-family: monospace;
}
.ss-label-warning{
    float: right;font-size: 15px;border: 1px solid #FF5722;background:#FF5722;color: #fff;padding: 4px 6px;font-family: monospace;
}

.form-control {
    height: 30px !important;
    font-size: 12px !important;
    font-weight: 700;
}
/*.form-group.is-success:after, */
/*.form-group.is-error:after{*/
/*    content: '';*/
/*    position: absolute;*/
/*    right:10px;*/
/*    top: 27px;*/
/*    width: 32px;*/
/*    height: 32px;*/
/*    background: url(/site_assets/img/input-icons.png) no-repeat;*/
/*}*/
/*.form-group.is-error:after {*/
/*    background-position: 0 -79px;*/
/*}*/
.myprofile{
    font-size: 13px;
}

  .has-success .form-control {
    border-color: #3c763d;
    -webkit-box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%);
    box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%);
}
.has-feedback .form-control {
    padding-right: 30.5px;
}
 .has-feedback .form-control-feedback {
    right: 5px;
}
.has-success .form-control-feedback {
    color: #3c763d;
}
.form-control-feedback {
    position: absolute;
    top: 29px ;
    right: 0;
    z-index: 2;
    display: block;
    width: 34px;
    height: 34px;
    line-height: 34px;
    text-align: center;
    pointer-events: none;
}

@keyframes spinner {
  to {transform: rotate(360deg);}
}
 
.spinner:before {
  content: '';
  box-sizing: border-box;
  position: absolute;
  top: 50%;
  left: 50%;
  width: 20px;
  height: 20px;
  margin-top: -10px;
  margin-left: -10px;
  border-radius: 50%;
  border: 2px solid #ccc;
  border-top-color: #000;
  animation: spinner .6s linear infinite;
}

.profile-page-title{
    color: #C52118;
    text-align: center;
    font-size: 20px;
    font-weight: 700
}

@media only screen and (max-width: 600px) {
  .tab-nav__link .nav-title {
      display:none;
  }
  
  .tab-container .tab-nav{
      margin-left:0px !important;
  }
  
  /*.tab-nav .tab-nav__item.active{*/
  /*    width: 15% !important;*/
  /*}*/
  .tab-nav .tab-nav__item{
      width: 14% !important;
      padding: 8px !important;
  }
  .tab-nav__link .ribbon{
      display:none;
  }
  .tab-nav__link .fa.nav-done{
      color:#0E3679;
  }
  .tab-nav__link .fa.nav-required{
      color:#c1ac17;
  }
  
}

.profile-input-upload:hover{
   cursor: pointer;
}
      </style>
    <main role="main">
 
      <section class="become-an-insurance">
               <div class="container">
                  <div class="row ">
                      @if(Auth::guard('agents')->user()->userType=="POSP")
                      <div class="col-12 alert-section" style="">
                           <?php  if($data['iscomplete']==0 && $agent->isProceedSign=='No' && $agent->payment_status=='Pending'){?> 
                               <div class="myprofile alert-profile-complete"  style="background: #fff;border: 1px solid #ac0f0a;color: #aa0f0a;margin: 10px 0px;    padding: 15px 48px;    box-shadow: 0px 1px 5px 0px rgba(0,0,0,0.2), 0px 2px 2px 0px rgba(0,0,0,0.14), 0px 3px 1px -2px rgba(0,0,0,0.12);border-radius: 10px;">
                                  <span><strong>Alert! </strong> Profile Information is not Complete. Fill all required details to get paid quickly.</span>
                               </div>
                           <?php }?>
                           
                           <?php  if($data['iscomplete']==1 && $agent->isProceedSign=='No' && $agent->payment_status=='Pending') { ?>
                            <div class="myprofile alert-process-payment" style="background: #fff; border: 1px solid #ac0f0a;color: #aa0f0a;margin: 10px 0px;    padding: 15px 48px;    box-shadow: 0px 1px 5px 0px rgba(0,0,0,0.2), 0px 2px 2px 0px rgba(0,0,0,0.14), 0px 3px 1px -2px rgba(0,0,0,0.12);border-radius: 10px;">
                              <span><strong>Congratulations! </strong> Profile Information is Complete. Proceed for the Payment of the Application fee. <i style="font-size: 16px;" class="fa fa-hand-o-right"></i></span>
                             <button type="submit" class="btn btn-primary"style=" background:  #2f3c46 !important; float: right !important; padding: 8px 10px !important; border-radius: 3px !important; box-shadow: 0 16px 24px 2px rgba(0, 0, 0, .14), 0 6px 30px 5px rgba(0, 0, 0, .12), 0 8px 10px -5px rgba(0, 0, 0, .2) !important; margin-top:-10px !important; border: 0px !important; color: #fff !important; font-size: 15px !important;text-transform: uppercase;font-weight: bold;" id="payment_process">Pay now <span class="fa fa-arrow-right"></span></button>
                           </div>
                           
                          <?php  } ?>
                       
                        <?php  if($data['iscomplete']==1 && $agent->isProceedSign=='No' && $agent->payment_status=='Paid') {?>
                            <div class="myprofile alert-process-verification" style="background: #fff; border: 1px solid #ac0f0a;color: #aa0f0a;margin: 10px 0px;    padding: 15px 48px;    box-shadow: 0px 1px 5px 0px rgba(0,0,0,0.2), 0px 2px 2px 0px rgba(0,0,0,0.14), 0px 3px 1px -2px rgba(0,0,0,0.12);border-radius: 10px;">
                              <span><strong>Congratulations! </strong>You have paid application fee successfully. please proceed for verification, after verification you can not  update any details.</span>
                             <button type="submit" class="btn btn-primary"style=" background: #2f3c46 !important; float: right !important; padding: 8px 10px !important; border-radius: 3px !important; box-shadow: 0 16px 24px 2px rgba(0, 0, 0, .14), 0 6px 30px 5px rgba(0, 0, 0, .12), 0 8px 10px -5px rgba(0, 0, 0, .2) !important; margin-top:-4px !important; border: 0px !important; color: #fff !important; font-size: 15px !important;text-transform: uppercase;font-weight: bold; " id="sing_process_video">Proceed <span class="fa fa-arrow-right"></span></button>
                           </div>
                       <?php  } ?>
                       
                        <?php  if($data['iscomplete']==1 && $agent->isProceedSign=='Yes' && $agent->payment_status=='Yes') {?>
                            <div class="myprofile alert-process-verification" style="background: #fff; border: 1px solid #ac0f0a;color: #aa0f0a;margin: 10px 0px;    padding: 15px 48px;    box-shadow: 0px 1px 5px 0px rgba(0,0,0,0.2), 0px 2px 2px 0px rgba(0,0,0,0.14), 0px 3px 1px -2px rgba(0,0,0,0.12);border-radius: 10px;">
                              <span><strong>Congratulations! </strong>You have completed the POSP Application with Super Finserv. We will check the records in IIB and will let you the the future course of action. We will refund your application & training fee in case we find your records in IIB with any other Insurer/Intermediary. Super Finserv reserves the right to select or reject the application..</span>
                            </div>
                       <?php  } ?>
                          
                     </div>
                     @endif
                  <?php //print_r($data);?>
                     <div class="">
                         <div class="col-md-12 col-sm-12 myprofile">
                             <p class="profile-page-title">My Profile</p>
                             
                           </div>
                     
                        <div class="steps steps--s2">
                           <div class="tab-container profile row">
                              <div class=" col-md-3 col-sm-12">
                              <ul class="tab-nav">
                                 <li class="tab-nav__item active">
                                   
                                    <a class="tab-nav__link" href="javascript:void(0);"> 
                                      <div class="ribbon ribbon-top-left personal-section"> 
                                          <?php if($data['personal']==100){?>
                                             <span>Done</span>
                                          <?php }else{ ?> 
                                             <span class="required">Required</span> 
                                          <?php }?>
                                      </div>
                                    <i class="fa fa-user  <?=($data['personal']==100)?'nav-done':'nav-required';?>"></i> 
                                    <span class="nav-title">Personal Detail</span>
                                    </a>
                                 </li>
                                 <li class="tab-nav__item">
                                    <a class="tab-nav__link " href="javascript:void(0);">
                                      <div class="ribbon ribbon-top-left education-section"> 
                                          <?php if($data['education']==100){?>
                                          <span>Done</span>
                                          <?php }else{ ?> 
                                            <span class="required">Required</span> 
                                          <?php }?>
                                      </div>
                                      <i class="fa fa-graduation-cap <?=($data['education']==100)?'nav-done':'nav-required';?>" ></i> <span class="nav-title">Education Detail</span>
                                    </a>
                                 </li>
                                 <li class="tab-nav__item">
                                    <a class="tab-nav__link" href="javascript:void(0);">
                                      <div class="ribbon ribbon-top-left bank-section"> 
                                          <?php if($data['bank']==100){?>
                                          <span>Done</span>
                                          <?php }else{ ?> 
                                            <span class="required">Required</span> 
                                          <?php }?>
                                      </div>
                                      <i class="fa fa-bank <?=($data['bank']==100)?'nav-done':'nav-required';?>"></i> <span class="nav-title">Bank Detail</span></a>
                                 </li>
                                 <li class="tab-nav__item">
                                    <a class="tab-nav__link" href="javascript:void(0);">
                                      <div class="ribbon ribbon-top-left document-section"> 
                                          <?php if($data['document']==100){?>
                                          <span>Done</span>
                                          <?php }else{ ?> 
                                            <span class="required">Required</span> 
                                          <?php }?>
                                      </div>
                                      <i class="fa fa-file <?=($data['document']==100)?'nav-done':'nav-required';?>"></i><span class="nav-title">Documents</span></a>
                                 </li>
                                 <?php /*
                                  <li class="tab-nav__item">
                                    <a class="tab-nav__link" href="javascript:void(0);"><i class="fa fas fa-briefcase"></i> <span class="nav-title">Business information</span></a>
                                 </li>
                                 */?>
                              </ul>
                              </div>
                               <div class=" col-md-9 col-sm-12">
                              <div class="tab-content" style="overflow: unset;">
                                 <div class="tab-content__item is-visible">
                                    <div class="__item">
                                       <h3 class="h2"><i class="fa fa-user" style="font-size: 20px;color: #ac0f0a; padding-right: 10px; " ></i>Personal Information</h3>
                                        @include('pos.profile.agent_personalInfo')
                                    </div>
                                 </div>

                                 <div class="tab-content__item">
                                    <div class="__item">
                                      <h3 class="h2"><i class="fa fa-graduation-cap" style="font-size: 20px;color: #ac0f0a; padding-right: 10px; "></i>Education Detail</h3>
                                        @include('pos.profile.agent_educationalInfo')
                                    </div>
                                 </div>

                                 <div class="tab-content__item">
                                    <div class="__item">
                                        <h3 class="h2"><i class="fa fa-bank" style="font-size: 20px;color: #ac0f0a; padding-right: 10px; "></i>Bank Details 
                                           <!--<span class="ss-label-success">-->
                                           <!--  <i class="fa fa-check-square-o "></i> Verified by account-->
                                           <!--</span>-->
                                        </h3>
                                        
                                        @include('pos.profile.agent_bankInfo')
                                    </div>
                                 </div>

                                 <div class="tab-content__item">
                                    <div class="__item">
                                       <h3 class="h2"><i class="fa fa-file" style="font-size: 20px;color: #ac0f0a; padding-right: 10px; "></i> Upload Document</h3>
                                        @include('pos.profile.agent_documentInfo')
                                    </div>
                                 </div>
                                 <?php /*
                                 <div class="tab-content__item">
                                    <div class="__item">
                                       <h3 class="h2"><i class="fa fa-briefcase" style="font-size: 20px;color: #ac0f0a; padding-right: 10px; "></i>Update Business information</h3>
                                        @include('pos.profile.agent_businessInfo')
                                    </div>
                                 </div>
                                */ ?>
                              </div>
                           </div>
                        </div>
                        <!-- end steps -->

                     </div>
                     </div>
                  </div>
               </div>
        </section>
           
      </main>
     
     
     @endsection
