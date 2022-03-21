@extends('pos.layouts.app')
  @section('content')
  <style>
      .avatar {
    color: #4d5052;
    font-weight: 600;
    width: 2rem;
    height: 2rem;
    line-height: 2rem;
    border-radius: 50%;
    display: inline-block;
    background: #808488 no-repeat center/cover;
    position: relative;
    vertical-align: bottom;
    font-size: .875rem;
    user-select: none;
}
.table.table_custom tr {
    background: #fff;
}

.table.table_custom {
    border-collapse: separate;
    border-spacing: 0 5px!important;
}
.table.table_custom tr th:first-child, .table.table_custom tr td:first-child {
    border-radius: .55rem 0 0 .55rem;
}

.table.table_custom.border-style tr td {
    border-top: 1px solid #e6e9ed;
    border-bottom: 1px solid #e6e9ed;
    border-left: 1px solid #e6e9ed;
}
.table.table-vcenter td, .table.table-vcenter th {
    vertical-align: middle;
}
.table td, .table th {
    border-color: #e8e9e9;
    font-size: 14px;
}
/*.table.table-hover tbody tr:hover {*/
/*    color: #666a6d;*/
/*}*/
/*.table-hover tbody tr:hover {*/
/*    color: #212529;*/
/*    background-color: #fff;*/
/*}*/


.table.table-hover tbody tr:hover {
    color: #666A6D;
}
.table-hover tbody tr:hover {
    color: #212529;
    background-color: rgba(0,0,0,.075);
}

.card-sale-area .card{
    border: 0;
    box-shadow: 0 7px 2px rgb(3 0 77 / 9%);
    border-radius: .5rem;
}
.card-sale-area .card .p-4 h2{
    font-size: 20px;
    color: #18113c;
    letter-spacing: -.022rem;
    font-family: sans-serif;
    font-weight: 900 !important;
}
.card-sale-area .card .p-4 .span-txt{
    color: #000;
    font-size: 13px;
    font-weight: 600;
}
.card-sale-area .card .p-4 .align-items-center .span-txt2{
    font-size: 14px;
}

