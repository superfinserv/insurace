<h4 style="color: #AC0F0B;font-weight: 600;">Address Information</h4>
<?php $address = $param->address;
      $document = isset($param->document)?$param->document:"";
      $month = array('01'=>'Jan', '02'=>'Feb','03'=>'Mar','04'=>'Apr','05'=>'May','06'=>'Jun','07'=>'Jul','08'=>'Aug','09'=>'Sep','10'=>'Oct','11'=>'Nov','12'=>'Dec');?>
<form method="POST" action="#" id="addressInfo-Form">
  <div class="row" style="margin-bottom: 10px;">
    <div class="col-md-6 col-sm-12 col-xs-12">
        <label style="color:#000">House no./Building</label>
        <div class="media-input-container">
             <ul class="mediainput input-single" style="">
              <li>
                <input type="text" name="house_no" id="house_no" class="form-control address-valid" placeholder="Enter House No./Building" value="<?=isset($address->house_no)?$address->house_no:'';?>">
               </li>
            </ul>
        </div>
    </div>
    <div class="col-md-6 col-sm-12 col-xs-12">
        <label style="color:#000">Area/Locallity</label>
        <div class="media-input-container">
             <ul class="mediainput input-single" style="">
              <li>
                <input type="text" name="street" id="street" class="form-control address-valid" placeholder="Enter Area/Locallity" value="<?=isset($address->street)?$address->street:'';?>">
              </li>
                
            </ul>
        </div>
    </div>
</div>
  <div class="row" style="margin-bottom: 10px;">
    <div class="col-md-4 col-sm-12 col-xs-12">
        <label style="color:#000">Pincode</label>
        <div class="media-input-container">
             <ul class="mediainput input-single" style="">
              <li>
                <input type="text" maxlength="6" name="pincode" id="pincode" class="form-control number-only" placeholder="Enter area pincode" value="<?=isset($address->pincode)?$address->pincode:'';?>">
               </li>
            </ul>
        </div>
    </div>
    <div class="col-md-4 col-sm-12 col-xs-12">
        <label style="color:#000">State</label>
        <div class="media-input-container">
             <ul class="mediainput input-single input-single-select" style="">
              <li>
                   <select id="state_id" name="state_id">
                        <option value="">select</option>
                         <?php foreach ($states as  $value) { ?>
                            <option value="{{$value->id}}-{{$value->name}}" <?=($value->id."-".$value->name==$address->state)?'selected':'';?>>{{$value->name}}</option>
                         <?php } ?>
                    </select>  
               </li>
            </ul>
        </div>
    </div>
    <div class="col-md-4 col-sm-12 col-xs-12">
        <label style="color:#000">City</label>
        <div class="media-input-container">
             <ul class="mediainput input-single input-single-select" style="">
              <li>
                   <select id="city_id" name="city_id">
                        <option value="">select</option>
                         <?php foreach ($cities as  $value) { ?>
                            <option value="{{$value->id}}-{{$value->name}}"  <?=($value->id."-".$value->name==$address->city)?'selected':'';?>>{{$value->name}}</option>
                         <?php } ?>
                    </select>  
              </li>
                
            </ul>
        </div>
    </div>
</div>
 <hr/>
 <h4 style="color: #AC0F0B;font-weight: 600;">Tax Benefit Details (We would require Identity Proof)</h4>
  <div class="row" style="margin-bottom: 10px;">
    
    <div class="col-md-6 col-sm-12 col-xs-12">
        <label style="color:#000">Document Type</label>
        <div class="media-input-container">
             <ul class="mediainput input-single input-single-select" style="">
              <li>
                   <select id="documentType" name="documentType">
                        <option value="">select</option>
                        <option value="PAN_CARD" <?=(isset($document->documentType) && $document->documentType=='PAN_CARD')?'selected':'';?>>Pan Card</option>
                        <option value="PASSPORT"  <?=(isset($document->documentType) && $document->documentType=='PASSPORT')?'selected':'';?>>Passport</option>
                        @if($param->supplier==4)
                        <option value="DRIVING_LICENSE"  <?=(isset($document->documentType) && $document->documentType=='DRIVING_LICENSE')?'selected':'';?>>Driving License</option>
                        <option value="VOTER_ID_CARD"  <?=(isset($document->documentType) && $document->documentType=='VOTER_ID_CARD')?'selected':'';?>>Voter Id</option>
                        @endif
                    </select>  
               </li>
            </ul>
        </div>
    </div>
    
    <div class="col-md-6 col-sm-12 col-xs-12">
        <label style="color:#000">Identity Number</label>
        <div class="media-input-container">
             <ul class="mediainput input-single" style="">
              <li>
                <input type="text" maxlength="20" name="documentId" id="documentId" class="form-control word-uppercase" placeholder="Enter Identity Number" value="<?=isset($document->documentId)?$document->documentId:'';?>">
               </li>
            </ul>
        </div>
    </div>
    
     <div class="col-md-6 col-sm-12 col-xs-12">
                <label style="color:#000">Issue Date</label>
                <div class="media-input-container">
                     <ul class="mediainput input-multi" style="">
                      
                            <li style="width:30%;">
                                <select name="docIssue_dd" id="docIssue_dd" class="dd" >
                                    <option value="">Date</option>
                                    <?php for($i=1;$i<=31;$i++){ $no = ($i<10)?"0".$i:$i;?> 
                                         <option value="<?=$no;?>"  <?=(isset($document->documentdd) && $document->documentdd==$no)?'selected':'';?>
                                         ><?=$no;?></option><?php } ?>
                                </select>
                               
                            </li>
                            <li style="width:30%;">
                                <select name="docIssue_mm" id="docIssue_mm" class="mm" >
                                    
                                    <option value="">Month</option>
                                    <?php foreach($month as $key=>$val){?>
                                    
                                    <option value="<?=$key;?>" <?=(isset($document->documentmm) && $document->documentmm==$key)?'selected':'';?>><?=strtoupper($val);?></option>
                                    <?php } ?>
                                </select>
                            </li>
                            <li style="width:30%;">
                                <select name="docIssue_yy" id="docIssue_yy" class="yy">
                                    <option value="">Year</option>
                                     <?php $cy=date('Y'); 
                                           $sy = $cy-50;
                                         for($y=$cy;$y>=$sy;$y--){?>
                                             <option value="<?=$y;?>" <?=(isset($document->documentyy) && $document->documentyy==$y)?'selected':'';?>><?=$y;?></option>
                                    <?php } ?>
                                </select>
                            </li>
                        
                    </ul>
                </div>
            </div>
  </div>
</form>