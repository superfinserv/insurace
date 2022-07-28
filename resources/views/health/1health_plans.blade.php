 @extends($layout)
 @section('content')
 <style>
 .invest-long-bg{
     background:none;
 }
  .partner-row{
            margin-bottom: 30px;
    }
    
    .partner-row .col-logo{
        
    }
    .partner-row .col-content{
        
    }
 .health-card .card{
     border:none;
     
 }
 .health-card .card .card-body{
     padding-bottom:0px;
 }
 .health-card{
         box-shadow: 0 1px 2px rgb(52 105 203 / 16%);
        padding-bottom: 15px;
         padding-top: 10px;
 }
    .left-card .card-header{
            background-color: #fff;
            border-bottom: none;
            font-size: 16px;
            font-weight: 600;
            color: #000;
    }
    .left-card .health-card-features li{
        font-size: 12px;
        color: #505f79;
        border-radius: 4px;
        border: 1px solid #dfe1e6;
        padding: 4px 8px;
        display: inline-flex;
        align-items: center;
        margin: 0 6px 6px 0;
    }
    .right-card .health-card-premium li{
            display: inline-block;
            width: 45%;
            
    }
    .right-card .health-card-premium li span{
        font-size: 12px;
        font-weight: 400;
        color: #7a869a;
        display: block;
    }
    
    .right-card .health-card-premium li .h4-amt{
        font-size: 16px;
       font-weight: 700;
    }
 .show-more-plans{
     text-align: center;
     cursor:pointer;
 }   
 .show-more-plans.less:after {
    transform: rotate(-135deg);
}
.show-more-plans.more:after{
    transform: rotate(45deg)
}
.show-more-plans.less:after, .show-more-plans.more:after {
    content: "";
    display: inline-block;
    border: solid #0E3679;
    border-width: 0 2px 2px 0;
    padding: 2px;
    
}
.show-more-txt{
   display: block;
}
  .col-logo{
    padding: 0;
    padding-right: 0px;
    text-align: center;
  }
  .col-logo img{
          margin-top: 15px;
          width: 50%;
  }
  .more-action{
    box-shadow: 0 1px 2px rgb(52 105 203 / 16%);
     border-top-left-radius: 5px;
    border-bottom-left-radius: 5px;
  }
.custom-checkbox .custom-control-input:checked~.custom-control-label::before {
    background-color: #AC0F0B;
}

.partner-row .health-card:not(:first-child) {
        border-top: 1px solid #ccc;
}

.more-card{
    display:none;
}

.downloadLink{
    font-size:15px;
}

/*--- DROPDOWN ---*/
/* Code By Webdevtrick ( https://webdevtrick.com ) */

.custom-select {
  display: none;
}
.dropdown-container {
  position: relative;
}
/* entypo */
[class*="entypo-"]:before {
  font-family: 'entypo', sans-serif;
}
.dropdown-select {
  z-index: 200;
  padding: 1.4rem;
  text-align: left;
  font-size: 16px;
  line-height: 1;
  cursor: pointer;
  transition: background-color 0.2s ease;
  border-radius: 5px;
  /*border-top-left-radius: 5px;*/
  /*border-top-right-radius: 5px;*/
}
.dropdown-select:before {
  float: right;
  transition: 0.3s ease;
}
.active .dropdown-select:before {
  transform: rotate(180deg);
}
.dropdown-select-ul {
  display: none;
  z-index: 100;
  position: absolute;
  width: 100%;
  max-height: 50rem;
  overflow: scroll;
  overflow-y: auto;
  overflow-x: hidden;
  text-align: left;
  border: 1px solid;
  border-top: none;
  box-shadow: 0 2px 2px rgba(0, 0, 0, 0.2);
  font-size: 16px;

}
.dropdown-select-ul li {
  display: block;
  padding: 0.7rem 1.4rem;
  cursor: pointer;
}
.dropdown-select-ul li.selected,
.dropdown-select-ul li.optgroup {
  cursor: default;
}
.dropdown-select-ul li.optgroup {
  width: 92%;
  padding-right: 0.7rem;
  margin: 0 4%;
  border-bottom: 1px solid;
  font-size: 90%;
  text-align: right;
}
.active .dropdown-select-ul {
  display: block;
  animation-fill-mode: both;
  animation-duration: 0.3s;
  animation-name: fadeIn;
}
.no-js .custom-select {
  display: block;
}
.no-js .dropdown-select,
.no-js .dropdown-select-ul {
  display: none;
}
.dropdown-select {
  /*background-color: #bdc3c7;*/
  /*color: #ecf0f1;*/
      background-color: #0E3679;
    color: #fff;
}
.dropdown-select:hover,
.dropdown-select:focus {
  background-color: #0E3679;
}
.active .dropdown-select {
  background-color: #0E3679;
}
.dropdown-select-ul {
  border-color: #34495e;
  background: #ecf0f1;
  color: #34495e;
}
.dropdown-select-ul li:hover,
.dropdown-select-ul li:focus {
  background: #e3e9eb;
}
.dropdown-select-ul li.selected {
  background: #0E3679;
  color: #fff;
}
.dropdown-select-ul li.optgroup {
  background: #ecf0f1;
  color: #a1aab0;
  border-bottom-color: #bdc3c7;
}
@keyframes fadeIn {
  0% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}

