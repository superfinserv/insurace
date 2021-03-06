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
 @media (min-width:768px) { 
     label.input-radio-label{
             padding: 5px 12px;
     }
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
                                        
                                            <?php if($childQue->inputType=='text'){?>
                                                <label class="child-Que-{{$childQue->id}}-{{$ins}}" data-id="<?=$childQue->id;?>"  data-parent="{{$que->id}}" style="color:#000">{{$childQue->title}}</label>
                                                <div class="media-input-container">
                                                    <ul class="mediainput input-single" style="">
                                                        <li style="width:95%;">
                                                            <input type="text" data-id="<?=$childQue->id;?>" data-type="{{$childQue->inputType}}" value="<?=$textDesc;?>" class="medi_text form-control child-input-{{$que->id}}-{{$ins}}" placeholder="Enter Description" name="medi_{{$childQue->inputType}}_<?=$childQue->id;?>_<?=$ins;?>" id="medi_{{$childQue->inputType}}_<?=$childQue->id;?>_<?=$ins;?>">
                                                        </li>
                                                    </ul>
                                                </div>
                                                <span class="span-error error-desc-text-<?=$childQue->id;?>_<?=$ins;?>">Required</span> 
                                            <?php } ?>
                                            
                                            <?php if($childQue->inputType=='year'){?>
                                                <label class="child-Que-{{$childQue->id}}-{{$ins}}" data-id="<?=$childQue->id;?>"  data-parent="{{$que->id}}" style="color:#000">{{$childQue->title}}</label>
                                                <div class="media-input-container">
                                                    <ul class="mediainput input-single" style="">
                                                        <li style="width:95%;">
                                                            <select data-id="<?=$childQue->id;?>" class="medi_boolean child-input-{{$que->id}}-{{$ins}}" data-type="{{$childQue->inputType}}"  name="medi_{{$childQue->inputType}}_<?=$childQue->id;?>_<?=$ins;?>" id="medi_{{$childQue->inputType}}_<?=$childQue->id;?>_<?=$ins;?>">
                                                               <option value="">-select-</option>
                                                             <?php $cy =  date('Y');
                                                             for($y=$cy;$y>=$cy-35;$y--){?>
                                                                   <option value="{{$y}}">{{$y}}</option>
                                                                <?php  } ?>
                                                               
                                                            </select>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <span class="span-error error-desc-text-<?=$childQue->id;?>_<?=$ins;?>">Required</span> 
                                            <?php } ?>
                                            
                                            <?php if($childQue->inputType=='date'){?>
                                                <label class="child-Que-{{$childQue->id}}-{{$ins}}" data-id="<?=$childQue->id;?>"  data-parent="{{$que->id}}" style="color:#000">{{$childQue->title}}</label>
                                                <div class="media-input-container">
                                                    <ul class="mediainput input-single" style="">
                                                        <li style="width:95%;">
                                                            <input type="text" data-dob="{{$insurer->dob}}" data-id="<?=$childQue->id;?>" data-type="{{$childQue->inputType}}" value="<?=$textDesc;?>" class="dmy-mask medi_text form-control child-input-{{$que->id}}-{{$ins}}" placeholder="d/m/Y" name="medi_{{$childQue->inputType}}_<?=$childQue->id;?>_<?=$ins;?>" id="medi_{{$childQue->inputType}}_<?=$childQue->id;?>_<?=$ins;?>">
                                                        </li>
                                                    </ul>
                                                </div>
                                                <span class="span-error error-desc-text-<?=$childQue->id;?>_<?=$ins;?>">Required</span> 
                                            <?php } ?>
                                            
                                            <?php if($childQue->inputType=='select'){
                                                $optionJson = json_decode($childQue->subQuestionsJson);
                                                $options = $optionJson->options;
                                            ?>
                                              <label class="child-Que-{{$childQue->id}}-{{$ins}}" data-id="<?=$childQue->id;?>" data-parent="{{$que->id}}" style="color:#000">{{$childQue->title}}</label>
                                                <div class="media-input-container">
                                                    <ul class="mediainput input-multi" style="">
                                                        <li style="width:95%;">
                                                            <select data-id="<?=$childQue->id;?>" class="medi_boolean child-input-{{$que->id}}-{{$ins}}" data-type="{{$childQue->inputType}}"  name="medi_{{$childQue->inputType}}_<?=$childQue->id;?>_<?=$ins;?>" id="medi_{{$childQue->inputType}}_<?=$childQue->id;?>_<?=$ins;?>">
                                                               <option value="">-select-</option>
                                                               @foreach($options as $opt)
                                                                   <option value="{{$opt->value}}">{{$opt->label}}</option>
                                                               @endforeach
                                                            </select>
                                                        </li>
                                                    
                                                    </ul>
                                                </div>
                                                <span class="span-error error-yesno-boolean-<?=$childQue->id;?>_<?=$ins;?>">Required</span> 
                                            <?php } ?>
                                     
                                   <?php } // child foreach end here?>
                           <?php } ?>
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