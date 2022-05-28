<h3 style="color: #fff;font-size: 18px;margin-bottom: 0;letter-spacing: 0.5px;font-weight: 700;">Live Products</h3>

<?php $isLogin=(Auth::guard('customers')->user())?true:false;?>
<div class="row text-center">
   <div class="resp  col-sm-4 col-lg-3 col-xl-3 col-xs-4  col-4 pt-3 animate animated slideRight" style="padding-right: 10px;padding-left: 10px;">
         <a href="@if($isLogin) {{url('/health-insurance/health-profile')}} @else {{url('/health-insurance')}} @endif" class="home-box">
           <div class="__item __item--shadow itemBox circle circle1" style="border-radius:10%">  
                <div class="_header">
                    <i class="fa fa-heartbeat" aria-hidden="true"></i> 
                </div>
                <div class="_body">
                   <h3 class="__title" style="font-size: 11px;line-height: 14px;letter-spacing: 1px;font-weight: 600 !important;">Mediclaim</h3>
                </div>
            </div> 
          </a>
    </div>
    <div class="resp  col-sm-4 col-lg-3 col-xl-3 col-xs-4  col-4 pt-3 animate animated slideDown" style="padding-right: 10px;padding-left: 10px;">
         <a href="@if($isLogin) {{url('/twowheeler-insurance/registration-number')}} @else {{url('/twowheeler-insurance')}} @endif" class="home-box">
           <div class="__item __item--shadow itemBox circle circle1" style="border-radius:10%">  
                <div class="_header">
                    <i class="fa fa-motorcycle" aria-hidden="true"></i> 
                </div>
                <div class="_body">
                   <h3 class="__title" style="font-size: 11px;line-height: 14px;letter-spacing: 1px;font-weight: 600 !important;">2W</h3>
                </div>
            </div> 
          </a>
    </div>
    
    <div class="resp  col-sm-4 col-lg-3 col-xl-3 col-xs-4  col-4 pt-3 animate animated slideLeft" style="padding-right: 10px;padding-left: 10px;">
         <a href="@if($isLogin) {{url('/car-insurance/registration-number')}} @else {{url('/car-insurance')}} @endif" class="home-box">
           <div class="__item __item--shadow itemBox circle circle1" style="border-radius:10%">  
                <div class="_header">
                    <i class="fa fa-car" aria-hidden="true"></i> 
                </div>
                <div class="_body">
                   <h3 class="__title" style="font-size: 11px;line-height: 14px;letter-spacing: 1px;font-weight: 600 !important;">Car</h3>
                </div>
            </div> 
          </a>
    </div>
    
    
