@extends('admin.layout.app')
@section('content')
  <style>
      .dataTables_filter{
          display:none;
      }
      .dataTables_wrapper .dataTables_paginate {
        margin-right: 12px;
      }
      .dataTables_wrapper .dataTables_paginate {
        margin-right: 12px;
      }
      .dataTables_wrapper .dataTables_info {
           margin-left: 12px;
      }
  </style> 
  
  <div class="row row-sm mg-t-20">
          <div class="col-lg-5">
            <div class="card shadow-base bd-0">
              <div class="card-header bg-transparent pd-20">
                <h6 class="card-title tx-uppercase tx-12 mg-b-0">Customer Interest Enquiry</h6>
              </div><!-- card-header -->
              <table id="enq-datatable" class="table table-responsive mg-b-0 tx-12">
                <thead>
                  <tr class="tx-10">
                    <th class="wd-10p pd-y-5">&nbsp;</th>
                    <th class="pd-y-5">Mobile</th>
                    <th class="pd-y-5">Type</th>
                    <th class="pd-y-5">Date</th>
                  </tr>
                </thead>
                <tbody>
                  <!--<tr>-->
                  <!--  <td class="pd-l-20">-->
                  <!--    <img src="../img/img1.jpg" class="wd-36 rounded-circle" alt="Image">-->
                  <!--  </td>-->
                  <!--  <td>-->
                  <!--    <a href="#" class="tx-inverse tx-14 tx-medium d-block">Mark K. Peters</a>-->
                  <!--    <span class="tx-11 d-block">TRANSID: 1234567890</span>-->
                  <!--  </td>-->
                  <!--  <td class="tx-12">-->
                  <!--    <span class="square-8 bg-success mg-r-5 rounded-circle"></span> Email verified-->
                  <!--  </td>-->
                  <!--  <td>Just Now</td>-->
                  <!--</tr>-->
                </tbody>
              </table>
              <div class="card-footer tx-12 pd-y-15 bg-transparent">
                <!--<a href="#"><i class="fa fa-angle-down mg-r-5"></i>Customer Almost to buy</a>-->
              </div><!-- card-footer -->
            </div><!-- card -->
          </div><!-- col-6 -->
          <div class="col-lg-7 mg-t-20 mg-lg-t-0">
            <div class="card shadow-base bd-0">
              <div class="card-header pd-20 bg-transparent">
                <h6 class="card-title tx-uppercase tx-12 mg-b-0">Customer Almost to Purchases</h6>
              </div><!-- card-header -->
              <table id="quote-datatable" class="table table-responsive mg-b-0 tx-12">
                <thead>
                  <tr class="tx-10">
                   <th class="pd-y-5" style="width:25%">Customer</th>
                    <th class="pd-y-5" style="width:25%">Type</th>
                    <th class="pd-y-5" style="width:20%">Partner</th>
                     <th class="pd-y-5" style="width:20%">Date</th>
                    <th class="pd-y-5 tx-center" style="width:10%">Actions</th>
                  </tr>
                </thead>
                <tbody>
                
                  
                </tbody>
              </table>
              <div class="card-footer tx-12 pd-y-15 bg-transparent">
                <!--<a href="#"><i class="fa fa-angle-down mg-r-5"></i>View All Products</a>-->
              </div><!-- card-footer -->
            </div><!-- card -->
          </div><!-- col-6 -->
        </div>
 <!--  <div class="card bd-0 ">-->
    <!--<div class="card-header tx-medium bd-0 tx-white bg-danger">-->
     
    <!--</div><!-- card-header -->
 <!--    <div class="card-header bg-danger d-flex   align-items-center justify-content-between">-->
 <!--         <h6 class="mg-b-0 tx-14 tx-white"> Our Leads</h6>-->
 <!--     </div>-->
 <!--   <div class="card-body bd bd-t-0 rounded-bottom">-->
 <!--        <div class="table-wrapper">-->
          
 <!--           <table id="agent-datatable" class="table display responsive">-->
 <!--             <thead>-->
 <!--               <tr>-->
 <!--                 <th>Title</th>-->
 <!--                 <th>Customer</th>-->
 <!--                 <th>Type</th>-->
 <!--                 <th>Supplier</th>-->
 <!--                 <th>Enquiry</th>-->
 <!--                 <th>Proposal No</th>-->
 <!--                 <th>Proposal Amount</th>-->
 <!--                 <th>Date</th>-->
 <!--                 <th>Status</th>-->
 <!--                 <th>Action</th>-->
 <!--               </tr>-->
 <!--             </thead>-->
 <!--             <tbody></tbody>-->
 <!--           </table>-->
 <!--       </div><!-- table-wrapper -->
 <!--    </div><!-- card-body -->-
 <!--</div>-->
@endsection