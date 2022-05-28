<?php $name = explode(" ",$param->selfName);?>
<h4 style="color: #AC0F0B;font-weight: 600;">Proposer Information</h4>
<form method="POST" action="#" id="proposerInfo-Form">
    <div class="row" style="margin-bottom: 10px;">
        <div class="col-md-6 col-sm-12 col-xs-12">
            <label style="color:#000">First Name</label>
            <div class="media-input-container">
                 <ul class="mediainput input-single" style="">
                  <li>
                    <input type="text" name="self_fname" id="self_fname" value="<?=isset($param->selfFname)?$param->selfFname:"";?>" class="form-control alpha-only word-uppercase" placeholder="Enter First Name" >
                   </li>
                </ul>
            </div>
        </div>
        <div class="col-md-6 col-sm-12 col-xs-12">
            <label style="color:#000">Last Name</label>
            <div class="media-input-container">
                 <ul class="mediainput input-single" style="">
                  <li>
                    <input type="text" name="self_lname" id="self_lname" value="<?=isset($param->selfLname)?$param->selfLname:"";?>" class="form-control alpha-only word-uppercase" placeholder="Enter Last Name">
                  </li>
                    
                </ul>
            </div>
        </div>
    </div>
    
    <div class="row" style="margin-bottom: 10px;">
        <div class="col-md-6 col-sm-12 col-xs-12">
            <label style="color:#000">Email Address</label>
            <div class="media-input-container">
                 <ul class="mediainput input-single" style="">
                  <li>
                    <input type="text" name="self_email" id="self_email" value="<?=isset($param->selfEmail)?$param->selfEmail:"";?>" class="form-control" placeholder="Enter Email address" >
                   </li>
                </ul>
            </div>
        </div>
        <div class="col-md-6 col-sm-12 col-xs-12">
            <label style="color:#000">Mobile Number</label>
            <div class="media-input-container">
                 <ul class="mediainput input-single" style="">
                  <li>
                    <input type="text" name="self_mobile"  maxlength="10" id="self_mobile" value="<?=isset($param->selfMobile)?$param->selfMobile:"";?>" class="form-control number-only" placeholder="Enter Mobile number">
                  </li>
                    
                </ul>
            </div>
        </div>
</div>
    
    <div class="row" style="margin-bottom: 10px;">
        <div class="col-md-6 col-sm-12 col-xs-12">
            <label style="color:#000">Date of birth</label>
            <div class="media-input-container">
                 <ul class="mediainput input-multi" style="">
                  
                        <li style="width:30%;">
                            <select name="self_dd" id="self_dd" >
                                <option value="">Date</option>
                                <?php for($i=1;$i<=31;$i++){ $no = ($i<10)?"0".$i:$i;?> <option value="<?=$no;?>" <?=(isset($param->selfdd) && $param->selfdd==$no)?'selected':"";?>><?=$no;?></option><?php } ?>
                            </select>
                           
                        </li>
                        <li style="width:30%;">
                            <select name="self_mm" id="self_mm">
                                <?php $month = array('01'=>'Jan', '02'=>'Feb','03'=>'Mar','04'=>'Apr','05'=>'May','06'=>'Jun','07'=>'Jul','08'=>'Aug','09'=>'Sep','10'=>'Oct','11'=>'Nov','12'=>'Dec');?>
                                <option value="">Month</option>
                                <?php foreach($month as $key=>$val){?>
                                <option value="<?=$key;?>" <?=(isset($param->selfmm) && $param->selfmm==$key)?'selected':"";?>>{{strtoupper($val)}} ({{$key}})</option>
                                <?php } ?>
                            </select>
                        </li>
                        <li style="width:30%;">
                            <select name="self_yy" id="self_yy">
                                <option value="">Year</option>
                                <?php $cy=date('Y');
                                      $sy = $cy-99;
                                  for($y=$cy;$y>=$sy;$y--){?> <option value="<?=$y;?>" <?=(isset($param->selfyy) && $param->selfyy==$y)?'selected':"";?>><?=$y;?></option> <?php } ?>
                            </select>
                        </li>
                    
                </ul>
            </div>
        </div>
        <div class="col-md-3 col-sm-12 col-xs-12">
            <label style="color:#000">Marital status</label>
            <div class="media-input-container">
                 <ul class="mediainput input-single input-single-select">
                    <li >
                        <select name="self_mstatus" id="self_mstatus">
                            <option value="">select</option>
                            <option value="Single" <?=(isset($param->selfMstatus) && $param->selfMstatus=='Single')?'selected':"";?>>Single</option>
                            <option value="Married" <?=(isset($param->selfMstatus) && $param->selfMstatus=='Married')?'selected':"";?>>Married</option>
                        </select>   
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-3 col-sm-12 col-xs-12">
            <label style="color:#000">Gender</label>
            <div class="media-input-container">
                 <ul class="mediainput input-single input-single-select" >
                    <li>
                        <select name="self_gender" id="self_gender">
                            <option value="">select</option>
                            <option value="MALE" <?=($param->gender=='MALE')?'selected':'';?>>Male</option>
                            <option value="FEMALE" <?=($param->gender=='FEMALE')?'selected':'';?>>Female</option>
                        </select>   
                    </li>
                </ul>
            </div>
        </div>
