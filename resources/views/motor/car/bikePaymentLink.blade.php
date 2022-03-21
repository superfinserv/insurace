 @extends('web.layout.app')
    @section('content')
       <main role="main">
          <section class="term-smoke ptb">
            <div class="container page-make-payment" >
                <div class="loaderDiv" style="text-align:center;padding: 75px 35px;">
                    <h4 style="font-size: 40px;color: #AC0F0B;font-weight: 600;">Fetching Your Payment Details<span class="inline-loader"><span class="inline-loader-box"></span><span class="inline-loader-box"></span><span class="inline-loader-box"></span></span></h4>
                </div>
                <div class="PaymentDesc" style="display:none;">
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                             <p style="font-size: 12px;margin-bottom:0px;">Dear <b>{{$info->customer->name}}</b>,</p>
                            <p style="margin: 0;font-size: 12px;">Premium deatils for your car 
                            <span style="font-weight: 600;">{{ucwords(strtolower($info->vehicle->make))}} {{ucwords(strtolower($info->vehicle->model))}} {{ucwords(strtolower($info->vehicle->varient))}}</span>.</p>
                            <br/>
                            <div class="card">
                                  <div class="card-header" style="background: #AC0F0B;color: #fff;">
                                      <h4>Payments Details</h4>
                                  </div>
                                  <div class="card-body">
                                        <ul class="list-group" >
                                            <?php $covers = $info->covers;?>
                                            <?php foreach($covers as $key=>$cover){
                                                if($key!="addons" && $cover->selection===true){?>
                                                <li style="font-size: 12px;line-height:20px !important;" class="list-group-item"><?=$cover->title;?> <b style="float:right">(+) ₹<?=$cover->grossAmt;?>/-</b></li>
                                               <?php  } ?>
                                            <?php } ?>
                                            <?php foreach($covers->addons as $adon){ ?>
                                                      <li style="font-size: 12px;line-height:20px !important;" class="list-group-item"><?=$adon->title;?> <b style="float:right">(+) ₹<?=$adon->grossAmt;?>/-</b></li>
                                                 
                                           <?php  } ?>
                                           <?php foreach($info->discount->discounts as $dis){ 
                                              $typ = ($dis->type=='NCB_DISCOUNT')?"NCB":"OTHER";?>
                                            <li style="font-size: 12px;line-height:20px !important;" class="list-group-item">@if($typ=='NCB')No Claim Bonus ({{$dis->percent}}%) @else Discount @endif ({{$typ}}-{{$dis->percent}}%)<b style="float:right">(-) ₹<?=$info->discount->total;?>/-</b></li>
                                           <?php }?>
                                            <li style="font-size: 12px;line-height:20px !important;" class="list-group-item">Service Tax GST(18%) <b style="float:right">(+) ₹<?=$info->tax;?>/-</b></li>
                                           
                                            <li style="font-weight: 600;background: #ccc;font-size: 12px;line-height:20px !important;" class="list-group-item">
                                                Amount to Pay <b style="float:right"><?=$info->gross;?></b></li>
                                                 
                                        </ul>
                                        <div class="form-check" id="effect">
                                            <input type="checkbox" class="form-check-input isChecked" id="agreeTerms" style="margin: 8px 0 0;">
                                            <label style="margin-left: 18px;font-size: 13px;color: #000;" class="form-check-label" >I agree to the <a href="#" class="readTermsConditions">Terms & Conditions</a></label>
                                         </div>
                                  </div>
                                  <div class="card-body">
                                      <button class="btn" data-enc="<?=$info->enq;?>" id="paynow_amount" style="width: 100%;padding: 10px;font-size: 20px;background: #AC0F0B;color: #fff;border: 1px solid #AC0F0B;">Pay ₹<?=$info->gross;?>/-</button>
                                  </div>
                            </div>
                </div>
                        <div class="col-md-4"></div>
                      </div>     
                 </div>
            </div>
          </section>
       </main>
    @endsection