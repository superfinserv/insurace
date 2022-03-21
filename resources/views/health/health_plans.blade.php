 @extends($layout)
@section('content')
<style>
.plan-card{ margin-bottom: 15px;box-shadow: 0px 5px 8px #b1aeae; border: none;}
.plan-card .plan-card-header{display:flex;}
.plan-card .plan-card-header .supp-company{
    -webkit-flex: 1 0 100px;
    -ms-flex: 1 0 100px;
     flex: 1 0 100px; 
    -webkit-align-self: stretch;
    -ms-flex-item-align: stretch;
    align-self: stretch; 
    -webkit-flex-direction: column;
    -ms-flex-direction: column;
    flex-direction: column;
    -webkit-justify-content: space-around;
    -ms-flex-pack: distribute;
    justify-content: space-around;
    -webkit-align-items: flex-start;
    -ms-flex-align: start;
    align-items: flex-start;
    min-height: 48px;
}
.plan-card .plan-card-header .supp-company img.com-logo{
    display: block;max-width: 100px;max-height: 32px;
}
.plan-card .plan-card-header .supp-company div.com-name{
    font-size: 10px;
    line-height: 20px;
    color: #AC0F0B;
    max-width: 130px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    cursor:pointer;
}
.plan-card .plan-card-header ul.plan-header-right{
    display: -webkit-flex;display: -ms-flexbox;display: flex;-webkit-align-items: center;-ms-flex-align: center;align-items: center;margin-bottom: 0px;
}
.plan-card .plan-card-header ul.plan-header-right .info-box{
    display:inline;font-size: 20px;padding: 1px 12px
}
.plan-card .plan-card-header ul.plan-header-right .info-box h4{
    margin-bottom:0px;font-size: 12px;
}
.plan-card .plan-card-header ul.plan-header-right .info-box span{
    font-weight: 700;
    font-size: 16px;
}
.plan-card .plan-desc-body .feature-title{
    font-size: 12px;
    font-weight: 600;
}
.plan-card .plan-desc-body .plan-feature-list li{
    font-size: 14px;line-height: 23px;
}
.plan-card .plan-desc-body .plan-feature-list li .hand-icon{
   font-size: 12px;
}
.plan-card .plan-desc-body .plan-feature-list li span.right-tooltip{
    float: right;color: #AC0F0B;
}
.plan-card .plan-desc-body .plan-feature-list li span.right-tooltip i{
    font-size:16px;
}

.plan-card .plan-card-footer{
	    padding:0px;
	}
.plan-card .plan-card-footer ul{
	    display: flex;margin-bottom:0px;
	}
	
.plan-card .plan-card-footer ul li{
	    display: inline;
        text-align: center;  
        padding: 10px 4px;
	}
.plan-card .plan-card-footer ul li.cols-1{
	   width: 40%;
    }
.plan-card .plan-card-footer ul li.cols-2{
	   width: 60%;
	   color:#fff;background: #AC0F0B;
    }
.plan-card .plan-card-footer ul li.cols-1 a{
	    font-size: 15px;
        font-weight: 600;
        color: #AC0F0B;
	}
.plan-card .plan-card-footer ul li.cols-2 a.btn-buynow{
	     color: #fff;padding: 12px 12px;
	     width:100%;
	}
	
	
	/**
 * placeholder-loading v0.2.5
 * Author: Zalog (https://www.zalog.ro/)
 * License: MIT
 **/
.ph-item {
  direction: ltr;
  position: relative;
  display: flex;
  flex-wrap: wrap;
  padding: 30px 15px 15px 15px;
  overflow: hidden;
  margin-bottom: 30px;
  background-color: #fff;
  border: 1px solid #e6e6e6;
  border-radius: 2px; }
  .ph-item, .ph-item *,
  .ph-item ::after, .ph-item ::before {
    box-sizing: border-box; }
  .ph-item::before {
    content: " ";
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 50%;
    z-index: 1;
    width: 500%;
    margin-left: -250%;
    -webkit-animation: phAnimation 0.8s linear infinite;
            animation: phAnimation 0.8s linear infinite;
    background: linear-gradient(to right, rgba(255, 255, 255, 0) 46%, rgba(255, 255, 255, 0.35) 50%, rgba(255, 255, 255, 0) 54%) 50% 50%; }
  .ph-item > * {
    flex: 1 1 auto;
    display: flex;
    flex-flow: column;
    padding-right: 15px;
    padding-left: 15px; }

.ph-row {
  display: flex;
  flex-wrap: wrap;
  margin-bottom: 7.5px; }
  .ph-row div {
    height: 10px;
    margin-bottom: 7.5px;
    background-color: #ced4da; }
  .ph-row .big,
  .ph-row.big div {
    height: 20px;
    margin-bottom: 15px; }
  .ph-row .empty {
    background-color: rgba(255, 255, 255, 0); }

.ph-col-2 {
  flex: 0 0 16.66667%; }

.ph-col-4 {
  flex: 0 0 33.33333%; }

.ph-col-6 {
  flex: 0 0 50%; }

.ph-col-8 {
  flex: 0 0 66.66667%; }

.ph-col-10 {
  flex: 0 0 83.33333%; }

.ph-col-12 {
  flex: 0 0 100%; }

.ph-avatar {
  position: relative;
  width: 100%;
  min-width: 60px;
  background-color: #ced4da;
  margin-bottom: 15px;
  border-radius: 50%;
  overflow: hidden; }
  .ph-avatar::before {
    content: " ";
    display: block;
    padding-top: 100%; }

.ph-picture {
  width: 100%;
  height: 120px;
  background-color: #ced4da;
  margin-bottom: 15px; }

@-webkit-keyframes phAnimation {
  0% {
    transform: translate3d(-30%, 0, 0); }
  100% {
    transform: translate3d(30%, 0, 0); } }

@keyframes phAnimation {
  0% {
    transform: translate3d(-30%, 0, 0); }
  100% {
    transform: translate3d(30%, 0, 0); } }

	
	   .plan-filter-ul{
           border-bottom: 2px solid #AC0F0B;text-align: right;
        }
        .plan-filter-ul li{
          display:inline;
        }
        .plan-filter-ul li select.plan-filter{
          padding: 12px 12px 12px 12px;height: auto;font-size: 12px;border-radius: 0px;font-weight: 600;
        }
        
   @media only screen and (max-width: 600px) { 
       .plan-filter-ul{
           border-bottom: 2px solid #AC0F0B;text-align: none;
        }
        .plan-filter-ul li{
          display:inline-block;
          width:48%;
        }
        .plan-filter-ul li select.plan-filter{
          padding: 12px 12px 12px 12px;height: auto;font-size: 10px;border-radius: 0px;font-weight: 600;width:100%;
        }
   }
</style>
<main role="main">
	<section class="invest-long page-heading-h2" style="background: none;">
        <div class="container invest-long-bg" style="box-shadow: none;">
            <div class="row" id="data_alll--">
                <div class="col-12 col-md-12 col-lg-12 col-sm-12">
                    <div class="filters-plans">
                        <ul >
                            <li style="display:inline;">
                                <i style="font-size: 20px;" class="fa fa-bars" aria-hidden="true"></i>
                                <span style="font-weight: 700;color: #000;">Best Match plans for </span>
                            </li>
                            <li style="display:inline;"><span style="font-size:12px;" id="listMembersHead">You(31 Yrs) | Spouse( 28Yrs) | Son(14 Yrs) | Daughter(10 Yrs)</span></li>
                           
                            <!--<li style="display: inline;float: right;font-weight: 700;color: #000;"><span>Health Insurance Plans</span></li>-->
                        </ul>
                        
                        <ul class="plan-filter-ul" >
                            <!--<li style="display:inline;">-->
                            <!--    <label style="padding: 12px;border: 1px solid #ccc;box-shadow: 0px 0px 1px #ccc;">Plan type: <b>Base</b></label>-->
                            <!--</li>-->
                            <li class="plan-filter-li" >
                                <select id="plan_policy_typ_filter" class="plan-filter"  style="">
                                    <option value="FL" selected>FAMILYFLOATER (Cover Type)</option>
                                    <option value="IN" >INDIVIDUAL (Cover Type)</option>
                                </select>
                            </li>
                            <li class="plan-filter-li">
                                <!--<label style="padding: 12px;border: 1px solid #ccc;box-shadow: 0px 0px 1px #ccc;">Cover:4.5 Lacs- 10Lacs</label>-->
                                <select id="plan_cover_filter" class="plan-filter" style=";">
                                    <option value="2-3"> Cover:2-3 Lakh</option>
                                    <option value="4-9" selected>Cover:4-9 Lakh</option>
                                    <option value="10-15">Cover:10- 15Lakh</option>
                                    <option value="16-25">Cover:16- 25Lakh</option>
                                    <option value="26-#">Cover:More then 25Lakh</option>
                                </select>
                                
                            </li>
                        </ul>
                    </div>
                </div>
                
    			 <!--<h4>Care Advantage</h4>-->
                 
        <!--         <div class="col-12 col-md-12 col-lg-12 col-sm-12">-->
        <!--                 <div class="row list-additional-plans"></div>-->
        <!--        </div>-->
        <!--        <hr/>-->
               
                <div class="col-12 col-md-12 col-lg-12 col-sm-12  ">
                     <h4 style="color:#AC0F0B;margin: 15px 0px;">Recommended Plans</h4>
                   <div class="row list-health-plans">
                         <?php for($i=0;$i<=6;$i++){ ?>
                         <div class="col-12 col-md-6 col-lg-4 col-sm-12 ph-elements" id="element-<?=$i;?>">
                              <div class="ph-item">
                                <div class="ph-col-12">
                                  <div class="ph-picture"></div>
                                  <div class="ph-row">
                                    <div class="ph-col-4"></div>
                                    <div class="ph-col-8 empty"></div>
                                    <div class="ph-col-12"></div>
                                  </div>
                                </div>
                                
                                <div>
                                  <div class="ph-row">
                                    <div class="ph-col-12"></div>
                                    <div class="ph-col-2"></div>
                                    <div class="ph-col-10 empty"></div>
                                    <div class="ph-col-8 big"></div>
                                    <div class="ph-col-4 big empty"></div>
                                  </div>
                                </div>
                              </div>
                          </div>
                         <?php } ?>
                         
       
                         
                     </div>
                </div>
                
                
            
			</div>
			
			 
    	</div>
    </section>

</main>


@endsection