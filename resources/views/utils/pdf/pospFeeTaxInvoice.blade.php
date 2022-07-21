<!DOCTYPE html>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
     <title>Fee Tax Invoice</title>
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
             width:210px;
         }
         .sign{
             width:100px;
         }
         
          .top-section {page-break-after: always;}
        

    	</style>
    </head>
<body>
    <?php  $date= date("d/m/Y", strtotime($pay->transaction_date));?>
    <div id="container" >
        <table class="table">
            <tr>
              <td colspan="2" style="width:100%;text-align:center;background:#ddd;margin-bottom:10px;"><h4>Tax <span style="padding:0px;margin:0px;color: #AC0F0B;">Invoice</span></h4></td>
            </tr>
            <tr>
               <td style="width:30%"><img class="logo" src="{{$logo}}" alt="Super Finserv Private Limited" id="" /></td>
               <td style="width:70%;text-align:right;">
                   <h5 style="margin:0;font-size:12px;">Super Finserv Private Limited</h5>
                   <p style="margin:0;font-size:12px;">Office No. 31,3rd Floor, Mahima Triniti, Swej Farm, Sodala</p>
                   <p style="margin:0;font-size:12px;">Jaipur (Raj) 302020</p>
                   <p style="margin:0;font-size:12px;">Ph: 0141-4919086</p>
                   <p style="margin:0;font-size:12px;">Email: care@superfinserv.com</p>
            </td>
                    
            </tr>
            <tr>
              <td style="width:70%;text-align:left;">
                  <h5 style="margin:0">{{$user->name}}</h5>
                  <p style="margin:0;font-size:11px;">{{$user->address}}</p>
                  <p style="margin:0;font-size:12px;">{{$user_city}} ({{$user_state}}) {{$user->pincode}}</p>
                  <p style="margin:0;font-size:12px;">+91 {{$user->mobile}}</p>
                  <p style="margin:0;font-size:12px;">{{$user->email}}</p>
              </td>
              <td style="width:30%;text-align:left;padding-left:120px;">
                  <h5 style="margin:0;">Invoice No.:{{str_replace("/","",$pay->invoice_no)}}</h5>
                  <p style="margin:0;font-size:12px;">Date:{{$date}}</p>
                  <p style="margin:0;font-size:12px;">CIN:{{get_site_settings('corporate_identity_no')}}</p>
                  <p style="margin:0;font-size:12px;">GSTIN:{{get_site_settings('gstin_no')}}</p>
                  <p style="margin:0;font-size:12px;">PAN:{{get_site_settings('pan_no')}}</p>
                  <!--<p style="margin:0;font-size:12px;">Reference:CAO-56756</p>-->
              </td>
            </tr>
            <tr>
                <td colspan="2" style="width:100%;padding:0px;">
                    <table  style="border-collapse: collapse;;padding:0px;;margin:0px;margin-top:20px;">
                        <thead>
                           <tr>
                               <th style="padding:5px;background:#ccc;width:50%;text-align:left;font-size:14px;border: 1px solid black;">Invoice description </th>
                               <th style="padding:5px;background:#ccc;width:25%;text-align:center;font-size:14px;border: 1px solid black;">SAC</th>
                               <th style="padding:5px;background:#ccc;width:25%;text-align:center;font-size:14px;border: 1px solid black;">Amount (in INR)</th>
                           </tr> 
                        </thead>
                        <tbody>
                            <tr>
                                <td style="padding:5px;font-size:12px;text-align:left;border: 1px solid black;">POSP- Life & General Insurance Application & Training Fee</td>
                                <td style="padding:5px;font-size:12px;text-align:center;border: 1px solid black;">999293</td>
                                <td style="padding:5px;font-size:12px;text-align:center;border: 1px solid black;">{{$fee_payment}}</td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding:5px;font-size:12px;text-align:right;border-left:1px solid black;border-left:1px solid black;">IGST(0.00%)</td>
                                <td style="padding:5px;font-size:12px;text-align:center;border-right:1px solid black;border-left:1px solid black;">{{$igst}}</td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding:5px;font-size:12px;text-align:right;border-left:1px solid black;">CGST(0.00%)</td>
                                <td style="padding:5px;font-size:12px;text-align:center;border-right:1px solid black;border-left:1px solid black;">{{$cgst}}</td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding:5px;font-size:12px;text-align:right;border-left:1px solid black;">SGST(0.00%)</td>
                                <td style="padding:5px;font-size:12px;text-align:center;border-right:1px solid black;border-left:1px solid black;">{{$sgst}}</td>
                            </tr>
                            <tr>
                                <th colspan="2" style="padding:5px;font-size:12px;text-align:right;border: 1px solid black;">Total Amount (in Words) : Rs. {{convertToIndianCurrency($payble)}}.</th>
                                <th style="padding:5px;font-size:12px;text-align:center;border-right:1px solid black;border: 1px solid black;">{{$total}}</th>
                            </tr>
                            <tr>
                                <td colspan="3" style="margin:0;padding:2px;font-size:12px;border-right: 1px solid black;border-left:1px solid black;">GST payable under Reverse charge :<strong> No</strong></td>
                            </tr>
                            <tr>
                                <td colspan="3" style="margin:0;padding:2px;font-size:12px;border-right: 1px solid black;border-left:1px solid black;">If yes, amount of GST payable :<strong> -</strong></td>
                            </tr>
                            <tr>
                                <td colspan="3" style="margin:0;padding:2px;font-size:10px;border-right: 1px solid black;border-left:1px solid black;border-bottom:1px solid black;">
                                    Note : Company Bank Details: AXIS BANK LTD. SWEJ FARM JAIPUR (RAJ.) A/C NO 917020066273689 IFSC CODE:UTIB0002582
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="width:100%;padding:0px;">
                    <table  style="border-collapse: collapse;;padding:0px;;margin:0px;margin-top:20px;">
                        <tr>
                            <td style="width:50%">
                                <p style="margin:0;font-size:12px;">Place of Supply : Rajasthan</p>
                                <p style="margin:0;font-size:12px;">Subject to Local Jurisdiction only</p>
                            </td>
                            <td style="width:50%;border:1px solid;text-align:center;vertical-align: bottom;padding-top:0px;padding-bottom:10px;">
                                <img class="sign" src="{{$sign}}" alt="Super Finserv Private Limited" id="" />
                                <p style="margin:0;font-size:12px;vertical-align: bottom;">For Super Finserv Private Limited</p>
                            </td>
                        </tr>
                        
                    </table>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>