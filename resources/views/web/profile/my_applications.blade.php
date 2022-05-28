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
                                            <a class="nav-link " href="{{url('/my-policies')}}">My Policies</a>
                                          </li>
                                          <li class="nav-item">
                                            <a class="nav-link active" href="{{url('/my-applications')}}">Resume Applications</a>
                                          </li>
                                        </ul>
                                </div>
                                <div class="card-body">
                                   <div class="table-responsive" id="tableSalesList">
                                        <table id="myBusinessTable" class="table table table-bordered table-striped table-hover table-vcenter text-nowrap table_custom border-style list">
                                            <thead>
                                                <tr>
                                                   
                                                    
                                                    <th>Date</th>
                                                    @if($isPOSP)
                                                     <th>Customer</th>
                                                    @endif
                                                    @if($isSP)
                                                        <th>Customer</th>
                                                        <th>POSP</th> 
                                                    @endif
                                                    
                                                    <th>Premium</th>
                                                    <th>Policy</th>
                                                    
                                                    <th>#</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            
                                             @foreach($polices as $sale)
                                             <?php //$supp =  DB::table('our_partners')->where('shortName',$sale->provider)->value('name'); ?>
                                            <tr class="">
                                                
                                                 <td class="hidden-xs">
                                                   <div class="amount-text">{{createFormatDate($sale->created_at,'Y-m-d H:i:s','d/m/Y')}}</div>
                                                </td>
                                                @if($isPOSP)
                                                    <td class="hidden-xs">
                                                         <div class=""><a href="#">{{$sale->customer_name}}</a></div>
                                                         <div class=""><span>{{$sale->customer_mobile}}</span></div>
                                                    </td>
                                                @endif
                                                 @if($isSP)
                                                    <td class="hidden-xs">
                                                         <div class=""><a href="#">{{$sale->customer_name}}</a></div>
                                                         <div class=""><span>{{$sale->customer_mobile}}</span></div>
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
                                                   <div class="amount-text">₹{{$sale->premiumAmount}}</div>
                                                </td>
                                               
                                                
                                                 
                                                <td class="hidden-xs">
                                                     <div class=""><a href="#">{{$sale->partnerName}}</a></div>
                                                     <div class=""><span>{{$sale->type}}</span></div>
                                                </td>
                                                
                                               <td class="hidden-xs text-center">
                                                   <div class="" id="actionPolicy-td-{{$sale->id}}" >
                                                       <?php $URL ="#";
                                                       if($sale->type=="HEALTH"){ 
                                                           $URL = "health-insurance/product-detail/".$sale->enquiry_id;
                                                        }else if($sale->type=="CAR"){
                                                           $URL = "car-insurance/users-information/".$sale->enquiry_id;
                                                       }else if($sale->type=="BIKE"){
                                                           $URL = "twowheeler-insurance/users-information/".$sale->enquiry_id;
                                                       }?>
                                                       <a  href="{{url($URL)}}" target="_self" class="btn btn-primary">BUY NOW</a>
                                                       
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