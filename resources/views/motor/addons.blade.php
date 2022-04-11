<style>
    .ui-slider-horizontal .ui-slider-handle {
        top: -5px;
        margin-left: -.6em;
    }
    .ui-slider .ui-slider-handle {
        width: 15px;
        height: 15px;
        border-radius: 50%;
    }
    .ui-slider-horizontal {
        height: 5px;
    }
    .ui-widget-content {
        border: 1px solid #ddd;
        background: #294b7c;
        color: #333;
    }
    .ui-widget.ui-widget-content {
        border: 1px solid #294b7c;
    }
    .ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default, .ui-button, html .ui-button.ui-state-disabled:hover, html .ui-button.ui-state-disabled:active {
      border: 1px solid #d40100;
      background: #d40100; 
    }
</style>

<div class="filter-content checksbox ">
	<div class="card-body">
	    <div class="TPCovers">
	    <h4 style="font-weight: 600;font-size: 14px;">PA Owner Driver</h4>
		 <div class="custom-control custom-radio plan_check PACover-group show-pop" data-toggle="tooltip" title="An accident cover which provides financial assistance to the car's owner in case of disablement or death due to an accident. Every individual vehicle owner must opt for this cover as per IRDAI guidelines, except for those without a driving license or having an existing Personal Accident cover of at least Rs. 15 lakhs." data-placement="top">
		  	<input type="radio" class="custom-control-input PACover com-cover" id="isPA_OwnerDriverCover" value="1" name="PA_OwnerDriverCover">
		  	<label style="font-size: 13px;" class="custom-control-label" for="isPA_OwnerDriverCover">PA Owner Driver Cover (Personal Accident)</label>
		    
		    <div id="pa-owner-driver-elem" style="display:none;">
		  	    <select class="" id="pa-owner-driver-value" style="height: 25px;margin-left: 15px;border-radius: 0px;font-size: 12px;width: 60%;">
			  	    
			  	    <option value="1">1 Year</option>
			  	    	@if($motor=='car')
			  	           <option value="3">3 Year</option>
			  	        @else
			  	         <option value="5">5 Year</option>
			  	       @endif
			  	    
			  	</select>
			  	
		  	    <button class="btn btn-small" id="btn-pa-owner-driver">UPDATE</button>
		  	</div>
		  	
		  	
		 </div>
		 <div class="custom-control custom-radio plan_check PACover-group" style="margin-top: 10px;">
		  	<input type="radio" class="custom-control-input PACover com-cover" id="notPA_OwnerDriverCover" value="0" name="PA_OwnerDriverCover" >
		  	<label style="margin-top: 1px;font-size: 10px;line-height: 16px;font-weight: 600;" class="custom-control-label" for="notPA_OwnerDriverCover">I hereby confirm that I don’t have effective driving licence / already have an alternate Personal Accident insurance cover of Rs. 15 lakhs on the date of commencement of this policy.</label>
		 </div>
		 <p ></p>
		
		
		<hr/>
		
		<h4 style="font-weight: 600;font-size: 14px;">Unnammed PA Cover</h4>
		<div class="custom-control custom-checkbox plan_check" data-toggle="tooltip" title="An accident cover which provides financial assistance to all passengers in the car at the time of accident in case of disablement or death to the passengers. Naming of individual is not required.">
		  	<input type="checkbox" data-name="pa-unnamed-passanger" class="custom-control-input pa-unnamed com-cover" id="isPA_UNPassCover" value="1" name="isPA_UNPassCover" data-filter-by="9">
		  	<label class="custom-control-label" for="isPA_UNPassCover">PA Cover for Unnamed passanger</label>
		  	<div id="pa-unnamed-passanger-elem" style="display:none;">
		  	    <select class="" id="pa-unnamed-passanger-value" style="height: 25px;margin-left: 15px;border-radius: 0px;font-size: 12px;width: 60%;">
		  	        @if($motor=='car')
    		  	         @for($i=10000;$i<=200000;$i +=10000)
    			  	    <option value="{{$i}}">{{$i}}</option>
    			  	    @endfor
		  	        @else
    			  	    @for($i=10000;$i<=100000;$i +=10000)
    			  	    <option value="{{$i}}">{{$i}}</option>
    			  	    @endfor
			  	    @endif
			  	</select>
			  	
		  	    <button class="btn btn-small" id="btn-pa-unnamed-passanger">UPDATE</button>
		  	</div>
		  	
		</div>
		
		<div class="custom-control custom-checkbox plan_check" data-toggle="tooltip" title="An accident cover which extends financial assistance for your paid driver in case of disablement or death to the driver due to an accident, as per the Workmen Compensation Act.">
		  	<input type="checkbox" class="custom-control-input addonCover com-cover" id="isPA_UNDriverCover" value="1" name="isPA_UNDriverCover" data-filter-by="9">
		  	<label class="custom-control-label" for="isPA_UNDriverCover">PA Cover for Paid Driver</label>
		</div>
		<hr/>
		
		<h4 style="font-weight: 600;font-size: 14px;">Legal Liability Cover</h4>
		<div class="custom-control custom-checkbox plan_check">
		  	<input type="checkbox" class="custom-control-input addonCover com-cover" id="isLL_PaidDriverCover" value="1" name="isLL_PaidDriverCover" data-filter-by="9">
		  	<label class="custom-control-label" for="isLL_PaidDriverCover">Legal Liability to Paid Driver</label>
		</div> 
		
		<div class="custom-control custom-checkbox plan_check">
		  	<input type="checkbox" class="custom-control-input addonCover com-cover" id="isLL_UNPassCover" value="1" name="isLL_UNPassCover" data-filter-by="9">
		  	<label class="custom-control-label" for="isLL_UNPassCover">Legal Liability to Unnamed Passanger</label>
		</div> 
		
		<div class="custom-control custom-checkbox plan_check">
		  	<input type="checkbox" class="custom-control-input addonCover com-cover" id="isLL_EmpCover" value="1" name="isLL_EmpCover" data-filter-by="9">
		  	<label class="custom-control-label" for="isLL_EmpCover">Legal Liability to Employees</label>
		</div> 
		
		<hr/>
		</div>
		<h4 style="font-weight: 600;font-size: 14px;"><u>Motor Own Damage -  Add Ons</u></h4>
		<div class="custom-control custom-checkbox plan_check"> 
		  	<input type="checkbox" class="custom-control-input addonCover moter-OD" id="isBreakDownAsCover" value="1" name="isBreakDownAsCover" data-filter-by="9">
		  	<label class="custom-control-label" for="isBreakDownAsCover">Road Side Assistance</label>
		</div>
		
		@if($motor=='car')
		
		<div class="custom-control custom-checkbox plan_check"> 
		  	<input type="checkbox" class="custom-control-input addonCover moter-OD" id="isPersonalBelongCover" value="1" name="isPersonalBelongCover" data-filter-by="9">
		  	<label class="custom-control-label" for="isPersonalBelongCover">Personal Belongings</label>
		</div>
		<div class="custom-control custom-checkbox plan_check"> 
		  	<input type="checkbox" class="custom-control-input addonCover moter-OD" id="isKeyLockProCover" value="1" name="isKeyLockProCover" data-filter-by="9">
		  	<label class="custom-control-label" for="isKeyLockProCover">Key and Lock Protect</label>
		</div>
		@endif
		<!--Do you have Zero Depreciation cover in your Previous policy addonZeroDepCover-->
		<div class="custom-control custom-checkbox plan_check">
		  	<input type="checkbox" data-name="zero-dep" class="custom-control-input addonZeroDepCover moter-OD" id="isPartDepProCover" value="1" name="isPartDepProCover" data-filter-by="9">
		  	<label class="custom-control-label" for="isPartDepProCover">Zero Dep</label>
		  	<div id="zero-dep-elem" style="display:none;">
		  	    <select class="" id="zero-dep-value" style="height: 25px;margin-left: 15px;border-radius: 0px;font-size: 12px;width: 60%;">
			  	    <option value="0">Cover only 1 claims per year</option>
			  	    <option value="1">Cover only 2 claims per year</option>
			  	    <option value="2">Cover Unlimited Claims</option>
			  	</select>
			  	
		  	    <button class="btn btn-small" id="btn-zero-dep-claim">UPDATE</button>
		  	</div> 
		</div>
		
		<div class="custom-control custom-checkbox plan_check">
		  	<input type="checkbox" class="custom-control-input addonCover moter-OD" id="isConsumableCover" value="1" name="isConsumableCover" data-filter-by="9">
		  	<label class="custom-control-label" for="isConsumableCover">Consumable cover</label>
		</div>
		
		<div class="custom-control custom-checkbox plan_check">
		  	<input type="checkbox" class="custom-control-input addonCover moter-OD" id="isEng_GearBoxProCover" value="1" name="isEng_GearBoxProCover" data-filter-by="9">
		  	<label class="custom-control-label" for="isEng_GearBoxProCover">Engine and Gear Box Protect</label>
		</div>
		 @if($motor=='tw')
	    <div class="custom-control custom-checkbox plan_check">
		  	<input type="checkbox" class="custom-control-input addonCover moter-OD" id="isCashAllowCover" value="1" name="isCashAllowCover" data-filter-by="9">
		  	<label class="custom-control-label" for="isCashAllowCover">Cash Allowance Cover</label>
		</div>
		@endif
		 @if($motor=='car')
		  <div class="custom-control custom-checkbox plan_check">
		  	<input type="checkbox" class="custom-control-input addonCover moter-OD" id="isTyreProCover" value="1" name="isTyreProCover" data-filter-by="9">
		  	<label class="custom-control-label" for="isTyreProCover">Tyre Protect</label>
		 </div>
		 	<div class="custom-control custom-checkbox plan_check return-to-invoice-elem" style="">
    		  	<input type="checkbox" class="custom-control-input addonCover moter-OD" id="isRetInvCover" value="1" name="isRetInvCover" data-filter-by="9">
    		  	<label class="custom-control-label" for="isRetInvCover">Return to Invoice</label>
		   </div>
		<!--<div class="custom-control custom-checkbox plan_check">-->
		<!--  	<input type="checkbox" class="custom-control-input addonCover moter-OD" id="isRimProCover" value="1" name="isRimProCover" data-filter-by="9">-->
		<!--  	<label class="custom-control-label" for="isRimProCover">Rim Protect Cover</label>-->
		<!--</div>-->
		@endif
		<hr/>
		@if($motor=='car')
		<h4 style="font-weight: 600;font-size: 14px;"><u>Accessories covers</u></h4>
		<div class="custom-control custom-checkbox plan_check">
		  	<input type="checkbox" class="custom-control-input addonAssCover access-cover"  id="isCngKitCover" value="1" name="isCngKitCover" >
		  	<label class="custom-control-label" for="isCngKitCover">CNG Kit Cover <span id="isCngKitCover-txt-val" style="display:none;color:#d40100;font-weight: 600;"><span class="inline-loader"><span class="inline-loader-box"></span><span class="inline-loader-box"></span><span class="inline-loader-box"></span></span></span></label>
		</div>
		<div id="isCngKitCover-elem" style="margin:10px;display:none;">
           <div id="slider-range-cng"></div>
        </div>
       
        <div class="custom-control custom-checkbox plan_check" style="margin-top: 30px;">
		  	<input type="checkbox" class="custom-control-input addonAssCover access-cover"  id="isElecAccCover" value="1" name="isElecAccCover" >
		  	<label class="custom-control-label" for="isElecAccCover">Electrical Accessories <span id="isElecAccCover-txt-val" style="display:none;color:#d40100;font-weight: 600;"><span class="inline-loader"><span class="inline-loader-box"></span><span class="inline-loader-box"></span><span class="inline-loader-box"></span></span></span></label>
		</div>
		<div id="isElecAccCover-elem" style="margin:10px;display:none;">
           <div id="slider-range-electric"></div>
        </div>
        
         
        <div class="custom-control custom-checkbox plan_check" style="margin-top: 30px;">
		  	<input type="checkbox" class="custom-control-input addonAssCover access-cover"  id="isNonElecAccCover" value="1" name="isNonElecAccCover" >
		  	<label class="custom-control-label" for="isNonElecAccCover">Non Electrical Accessories <span id="isNonElecAccCover-txt-val" style="display:none;color:#d40100;font-weight: 600;"><span class="inline-loader"><span class="inline-loader-box"></span><span class="inline-loader-box"></span><span class="inline-loader-box"></span></span></span></label>
		</div>
		<div id="isNonElecAccCover-elem" style="margin:10px;display:none;">
           <div id="slider-range-nonelectric"></div>
        </div>
        <hr/>
       @endif
		<!--<div class="assCovervalueRange isCngKitCover-elem" style="display:none;">-->
		    <!--<p style="font-size: 12px;border-bottom: 1px solid #ccc; color: #000;margin-top: 0px; margin-bottom: 15px !important;">Cover your car's extra fitted electrical accessories like stereo, fog lamps, buzzers etc</p>-->
		<!--     <table class="table table-assCovervalueRange">-->
