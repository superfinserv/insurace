@extends($layout)
@section('content')
<style>
    .plan_check{
        display: block;
        margin-bottom: 5px;
    }
    .slider-color {
      -webkit-appearance: none;
      width: 100%;
      height: 6px;
      border-radius: 3px;
      background: #294b7c;
      outline: none;
      opacity:1;
      -webkit-transition: opacity .15s ease-in-out;
      transition: opacity .15s ease-in-out;
    }
    .slider-color:hover {
      opacity:1;
    }
    .slider-color::-webkit-slider-thumb {
      -webkit-appearance: none;
      appearance: none;
      width: 20px;
      height: 20px;
      border-radius: 50%;
      background: #ac0f0a;
      cursor: pointer;
    }
    .slider-color::-moz-range-thumb {
      width: 20px;
      height: 20px;
      border: 0;
      border-radius: 50%;
      background: #ac0f0a;
      cursor: pointer;
    }
    
 .table-assCovervalueRange tr td,.table-assCovervalueRange tr th{
      border: 1px solid #ac0f09;
   vertical-align: middle;
}

.table-assCovervalueRange tr th{
    font-size: 12px;
    font-weight: 400;
    text-align:center;
    padding:5px;
}
.table-assCovervalueRange tr th .min-assval,.table-assCovervalueRange tr th .max-assval{
    color:#ac0f0a; 
    font-weight: 600;
}
.assCovervalueRange{
    margin-top:12px;
}


.btn-update-assVal{
    width: 100%;
    padding: 8px;
    background: #ac0f09;
    color: #fff;
    font-size: 13px;
    font-weight: 800;
    text-shadow: unset;
}
.btn-update-assVal:hover,.btn-update-assVal:active{
    background: #d61811;
    color: #fff;
}
.other-vehical-details {
    font-size: 12px;
    font-weight: 400;
    line-height: normal;
    letter-spacing: normal;
    width: 354px;
    color: #8a8a8a;
    margin: 1px 0 0 0;
    text-overflow: ellipsis;
    width: 375px;
    overflow: hidden;
}

.other-vehical-details span {
    margin-right: 5px;
    padding-left: 15px;
    position: relative;
}
/*.other-vehical-details span:nth-child(1) {*/
/*    padding: 0;*/
/*}*/
.other-vehical-details span:before {
    content: "";
    width: 3px;
    height: 3px;
    border-radius: 20px;
    background: #000;
    left: 5px;
    top: 6px;
    position: absolute;
}
.btn-small {
    border: 1px solid #AC0F0B;
    background: #AC0F0B;
    color: #ffff;
}


.cart-empty img{
    filter: grayscale(100%);
}

span.addon-badge{
    background: #fff;
color: #ac0f0b;
font-size: 10px;
margin-right: 10px;
margin-bottom: 5px;
border: 1px solid #ac0f0b;
padding: 1px 4px;
line-height: 14px;
border-radius: 2px;
}

select {
    width: 220px;
    border: 1px solid #cccccc;
    background-color: #ffffff;
}
select {
    height: 30px;
    *margin-top: 4px;
    line-height: 30px;
}

label, input, button, select, textarea {
    font-size: 14px;
    font-weight: normal;
    line-height: 20px;
}

select, input[type="file"] {
    height: 30px;
    *margin-top: 4px;
    line-height: 30px;
}
select, textarea, input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"], .uneditable-input {
    display: inline-block;
    height: 20px;
    padding: 4px 6px;
    margin-bottom: 10px;
    font-size: 14px;
    line-height: 20px;
    color: #555555;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
    vertical-align: middle;
}

.right-info{
    display: inline;float: right;
}

@media only screen and (max-width:480px) {
     .right-info{ 
         display: inline;float: unset;
      }
    
}

.error-span{
    position: absolute;
top: -16%;
font-size: 12px;
color: #7a0c16;
background-color: #f8d7da;
border-color: #f5c2c7;
width: 96%;
left: 2%;
border-radius: 4px;
padding: 4px 1px 4px 1px;
}
</style>

