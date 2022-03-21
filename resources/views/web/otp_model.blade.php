  <div class="card otpMaster" style="border:none">
            <div class="card-body">
              <h5 class="modal-title" style="text-align:center">Mobile Number verification</h5>
              <p style="font-size: 15px;text-align:center">Enter the code we just sent on <br/><span style="color: #AC0F0B;font-weight: 600;">+91 {{$mobile}}</span></p>
                
                <form class="form-group" style="margin: 0;" enctype="multipart/form-data"  id="verifyotp" method="post">
                  <input class="integer-mobile" name="_token" type="hidden" value="{{ csrf_token() }}" />
                   <input id="_mobileNUM" type="hidden" value="{{$mobile}}" />
                  <div class="otp-1" style="text-align: center;">
                   <?php /*<div class="msg-container" style="height:45px;margin-bottom:5px;">
                       <?php  if($msg){?>
                         <div id="ajax_response{{$mobile}}"><div class="alert alert-success alert-bordered"> <span class="text-semibold"><?php echo $msg;  ?></span></div></div>
                      <?php }  ?>
                   </div> */?>
                   
                           <div class="inputs" id="inputs" autocomplete="off">
                                <input maxlength="2" placeholder="" class="otpvalue integer-mobile"  type="number" value=""  name="codeBox1" autocomplete="off">
                                <input maxlength="2" placeholder="" class="otpvalue integer-mobile"  type="number" value=""  name="codeBox2" autocomplete="off">
                                <input maxlength="2" placeholder="" class="otpvalue integer-mobile"  type="number" value=""  name="codeBox3" autocomplete="off">
                                <input maxlength="2" placeholder="" class="otpvalue integer-mobile"  type="number" value=""  name="codeBox4" autocomplete="off">
                            </div>
                         
                  </div>
                 
                  <div class="text-center">
                      <button type="submit" id="otpformbutton" class="btn btn-primary btn-otp-send">Submit OTP</button>
                       
                  </div>
                  <p id="ajax_response{{$mobile}}" style="text-align: center;font-size: 13px;color: #d40000;font-weight: 600;"></p>

                </form>
                <div class="text-center" style="margin-top:12px;">
                    <p style="margin-bottom:0px;color: #989696b8;font-size: 15px">Didn't receive the code?</p> 
                   <p><a href="#" class="resend" id="resend"  data-mobile="{{$mobile}}">Resend OTP</a></p>
                </div>
                   
              
           </div>
         </div>
       </div>
 <script type="text/javascript">

   $(document).on('click', '#otpformbutton', function (e) {  
     e.preventDefault();
    
       var mobile=$('#resend').attr('data-mobile');
       var verifyotp=$(".otpvalue").valid();
       var formData  = $('#verifyotp').serialize();
       if(verifyotp){
             $.ajax({
                    type: "POST",
                    url: base_url + "/verifyotp/"+mobile,
                    data: formData,
                    dataType:'json',
                    timeout: 3000,
                    success: function (data) {
                        console.log(data);
                        var msg=data.msg;
                            var str = $.trim(data.statusCode);
                            var email = $.trim(data.email);
                        if (str == 200) {
                         // var customer_id=data.customer_id;
                             //   var lead_id= data.lead_id;
                            //    var leadData = {};
                           // leadData= {customer_id:customer_id,lead_id:lead_id,mobile:mobile};
                           // localStorage.setItem("customersDetails", JSON.stringify(leadData));
                             window.location=base_url + "/"+data.url;
                               
                        } else if(str == '400'){
                             $('#ajax_response'+mobile).html('');
                             $('#ajax_response'+mobile).html('<span>'+msg+'</span>')
                            // setInterval(function(){ $(".alert").hide(); }, 5000);
                        }else{
                             $('#ajax_response'+mobile).html('');
                            $('#ajax_response'+mobile).html('<span>'+msg+'</span>')
                        //  setInterval(function(){ $(".alert").hide(); }, 5000);
                        }
                    },
                    error: function () { }
                });
}
    });
  var resend="";
