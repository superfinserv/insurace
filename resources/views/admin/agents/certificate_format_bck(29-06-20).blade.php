<!DOCTYPE html>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
     <title>POP Certificate</title>
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
    	</style>
    </head>
    <body>
        <?php $name=$user->name;$adhaar_card_number=$user->adhaar_card_number;?>
        <div id="container">
            <table class="table">
                <tr>
                    <td style="width:50%"><img class="logo" src="{{$logo}}" alt="SUPER SOLUTIONS" id="" /></td>
                    <td style="width:50%"></td>
                </tr>
                <tr>
                    <th style="width:80%;padding-top:20px;font-size:13px;">MR./MS:{{$name}}</th>
                    <td style="width:20%;padding-top:20px;padding-right:20px;text-align:right;font-size:13px;">Date:<?php $date= date("d-m-Y", strtotime($certification->created_at)); echo $date;?></td>
                </tr>
                <tr>
                    <td style="width:60%;padding:0px;">
                        <table>
                            <tr>
                                <td style="font-size:13px;padding:0px;">{{$user->address}},<br/>
                                {{$user_city}}-{{$user->pincode}} {{$user_state}}</td>
                             </tr>
                             <tr><td style="padding-top:12px;font-size:13px;">{{$user->mobile}}</td> </tr>
                             <tr><td style="font-size:13px;">{{$user->email}}</td></tr>
                        </table>
                    </td>
                    <td style="width:20%;text-align:right;padding:0px;">
                        <img style="height:150px;width:150px;" src="{{$profile}}"/>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="padding-top:12px;font-size:15px;">This is in with reference to your application requesting to enrol yourself as a <b style="margin-left:0px;">Point of Sale Person.</b></td>
                </tr>
                <tr>
                    <td  colspan="2" style="padding-top:12px;font-size:15px;">
                        This is to confirm that you have successfully completed the prescribed training and have also passed
                        the examination specified for Point of Sales Examination conducted by Dream Weavers Edutrack Pvt.
                        Ltd. under the Guidelines on Point of Sales Person for Life, Non-life and Health insurers. Your personal
                        details are as under:  
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="padding-top:12px;font-size:15px;"><span>Aadhaar No : <b  style="margin-left:0px;"><?='XXXX-XXXX-'.substr($adhaar_card_number, -4);?></b></span> </td>
                </tr>
                <tr>
                    <td colspan="2" style="padding-top:10px;font-size:15px;"><span>PAN No:<b style="margin-left:0px;">{{$user->pan_card_number}}</b></span></td>
                </tr>
                <tr>
                    <td colspan="2" style="padding-top:10px;font-size:15px;"><span>POSP Identification Number: <b style="margin-left:0px;"><?=$user->posp_ID;?></b></span></td>
                </tr>
                 <tr>
                     <td colspan="2"  style="padding-top:18px;font-size:16px;"> 
                     This letter authorizes you to act as Point of Sales Person for Supersolutions Advisory Services Pvt. Ltd. to market products categorized and identified under 
                     the POSP Guidelines only.
                     </td>
                </tr>
                
                <tr>
                      <td colspan="3"  style="padding-top:18px;font-size:16px;"> 
                         In case you wish to work with any other company, you are required to obtain a fresh letter from the
                         new insurer/ insurance intermediary in order to act as Point of Sales Person for that entity.
                      </td>
                 </tr>
                <tr><td colspan="2" style="padding-top:15px;font-size:16px;">Your Truly </td> </tr>
                <tr><td colspan="2"  style="padding-top:15px;font-size:12px;"> Vipul Rawal </td> </tr>
                <tr>
                    <td colspan="2" style="text-align:center;padding-top:25px;" >
                         <p style="font-size:12px;margin:0;">3F-22, Mahima’s Triniti, Swej Farm, New Sanganer Road, Sodala, Jaipur - 302019 (Raj.)</p>
                         <p style="font-size:12px;margin:0;">Email: care@supersolutions.in | Website : www.insurance.supersolutions.in | CIN: U74999RJ2017PTC058858</p>
                    </td>
                    
                </tr>
                 <tr><td colspan="2" style="text-align:center;padding-top:20px;font-size:12px;">This is a system generated certificate, no signature required.</td> </tr>

            </table>
        </div>
    </body>
</html>