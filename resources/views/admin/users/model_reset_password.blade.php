 <form class="form-group" method="post" enctype="multipart/form-data" action="#" id="userResetPasswordForm" >
    <input name="_token" type="hidden" value="{{ csrf_token() }}" />
    <input name="userID"  id="userID" type="hidden" value="{{$userId}}" />
    <div class="resetpass-notify"></div>
    <div class="row">
       <div class="col-lg-6 col-md-6">
            <div class="form-group">
              <label class="form-control-label">Password: <span class="tx-danger">*</span></label>
              <input class="form-control" type="password" required id="userPass" name="agentPass"  placeholder="Enter Password">
            </div>
       </div>
       
        <div class="col-lg-6 col-md-6">
            <div class="form-group">
              <label class="form-control-label">Confirm Password: <span class="tx-danger">*</span></label>
              <input class="form-control" type="password" required name="usercPass" id="usercPass" placeholder="Repeat Password">
            </div>
       </div>
       
       
   </div>
  <div class="row">
        <div class="col-lg-3 col-md-3">
            <button class="btn btn-info userResetPasswordBtn" type="button">Reset Password</button>
        </div>
    </div>
 </form>