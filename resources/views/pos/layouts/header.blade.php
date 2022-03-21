    <header id="top-bar" class="top-bar top-bar--dark" data-nav-anchor="true"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
       <div class="top-bar__inner">
            <div class="container-fluid">
                <div class="row align-items-center no-gutters">
                    <a class="top-bar__logo site-logo" href="{{url('/')}}">
                        <img class="img-fluid" src="{{get_site_settings('site_logo')}}"  alt="{{config('custom.site_name')}}"/>
                    </a>

                    <a id="top-bar__navigation-toggler" class="top-bar__navigation-toggler" href="javascript:void(0);"><span></span></a>
                    <div class="top-bar__collapse">
                        <nav id="top-bar__navigation" class="top-bar__navigation drop-menu" role="navigation">
                            <ul>
                                <li> <a class="nav-link" href="{{url('faq')}}">FAQ</a>  </li>   
                            </ul>
                        </nav>
                        <div id="top-bar__action" class="top-bar__action">
                            <div class="d-xl-flex flex-xl-row flex-xl-wrap align-items-xl-center">
                                
                                @if(Auth::guard('agents')->user())
                                <nav id="top-bar__navigation" class="top-bar__navigation drop-menu" role="navigation">
                                    <ul>  
                                        <li><a class="nav-link clr" href="#">Leads</a> </li>
                                        <?php /*<li class="has-submenu"><a class="nav-link clr" href="javascript:void(0);">Sales</a>
                                            <ul class="submenu">
                                                <li><a href="{{url('/my-sales')}}" style="color:#fff !important;">Insurance Sales</a></li>
                                        <!--    <li><a href="become-earnings-from-insurance.html" style="color:#fff !important;">Mutual Fund Sales</a> </li> -->
                                                <li><a href="become-earnings-from-insurance.html" style="color:#fff !important;">Earnings</a></li>
                                            </ul>
                                        </li> */?>
                                         <li><a class="nav-link clr" href="{{url('dashboard')}}">Sales Dashboard</a> </li>
                                        <li class="has-submenu"> <a class="nav-link clr" href="javascript:void(0);">{{Auth::guard('agents')->user()->mobile}}</a>
                                            <ul class="submenu">
                                                <li><a href="{{url('profile')}}" style="color:#fff !important;">My Profile</a></li>
                                                <li><a href="{{url('profile-overview')}}" style="color:#fff !important;">Profile overview</a></li>
                                                <li><a href="{{url('my-certification')}}" style="color:#fff !important;">My Certification</a></li>
                                                <!-- <li><a href="become-adviser-role-insurance.html" style="color:#fff !important;">Refer and Earn</a></li>
                                                <li><a href="become-students-selling-insurance.html" style="color:#fff !important;">Language</a></li> -->
                                                <li><a href="{{url('logout')}}" style="color:#fff !important;">Logout</a></li>
                                            </ul>
                                        </li>
                                           
                                        <li>
                                            <a class="custom-btn custom-btn--medium custom-btn--style-3" href="{{url('create/quote')}}">Create a Quote</a>
                                        </li>   

                                    </ul>
                                </nav>
                                @else
                                <div class="top-bar__auth-btns">
                                   <a class="custom-btn custom-btn--medium custom-btn--style-3" href="{{url('/sign-in')}}">Login</a>
                                </div>
                                @endif
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
        <span class="side-menu__button-close  js-side-menu-close"></span>
        <div class="side-menu__inner">
            <ul class="side-menu__menu">
                <h5>Insurance :</h5>
                    <li><a href="{{url('term-insurance')}}"><i class="fa fa-thermometer-three-quarters" aria-hidden="true"></i> Term Insurance</a></li>
                    <li><a href="{{url('health-insurance')}}"><i class="fa fa-child" aria-hidden="true"></i> Health Insurance</a></li>
                    <li><a href="{{url('life-insurance-plan')}}"><i class="fa fa-users" aria-hidden="true"></i> Life Insurance Plan</a></li>
                    <li><a href="{{url('ulip-plan')}}"><i class="fa fa-magnet" aria-hidden="true"></i> ULIP plan</a></li>
                    <li><a href="{{url('investment-plan')}}"><i class="fa fa-cubes" aria-hidden="true"></i> Investment plan</a></li>
                    <li><a href="{{url('car-insurance')}}"><i class='fa fa-car'></i> Car Insurance</a></li>
                    <li><a href="{{url('bike-insurance')}}"><i class='fa fa-motorcycle'></i> bike Insurance</a></li>
                    <li><a href="{{url('travel-insorance-plan')}}"><i class="fa fa-plane"></i> Travel Plan</a></li>
                    <li><a href="#"><i class="fa fa-diamond" aria-hidden="true"></i> General Insurance</a></li>
            </ul>
            <address class="side-menu__address mtn">Address : INDIA, 3280 Cabell Avenue Indore, ST 452001<br>
                <a href="mailto:youremail@yourdomain.com">info@buypolicy.com</a> <br>
                <a href="#">+91 703-xxx-xxx</a>
                <div class="s-btns s-btns--md s-btns--colored s-btns--rounded">
                    <ul class="d-flex flex-row flex-wrap align-items-center">
                        <li><a class="f" href="#"><i class="fontello-facebook"></i></a></li>
                        <li><a class="t" href="#"><i class="fontello-twitter"></i></a></li>
                        <li><a class="y" href="#"><i class="fontello-youtube-play"></i></a></li>
                        <li><a class="i" href="#"><i class="fontello-instagram"></i></a></li>
                    </ul>
                </div>
            </address>
        </div>
    </div>
    <!-- end side menu -->