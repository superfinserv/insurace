<style>
    .question_desc{
        display:none;
    }
    .users-span-error{
        font-size: 12px;
        margin-left: 0px;
        color: red;
        font-weight: 600;
        margin-bottom: 12px;
        }
        
 .input-radio {
	 position: absolute;
	 visibility: hidden;
	 display: none;
}
 label.input-radio-label {
	 color: #9a929e;
	 display: inline-block;
	 cursor: pointer;
	 font-weight: bold;
	 padding: 5px 20px;
	 margin-bottom:0px;
}
 .input-radio:checked + label.input-radio-label {
	color: #fff;
    background: #AC0F0B;
}
/* label.input-radio-label + .input-radio + label.input-radio-label {*/
/*	 border-left: solid 3px #675f6b;*/
/*}*/
 .input-radio-group {
	 border: solid 2px #AC0F0B;
	 display: inline-block;
	 /*margin: 20px;*/
	 border-radius: 10px;
	 overflow: hidden;
}
</style>
<?php //print_r($param->medical);?>
<div class="row">
    <div class="col-md-9">
        <h6 style="font-size: 15px;text-transform: none;color: black;line-height: 1.8;">Does any person(s) to be insured has any pre-existing diseases?</h6>
    </div>
    <div class="col-md-3">
        <div class="input-radio-group">
             <input type="radio" value="Yes" class="input-radio hasAnyMedical" id="hasAnyMedical-Yes" name="hasAnyMedical" <?=(isset($param->hasMedical) && ($param->hasMedical=='YES'))?'checked':'';?>>
             <label for="hasAnyMedical-Yes" class="input-radio-label ">Yes</label>
             <input type="radio"  value="No" class="input-radio hasAnyMedical"  id="hasAnyMedical-No" name="hasAnyMedical" <?=(!isset($param->hasMedical) || (isset($param->hasMedical) && ($param->hasMedical=='NO')))?'checked':'';?>>
             <label for="hasAnyMedical-No" class="input-radio-label ">No</label>
        </div>
    </div>