.filter-nav .filter-nav-li{
   display: inline-block;
     width:25%;
}
.filter-nav .filter-nav-li select {
    height: 42px;background:#AC0F0B;color#fff
}


#app { 
    overflow:unset;
}
.leftSideColFixed{
     position: -webkit-sticky;position: sticky;top: 163px;
     box-shadow: 0 3px 6px rgb(0 0 0 / 16%);
     
}
.topHeaderlFixed{
         position: sticky;
    top: 75px;
    z-index: 9;
     margin-bottom: 14px;
}
.topHeaderlFixed .filter-nav{
  box-shadow: 0 3px 6px rgb(0 0 0 / 16%);
    background: #fff;
    padding: 12px 12px;  
}
 </style>
 <main role="main">
	<section class="invest-long page-heading-h2" style="background: #edeff1;">
        <div class="container" style="box-shadow: none;">
            <div class="">
                
                <div class="row">
                    <div class="col-md-12 topHeaderlFixed">
                        <ul class="filter-nav ">
                           
                            
                            <li class="filter-nav-li" style="">
                                <select id="plan_cover_filter" class="custom-select" >
                                    <option value="2"> Cover:2-3 Lakh</option>
                                    @if(isset(Auth::guard('customers')->user()->id))
                                    <option value="4" selected>Cover:4-5 Lakh</option>
                                    <option value="6">Cover:6- 8Lakh</option>
                                    <option value="9">Cover:9- 10Lakh</option>
                                    <option value="11">Cover:11- 15Lakh</option>
                                    <option value="16">Cover:16- 20Lakh</option>
                                    <option value="21">Cover:21- 25Lakh</option>
                                    <option value="26">Cover:More then 25Lakh</option>
                                    @else
                                       @if(Auth::guard('agents')->user()->userType=="POSP")
                                         <option value="4" selected>Cover:4-5 Lakh</option>
                                        @else
                                        <option value="4" selected>Cover:4-5 Lakh</option>
                                        <option value="6">Cover:6- 8Lakh</option>
                                        <option value="9">Cover:9- 10Lakh</option>
                                        <option value="11">Cover:11- 15Lakh</option>
                                        <option value="16">Cover:16- 20Lakh</option>
                                        <option value="21">Cover:21- 25Lakh</option>
                                        <option value="26">Cover:More then 25Lakh</option>
                                        @endif
                                    @endif
                                </select>

                             </li>
                             
                             <li class="filter-nav-li">
                                 <select id="plan_policy_typ_filter"  class="custom-select" >
                                    <option value="FL" selected>FAMILYFLOATER (Cover Type)</option>
                                    <option value="IN" >INDIVIDUAL (Cover Type)</option>
                                </select>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <div class="card leftSideColFixed">
                              <div class="card-header">
                                Policy benefits
                              </div>
                              <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox plan_check">
                            		  	<input type="checkbox" class="custom-control-input" id="featureCover1" value="1" name="featureCover1" data-filter-by="9">
                            		  	<label class="custom-control-label" for="featureCover1">No Claim Bonus</label>
                            		</div> 
                                </li>
                                <li class="list-group-item">
                                      <div class="custom-control custom-checkbox plan_check">
                            		  	<input type="checkbox" class="custom-control-input" id="featureCover1" value="1" name="featureCover1" data-filter-by="9">
                            		  	<label class="custom-control-label" for="featureCover1">Free Health Checkup</label>
                            		</div> 
                                </li>
                                <li class="list-group-item">
                                      <div class="custom-control custom-checkbox plan_check">
                            		  	<input type="checkbox" class="custom-control-input" id="featureCover1" value="1" name="featureCover1" data-filter-by="9">
                            		  	<label class="custom-control-label" for="featureCover1">Opd expenses</label>
                            		</div> 
                                </li>
                                <li class="list-group-item">
                                      <div class="custom-control custom-checkbox plan_check">
                            		  	<input type="checkbox" class="custom-control-input" id="featureCover1" value="1" name="featureCover1" data-filter-by="9">
                            		  	<label class="custom-control-label" for="featureCover1">Day care treatments</label>
                            		</div> 
                                </li>
                                 <li class="list-group-item">
                                      <div class="custom-control custom-checkbox plan_check">
                            		  	<input type="checkbox" class="custom-control-input" id="featureCover1" value="1" name="featureCover1" data-filter-by="9">
                            		  	<label class="custom-control-label" for="featureCover1"> Post-hospitalization covered</label>
                            		</div> 
                                </li>
                                <li class="list-group-item">
                                      <div class="custom-control custom-checkbox plan_check">
                            		  	<input type="checkbox" class="custom-control-input" id="featureCover1" value="1" name="featureCover1" data-filter-by="9">
                            		  	<label class="custom-control-label" for="featureCover1">Pre-hospitalization covered</label>
                            		</div> 
                                </li>
                                
                              </ul>
                            </div>
                    </div><!--col-md-4-->
                    <div class="col-md-9">
                        <div class="row partner-row digit-partner-row">
                            <div class="col-md-2 col-logo">
                                <div class="more-action bg-white">
                                     <img src="{{asset('assets/partners/digit-insurance.png')}}" />
                                     <div class="show-more-plans less" data-partner="digit">
                                          <a href="#" class="txt-red font-14 show-more-txt">Hide</a>
                                     </div>
                                </div>
                                
                                
                            </div>
                            <div class="col-md-10 col-content bg-white elem-digit-health">
                              @include('health.plan-skelton-loader')
                            </div>
                        </div><!--inner row col-8-->
                        
                        <div class="row partner-row hdfcergo-partner-row">
                            <div class="col-md-2 col-logo">
                                <div class="more-action bg-white">
                                     <img  src="{{asset('assets/partners/HDFC-Ergo-logo.png')}}" />
                                     <div class="show-more-plans less" data-partner="hdfcergo">
                                          <a href="#" class="txt-red font-14 show-more-txt">Hide</a>
                                     </div>
                                </div>
                                
                                
                            </div>
                            <div class="col-md-10 col-content bg-white elem-hdfcergo-health">
                                @include('health.plan-skelton-loader')
                                <!--[[QUOTE ELEMENT WILL BE HERE]]-->
                            </div>
                        </div><!--inner row col-8-->
                        
                        <div class="row partner-row manipal_cigna-partner-row">
                            <div class="col-md-2 col-logo">
                                <div class="more-action bg-white">
                                     <img style="width:80%" src="{{asset('assets/partners/ManipalCigna_60a251440f393.png')}}" />
                                     <div class="show-more-plans less" data-partner="manipal_cigna">
                                          <a href="#" class="txt-red font-14 show-more-txt">Hide</a>
                                     </div>
                                </div>
                                
                                
                            </div>
                            <div class="col-md-10 col-content bg-white elem-manipal_cigna-health">
                                @include('health.plan-skelton-loader')
                                <!--[[QUOTE ELEMENT WILL BE HERE]]-->
                            </div>
                        </div><!--inner row col-8-->
                        
                        <div class="row partner-row care-partner-row">
                            <div class="col-md-2 col-logo">
                                <div class="more-action bg-white">
                                     <img style="width:80%" src="{{asset('assets/partners/CareHealthInsurance_60a2509606d1d.jpg')}}" />
                                     <div class="show-more-plans less" data-partner="care">
                                          <a href="#" class="txt-red font-14 show-more-txt">Hide</a>
                                     </div>
                                </div>
                                
                                
                            </div>
                            <div class="col-md-10 col-content bg-white elem-care-health">
                                @include('health.plan-skelton-loader')
                                <!--[[QUOTE ELEMENT WILL BE HERE]]-->
                            </div>
                        </div><!--inner row col-8-->
                        
                         
                    </div><!--col-md-8-->
                </div>
                
            </div>
            <style>
            .campareBox{
                        position: fixed;
                        box-shadow: 0 -5px 6px 0 rgb(0 0 0 / 16%);
                        bottom: 0;
                        padding: 20px;
                        background: #fff;
                        z-index: 98;
                        right: 0;
                        left:0;
                 }
                .campareBox .quotesCompareDiv{
                    box-shadow: 0 3px 6px rgb(0 0 0 / 16%);border-radius: 5px;
                }
                .campareBox .quotesCompareDiv ul{
                    margin-bottom:0px;
                }
                 .campareBox .quotesCompareDiv ul li{
                    display: inline-block;
                    /*vertical-align: top;*/
                    
                 }
                 .campareBox .quotesCompareDiv ul li.QuoteCompareImage{
                    width:30%; 
                 }
                 .campareBox .quotesCompareDiv ul li.QuoteCompareplanIndfo{
                    width:68%;  
                 }
                 .campareBox .quotesCompareDiv ul li.QuoteCompareplanIndfo p{
                     margin: 0 0 4px 0;
                    font-size: 12px;
                    font-weight: 600;
                 }
                 .btnCompareNow{
                         margin-top: 9%;
                         width: 50%;
                 }
            </style>
            
           
        </div>
    </section>
     <div class="campareBox">
                <div class="row">
                    <div class="col-md-3">
                        
                        <div class="card quotesCompareDiv" style="">
                            <ul>
                                <li class="QuoteCompareImage" ><img  src="{{asset('assets/partners/HDFC-Ergo-logo.png')}}"/></li>
                                <li class="QuoteCompareplanIndfo">
                                    <p class="txt-blue">Optima Secure</p>
                                    <p class="">Cover: ₹5L</p>
                                </li>
                            </ul>
                        </div>
                       
                    </div>
                    <div class="col-md-3">
                        
                        <div class="card quotesCompareDiv" style="">
                            <ul>
                                <li class="QuoteCompareImage"><img  src="{{asset('assets/partners/CareHealthInsurance_60a2509606d1d.jpg')}}" /></li>
                                <li class="QuoteCompareplanIndfo">
                                    <p>Care- No Claim Bunus Super</p>
                                    <p>Cover: ₹5L</p>
                                </li>
                            </ul>
                        </div>
                        
                    </div>
                    <div class="col-md-3">
                        
                        <div class="card quotesCompareDiv" style="">
                            <ul>
                                <li class="QuoteCompareImage"><img  src="{{asset('assets/partners/digit-insurance.png')}}" /></li>
                                <li class="QuoteCompareplanIndfo">
                                    <p>Digit Silver Health Care</p>
                                    <p>Cover: ₹5L</p>
                                </li>
                            </ul>
                        </div>
                        
                    </div>
                    <div class="col-md-3">
                        <button class="btnSF btn-blue-outline btnCompareNow">Compare Now</button>
                    </div>
                </div>
            </div>
  </main>
  
  <?php /*<div class="row health-card">
                                    <div class="col-md-6">
                                           <div class="card left-card">
                                              <div class="card-header"> Digit Gold </div>
                                              <div class="card-body">
                                                   <ul class="health-card-features">
                                                      <li>Single pvt AC Room</li>
                                                      <li>Restoration of cover</li>
                                                      <li>Free health checkup</li>
                                                      <li>Existing Illness cover</li>
                                                      <li>More Features</li>
                                                   </ul>  
                                                <!--<h5 class="card-title">Special title treatment</h5>-->
                                                <!--<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>-->
                                                <!--<a href="#" class="btn btn-primary">Go somewhere</a>-->
                                              </div>
                                            </div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <div class="card right-card">
                                            <ul class="health-card-premium">
                                                <li>
                                                    <span>Cover Amount</span>
                                                    <h4 class="h4-amt">₹5 Lakhs</h4>
                                                </li>
                                                <li>
                                                    <span>Premium Amount</span>
                                                    <h4 class="h4-amt">₹10689.65</h4>
                                                </li>
                                            </ul>
                                            <button class="btnSF btn-red btn-radius-10" style="line-height: 35px;font-weight: 700;">Buy Now</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="custom-control custom-checkbox plan_check">
                            		  	<input type="checkbox" class="custom-control-input" id="addtoCampre" value="1" name="addtoCampre">
                            		  	<label class="custom-control-label" style="font-weight: 600;" for="addtoCampre">Add to Compare</label>
                            		</div> 
                                    </div>
                                     <div class="col-md-6">
                                       <a href="#" class="downloadQuoteLink txt-blue"><span class="fa fa-download"></span> Download Quote</a>
                                     </div>
                               </div>
                               <div class="row health-card more-card digit-card">
                                    <div class="col-md-6">
                                           <div class="card left-card">
                                              <div class="card-header"> Digit Gold </div>
                                              <div class="card-body">
                                                   <ul class="health-card-features">
                                                      <li>Single pvt AC Room</li>
                                                      <li>Restoration of cover</li>
                                                      <li>Free health checkup</li>
                                                      <li>Existing Illness cover</li>
                                                      <li>More Features</li>
                                                   </ul>  
                                                <!--<h5 class="card-title">Special title treatment</h5>-->
                                                <!--<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>-->
                                                <!--<a href="#" class="btn btn-primary">Go somewhere</a>-->
                                              </div>
                                            </div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <div class="card right-card">
                                            <ul class="health-card-premium">
                                                <li>
                                                    <span>Cover Amount</span>
                                                    <h4 class="h4-amt">₹5 Lakhs</h4>
                                                </li>
                                                <li>
                                                    <span>Premium Amount</span>
                                                    <h4 class="h4-amt">₹10689.65</h4>
                                                </li>
                                            </ul>
                                            <button class="btnSF btn-red btn-radius-10" style="line-height: 35px;font-weight: 700;">Buy Now</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="custom-control custom-checkbox plan_check">
                            		  	<input type="checkbox" class="custom-control-input" id="addtoCampre" value="1" name="addtoCampre">
                            		  	<label class="custom-control-label" style="font-weight: 600;" for="addtoCampre">Add to Compare</label>
                            		</div> 
                                    </div>
                                     <div class="col-md-6">
                                       <a href="#" class="downloadQuoteLink txt-blue"><span class="fa fa-download"></span> Download Quote</a>
                                     </div>
                               </div>
                               <div class="row health-card more-card digit-card">
                                    <div class="col-md-6">
                                           <div class="card left-card">
                                              <div class="card-header"> Digit Gold </div>
                                              <div class="card-body">
                                                   <ul class="health-card-features">
                                                      <li>Single pvt AC Room</li>
                                                      <li>Restoration of cover</li>
                                                      <li>Free health checkup</li>
                                                      <li>Existing Illness cover</li>
                                                      <li>More Features</li>
                                                   </ul>  
                                                <!--<h5 class="card-title">Special title treatment</h5>-->
                                                <!--<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>-->
                                                <!--<a href="#" class="btn btn-primary">Go somewhere</a>-->
                                              </div>
                                            </div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <div class="card right-card">
                                            <ul class="health-card-premium">
                                                <li>
                                                    <span>Cover Amount</span>
                                                    <h4 class="h4-amt">₹5 Lakhs</h4>
                                                </li>
                                                <li>
                                                    <span>Premium Amount</span>
                                                    <h4 class="h4-amt">₹10689.65</h4>
                                                </li>
                                            </ul>
                                            <button class="btnSF btn-red btn-radius-10" style="line-height: 35px;font-weight: 700;">Buy Now</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="custom-control custom-checkbox plan_check">
                            		  	<input type="checkbox" class="custom-control-input" id="addtoCampre" value="1" name="addtoCampre">
                            		  	<label class="custom-control-label" style="font-weight: 600;" for="addtoCampre">Add to Compare</label>
                            		</div> 
                                    </div>
                                     <div class="col-md-6">
                                       <a href="#" class="downloadQuoteLink txt-blue"><span class="fa fa-download"></span> Download Quote</a>
                                     </div>
                               </div>
                               */?>
 @endsection