</div>
    
    <div class="row" style="margin-bottom: 10px;">
        <div class="col-md-6 col-sm-12 col-xs-12">
            <label style="color:#000">Height</label>
            <div class="media-input-container">
                 <ul class="mediainput input-multi" >
                  
                        <li style="width:48%;">
                            <select name="self_feet" id="self_feet" style="">
                                <option value="">Feet</option>
                                <<?php for($feet=0;$feet<=6;$feet++){ $_ft = ($feet<10 && $feet!=0)?"0".$feet:$feet;?>
                                <option value="<?=$_ft;?>" <?=(isset($param->selfFeet) && $param->selfFeet==$_ft)?'selected':"";?>><?=$_ft." Feet";?></option>
                                <?php } ?>
                            </select>
                           
                        </li>
                        <li style="width:48%;border-left: 1px solid #ccc;">
                            <select name="self_inch" id="self_inch">
                                <option value="">Inch</option>
                                <?php for($inch=0;$inch<=11;$inch++){ $_no = ($inch<10 && $inch!=0)?"0".$inch:$inch;?>
                                <option value="<?=$_no;?>" <?=(isset($param->selfInch) && $param->selfInch==$_no)?'selected':"";?>><?=$_no." Inch";?></option>
                                <?php } ?>
                            </select>
                        </li>
                </ul>
            </div>
        </div>
        <div class="col-md-6 col-sm-12 col-xs-12">
            <label style="color:#000">Weight (in Kg)</label>
            <div class="media-input-container">
                 <ul class="mediainput input-single">
                   <li style="width:88%;">
                    <input type="text" maxlength="3" name="self_weight" id="self_weight" value="<?=isset($param->selfWeight)?$param->selfWeight:"";?>" class="form-control number-only" placeholder="Enter weight">
                   </li>
                   <li style="width:8%;"><label>Kg</label></li>
                    
                </ul>
            </div>
        </div>
     </div>
     <hr/>
     <h4 style="color: #AC0F0B;font-weight: 600;">Nominee Details:</h4>
    <div class="row" style="margin-bottom: 10px;">
        
        <div class="col-lg-4 col-xl-4 col-md-6 col-sm-12 col-xs-12">
            <label style="color:#000">Nominee Name</label>
            <div class="media-input-container">
                 <ul class="mediainput input-single" style="">
                  <li>
                    <input type="text" name="nominee_name" id="nominee_name" value="<?=isset($param->nomineename)?$param->nomineename:"";?>" class="form-control word-uppercase" placeholder="Nominee Fullname" >
                   </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-5 col-xl-5 col-md-6 col-sm-12 col-xs-12">
            <label style="color:#000">Date of birth</label>
            <div class="media-input-container">
                 <ul class="mediainput input-multi" style="">
                  
                        <li style="width:30%;">
                            <select name="nominee_dd" id="nominee_dd" >
                                <option value="">Date</option>
                                <?php for($i=1;$i<=31;$i++){ $no = ($i<10)?"0".$i:$i;?> <option value="<?=$no;?>" <?=(isset($param->nomineedd) && $param->nomineedd==$no)?'selected':"";?>><?=$no;?></option><?php } ?>
                            </select>
                           
                        </li>
                        <li style="width:30%;">
                            <select name="nominee_mm" id="nominee_mm">
                                <?php $month = array('01'=>'Jan', '02'=>'Feb','03'=>'Mar','04'=>'Apr','05'=>'May','06'=>'Jun','07'=>'Jul','08'=>'Aug','09'=>'Sep','10'=>'Oct','11'=>'Nov','12'=>'Dec');?>
                                <option value="">Month</option>
                                <?php foreach($month as $key=>$val){?>
                                <option value="<?=$key;?>" <?=(isset($param->nomineemm) && $param->nomineemm==$key)?'selected':"";?>>{{strtoupper($val)}} ({{$key}})</option>
                                <?php } ?>
                            </select>
                        </li>
                        <li style="width:30%;">
                            <select name="nominee_yy" id="nominee_yy">
                                <option value="">Year</option>
                                <?php $cy=date('Y')-1;
                                      $sy = $cy-90;
                                  for($y=$cy;$y>=$sy;$y--){?> <option value="<?=$y;?>" <?=(isset($param->nomineeyy) && $param->nomineeyy==$y)?'selected':"";?>><?=$y;?></option> <?php } ?>
                            </select>
                        </li>
                    
                </ul>
            </div>
        </div>
        <div class="col-lg-3 col-xl-3 col-md-6 col-sm-12 col-xs-12">
            <label style="color:#000">Nominee Relation</label>

            <div class="media-input-container">
                 <ul class="mediainput input-single input-single-select">
                    <li >
                        <select name="nominee_relation" id="nominee_relation">
                            <option value="">Select Relation</option>
                             @foreach($relations as $nr)
                               
                              <option value="{{$nr->value}}"  <?=(isset($param->nomineerelation) && $param->nomineerelation==$nr->value)?'selected':"";?>>{{$nr->label}}</option>
                             @endforeach
                        </select>   
                    </li>
                </ul>
            </div>
        </div>
</div>
</form>