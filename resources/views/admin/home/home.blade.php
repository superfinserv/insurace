@extends('admin.layout.app')
    @section('content')
      <style>
          .bg-theme{
              background-color: #AC0F0B;
          }
          .bg-theme-2{
              background-color: #0E3679;
          }
      </style>

        <div class="row row-sm mg-t-80">
          <div class="col-sm-6 col-xl-3">
            <div class="bg-theme rounded overflow-hidden">
              <div class="pd-x-20 pd-t-20 d-flex align-items-center">
                <i class="ion ion-earth tx-60 lh-0 tx-white op-7"></i>
                <div class="mg-l-20">
                  <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">Today's Premium</p>
                  <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1">1,975,224</p>
                  <span class="tx-11 tx-roboto tx-white-8">24% higher yesterday</span>
                </div>
              </div>
              <div id="ch1" class="ht-20 tr-y-1"></div>
            </div>
          </div><!-- col-3 -->
          <div class="col-sm-6 col-xl-3 mg-t-20 mg-sm-t-0">
            <div class="bg-theme-2 rounded overflow-hidden">
              <div class="pd-x-20 pd-t-20 d-flex align-items-center">
                <i class="ion ion-bag tx-60 lh-0 tx-white op-7"></i>
                <div class="mg-l-20">
                  <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">Today's Claim</p>
                  <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1">$329,291</p>
                  
                  <span class="tx-11 tx-roboto tx-white-8">$390,212 before tax</span>
                </div>
              </div>
              <div id="ch3" class="ht-20 tr-y-1"></div>
            </div>
          </div><!-- col-3 -->
          <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
            <div class="bg-theme-2 rounded overflow-hidden">
              <div class="pd-x-20 pd-t-20 d-flex align-items-center">
                <i class="ion ion-monitor tx-60 lh-0 tx-white op-7"></i>
                <div class="mg-l-20">
                  <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">Today's Service Request</p>
                  <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1">54.45%</p>
                  <span class="tx-11 tx-roboto tx-white-8">23% average duration</span>
                </div>
              </div>
              <div id="ch2" class="ht-20 tr-y-1"></div>
            </div>
          </div><!-- col-3 -->
          <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
            <div class="bg-theme rounded overflow-hidden">
              <div class="pd-x-20 pd-t-20 d-flex align-items-center">
                <i class="ion ion-ios-person-outline tx-60 lh-0 tx-white op-7"></i>
                <div class="mg-l-20">
                  <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">Posp Registered</p>
                  <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1">32.16%</p>
                  <span class="tx-11 tx-roboto tx-white-8">65.45% on average time</span>
                </div>
              </div>
              <div id="ch4" class="ht-20 tr-y-1"></div>
            </div>
          </div><!-- col-3 -->
        </div><!-- row -->
        
        <div class="row row-sm mg-t-20">
            <div class="col-lg-8">
                
               @include('admin.home.eChart') 
                
            </div>
            <div class="col-lg-4">
                
                @include('admin.home.statistics') 

            </div>
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