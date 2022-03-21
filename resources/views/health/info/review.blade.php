   
    <style>
      .reviewInfo-card .info-value{
            font-size: 14px;
            color: #000;
            } 
       .reviewInfo-card .info-label{
            font-size: 12px;
            color: #AC0F0B;
            font-weight: 600;
       } 
     .reviewInfo-card  .edit-link{
          float:right;
          color: #AC0F0B;
          font-size: 15px;
      }
      .reviewInfo-card .edit-link i{
          color: #AC0F0B;
          font-size: 15px;
      }
    </style>
   
<div class="row">
    <div class="col-md-12" style="margin-bottom: 10px;">
        <div class="card reviewInfo-card">
            <div class="card-header">Proposer Information
            <a href="#" class="edit-link btn-edit-link" data-step="proposerInfo"><i class="fa fa-edit"></i></a></div>
            <div class="card-body ">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <span class="info-label">Name</span>
                        <div  class="info-value"><?=isset($param->selfName)?$param->selfName:"";?></div>
                    </div>
                    <div class="col-12 col-md-4">
                        <span class="info-label">Gender</span>
                        <div  class="info-value"><?=isset($param->gender)?$param->gender:"";?></div>
                    </div>
                    <div class="col-12 col-md-4">
                        <span class="info-label">Height</span>
                        <div  class="info-value"><?=($param->selfFeet && $param->selfInch)?$param->selfFeet."ft ".$param->selfInch."inch":"";?></div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-12 col-md-4">
                        <span class="info-label">Weight</span>
                        <div  class="info-value"><?=isset($param->selfWeight)?$param->selfWeight:"";?> Kg</div>
                    </div>
                    <div class="col-12 col-md-4">
                        <span class="info-label">Mobile</span>
                        <div  class="info-value">(+91)<?=isset($param->selfMobile)?$param->selfMobile:"";?></div>
                    </div>
                    <div class="col-12 col-md-4">
                        <span class="info-label">Email</span>
                        <div  class="info-value"><?=isset($param->selfEmail)?$param->selfEmail:"";?></div>
                    </div>
                </div>
                
                 <div class="row">
                    <div class="col-12 citycol-md-12">
                        <span class="info-label">Address</span>
                        <?php $ct = explode("-",$param->address->city);
                              $st = explode("-",$param->address->state);
                              $address = $param->address->house_no.",".$param->address->street.",".$ct[1].",".$st[1].",".$param->address->pincode;
                              ?>
                        <div  class="info-value"><?=isset($param->address)?$address:"";?></div>
                    </div>
                </div>
                
                
            </div>
            <!--<div class="card-footer">Featured</div>-->
        </div>
    </div>
    
    <!-- insurer information -->
    <div class="col-md-12" style="margin-bottom: 10px;">
        <div class="card reviewInfo-card">
            <div class="card-header">Insured members
            <a href="#" class="edit-link btn-edit-link" data-step="insurerInfo"><i class="fa fa-edit"></i></a></div>
            <div class="card-body ">
                <?php $c = 1;foreach($param->members as $ins=>$insurer){ ?>
                <div class="row" style="">
                     <div class="col-12 col-md-12">
                         <span style="font-size: 14px;color: #000;font-weight: 600;"><?=($insurer->type=="self")?$param->selfName."(You)":$insurer->fname." ".$insurer->lname."(".ucfirst($insurer->type).")";?></span></div>
                    <div class="col-12 col-md-4">
                        <span class="info-label">Date of birth</span>
                        <div  class="info-value">
                            <?=($insurer->type=="self")?$param->selfdd."/".$param->selfmm."/".$param->selfyy:$insurer->dd."/".$insurer->mm."/".$insurer->yy;?>
                            </div>
                    </div>
                    <div class="col-12 col-md-4">
                        
                        <span class="info-label">Gender</span>
                        <div  class="info-value"><?=($insurer->type=="self")?$param->gender:$insurer->gender;?></div>
                    </div>
                    <div class="col-12 col-md-4">
                        <span class="info-label">Height</span>
                        <div  class="info-value">
                            <?=($insurer->type=="self")?$param->selfFeet." ft ".$param->selfInch." inch":$insurer->feet."ft ".$insurer->inch." inch";?>
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-4">
                        <span class="info-label">Weight</span>
                        <div  class="info-value">
                            <?=($insurer->type=="self")?$param->selfWeight:$insurer->weight;?> Kg
                            </div>
                    </div>
                    
                   <?php /* <div class="col-12 col-md-4">
                        <span class="info-label">Relation with Nominee</span>
                        <div  class="info-value">
                            <?=($insurer->type=="self")?str_replace("_"," ",$param->nomineerelation):str_replace("_"," ",$insurer->relation);?>
                            </div>
                    </div> */?>
                    
                    
                </div>
                 <?php  if($insurer->type!="self"){?>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <span class="info-label">Nominee Name</span>
                        <div  class="info-value">{{$param->selfFname}} {{$param->selfLname}}</div>
                    </div>
                    <div class="col-12 col-md-4">
                        <span class="info-label">Nominee DOB</span>
                        <div  class="info-value">{{$param->selfdd}}/{{$param->selfmm}}/{{$param->selfyy}}</div>
                    </div>
                    <div class="col-12 col-md-4">
                        <span class="info-label">Nominee Relation</span>
                        <div  class="info-value">
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
                        {{$r}}
                        </div>
                    </div>
                </div>
                <?php } ?>
                <?php } ?>
                
            
            </div>
            <!--<div class="card-footer">Featured</div>-->
        </div>
    </div>
    
    <!-- nominee Information & document Info -->
    <div class="col-md-12" style="margin-bottom: 10px;">
        <div class="card reviewInfo-card">
            <div class="card-header">Nominee & Document Information
            <!--<a href="#" class="edit-link btn-edit-link" data-step="proposerInfo"><i class="fa fa-edit"></i></a>-->
            </div>
            <div class="card-body ">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <span class="info-label">Nominee Name</span>
                        <div  class="info-value"><?=isset($param->nomineename)?$param->nomineename:"";?></div>
                    </div>
                    <div class="col-12 col-md-4">
                        <span class="info-label">Nominee Relation with Proposer</span>
                        <div  class="info-value"><?=isset($param->nomineerelation)?$param->nomineerelation:"";?></div>
                    </div>
                    <div class="col-12 col-md-4">
                        <span class="info-label">Nominee DOB</span>
                        <div  class="info-value"><?=($param->nomineedd && $param->nomineemm && $param->nomineeyy)?($param->nomineedd."/".$param->nomineemm."/".$param->nomineeyy):"";?></div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-12 col-md-4">
                        <span class="info-label">Document Type</span>
                        <div  class="info-value"><?=isset($param->document->documentType)?str_replace("_"," ",$param->document->documentType):"";?></div>
                    </div>
                    <div class="col-12 col-md-4">
                        <span class="info-label">Document ID</span>
                        <div  class="info-value"><?=isset($param->document->documentId)?$param->document->documentId:"";?></div>
                    </div>
                    <div class="col-12 col-md-4">
                        <span class="info-label">Document issue Date</span>
                        <div  class="info-value"><?=isset($param->document->documentdd)?$param->document->documentdd.'/'.$param->document->documentmm.'/'.$param->document->documentyy:"";?></div>
                    </div>
                </div>
            
                
                
            </div>
            <!--<div class="card-footer">Featured</div>-->
        </div>
    </div>
    
    <!-- Medical history -->
    <div class="col-md-12" style="margin-bottom: 10px;">
        <div class="card reviewInfo-card">
            <div class="card-header">Medical history
            <a href="#" class="edit-link btn-edit-link" data-step="medicalInfo"><i class="fa fa-edit"></i></a></div>
            <div class="card-body ">
                
                <?php if($param->hasMedical=="YES"){ ?>
                    <div class="row" style="border-bottom:1px solid #ccc;margin-bottom: 10px; padding-bottom: 10px;">
                        <?php  foreach($param->members as $m=>$mem){ ?>
                           <div class="col-12 col-md-6">
                               <span class="info-label"><?=($mem->type=="self")?$param->selfName:$mem->fname." ".$mem->lname;?></span>
                               </hr>
                              <?php if(isset($mem->medical)){
                                         if(!empty($mem->medical)){
                                           foreach($mem->medical as $q){?>
                                              <p style="margin:0;font-size: 14px;color: #000;font-weight: 600;"> <?=$q->title;?></p>
                                              <?php if($q->hasChildQuestions && !empty($q->childQuestions)){ 
                                                       foreach($q->childQuestions as $chQ){?>
                                                          <p style="font-size: 12px;margin:0;">{{$chQ->title}} : {{$chQ->answer}} </p>
                                                       <?php } // foreach child?>
                                              
                                              <?php } // if child que?>
                                        <?php } //foreach end
                                        } //!empty medical
                                   } //isset medical ?>
                           </div>
                        <?php }?>
                    </div>
                <?php }else{?>
                      <h4>No medical illness found!</h4>
                <?php }?>
                
                
            </div>
            <!--<div class="card-footer">Featured</div>-->
        </div>
    </div>
</div>