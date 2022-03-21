@extends('admin.layout.app')
    @section('content')
    

        <div class="row row-sm">
          <div class="col-sm-6 col-xl-3">
            <div class="bg-info rounded overflow-hidden">
              <div class="pd-x-20 pd-t-20 d-flex align-items-center">
                <i class="ion ion-earth tx-60 lh-0 tx-white op-7"></i>
                <div class="mg-l-20">
                  <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">Today's Premium</p>
                  <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1">1,975,224</p>
                  <span class="tx-11 tx-roboto tx-white-8">24% higher yesterday</span>
                </div>
              </div>
              <div id="ch1" class="ht-50 tr-y-1"></div>
            </div>
          </div><!-- col-3 -->
          <div class="col-sm-6 col-xl-3 mg-t-20 mg-sm-t-0">
            <div class="bg-purple rounded overflow-hidden">
              <div class="pd-x-20 pd-t-20 d-flex align-items-center">
                <i class="ion ion-bag tx-60 lh-0 tx-white op-7"></i>
                <div class="mg-l-20">
                  <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">Today's Claim</p>
                  <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1">$329,291</p>
                  
                  <span class="tx-11 tx-roboto tx-white-8">$390,212 before tax</span>
                </div>
              </div>
              <div id="ch3" class="ht-50 tr-y-1"></div>
            </div>
          </div><!-- col-3 -->
          <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
            <div class="bg-teal rounded overflow-hidden">
              <div class="pd-x-20 pd-t-20 d-flex align-items-center">
                <i class="ion ion-monitor tx-60 lh-0 tx-white op-7"></i>
                <div class="mg-l-20">
                  <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">Today's Service Request</p>
                  <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1">54.45%</p>
                  <span class="tx-11 tx-roboto tx-white-8">23% average duration</span>
                </div>
              </div>
              <div id="ch2" class="ht-50 tr-y-1"></div>
            </div>
          </div><!-- col-3 -->
          <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
            <div class="bg-primary rounded overflow-hidden">
              <div class="pd-x-20 pd-t-20 d-flex align-items-center">
                <i class="ion ion-ios-person-outline tx-60 lh-0 tx-white op-7"></i>
                <div class="mg-l-20">
                  <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">Posp Registered</p>
                  <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1">32.16%</p>
                  <span class="tx-11 tx-roboto tx-white-8">65.45% on average time</span>
                </div>
              </div>
              <div id="ch4" class="ht-50 tr-y-1"></div>
            </div>
          </div><!-- col-3 -->
        </div><!-- row -->
        
        <div class="row row-sm mg-t-20">
          <div class="col-lg-6">
            <div class="widget-2">
              <div class="card shadow-base overflow-hidden">
                <div class="card-header">
                  <h6 class="card-title">POSP Statistics</h6>
                  <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="#" class="btn btn-posp-statistic active" data-attr='ALL'>All</a>
                    <a href="#" class="btn btn-posp-statistic" data-attr='MTD'>MTD</a>
                    <a href="#" class="btn btn-posp-statistic" data-attr='YTD'>YTD</a>
                  </div>
                </div><!-- card-header -->
                <div class="card-body pd-0 bd-color-gray-lighter" id="posp-statistic">
                  <div class="row no-gutters tx-center">
                    <div class="col-12 col-sm-4 pd-y-20 tx-left">
                      <p class="pd-l-20 tx-12 lh-8 mg-b-0">Note: Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula...</p>
                    </div><!-- col-4 -->
                    <div class="col-6 col-sm-2 pd-y-20">
                      <h5 class="tx-inverse tx-lato tx-bold mg-b-5"><span id="spn-Recruited">...</span></h5>
                      <p class="tx-12 mg-b-0">Recruited</p>
                    </div><!-- col-2 -->
                    <div class="col-6 col-sm-2 pd-y-20 bd-l bd-color-gray-lighter">
                      <h5 class="tx-inverse tx-lato tx-bold mg-b-5"><span id="spn-active">...</span></h5>
                      <p class="tx-12 mg-b-0">Active</p>
                    </div><!-- col-2 -->
                    <div class="col-6 col-sm-2 pd-y-20 bd-l bd-color-gray-lighter">
                      <h5 class="tx-inverse tx-lato tx-bold mg-b-5"><span id="spn-trash">...</span></h5>
                      <p class="tx-12 mg-b-0">Trash</p>
                    </div><!-- col-2 -->
                    <div class="col-6 col-sm-2 pd-y-20 bd-l bd-color-gray-lighter">
                      <h5 class="tx-inverse tx-lato tx-bold mg-b-5"><span id="spn-untr">...</span></h5>
                      <p class="tx-12 mg-b-0">Under Traning</p>
                    </div><!-- col-2 -->
                  </div><!-- row -->
                </div><!-- card-body -->
                <div class="card-body pd-0"></div><!-- card-body -->
              </div><!-- card -->
            </div><!-- widget-2 -->
          </div><!-- col-6 -->
          <div class="col-lg-6 mg-t-20 mg-lg-t-0">
            <div class="widget-2">
              <div class="card shadow-base overflow-hidden">
                <div class="card-header">
                  <h6 class="card-title">NOP</h6>
                  <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="#" class="btn btn-nop-statistic active" data-attr='ALL'>All</a>
                    <a href="#" class="btn btn-nop-statistic" data-attr='MTD'>MTD</a>
                    <a href="#" class="btn btn-nop-statistic" data-attr='YTD'>YTD</a>
                  </div>
                </div><!-- card-header -->
                <div class="card-body pd-0 bd-color-gray-lighter" id="nop-statistic">
                  <div class="row no-gutters tx-center">
                    <div class="col-12 col-sm-4 pd-y-20 tx-left">
                      <p class="pd-l-20 tx-12 lh-8 mg-b-0">Note: Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula...</p>
                    </div><!-- col-4 -->
                    <div class="col-6 col-sm-2 pd-y-20">
                      <h5 class="tx-inverse tx-lato tx-bold mg-b-5"><span id="spn-nop-Life">...</span></h5>
                      <p class="tx-12 mg-b-0">Life</p>
                    </div><!-- col-2 -->
                    <div class="col-6 col-sm-2 pd-y-20 bd-l bd-color-gray-lighter">
                      <h5 class="tx-inverse tx-lato tx-bold mg-b-5"><span id="spn-nop-Health">...</span></h5>
                      <p class="tx-12 mg-b-0">Health</p>
                    </div><!-- col-2 -->
                    <div class="col-6 col-sm-2 pd-y-20 bd-l bd-color-gray-lighter">
                      <h5 class="tx-inverse tx-lato tx-bold mg-b-5"><span id="spn-nop-Motor">...</span></h5>
                      <p class="tx-12 mg-b-0">Motor</p>
                    </div><!-- col-2 -->
                    <div class="col-6 col-sm-2 pd-y-20 bd-l bd-color-gray-lighter">
                      <h5 class="tx-inverse tx-lato tx-bold mg-b-5"><span id="spn-nop-NonMotor">...</span></h5>
                      <p class="tx-12 mg-b-0">Non Motor</p>
                    </div><!-- col-2 -->
                  </div><!-- row -->
                </div><!-- card-body -->
                <div class="card-body pd-0"></div><!-- card-body -->
              </div><!-- card -->
            </div><!-- widget-2 -->
          </div><!-- col-6 -->
        </div>
        
        <div class="row row-sm mg-t-20">
          <div class="col-lg-6">
            <div class="widget-2">
              <div class="card shadow-base overflow-hidden">
                <div class="card-header">
                  <h6 class="card-title">Premium</h6>
                  <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="#" class="btn btn-premium-statistic active" data-attr='ALL'>All</a>
                    <a href="#" class="btn btn-premium-statistic" data-attr='MTD'>MTD</a>
                    <a href="#" class="btn btn-premium-statistic" data-attr='YTD'>YTD</a>
                  </div>
                </div><!-- card-header -->
                <div class="card-body pd-0 bd-color-gray-lighter" id="premium-statistic">
                  <div class="row no-gutters tx-center">
                    <div class="col-12 col-sm-4 pd-y-20 tx-left">
                      <p class="pd-l-20 tx-12 lh-8 mg-b-0">Note: Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula...</p>
                    </div><!-- col-4 -->
                    <div class="col-6 col-sm-2 pd-y-20">
                      <h5 class="tx-inverse tx-lato tx-bold mg-b-5" style="font-size:11px"><span id="spn-Life">...</span></h5>
                      <p class="tx-12 mg-b-0">Life</p>
                    </div><!-- col-2 -->
                    <div class="col-6 col-sm-2 pd-y-20 bd-l bd-color-gray-lighter">
                      <h5 class="tx-inverse tx-lato tx-bold mg-b-5" style="font-size:11px"><span id="spn-Health">...</span></h5>
                      <p class="tx-12 mg-b-0">Health</p>
                    </div><!-- col-2 -->
                    <div class="col-6 col-sm-2 pd-y-20 bd-l bd-color-gray-lighter">
                      <h5 class="tx-inverse tx-lato tx-bold mg-b-5" style="font-size:11px" ><span id="spn-Motor">...</span></h5>
                      <p class="tx-12 mg-b-0">Motor</p>
                    </div><!-- col-2 -->
                    <div class="col-6 col-sm-2 pd-y-20 bd-l bd-color-gray-lighter">
                      <h5 class="tx-inverse tx-lato tx-bold mg-b-5" style="font-size:11px"><span id="spn-NonMotor">...</span></h5>
                      <p class="tx-12 mg-b-0">Non Motor</p>
                    </div><!-- col-2 -->
                  </div><!-- row -->
                </div><!-- card-body -->
                <div class="card-body pd-0"></div><!-- card-body -->
              </div><!-- card -->
            </div><!-- widget-2 -->
          </div><!-- col-6 -->
          <div class="col-lg-6 mg-t-20 mg-lg-t-0">
            <div class="widget-2">
              <div class="card shadow-base overflow-hidden">
                <div class="card-header">
                  <h6 class="card-title">Renewal Premium</h6>
                  <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="#" class="btn active">ALL</a>
                    <a href="#" class="btn">Due</a>
                    <a href="#" class="btn">Collected</a>
                  </div>
                </div><!-- card-header -->
                <div class="card-body pd-0 bd-color-gray-lighter">
                  <div class="row no-gutters tx-center">
                    <div class="col-12 col-sm-4 pd-y-20 tx-left">
                      <p class="pd-l-20 tx-12 lh-8 mg-b-0">Note: Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula...</p>
                    </div><!-- col-4 -->
                    <div class="col-6 col-sm-2 pd-y-20">
                      <h5 class="tx-inverse tx-lato tx-bold mg-b-5">1,343</h5>
                      <p class="tx-12 mg-b-0">Life</p>
                    </div><!-- col-2 -->
                    <div class="col-6 col-sm-2 pd-y-20 bd-l bd-color-gray-lighter">
                      <h5 class="tx-inverse tx-lato tx-bold mg-b-5">102</h5>
                      <p class="tx-12 mg-b-0">Health</p>
                    </div><!-- col-2 -->
                    <div class="col-6 col-sm-2 pd-y-20 bd-l bd-color-gray-lighter">
                      <h5 class="tx-inverse tx-lato tx-bold mg-b-5">343</h5>
                      <p class="tx-12 mg-b-0">Motor</p>
                    </div><!-- col-2 -->
                    <div class="col-6 col-sm-2 pd-y-20 bd-l bd-color-gray-lighter">
                      <h5 class="tx-inverse tx-lato tx-bold mg-b-5">960</h5>
                      <p class="tx-12 mg-b-0">Non Motor</p>
                    </div><!-- col-2 -->
                  </div><!-- row -->
                </div><!-- card-body -->
                <div class="card-body pd-0"></div><!-- card-body -->
              </div><!-- card -->
            </div><!-- widget-2 -->
          </div><!-- col-6 -->
        </div>
        
        <div class="row  mg-t-20 no-gutters widget-1 shadow-base">
          <div class="col-sm-6 col-lg-3">
            <div class="card">
              <div class="card-header">
                <h6 class="card-title">Today's Sales</h6>
                <a href="#"><i class="icon ion-android-more-horizontal"></i></a>
              </div><!-- card-header -->
              <div class="card-body sales-statistic">
                <span id="spark1"><canvas width="89" height="30" style="display: inline-block; width: 89px; height: 30px; vertical-align: top;"></canvas></span>
                <span class="today-totalSale" style="font-size: 14px;">0.00</span>
              </div><!-- card-body -->
              <div class="card-footer">
                <div>
                  <span class="tx-11">Health</span>
                  <h6 class="tx-12 tx-inverse today-Health">0.00</h6>
                </div>
                <div>
                  <span class="tx-11">Motor</span>
                  <h6 class="tx-12 tx-inverse today-Motor">0.00</h6>
                </div>
                <div>
                  <span class="tx-11">No. of Policies</span>
                  <h6 class="tx-12 tx-danger today-noPolicy">0</h6>
                </div>
              </div><!-- card-footer -->
            </div><!-- card -->
          </div><!-- col-3 -->
          <div class="col-sm-6 col-lg-3 mg-t-1 mg-sm-t-0">
            <div class="card">
              <div class="card-header">
                <h6 class="card-title">This Week's Sales</h6>
                <a href="#"><i class="icon ion-android-more-horizontal"></i></a>
              </div><!-- card-header -->
              <div class="card-body sales-statistic">
                <span id="spark2"><canvas width="89" height="30" style="display: inline-block; width: 89px; height: 30px; vertical-align: top;"></canvas></span>
                <span class="tx-medium tx-inverse tx-32 week-totalSale" style="font-size: 14px;">0.00</span>
              </div><!-- card-body -->
              <div class="card-footer">
                <div>
                  <span class="tx-11">Health</span>
                  <h6 class="tx-12 tx-inverse week-Health">0.00</h6>
                </div>
                <div>
                  <span class="tx-11">Motor</span>
                  <h6 class="tx-12 tx-inverse week-Motor">0.00</h6>
                </div>
                <div>
                  <span class="tx-11">No. of Policies</span>
                  <h6 class="tx-12 tx-danger week-noPolicy">0</h6>
                </div>
              </div><!-- card-footer -->
            </div><!-- card -->
          </div><!-- col-3 -->
          <div class="col-sm-6 col-lg-3 mg-t-1 mg-lg-t-0">
            <div class="card">
              <div class="card-header">
                <h6 class="card-title">This Month's Sales</h6>
                <a href="#"><i class="icon ion-android-more-horizontal"></i></a>
              </div><!-- card-header -->
              <div class="card-body sales-statistic">
                <span id="spark3"><canvas width="89" height="30" style="display: inline-block; width: 89px; height: 30px; vertical-align: top;"></canvas></span>
                <span class="month-totalSale" style="font-size: 14px;">0.00</span>
              </div><!-- card-body -->
              <div class="card-footer">
               <div>
                  <span class="tx-11">Health</span>
                  <h6 class="tx-12 tx-inverse month-Health">0.00</h6>
                </div>
                <div>
                  <span class="tx-11">Motor</span>
                  <h6 class="tx-12 tx-inverse month-Motor">0.00</h6>
                </div>
                <div>
                  <span class="tx-11">No. of Policies</span>
                  <h6 class="tx-12 tx-danger month-noPolicy">0</h6>
                </div>
              </div><!-- card-footer -->
            </div><!-- card -->
          </div><!-- col-3 -->
          <div class="col-sm-6 col-lg-3 mg-t-1 mg-lg-t-0">
            <div class="card">
              <div class="card-header">
                <h6 class="card-title">This Year Sales</h6>
                <a href="#"><i class="icon ion-android-more-horizontal"></i></a>
              </div><!-- card-header -->
              <div class="card-body ">
                <span id="spark4"><canvas width="89" height="30" style="display: inline-block; width: 89px; height: 30px; vertical-align: top;"></canvas></span>
                <span class="year-totalSale" style="font-size: 14px;">0.00</span>
              </div><!-- card-body -->
              <div class="card-footer">
                <div>
                  <span class="tx-11">Health</span>
                  <h6 class="tx-12 tx-inverse year-Health">0.00</h6>
                </div>
                <div>
                  <span class="tx-11">Motor</span>
                  <h6 class="tx-12 tx-inverse year-Motor">0.00</h6>
                </div>
                <div>
                  <span class="tx-11">No. of Policies</span>
                  <h6 class="tx-12 tx-danger year-noPolicy">0</h6>
                </div>
              </div><!-- card-footer -->
            </div><!-- card -->
          </div><!-- col-3 -->
        </div>
        
      
    @endsection