
<div class="" style="margin-bottom: 35px;color: #0E3679;font-size: 14px;font-weight: 900;">
        <p  style="margin-bottom: 10px;text-align: center;color: #C52118;">Great !! your mobile number has been verified successfully.</p> 
        <p  style="margin: 0;text-align: center;">To complete your account creation with</p>
        <p  style="margin: 0;text-align: center;">Super Finserv Private Limited,</p>
        <p  style="margin: 0;text-align: center;">Please enter the required information below :</p>
</div>
<form class=" card-sm form-group" style="margin: 0;" enctype="multipart/form-data"  id="agentDetails" method="post">
    <input name="_token" type="hidden" value="{{ csrf_token() }}" />
    <div class="row no-gutters">
        <div class="col-12 col-sm">
            <div class="input-wrp">
                <input class="form-control " placeholder="Mobile Number..." name="mobile" maxlength="10" id="mobiles" onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));" autocomplete="off" readonly="">
            </div>
            <div class="input-wrp">
                <input class="form-control " placeholder="Full Name" name="name"  id="name" type="text"  />
            </div>
            <div class="input-wrp">
                <input class="form-control " placeholder="Email" name="email"  id="email" type="email" />
            </div>
            <div class="input-wrp">
                <select class="form-control  invest-month single-select2" placeholder="Address" name="stateID"  id="stateID">
                    <option value="">Select State</option>
                    <?php foreach ($statelist as  $value) {?>
                         <option value="{{$value->id}}">{{$value->name}}</option>
                     <?php } ?></select>
               <div id="errorState"></div>
            </div>
             <div class="input-wrp">
                <select class="form-control  invest-month"  name="city"  id="city">
                    <option value="">Select city</option>
                </select>
               <div id="errorCity"></div>
            </div>
             <div class="input-wrp">
                <input class="form-control " placeholder="Pincode" name="pincode"  id="pincode"  />
            </div>
            <div class="input-wrp" style="width: 48%;float: left;margin-right: 8px;">
                <input class="form-control" placeholder="Password" name="password" id="password" type="password"  >
            </div>
            <div class="input-wrp" style="width: 48%;float: right;">
                 <input class="form-control" placeholder="Confirm Password" name="confirm_password" id="confirm_password" type="password" >
            </div>
        </div>
        <div class="col-12 ">
            <button class="custom-btn custom-btn--medium custom-btn--style-1 wide" type="submit" role="button" style=" margin-left:0px;">Get Started</button>
        </div>
    </div>
</form>
