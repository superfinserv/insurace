<!DOCTYPE html>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
      	<title>Invoice</title>
    	
    	<style type="text/css">
    	* { 
        	 	margin: 10; 
        	 	padding: 0;

           }
           
    	/*@font-face {*/
     /*           font-family: 'CalibriRegular';*/
     /*           src: url('https://insurance.supersolutions.in/agent/fonts/calibri/Calibri Regular.ttf') format("truetype");*/
     /*           font-style: normal;*/
     /*           font-weight: normal;*/
     /*        }*/
     
             /*@font-face {*/
             /*       font-family: "cedarville-font-family";*/
             /*       src: url("https://insurance.supersolutions.in/agent/fonts/OpenSansCondensed-Light.ttf");*/
             /*       font-weight: normal;*/
             /*   }*/
           
        	::selection{ background-color: #E13300; color: white; }
        	::moz-selection{ background-color: #E13300; color: white; }
        	::webkit-selection{ background-color: #E13300; color: white; }
        
        	body {
        		background-color: #fff;
        	/*font-family: "cedarville-font-family";*/
        	font-family: DejaVu Sans;
        		
        	}
            table{
               border-collapse: collapse;
               width:100%;
               color:#000;
               font-family: DejaVu Sans;
            }
            /*table tbody tr td,table tbody tr th{  font-family: "cedarville-font-family";}*/
            #container{
        		border: 1px solid #D0D0D0;
        	}
        	#pic {     
		
	        width: 130px;
    height: 150px;
    border: 1px solid #000;
    border-radius:5px;
    padding: 2px;
	   
	}
    	</style>
    </head>
    <body>
        <?php $name=$user->name;$adhaar_card_number=$user->adhaar_card_number;?>
        <div id="container">
            <table class="table">
                <tr>
                    <td style="width:20%;font-size:12px;vertical-align:bottom"><b>CIN:</b>U74999RJ2017PTC058858</td>
                    <th style="width:60%;text-align:center;"> <img class="fn" src="{{$logo}}" alt="SUPER SOLUTIONS" id="" ></th>
                    <th style="width:25%"></th>
                </tr>
                <tr>
                    
                    <td colspan="3" style="text-align:center;"><p style="font-size:13px;"><b>REGISTERED OFFICE:</b> 3F-22 Mahima’s Triniti, Plot No. 5, Swej Farm, New Sanganer Road, Sodala,<br/>
                          Jaipur, RAJASTHAN- 302019. &nbsp;&nbsp;&nbsp;Phone: +91-141-4919086 Email:<a href="#">care@supersolutions.in</a></p></td>
                    
                </tr>
                <tr>
                     <td colspan="2" style="width:75%;padding-bottom:20px;">
                          <table class="table">
                              <tr><td style="padding-bottom:25px;font-size:14px;">Date:<?php $date= date("dS M Y", strtotime($certification->created_at)); echo $date;?></td></tr>
                              <tr><td style="padding-bottom:12px;font-size:14px;">Mr./Ms:{{$name}}</td></tr>
                              <tr><td style="padding-bottom:8px;font-size:14px;">Address:{{$user->address}},<br/>
                                   {{$user_city}}-{{$user->pincode}} ({{$user_state}})</td></tr>
                              <tr><td style="font-size:13px;">Contact:{{$user->mobile}}</td></tr>
                          </table>
                     </td>
                    <td style="width:25%;padding-bottom:20px;">
                        	<img id="pic" src="{{$profile}}">
                    </td>
                </tr>
                
                <tr>
                    <td colspan="3" style="padding-bottom:13px;font-size:13px;">
                       <p>This is in with reference to your application requesting to enrol yourself as a<strong>Point of Sale Person</strong></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="padding-bottom:40px;font-size:16px;">
                        This is to confirm that you have successfully completed the prescribed training and have also passed
                        the examination specified for Point of Sales Examination conducted by Dream Weavers Edutrack Pvt.
                        Ltd. under the Guidelines on Point of Sales Person for Life, Non-life and Health insurers. Your personal
                        details are as under:  
                    </td>
                </tr>
                <tr><td colspan="3"  style="padding-bottom:12px;font-size:16px;"> PAN No:<b>{{$user->pan_card_number}}</b></td> </tr>
                <tr><td colspan="3"  style="padding-bottom:12px;font-size:16px;"> Aadhaar No: <b>{{$user->adhaar_card_number}}</b></td> </tr>
                <tr><td colspan="3"  style="padding-bottom:12px;font-size:16px;"> POSP Identification Number: <b><?=$user->posp_ID;?></b> </td> </tr>
                
                 <tr>
                     <td colspan="3"  style="padding-bottom:12px;font-size:16px;"> 
                     This letter authorizes you to act as Point of Sales Person for Supersolutions Advisory Services Pvt. Ltd.
                     to only market products categorized and identified under the Guidelines.
                     </td>
                </tr>
                 
                  <tr>
                      <td colspan="3"  style="padding-bottom:8px;font-size:16px;"> 
                         In case you wish to work with any other company, you are required to obtain a fresh letter from the
                         new insurer/ insurance intermediary in order to act as Point of Sales Person for that entity.
                      </td>
                 </tr>
                 <tr><td colspan="3" style="padding-bottom:8px;font-size:16px;">Your Truly </td> </tr>
                <tr><td colspan="3"  style="padding-bottom:8px;font-size:16px;"> Vipul Rawal </td> </tr>
                <tr><td colspan="3"  style="text-align:center;padding-bottom:8px;font-size:16px;">This is a system generated certificate, no signature required.</td> </tr>

            </table>
        </div>
    </body>
</html>