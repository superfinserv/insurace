  @extends($layout)
    @section('content')
<style>
 
.media-box-container{
   border: 1px solid #AC0F0B;
    padding: 5px 5px 5px 20px;
    /* display: block; */
    /* position: relative; */
    /* padding-left: 30px; */
    margin-bottom: 15px;
    /* cursor: pointer; */
    /* font-size: 18px; */
    border-radius: 8px;
    box-shadow: 0px 0px 10px #ccc;c;
}
.media-box-container .mediabox{
    padding: 0;
    width: 100%;
    display: table;
    margin-bottom: 0px;
}
.media-box-container .mediabox li{
   display:table-cell;width:50%;
}

.media-box-container .mediabox li select.age-selector{
    outline: none;
    border: none;
    font-size: 14px;
    width: 70%;
}
}
.media-box-container .mediabox li select:first-child{
    color: #b6b3b3;
}

.media-box-container .mediabox li label{
    color: #000;
    font-weight: 600;
}
.span-error{
    font-size: 10px;
    float: right;
    margin-top: -15px;
    color: red;
    font-weight: 600;
}
.select2-error{
    font-size: 10px;
    float: right;
    color: red;
    font-weight: 600;
}
.mediabox select{
    border:0px;
   outline:0px
}.ui-menu .ui-menu-item {
  padding: 5px 5px;
  border-bottom: 1px solid #ccc;
}

	.ui-autocomplete {
		max-height: 100px;
		overflow-y: auto;
		/* prevent horizontal scrollbar */
		overflow-x: hidden;
	}
	/* IE 6 doesn't support max-height
	 * we use height instead, but this forces the menu to always be this tall
	 */
	* html .ui-autocomplete {
		height: 100px;
	}
	

  </style>
<main role="main">
  	<section class="health-profile">
  		<div class="container healt-pro-bg ptb hltmt-40 page-heading-h2">
  		    <h2 class="text-center page-title" >Select age of each member</h2>
             <div class="section-inner">
                <div class="helth-introInfo" style="padding-top: 20px;">
                    <div class="row">
                        <div class="col-md-2 col-sm-12 col-xs-12"></div>
                        <div class="col-md-8 col-sm-12 col-xs-12">
                            <div class="listing-members row"></div>
                            <!--<div class="row">-->
                            <!--    <div class="col-md-6 col-sm-12 col-xs-12">-->
                            <!--        <div class="media-box-container">-->
                            <!--             <ul class="mediabox" style="">-->
                            <!--              <li><label>You</label></li>-->
                            <!--              <li class="text-right">-->
                            <!--                    <select class="age-selector">-->
                            <!--                      <option value="">Select age</option>-->
                            <!--                      <option value="5">5</option>-->
                            <!--                      <option value="6">6</option>-->
                            <!--                    </select>-->
                            <!--             </li>-->
                            <!--            </ul>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--    <div class="col-md-6 col-sm-12 col-xs-12">-->
                            <!--         <div class="media-box-container">-->
                            <!--             <ul class="mediabox">-->
                            <!--              <li style=""><label>Wife</label></li>-->
                            <!--              <li class="text-right"><select class="age-selector"><option value="">Select age</option></select></li>-->
                            <!--            </ul>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--</div>-->
                            <!--<div class="row">-->
                            <!--    <div class="col-md-6 col-sm-12 col-xs-12">-->
                            <!--        <div class="media-box-container">-->
                            <!--             <ul class="mediabox" style="">-->
                            <!--              <li><label>Daughter</label></li>-->
                            <!--              <li class="text-right"><select class="age-selector"><option value="">Select age</option></select></li>-->
                            <!--            </ul>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--    <div class="col-md-6 col-sm-12 col-xs-12">-->
                            <!--         <div class="media-box-container">-->
                            <!--             <ul class="mediabox">-->
                            <!--              <li style=""><label>Daughter</label></li>-->
                            <!--              <li class="text-right"><select class="age-selector"><option value="">Select age</option></select></li>-->
                            <!--            </ul>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--</div>-->
                            <!--<div class="row">-->
                            <!--    <div class="col-md-6 col-sm-12 col-xs-12">-->
                            <!--        <div class="media-box-container">-->
                            <!--             <ul class="mediabox" style="">-->
                            <!--              <li><label>Father</label></li>-->
                            <!--              <li class="text-right"><select class="age-selector"><option value="">Select age</option></select></li>-->
                            <!--            </ul>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--    <div class="col-md-6 col-sm-12 col-xs-12">-->
                            <!--         <div class="media-box-container">-->
                            <!--             <ul class="mediabox">-->
                            <!--              <li style=""><label>Mother</label></li>-->
                            <!--              <li class="text-right"><select class="age-selector"><option value="">Select age</option></select></li>-->
                            <!--            </ul>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--</div>-->
                            <div class="row">
                                  
                                  <div class="col-md-4 col-sm-12 col-xs-12" style="margin-top:15px;">
                                      <div class="">
                                         <select class="state-city-selector" id="state_id" name="state_id" tabindex="1">
                                              <option value="">Choose state</option>
                                              <?php foreach ($states as  $value) { ?>
                                                <option value="{{$value->id}}-{{$value->name}}">{{$value->name}}</option>
                                              <?php } ?>
                                          </select>
                                      </div>
                                  </div>
                                   <div class="col-md-4 col-sm-12 col-xs-12" style="margin-top:15px;">
                                       <div class="">
                                          <select class=" state-city-selector" id="city_id" name="city_id" tabindex="2">
                                              <option value="">Choose City</option>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="col-md-4 col-sm-12 col-xs-12" style="margin-top:15px;">
                                       <div class="">
                                           <input type="text" tabindex="3" disabled style="margin-bottom:0px;" id="pincode" name="pincode" class="form-control number-only" maxlength="6" placeholder="Enter Pincode"/>
                                       </div>
                                   </div>
                                 
                            </div>
                            <div class="row text-center" style="margin-top:15px;">
                                <div class="col-md-12">
                                      <a href="{{url('health-insurance/health-profile-members')}}" class="btn btn-ss"> <i class="left fa fa-chevron-left "></i> Back</a>
                                     <button type="button"  class="btn btn-ss btnTable3" tabindex="4">Continue <i class="right fa fa-chevron-right "></i></button>
                                </div>
                               
                            </div>
                            
                        </div>
                        <div class="col-md-2 col-sm-12 col-xs-12"></div>
                    </div>
                    
                
                </div>
            </div>
            
        </div>
    </section>
</main>
@endsection

 