<main role="main">
	<section class="invest-long page-heading-h2" style="background: none;">
        <div class="container invest-long-bg" style="box-shadow: none;">
        	<div class="card planInfo-card">
            	 <header class="card-header">
            	     <div style="display: inline-block;">
            	         <ul style="font-size: 12px;margin-bottom:0px;">
            	         <li style="display:inline;font-size: 15px;font-weight: 600;"><a href="#" style="color:#224c8a"><span id="span-make_name"></span></a></li>
            	         <li style="display:inline;font-size: 15px;font-weight: 600;"><a href="#" style="color:#224c8a"><span id="span-model_name"></span></a></li>
            	         <li style="display:inline;font-size: 15px;font-weight: 600;"><a href="#" style="color:#224c8a"><span id="span-varient_name"></span></a></li>
            	         </ul>
            	         <div class="other-vehical-details"><span>Two Wheeler</span><span id="span-regYear">...</span><span id="span-FuleType">...</span><span id="span-RTO">...</span></div>
            	     
            	     </div>
            	     
            	     <div class="right-info" >
                        <select class="form-control planType" id="planType" name="planType" style="border: 1px solid #AC0F0B;font-weight: 600;">
                            <option value="COM">Comprehensive (OD+Third Party)</option>
                            <option value="TP">Third Party Cover</option>
                            <option value="SAOD">Stand Alone OD Cover</option>
                          </select>
            	    
            	 </div>
            	 </header>
            	    <div class="card-body">
            	        
                         <div class="row" id="data_alll--">
                                <div class="col-12 col-lg-4 prodct_fillter" style="">
                					
                	                	<nav class="navbar navbar-expand-md navbar-light shadow-sm mb-4 mb-lg-0 sidenav">
                    						<!-- Menu -->
                    						<a class="d-xl-none d-lg-none d-md-none text-inherit font-weight-bold" href="#!" style="color: #AC0F0B;font-size: 15px;">Add Extra Coverage</a>
                    						<!-- Button -->
                    						<button class="navbar-toggler d-md-none icon-shape icon-sm rounded text-light" style="background: #AC0F0B;color: #fff;padding: 8px;font-size: 12px;" type="button" data-toggle="collapse" data-target="#sidenav" aria-controls="sidenav" aria-expanded="false" aria-label="Toggle navigation">
                    							<span class="fa fa-bars"></span>
                    						</button>
                    						<!-- Collapse -->
                    						<div class="collapse navbar-collapse" id="sidenav">
                    							<div class="navbar-nav flex-column">
                    							     <div class="card cardIdvSet" >
                                    					<div class="card-body" style="padding:0px;">
                                    					    <table class="table table-planInfo" style="margin-bottom:0px;">
                                    			                <tbody>
                                    			                    <tr><th>IDV:<span id="IdvCurrentValue" style="margin-left: 20px;">Lowest Price</span></th><td><a class="idv-edit-th" id="open-idv-modal" href="#">Edit</a></td> </tr>
                                    			                </tbody>
                                    			           </table>
                                    					</div> 
                                    				</div>
                                    				
                                    				<div class="card" style="margin-top:20px;">
                                    				    <article class="card-group-item">
                                    						<header class="card-header">
                                    							<h3 class="title" style="margin-bottom:0px;letter-spacing: 0.5;">Add Extra Coverage</h3>
                                    						</header>
                                    						
                                    						@include('motor.addons',['motor' => 'tw'])
                                    				
                                    					</article> 
                                    				</div>
                                    					
                    							</div>
                    						</div>
					                  </nav>
                    				   
                				</div> 
                			
                				<div class="col-12 col-lg-8 col-xl-8 text-center" >
                				   <div style="width: 100%;text-align: right;font-size: 12px;color: #AC0F0B;cursor: pointer;text-decoration: underline;display:none;" id="ODdetails" ><i style="font-size: 12px;" class="fa fa-pencil"></i> Change Current TP details</div>
                                   <div id="PlanListContainer">
                                       
                                        <div class="card plan-card plan-card-digit_m cart-empty">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="provider-logo col-md-4 col-lg-3 col-xs-12">
                                                        <img src="{{asset('assets/insurer-logo/DigitLogo.jpg')}}" style="width:100%;padding: 10px 30px 0px 0px;"/>
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-xs-12">
                                                        <div class="column-2" style="display:none;">
                                                            <h5 class="idv">IDV:337,092/-</h5>
                                                            <h5 class="plan-deatil-link">
                                                                <a href="#" class="Premium-Breakup" data-ref="#">Plan Break-down</a>
                                                            </h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-xs-12">
                                                        <div class="column-3" style="display:none;">
                                                            <h3 class="Premium-PAcover" style="font-size: 13px;font-weight: bolder;color: #AC0F0B;margin-bottom: 5px;" data-toggle="tooltip" title="PA Owner Driver Cover (Personal Accident)">PA Cover</h3>
                                                            <h5 class="Premium-PAcover"><span class="paCoverStatus-txt">Added</span></h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-xs-12">
                                                        <div class="column-4">
                                                            <!--<h5 style="" class="grosspremium"><span class="fa fa-inr"></span> ----</h5>-->
                                                                <button class="btn btn-netpremiumn selectPlan" style="height: 40px;" data-provider="DIGIT_M" data-ref="">
                                                                   <span class="inline-loader"><span class="inline-loader-box"></span><span class="inline-loader-box"></span><span class="inline-loader-box"></span></span> 
                                                                </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="card-footer digit_m_addon" style="font-size: 12px;text-shadow: 0px 1px 0px #ccc;">No addon cover selected</div>
                                        </div>
                                        
                                        <div class="card plan-card plan-card-hdfcergo_m cart-empty" >
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="provider-logo col-md-4 col-lg-3 col-xs-12">
                                                        <img class="cart-empty" src="{{asset('assets/partners/HDFC-Ergo-logo.png')}}" style="width:80px;">
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-xs-12">
                                                        <div class="column-2" style="display:none;">
                                                            <h5 class="idv">IDV:#/-</h5>
                                                            <h5 class="plan-deatil-link">
                                                                <a href="#" class="Premium-Breakup" data-ref="#">Plan Break-down</a>
                                                            </h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-xs-12">
                                                       <div class="column-3" style="display:none;">
                                                            <h3 class="Premium-PAcover" style="font-size: 13px;font-weight: bolder;color: #AC0F0B;margin-bottom: 5px;" data-toggle="tooltip" title="PA Owner Driver Cover (Personal Accident)">PA Cover</h3>
                                                            <h5 class="Premium-PAcover"><span class="paCoverStatus-txt">Added</span></h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-xs-12">
                                                        <div class="column-4">
                                                            <!--<h5 style="" class="grosspremium"><span class="fa fa-inr"></span> ----</h5>-->
                                                                <button class="btn btn-netpremiumn selectPlan" style="height: 40px;" data-provider="" data-ref="#">
                                                                   <span class="inline-loader"><span class="inline-loader-box"></span><span class="inline-loader-box"></span><span class="inline-loader-box"></span></span> 
                                                                </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="card-footer hdfcergo_m_addon" style="font-size: 12px;text-shadow: 0px 1px 0px #ccc;">No addon cover selected</div>
                                        </div>
                                        
                                           <div class="card plan-card plan-card-fgi_m cart-empty">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="provider-logo col-md-4 col-lg-3 col-xs-12">
                                                        <img src="{{asset('assets/partners/FutureGenerali_60a250f2bf870.png')}}" style="width:100%;padding: 10px 30px 0px 0px;"/>
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-xs-12">
                                                        <div class="column-2" style="display:none;">
                                                            <h5 class="idv">IDV:337,092/-</h5>
                                                            <h5 class="plan-deatil-link">
                                                                <a href="#" class="Premium-Breakup" data-ref="#">Plan Break-down</a>
                                                            </h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-xs-12">
                                                        <div class="column-3" style="display:none;">
                                                            <h3 class="Premium-PAcover" style="font-size: 13px;font-weight: bolder;color: #AC0F0B;margin-bottom: 5px;" data-toggle="tooltip" title="PA Owner Driver Cover (Personal Accident)">PA Cover</h3>
                                                            <h5 class="Premium-PAcover"><span class="paCoverStatus-txt">Added</span></h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-xs-12">
                                                        <div class="column-4">
                                                            <!--<h5 style="" class="grosspremium"><span class="fa fa-inr"></span> ----</h5>-->
                                                                <button disabled class="btn btn-netpremiumn selectPlan" style="height: 40px;" data-provider="fgi_m" data-ref="">
                                                                   0.00<!--<span class="inline-loader"><span class="inline-loader-box"></span><span class="inline-loader-box"></span><span class="inline-loader-box"></span></span> -->
                                                                </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="card-footer fgi_m_addon" style="font-size: 12px;text-shadow: 0px 1px 0px #ccc;">No addon cover selected</div>
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
.table-planInfo tr:last-child td,.table-planInfo tr:last-child th{
   border-bottom:1px solid #ccc;
}

