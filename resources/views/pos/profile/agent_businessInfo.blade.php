 <form class="form-group" style="top: 10px;margin: 10px;" enctype="multipart/form-data"  id="businessinfo" method="post">
     <input name="_token" type="hidden" value="{{ csrf_token() }}" />
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="inputEmail4" class="h4">Primary source of income</label>
         </div>
         <div class="form-group col-md-6">
            <select type="text" class="form-control single-select2 profile-input" data-refClass="business-section" id="income" name="income">
            <option value="">Please Select</option>
            <option value="Insurance agent / advisor" <?php if($agent_bussness_info->income=="Insurance agent / advisor"){ echo 'selected';}?>>Insurance agent / advisor</option>
          <option value="Financial advisor / consultant"  <?php if($agent_bussness_info->income=="Financial advisor / consultant"){ echo 'selected';}?>>Financial advisor / consultant</option>
          <option value="Direct Selling Associate"  <?php if($agent_bussness_info->income=="Direct Selling Associate"){ echo 'selected';}?>>Direct Selling Associate</option>
          <option value="Car Dealer"  <?php if($agent_bussness_info->income=="Car Dealer"){ echo 'selected';}?>>Car Dealer</option>
          <option value="Two Wheeler Dealer"  <?php if($agent_bussness_info->income=="Two Wheeler Dealer"){ echo 'selected';}?>>Two Wheeler Dealer</option>
          <option value="RTO agent"  <?php if($agent_bussness_info->income=="RTO agent"){ echo 'selected';}?>>RTO Agent</option>
          <option value="Entrepreneur/ Business/ Self-employed"  <?php if($agent_bussness_info->income=="Entrepreneur/ Business/ Self-employed"){ echo 'selected';}?>>Entrepreneur/ Business/ Self-employed</option>
          <option value="Salaried professional"  <?php if($agent_bussness_info->income=="Salaried professional"){ echo 'selected';}?>>Salaried professional</option>
          <option value="Real Estate Agent"  <?php if($agent_bussness_info->income=="Real Estate Agent"){ echo 'selected';}?>>Real Estate Agent</option>
          <option value="Accounting/ Admin/ IT services"  <?php if($agent_bussness_info->income=="Accounting/ Admin/ IT services"){ echo 'selected';}?>>Accounting/ Admin/ IT services</option>
          <option value="Tax consultant/ Lawyer"  <?php if($agent_bussness_info->income=="Tax consultant/ Lawyer"){ echo 'selected';}?>>Tax consultant/ Lawyer</option>
          <option value="Homemaker"  <?php if($agent_bussness_info->income=="Homemaker"){ echo 'selected';}?>>Homemaker</option>
          <option value="Retired"  <?php if($agent_bussness_info->income=="Retired"){ echo 'selected';}?>>Retired</option>
          <option value="Unemployed"  <?php if($agent_bussness_info->income=="Unemployed"){ echo 'selected';}?>>Unemployed</option>
          <option value="Other"  <?php if($agent_bussness_info->income=="Other"){ echo 'selected';}?>>Other</option>
          </select>
          </div>
          <div class="form-group col-md-4">
            <label for="inputEmail4" class="h4">Years of experience in Insurance</label>
         </div>
            <div class="form-group col-md-6">
             <select type="text" class="form-control single-select2 profile-input" data-refClass="business-section" id="experience" name="experience">
                  <option value="">Please Select</option>
                  <option value="0" <?php if($agent_bussness_info->exp=="0"){ echo 'selected';}?>>Fresher</option>
                  <option value="1" <?php if($agent_bussness_info->exp=="1"){ echo 'selected';}?>>1 year</option>
                  <option value="2" <?php if($agent_bussness_info->exp=="2"){ echo 'selected';}?>>2 years</option>
                  <option value="3" <?php if($agent_bussness_info->exp=="3"){ echo 'selected';}?>>3 years</option>
                  <option value="4" <?php if($agent_bussness_info->exp=="4"){ echo 'selected';}?>>4 years</option>
                  <option value="5" <?php if($agent_bussness_info->exp=="5"){ echo 'selected';}?>>5 years</option>
                  <option value="6" <?php if($agent_bussness_info->exp=="6"){ echo 'selected';}?>>6 years</option>
                  <option value="7" <?php if($agent_bussness_info->exp=="7"){ echo 'selected';}?>>7 years</option>
                  <option value="8" <?php if($agent_bussness_info->exp=="8"){ echo 'selected';}?>>8 years</option>
                  <option value="9" <?php if($agent_bussness_info->exp=="9"){ echo 'selected';}?>>9 years</option>
                  <option value="10" <?php if($agent_bussness_info->exp=="10"){ echo 'selected';}?>>10 years</option>
                  <option value="11" <?php if($agent_bussness_info->exp=="11"){ echo 'selected';}?>>11 years</option>
                  <option value="12" <?php if($agent_bussness_info->exp=="12"){ echo 'selected';}?>>12 years</option>
                  <option value="13" <?php if($agent_bussness_info->exp=="13"){ echo 'selected';}?>>13 years</option>
                  <option value="14" <?php if($agent_bussness_info->exp=="14"){ echo 'selected';}?>>14 years</option>
                  <option value="15" <?php if($agent_bussness_info->exp=="15"){ echo 'selected';}?>>15 years</option>
                  <option value="16" <?php if($agent_bussness_info->exp=="16"){ echo 'selected';}?>>More than 15 years</option>
                  </select>
          </div>
         
          <div class="form-group col-md-4">
          <label for="inputAddress" class="h4">Do you have a dedicated office space for handling insurance business?</label>
       </div>
        <div class="form-group col-md-6">
          <div class="custom-control custom-radio">
              <input type="radio" class="custom-control-input profile-input" data-refClass="business-section" id="defaultUnchecked1" name="is_ins_bus" value="0" <?php if($agent_bussness_info->is_ins_bus==0){ echo 'checked';}?>>
              <label class="custom-control-label h4" for="defaultUnchecked1">No</label>
            </div>
    
            <!-- Default checked -->
            <div class="custom-control custom-radio">
              <input type="radio" class="custom-control-input profile-input" data-refClass="business-section" id="defaultChecked2" name="is_ins_bus" <?php if($agent_bussness_info->is_ins_bus==1){ echo 'checked';}?> value="1">
              <label class="custom-control-label h4" for="defaultChecked2">Yes</label>
            </div>
        </div>
         <div class="form-group col-md-12">
            <label for="inputEmail4" class="h4">Monthly Average Business</label>
           
          </div>
          <div class="form-group col-md-4">
            <label for="inputEmail4" class="h4">Motor premium?</label>
         </div>
            <div class="form-group col-md-6">
             
            <select  class="form-control single-select2 profile-input" data-refClass="business-section" id="motor_premium" name="motor_premium">
               <option value="">Please Select</option>
               <option value="0" <?php if($agent_bussness_info->motor_premium==0){ echo 'selected';}?>>Nil</option>
               <option value="0.125" <?php if($agent_bussness_info->motor_premium==0.125){ echo 'selected';}?>>Less than 25k</option>
               <option value="0.25" <?php if($agent_bussness_info->motor_premium==0.25){ echo 'selected';}?>>25k</option>
               <option value="0.5" <?php if($agent_bussness_info->motor_premium==0.5){ echo 'selected';}?>>50k</option>
               <option value="0.75" <?php if($agent_bussness_info->motor_premium==0.75){ echo 'selected';}?>>75k</option>
               <option value="1" <?php if($agent_bussness_info->motor_premium==1){ echo 'selected';}?>>1 lakh</option>
               <option value="2" <?php if($agent_bussness_info->motor_premium==2){ echo 'selected';}?>>2 lakh</option>
               <option value="3" <?php if($agent_bussness_info->motor_premium==3){ echo 'selected';}?>>3 lakh</option>
               <option value="4" <?php if($agent_bussness_info->motor_premium==4){ echo 'selected';}?>>4 lakh</option>
               <option value="5" <?php if($agent_bussness_info->motor_premium==5){ echo 'selected';}?>>5 lakh</option>
               <option value="6" <?php if($agent_bussness_info->motor_premium==6){ echo 'selected';}?>>6 lakh</option>
               <option value="7" <?php if($agent_bussness_info->motor_premium==7){ echo 'selected';}?>>7 lakh</option>
               <option value="8" <?php if($agent_bussness_info->motor_premium==8){ echo 'selected';}?>>8 lakh</option>
               <option value="9" <?php if($agent_bussness_info->motor_premium==9){ echo 'selected';}?>>9 lakh</option>
               <option value="10" <?php if($agent_bussness_info->motor_premium==10){ echo 'selected';}?>>10 lakh</option>
               <option value="11" <?php if($agent_bussness_info->motor_premium==11){ echo 'selected';}?>>11 lakh</option>
               <option value="12" <?php if($agent_bussness_info->motor_premium==12){ echo 'selected';}?>>12 lakh</option>
               <option value="13" <?php if($agent_bussness_info->motor_premium==13){ echo 'selected';}?>>13 lakh</option>
               <option value="14" <?php if($agent_bussness_info->motor_premium==14){ echo 'selected';}?>>14 lakh</option>
               <option value="15" <?php if($agent_bussness_info->motor_premium==15){ echo 'selected';}?>>15 lakh</option>
               <option value="16" <?php if($agent_bussness_info->motor_premium==16){ echo 'selected';}?>>More than 15 lakh</option>
            </select>
          </div>
          <div class="form-group col-md-4">
            <label for="inputEmail4" class="h4">Health premium?</label>
         </div>
            <div class="form-group col-md-6">
            
           <select class="form-control single-select2 profile-input" data-refClass="business-section" id="health_premium" name="health_premium">
               <option value="">Please Select</option>
              <option value="0" <?php if($agent_bussness_info->health_premium==0){ echo 'selected';}?>>Nil</option>
               <option value="0.125" <?php if($agent_bussness_info->health_premium==0.125){ echo 'selected';}?>>Less than 25k</option>
               <option value="0.25" <?php if($agent_bussness_info->health_premium==0.25){ echo 'selected';}?>>25k</option>
               <option value="0.5" <?php if($agent_bussness_info->health_premium==0.5){ echo 'selected';}?>>50k</option>
               <option value="0.75" <?php if($agent_bussness_info->health_premium==0.75){ echo 'selected';}?>>75k</option>
               <option value="1" <?php if($agent_bussness_info->health_premium==1){ echo 'selected';}?>>1 lakh</option>
               <option value="2" <?php if($agent_bussness_info->health_premium==2){ echo 'selected';}?>>2 lakh</option>
               <option value="3" <?php if($agent_bussness_info->health_premium==3){ echo 'selected';}?>>3 lakh</option>
               <option value="4" <?php if($agent_bussness_info->health_premium==4){ echo 'selected';}?>>4 lakh</option>
               <option value="5" <?php if($agent_bussness_info->health_premium==5){ echo 'selected';}?>>5 lakh</option>
               <option value="6" <?php if($agent_bussness_info->health_premium==6){ echo 'selected';}?>>6 lakh</option>
               <option value="7" <?php if($agent_bussness_info->health_premium==7){ echo 'selected';}?>>7 lakh</option>
               <option value="8" <?php if($agent_bussness_info->health_premium==8){ echo 'selected';}?>>8 lakh</option>
               <option value="9" <?php if($agent_bussness_info->health_premium==9){ echo 'selected';}?>>9 lakh</option>
               <option value="10" <?php if($agent_bussness_info->health_premium==10){ echo 'selected';}?>>10 lakh</option>
               <option value="11" <?php if($agent_bussness_info->health_premium==11){ echo 'selected';}?>>11 lakh</option>
               <option value="12" <?php if($agent_bussness_info->health_premium==12){ echo 'selected';}?>>12 lakh</option>
               <option value="13" <?php if($agent_bussness_info->health_premium==13){ echo 'selected';}?>>13 lakh</option>
               <option value="14" <?php if($agent_bussness_info->health_premium==14){ echo 'selected';}?>>14 lakh</option>
               <option value="15" <?php if($agent_bussness_info->health_premium==15){ echo 'selected';}?>>15 lakh</option>
               <option value="16" <?php if($agent_bussness_info->health_premium==16){ echo 'selected';}?>>More than 15 lakh</option>
             </select>
          </div>
       
        <div class="form-group col-md-4">
          <label for="inputAddress" class="h4">Life premium?</label>
       </div>
       <div class="form-group col-md-6">
         
           <select  class="form-control single-select2 profile-input" data-refClass="business-section" id="life_premium" name="life_premium">
               <option value="">Please Select</option>
               <option value="0" <?php if($agent_bussness_info->life_premium==0){ echo 'selected';}?>>Nil</option>
               <option value="0.125" <?php if($agent_bussness_info->life_premium==0.125){ echo 'selected';}?>>Less than 25k</option>
               <option value="0.25" <?php if($agent_bussness_info->life_premium==0.25){ echo 'selected';}?>>25k</option>
               <option value="0.5" <?php if($agent_bussness_info->life_premium==0.5){ echo 'selected';}?>>50k</option>
               <option value="0.75" <?php if($agent_bussness_info->life_premium==0.75){ echo 'selected';}?>>75k</option>
               <option value="1" <?php if($agent_bussness_info->life_premium==1){ echo 'selected';}?>>1 lakh</option>
               <option value="2" <?php if($agent_bussness_info->life_premium==2){ echo 'selected';}?>>2 lakh</option>
               <option value="3" <?php if($agent_bussness_info->life_premium==3){ echo 'selected';}?>>3 lakh</option>
               <option value="4" <?php if($agent_bussness_info->life_premium==4){ echo 'selected';}?>>4 lakh</option>
               <option value="5" <?php if($agent_bussness_info->life_premium==5){ echo 'selected';}?>>5 lakh</option>
               <option value="6" <?php if($agent_bussness_info->life_premium==6){ echo 'selected';}?>>6 lakh</option>
               <option value="7" <?php if($agent_bussness_info->life_premium==7){ echo 'selected';}?>>7 lakh</option>
               <option value="8" <?php if($agent_bussness_info->life_premium==8){ echo 'selected';}?>>8 lakh</option>
               <option value="9" <?php if($agent_bussness_info->life_premium==9){ echo 'selected';}?>>9 lakh</option>
               <option value="10" <?php if($agent_bussness_info->life_premium==10){ echo 'selected';}?>>10 lakh</option>
               <option value="11" <?php if($agent_bussness_info->life_premium==11){ echo 'selected';}?>>11 lakh</option>
               <option value="12" <?php if($agent_bussness_info->life_premium==12){ echo 'selected';}?>>12 lakh</option>
               <option value="13" <?php if($agent_bussness_info->life_premium==13){ echo 'selected';}?>>13 lakh</option>
               <option value="14" <?php if($agent_bussness_info->life_premium==14){ echo 'selected';}?>>14 lakh</option>
               <option value="15" <?php if($agent_bussness_info->life_premium==15){ echo 'selected';}?>>15 lakh</option>
               <option value="16" <?php if($agent_bussness_info->life_premium==16){ echo 'selected';}?>>More than 15 lakh</option>
            </select>
        </div>
        <div class="form-group col-md-12">
            <label for="inputEmail4" class="h4"> Which of the following licenses do you currently hold?</label>
           
          </div>
       
      
      <div class="col-md-12 col-sm-12 mt-5" id="main">
        <div class="checkbox abc row">
    
          <label class="col-md-4"><input type="checkbox" name="is_agency_health" id="is_agency_health" value="1" <?php if($agent_bussness_info->is_agency_health==1){ echo 'checked';}?>><i class="fontello-check" ></i><span class="h4" style=" padding-left: 10px;    margin-top: 0px; ">Agency Health</span></label>
          <div class="ch_for col-md-6" style="<?php if($agent_bussness_info->is_agency_health==1){ echo 'display: block';}else{ echo 'display: none'; }?>" id="agency_health_div"> 
            <span class="h4">Agency Health Insurance with whom?</span>
          <select name="agency_health" id="agency_health" class="form-control single-select2">
              <option value="">Please Select </option>
              <option value="Agriculture Insurance Company of India" <?php if($agent_bussness_info->agency_health=='Agriculture Insurance Company of India'){ echo 'selected';}?>>Agriculture Insurance Company of India</option>
              <option value="Apollo Munich Health Insurance" <?php if($agent_bussness_info->agency_health=='Apollo Munich Health Insurance'){ echo 'selected';}?>>Apollo Munich Health Insurance</option>
              <option value="Cholamandalam MS General Insurance" <?php if($agent_bussness_info->agency_health=='Cholamandalam MS General Insurance'){ echo 'selected';}?>>Cholamandalam MS General Insurance</option>
              <option value="Bajaj Allianz General Insurance" <?php if($agent_bussness_info->agency_health=='Bajaj Allianz General Insurance'){ echo 'selected';}?>>Bajaj Allianz General Insurance</option>
              <option value="Bharti AXA General Insurance" <?php if($agent_bussness_info->agency_health=='Bharti AXA General Insurance'){ echo 'selected';}?>>Bharti AXA General Insurance</option>
              <option value="Cigna TTK" <?php if($agent_bussness_info->agency_health=='Cigna TTK'){ echo 'selected';}?>>Cigna TTK</option>
              <option value="Export Credit Guarantee Corporation of India" <?php if($agent_bussness_info->agency_health=='Export Credit Guarantee Corporation of India'){ echo 'selected';}?>>Export Credit Guarantee Corporation of India</option>
              <option value="GIC Re" <?php if($agent_bussness_info->agency_health=='GIC Re'){ echo 'selected';}?>>GIC Re</option>
              <option value="HDFC ERGO General Insurance Company" <?php if($agent_bussness_info->agency_health=='HDFC ERGO General Insurance Company'){ echo 'selected';}?>>HDFC ERGO General Insurance Company</option>
              <option value="ICICI Lombard" <?php if($agent_bussness_info->agency_health=='ICICI Lombard'){ echo 'selected';}?>>ICICI Lombard</option>
              <option value="IFFCO Tokio" <?php if($agent_bussness_info->agency_health=='IFFCO Tokio'){ echo 'selected';}?>>IFFCO Tokio</option>
              <option value="L&amp;T General Insurance" <?php if($agent_bussness_info->agency_health=='L&amp;T General Insurance'){ echo 'selected';}?>>L&amp;T General Insurance</option>
              <option value="Liberty Videocon General Insurance" <?php if($agent_bussness_info->agency_health=='Liberty Videocon General Insurance'){ echo 'selected';}?>>Liberty Videocon General Insurance</option>
              <option value="National Insurance Company" <?php if($agent_bussness_info->agency_health=='National Insurance Company'){ echo 'selected';}?>>National Insurance Company</option>
              <option value="New India Assurance" <?php if($agent_bussness_info->agency_health=='New India Assurance'){ echo 'selected';}?>>New India Assurance</option>
              <option value="The Oriental Insurance Company" <?php if($agent_bussness_info->agency_health=='The Oriental Insurance Company'){ echo 'selected';}?>>The Oriental Insurance Company</option>
              <option value="Reliance General Insurance" <?php if($agent_bussness_info->agency_health=='Reliance General Insurance'){ echo 'selected';}?>>Reliance General Insurance</option>
              <option value="Religare" <?php if($agent_bussness_info->agency_health=='Religare'){ echo 'selected';}?>>Religare</option>
              <option value="Royal Sundaram General Insurance" <?php if($agent_bussness_info->agency_health=='Royal Sundaram General Insurance'){ echo 'selected';}?>>Royal Sundaram General Insurance</option>
              <option value="Star Health and Allied Insurance" <?php if($agent_bussness_info->agency_health=='Star Health and Allied Insurance'){ echo 'selected';}?>>Star Health and Allied Insurance</option>
              <option value="Tata AIG General" <?php if($agent_bussness_info->agency_health=='Tata AIG General'){ echo 'selected';}?>>Tata AIG General</option>
              <option value="United India Insurance Company" <?php if($agent_bussness_info->agency_health=='United India Insurance Company'){ echo 'selected';}?>>United India Insurance Company</option>
              <option value="Universal Sompo General Insurance Company" <?php if($agent_bussness_info->agency_health=='Universal Sompo General Insurance Company'){ echo 'selected';}?>>Universal Sompo General Insurance Company</option>
          </select>
          </div>
    
        </div>
        <div class="checkbox abc row">
    
          <label class="col-md-4"><input type="checkbox" name="is_agency_life" id="is_agency_life" value="1" <?php if($agent_bussness_info->is_agency_life==1){ echo 'checked';}?>><i class="fontello-check" > </i><span class="h4" style=" padding-left: 10px;    margin-top: 0px; ">Agency Life</span></label>
          <div class="ch_for col-md-6" style="<?php if($agent_bussness_info->is_agency_life==1){ echo 'display: block';}else{ echo 'display: none'; }?>" id="agency_life_div">
             <span class="h4">Agency Life Insurance with whom?</span>
         <select name="agency_life" id="agency_life" class="form-control single-select2">
          <option value=""> Please Select</option>
          <option value="Aviva India" <?php if($agent_bussness_info->agency_life=='Aviva India'){ echo 'selected';}?>>Aviva India</option>
          <option value="Bajaj Allianz Life Insurance" <?php if($agent_bussness_info->agency_life=='Bajaj Allianz Life Insurance'){ echo 'selected';}?>>Bajaj Allianz Life Insurance</option>
          <option value="Birla Sun Life Insurance Company Limited" <?php if($agent_bussness_info->agency_life=='Birla Sun Life Insurance Company Limited'){ echo 'selected';}?>>Birla Sun Life Insurance Company Limited</option>
          <option value="Exide Life Insurance" <?php if($agent_bussness_info->agency_life=='Exide Life Insurance'){ echo 'selected';}?>>Exide Life Insurance</option>
          <option value="HDFC Standard Life Insurance" <?php if($agent_bussness_info->agency_life=='HDFC Standard Life Insurance'){ echo 'selected';}?>>HDFC Standard Life Insurance</option>
          <option value="ICICI Prudential Life Insurance" <?php if($agent_bussness_info->agency_life=='ICICI Prudential Life Insurance'){ echo 'selected';}?>>ICICI Prudential Life Insurance</option>
          <option value="IDBI Federal Life Insurance" <?php if($agent_bussness_info->agency_life=='IDBI Federal Life Insurance'){ echo 'selected';}?>>IDBI Federal Life Insurance</option>
          <option value="IndiaFirst Life Insurance Company" <?php if($agent_bussness_info->agency_life=='IndiaFirst Life Insurance Company'){ echo 'selected';}?>>IndiaFirst Life Insurance Company</option>
          <option value="Life Insurance Corporation of India" <?php if($agent_bussness_info->agency_life=='Life Insurance Corporation of India'){ echo 'selected';}?>>Life Insurance Corporation of India</option>
          <option value="Max Life Insurance" <?php if($agent_bussness_info->agency_life=='Max Life Insurance'){ echo 'selected';}?>>Max Life Insurance</option>
          <option value="Peerless Group" <?php if($agent_bussness_info->agency_life=='Peerless Group'){ echo 'selected';}?>>Peerless Group</option>
          <option value="PNB MetLife India Insurance Company" <?php if($agent_bussness_info->agency_life=='PNB MetLife India Insurance Company'){ echo 'selected';}?>>PNB MetLife India Insurance Company</option>
          <option value="SBI Life Insurance Company" <?php if($agent_bussness_info->agency_life=='SBI Life Insurance Company'){ echo 'selected';}?>>SBI Life Insurance Company</option>
          <option value="Edelweiss Tokio Life Insurance" <?php if($agent_bussness_info->agency_life=='Edelweiss Tokio Life Insurance'){ echo 'selected';}?>>Edelweiss Tokio Life Insurance</option>
      </select>
          </div>
          
        </div>
        <div class="checkbox abc row">
    
          <label class="col-md-4"><input type="checkbox" name="is_agency_gerenal" id="is_agency_gerenal" class="absd" value="1" <?php if($agent_bussness_info->is_agency_general==1){ echo 'checked';}?>><i class="fontello-check" ></i><span class="h4" style=" padding-left: 10px;    margin-top: 0px; ">Agency General</span></label>
          <div class="ch_for col-md-6" style="<?php if($agent_bussness_info->is_agency_general==1){ echo 'display: block';}else{ echo 'display: none'; }?>" id="agency_gerenal_div">
            <span class="h4">Agency General Insurance with whom?</span>
         <select name="agency_gerenal" id="agency_gerenal" class="form-control single-select2">
            <option value="">Please Select</option>
              <option value="Agriculture Insurance Company of India" <?php if($agent_bussness_info->agency_general=='Agriculture Insurance Company of India'){ echo 'selected';}?>>Agriculture Insurance Company of India</option>
              <option value="Apollo Munich Health Insurance" <?php if($agent_bussness_info->agency_general=='Apollo Munich Health Insurance'){ echo 'selected';}?>>Apollo Munich Health Insurance</option>
              <option value="Cholamandalam MS General Insurance" <?php if($agent_bussness_info->agency_general=='Cholamandalam MS General Insurance'){ echo 'selected';}?>>Cholamandalam MS General Insurance</option>
              <option value="Bajaj Allianz General Insurance" <?php if($agent_bussness_info->agency_general=='Bajaj Allianz General Insurance'){ echo 'selected';}?>>Bajaj Allianz General Insurance</option>
              <option value="Bharti AXA General Insurance" <?php if($agent_bussness_info->agency_general=='Bharti AXA General Insurance'){ echo 'selected';}?>>Bharti AXA General Insurance</option>
              <option value="Cigna TTK" <?php if($agent_bussness_info->agency_general=='Cigna TTK'){ echo 'selected';}?>>Cigna TTK</option>
              <option value="Export Credit Guarantee Corporation of India" <?php if($agent_bussness_info->agency_general=='Export Credit Guarantee Corporation of India'){ echo 'selected';}?>>Export Credit Guarantee Corporation of India</option>
              <option value="GIC Re" <?php if($agent_bussness_info->agency_general=='GIC Re'){ echo 'selected';}?>>GIC Re</option>
              <option value="HDFC ERGO General Insurance Company" <?php if($agent_bussness_info->agency_general=='HDFC ERGO General Insurance Company'){ echo 'selected';}?>>HDFC ERGO General Insurance Company</option>
              <option value="ICICI Lombard" <?php if($agent_bussness_info->agency_general=='ICICI Lombard'){ echo 'selected';}?>>ICICI Lombard</option>
              <option value="IFFCO Tokio" <?php if($agent_bussness_info->agency_general=='IFFCO Tokio'){ echo 'selected';}?>>IFFCO Tokio</option>
              <option value="L&amp;T General Insurance" <?php if($agent_bussness_info->agency_general=='L&amp;T General Insurance'){ echo 'selected';}?>>L&amp;T General Insurance</option>
              <option value="Liberty Videocon General Insurance" <?php if($agent_bussness_info->agency_general=='Liberty Videocon General Insurance'){ echo 'selected';}?>>Liberty Videocon General Insurance</option>
              <option value="National Insurance Company" <?php if($agent_bussness_info->agency_general=='National Insurance Company'){ echo 'selected';}?>>National Insurance Company</option>
              <option value="New India Assurance" <?php if($agent_bussness_info->agency_general=='New India Assurance'){ echo 'selected';}?>>New India Assurance</option>
              <option value="The Oriental Insurance Company" <?php if($agent_bussness_info->agency_general=='The Oriental Insurance Company'){ echo 'selected';}?>>The Oriental Insurance Company</option>
              <option value="Reliance General Insurance" <?php if($agent_bussness_info->agency_general=='Reliance General Insurance'){ echo 'selected';}?>>Reliance General Insurance</option>
              <option value="Religare" <?php if($agent_bussness_info->agency_general=='Religare'){ echo 'selected';}?>>Religare</option>
              <option value="Royal Sundaram General Insurance" <?php if($agent_bussness_info->agency_general=='Royal Sundaram General Insurance'){ echo 'selected';}?>>Royal Sundaram General Insurance</option>
              <option value="Star Health and Allied Insurance" <?php if($agent_bussness_info->agency_general=='Star Health and Allied Insurance'){ echo 'selected';}?>>Star Health and Allied Insurance</option>
              <option value="Tata AIG General" <?php if($agent_bussness_info->agency_general=='Tata AIG General'){ echo 'selected';}?>>Tata AIG General</option>
              <option value="United India Insurance Company" <?php if($agent_bussness_info->agency_general=='United India Insurance Company'){ echo 'selected';}?>>United India Insurance Company</option>
              <option value="Universal Sompo General Insurance Company" <?php if($agent_bussness_info->agency_general=='Universal Sompo General Insurance Company'){ echo 'selected';}?>>Universal Sompo General Insurance Company</option>
        </select>
          </div>
          
        </div>
        <div class="checkbox abc row">
    
          <label class="col-md-4"><input type="checkbox" name="is_pos_life" id="is_pos_life" value="1" <?php if($agent_bussness_info->is_pos_life==1){ echo 'checked';}?>><i class="fontello-check" ></i><span class="h4" style=" padding-left: 10px;     margin-top: 0px;">Pos Life</span></label>
          <div class="ch_for col-md-6" style="<?php if($agent_bussness_info->is_pos_life==1){ echo 'display: block';}else{ echo 'display: none'; }?>" id="pos_life_div">
            <span class="h4">Pos Life Insurance with whom ?</span>
          <input type="text" name="pos_life" id="pos_life" value="{{$agent_bussness_info->pos_life}}" placeholder="Channel details"  class="form-control  ">
          </div>
          
        </div>
        <div class="checkbox abc row">
    
          <label class="col-md-4"><input type="checkbox" name="is_pos_gerenal" id="is_pos_gerenal" value="1" <?php if($agent_bussness_info->is_pos_general==1){ echo 'checked';}?>><i class="fontello-check" ></i><span class="h4" style=" padding-left: 10px;  margin-top: 0px;">Pos General</span></label>
          <div class="ch_for col-md-6" style="<?php if($agent_bussness_info->is_pos_general==1){ echo 'display: block';}else{ echo 'display: none'; }?>" id="pos_gerenal_div">
            <span class="h4">Pos General Insurance with whom ?</span>
          <input type="text" name="pos_gerenal" id="pos_gerenal" value="{{$agent_bussness_info->pos_general}}" placeholder="Channel details"  class="form-control  ">
          </div>
          
        </div>
         <div class="checkbox abc row">
    
          <label class="col-md-4"><input type="checkbox" name="is_surveyor" id="is_surveyor" value="1" <?php if($agent_bussness_info->is_surveyor==1){ echo 'checked';}?>><i class="fontello-check" ></i><span class="h4" style=" padding-left: 10px;  margin-top: 0px;">Surveyor</span></label>
          <div class="ch_for col-md-6" style="<?php if($agent_bussness_info->is_surveyor==1){ echo 'display: block';}else{ echo 'display: none'; }?>" id="surveyor_div">
            <span class="h4">Surveyor Insurance with whom?</span>
          <select name="surveyor" id="surveyor" class="form-control single-select2">
              <option value="">Please Select </option>
               <option value="Agriculture Insurance Company of India" <?php if($agent_bussness_info->surveyor=='Agriculture Insurance Company of India'){ echo 'selected';}?>>Agriculture Insurance Company of India</option>
              <option value="Apollo Munich Health Insurance" <?php if($agent_bussness_info->surveyor=='Apollo Munich Health Insurance'){ echo 'selected';}?>>Apollo Munich Health Insurance</option>
              <option value="Cholamandalam MS General Insurance" <?php if($agent_bussness_info->surveyor=='Cholamandalam MS General Insurance'){ echo 'selected';}?>>Cholamandalam MS General Insurance</option>
              <option value="Bajaj Allianz General Insurance" <?php if($agent_bussness_info->surveyor=='Bajaj Allianz General Insurance'){ echo 'selected';}?>>Bajaj Allianz General Insurance</option>
              <option value="Bharti AXA General Insurance" <?php if($agent_bussness_info->surveyor=='Bharti AXA General Insurance'){ echo 'selected';}?>>Bharti AXA General Insurance</option>
              <option value="Cigna TTK" <?php if($agent_bussness_info->surveyor=='Cigna TTK'){ echo 'selected';}?>>Cigna TTK</option>
              <option value="Export Credit Guarantee Corporation of India" <?php if($agent_bussness_info->surveyor=='Export Credit Guarantee Corporation of India'){ echo 'selected';}?>>Export Credit Guarantee Corporation of India</option>
              <option value="GIC Re" <?php if($agent_bussness_info->surveyor=='GIC Re'){ echo 'selected';}?>>GIC Re</option>
              <option value="HDFC ERGO General Insurance Company" <?php if($agent_bussness_info->surveyor=='HDFC ERGO General Insurance Company'){ echo 'selected';}?>>HDFC ERGO General Insurance Company</option>
              <option value="ICICI Lombard" <?php if($agent_bussness_info->surveyor=='ICICI Lombard'){ echo 'selected';}?>>ICICI Lombard</option>
              <option value="IFFCO Tokio" <?php if($agent_bussness_info->surveyor=='IFFCO Tokio'){ echo 'selected';}?>>IFFCO Tokio</option>
              <option value="L&amp;T General Insurance" <?php if($agent_bussness_info->surveyor=='L&amp;T General Insurance'){ echo 'selected';}?>>L&amp;T General Insurance</option>
              <option value="Liberty Videocon General Insurance" <?php if($agent_bussness_info->surveyor=='Liberty Videocon General Insurance'){ echo 'selected';}?>>Liberty Videocon General Insurance</option>
              <option value="National Insurance Company" <?php if($agent_bussness_info->surveyor=='National Insurance Company'){ echo 'selected';}?>>National Insurance Company</option>
              <option value="New India Assurance" <?php if($agent_bussness_info->surveyor=='New India Assurance'){ echo 'selected';}?>>New India Assurance</option>
              <option value="The Oriental Insurance Company" <?php if($agent_bussness_info->surveyor=='The Oriental Insurance Company'){ echo 'selected';}?>>The Oriental Insurance Company</option>
              <option value="Reliance General Insurance" <?php if($agent_bussness_info->surveyor=='Reliance General Insurance'){ echo 'selected';}?>>Reliance General Insurance</option>
              <option value="Religare" <?php if($agent_bussness_info->surveyor=='Religare'){ echo 'selected';}?>>Religare</option>
              <option value="Royal Sundaram General Insurance" <?php if($agent_bussness_info->surveyor=='Royal Sundaram General Insurance'){ echo 'selected';}?>>Royal Sundaram General Insurance</option>
              <option value="Star Health and Allied Insurance" <?php if($agent_bussness_info->surveyor=='Star Health and Allied Insurance'){ echo 'selected';}?>>Star Health and Allied Insurance</option>
              <option value="Tata AIG General" <?php if($agent_bussness_info->surveyor=='Tata AIG General'){ echo 'selected';}?>>Tata AIG General</option>
              <option value="United India Insurance Company" <?php if($agent_bussness_info->surveyor=='United India Insurance Company'){ echo 'selected';}?>>United India Insurance Company</option>
              <option value="Universal Sompo General Insurance Company" <?php if($agent_bussness_info->surveyor=='Universal Sompo General Insurance Company'){ echo 'selected';}?>>Universal Sompo General Insurance Company</option>
          </select>
          </div>
          
        </div>
        <div class="checkbox  row" id="checkboxs">
        <label class="col-md-4"><input type="checkbox" name="noneCheck" id="noneCheck" value="1"><i class="fontello-check " ></i><span class="h4" style=" padding-left: 10px;  margin-top: 0px;">None</span></label>
                                                     
        </div>
      </div>
     
    
    
            </div>
          <div class="form-group col-md-12"style=" margin-bottom: 10%; top: 15px; bottom: 19px; ">
        <button type="submit" class="btn btn-primary">update</button>
     </div>
</form>