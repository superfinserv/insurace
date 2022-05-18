
<?php $role="";?>
    <div class="br-logo"><a href="#">
        <!--<span>[</span>bracket <i>plus</i><span>]</span>-->
         <img src="{{get_site_settings('site_logo')}}" alt="" style="width: 100%;">
        </a>
    </div>
    <div class="br-sideleft sideleft-scrollbar">
      <label class="sidebar-label pd-x-10 mg-t-20 op-3">Navigation</label>
      <ul class="br-sideleft-menu">
        <li class="br-menu-item">
          <a href="{{url('/home')}}" class="br-menu-link active">
            <i class="menu-item-icon icon ion-ios-home-outline tx-24"></i>
            <span class="menu-item-label">Dashboard</span>
          </a><!-- br-menu-link -->
        </li><!-- br-menu-item -->
         <li class="br-menu-item">
          <a href="#" class="br-menu-link with-sub">
            <i class="menu-item-icon icon ion-ios-paper-outline tx-22"></i>
            <span class="menu-item-label">Sales</span>
          </a><!-- br-menu-link -->
          <ul class="br-menu-sub">
            <li class="sub-item"><a href="{{url('/sales/leads')}}" class="sub-link">Our Leads</a></li>
            <li class="sub-item"><a href="{{url('/sales/insured')}}" class="sub-link">Sold</a></li>
          </ul>
        </li>
        <?php /*
        <li class="br-menu-item">
          <a href="{{url('/regions')}}" class="br-menu-link">
            <i class="menu-item-icon icon ion-ios-list-outline tx-22"></i>
            <span class="menu-item-label">Regions</span>
          </a><!-- br-menu-link -->
        </li><!-- br-menu-item -->
        */?>
        <li class="br-menu-item">
          <a href="#" class="br-menu-link with-sub">
            <i class="menu-item-icon icon ion-android-notifications tx-24"></i>
            <span class="menu-item-label">Notifications Setting</span>
          </a><!-- br-menu-link -->
          <ul class="br-menu-sub">
            <li class="sub-item"><a href="{{url('/notification/templates/email')}}" class="sub-link">Email Template</a></li>
            <li class="sub-item"><a href="{{url('/notification/templates/sms')}}" class="sub-link">SMS Template</a></li>
            <li class="sub-item"><a href="{{url('/notification/templates/settings')}}" class="sub-link">Settings</a></li>
          </ul>
        </li>
         <?php /*
        <li class="br-menu-item">
          <a href="{{url('/branches')}}" class="br-menu-link">
            <i class="menu-item-icon icon ion-ios-list-outline tx-22"></i>
            <span class="menu-item-label">Branches</span>
          </a><!-- br-menu-link -->
        </li><!-- br-menu-item -->
       
         <li class="br-menu-item">
          <a href="{{url('/roles')}}" class="br-menu-link">
            <i class="menu-item-icon icon ion-ios-gear-outline tx-24"></i>
            <span class="menu-item-label">Roles</span>
          </a><!-- br-menu-link -->
        </li><!-- br-menu-item -->
        <li class="br-menu-item">
          <a href="{{url('/users')}}" class="br-menu-link">
            <i class="menu-item-icon icon ion-ios-person-outline tx-24"></i>
            <span class="menu-item-label">Users</span>
          </a><!-- br-menu-link -->
        </li><!-- br-menu-item -->
        */?>
        <li class="br-menu-item">
          <a href="{{url('/categories')}}" class="br-menu-link">
            <i class="menu-item-icon icon ion-ios-paper-outline tx-22"></i>
            <span class="menu-item-label">Categories</span>
          </a><!-- br-menu-link -->
        </li><!-- br-menu-item -->
        <li class="br-menu-item">
          <a href="{{url('/pre-insurers')}}" class="br-menu-link">
            <i class="menu-item-icon icon ion-ios-paper-outline tx-22"></i>
            <span class="menu-item-label">Previous Insurer</span>
          </a><!-- br-menu-link -->
        </li><!-- br-menu-item -->
       
        <li class="br-menu-item">
          <a href="#" class="br-menu-link with-sub">
            <i class="menu-item-icon icon ion-ios-person tx-24"></i>
            <span class="menu-item-label">POSP</span>
          </a><!-- br-menu-link -->
          <ul class="br-menu-sub">
            <li class="sub-item"><a href="{{url('/agents')}}" class="sub-link">POSP</a></li>
            <li class="sub-item"><a href="{{url('/agent/applications')}}" class="sub-link">Posp (Applications)</a></li>
            <li class="sub-item"><a href="{{url('/agent/payments')}}" class="sub-link">Posp Payments</a></li>
          </ul>
        </li>
        <li class="br-menu-item">
          <a href="{{url('/customers')}}" class="br-menu-link">
            <i class="menu-item-icon icon ion-ios-person-outline tx-24"></i>
            <span class="menu-item-label">Customers</span>
          </a><!-- br-menu-link -->
        </li><!-- br-menu-item -->
        
        <li class="br-menu-item">
          <a href="#" class="br-menu-link with-sub">
            <i class="menu-item-icon icon ion-android-notifications tx-24"></i>
            <span class="menu-item-label">Partners</span>
          </a><!-- br-menu-link -->
          <ul class="br-menu-sub">
            <li class="sub-item"><a href="{{url('/our-partners')}}" class="sub-link">Partners List</a></li>
            <li class="sub-item"><a href="{{url('/our-partners/plans-list')}}" class="sub-link">Partners Plans</a></li>
          </ul>
        </li>
       
        
        <li class="br-menu-item">
          <a href="#" class="br-menu-link with-sub">
            <i class="menu-item-icon icon ion-ios-color-filter-outline tx-24"></i>
            <span class="menu-item-label">Vehicles</span>
          </a><!-- br-menu-link -->
          <ul class="br-menu-sub">
            <li class="sub-item"><a href="{{url('vehicles/2w')}}" class="sub-link">2W</a></li>
            <li class="sub-item"><a href="{{url('vehicles/pvt-car')}}" class="sub-link">Pvt Car</a></li>
          </ul>
        </li> 
        <li class="br-menu-item">
          <a href="{{url('/pincode-master')}}" class="br-menu-link">
            <i class="menu-item-icon icon ion-ionic tx-24"></i>
            <span class="menu-item-label">Pincode Master</span>
          </a><!-- br-menu-link -->
        </li><!-- br-menu-item -->
         <li class="br-menu-item">
          <a href="{{url('/rto-master')}}" class="br-menu-link">
            <i class="menu-item-icon icon ion-arrow-move tx-24"></i>
            <span class="menu-item-label">RTO Master</span>
          </a><!-- br-menu-link -->
        </li><!-- br-menu-item -->
        
        <?php /*<li class="br-menu-item">
          <a href="{{url('/create/policy')}}" class="br-menu-link">
            <i class="menu-item-icon icon ion-filing tx-22"></i>
            <span class="menu-item-label">Create Policy</span>
          </a><!-- br-menu-link -->
        </li><!-- br-menu-item --> */?>
        
        <li class="br-menu-item">
          <a href="{{url('/logout')}}" class="br-menu-link">
            <i class="menu-item-icon icon ion-power tx-22"></i>
            <span class="menu-item-label">Sign Out</span>
          </a><!-- br-menu-link -->
        </li><!-- br-menu-item -->
        
      </ul><!-- br-sideleft-menu -->

      <!--<label class="sidebar-label pd-x-10 mg-t-25 mg-b-20 tx-info">Information Summary</label>-->

      <!--<div class="info-list">-->
      <!--  <div class="info-list-item">-->
      <!--    <div>-->
      <!--      <p class="info-list-label">Memory Usage</p>-->
      <!--      <h5 class="info-list-amount">32.3%</h5>-->
      <!--    </div>-->
      <!--    <span class="peity-bar" data-peity='{ "fill": ["#336490"], "height": 35, "width": 60 }'>8,6,5,9,8,4,9,3,5,9</span>-->
      <!--  </div><!-- info-list-item -->

      <!--  <div class="info-list-item">-->
      <!--    <div>-->
      <!--      <p class="info-list-label">CPU Usage</p>-->
      <!--      <h5 class="info-list-amount">140.05</h5>-->
      <!--    </div>-->
      <!--    <span class="peity-bar" data-peity='{ "fill": ["#1C7973"], "height": 35, "width": 60 }'>4,3,5,7,12,10,4,5,11,7</span>-->
      <!--  </div><!-- info-list-item -->

      <!--  <div class="info-list-item">-->
      <!--    <div>-->
      <!--      <p class="info-list-label">Disk Usage</p>-->
      <!--      <h5 class="info-list-amount">82.02%</h5>-->
      <!--    </div>-->
      <!--    <span class="peity-bar" data-peity='{ "fill": ["#8E4246"], "height": 35, "width": 60 }'>1,2,1,3,2,10,4,12,7</span>-->
      <!--  </div><!-- info-list-item -->

      <!--  <div class="info-list-item">-->
      <!--    <div>-->
      <!--      <p class="info-list-label">Daily Traffic</p>-->
      <!--      <h5 class="info-list-amount">62,201</h5>-->
      <!--    </div>-->
      <!--    <span class="peity-bar" data-peity='{ "fill": ["#9C7846"], "height": 35, "width": 60 }'>3,12,7,9,2,3,4,5,2</span>-->
      <!--  </div><!-- info-list-item -->
      <!--</div>-->
      <!-- info-list -->

      <br>
    </div>