//setInterval(function(){ $(".alert").hide(); }, 5000);
   $("#verifyotp").validate({   
        errorClass: 'help-block error',
            errorElement: 'div',
          errorPlacement: function(error, element) {
                error.insertAfter(element.parent('.input-group'));
            },
            highlight: function(e) {
                $(e).closest('.form-group').removeClass('has-success has-error')
                    .addClass('has-error');
                $(e).closest('.help-block').remove();
            },
            success: function(e) {
                e.closest('.form-group').removeClass('has-success has-error');
                e.closest('.help-block').remove();
            },
        rules: {
            'otp':{
                required: true,
               
               
            },
          
            
            
        }

            
    });
  function processInput(holder){
  var elements = holder.children(), //taking the "kids" of the parent
      str = ""; //unnecesary || added for some future mods
  
  elements.each(function(e){ //iterates through each element
    var val = $(this).val().replace(/\D/,""), //taking the value and parsing it. Returns string without changing the value.
        focused = $(this).is(":focus"), //checks if the current element in the iteration is focused
        parseGate = false;
    
    val.length==1?parseGate=false:parseGate=true; 
      /*a fix that doesn't allow the cursor to jump 
      to another field even if input was parsed 
      and nothing was added to the input*/
    
    $(this).val(val); //applying parsed value.
    
    if(parseGate&&val.length>1){ //Takes you to another input
      var exist = elements[e+1]?true:false; //checks if there is input ahead
      exist&&val[1]?( //if so then
        elements[e+1].disabled=false,
        elements[e+1].value=val[1], //sends the last character to the next input
        elements[e].value=val[0], //clears the last character of this input
        elements[e+1].focus() //sends the focus to the next input
      ):void 0;
    } else if(parseGate&&focused&&val.length==0){ //if the input was REMOVING the character, then
      var exist = elements[e-1]?true:false; //checks if there is an input before
      if(exist) elements[e-1].focus(); //sends the focus back to the previous input
    }
    
    val==""?str+=" ":str+=val;
    console.log(val);
  });
}

$("#inputs").on('input', function(){
    $('#ajax_response'+$('#_mobileNUM').val()).html('');
    processInput($(this))
    if($("input[name=codeBox4]").val()!=""){
        $('#otpformbutton').trigger('click');
    }
    
    
}); //still wonder how it worked out. But we are adding input listener to the parent... (omg, jquery is so smart...);

$("#inputs").on('click', function(e) { //making so that if human focuses on the wrong input (not first) it will move the focus to a first empty one.
  var els = $(this).children(),
      str = "";
  els.each(function(e){
    var focus = $(this).is(":focus");
    $this = $(this);
    while($this.prev().val()==""){
      $this.prev().focus();
      $this = $this.prev();
    }
  })
});
 
             </script>
                                
<style type="text/css">

.btn.btn-primary.btn-otp-send {
    text-align: center;
    margin: 0 auto;
    padding: 5px 35px;
    font-size: 16px;
    font-weight: 500;
    letter-spacing: 1px;
    text-transform: uppercase;
    border-radius: 4px;
    background: #db3f3c;
    color: #fff !important;
    border-color: #db3f3c;
    margin-top: 13px;
}

.inputs input:not(:last-child){ margin-right:20px; }
a#resend:hover {
    /*text-align: center !important;*/
    /*display: block !important;*/
    /*color: red !important;*/
    font-weight: 600;
    font-size: 16px;
}
a#resend {
    
    
    color: #dc3545;
    font-weight: 600;
    font-size: 16px;
}

h5.modal-title{
    font-size: 17px;
    font-weight: 600;
    margin: 0 auto;
}
div#inputs input {
    /* padding: 18px; */
     width: 15%;
    font-size: 20px;
    font-weight: 600;
    min-height:40px !important;
    text-align: center;
    border: none;
    border-bottom: 3px solid #dc3545;
    border-radius: 0px;
     box-shadow: none;
}

div#inputs input:focus {
        box-shadow: none;
        outline: 0;
}
</style>
