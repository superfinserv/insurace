
                                   <div class="modal-body">
                                      <h5 class="modal-title topft">Please Enter the OTP to Verify Your Account</h5>
                                      <p class="text-center " style="margin-bottom: 1px;">An OTP (One Time Password) has been sent to</p>
                                      <p class="text-center" style="margin-top: 1px;">+91-<span id="pfts"></span></p>
                                    </div>
                                   {{ Form::open(array('url' => '#' ,'style'=>"margin: 0;top: 15px;",'class'=>"form-group text-center",'enctype'=>"multipart/form-data", 'id'=>"verifyotp",'method'=>"post" )) }}
                                       <div class="otp-1">
                                         
                                            <input id="codeBox1" placeholder="" type="tel" max="9" maxlength="1" onkeyup="onKeyUpEvent(1, event)" onfocus="onFocusEvent(1)" name="codeBox1" autocomplete="off" />
                                            <input id="codeBox2" placeholder="" type="tel" max="9" maxlength="1" onkeyup="onKeyUpEvent(2, event)" onfocus="onFocusEvent(2)"  name="codeBox2" autocomplete="off" />
                                            <input id="codeBox3" placeholder="" type="tel" max="9" maxlength="1" onkeyup="onKeyUpEvent(3, event)" onfocus="onFocusEvent(3)" name="codeBox3" autocomplete="off" />
                                            <input id="codeBox4" placeholder="" type="tel" max="9" maxlength="1" onkeyup="onKeyUpEvent(4, event)" onfocus="onFocusEvent(4)" name="codeBox4" autocomplete="off" />
                                        </div>
                                        <div class="modal-footer">
                                        <button type="submit"  class="btn btn-primary otp-btn-dn">Verify</button>
                                        </div>
                                    {{ Form::close() }}
                                    <br><br>
                                    <p class="text-center"><a href="#" class="resend">Resent Otp</a> || <a href="#" class="change">change number</a></p>
                                    <p></p>
                                