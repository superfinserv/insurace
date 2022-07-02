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
         
          /*.top-section {page-break-after: always;}*/
        
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
               
                <?php $heading = ($enQ->type=="BIKE")?"Two-wheeler":"Car";
                     
                    $param    = json_decode($enQ->params_request);
                    $jsonData = json_decode($enQ->json_data);
                    $vehicleNumber = ($param->vehicle->hasvehicleNumber=="true")?$param->vehicle->vehicleNumber:$param->vehicle->rtoCode;?>
                <tr>
                    <td colspan="2" style="width:100%;font-size:14px;text-align:center;"><h3>{{$heading}} insurance Premium Break-up</h3></td>
                </tr>
                
                
                <tr>
                    <td colspan="2">
                        <table class="table2">
                            <tr>
                               <td colspan="4" style="width:100%;border:1px solid;text-align:left;">Model:{{$param->vehicle->brand->name}} {{$param->vehicle->model->name}} {{$param->vehicle->varient->name}}</td>
                            </tr>
                            <tr>
                              <td>Quote ID</td>
                              <td>{{$enQ->SFQuoteId}}</td>
                              <td>Quote Generated Date</td>
                              <td>{{$QuoteDate}}</td>
                            </tr>
                            <tr>
                              <td>Insured Declared Value(IDV)</td>
                              <td>{{$enQ->idv}}</td>
                              <td>Registration Month & Year</td>
                              <td>{{$RegDate}}</td>
                            </tr>
                             <tr>
                              <td>Cubic Capacity</td>
                              <td>{{$param->vehicle->cc}}cc</td>
                              <td>Fuel Type</td>
                              <td>{{$param->vehicle->fueltype}}</td>
                            </tr>
                            <tr>
                              <td>Cover Type</td>
                              <td> @if($enQ->policyType=="COM")
                                          Comprehensive 
                                     @elseif($enQ->policyType=="TP")
                                        Third Party
                                      @elseif($enQ->policyType=="SAOD")
                                       Standalone Own Damage
                                     @endif</td>
                               <td>Registration No</td>
                              <td>{{$vehicleNumber}}</td>
                            </tr>
                             
                            
                            
                        </table>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <table class="table3">
                            <tr style="background:#ccc">
                               <th  colspan="2" style="width:75%;text-align:left;">Own Damage Premium</th>
                               <th style="width:25%;text-align:right;">₹{{$jsonData->covers->od->grossAmt}}</th>
                            </tr>
                            
                            <tr style="background:#656666">
                               <th style="color:#fff;width:50%;text-align:left;">Coverage Name</th>
                               <th style="width:20%;color:#fff;text-align:right;">Insured Value</th>
                               <th style="width:20%;color:#fff;text-align:right;">Premium Amount</th>
                            </tr>
                            @foreach($jsonData->covers->addons as $adon)
                            <tr style="background:#e8e8e8">
                               <td style="width:60%;text-align:left;">{{$adon->title}}</td>
                               <td style="width:20%;text-align:right;">-</td>
                               <td style="width:20%;text-align:right;">₹{{$adon->grossAmt}}</td>
                            </tr>
                            @endforeach
                            
                            <tr>
                                <td colspan="3">&nbsp;</td>
                            </tr>
                            <tr style="background:#ccc">
                               <th  colspan="2" style="width:75%;text-align:left;">Liability Premium</th>
                               <th style="width:25%;text-align:right;">₹{{$jsonData->covers->tp->grossAmt}}</th>
                            </tr>
                         
                                <tr style="background:#656666">
                                   <th style="color:#fff;width:50%;text-align:left;">Coverage Name</th>
                                   <th style="width:20%;color:#fff;text-align:right;">Insured Value</th>
                                   <th style="width:20%;color:#fff;text-align:right;">Premium Amount</th>
                                </tr>
                               
                               @foreach($jsonData->covers as $key=>$cover){
                               @if($key!="addons" && $key!="tp" && $key!="od" && $cover->selection===true){?>
                                    <tr style="background:#e8e8e8">
                                       <td style="width:60%;text-align:left;">{{$cover->title}}</td>
                                       <td style="width:20%;text-align:right;"></td>
                                       <td style="width:20%;text-align:right;">₹{{$cover->grossAmt}}</td>
                                    </tr>
                                     @endif
                            @endforeach
                           
                            
                            <tr>
                                <th colspan="2" style="width:50%;text-align:left;">Net Premium</th>
                                <th style="width:50%;text-align:right;">₹{{$enQ->netAmt}}</th>
                            </tr>
                            <tr>
                                <th colspan="2" style="width:50%;text-align:left;">Goods and Service Tax</th>
                                <th style="width:50%;text-align:right;">₹{{$enQ->taxAmt}}</th>
                            </tr>
                            <tr>
                                <th colspan="2" style="width:50%;text-align:left;">Total Payble Premium</th>
                                <th style="width:50%;text-align:right;">₹{{$enQ->grossAmt}}</th>
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
        
    </body>
</html>