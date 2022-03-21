<form action="{{$pageData->formAction}}" method="post" name="PAYMENTFORM" id="PAYMENTFORM">
     @isset($pageData->formData)
         @foreach ($pageData->formData as $key=>$value)
            <input type="hidden" name="{{$key}}" value="{{$value}}" />
         @endforeach
     @endisset
     
<!--<form name="form1" method="post" action="https://online.futuregenerali.in/ECOM_NL/WEBAPPLN/UI/Common/webaggpay.aspx" id="form1">-->
<!--<input type="text" name='TransactionID' value='V0026511'/>-->
<!--<input type="text" name='PaymentOption' value='1'/>-->
<!--<input type="text" name='ResponseURL' value='http://localhost:9000/payment/response/fg'/>-->
<!--<input type="text" name='ProposalNumber' value='XMPVF0136141'/>-->
<!--<input type="text" name='PremiumAmount' value='3000'/>-->
<!--<input type="text" name='UserIdentifier' value='60001464'/>-->
<!--<input type="text" name='UserId' value='10134025'/>-->
<!--<input type="text" name='FirstName' value='asdf'/>-->
<!--<input type="text" name='LastName' value='asf'/>-->
<!--<input type="text" name='Mobile' value='8975504842'/>-->
<!--<input type="text" name='Email' value='asda@sdfd.com'/>-->
<!--<input type="submit" value='Submit' />-->
</form>