.table_custom tbody tr td .amount-text{
    color: #000;
    font-weight: 700;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
    color: #fff !important;
    border: 1px solid #C52118;
    font-size: 14px;
    background-color: #C52118;
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #c52118), color-stop(100%, #C52118));
    background: -webkit-linear-gradient(top, white 0%, #C52118 100%);
    background: -moz-linear-gradient(top, white 0%, #C52118 100%);
    background: -ms-linear-gradient(top, white 0%, #C52118 100%);
    background: -o-linear-gradient(top, white 0%, #C52118 100%);
    background: linear-gradient(to bottom, #c52118 0%, #c52118 100%);
}
.dataTables_wrapper .dataTables_info{
    font-size: 15px;
    color: #0E3679;
}
.dataTables_filter{
    display:none;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.disabled, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active {
    cursor: default;
    color: #1165b2 !important;
    border: 1px solid transparent;
    background: transparent;
    box-shadow: none;
    font-size: 15px;
}
.dataTables_wrapper .dataTables_paginate .paginate_button {
    padding: 1px 10px;
}
  </style>
    <main role="main">
       <section class="become-an-insurance">
               <div class="container">
                   <div class="row">
                       <div class="col-md-3">
                           <div class="form-group">
                                <label for="name" class="h4">Financial  Year</label>
                                <select class="form-control search-input-text" id="table-0" data-column="0" >
                                    <option value="2021-2022" selected>2021-2022</option>
                                    <option value="2020-2021">2020-2021</option>
                                    <option value="2019-2020">2019-2020</option>
                                </select>
                            </div>
                       </div>
                       <div class="col-md-3">
                           <div class="form-group">
                                <label for="name" class="h4">Policy From</label>
                                <select class="form-control search-input-text" id="table-1" data-column="1" >
                                    <option value="">ALL</option>
                                    <option value="DIGIT">Go Digit General Insurance</option>
                                     <option value="MANIPAL_CIGNA">Manipal Cigna Health Insurance</option>
                                     <option value="FGI">Future Generali</option>
                                     <option value="CARE">Care Health Insurance</option>
                                    
                                </select>
                            </div>
                       </div>
                       <div class="col-md-3">
                           <div class="form-group">
                                <label for="name" class="h4">Policy Type</label>
                                <select class="form-control search-input-text" id="table-2" data-column="2" >
                                    <option value="">ALL</option>
                                    <option value="CAR">Car</option>
                                     <option value="BIKE">Two Wheeler</option>
                                     <option value="HEALTH">Health</option>
                                     
                                </select>
                            </div>
                       </div>
                       <div class="col-md-3">
                           <div class="form-group">
                                <label for="name" class="h4">Policy/Trasaction Number</label>
                                <input type="text" class="form-control search-input-text" id="table-3" data-column="3"  Placeholder="Example:65754">
                                    
                            </div>
                       </div>
                   </div>
                   <div class="row card-sale-area" >
						<div class="col-lg-4 col-md-12 col-12">
							<!-- Card -->
							<div class="card mb-4 ">
								<div class="p-4">
									<span class="span-txt font-size-xs text-uppercase font-weight-semi-bold">Total Premium</span>
									<h2 class="mt-4  mb-1 d-flex align-items-center  lh-1">
										₹<span id="TotalSale">{{($TotalSale)?$TotalSale:'0.00'}}</span>
									</h2>
									<?php /*<span class="d-flex justify-content-between align-items-center">
										<span class="span-txt2">Total Earning</span>
										<span class="badge badge-success ml-2">₹203.23</span>
									</span> */?>
								</div>
							</div>
						</div>
						
						<div class="col-lg-4 col-md-12 col-12">
							<!-- Card -->
							<div class="card mb-4">
								<div class="p-4">
									<span class="span-txt font-size-xs text-uppercase font-weight-semi-bold">Premium for {{date('M-Y')}}</span>
									<h2 class="mt-4  mb-1 d-flex align-items-center lh-1">
										₹<span id="MonthSale">{{($MonthSale)?$MonthSale:'0.00'}}</span>
									</h2>
									<?php /*<span class="d-flex justify-content-between align-items-center">
										<span class="span-txt2">Earning for {{date('M-Y')}}</span>
										<span class="badge badge-success ml-2">₹203.23</span>
									</span> */?>
								</div>
							</div>
						</div>

						<div class="col-lg-4 col-md-12 col-12">
							<!-- Card -->
							<div class="card mb-4">
								<div class="p-4">
									<span class="span-txt font-size-xs text-uppercase font-weight-semi-bold">Total No. of Policies YTD/MTD</span>
									<h2 class="mt-4  mb-1 d-flex align-items-center lh-1">
										<span id="TotalSalesCount">{{($TotalSalesCount>100)?'100+':$TotalSalesCount}}/{{$TotalSaleMonthCount}}</span>
									</h2>
									<?php /*<span class="d-flex justify-content-between align-items-center">
										<span class="span-txt2">This month</span>
										<span class="badge badge-info ml-2">{{$TotalSaleMonthCount}}</span>
									</span> */?>
								</div>
							</div>
						</div>
						
					</div>
                  <div class="row ">
                      <div class="col-md-12 col-sm-12">
                           <div class="card" style="background-color: #efebeb;">
                                <div class="card-header" style="background: #AC0F0B;color: #fff;">My Policies</div>
                                <div class="card-body">
                                   <div class="table-responsive" id="tableSalesList">
                                        <table id="myBusinessTable" class="table table-hover table-vcenter text-nowrap table_custom border-style list">
                                            <thead>
                                                <tr>
                                                    <th>Customer</th>
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
                                                <?php /*
                                             @foreach($saleslist as $sale)
                                             <?php $supp =  DB::table('suppliers')->where('short',$sale->provider)->value('name');
                                                   $hasCust =  DB::table('customers')->where('id',$sale->customer_id)->count();
                                                   if($hasCust){
                                                      $Cust =  DB::table('customers')->where('id',$sale->customer_id)->first();
                                                   }?>
                                            <tr class="">
                                                <!--<td class="width35 hidden-xs">-->
                                                <!--   <a href="javascript:void(0);" class="mail-star"><i class="fa fa-star"></i></a>-->
                                                <!--</td>-->
                                                
                                                <td>
                                                    <div><a href="javascript:void(0);">{{ ($hasCust && $Cust->name!="")?$Cust->name:"N/A"}}</a></div>
                                                    <div class="text-muted">{{ ($hasCust)?$Cust->mobile:"N/A"}}</div>
                                                </td>
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
                                            @endforeach */?>
                                          </tbody>
                                        </table>
                                     </div>
                               </div>
                                <div class="card-footer text-muted"></div>
                            </div>
                        </div>
                  </div>
               </div>
        </section>
    </main>
     
     
 @endsection
