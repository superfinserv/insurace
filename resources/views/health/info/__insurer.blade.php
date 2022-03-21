<?php print_r($params->members);?>
<?php foreach($params->members as $insurer){?>
<div style="margin-top: 5px;border-bottom: 1px solid #ccc;">
    <h4 style="color: #AC0F0B;font-weight: 600;">1 Insurer Information</h4>
    <div class="row">
        <div class="col-md-6 col-sm-12 col-xs-12">
            <label style="color:#000">First Name</label>
            <div class="media-input-container">
                 <ul class="mediainput input-single" style="">
                  <li>
                    <input type="text" name="self-name" id="self-name" class="form-control" placeholder="Enter First Name" >
                   </li>
                </ul>
            </div>
        </div>
        <div class="col-md-6 col-sm-12 col-xs-12">
            <label style="color:#000">Last Name</label>
            <div class="media-input-container">
                 <ul class="mediainput input-single" style="">
                  <li>
                    <input type="text" name="self-name" id="self-name" class="form-control" placeholder="Enter Last Name">
                  </li>
                    
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-12 col-xs-12">
            <label style="color:#000">Date of birth</label>
            <div class="media-input-container">
                 <ul class="mediainput input-multi" style="">
                  
                        <li style="width:30%;">
                            <select name="self-dd" name="self-dd" >
                                <option class="">Date</option>
                                <?php for($i=1;$i<=31;$i++){ $no = ($i<10)?"0".$i:$i;?> <option class="<?=$no;?>"><?=$no;?></option><?php } ?>
                            </select>
                           
                        </li>
                        <li style="width:30%;">
                            <select name="self-mm" name="self-mm">
                                <?php $month = array('01'=>'Jan', '02'=>'Feb','03'=>'Mar','04'=>'Apr','05'=>'May','06'=>'Jun','07'=>'Jul','08'=>'Aug','09'=>'Sep','10'=>'Oct','11'=>'Nov','12'=>'Dec');?>
                                <option class="">Month</option>
                                <?php foreach($month as $key=>$val){?>
                                <option class="<?=$key;?>"><?=strtoupper($val);?></option>
                                <?php } ?>
                            </select>
                        </li>
                        <li style="width:30%;">
                            <select name="self-yy" name="self-yy">
                                <option class="">Year</option>
                                <option class="1950">1950</option>
                                <option class="1950">1950</option>
                            </select>
                        </li>
                    
                </ul>
            </div>
        </div>
        <div class="col-md-4 col-sm-12 col-xs-12">
            <label style="color:#000">Relationship with Proposer</label>
            <div class="media-input-container">
                 <ul class="mediainput input-single input-single-select">
                    <li >
                        <select name="self-mstatus" name="self-mstatus">
                            <option class="">select</option>
                            <option class="single">Single</option>
                            <option class="married">Married</option>
                        </select>   
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-2 col-sm-12 col-xs-12">
            <label style="color:#000">Gender</label>
            <div class="media-input-container">
                 <ul class="mediainput input-single input-single-select" >
                    <li>
                        <select name="self-gender" name="self-gender">
                            <option class="">select</option>
                            <option class="Male">Male</option>
                            <option class="Female">Female</option>
                        </select>   
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-12 col-xs-12">
            <label style="color:#000">Height</label>
            <div class="media-input-container">
                 <ul class="mediainput input-multi" >
                  
                        <li style="width:48%;">
                            <select name="self-feet" name="self-feet" style="">
                                <option class="">Feet</option>
                                <<?php for($feet=0;$feet<=6;$feet++){ $_ft = ($feet<10)?"0".$feet:$feet;?>
                                <option class="<?=$_ft;?>"><?=$_ft." Feet";?></option>
                                <?php } ?>
                            </select>
                           
                        </li>
                        <li style="width:48%;border-left: 1px solid #ccc;">
                            <select name="self-inch" name="self-inch">
                                <option class="">Inch</option>
                                <?php for($inch=0;$inch<=11;$inch++){ $_no = ($inch<10)?"0".$inch:$inch;?>
                                <option class="<?=$_no;?>"><?=$_no." Inch";?></option>
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
                    <input type="text" name="self-weight" id="self-weight" class="form-control" placeholder="Enter weight">
                   </li>
                   <li style="width:8%;"><label>Kg</label></li>
                    
                </ul>
            </div>
        </div>
     </div>
</div> 
<?php } ?>

 <div style="margin-top: 5px;border-bottom: 1px solid #ccc;">
    <h4 style="color: #AC0F0B;font-weight: 600;">2 Insurer Information</h4>
    <div class="row">
        <div class="col-md-6 col-sm-12 col-xs-12">
            <label style="color:#000">First Name</label>
            <div class="media-input-container">
                 <ul class="mediainput input-single" style="">
                  <li>
                    <input type="text" name="self-name" id="self-name" class="form-control" placeholder="Enter First Name" >
                   </li>
                </ul>
            </div>
        </div>
        <div class="col-md-6 col-sm-12 col-xs-12">
            <label style="color:#000">Last Name</label>
            <div class="media-input-container">
                 <ul class="mediainput input-single" style="">
                  <li>
                    <input type="text" name="self-name" id="self-name" class="form-control" placeholder="Enter Last Name">
                  </li>
                    
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-12 col-xs-12">
            <label style="color:#000">Date of birth</label>
            <div class="media-input-container">
                 <ul class="mediainput input-multi" style="">
                  
                        <li style="width:30%;">
                            <select name="self-dd" name="self-dd" >
                                <option class="">Date</option>
                                <?php for($i=1;$i<=31;$i++){ $no = ($i<10)?"0".$i:$i;?> <option class="<?=$no;?>"><?=$no;?></option><?php } ?>
                            </select>
                           
                        </li>
                        <li style="width:30%;">
                            <select name="self-mm" name="self-mm">
                                <?php $month = array('01'=>'Jan', '02'=>'Feb','03'=>'Mar','04'=>'Apr','05'=>'May','06'=>'Jun','07'=>'Jul','08'=>'Aug','09'=>'Sep','10'=>'Oct','11'=>'Nov','12'=>'Dec');?>
                                <option class="">Month</option>
                                <?php foreach($month as $key=>$val){?>
                                <option class="<?=$key;?>"><?=strtoupper($val);?></option>
                                <?php } ?>
                            </select>
                        </li>
                        <li style="width:30%;">
                            <select name="self-yy" name="self-yy">
                                <option class="">Year</option>
                                <option class="1950">1950</option>
                                <option class="1950">1950</option>
                            </select>
                        </li>
                    
                </ul>
            </div>
        </div>
        <div class="col-md-4 col-sm-12 col-xs-12">
            <label style="color:#000">Relationship with Proposer</label>
            <div class="media-input-container">
                 <ul class="mediainput input-single input-single-select">
                    <li >
                        <select name="self-mstatus" name="self-mstatus">
                            <option class="">select</option>
                            <option class="single">Single</option>
                            <option class="married">Married</option>
                        </select>   
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-2 col-sm-12 col-xs-12">
            <label style="color:#000">Gender</label>
            <div class="media-input-container">
                 <ul class="mediainput input-single input-single-select" >
                    <li>
                        <select name="self-gender" name="self-gender">
                            <option class="">select</option>
                            <option class="Male">Male</option>
                            <option class="Female">Female</option>
                        </select>   
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-12 col-xs-12">
            <label style="color:#000">Height</label>
            <div class="media-input-container">
                 <ul class="mediainput input-multi" >
                  
                        <li style="width:48%;">
                            <select name="self-feet" name="self-feet" style="">
                                <option class="">Feet</option>
                                <<?php for($feet=0;$feet<=6;$feet++){ $_ft = ($feet<10)?"0".$feet:$feet;?>
                                <option class="<?=$_ft;?>"><?=$_ft." Feet";?></option>
                                <?php } ?>
                            </select>
                           
                        </li>
                        <li style="width:48%;border-left: 1px solid #ccc;">
                            <select name="self-inch" name="self-inch">
                                <option class="">Inch</option>
                                <?php for($inch=0;$inch<=11;$inch++){ $_no = ($inch<10)?"0".$inch:$inch;?>
                                <option class="<?=$_no;?>"><?=$_no." Inch";?></option>
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
                    <input type="text" name="self-weight" id="self-weight" class="form-control" placeholder="Enter weight">
                   </li>
                   <li style="width:8%;"><label>Kg</label></li>
                    
                </ul>
            </div>
        </div>
     </div>
</div> 