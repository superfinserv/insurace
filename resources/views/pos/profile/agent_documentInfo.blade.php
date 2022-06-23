<form class="form-group" style="top: 10px;margin: 10px;" enctype="multipart/form-data"  id="documentinfo" method="post">
                                         <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                                            <div class="form-row">
                                              <div class="form-group col-md-4">
                                                <label for="inputEmail4" class="h4">PAN card number</label>
                                             </div>
                                             <div class="form-group col-md-6">
                                                <input  data-refClass="document-section" type="text" style="text-transform: uppercase;" class="form-control profile-input" name="pan_card_number" id="pan_card_number" placeholder="PAN card number" value="{{$agent->pan_card_number}}">
                                              </div>
                                              <div class="form-group col-md-4">
                                                <label for="inputPassword4" class="h4">Upload PAN card</label>
                                             </div>
                                              <div class="form-group col-md-6">
                                                <!--<div class="form-group" id="not-hasPan-element" style="display:">-->
                                                <!--    <input type="file" class="form-control-file" name="pan_card" id="pan_card" accept="application/pdf,image/jpeg, image/png">-->
                                                <!--</div>-->
                                                
                                                <div class="form-group" id="not-hasPan-element" style="display:<?=($agent->pan_card=="")?"block":"none";?>">
                                                    <div class="input-group mb-3">
                                                      <input data-refClass="document-section" type="file" class="form-control"  name="pan_card" id="pan_card" accept="application/pdf,image/jpeg, image/png">
                                                      <div class="input-group-append profile-input-upload" data-name="pan_card" data-refClass="document-section" data-form="documentinfo" data-elem="hasPan-element">
                                                        <span class="input-group-text">
                                                            <i class="fa fa-check "  style="color:#C52118;font-size: 20px;"></i>
                                                        </span>
                                                      </div>
                                                    </div>
                                                </div>
                                             
                                               <div class="form-group" id="hasPan-element" style="display:<?=($agent->pan_card!="")?"block":"none";?>">
                                                    <input type="text" class="form-control" name="hasPan" id="hasPan" readonly="" style=" width: 90%;float: left;" value="{{$agent->pan_card}}">
                                                    <i class="fa fa-trash remove-pancard" style="cursor: pointer;width: 10%;color: red;font-size: 25px;padding-top: 5px;padding-left: 10px;" data-id="{{$agent->id}}" data-name="{{$agent->pan_card}}"></i>
                                                </div>
                                                
                                              </div>
                                             
                                            
                                              <div class="form-group col-md-4">
                                                <label for="inputEmail4" class="h4">Adhaar Card Number</label>
                                             </div>
                                             <div class="form-group col-md-6">

                                                <input data-refClass="document-section" type="text" class="form-control profile-input" name="adhaar_card_number" id="adhaar_card_number"  placeholder="Adhaar Card Number" value="{{$agent->adhaar_card_number}}" maxlength="12" minlength="12">
                                              </div>
                                              <div class="form-group col-md-4">
                                                <label for="inputPassword4" class="h4">Upload Adhaar Card</label>
                                             </div>
                                              <div class="form-group col-md-6">
                                                <!--<div class="form-group" id="not-hasAadhar-element" style="display:">-->
                                                <!--    <input type="file" class="form-control-file" name="adhaar_card" id="adhaar_card" accept="application/pdf,image/jpeg, image/png">-->
                                                <!--</div>-->
                                                
                                                <div class="form-group" id="not-hasAadhar-element" style="display:<?=($agent->adhaar_card=="")?"block":"none";?>">
                                                    <div class="input-group mb-3">
                                                      <input  data-refClass="document-section" type="file" class="form-control "   name="adhaar_card" id="adhaar_card" accept="application/pdf,image/jpeg, image/png">
                                                      <div class="input-group-append profile-input-upload"  data-name="adhaar_card" data-refClass="document-section" data-form="documentinfo" data-elem="hasAadhar-element">
                                                        <span class="input-group-text">
                                                            <i class="fa fa-check "  style="color:#C52118;font-size: 20px;"></i>
                                                        </span>
                                                      </div>
                                                    </div>
                                                </div>
                                             
                                               <div class="form-group" id="hasAadhar-element" style="display:<?=($agent->adhaar_card!="")?"block":"none";?>">
                                                   
                                                    <input type="text" class="form-control" name="hasAadhar" id="hasAadhar" readonly="" style=" width: 90%;float: left;" value="{{$agent->adhaar_card}}">
                                                    <i class="fa fa-trash remove-aadharcard" style="cursor: pointer;width: 10%;color: red;font-size: 25px;padding-top: 5px;padding-left: 10px;" data-id="{{$agent->id}}" data-name="{{$agent->adhaar_card}}"></i>
                                                </div>
                                                
                                                
                                              </div>
                                               <div class="form-group col-md-4">
                                                <label for="inputPassword4" class="h4">Upload Adhaar Card Back</label>
                                             </div>
                                              <div class="form-group col-md-6">
                                                <!--<div class="form-group" id="not-hasAaharBack-element" style="display:<?=($agent->adhaar_card_back=="")?"block":"none";?>">-->
                                                   
                                                <!--    <input type="file" class="form-control-file" name="adhaar_card_back" id="adhaar_card_back" accept="application/pdf,image/jpeg, image/png">-->
                                                <!--</div>-->
                                                
                                                <div class="form-group" id="not-hasAaharBack-element" style="display:<?=($agent->adhaar_card_back=="")?"block":"none";?>">
                                                    <div class="input-group mb-3">
                                                      <input data-refClass="document-section" type="file" class="form-control"  name="adhaar_card_back" id="adhaar_card_back" accept="application/pdf,image/jpeg, image/png">
                                                      <div class="input-group-append profile-input-upload" data-name="adhaar_card_back" data-refClass="document-section" data-form="documentinfo" data-elem="hasAaharBack-element">
                                                        <span class="input-group-text">
                                                            <i class="fa fa-check "  style="color:#C52118;font-size: 20px;"></i>
                                                        </span>
                                                      </div>
                                                    </div>
                                                </div>
                                             
                                               <div class="form-group" id="hasAaharBack-element" style="display:<?=($agent->adhaar_card_back!="")?"block":"none";?>">
                            
                                                    <input data-refClass="document-section" type="text" class="form-control" name="hasAaharBack" id="hasAaharBack" readonly="" style=" width: 90%;float: left;" value="{{$agent->adhaar_card_back}}">
                                                    <i class="fa fa-trash remove-aadharcard-back" style="cursor: pointer;width: 10%;color: red;font-size: 25px;padding-top: 5px;padding-left: 10px;" data-id="{{$agent->id}}" data-name="{{$agent->adhaar_card_back}}"></i>
                                                </div>
                                                
                                                
                                              </div>
                                            
                                             
                                             
                                            </div>

                                         <!--     <div class="form-group col-md-10"style=" margin-bottom: 10%; top: 15px; bottom: 19px; ">-->
                                         <!--   <button type="submit" class="btn btn-primary">update</button>-->
                                         <!--</div>-->
                                          </form>