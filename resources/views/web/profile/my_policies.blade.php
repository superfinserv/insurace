@extends('web.layout.app')
    @section('content')
    <style>
        .table.dataTable tbody th, table.dataTable tbody td{
            font-weight: 500;
            font-size: 14px;
            color: #000;
        }
        .nav-pills .nav-link.active {
                color: #fff;
                background-color: #0e3679 !important;
            }
     .nav-pills .nav-link {
         color:#fff !important;
     }
     .nav-pills>.nav-item>.nav-link:hover{
         color:#AC0F0B !important;
     }
     
     .nav-pills>.nav-item>.nav-link.active:hover{
         color:#FFF !important;
     }
    </style>
    
    <!--<div class=""><a href="#">Ram Kumar</a></div>-->
    <!--                                         <div class=""><span>SF/SP/A10001</span></div>-->
    <main role="main" >
	<section class="section" style="padding-top: 80px;">
             <div class="row ">
                      <div class="col-md-12 col-sm-12">
                           <div class="card" style="">
                                <div class="card-header" style="background: #AC0F0B;color: #fff;">
                                  <ul class="nav nav-pills card-header-pills">
                                          <li class="nav-item">
                                            <a class="nav-link active" href="{{url('/my-policies')}}">My Policies</a>
                                          </li>
                                          <li class="nav-item">
                                            <a class="nav-link" href="{{url('/my-applications')}}">Resume Applications</a>
                                          </li>
                                        </ul>
                                </div>
                                <div class="card-body">
                                   <div class="table-responsive" id="tableSalesList">
                                        <table id="myBusinessTable" class="table table table-bordered table-striped table-hover table-vcenter text-nowrap table_custom border-style list">
                                            <thead>
                                                <tr>
                                                   
                                                    <th>Policy No</th>
                                                    <th>Date</th>
                                                    @if($isPOSP)
                                                     <th>Customer</th>
                                                    @endif
                                                    @if($isSP)
                                                        <th>Customer</th>
                                                        <th>POSP</th> 
                                                    @endif
                                                    
                                                    <th>Amount</th>
                                                    <th>Transaction No</th>
                                                    <th>Policy</th>
                                                    
                                                    <th>#</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            
                                             @foreach($polices as $sale)
                                             <?php //$supp =  DB::table('our_partners')->where('shortName',$sale->provider)->value('name'); ?>
                                            <tr class="">
                                                <td class="hidden-xs">
                                                   <div class=""><a href="javascript:void(0);">{{$sale->policy_no}}</a></div>
                                                </td>
                                                 <td class="hidden-xs">
                                                   <div class="amount-text">{{createFormatDate($sale->date,'Y-m-d H:i:s','d/m/Y')}}</div>
                                                </td>
                                                @if($isPOSP)
                                                    <td class="hidden-xs">
                                                         <div class=""><a href="#">{{$sale->customer_name}}</a></div>
                                                         <div class=""><span>{{$sale->mobile_no}}</span></div>
                                                    </td>
                                                @endif
                                                 @if($isSP)
                                                    <td class="hidden-xs">
                                                         <div class=""><a href="#">{{$sale->customer_name}}</a></div>
                                                         <div class=""><span>{{$sale->mobile_no}}</span></div>
                                                    </td>
                                                 <?php
                                                   $pospName = "N/A"; $pospID = "N/A";
                                                 if($sale->agent_id) { 
                                                        $isPospExist = DB::table('agents')->where('id',$sale->agent_id)->count();
                                                            if($isPospExist){
                                                                $posp= DB::table('agents')->select('name','posp_ID')->where('id',$sale->agent_id)->first();
                                                                $pospName =$posp->name;  $pospID = $posp->posp_ID;
                                                            }
                                                        }
                                                     ?>
                                                    <td class="hidden-xs">
                                                         <div class=""><a href="#">{{$pospName}}</a></div>
                                                         <div class=""><span>{{$pospID}}</span></div>
                                                    </td>
                                                @endif
                                                
                                                <td class="hidden-xs">
                                                   <div class="amount-text">₹{{$sale->amount}}</div>
                                                </td>
                                               
                                                <td class="hidden-xs">
                                                   <div class="">{{$sale->transaction_no}}</div>
                                                </td>
                                                 
                                                <td class="hidden-xs">
                                                     <div class=""><a href="#">{{$sale->partnerName}}</a></div>
                                                     <div class=""><span>{{$sale->type}}</span></div>
                                                </td>
                                                
                                               <td class="hidden-xs text-center">
                                                   <div class="" id="actionPolicy-td-{{$sale->id}}" >
                                                       @if($sale->filename!="")
                                                       <a download="{{url('get/download/file/policy-file/'.$sale->filename)}}" target="_self" href="{{url('get/download/file/policy-file/'.$sale->filename)}}">Download</a>
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
                                <div class="card-footer "></div>
                            </div>
                        </div>
                  </div>
    </section>
   </main>
 @endsection