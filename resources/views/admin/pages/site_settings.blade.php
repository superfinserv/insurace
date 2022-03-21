 @extends('admin.layout.app')
@section('content')
  
 
    <div class="card bd-0">
       <div class="card-header d-flex tx-medium bd-0 tx-inverse  align-items-center justify-content-between pd-y-5">
          <h6 class="mg-b-0 tx-14 tx-inverse"> General Settings</h6>
           <div class="card-option tx-24">
                <a id="btnClearCache" class="btn btn-dark active btn-sm" href="#">Clear Cache</a>
            </div>
        </div><!-- card-header -->
        <div class="card-body bd bd-t-0 rounded-bottom">
            <div class="--br-section-wrapper --rounded-bottom-0">
                <div class="row">
                     <div class="col-md-2"></div>
                     <div class="col-md-8">
                         
                         <div class="row"><!-- row start -->
                             <a href="{{url('/settings/portal-settings')}}" class="col-md-6" style="padding: 10px;">
                                    <table class="table  tx-13 tx-gray-700 bd-b">
                                       <tbody>
                                          <tr>
                                            <td style="width: 15%;padding:0px;" class="bd-t-0-force" rowspan="2">
                                                <img src="{{asset('site_assets/icons/icon-portal-settings-50.png')}}"/>
                                            </td>
                                            <th style="padding:0px;font-size: 16px;" class="bd-t-0-force">Portal Settings</th>
                                          </tr>
                                          <tr>
                                            <td style="padding:0px;" class="bd-t-0-force">Logo upload , company details</td>
                                          </tr>
                                        </tbody>
                                    </table>
                                    
                                    
                                    
                             </a>
                             
                              <a href="{{url('/settings/posp-settings')}}" class="col-md-6" style="padding: 10px;">
                                 
                                 <table class="table  tx-13 tx-gray-700 bd-b">
                                       <tbody>
                                          <tr>
                                            <td style="width: 15%;padding:0px;" class="bd-t-0-force" rowspan="2">
                                                <img src="{{asset('site_assets/icons/icon-portal-settings-50.png')}}"/>
                                            </td>
                                            <th style="padding:0px;font-size: 16px;" class="bd-t-0-force">POSP Settings</th>
                                          </tr>
                                          <tr>
                                            <td style="padding:0px;" class="bd-t-0-force">prefix ,application fee</td>
                                          </tr>
                                        </tbody>
                                    </table>
                             </a>
                        </div><!-- row end -->
                        
                        <div class="row"><!-- row start -->
                               <a href="{{url('/settings/social-settings')}}"  class="col-md-6" style="padding: 10px;">
                                    <table class="table  tx-13 tx-gray-700 bd-b">
                                       <tbody>
                                          <tr>
                                            <td style="width: 15%;padding:0px;" class="bd-t-0-force" rowspan="2">
                                                <img src="{{asset('site_assets/icons/icon-portal-settings-50.png')}}"/>
                                            </td>
                                            <th style="padding:0px;font-size: 16px;" class="bd-t-0-force">Social Media</th>
                                          </tr>
                                          <tr>
                                            <td style="padding:0px;" class="bd-t-0-force">facebook,twitter,linkedin urls</td>
                                          </tr>
                                        </tbody>
                                    </table>
                                    
                                    
                                    
                             </a>
                              <a href="{{url('/settings/pg-settings')}}" class="col-md-6" style="padding: 10px;">
                                 
                                 <table class="table  tx-13 tx-gray-700 bd-b">
                                       <tbody>
                                          <tr>
                                            <td style="width: 15%;padding:0px;" class="bd-t-0-force" rowspan="2">
                                                <img src="{{asset('site_assets/icons/icon-portal-settings-50.png')}}"/>
                                            </td>
                                            <th style="padding:0px;font-size: 16px;" class="bd-t-0-force">Payment Getway Settings</th>
                                          </tr>
                                          <tr>
                                            <td style="padding:0px;" class="bd-t-0-force">Key, token settings</td>
                                          </tr>
                                        </tbody>
                                    </table>
                             </a>
                        </div><!-- row end -->
                        
                        <?php /*
                         <div class="row"><!-- row start -->
                             <div class="col-md-6" style="padding: 10px;">
                                    <table class="table  tx-13 tx-gray-700 bd-b">
                                       <tbody>
                                          <tr>
                                            <td style="width: 15%;padding:0px;" class="bd-t-0-force" rowspan="2">
                                                <img src="{{asset('site_assets/icons/icon-portal-settings-50.png')}}"/>
                                            </td>
                                            <th style="padding:0px;font-size: 16px;" class="bd-t-0-force">Payout Rate Master</th>
                                          </tr>
                                          <tr>
                                            <td style="padding:0px;" class="bd-t-0-force">Logo upload , company details</td>
                                          </tr>
                                        </tbody>
                                    </table>
                                    
                                    
                                    
                             </div>
                             <div class="col-md-6" style="padding: 10px;">
                                 
                                 <table class="table  tx-13 tx-gray-700 bd-b">
                                       <tbody>
                                          <tr>
                                            <td style="width: 15%;padding:0px;" class="bd-t-0-force" rowspan="2">
                                                <img src="{{asset('site_assets/icons/icon-portal-settings-50.png')}}"/>
                                            </td>
                                            <th style="padding:0px;font-size: 16px;" class="bd-t-0-force">Alert Settings</th>
                                          </tr>
                                          <tr>
                                            <td style="padding:0px;" class="bd-t-0-force">Logo upload , company details</td>
                                          </tr>
                                        </tbody>
                                    </table>
                             </div>
                        </div><!-- row end -->
                        */?>
                        
                     </div>
                     <div class="col-md-2"></div>
                 </div>
            </div>
        </div>
    </div>
 
@endsection