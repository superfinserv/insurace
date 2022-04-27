@extends('web.layout.app')
    @section('content')
    <main role="main" >
	<section class="section" style="padding-top: 80px;">
             <div class="row ">
                      <div class="col-md-12 col-sm-12">
                           <div class="card" style="background-color: #efebeb;">
                                <div class="card-header" style="background: #AC0F0B;color: #fff;">My Policies</div>
                                <div class="card-body">
                                   <div class="table-responsive" id="tableSalesList">
                                        <table id="myBusinessTable" class="table table-hover table-vcenter text-nowrap table_custom border-style list">
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Amount</th>
                                                    <th>Policy No</th>
                                                    <th>Transaction No</th>
                                                    <th>Policy From</th>
                                                    <th>Policy For</th>
                                                    <th>Payment Status</th>
                                                    <th>Policy Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            
                                             @foreach($polices as $sale)
                                             <?php $supp =  DB::table('our_partners')->where('shortName',$sale->provider)->value('name'); ?>
                                            <tr class="">
                                                
                                                 <td class="hidden-xs">
                                                   <div class="amount-text">{{createFormatDate($sale->date,'Y-m-d H:i:s','d/m/Y')}}</div>
                                                </td>
                                                <td class="hidden-xs">
                                                   <div class="amount-text">₹{{$sale->amount}}</div>
                                                </td>
                                                <td class="hidden-xs">
                                                   <div class="text-muted"><a href="javascript:void(0);">{{$sale->policy_no}}</a></div>
                                                </td>
                                                <td class="hidden-xs">
                                                   <div class="text-muted">{{$sale->transaction_no}}</div>
                                                </td>
                                                 <td class="hidden-xs">
                                                   <div class="text-muted">{{$supp}}</div>
                                                </td>
                                                <td class="hidden-xs">
                                                   <div class="text-muted">{{$sale->type}}</div>
                                                </td>
                                                <td class="hidden-xs">
                                                    <div class="text-muted">{{$sale->policy_status}}</div>
                                                </td>
                                                <td class="hidden-xs">
                                                   <div class="text-muted">{{$sale->payment_status}}</div>
                                                </td>
                                               <td class="hidden-xs text-center">
                                                   <div class="text-muted" id="actionPolicy-td-{{$sale->id}}" >
                                                       @if($sale->filename!="")
                                                       <a href="{{url('get/download/file/policy-file/'.$sale->filename)}}">Download</a>
                                                       @else
                                                       <a href="#" data-id="{{$sale->id}}" class="getPolicyPdf">Get Pdf</a>
                                                       @endif
                                                    </div>
                                                </td>
                                               
                                            </tr>
                                            @endforeach 
                                          </tbody>
                                        </table>
                                     </div>
                               </div>
                                <div class="card-footer text-muted"></div>
                            </div>
                        </div>
                  </div>
    </section>
   </main>
 @endsection