<form action="{{$pageData->formAction}}" method="post" name="PAYMENTFORM" id="PAYMENTFORM">
     @isset($pageData->formData)
         @foreach ($pageData->formData as $key=>$value)
            <input type="hidden" name="{{$key}}" value="{{$value}}" />
         @endforeach
     @endisset
     
      <!--<input type="hidden" name="key" value="2M6Fzv" />-->
      <!--<input type="hidden" name="txnid" value="ddc7fbca7dc37b1fa002" /> -->
      <!--<input type="hidden" name="amount" value="3102.45" />   -->
      <!--<input type="hidden" name="productinfo" value="ProHealth Select B" />-->
      <!--<input type="hidden" name="firstname" value="eee" />-->
      <!--<input type="hidden" name="email" value="test@gmail.com" />-->
      <!--<input type="hidden" name="phone" value="8287373490" />-->
      <!--<input type="hidden" name="lastname" value="sfsd" />-->
      <!--<input type="hidden" name="address1" value="" />-->
      <!--<input type="hidden" name="address2" value="" />-->
      <!--<input type="hidden" name="city" value="Rewari" />-->
      <!--<input type="hidden" name="state" value="Haryana" />-->
      <!--<input type="hidden" name="country" value="" />-->
      <!--<input type="hidden" name="zipcode" value="120001" />-->
      <!--<input type="hidden" name="udf1" value="" />-->
      <!--<input type="hidden" name="udf2" value="" />-->
      <!--<input type="hidden" name="udf3" value="" />-->
      <!--<input type="hidden" name="udf4" value="PROSLB980002623" />-->
      <!--<input type="hidden" name="udf5" value="141806" />-->
      <!--<input type="hidden" name="surl" value="http://agencyportal.local:5555/reciept" />-->
      <!--<input type="hidden" name="furl" value="http://agencyportal.local:5555/failed" />-->
      <!--<input type="hidden" name="hash" value="160e61eb708e98a0a403c8cf34ad5ce6af819bdddc8db92e4d84e291941a4bcc794cd9cf16b7d78668888e0cd270f9f09ddde413898a2aaa4090815ce4a9368f"/>-->
</form>
