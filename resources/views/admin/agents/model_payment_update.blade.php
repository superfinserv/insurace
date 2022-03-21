 <form class="form-group" method="post" enctype="multipart/form-data" action="#" id="agentPaymentupdateInfo" >
               <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                <input name="agentID"  id="agentID" type="hidden" value="{{$agentId}}" />
                <div class="pay-notify"></div>
               <div class="row">
                       <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                              <label class="form-control-label">Transaction ID: <span class="tx-danger">*</span></label>
                              <input class="form-control" type="text" required id="transactionID" name="transactionID" value="<?=isset($pay)?$pay->transaction_id:'';?>" placeholder="Enter Transaction ID">
                            </div>
                       </div>
                       
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                              <label class="form-control-label">Transaction Date: <span class="tx-danger">*</span></label>
                              <input class="form-control" type="text" required name="transactionDate" id="transactionDate" value="<?=isset($pay)?$pay->transaction_date:date('Y-m-d');?>" placeholder="Enter transaction date">
                            </div>
                       </div>
                       
                       
                   </div>
                 
                    
                <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                              <label class="form-control-label">Transaction Mode: <span class="tx-danger">*</span></label>
                              <select class="form-control" name="transactionMode" id="transactionMode" required>
                                  <option value="">Choose Mode</option>
                                   <option value="Cheque" <?=(isset($pay) && ($pay->mode=='Cheque'))?'selected':'';?>>Cheque</option>
                                   <option value="Bank Transfer" <?=(isset($pay) && ($pay->mode=='Bank Transfer'))?'selected':'';?>>Bank Transfer</option>
                                   <option value="Cash" <?=(isset($pay) && ($pay->mode=='Cash'))?'selected':'';?>>Cash</option>
                                   <option value="Payment Link" <?=(isset($pay) && ($pay->mode=='Payment Link'))?'selected':'';?>>Payment Link</option>
                                   <option value="Card" <?=(isset($pay) && ($pay->mode=='Card'))?'selected':'';?>>Card</option>
                                   <option value="UPI" <?=(isset($pay) && ($pay->mode=='UPI'))?'selected':'';?>>UPI</option>
                              </select>
                            </div>
                       </div>
                       <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                              <label class="form-control-label">Transaction Note: <span class="tx-danger">(if any)</span></label>
                              <input class="form-control" type="text" name="transactionNote" id="transactionNote" value="<?=isset($pay)?$pay->note:'';?>" placeholder="Enter transaction note">
                            </div>
                       </div>
                       
                </div>
                   
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <button class="btn btn-info agentPaymentUpdateBtn" type="button">Update</button>
                    </div>
                </div>
            </form>