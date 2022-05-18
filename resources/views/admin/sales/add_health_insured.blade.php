@extends('admin.layout.app')
@section('content')
   <style>
       .table input.form-control{
           border-radius: 0px;
           height: calc(2.6125rem + 8px);
           border: 0;
       }
       .table td{
                color: #574f4f;
                font-size: 12px;
       }
       
       .has-error{
           border: 1px solid #c71a1a !important;
       }
       .has-error input{
           color:#c71a1a;
       }
   </style>
  <div class="card bd-0 ">
    <!--<div class="card-header tx-medium bd-0 tx-white bg-danger">-->
     
    <!--</div><!-- card-header -->
     <div class="card-header bg-danger d-flex   align-items-center justify-content-between pd-y-5">
          <h6 class="mg-b-0 tx-14 tx-white">{{$subtitle}}</h6>
          <div class="card-option tx-24">
            <a href="{{url('/sales/insured')}}" class="btn btn-dark  btn-sm tx-white mg-l-10"><i class="icon ion-arrow-left-a lh-0"></i> Back</a>
           </div><!-- card-option -->
      </div>
    <div class="card-body bd bd-t-0 rounded-bottom">
            <div class="agent-register-notify"></div>
            <form class="form-group" method="post" enctype="multipart/form-data" action="#" id="HealthInsuredForm" >
               <input name="_token" type="hidden" value="{{ csrf_token() }}" />
               <input name="param" type="hidden" value="health" />
                           <div class="row">
                                <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                      <label class="form-control-label">Policy No: <span class="tx-danger">*</span></label>
                                      <input class="form-control" type="text" id="policy_no" name="policy_no" value="" placeholder="">
                                    </div>
                               </div>
                                <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                      <label class="form-control-label">Transaction No:</label>
                                      <input class="form-control" type="text" id="tranaction_no" name="tranaction_no" value="" placeholder="">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                      <label class="form-control-label">Customer Name: <span class="tx-danger">*</span></label>
                                      <input class="form-control" type="text" name="customer_name" id="customer_name" value="" placeholder="">
                                    </div>
                               </div>
                    
                                <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                      <label class="form-control-label">Customer Mobile: <span class="tx-danger">*</span></label>
                                      <input class="form-control" type="text" id="customer_no" name="customer_no" value="" placeholder="">
                                    </div>
                               </div>
                         </div>
                          
                           <div class="row">
                                 <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                      <label class="form-control-label">Insurer: <span class="tx-danger">*</span></label>
                                      <select class="form-control select2-show-search" data-placeholder="Choose one" name="insPartner" id="insPartner">
                                         <option value="">Choose Insurer</option>
                                         @foreach ($insurer as $r)
                                           <option value="{{$r->shortName}}">{{$r->name}}</option>
                                         @endforeach
                                      </select>
                                    </div>
                               </div>
                                <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                      <label class="form-control-label">Policy Plan name: <span class="tx-danger">*</span></label>
                                      <select class="form-control select2-show-search" data-placeholder="Choose one" name="policyPlan" id="policyPlan">
                                         <option value="">Choose Plan</option>
                                      </select>
                                    </div>
                               </div>
                              <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                      <label class="form-control-label">Policy Start Date: <span class="tx-danger">*</span></label>
                                      <input class="form-control" type="text" id="startDate" name="startDate" value="" placeholder="">
                                    </div>
                               </div>
                               <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                      <label class="form-control-label">Policy End Date: <span class="tx-danger">*</span></label>
                                      <input class="form-control" type="text" id="endDate" name="endDate" value="" placeholder="">
                                    </div>
                               </div>
                               
                        </div>
                    
                       <div class="row">
                               <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                      <label class="form-control-label">Policy Type: <span class="tx-danger">*</span></label>
                                       <select class="form-control select2-show-search" data-placeholder="Choose one" name="policyType" id="policyType">
                                            <option value="">Choose</option>
                                            <option value="FL">Floater</option>
                                            <option value="IN">Individual</option>
                                        </select>
                                    </div>
                               </div>
                               <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                      <label class="form-control-label">Login Date: <span class="tx-danger">*</span></label>
                                      <input class="form-control" type="text" id="loginDate" name="loginDate" value="" placeholder="">
                                    </div>
                               </div>
                              
                              <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                      <label class="form-control-label">POSP: <span class="tx-danger">*</span></label>
                                       <select class="form-control select2-show-search" data-placeholder="Choose one" name="pospId" id="pospId">
                                         <option value="">Choose</option>
                                         @foreach ($posps as $posp)
                                           <option value="{{$posp->id}}">{{$posp->name}} ({{$posp->posp_ID}}) [{{$posp->userType}}]</option>
                                         @endforeach
                                      </select>
                                    </div>
                               </div>
                               
                         </div>
                      <div class="row row mg-t-20">
                             
                               
                               <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                      <label class="form-control-label">Total Net<span class="tx-danger">*</span></label>
                                      <input class="form-control" type="text" id="total_net" name="total_net" value=""  placeholder="">
                                    </div>
                               </div>
                               <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                      <label class="form-control-label">Total Tax<span class="tx-danger">*</span></label>
                                      <input class="form-control" type="text" id="total_tax" name="total_tax" value=""  placeholder="">
                                    </div>
                               </div>
                               <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                      <label class="form-control-label">Total Gross<span class="tx-danger">*</span></label>
                                      <input class="form-control" type="text" id="total_gross" name="total_gross" value=""  placeholder="">
                                    </div>
                               </div>
                                
                                <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                      <label class="form-control-label">Policy Copy<span class="tx-danger">*</span></label>
                                      <input class="form-control" type="file" id="policyFile" name="policyFile" value="" placeholder="">
                                    </div>
                                </div>
                           </div>
                           
                           <div class="row row mg-t-20">
                                <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                      <label class="form-control-label">Term Year: <span class="tx-danger">*</span></label>
                                       <select class="form-control select2-show-search" data-placeholder="Choose one" name="termYear" id="termYear">
                                         <option value="">Choose</option>
                                          <option value="1">1 Year</option>
                                          <option value="2">3 Year</option>
                                          <option value="3">3 Year</option>
                                        </select>
                                    </div>
                               </div>
                               <?php  $arraySum = [2,3,4,4.5,5,7,8,9,10,12,15,20,25,30,40,50,60,75,100];?>
                               <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                      <label class="form-control-label">Sum Insured: <span class="tx-danger">*</span></label>
                                       <select class="form-control select2-show-search" data-placeholder="Choose one" name="sumInsured" id="sumInsured">
                                          <option value="">Choose</option>
                                          @foreach($arraySum as $sum)
                                          @php  $opt = ($sum==100)?'1 Cr':$sum.' Lakhs';  @endphp
                                          <option value="{{$sum}}">{{$opt}}</option>
                                          @endforeach
                                        </select>
                                    </div>
                               </div>
                               
                                <div class="col-lg-3 col-md-3">
                                   <button class="btn btn-primary savepolicyInfoBtn" style="margin-top:28px;" type="submit">Save</button>
                                </div>
                            </div>
                    
                
            </form>
         </div>
    </div><!-- card-body -->

@endsection