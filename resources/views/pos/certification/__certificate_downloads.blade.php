<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<style type="text/css">

 * { 
	 	margin: 0; 
	 	padding: 0;

 }
body { 
	     font: 16px Helvetica, Sans-Serif; 
	     line-height: 24px; 
	     background: url(images/noise.jpg); 
	 }
#page-wrap {
    width: 750px;
    margin: 40px auto 60px;
    padding-right: 20px;
    padding-left: 20px;
}
#pic {     
		
	       width: 150px;
    height: 162px;
    border: 1px solid #dcd9d9;
    padding: 5px;
	   
	}
h1 { margin: 0 0 16px 0; padding: 0 0 16px 0; font-size: 42px; font-weight: bold; letter-spacing: -2px; border-bottom: 1px solid #999; }
h2 { font-size: 20px; margin: 0 0 6px 0; position: relative; }

p { margin: 0 0 16px 0; }
#objective { width: 100%; float: left;    margin-bottom: 40px; }
#page-wrap p {
		    font-size: 18px;
		    padding: 0px;
		    font-weight: 500;
}
}
</style>
<style type="text/css"  media="print">
@media print {
  #pic {     
		
	        width: 150px;
    height: 162px;
    border: 1px solid #dcd9d9;
    padding: 5px;
	   
	}
}
</style>
</head>
<body>
<div id="page-wrap">
<?php $name=$user->name;$adhaar_card_number=$user->adhaar_card_number;?>
<div id="contact-info" class="vcard" style="border-bottom: 3px solid #ac0f0b;margin-bottom: 20px;">
   <img class="fn" src="{{$logo}}" alt="SUPER SOLUTIONS" id="" style="width: 250px;padding-bottom: 30px;">
</div>
<div id="objectives" style="margin-bottom: 5px;width: 100%; margin-bottom: 10px;">
	
	<h2><span style="float:left;">MR./MS:{{$name}}</span><span style="float: right;">Date:<?php $date= date("d-m-Y", strtotime($certification->created_at)); echo $date;?></span></h2>
	<br/>
</div>

<div id="objectives" style="width: 100%;margin-bottom: 25px;height: 165px;text-align: right;">
	<img id="pic" src="{{$profile}}">
</div>
		<p>
		This is in reference to the application made by you for enrolling yourself to act as
		    Point of Sale Person.</p>
		<p>This is to confirm that you have successfully completed the prescribed training and
		have also passed the examination specified for Point of Sales examination
		conducted by SuperSolutions underthe Guidelines on Point of
		    Sales Person for Life, Non-life and Health insurers.</p>
		<p>Your personal details are as under:</p>
		<p>Aadhaar No : {{$adhaar_card_number}}</p>
		<p>POSP Identification Number: CF/POS/200778</p>
		<p>This letter authorizes you to act as Point of Sales Person for  SuperSolutions to market products categorized and identified underthe
		    Guidelines only.</p>
		<p>In case you wish to work for another company, you are required to obtain a fresh
		letterfrom the new insurer/ insurance intermediary in orderto act as Point of Sales
		Person forthat entity.
		</p><p>Yours truly,</p><p style="font-size: 14px;font-weight: 700;">Vipul Rawal</p>

		<div class="footer" style="border-top: 3px solid #ac0f0b;padding-top: 24px;">
		<p style="font-size: 12px;font-weight: 600;color: #808488;text-align: center;margin: 0px;">3F-22 Mahima's Triniti, Plot No-5, Swej Farm, New Sanganer Road, Sodala, Jaipur, Rajasthan-302019</p>
		<p style="font-size: 12px;font-weight: 600;color: #808488;text-align: center;margin: 0px;">Email : care@supersolutions.in | Website : wwww.SuperSolutions.in| CIN: U74999RJ2017PTC058858</p>
		<span>
		    <p style="font-size: 13px;font-weight: 600;color: #808488;text-align: center;">This is a system generated certificate, no signature required.</p>
    </span>
   </div>
</div>




</body></html>