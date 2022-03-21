<!DOCTYPE html>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
     <title>Document</title>
    <style type="text/css">
    	* {margin: 10;padding: 0;}
    
           
        	/*::selection{ background-color: #E13300; color: white; }*/
        	/*::moz-selection{ background-color: #E13300; color: white; }*/
        	/*::webkit-selection{ background-color: #E13300; color: white; }*/
        
        	body {
        	   background-color: #fff;
        	   font-family: DejaVu Sans;
        	}
            table{
               border-collapse: collapse;
               width:100%;
               color:#000;
               font-family: DejaVu Sans;
            }
         
         
         .logo{
             width:310px;
         }
         
          /*.top-section {page-break-after: always;}*/
        

    	</style>
    </head>
    <body>
        <?php
        $param=json_decode($sale->params);
        ?>
        <div id="container"  class="top-section">
            <table class="table">
                <tr>
                    <td colspan="2" style="width:100%;text-align:center;"><img class="logo" src="{{$logo}}" alt="Super Finserv" id="" /></td>
                    <!--<td style="width:50%"></td>-->
                </tr>
               
                <tr>
                    <td colspan="2" style="width:100%;font-size:14px;text-align:center;"><h3>Your Policy No:{{$sale->policy_no}}</h3></td>
                </tr>
                <tr>
                    <td colspan="2" style="width:100%;font-size:14px;text-align:center;"><h3>Provided your required details to get insured</h3></td>
                </tr>
                
               <tr>
                    <td colspan="2" style="width:100%;border-top:1px solid"></td>
                </tr>
                
                <tr>  
                     <td colspan="2"  style="width:100%;padding:0px;">
                        <table style="border-collapse: collapse;">
                            <tr>
                                
                                <td style="width:90%;padding:0px;">
                                    <table style="border-collapse: collapse;">
                                        <tr><th colspan="3" 
                                                style="padding:2px 8px;color:#fff;width:100%;text-align:left;verticle-align:top;background-color:#AC0F0B">Proposer Information </th></tr>
                                        <tr>
                                            <th style="font-size:13px;width:40%;padding:1px 0px;border: 1px solid black;text-align:center;">Name</th>
                                            <th style="font-size:13px;width:40%;padding:1px 0px;border: 1px solid black;text-align:center;">Mobile</th>
                                            <th style="font-size:13px;width:40%;padding:1px 0px;border: 1px solid black;text-align:center;">Email</th>
                                        </tr>
                                        <tr>
                                            <td  style="font-size:13px;width:60%;border: 1px solid black;text-align:center;">{{$param->selfName}}</td>
                                            <td  style="font-size:13px;width:60%;border: 1px solid black;text-align:center;">+91 {{$param->selfMobile}}</td>
                                            <td  style="font-size:13px;width:60%;border: 1px solid black;text-align:center;">{{$param->selfEmail}}</td>
                                        </tr>
                                        
                                        <tr>
                                            <th style="font-size:13px;width:40%;padding:1px 0px;border: 1px solid black;text-align:center;">Gender </th>
                                            <th style="font-size:13px;width:40%;padding:1px 0px;border: 1px solid black;text-align:center;">Weight</th>
                                            <th style="font-size:13px;width:40%;padding:1px 0px;border: 1px solid black;text-align:center;">Height</th>
                                        </tr>
                                        <tr>
                                            <td  style="font-size:13px;width:60%;border: 1px solid black;text-align:center;">{{$param->gender}}</td>
                                            <td  style="font-size:13px;width:60%;border: 1px solid black;text-align:center;">{{$param->selfWeight}} kg</td>
                                            <td  style="font-size:13px;width:60%;border: 1px solid black;text-align:center;">{{$param->selfFeet}}Feet {{$param->selfInch}}Inch</td>
                                        </tr>
                                        <tr>
                                            <th style="font-size:13px;width:40%;padding:1px 0px;border: 1px solid black;text-align:center;">Marital status </th>
                                            <th colspan="2" style="font-size:13px;width:40%;padding:1px 0px;border: 1px solid black;text-align:center;">Address </th>
                                        </tr>
                                        <tr>
                                             <td style="font-size:13px;width:60%;border: 1px solid black;text-align:center;">{{$param->selfMstatus}}</td>
                                             <?php  $state= explode('-',$param->address->state);$city= explode('-',$param->address->city);?>
                                            <td colspan="2" style="font-size:13px;width:60%;border: 1px solid black;text-align:center;">{{$param->address->house_no}},{{$param->address->street}},{{$city[1]}},{{$state[1]}}-{{$param->address->pincode}}</td>
                                        </tr>
                                        
                                        
                                        
                                    </table>
                                </td>
                            </tr>
                        </table>
                     </td>
                    
                    
                </tr>
                
                <tr>  
                     <td colspan="2"  style="width:100%;padding:0px;">
                        <table style="border-collapse: collapse;">
                            <tr><th style="padding:2px 8px;color:#fff;width:100%;text-align:left;verticle-align:top;background-color:#AC0F0B">Insured members </th></tr>
                            <tr>
                                <td style="width:90%;padding:0px;">
                                    @foreach($param->members as $ins=>$insurer)
                                     <table style="border-collapse: collapse;">
                                        
                                        <tr>
                                            <th style="font-size:13px;width:40%;padding:1px 0px;border: 1px solid black;text-align:center;">Name</th>
                                            <th style="font-size:13px;width:40%;padding:1px 0px;border: 1px solid black;text-align:center;">Date of birth</th>
                                            <th style="font-size:13px;width:40%;padding:1px 0px;border: 1px solid black;text-align:center;">Gender</th>
                                        </tr>
                                        <tr>
                                            <td  style="font-size:13px;width:60%;border: 1px solid black;text-align:center;">
                                                   <?=($insurer->type=="self")?$param->selfName."(You)":$insurer->fname." ".$insurer->lname."(".ucfirst($insurer->type).")";?>
                                            </td>
                                            <td  style="font-size:13px;width:60%;border: 1px solid black;text-align:center;">
                                                 <?=($insurer->type=="self")?$param->selfdd."/".$param->selfmm."/".$param->selfyy:$insurer->dd."/".$insurer->mm."/".$insurer->yy;?>
                                            </td>
                                            <td  style="font-size:13px;width:60%;border: 1px solid black;text-align:center;">
                                                <?=($insurer->type=="self")?$param->gender:$insurer->gender;?>
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <th style="font-size:13px;width:40%;padding:1px 0px;border: 1px solid black;text-align:center;">Height </th>
                                            <th style="font-size:13px;width:40%;padding:1px 0px;border: 1px solid black;text-align:center;">Weight</th>
                                            <th style="font-size:13px;width:40%;padding:1px 0px;border: 1px solid black;text-align:center;">Relation with Nominee</th>
                                        </tr>
                                        <tr>
                                            <td  style="font-size:13px;width:60%;border: 1px solid black;text-align:center;">
                                                 <?=($insurer->type=="self")?$param->selfFeet." ft ".$param->selfInch." inch":$insurer->feet."ft ".$insurer->inch." inch";?>
                                            </td>
                                            <td  style="font-size:13px;width:60%;border: 1px solid black;text-align:center;">
                                                <?=($insurer->type=="self")?$param->selfWeight:$insurer->weight;?> Kg
                                            </td>
                                            <td  style="font-size:13px;width:60%;border: 1px solid black;text-align:center;">
                                                 <?php /*($insurer->type=="self")?str_replace("_"," ",$param->nomineerelation):str_replace("_"," ",$insurer->relation); */?>
                                            </td>
                                        </tr>
                                    </table>
                                    @endforeach
                                    
                                    
                                </td>
                            </tr>
                        </table>
                     </td>
                    
                    
                </tr>
                
                <tr>  
                     <td colspan="2"  style="width:100%;padding:0px;">
                        <table style="border-collapse: collapse;">
                            <tr>
                                
                                <td style="width:90%;padding:0px;">
                                    <table style="border-collapse: collapse;">
                                        <tr><th colspan="3" 
                                                style="padding:2px 8px;color:#fff;width:100%;text-align:left;verticle-align:top;background-color:#AC0F0B">Nominee & Document Information </th></tr>
                                        <tr>
                                            <th style="font-size:13px;width:40%;padding:1px 0px;border: 1px solid black;text-align:center;">Nominee Name</th>
                                            <th style="font-size:13px;width:40%;padding:1px 0px;border: 1px solid black;text-align:center;">Nominee Relation with Proposer</th>
                                            <th style="font-size:13px;width:40%;padding:1px 0px;border: 1px solid black;text-align:center;">Nominee DOB</th>
                                        </tr>
                                        <tr>
                                            <td  style="font-size:13px;width:60%;border: 1px solid black;text-align:center;"><?=isset($param->nomineename)?$param->nomineename:"";?></td>
                                            <td  style="font-size:13px;width:60%;border: 1px solid black;text-align:center;"><?=isset($param->nomineerelation)?$param->nomineerelation:"";?></td>
                                            <td  style="font-size:13px;width:60%;border: 1px solid black;text-align:center;"><?=($param->nomineedd && $param->nomineemm && $param->nomineeyy)?($param->nomineedd."/".$param->nomineemm."/".$param->nomineeyy):"";?></td>
                                        </tr>
                                        
                                        <tr>
                                            <th style="font-size:13px;width:40%;padding:1px 0px;border: 1px solid black;text-align:center;">Document Type </th>
                                            <th style="font-size:13px;width:40%;padding:1px 0px;border: 1px solid black;text-align:center;">Document ID</th>
                                            <th style="font-size:13px;width:40%;padding:1px 0px;border: 1px solid black;text-align:center;">Document issue Date</th>
                                        </tr>
                                        <tr>
                                            <td  style="font-size:13px;width:60%;border: 1px solid black;text-align:center;"><?=isset($param->document->documentType)?str_replace("_"," ",$param->document->documentType):"";?></td>
                                            <td  style="font-size:13px;width:60%;border: 1px solid black;text-align:center;"><?=isset($param->document->documentId)?$param->document->documentId:"";?></td>
                                            <td  style="font-size:13px;width:60%;border: 1px solid black;text-align:center;"><?=isset($param->document->documentdd)?$param->document->documentdd.'/'.$param->document->documentmm.'/'.$param->document->documentyy:"";?></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                     </td>
                    
                    
                </tr>
                <tr>  
                     <td colspan="2"  style="width:100%;padding:0px;">
                        <table style="border-collapse: collapse;">
                            <tr><th style="padding:2px 8px;color:#fff;width:100%;text-align:left;verticle-align:top;background-color:#AC0F0B">Medical history </th></tr>
                            <?php if($param->hasMedical=="YES"){ ?>
                            <tr>
                                <td style="width:90%;padding:0px;">
                                    @foreach($param->members as $m=>$mem)
                                     <?php if(isset($mem->medical)){
                                                if(!empty($mem->medical)){ ?>
                                                 <table style="border-collapse: collapse;">
                                                    <tr><td style="font-size:13px;width:60%;border: 1px solid black;text-align:left;" colspan="3"><?=($mem->type=="self")?$param->selfName:$mem->fname." ".$mem->lname;?></td></tr>
                                                    <?php foreach($mem->medical as $q){?>
                                                    <tr>
                                                        <th colspan="3" style="font-size:13px;width:40%;padding:1px 0px;border: 1px solid black;text-align:left;"><?=$q->title;?></th>
                                                    </tr>
                                                    <?php if($q->hasChildQuestions && !empty($q->childQuestions)){ 
                                                            foreach($q->childQuestions as $chQ){ ?>
                                                                <tr>
                                                                    <td colspan="2" style="font-size:13px;width:60%;border: 1px solid black;text-align:left;">{{$chQ->title}}</td>
                                                                    <td  style="font-size:13px;width:60%;border: 1px solid black;text-align:left;">{{$chQ->answer}}</td>
                                                                </tr>
                                                           <?php } ?>
                                                     <?php } ?>
                                                    <?php } ?>
                                                    
                                                </table>
                                          <?php } 
                                        } ?>
                                    @endforeach
                                    
                                    
                                </td>
                            </tr>
                            <?php }else{?>
                                <tr><td style="padding:2px 8px;color:#fff;width:100%;text-align:center;verticle-align:top;">No Medical illness selected</td></tr>
                            <?php } ?>
                        </table>
                     </td>
                    
                    
                </tr>
                <tr>
                    <td colspan="2" style="text-align:center;border-top:1px solid" >
                         <p style="font-size:12px;margin:0;">{{get_site_settings('contact_address')}}</p>
                         <p style="font-size:12px;margin:0;">Email: {{get_site_settings('contact_email')}} | Website : www.superfinserv.in | CIN: {{get_site_settings('corporate_identity_no')}}</p>
                    </td>
                    
                </tr>
               
            </table>
        </div>
        
    </body>
</html>