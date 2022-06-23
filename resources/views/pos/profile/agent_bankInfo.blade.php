<form class="form-group" style="top: 10px;margin: 10px;" enctype="multipart/form-data"  id="bankinfo" method="post">
 <input name="_token" type="hidden" value="{{ csrf_token() }}" />
    <div class="form-row">
      <div class="form-group col-md-4 col-sm-12">
        <label for="inputEmail4" class="h4">Bank Name</label>
     </div>
      <div class="form-group col-md-6 col-sm-12">
         <select type="text"  data-refClass="bank-section" class="form-control profile-input single-select2" id="bank_name" name="bank_name">
            <option value="">Select Bank</option>
                    <?php foreach ($banks as  $value) {?>
                      <option value="{{$value->bank}}" <?php if($value->bank==$agent->bank_name){ echo 'selected';}?>>{{$value->bank}}</option>
                   <?php } ?>
           </select>
          <div id="bank-error"></div>
      </div>
      <div class="form-group col-md-4 col-sm-12">
        <label for="inputEmail4" class="h4">Account Holder Name</label>
     </div>
      <div class="form-group col-md-6 col-sm-12">
          <?php $account_holder_name = ($agent->account_holder_name!="")?$agent->account_holder_name:$agent->name;?>
        <input data-refClass="bank-section" type="text" class="form-control profile-input" id="account_holder_name" name="account_holder_name" placeholder="Account Holder Name" value="{{$account_holder_name}}">
      </div>
     
     <div class="form-group col-md-4 col-sm-12">
        <label for="inputEmail4" class="h4">Account Number</label>
     </div>
      <div class="form-group col-md-6 col-sm-12">
        <input data-refClass="bank-section" type="text" class="form-control profile-input number-only" id="account_number" name="account_number" placeholder="Account Number" value="{{$agent->account_number}}">
      </div>

      <div class="form-group col-md-4 col-sm-12">
        <label for="inputEmail4" class="h4">Confirm Account Number</label>
     </div>
      <div class="form-group col-md-6 col-sm-12">
        <input data-refClass="bank-section" type="password" class="form-control profile-input number-only" id="account_number_confirm" name="account_number_confirm" placeholder="Confirm Account Number" value="{{$agent->account_number}}">
      </div>
    <div class="form-group col-md-4 col-sm-12">

        <label for="inputEmail4" class="h4">IFSC</label>
     </div>
     <div class="form-group col-md-6 col-sm-12">
        <input data-refClass="bank-section" type="text" class="form-control profile-input uppercase" id="ifsc_code" name="ifsc_code" placeholder="IFSC Code" value="{{$agent->ifsc_code}}">
      </div>
     <div class="form-group col-md-4 col-sm-12">
        <label for="inputPassword4" class="h4">Cancelled cheque / passbook / bank statement</label>
     </div>
      <div class="form-group col-md-6 col-sm-12">
        <!-- <div class="form-group" id="not-hasPassbook-element" style="display:">-->
        <!--    <input type="file" class="form-control-file" name="passbook_statement" id="passbook_statement" accept="application/pdf,image/jpeg, image/png">-->
        <!--</div>-->
        
         <div class="form-group" id="not-hasPassbook-element" style="display:<?=($agent->passbook_statement=="")?"block":"none";?>">
                <div class="input-group mb-3">
                  <input data-refClass="bank-section" type="file" class="form-control"  name="passbook_statement" id="passbook_statement" accept="application/pdf,image/jpeg, image/png">
                  <div class="input-group-append profile-input-upload" data-name="passbook_statement" data-refClass="bank-section" data-form="bankinfo" data-elem="hasPassbook-element">
                    <span class="input-group-text">
                        <i class="fa fa-check "  style="color:#C52118;font-size: 20px;"></i>
                    </span>
                  </div>
                </div>
         </div>
     
       <div class="form-group" id="hasPassbook-element" style="display:<?=($agent->passbook_statement!="")?"block":"none";?>">
            <input type="text" class="form-control" name="hasPassbook" id="hasPassbook" readonly="" style="width: 90%;float: left;" value="{{$agent->passbook_statement}}">
            <i class="fa fa-trash remove-passbook" style="cursor: pointer;width: 10%;color: red;font-size: 25px;padding-top: 5px;padding-left: 10px;" data-id="{{$agent->id}}" data-name="{{$agent->passbook_statement}}"></i>
        </div>
        
      </div>
    </div>

 <!--     <div class="form-group col-md-10 col-sm-12"style=" margin-bottom: 10%; top: 15px; bottom: 19px; ">-->
 <!--   <button type="submit" class="btn btn-primary">update</button>-->
 <!--</div>-->
  </form>