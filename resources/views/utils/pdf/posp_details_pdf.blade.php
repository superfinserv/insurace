<!DOCTYPE html>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
     <title>POSP Certificate</title>
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
        .profile-img{
            width: 150px;
            height:150px;
         }

    	</style>
    </head>
    <body>
        
        <!-- certificate top content-->
        <div id="container"  class="top-section">
            <table class="table">
                <tr>
                    <td colspan="2" style="width:100%;text-align:center;"><img class="logo" src="{{$logo}}" alt="SUPER SOLUTIONS" id="" /></td>
                    <!--<td style="width:50%"></td>-->
                </tr>
                <tr>
                    <td colspan="2" style="width:100%;font-size:14px;text-align:center;"><h3>POSP verified details</h3></td>
                </tr>
                <tr>
                    <td colspan="2" style="width:100%;border-top:1px solid"></td>
                </tr>
                
                <tr>  
                     <td colspan="2"  style="width:100%;padding:0px;">
                        <table style="border-collapse: collapse;">
                            <tr>
                                <td style="width:10%;border: 1px solid black;text-align:center;">
                                    <img class="profile-img" src="{{$profile}}" alt="{{$user->name}}" id=""/><br/>
                                    
                                </td>
                                <td style="width:90%;padding:0px;">
                                    <table style="border-collapse: collapse;">
                                        <tr><th colspan="2" style="padding:2px 8px;color:#fff;width:100%;text-align:left;verticle-align:top;background-color:#AC0F0B">Personal Details:({{$user->posp_ID}})</th></tr>
                                        <tr>
                                            <th style="font-size:13px;width:40%;padding:0px;border: 1px solid black;text-align:center;">Name</th>
                                            <td  style="font-size:13px;width:60%;border: 1px solid black;text-align:center;">{{$user->name}}</td>
                                        </tr>
                                        <tr>
                                            <th style="font-size:13px;width:40%;padding:0px;border: 1px solid black;text-align:center;">Mobile Number</th>
                                            <td  style="font-size:13px;width:60%;border: 1px solid black;text-align:center;">+91 {{$user->mobile}}</td>
                                        </tr>
                                        <tr>
                                            <th style="font-size:13px;width:40%;padding:0px;border: 1px solid black;text-align:center;">Email Address</th>
                                            <td  style="font-size:13px;width:60%;border: 1px solid black;text-align:center;">{{$user->email}}</td>
                                        </tr>
                                        <tr>
                                            <th style="font-size:13px;width:40%;padding:0px;border: 1px solid black;text-align:center;">Gender</th>
                                            <td  style="font-size:13px;width:60%;border: 1px solid black;text-align:center;">{{$user->sex}}</td>
                                        </tr>
                                        <tr>
                                            <th style="font-size:13px;width:40%;padding:0px;border: 1px solid black;text-align:center;">Merital Status</th>
                                            <td  style="font-size:13px;width:60%;border: 1px solid black;text-align:center;">{{$user->marital_status}}</td>
                                        </tr>
                                        <tr>
                                            <th style="font-size:13px;width:40%;padding:0px;border: 1px solid black;text-align:center;">Address</th>
                                            <td  style="font-size:13px;width:60%;border: 1px solid black;text-align:center;">{{$user->address}},{{$user_city}},{{$user_state}}-{{$user->pincode}}</td>
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
                            <tr><th colspan="2" style="padding:2px 8px;color:#fff;width:100%;text-align:left;verticle-align:top;background-color:#AC0F0B">Bank Details:</th></tr>
                            <tr>
                                <th style="font-size:13px;width:40%;padding:0px;border: 1px solid black;text-align:center;">Bank Name</th>
                                <td  style="font-size:13px;width:60%;border: 1px solid black;text-align:center;">{{$user->bank_name}}</td>
                            </tr>
                            <tr>
                                <th style="font-size:13px;width:40%;padding:0px;border: 1px solid black;text-align:center;">Account Holder Name</th>
                                <td  style="font-size:13px;width:60%;border: 1px solid black;text-align:center;">{{$user->account_holder_name}}</td>
                            </tr>
                            <tr>
                                <th style="font-size:13px;width:40%;padding:0px;border: 1px solid black;text-align:center;"> Account Number</th>
                                <td  style="font-size:13px;width:60%;border: 1px solid black;text-align:center;">{{$user->account_number}}</td>
                            </tr>
                            <tr>
                                <th style="font-size:13px;width:40%;padding:0px;border: 1px solid black;text-align:center;">IFSC</th>
                                <td  style="font-size:13px;width:60%;border: 1px solid black;text-align:center;">{{$user->ifsc_code}}</td>
                            </tr>
                            
                        </table>
                    </td>
                </tr>
                
                <tr>
                   <td colspan="2"  style="width:100%;padding:0px;">
                        <table style="border-collapse: collapse;">
                            <tr><th colspan="2" style="padding:2px 8px;color:#fff;width:100%;text-align:left;verticle-align:top;background-color:#AC0F0B">Education Details:</th></tr>
                            <tr>
                                <th style="font-size:13px;width:40%;padding:0px;border: 1px solid black;text-align:center;">Qualification</th>
                                <td  style="font-size:13px;width:60%;border: 1px solid black;text-align:center;">{{$user->educational_qualification}}</td>
                            </tr>
                            
                            
                        </table>
                    </td>
                </tr>
                <tr>
                   <td colspan="2"  style="width:100%;padding:0px;">
                        <table style="border-collapse: collapse;">
                            <tr><th colspan="2" style="padding:2px 0px;color:#fff;width:100%;text-align:left;verticle-align:top;background-color:#AC0F0B">Document Details:</th></tr>
                            <tr>
                                <th style="font-size:13px;width:40%;padding:0px;border: 1px solid black;text-align:center;">PAN card Number</th>
                                <td  style="font-size:13px;width:60%;border: 1px solid black;text-align:center;">{{$user->pan_card_number}}</td>
                            </tr>
                            <tr>
                                <th style="font-size:13px;width:40%;padding:0px;border: 1px solid black;text-align:center;">Aadhar Number</th>
                                <td  style="font-size:13px;width:60%;border: 1px solid black;text-align:center;"><?='XXXX-XXXX-'.substr($user->adhaar_card_number, -4);?></td>
                            </tr>
                            
                            
                        </table>
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2" style="width:100%;padding-bottom:310px;"></td>
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