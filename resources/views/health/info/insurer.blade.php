<?php //print_r($params->members);?>
<h4 style="color: #AC0F0B;font-weight: 600;">Insurer Information</h4>
<form method="POST" action="#" id="insurerInfo-Form">
<?php $month = array('01'=>'Jan', '02'=>'Feb','03'=>'Mar','04'=>'Apr','05'=>'May','06'=>'Jun','07'=>'Jul','08'=>'Aug','09'=>'Sep','10'=>'Oct','11'=>'Nov','12'=>'Dec');?>
<?php $c = 1;foreach($param->members as $ins=>$insurer){
     $readonly = ($insurer->type=="self")?"readonly":"";
     $disabled = ($insurer->type=="self")?"disabled":"";
    // echo ($insurer->type!="self"?(isset($insurer->fname)?$insurer->fname:$param->selfFname:''))); 
     //$days = ($month ==           2 ?($year     %         4 ?     28        : ($year % 100 ? 29 : ($year %400 ? 28 : 29))) : (($month - 1) % 7 % 2 ? 30 : 31));
     //$days = ($insurer->type!="self"?(isset($insurer->fname)?$insurer->fname:""):$param->selfFname);
   //if($insurer->type!="self"){?>
     <div style="margin-top: 5px;border-bottom: 1px solid #ccc;">
        <h4 style="color: #AC0F0B;font-weight: 600;"><?=$c;?> Insurer Information [<?=$insurer->type;?>]</h4>
        <div class="row" style="margin-bottom: 10px;">
            <div class="col-md-6 col-sm-12 col-xs-12">
                <label style="color:#000">First Name</label>
                <div class="media-input-container">
                     <ul class="mediainput input-single" style="">
                      <li>
                        <input <?=$readonly;?> type="text" name="<?=$ins;?>_fname" id="<?=$ins;?>_fname" class="form-control insurer-fname alpha-only word-uppercase" 
                                               placeholder="Enter First Name" value="<?=($insurer->type!="self"?(isset($insurer->fname)?$insurer->fname:""):$param->selfFname);?>">
                       </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">
                <label style="color:#000">Last Name</label>
                <div class="media-input-container">
                     <ul class="mediainput input-single" style="">
                      <li>
                        <input <?=$readonly;?> type="text" name="<?=$ins;?>_lname" id="<?=$ins;?>_lname"
                                               class="form-control insurer-lname alpha-only word-uppercase" placeholder="Enter Last Name" value="<?=($insurer->type!="self"?(isset($insurer->lname)?$insurer->lname:""):$param->selfLname);?>">
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
                                <select name="<?=$ins;?>_dd" id="<?=$ins;?>_dd" class="insurer-dd" <?=$disabled;?>>
                                    <option value="">Date</option>
                                    <?php for($i=1;$i<=31;$i++){ $no = ($i<10)?"0".$i:$i;?> <option value="<?=$no;?>" 
                                        <?=($insurer->type!="self"?((isset($insurer->dd) && $insurer->dd==$no)?"selected":""):(($param->selfdd==$no)?'selected':''));?>
                                        ><?=$no;?></option><?php } ?>
                                </select>
                               
                            </li>
                            <li style="width:30%;">
                                <select name="<?=$ins;?>_mm" id="<?=$ins;?>_mm" class="insurer-mm" <?=$disabled;?>>
                                    
                                    <option value="">Month</option>
                                    <?php foreach($month as $key=>$val){?>
                                    
                                    <option value="<?=$key;?>"
                                        <?=($insurer->type!="self"?((isset($insurer->mm) && $insurer->mm==$key)?"selected":""):(($param->selfmm==$key)?'selected':''));?>
                                        >{{strtoupper($val)}} ({{$key}})</option>
                                    <?php } ?>
                                </select>
                            </li>
                            <li style="width:30%;">
                                <select name="<?=$ins;?>_yy" id="<?=$ins;?>_yy" class="insurer-yy" <?=$disabled;?>>
                                    <option value="">Year</option>
                                     <?php $cy=date('Y');
                                      if($insurer->type=="self" || $insurer->type=="wife" || $insurer->type=="husband"){
                                          $sy = $cy-(18+81);
                                      }else if($insurer->type=="mother" || $insurer->type=="father"){
                                          $sy = $cy-(18+81);
                                      }else if($insurer->type=="son" || $insurer->type=="daughter"){
                                          $sy = $cy-25;
                                      }
                                      //$sy = $cy-18;
                                      for($y=$cy;$y>=$sy;$y--){?> <option value="<?=$y;?>" 
                                      <?=($insurer->type!="self"?((isset($insurer->yy) && $insurer->yy==$y)?"selected":""):(($param->selfyy==$y)?'selected':''));?>
                                      ><?=$y;?></option> <?php } ?>
                                </select>
                            </li>
                        
                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-sm-12 col-xs-12">
                <label style="color:#000">Gender</label>
                <div class="media-input-container">
                     <ul class="mediainput input-single" >
                        <li>
                           <?php /* <select name="<?=$ins;?>_gender" id="<?=$ins;?>_gender" class="insurer-gender" disabled>
                                <option value="">select</option>
                                <option value="Male"   <?=($insurer->type=='son' || $insurer->type=='father' || $insurer->type=="husband")?'selected':'';?>>Male</option>
                                <option value="Female" <?=($insurer->type=='daughter' || $insurer->type=='mother' || $insurer->type=="wife")?'selected':'';?>>Female</option>
                            </select>   */?>
                             <?php //$g = ($insurer->type=='son' || $insurer->type=='father' || $insurer->type=="husband")?"MALE":"FEMALE"; ?>
                             <?php $g = ($insurer->type!="self"?(($insurer->type=='son' || $insurer->type=='father' || $insurer->type=="husband")?"MALE":"FEMALE"):$param->gender);?>
                            <input readonly type="text" name="<?=$ins;?>_gender" id="<?=$ins;?>_gender" class="form-control insurer-gender"  value="<?=$g;?>">
                        </li>
                    </ul>
                </div>
            </div>
            <?php /*
            <div class="col-md-3 col-sm-12 col-xs-12">
            <label style="color:#000">Nominee Relation</label>
            <div class="media-input-container">
                 <ul class="mediainput input-single input-single-select">
                    <li >
                        <select name="<?=$ins;?>_relation" id="<?=$ins;?>_relation" <?=$disabled;?>>
                            <option value="">Select Relation</option>
                             <?php $insRelation = ($insurer->type=="self")?$param->nomineerelation:(isset($insurer->relation)?$insurer->relation:"");?>
                             @foreach($relations as $nr)
                              <option value="{{$nr->value}}"  <?=(isset($insRelation) && $insRelation==$nr->value)?'selected':"";?>>{{$nr->label}}</option>
                             @endforeach
                        </select>   
                    </li>
                </ul>
            </div>
        </div>
             */?>
        </div>
        <div class="row" style="margin-bottom: 10px;">
            <div class="col-md-6 col-sm-12 col-xs-12">
                <label style="color:#000">Height</label>
                <div class="media-input-container">
                     <ul class="mediainput input-multi" >
                      
                            <li style="width:48%;">
                                <select name="<?=$ins;?>_feet" id="<?=$ins;?>_feet" class="insurer-feet" <?=$disabled;?>>
                                    <option value="">Feet</option>
                                    <<?php for($feet=0;$feet<=6;$feet++){ $_ft = ($feet<10)?"0".$feet:$feet;?>
                                    <option value="<?=$_ft;?>"
                                     <?=($insurer->type!="self"?((isset($insurer->feet) && $insurer->feet==$_ft)?"selected":""):(($param->selfFeet==$_ft)?'selected':''));?>
                                    ><?=$_ft." Feet";?></option>
                                    <?php } ?>
                                </select>
                               
                            </li>
                            <li style="width:48%;border-left: 1px solid #ccc;">
                                <select name="<?=$ins;?>_inch" id="<?=$ins;?>_inch" class="insurer-inch" <?=$disabled;?>>
                                    <option value="">Inch</option>
                                    <?php for($inch=0;$inch<=11;$inch++){ $_no = ($inch<10 && $inch>0)?"0".$inch:$inch;?>
                                    <option value="<?=$_no;?>" 
                                      <?=($insurer->type!="self"?((isset($insurer->inch) && $insurer->inch==$_no)?"selected":""):(($param->selfInch==$_no)?'selected':''));?>
                                      ><?=$_no." Inch";?></option>
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
                        <input <?=$readonly;?> type="text" maxlength="3" name="<?=$ins;?>_weight" id="<?=$ins;?>_weight" 
                                class="form-control insurer-weight number-only" placeholder="Enter weight kg" 
                                value="<?=($insurer->type!="self"?(isset($insurer->weight)?$insurer->weight:""):$param->selfWeight);?>">
                       </li>
                       <li style="width:8%;"><label>Kg</label></li>
                        
                    </ul>
                </div>
            </div>
         </div>
         <?php  if($insurer->type!="self"){?>
        <h4 style="color: #AC0F0B;font-weight: 600;">Nominnee Information [<?=$insurer->type;?>]</h4> 
        <div class="row">
            <div class="col-md-4 col-sm-12 col-xs-12">
                <label style="color:#000">Nominnee Name</label>
                <p style="margin-top:0px;font-weight: bold;font-size: 12px;">{{$param->selfFname}} {{$param->selfLname}}</p>
            </div>
            <div class="col-md-4 col-sm-12 col-xs-12">
                 <label style="color:#000">Nominnee DOB</label>
                 <p style="margin-top:0px;font-weight: bold;font-size: 12px;">{{$param->selfdd}}/{{$param->selfmm}}/{{$param->selfyy}}</p>
                </div>
            <div class="col-md-4 col-sm-12 col-xs-12">
                <label style="color:#000">Nominnee Relation</label>
                <?php $r="";if($param->gender=='MALE'){
                                 if($insurer->type=="wife" ){ $r="Husband"; }
                                else if($insurer->type=="husband"){  $r="Wife"; }
                                else if($insurer->type=="son" || $insurer->type=="daughter"){  $r="Father"; }
                                else if($insurer->type=="father" || $insurer->type=="mother"){  $r="Son"; }
                        }else{
                                if($insurer->type=="wife" ){ $r="Husband"; }
                                else if($insurer->type=="husband"){  $r="Wife"; }
                                else if($insurer->type=="son" || $insurer->type=="daughter"){  $r="Mother"; }
                                else if($insurer->type=="father" || $insurer->type=="mother"){  $r="Son"; }  
                        }?>
                <p style="margin-top:0px;font-weight: bold;font-size: 12px;">{{$r}}</p>
                </div>
        </div>
        <?php } ?>
    </div> 
   <?php $c++;//} ?>
<?php } ?>
</form>
