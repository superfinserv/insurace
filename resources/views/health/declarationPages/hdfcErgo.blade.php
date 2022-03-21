<form action="{{$pageData->formAction}}" method="post" name="PAYMENTFORM" id="PAYMENTFORM">
     @isset($pageData->formData)
         @foreach ($pageData->formData as $key=>$value)
            <input type="hidden" id="{{$key}}" name="{{$key}}" value="{{$value}}" />
         @endforeach
     @endisset
     

</form>