.table-planInfo tr th{
    font-size: 12px;
    font-weight: 600;
    border-left:1px solid #ccc;
}
.table-planInfo tr th span#IdvCurrentValue{
   margin-left: 20px;
    color: #d30100;
}
.table-planInfo tr td{
   font-size: 12px;
   color: black;
    border-right:1px solid #ccc;
}
.plan-card{
        box-shadow: 0px 5px 8px #b1aeae;
        border: none;
       margin-bottom: 35px;
    }
    .plan-card .provider-logo img{
        width: 120px;
    }
    .plan-card .column-2{
        padding:8px;
    }
    .plan-card .column-2 .idv{
       font-size:15px;font-weight:500
    }
    .plan-card .column-2 .plan-deatil-link a{
        color:#AC0F0B;
    }
    .plan-card .column-3 {
       padding: 8px;
    }
    .plan-card .column-4 .grosspremium {
      font-size:15px;font-weight:500;text-decoration: line-through;
    }
    .plan-card .column-4 .btn-netpremiumn {
        width: 100%;
        font-size: 17px;
        color: #ffff;
        background: #224c8a;
        text-shadow: unset;
        box-shadow: unset;
        border: 1px solid #224c89;
    }
    .plan-card .column-4 .btn-netpremiumn i.fa{
        font-size:20px;
    }
    

</style>

@endsection