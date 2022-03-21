 <form class="form-group" method="post" enctype="multipart/form-data" action="#" id="agentResetPasswordForm" >
    <input name="_token" type="hidden" value="{{ csrf_token() }}" />
    <input name="agentID"  id="agentID" type="hidden" value="{{$agentId}}" />
    <div class="resetpass-notify"></div>
    <div class="row">
       <div class="col-lg-6 col-md-6">
            <div class="form-group">
              <label class="form-control-label">Password: <span class="tx-danger">*</span></label>
              <input class="form-control" type="password" required id="agentPass" name="agentPass"  placeholder="Enter Password">
            </div>
       </div>
       
        <div class="col-lg-6 col-md-6">
            <div class="form-group">
              <label class="form-control-label">Confirm Password: <span class="tx-danger">*</span></label>
              <input class="form-control" type="password" required name="agentcPass" id="agentcPass" placeholder="Repeat Password">
            </div>
       </div>
       
       
   </div>
  <div class="row">
        <div class="col-lg-3 col-md-3">
            <button class="btn btn-info agentResetPasswordBtn" type="button">Reset Password</button>
        </div>
    </div>
 </form>