<!DOCTYPE html>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
     <title>Quote</title>
    <style type="text/css">
    	* {margin: 9;padding: 0;}
    
           
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
         .partnerlogo{
             width:100px;
         }
         
          .top-section {page-break-after: always;}
        
          .table2, .table2 th, .table2 td {
              border: 1px solid black;
              border-collapse: collapse;
              
          }
          .table2 th, .table2 td{
              font-size:13px;
              padding:2px 2px;
              text-align:center;
          }
          
          .table3, .table3 th, .table3 td {
              border: 1px solid #ccc;
              border-collapse: collapse;
              
          }
          .table3 th, .table3 td{
              font-size:13px;
              padding:2px 2px;
              text-align:center;
          }
          
       
 .feature-section {page-break-inside: avoid;}

    	</style>
    </head>
    <body>
        
        <div id="container"  class="top-section">
            <table class="table">
                <tr>
                    <td  style="width:50%;text-align:left;">
                        <img class="logo" src="{{$logo}}" alt="{{config('custom.site_name')}}" id="" />
                    </td>
                    <td  style="width:50%;text-align:right;">
                        <img class="partnerlogo" src="{{$partnerlogo}}" alt="{{config('custom.site_name')}}" id="" />
                    </td>
                </tr>
               
                <?php $heading = "Health";
                     
                    $params    = json_decode($enQ->params_request);
                    $sumInsureds    = json_decode($enQ->sumInsured);
                    $jsonData = json_decode($enQ->json_data);
                    $amounts = json_decode($enQ->amounts);
                    $termYear = $enQ->termYear;
                    $insm = $params->total_adult."-Adult ";
                    $insm = ($params->total_child>0)?$insm.$params->total_child."-Child":$insm;
                    
                    ?>
                <tr>
                    <td colspan="2" style="width:100%;font-size:14px;text-align:center;"><h3>{{$heading}} insurance Premium Break-up</h3></td>
                </tr>
                
                
                <tr>
                    <td colspan="2">
                        <table class="table2">
                            <tr>
                                @if($enQ->zone!="")
                                <td colspan="3" style="width:80%;border:1px solid;text-align:left;">
                                   Plan:{{$enQ->title}} ({{$partner->name}}) 
                                </td>
                                <td colspan="1" style="width:20%;border:1px solid;text-align:center;">
                                   Zone : {{$enQ->zone}}
                                </td>
                                @else
                                 <td colspan="4" style="width:100%;border:1px solid;text-align:left;">
                                   Plan:{{$enQ->title}} ({{$partner->name}}) 
                                </td>
                                @endif
                              
                            </tr>
                            <tr>
                              <td>Quote ID</td>
                              <td>{{$enQ->SFQuoteId}}</td>
                              <td>Quote Generated Date</td>
                              <td>{{$QuoteDate}}</td>
                            </tr>
                            <tr>
                              <td>Cover Sum Insured</td>
                              <td>{{$sumInsureds->shortAmt}} Lakh</td>
                              <td>Cover Type</td>
                              <td>@if($enQ->policyType=="FL")
                                          Floater 
                                   @elseif($enQ->policyType=="IN")
                                        Individual 
                                    @endif</td>
                            </tr>
                             <tr>
                              <td>Policy Period</td>
                              <td>{{$termYear}} Year</td>
                              <td>Insured Members</td>
                              <td>{{$insm}}</td>
                            </tr>
                        </table>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <table class="table3">
                             <tr style="background:#ccc">
                               <th  colspan="3" style="width:100%;text-align:left;">Proposer Details</th>
                            </tr>
                            <tr style="background:#cccccc45">
                               <th style="color:#000;width:33.33%;text-align:center;">Name</th>
                               <th style="width:33.33%;color:#000;text-align:center;">Mobile</th>
                               <th style="width:33.33%;color:#000;text-align:center;">Email</th>
                            </tr>
                            <tr>
                               <td  style="width:33.33%;text-align:center;">{{$params->selfFname}} {{$params->selfLname}}</td>
                               <td style="width:33.33%;text-align:center;">{{$params->selfMobile}}</td>
                               <td style="width:33.33%;text-align:center;">{{$params->selfEmail}}</td>
                            </tr>
                            <tr style="background:#cccccc45">
                               <th style="color:#000;width:33.33%;text-align:center;">City</th>
                               <th style="width:33.33%;color:#000;text-align:center;">State</th>
                               <th style="width:33.33%;color:#000;text-align:center;">Pincode</th>
                            </tr>
                            <tr style="">
                               <td style="width:33.33%;text-align:center;"><?=explode('-',$params->city)[1];?></td>
                               <td style="width:33.33%;text-align:center;"><?=explode('-',$params->state)[1];?></td>
                               <td style="width:33.33%;text-align:center;">{{$params->pincode}}</td>
                            </tr>
                            <tr>
                                <td colspan="3">&nbsp;</td>
                            </tr>
                            <tr style="background:#ccc">
                               <th  colspan="3" style="width:100%;text-align:left;">Insured Members</th>
                              
                            </tr>
                            
                            <tr style="background:#656666">
                               <th colspan="2" style="color:#fff;width:60%;text-align:left;">Insured</th>
                               <th style="width:40%;color:#fff;text-align:right;">Age</th>
                               
                            </tr>
                            @foreach($params->members as $mem)
                            <tr style="background:#e8e8e8">
                               <td colspan="2" style="width:60%;text-align:left;">{{ucfirst($mem->type)}} @if($mem->type=="self")(Proposer)@endif</td>
                               <td style="width:40%;text-align:right;">{{$mem->age}} Years</td>
                            </tr>
                            @endforeach
                            
                            <tr>
                                <td colspan="3">&nbsp;</td>
                            </tr>
                            <tr style="background:#ccc">
                               <th  colspan="2" style="width:75%;text-align:left;">Premium Break-up</th>
                               <th style="width:25%;text-align:right;"></th>
                            </tr>
                               @if($amounts->{$termYear}->Addons)
                                <tr style="background:#656666">
                                   <th colspan="2" style="color:#fff;width:60%;text-align:left;">Coverage Name</th>
                                   <th style="width:40%;color:#fff;text-align:right;">Premium Amount</th>
                                </tr>
                               
                               @foreach($amounts->{$termYear}->Addons as $addon)
                              
                                    <tr style="background:#e8e8e8">
                                       <td colspan="2" style="width:60%;text-align:left;">{{$addon->title}} [Addon]</td>
                                       <td style="width:40%;text-align:right;">₹{{number_format((float)$addon->premium, 2, '.', '')}}</td>
                                    </tr>
                                    
                                 @endforeach
                          @endif 
                            
                            <tr>
                                <th colspan="2" style="width:50%;text-align:left;">Base Premium</th>
                                <th style="width:50%;text-align:right;">₹{{number_format((float)$amounts->{$termYear}->Base_Premium, 2, '.', '')}}</th>
                            </tr>
                            <tr>
                                <th colspan="2" style="width:50%;text-align:left;">Goods and Service Tax</th>
                                <th style="width:50%;text-align:right;">₹{{number_format((float)$amounts->{$termYear}->Total_Tax, 2, '.', '')}}</th>
                            </tr>
                            <tr>
                                <th colspan="2" style="width:50%;text-align:left;">Total Payble Premium</th>
                                <th style="width:50%;text-align:right;">₹{{number_format((float)$amounts->{$termYear}->Total_Premium, 2, '.', '')}}</th>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr><th colspan="2" >This quote is valid till 7 days from the date of quote issued</th></tr>
                <tr>
                    <td colspan="2" style="text-align:center;border-top:1px solid" >
                        <p style="font-size:12px;margin:0;">
                            Super Finserv Private Limited
                        </p>
                         <p style="font-size:12px;margin:0;">Office No. 31, Third Floor, Mahima's Triniti, Plot No-5, Swej Farm,  Jaipur, Rajasthan 302019</p>
                         <p  style="font-size:12px;margin:0;">IRDAI CORPORATE AGENCY REGISTRATION NUMBER: {{config('custom.irda_reg_no')}} | VALID TILL:{{config('custom.irda_valid_till')}}</p>
                         <p style="font-size:12px;margin:0;">Email: {{config('custom.contact_email')}} | Website : www.superfinserv.com | CIN: {{config('custom.corporate_identity_no')}}</p>
                         <p style="font-size:12px;margin:0;">
                            Phone: +91-141-4919086
                        </p>
                    </td>
                    
                </tr>
               
            </table>
        </div>
        
         <div id="container" class="feature-section">
            <table class="table">
                <tr>
                    <td colspan="2" style="width:100%;font-size:14px;text-align:center;"><h3>{{$enQ->title}} ({{$partner->name}}) </h3></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <table class="table3">
                             <tr style="background:#ccc">
                               <th  colspan="2" style="width:100%;text-align:center;">Features</th>
                            </tr>
                            @foreach($features as $row)
                            <tr>
                               <th style="background:#cccccc45;color:#000;width:33.33%;text-align:center;">{{$row->_key}}</th>
                               <td style="width:33.33%;color:#000;text-align:center;">{{$row->_val}}</td>
                              </tr>
                            @endforeach
                        </table>
                     </td>
                </tr>
             </table>
        </div>
    </body>
</html>