</div>
<div class="questionList" style="border: 1px solid #ccc;padding: 10px;<?=(isset($param->hasMedical) && ($param->hasMedical=='YES'))?'display:block;':'display:none;';?>">
    <?php
    $month = array('01'=>'Jan', '02'=>'Feb','03'=>'Mar','04'=>'Apr','05'=>'May','06'=>'Jun','07'=>'Jul','08'=>'Aug','09'=>'Sep','10'=>'Oct','11'=>'Nov','12'=>'Dec');
    $cignaLvl802 = ['Lvl02_O802_01','Lvl02_O802_02','Lvl02_O802_03','Lvl02_O802_04','Lvl02_O802_05','Lvl02_O802_06','Lvl02_O802_07','Lvl02_O802_08','Lvl02_O802_09','Lvl02_O802_10','Lvl02_O802_11','Lvl02_O802_12','Lvl02_O802_13','Lvl02_O802_14'];
    foreach($questions as $que){ 
        $isQuecheked = false;
        if(isset($param->medical->{$que->id})){$isQuecheked = true;}
        $childQueCnt = DB::table('medical_questions')->where('parentId',$que->id)->count(); 
    ?>
    <div class="row medical-que question_head_<?=$que->id;?>" style="margin-bottom: 30px;" >
        <div class="col-md-12 col-sm-12 col-xs-12">
             <div class="th-border">
                <label class="control control--checkbox"><?=$que->title;?>
                  <input @if($isQuecheked) checked @endif type="checkbox" name="medical_que_<?=$que->id;?>" data-child="{{$childQueCnt}}" data-boolean="<?=$que->isBoolean;?>"  data-text="<?=$que->isText;?>" data-since="<?=$que->isSince;?>"  data-title="<?=$que->title;?>" value="<?=$que->id;?>" class="medical_que medical_que_<?=$que->id;?>"/>
                  <div class="control__indicator"></div>
                </label>
            </div>
             <div class="question_desc  question_desc_<?=$que->id;?>" style="margin: 10px 0px 0px 0px;background: #fafafa;padding: 5px;@if($isQuecheked) display:block; @endif">
                <h5><?=$que->question;?></h5>
                <div class="row" style="">
                     <div class="col-md-12 col-sm-12 col-xs-12"><span class="users-span-error error-select-user-<?=$que->id;?>"></span></div>
                    <?php foreach($param->members as $ins=>$insurer){ 
                        $isMemChecked = false;
                        $YearFrom = $insurer->yy;
                        $YearTill =date('Y');
                        if($isQuecheked){ $isMemChecked =  isset($insurer->medical->{$que->id})?true:false;}
                        $monthsel = "";$yearSel="";$textDesc="";$booleanYN="";
                       
                    ?>
                    <div class="col-md-6 col-sm-6 col-xs-12" style=" margin-bottom: 12px;">
                        <div class="td-border">
                          <label class="control control--checkbox"><?=($insurer->type=="self")?$param->selfName:$insurer->fname." ".$insurer->lname;?>
                            <input  @if($isMemChecked) checked @endif type="checkbox" name="ins-members-<?=$ins;?>" data-key="<?=$ins;?>" value="<?=$que->id;?>_<?=$ins;?>" data-username="<?=($insurer->type=="self")?$param->selfName:$insurer->fname." ".$insurer->lname;?>" class="ins-members ins-members-<?=$que->id;?> ins-members-<?=$ins;?>"/>
                            <div class="control__indicator"></div>
                          </label>
                        </div>
                        <div class="row insurer-medical-info-<?=$que->id;?>_<?=$ins;?>" style="@if($isMemChecked) display:block; @else display:none; @endif">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                             <?php 
                                 if($childQueCnt){
                                 $childQues = DB::table('medical_questions')->where('parentId',$que->id)->get();
                                 
                                    foreach($childQues as $childQue){
                                        
                                        $_isQuecheked = false;
                                        if(isset($param->medical->{$childQue->id})){$_isQuecheked = true;} ?>
                                        
                                        <?php if($childQue->isSince=='YES' ){?>
                                                <label class="child-Que-{{$que->id}}-{{$ins}}" data-id="<?=$childQue->id;?>" data-since="YES" data-text="NO" data-bool="NO" data-parent="{{$que->id}}" style="color:#000">{{$childQue->title}} (Since)</label>
                                                <div class="media-input-container">
                                                    <ul class="mediainput input-multi" style="">
                                                        <li style="width:45%;">
                                                            <select class="medi_since_mm" name="medi_since_mm_<?=$childQue->id;?>_<?=$ins;?>" id="medi_since_mm_<?=$childQue->id;?>_<?=$ins;?>">
                                                               <option value="">Month</option>
                                                                <?php foreach($month as $key=>$val){?>
                                                                <option value="<?=$key;?>" <?=($isMemChecked && $monthsel==$key)?'selected':'';?>><?=strtoupper($val);?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </li>
                                                        <li style="width:45%;">
                                                            <select class="medi_since_yy child-Que-{{$que->id}}" name="medi_since_yy_<?=$childQue->id;?>_<?=$ins;?>" id="medi_since_yy_<?=$childQue->id;?>_<?=$ins;?>">
                                                                <option value="">Year</option>
                                                                <?php 
                                                                     for($y=$YearFrom;$y<=$YearTill;$y++){?> 
                                                                     <option value="<?=$y;?>" <?=($isMemChecked && $yearSel==$y)?'selected':'';?>><?=$y;?></option> 
                                                                     <?php } ?>
                                                                     
                                                            </select>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <span class="span-error error-time-since-<?=$childQue->id;?>_<?=$ins;?>">Please choose time?</span> 
                                            <?php } ?>
                                            <?php if($childQue->isBoolean=='YES'){?>
                                                <label class="child-Que-{{$que->id}}-{{$ins}}  @if(in_array($childQue->setcode, $cignaLvl802)) has-sub-child @endif" data-id="<?=$childQue->id;?>" data-since="NO" data-text="NO" data-bool="YES" data-parent="{{$que->id}}" style="color:#000">{{$childQue->title}}</label>
                                                <div class="media-input-container">
                                                    <ul class="mediainput input-multi" style="">
                                                        <li style="width:95%;">
                                                            <select class="medi_boolean " name="medi_boolean_<?=$childQue->id;?>_<?=$ins;?>" id="medi_boolean_<?=$childQue->id;?>_<?=$ins;?>">
                                                               <option value="">-select-</option>
                                                               <option value="YES" <?=($isMemChecked && $booleanYN=='YES')?'selected':'';?>>Yes</option>
                                                               <option value="NO"  <?=($isMemChecked && $booleanYN=='NO')?'selected':'';?>>No</option>
                                                            </select>
                                                        </li>
                                                    
                                                    </ul>
                                                </div>
                                                <span class="span-error error-yesno-boolean-<?=$childQue->id;?>_<?=$ins;?>">Please select Yes/No?</span> 
                                                
                                                @if(!is_null($childQue->subQuestionsJson))
                                                   <div style="display:none;" class="subChild-elem-{{$childQue->id}}">
                                                      <?php 
                                                        $subQuestionJson = $childQue->subQuestionsJson;
                                                        $subQuestions = json_decode($subQuestionJson);
                                                         foreach($subQuestions->data as $subQ){ ?>
                                                            
                                                               <label class="child-Que-{{$childQue->id}}-{{$ins}}" data-id="<?=$subQ->setcode;?>"  data-parent="{{$subQuestions->setCode}}" style="color:#000">{{$subQ->Que}}</label>
                                                                <div class="media-input-container">
                                                                    <ul class="mediainput input-multi" style="">
                                                                        <li style="width:95%;">
                                                                            <select class="medi_boolean" name="medi_boolean_<?=$subQ->setcode;?>_<?=$ins;?>" id="medi_boolean_<?=$subQ->setcode;?>_<?=$ins;?>">
                                                                               @foreach($subQ->options as $opt)
                                                                               <option value="{{$opt->value}}">{{$opt->label}}</option>
                                                                               @endforeach
                                                                              
                                                                            </select>
                                                                        </li>
                                                                    
                                                                    </ul>
                                                                </div>
                                                                <span class="span-error error-yesno-boolean-<?=$subQ->setcode;?>_<?=$ins;?>">Please select Yes/No?</span>  
                                                         
                                                         <?php } ?>
                                                  </div>
                                                @endif
                                               
                                            <?php } // boolean ?>
                                            <?php if($childQue->isText=='YES'){?>
                                                <label class="child-Que-{{$que->id}}-{{$ins}}" data-id="<?=$childQue->id;?>" data-since="NO" data-text="YES" data-bool="NO" data-parent="{{$que->id}}" style="color:#000">{{$childQue->title}}</label>
                                                <div class="media-input-container">
                                                    <ul class="mediainput input-single" style="">
                                                        <li style="width:95%;">
                                                            <input type="text" value="<?=$textDesc;?>" class="medi_text form-control " placeholder="Enter Description" name="medi_text_<?=$childQue->id;?>_<?=$ins;?>" id="medi_text_<?=$childQue->id;?>_<?=$ins;?>">
                                                        </li>
                                                    
                                                    </ul>
                                                </div>
                                                <span class="span-error error-desc-text-<?=$childQue->id;?>_<?=$ins;?>">Please enter description.?</span> 
                                            <?php } ?>
                                     
                                   <?php } // child foreach end here?>
                           <?php } /*else{ // if has child count here ?>
                                <!--<div class="row insurer-medical-info-<?=$que->id;?>_<?=$ins;?>" style="@if($isMemChecked) display:block; @else display:none; @endif">-->
                                 <!--    <div class="col-md-12 col-sm-12 col-xs-12">-->
                                            <?php if($que->isSince=='YES' ){?>
                                                <label style="color:#000">Since when?</label>
                                                <div class="media-input-container">
                                                    <ul class="mediainput input-multi" style="">
                                                        <li style="width:45%;">
                                                            <select class="medi_since_mm" name="medi_since_mm_<?=$que->id;?>_<?=$ins;?>" id="medi_since_mm_<?=$que->id;?>_<?=$ins;?>">
                                                               <option value="">Month</option>
                                                                <?php foreach($month as $key=>$val){?>
                                                                <option value="<?=$key;?>" <?=($isMemChecked && $monthsel==$key)?'selected':'';?>><?=strtoupper($val);?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </li>
                                                        <li style="width:45%;">
                                                            <select class="medi_since_yy" name="medi_since_yy_<?=$que->id;?>_<?=$ins;?>" id="medi_since_yy_<?=$que->id;?>_<?=$ins;?>">
                                                                <option value="">Year</option>
                                                                <?php 
                                                                     for($y=$YearFrom;$y<=$YearTill;$y++){?> 
                                                                     <option value="<?=$y;?>" <?=($isMemChecked && $yearSel==$y)?'selected':'';?>><?=$y;?></option> 
                                                                     <?php } ?>
                                                                     
                                                            </select>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <span class="span-error error-time-since-<?=$que->id;?>_<?=$ins;?>">Please choose time?</span> 
                                            <?php } ?>
                                            <?php if($que->isBoolean=='YES'){?>
                                                <label style="color:#000">Select?</label>
                                                <div class="media-input-container">
                                                    <ul class="mediainput input-multi" style="">
                                                        <li style="width:95%;">
                                                            <select class="medi_boolean" name="medi_boolean_<?=$que->id;?>_<?=$ins;?>" id="medi_boolean_<?=$que->id;?>_<?=$ins;?>">
                                                               <option value="">-select-</option>
                                                               <option value="YES" <?=($isMemChecked && $booleanYN=='YES')?'selected':'';?>>Yes</option>
                                                               <option value="NO"  <?=($isMemChecked && $booleanYN=='NO')?'selected':'';?>>No</option>
                                                            </select>
                                                        </li>
                                                    
                                                    </ul>
                                                </div>
                                                <span class="span-error error-yesno-boolean-<?=$que->id;?>_<?=$ins;?>">Please select Yes/No?</span> 
                                            <?php } ?>
                                            <?php if($que->isText=='YES'){?>
                                                <label style="color:#000">Enter Description?</label>
                                                <div class="media-input-container">
                                                    <ul class="mediainput input-single" style="">
                                                        <li style="width:95%;">
                                                            <input type="text" value="<?=$textDesc;?>" class="medi_text form-control" placeholder="Enter Description" name="medi_text_<?=$que->id;?>_<?=$ins;?>" id="medi_text_<?=$que->id;?>_<?=$ins;?>">
                                                        </li>
                                                    
                                                    </ul>
                                                </div>
                                                <span class="span-error error-desc-text-<?=$que->id;?>_<?=$ins;?>">Please enter description.?</span> 
                                            <?php } ?>
                                   <!-- </div>-->
                                <!--</div>-->
                        <?php } */// else has child count here ?>
                          </div>
                        </div>
                        
                          
                    </div>
                  
                    <?php } ?>
                    
                </div>
            </div>
        
       
        
    </div>
    </div>
    
    <hr/>
    <?php } ?>
    <span class="error-medical" style="color:red;font-weight: 600;font-size: 12px;"></span>
</div>