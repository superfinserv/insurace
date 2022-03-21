@extends('admin.layout.app')
@section('content')
  <div class="card bd-0 ">
    <!--<div class="card-header tx-medium bd-0 tx-white bg-danger">-->
     
    <!--</div><!-- card-header -->
     <div class="card-header bg-danger d-flex   align-items-center justify-content-between">
          <h6 class="mg-b-0 tx-14 tx-white">Policy No. : {{$info->policy_no}}</h6>
          
      </div>
     <div class="card-body bd bd-t-0 rounded-bottom">
         <div class="row">
             <div class="col-md-5">
                 <table class="table table-bordered tx-13 tx-gray-700 bd">
                    <thead>
                      <tr class="bg-gray-100 tx-13 tx-uppercase tx-gray-800">
                        <th class="wd-40p">Customer Name</th>
                        <td class="wd-60p">{{$info->customer_name}}</th>
                      </tr>
                      <tr class="bg-gray-100 tx-13 tx-uppercase tx-gray-800">
                        <th class="wd-40p">Customer Mobile</th>
                        <td class="wd-60p">{{$info->mobile_no}}</th>
                      </tr>
                      <tr class="bg-gray-100 tx-13 tx-uppercase tx-gray-800">
                        <th class="wd-40p">Customer Email</th>
                        <td class="wd-60p">-</th>
                      </tr>
                      <tr class="bg-gray-100 tx-13 tx-uppercase tx-gray-800">
                        <th class="wd-40p">Customer DOB</th>
                        <td class="wd-60p">-</th>
                      </tr>
                       <tr class="bg-gray-100 tx-13 tx-uppercase tx-gray-800">
                        <th class="wd-40p">Premium </th>
                        <td class="wd-60p">₹{{$info->amount}}/-</th>
                      </tr>
                       <tr class="bg-gray-100 tx-13 tx-uppercase tx-gray-800">
                        <th class="wd-40p">Policy No </th>
                        <td class="wd-60p">{{$info->policy_no}}</th>
                      </tr>
                      <tr class="bg-gray-100 tx-13 tx-uppercase tx-gray-800">
                        <th class="wd-40p">Transaction ID</th>
                        <td class="wd-60p">{{$info->transaction_no}}</th>
                      </tr>
                      <?php $supplier  =  ($info->provider)?DB::table("our_partners")->where('shortName','=',$info->provider)->value('name'):"Not available";?>
                      <tr class="bg-gray-100 tx-13 tx-uppercase tx-gray-800">
                        <th class="wd-40p">Insurer</th>
                        <td class="wd-60p">{{$supplier}}</th>
                      </tr>
                      <tr class="bg-gray-100 tx-13 tx-uppercase tx-gray-800">
                        <th class="wd-40p">Policy Type</th>
                        <td class="wd-60p">{{$info->type}}</th>
                      </tr>
                      <tr>
                         <th style="text-transform: unset;">Policy</th>
                         <td>
                             @if($info->filename!="")
                              <a href="{{url('/get/download/file/policy-file/'.$info->filename)}}"><div>Download <i class="fa fa-download"></i></div></a>
                             @else
                              <a data-id="{{$info->id}}"  href="#" class="get-policy-doc"><div>Get Policy <i class="fa fa-globe"></i></div></a>
                             @endif
                        </td>
                       </tr>
                        @if($info->type=='HEALTH' && $info->provider=='DIGIT') 
                          <tr>
                             <th style="text-transform: unset;">Proposal</th>
                             <td>
                                 @if($info->proposal!="")
                                 <a  href="{{url('/get/download/file/policy-proposal/'.$info->proposal)}}"><div>Download <i class="fa fa-download"></i></div></a>
                                 @else
                                  <a data-provider="{{$info->provider}}" data-id="{{$info->id}}"  href="#" class="get-policy-doc file-Proposal" href="#"><div>Get Policy <i class="fa fa-globe"></i></div></a>
                                 @endif
                            </td>
                          </tr>
                          <tr>
                             <th style="text-transform: unset;">eCard</th>
                             <td>
                                  @if($info->ecard!="")
                                 <a href="{{url('/get/download/file/policy-receipt/'.$info->ecard)}}"><div>Download <i class="fa fa-download"></i></div></a>
                                @else
                                  <a data-provider="{{$info->provider}}" data-id="{{$info->id}}"  href="#" class="get-policy-doc file-eCard"><div>Get Policy <i class="fa fa-globe"></i></div></a>
                                 @endif 
                                </td>
                          </tr>
                        @elseif($info->type=='HEALTH' && $info->provider=='MANIPAL_CIGNA')
                          <tr>
                             <th style="text-transform: unset;">Receipt</th>
                             <td>
                                 @if($info->receipt!="") 
                                 <a href="{{url('/get/download/file/customer-uploaded-doc/'.$info->receipt)}}"><div>Download <i class="fa fa-download"></i></div></a>
                                @else
                                  <a  data-provider="{{$info->provider}}" data-id="{{$info->id}}"  href="#" class="get-policy-doc receipt"><div>Get Receipt <i class="fa fa-globe"></i></div></a>
                                 @endif 
                             </td>
                          </tr>
                        @endif
                      @if(($info->type=='CAR' || $info->type=='BIKE') && $info->uploaded_doc!="") 
                           <tr>
                             <th style="text-transform: unset;">Uploaded Document</th>
                             <td><a href="{{url('/get/download/file/customer-uploaded-doc/'.$info->uploaded_doc)}}">Download <i class="fa fa-download"></i></a></td>
                           </tr>
                       @endif
                    </thead>
                    </table>
                   @if($info->type=='HEALTH')
                    <table class="table table-bordered bd">
                        <thead>
                            <tr class="bg-gray-100 tx-11 tx-gray-800">
                                <th colspan="2">Member's Info</th>
                            </tr>
                        </thead>
                        <?php $params = json_decode($info->params); 
                             // print_r($params->members);
                              $members = $params->members; $mn =1;?>
                    
                        @foreach($members as $m)
                            <tr class="bg-gray-100 tx-11 tx-gray-800">
                                <th colspan="2">Member - <?=$mn;?> ({{$m->type}}) </th>
                            </tr>
                            <tr>
                               <th style="text-transform: unset;">Name</th>
                               <td><?=($m->type=='self')?$params->selfName:$m->fname.' '.$m->lname;?></td>
                            </tr>
                            <tr>
                               <th style="text-transform: unset;">Date of Birth</th>
                               <td><?=$m->dd.'/'.$m->mm.'/'.$m->yy;?></td>
                            </tr>
                            
                            <tr>
                               <th style="text-transform: unset;">Height</th>
                               <td><?=($m->type=='self')?$params->selfFeet.' feet '.$params->selfInch.' inch':$m->feet.' feet '.$m->inch.' inch';?></td>
                            </tr>
                            <tr>
                               <th style="text-transform: unset;">Weight</th>
                               <td><?=($m->type=='self')?$params->selfWeight:$m->weight;?> Kg</td>
                            </tr>
                            <tr class=" tx-11 tx-gray-800">
                              <th colspan="2" style="text-align: center;">Medical</th>
                            </tr>
                            <?php 
                            if(isset($m->medical) && count($m->medical)){ ?>
                                @foreach($m->medical as $med)
                                <tr>
                                   <th style="text-transform: unset;">{{$med->title}}</th>
                                   <td></td>
                                </tr>
                                @endforeach
                            <?php } ?>
                              
                            <?php $mn++;?>
                        @endforeach
                    </table>
                    
                    <table class="table table-bordered bd">
                        <thead>
                            <tr class="bg-gray-100 tx-11 tx-gray-800">
                                <th colspan="2">Address</th>
                            </tr>
                            
                             <tr>
                                   <th style="text-transform: unset;">Address</th>
                                   <td>{{$params->address->house_no}},{{$params->address->street}}</td>
                             </tr>
                             <tr>
                                   <th style="text-transform: unset;">City</th>
                                   <td><?=explode('-',$params->address->city)[1];?></td>
                             </tr>
                             <tr>
                                   <th style="text-transform: unset;">State</th>
                                   <td><?=explode('-',$params->address->state)[1];?></td>
                             </tr>
                             <tr>
                                   <th style="text-transform: unset;">Pincode</th>
                                   <td>{{$params->address->pincode}}</td>
                             </tr>
                        </thead>
                    </table>
                    @endif
             </div>
             <div class="col-md-7">
                 @if($info->type=='CAR')
                 <?php $jData = json_decode($info->json_data);
                     $covers = $jData->covers;?>
                     
                      <table class="table table-bordered bd">
                        <thead>
                            <tr class="bg-gray-100 tx-11 tx-gray-800">
                                <th colspan="2">Covers</th>
                            </tr>
                            @foreach($covers as $key=>$cover)
                             @if($key!='addons')
                                <tr>
                                   <th style="text-transform: unset;">{{$cover->title}}</th>
                                   <td>₹{{$cover->grossAmt}}</td>
                                </tr>
                             @else
                                 <tr class="bg-gray-100 tx-11 tx-gray-800">
                                    <th colspan="2">Addons</th>
                                </tr>
                                 @foreach($covers->addons as $ad)
                                 <tr>
                                   <th style="text-transform: unset;">{{$ad->title}}<?=isset($ad->insured)?' (₹'.$ad->insured.')':'';?></th>
                                   <td>₹{{$ad->grossAmt}}</td>
                                </tr>
                                 @endforeach
                             @endif
                           @endforeach
                           
                    </thead>
                     </table>
                 
                 @elseif($info->type=='HEALTH')
                   @if($info->product_info!="")
                         <?php $product_info = json_decode($info->product_info); ?>
                           <table class="table table-bordered bd">
                                <thead>
                                    <tr class="bg-gray-100 tx-11 tx-gray-800">
                                        <th colspan="2">Product Info</th>
                                    </tr>
                                     <tr>
                                           <th style="text-transform: unset;">Title</th>
                                           <td>{{$product_info->title}}</td>
                                     </tr>
                                     <tr>
                                           <th style="text-transform: unset;">Zone</th>
                                           <td>{{$product_info->zone}}</td>
                                     </tr>
                                     <tr>
                                           <th style="text-transform: unset;">Policy Type</th>
                                           <td>{{$product_info->policyType}}</td>
                                     </tr>
                                     
                                </thead>
                        </table>
                     @endif 
                     
                     @if($info->premium_info!="")
                         <?php $premium_info = json_decode($info->premium_info);?>
                           <table class="table table-bordered bd">
                                <thead>
                                    <tr class="bg-gray-100 tx-11 tx-gray-800">
                                        <th colspan="2">Premium Info</th>
                                    </tr>
                                     <tr>
                                           <th style="text-transform: unset;">SumInsured</th>
                                           <td>{{$info->sumInsured}}</td>
                                     </tr>
                                     <tr>
                                           <th style="text-transform: unset;">Term </th>
                                           <td>{{$info->termYear}} Year</td>
                                     </tr>
                                     <tr>
                                           <th style="text-transform: unset;">Base Premium</th>
                                           <td>{{$premium_info->Base_Premium}}</td>
                                     </tr>
                                     <tr>
                                           <th style="text-transform: unset;">Tax</th>
                                           <td>{{$premium_info->Total_Tax}}</td>
                                     </tr>
                                     <tr class="bg-gray-100 tx-11 tx-gray-800">
                                        <th colspan="2">Addons</th>
                                    </tr>
                                    <?php  $addonss = $premium_info->Addons; ?>
                                    @foreach($addonss as $ad)
                                         <tr>
                                           <th style="text-transform: unset;">{{$ad->title}}</th>
                                           <td>₹{{$ad->premium}}</td>
                                        </tr>
                                    @endforeach 
                                     <tr> 
                                           <th style="text-transform: unset;">Total</th>
                                           <td>{{$premium_info->Total_Premium}}</td>
                                     </tr>
                                </thead>
                        </table>
                     @endif 
                 @endif
             </div>
         </div>
         
     </div>
    </div>
     

@endsection