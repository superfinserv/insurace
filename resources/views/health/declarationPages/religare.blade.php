<?php //$old = "https://apiuat.religarehealthinsurance.com/portalui/PortalPayment.run";?>
<form   action='{{$pageData->formAction}}' id="PAYMENTFORM" name='PAYMENTFORM' method='post'>
    <div>
     <input type='hidden' id="proposalNum" name='proposalNum' value='<?=$jd->proposalNum;?>'/>
	 <input type='hidden' name='returnURL' value='<?=$pageData->returnURL;?>'/>
	 
	</div>
</form>