<!--                                    <tbody>-->
<!--                                        <tr>-->
<!--                                            <th style="width:20%">Min<br/><span class="min-assval">10000</span></th>-->
<!--                                            <th style="width:60%">-->
                                <!--<input type="range" min="175" max="3500" value="175" class="slider-color" >-->
<!--                                                <input type="text" id="cng_ass_Range"  data-extra-classes="irs-outline irs-danger"> -->
<!--                                            </th>-->
<!--                                            <th style="width:20%"> Max<br/><span class="max-assval">80000</span></th>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <th colspan="3" style="text-align:right"><button id="cng_ass_val" class="btn btn-update-assVal"> UPDATE <span>₹10000</span></button></th>-->
<!--                                        </tr>-->
<!--                                    </tbody>-->
<!--                            </table>-->
            
		<!--</div>-->
		
		
		<!--<div class="custom-control custom-checkbox plan_check">-->
		<!--  	<input type="checkbox" class="custom-control-input addonAssCover access-cover" id="isElecAccCover" value="1" name="isElecAccCover" data-filter-by="9">-->
		<!--  	<label class="custom-control-label" for="isElecAccCover">Electrical Accessories Cover</label>-->
		<!--</div>-->
		<!--<div class="assCovervalueRange isElecAccCover-elem" style="display:none;">-->
		<!--    <p style="font-size: 12px;border-bottom: 1px solid #ccc; color: #000;margin-top: 0px; margin-bottom: 15px !important;">Cover your car's extra fitted electrical accessories like stereo, fog lamps, buzzers etc</p>-->
		<!--     <table class="table table-assCovervalueRange">-->
