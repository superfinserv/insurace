
            <header id="top-bar" class="top-bar top-bar--dark is-sticky" data-nav-anchor="true"><meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
              
                <div class="top-bar__inner">
                    <div class="container-fluid">
                        <div class="row align-items-center no-gutters">

                            <a class="top-bar__logo site-logo" href="{{url('/')}}">
                                <img class="img-fluid" src="{{asset('site_assets/logo/'.config('custom.site_logo'))}}"  alt="{{config('custom.site_name')}}" />
                            </a>

                            <a id="top-bar__navigation-toggler" class="top-bar__navigation-toggler" href="javascript:void(0);">
                                <span></span>
                            </a>

                            <div class="top-bar__collapse">
                                <nav id="top-bar__navigation" class="top-bar__navigation" role="navigation">
                                    <ul>
                                        
                                         <li class="active">
                                            <a class="nav-link" href="{{url('/')}}">Home</a>
                                        </li>
                                        <li>
                                            <a class="nav-link" href="{{url('/about')}}">About</a>
                                        </li>
                                       <?php /*
                                        <li>
                                            <a class="nav-link" href="{{url('/artical')}}">Articles</a>
                                        </li>  */?>

                                        <li>
                                            <a class="nav-link" href="{{url('claims')}}">Claims</a>
                                        </li>
                                        
                                        

                                    </ul>
                                </nav>

                                <div id="top-bar__action" class="top-bar__action">
                                    <div class="d-xl-flex flex-xl-row flex-xl-wrap align-items-xl-center">
                                        <div class="top-bar__auth-btns">
                                            @if(Auth::guard('customers')->user())
                                             <a href="{{url('/my-policies')}}" >{{Auth::guard('customers')->user()->mobile}}</a>
                                             <a href="{{url('/logout')}}" >Logout</a>
                                            @else
                                             <a href="{{url('/sign-in')}}" >Sign In</a>
                                            @endif

                                            <a class="custom-btn custom-btn--medium custom-btn--style-3" href="{{url('/contact')}}">Get in Touch</a>
                                        </div>

                                        
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                
            </header>
            <!-- end header -->

            <!-- start side menu -->
            <div id="side-menu" class="side-menu  d-none">
                       <div class="row">
                           <div class="side-menu__inner scroheight scrolheiht1">
                      <div class="side-menu__menu">
                           <span class="side-menu__button-close pull-right l-0 js-side-menu-close" style="right:0 !important; top:5;"></span>
                          <h5>LIFE</h5>
                                <div class="col-md-2 col-sm-2">
                                       <div class="circle circle1">
                                          <a href="{{url('term-insurance')}}"><i class="fa fa-shield" aria-hidden="true"></i><p>Protection</p></a>
                                        </div>
                                </div>
                                 <div class="col-md-2 col-sm-2">
                                       <div class="circle circle1">
                                          <a href="{{url('child-plan')}}"><i class="fa fa-child"></i><p>Child Plan</p></a>
                                        </div>
                                </div>
                                <div class="col-md-2 col-sm-2">
                                       <div class="circle circle1">
                                          <a href="{{url('investment-plan')}}"><i class="fa fa-money" aria-hidden="true"></i><p>Savings</p></a>
                                        </div>
                                </div>
                                <div class="col-md-2 col-sm-2">
                                       <div class="circle circle1">
                                          <a href="{{url('ulip-plan')}}"><i class="fa fa-magnet" aria-hidden="true"></i><p>Ulips</p></a>
                                        </div>
                                </div>
                                 <div class="col-md-2 col-sm-2">
                                       <div class="circle circle1">
                                          <a href="{{url('life-insurance/')}}"><i class="fa fa-blind" aria-hidden="true"></i><p>Retirement</p></a>
                                        </div>
                                </div>
                     </div>
                        </div>
                       </div> 
                       
                       <!--<hr class="mt-5">-->
                <div class="row top-bdr">
                        <div class="side-menu__inner scroheight scrolheiht2">
                      <div class="side-menu__menu">
                          <h5>HEALTH</h5>
                                <div class="col-md-2 col-sm-2">
                                     <div class="circle circle1">
                                          <a href="{{url('health-insurance')}}"><i class="fa fa-h-square" aria-hidden="true"></i><p>Mediclaim</p></a>
                                     </div>
                                </div>
                                <div class="col-md-2 col-sm-2">
                                     <div class="circle circle1">
                                          <a href="{{url('cancer-insurance')}}"><i class="fa fa-medkit" aria-hidden="true"></i> <p>Cancer</p></a>
                                     </div>
                                </div>
                                          <div class="col-md-2 col-sm-2">
                                              <div class="circle circle1">
                                              <a href="{{url('critical-insurance')}}"><i class="fa fa-microchip"></i> <p>Critical</p></a>
                                              </div>
                                          </div>
                                          <div class="col-md-2 col-sm-2">
                                              <div class="circle circle1">
                                              <a href="{{url('accidental-insurance')}}"><i class="fa fa-ambulance" aria-hidden="true"></i><p>Accidental</p></a>
                                              </div>
                                          </div>
                     </div>
                        </div>
                        </div>
                        <!--<hr class="mt-5">-->
                <div class="row top-bdr">
                    <div class="side-menu__inner genralast">
                 <!--<span class="side-menu__button-close  js-side-menu-close"></span>-->
                <div class="side-menu__menu">
                          <h5>GENERAL</h5>
                                  <div class="col-md-2 col-sm-2">
                                      <div class="circle circle1">
                                          <a href="{{url('car-insurance')}}"><i class="fa fa-car"></i><p>Car</p></a>
                                        </div>
                                  </div>
                                  <div class="col-md-2 col-sm-2">
                                      <div class="circle circle1">
                                          <a href="{{url('bike-insurance')}}"> <i class="fa fa-motorcycle" aria-hidden="true"></i><p>Bike</p></a>
                                        </div>
                                  </div>
                                  <div class="col-md-2 col-sm-2">
                                       <div class="circle circle1">
                                          <a href="{{url('travel-insurance')}}"><i class="fa fa-plane"></i><p>Travel</p></a>
                                        </div>
                                  </div>
                                  <div class="col-md-2 col-sm-2">
                                       <div class="circle circle1">
                                          <a href="{{url('mobile-insurance')}}"><i class="fa fa-mobile"></i><p>Mobile</p></a>
                                        </div>
                                        </div>
                                  <div class="col-md-2 col-sm-2">
                                      <div class="circle circle1">
                                          <a href="{{url('shop-insurance')}}"><i class="fa fa-shopping-bag" aria-hidden="true"></i><p>Shop</p></a>
                                        </div>
                                  </div>
                                  <div class="col-md-2 col-sm-2">
                                        <div class="circle circle1">
                                          <a href="{{url('taxi-insurance')}}"><i class="fa fa-taxi" aria-hidden="true"></i><p>Taxi</p></a>
                                        </div>
                                  </div>
                                  <div class="col-md-2 col-sm-2">
                                      <div class="circle circle1">
                                          <a href="{{url('bus-insurance')}}"><i class="fa fa-bus" aria-hidden="true"></i><p>bus</p></a>
                                        </div>
                                  </div>
                                  <div class="col-md-2 col-sm-2">
                                       <div class="circle circle1">
                                          <a href="{{url('goods-insurance')}}"><i class="fa fa-th-large" aria-hidden="true"></i><p>Goods</p></a>
                                        </div>
                                  </div>
                                  <div class="col-md-2 col-sm-2">
                                       <div class="circle circle1">
                                          <a href="{{url('tractor-insurance')}}"><i class='fas fa-tractor'></i><p>Tractor</p></a>
                                        </div>
                                  </div>
                                  <div class="col-md-2 col-sm-2">
                                      <div class="circle circle1">
                                          <a href="{{url('Misc')}}"> <i class="fa fa-modx"></i><p>Misc...</p></a>
                                        </div>
                                  </div>
               </div>


                </div>
                </div>
            </div>
            
            <!-- end side menu -->
            <style>
              .navbar-nav li.active > a {
                      background-color: #333;
                      color: #fff;
                    }
            </style>