</div>
<br/>
<h3 style="color: #fff;font-size: 18px;margin-bottom: 0;letter-spacing: 0.5px;font-weight: 700;">Coming Soon</h3>
<div class="row text-center">

    
    
    
    
    
    
    <div class="resp  col-sm-4 col-lg-3 col-xl-3 col-xs-4  col-4 pt-3 animate animated slideUp" style="padding-right: 10px;padding-left: 10px;">
         <a href="#" class="home-box">
           <div class="__item __item--shadow itemBox circle circle1" style="border-radius:10%">  
                <div class="_header">
                    <i class="fa fa-bus" aria-hidden="true"></i> 
                </div>
                <div class="_body">
                   <h3 class="__title" style="font-size: 11px;line-height: 14px;letter-spacing: 1px;font-weight: 600 !important;">Bus</h3>
                </div>
            </div> 
          </a>
    </div>
    <div class="resp  col-sm-4 col-lg-3 col-xl-3 col-xs-4  col-4 pt-3 animate animated slideLeft" style="padding-right: 10px;padding-left: 10px;">
         <a href="#" class="home-box">
           <div class="__item __item--shadow itemBox circle circle1" style="border-radius:10%">  
                <div class="_header">
                    <i class="fa fa-medkit" aria-hidden="true"></i> 
                </div>
                <div class="_body">
                   <h3 class="__title" style="font-size: 11px;line-height: 14px;letter-spacing: 1px;font-weight: 600 !important;">SuperTopup</h3>
                </div>
            </div> 
          </a>
    </div>
    
    <div class="resp  col-sm-4 col-lg-3 col-xl-3 col-xs-4  col-4 pt-3 animate animated slideRight" style="padding-right: 10px;padding-left: 10px;">
         <a href="#" class="home-box">
           <div class="__item __item--shadow itemBox circle circle1" style="border-radius:10%">  
                <div class="_header">
                    <i class="fa fa-shield" aria-hidden="true"></i> 
                </div>
                <div class="_body">
                   <h3 class="__title" style="font-size: 11px;line-height: 14px;letter-spacing: 1px;font-weight: 600 !important;">Term Plan</h3>
                </div>
            </div> 
          </a>
    </div>
    <div class="resp  col-sm-4 col-lg-3 col-xl-3 col-xs-4  col-4 pt-3 animate animated slideLeft" style="padding-right: 10px;padding-left: 10px;">
         <a href="#" class="home-box">
           <div class="__item __item--shadow itemBox circle circle1" style="border-radius:10%">  
                <div class="_header">
                    <i class="fa fa-plane" aria-hidden="true"></i> 
                </div>
                <div class="_body">
                   <h3 class="__title" style="font-size: 11px;line-height: 14px;letter-spacing: 1px;font-weight: 600 !important;">Travel</h3>
                </div>
            </div> 
          </a>
    </div>
    
       <div class="resp  col-sm-4 col-lg-3 col-xl-3 col-xs-4  col-4 pt-3 animate animated slideRight" style="padding-right: 10px;padding-left: 10px;">
         <a href="#" class="home-box">
           <div class="__item __item--shadow itemBox circle circle1" style="border-radius:10%">  
                <div class="_header">
                    <i class="fa fa-ambulance" aria-hidden="true"></i> 
                </div>
                <div class="_body">
                   <h3 class="__title" style="font-size: 11px;line-height: 14px;letter-spacing: 1px;font-weight: 600 !important;">Accidental</h3>
                </div>
            </div> 
          </a>
    </div>
    
    <div class="resp  col-sm-4 col-lg-3 col-xl-3 col-xs-4  col-4 pt-3 animate animated slideDown" style="padding-right: 10px;padding-left: 10px;">
         <a href="#" class="home-box">
           <div class="__item __item--shadow itemBox circle circle1" style="border-radius:10%">  
                <div class="_header">
                    <i class="fa fa-money" aria-hidden="true"></i> 
                </div>
                <div class="_body">
                   <h3 class="__title" style="font-size: 11px;line-height: 14px;letter-spacing: 1px;font-weight: 600 !important;">Savings</h3>
                </div>
            </div> 
          </a>
    </div>
    
</div>

<?php /*
<div class="row text-center">
                                        <?php $i=1; foreach ($categories as $value) {?>
                                         <div class="resp  col-sm-4 col-lg-3 col-xl-3 col-xs-4  col-4 pt-3 animate animated  <?php if($i==1 || $i==4 || $i==7 ){ echo 'slideRight'; }elseif($i==3 || $i==6 || $i==9){ echo 'slideLeft';}elseif($i==2){ echo 'slideDown';}elseif($i==8){ echo 'slideUp';}?>" style="padding-right: 10px;padding-left: 10px;">
                                           <a href="{{url('/')}}/{{$value->slug}}" class="home-box">
                                           <div class="__item __item--shadow itemBox circle circle1" style="border-radius:10%">
                                                <div class="_header">
                                                    <i class="{{$value->icon_class}}" aria-hidden="true"></i> 
                                                </div>
                                                <div class="_body">
                                                   <h3 class="__title" style="font-size: 11px;line-height: 14px;letter-spacing: 1px;font-weight: 600 !important;">{{$value->name}}</h3>
                                                </div>
                                            </div> 
                                           </a>
                                        </div>
                                        <?php $i++; } ?>
                                    </div>*/ ?>