<!--                                    <tbody>-->
<!--                                        <tr>-->
<!--                                            <th style="width:20%">Min<br/><span class="min-assval">175</span></th>-->
<!--                                            <th style="width:60%">-->
                                <!--<input type="range" min="175" max="3500" value="175" class="slider-color" >-->
<!--                                                <input type="text" id="electrical_ass_Range"  data-extra-classes="irs-outline irs-danger"> -->
<!--                                            </th>-->
<!--                                            <th style="width:20%"> Max<br/><span class="max-assval">3500</span></th>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <th colspan="3" style="text-align:right"><button id="electrical_ass_val" class="btn btn-update-assVal"> UPDATE <span>₹175</span></button></th>-->
<!--                                        </tr>-->
<!--                                    </tbody>-->
<!--                            </table>-->
            
		<!--</div>-->
		
  <!--      <div class="custom-control custom-checkbox plan_check">-->
		<!--  	<input type="checkbox" class="custom-control-input addonAssCover" id="isNonElecAccCover" value="1" name="isNonElecAccCover" data-filter-by="9">-->
		<!--  	<label class="custom-control-label" for="isNonElecAccCover">Non Electrical Accessories Cover</label>-->
		<!--</div>-->
		<!--<div class="assCovervalueRange isNonElecAccCover-elem" style="display:none;">-->
		<!--     <p style="font-size: 12px;border-bottom: 1px solid #ccc; color: #000;margin-top: 0px; margin-bottom: 15px !important;">Cover your car's extra fitted non-electrical accessories like roof rack, wheel cover, etc</p>-->
		<!--     <table class="table table-assCovervalueRange">-->
<!--                                    <tbody>-->
<!--                                        <tr>-->
<!--                                            <th style="width:20%">Min<br/><span class="min-assval">175</span></th>-->
<!--                                            <th style="width:60%">-->
                            <!--<input type="range" min="175" max="3500" value="175" class="slider-color" id="non_electrical_ass_Range">-->
<!--                                            <input type="text" id="non_electrical_ass_Range"  data-extra-classes="irs-outline irs-danger">-->
<!--                                            </th>-->
<!--                                            <th style="width:20%"> Max<br/><span class="max-assval">3500</span></th>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <th colspan="3" style="text-align:right"><button  id="nonelectrical_ass_val" class="btn btn-update-assVal">UPDATE <span>₹175</span></button></th>-->
<!--                                        </tr>-->
<!--                                    </tbody>-->
<!--                            </table>-->
<!--                         </div>-->
		
	</div> 
</div>