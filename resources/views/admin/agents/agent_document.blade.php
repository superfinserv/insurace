@extends('admin.layout.app')
@section('content')

  <div class="card bd-0 ">
      @include('admin.agents.agents_menu_header')
    <div class="card-body bd bd-t-0 rounded-bottom">
        <div class="row">
            <div class="col-md-3 col-lg-3">
                 @include('admin.agents.agents_menu')
            </div>
           <?php  $assetUrl = "https://supersolutions.in/insurance/agents/";?>
            <div class="col-md-9 col-lg-9 mg-t-20 mg-lg-t-0-force">
                <div class="agent-doc-notify"></div>
              <form class="form-group" method="post" enctype="multipart/form-data" action="#" id="agentDocInfo" >
                <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                <input name="_agent" id="_agent" type="hidden" value="{{$agentData->id}}" />
                   <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                      <label class="form-control-label">PAN CARD NUMBER: <span class="tx-danger">*</span></label>
                                      <input class="form-control" type="text" name="pan_card_no" id="pan_card_no" value="{{$agentData->pan_card_number}}" placeholder="Enter PAN CARD NUMBER">
                                    </div>
                                </div>
                           
                           
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                      <label class="form-control-label">Address proof(Aadhar/licence/passport): <span class="tx-danger">*</span></label>
                                      <input class="form-control" type="text" id="address_proff" name="address_proff" value="{{$agentData->adhaar_card_number}}" placeholder="Address proof identity number">
                                    </div>
                                </div>
                            </div>
                        </div>   
                        <div class="col-md-6">
                            <div class="row">
                                
                                <div class="col-lg-12 col-md-12">
                                    <span>PAN CARD COPY</span>
                                    <table class="table table-bordered table-file-has-pan_card" style="@if($agentData->pan_card!='') display:block;@else display:none; @endif border: 1px solid #ccc;margin-top:7px;">
                                        <thead style="">
                                            <tr>
                                                <th style="width:70%;"><span id="pan_card_name"><?=$agentData->pan_card;?></span></th>
                                                <th style="width:30%;padding: 2px 11px 0px 18px;">
                                                  <a class="btn btn-dark btn-icon mg-r-5" download target="_blank" href="<?=$assetUrl.'pan_card/'.$agentData->pan_card;?>"><div><i class="fas fa-file-download"></i></div></a>
                                                  <a class="btn btn-danger btn-icon btn-remove-file mg-r-5" href="#" data-doc="pan_card"><div><i class="fas fa-trash-alt"></i></div></a>
                                                </th>
                                            </tr>
                                        </thead>
                                    </table>
                                    
                                    <table class="table table-bordered table-file-choose-pan_card" style="@if($agentData->pan_card!='') display:none;@else display:block; @endif border: 1px solid #ccc;margin-top:7px;">
                                         <thead class="">
                                            <tr>
                                               <th style="width:90%;padding: 0px;"><input type="file" class="form-control" name="new_pan_card" id="new_pan_card" /></th>
                                               <th style="width:10%;padding: 2px 5px 2px 10px;"><a class="btn btn-success btn-icon mg-r-5 uploadattach" data-doc="pan_card" href="#"  ><div><i class="fas fa-check-square"></i></div></a></th>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <div class="progress" id="myprogress-container-pan_card" style="display:none;">
                                                       <div class="progress-bar myprogress-pan_card" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                                                    </div>
                                                </th>
                                            </tr>
                                         </thead>
                                   </table>
                                </div>
                                
                                  <div class="col-lg-12 col-md-12">
                                    <span>ADDRESS PROOF-1 COPY</span>
                                    <table class="table table-bordered table-file-has-adhaar_card" style="@if($agentData->adhaar_card!='') display:block;@else display:none; @endif border: 1px solid #ccc;margin-top:7px;">
                                        <thead style="">
                                            <tr>
                                                <th style="width:70%;"><span id="adhaar_card_name"><?=$agentData->adhaar_card;?></span></th>
                                                <th style="width:30%;padding: 2px 11px 0px 18px;">
                                                  <a class="btn btn-dark btn-icon mg-r-5" download target="_blank" href="<?=$assetUrl.'adhaar_card/'.$agentData->adhaar_card;?>"><div><i class="fas fa-file-download"></i></div></a>
                                                  <a class="btn btn-danger btn-icon btn-remove-file mg-r-5" href="#" data-doc="adhaar_card"><div><i class="fas fa-trash-alt"></i></div></a>
                                                </th>
                                            </tr>
                                        </thead>
                                    </table>
                               
                                    <table class="table table-bordered table-file-choose-adhaar_card" style="@if($agentData->adhaar_card!='') display:none;@else display:block; @endif border: 1px solid #ccc;margin-top:7px;">
                                         <thead class="">
                                            <tr>
                                               <th style="width:90%;padding: 0px;"><input type="file" class="form-control" name="new_adhaar_card" id="new_adhaar_card" /></th>
                                               <th style="width:10%;padding: 2px 5px 2px 10px;"><a class="btn btn-success btn-icon mg-r-5 uploadattach" data-doc="adhaar_card" href="#"  ><div><i class="fas fa-check-square"></i></div></a></th>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <div class="progress" id="myprogress-container-adhaar_card" style="display:none;">
                                                       <div class="progress-bar myprogress-adhaar_card" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                                                    </div>
                                                </th>
                                            </tr>
                                         </thead>
                                   </table>
                                </div>
                                
                                  <div class="col-lg-12 col-md-12">
                                       <span>ADDRESS PROOF-2 COPY</span>
                                    <table class="table table-bordered table-file-has-adhaar_card_back" style="@if($agentData->adhaar_card_back!='') display:block;@else display:none; @endif border: 1px solid #ccc;margin-top:7px;">
                                        <thead style="">
                                            <tr>
                                                <th style="width:70%;"><span id="adhaar_card_back_name"><?=$agentData->adhaar_card_back;?></span></th>
                                                <th style="width:30%;padding: 2px 11px 0px 18px;">
                                                  <a class="btn btn-dark btn-icon mg-r-5" download target="_blank" href="<?=$assetUrl.'adhaar_card/'.$agentData->adhaar_card_back;?>"><div><i class="fas fa-file-download"></i></div></a>
                                                  <a class="btn btn-danger btn-icon btn-remove-file mg-r-5" href="#" data-doc="adhaar_card_back"><div><i class="fas fa-trash-alt"></i></div></a>
                                                </th>
                                            </tr>
                                        </thead>
                                    </table>
                               
                                    <table class="table table-bordered table-file-choose-adhaar_card_back" style="@if($agentData->adhaar_card_back!='') display:none;@else display:block; @endif border: 1px solid #ccc;margin-top: 7px;">
                                         <thead class="">
                                            <tr>
                                               <th style="width:90%;padding: 0px;"><input type="file" class="form-control" name="new_adhaar_card_back" id="new_adhaar_card_back" /></th>
                                               <th style="width:10%;padding: 2px 5px 2px 10px;"><a class="btn btn-success btn-icon mg-r-5 uploadattach" data-doc="adhaar_card_back" href="#"  ><div><i class="fas fa-check-square"></i></div></a></th>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <div class="progress" id="myprogress-container-adhaar_card_back" style="display:none;">
                                                       <div class="progress-bar myprogress-adhaar_card_back" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                                                    </div>
                                                </th>
                                            </tr>
                                         </thead>
                                   </table>
                                </div>
                                
                            </div>
                        </div> 
                   </div>
                   
                  
                   
                    <div class="row">
                             <div class="col-lg-3 col-md-3">
                                 <button class="btn btn-info agentBankInfoBtn" type="submit">Update Info</button>
                            <div>
                        </div>
                    </div>
         </div>
                </form>
     </div><!-- card-body -->
 </div>
         
         

      
@endsection