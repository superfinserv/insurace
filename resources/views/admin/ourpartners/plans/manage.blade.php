@extends('admin.layout.app')
@section('content')
 
  <div class="card bd-0 ">
    <!--<div class="card-header tx-medium bd-0 tx-white bg-danger">-->
     
    <!--</div><!-- card-header -->
     <div class="card-header bg-danger d-flex   align-items-center justify-content-between pd-y-5">
          <h6 class="mg-b-0 tx-14 tx-white">Manage : <?=$plan->plan_name;?></h6>
          <div class="card-option tx-24">
            <a href="{{url('#')}}" class="btn btn-dark  btn-sm tx-white mg-l-10"><i class="icon ion-arrow-left-a lh-0"></i> Back</a>
           </div><!-- card-option -->
      </div>
    <div class="card-body bd bd-t-0 rounded-bottom">
        
            <form  method="post" enctype="multipart/form-data" action="#" id="plansInfo" >
               <input name="_token" type="hidden" value="{{ csrf_token() }}" />
               <input name="planID" id="planID" type="hidden" value="{{ $plan->id }}" />
               <div class="row">
                    <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                              <label class="form-control-label">Supplier: <span class="tx-danger">*</span></label>
                              <input class="form-control" type="text" id="supp_name" name="supp_name" value="<?=$supp->name;?>" placeholder="Supplier name" readonly>
                            </div>
                       </div>
                       <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                              <label class="form-control-label">Plan Name: <span class="tx-danger">*</span></label>
                              <input class="form-control" type="text" id="plan_name" name="plan_name" value="<?=$plan->plan_name;?>" placeholder="Enter Plan Name">
                            </div>
                       </div>
              
                    <div class="col-lg-3 col-md-3">
                            <div class="form-group" id="file1Area">
                              <label class="form-control-label">Policy wording:<span class="tx-danger">*</span></label>
                              <input class="form-control" type="file" id="policy_wording" name="policy_wording"  placeholder="Choose File" >
                              <span class="help-block"> @if($plan->policy_wording!=""){{$plan->policy_wording}} @endif</span>
                            </div>
                       </div>
                       <div class="col-lg-3 col-md-3">
                            <div class="form-group" id="file2Area">
                              <label class="form-control-label">Policy brochure: <span class="tx-danger">*</span></label>
                              <input class="form-control" type="file" id="policy_brochure" name="policy_brochure" placeholder="Choose File">
                              <span class="help-block"> @if($plan->policy_brochure!=""){{$plan->policy_brochure}} @endif</span>
                            </div>
                       </div>
              </div>
               <div class="row">
                   <div class="col-lg-12 col-md-12">
                         <div class="form-group">
                           <textarea class="form-control desc-editor" name="plan_description" id="plan_description"><?=html_entity_decode($plan->descriptions);?></textarea>
                        </div>
                   </div>
                   
                   
              </div>
               
                <div class="row bd rounded table-responsive">
                    <table class="table table-bordered">
                        <thead class="thead-colored thead-dark">
                            <tr>
                                <th style="width:20%;vertical-align: middle;text-align: center;">Key</th>
                                <th style="width:80%;vertical-align: middle;text-align: center;">Values</th>
                              </tr>  
                        </thead>
                        <tbody>
                            @php $kcnt = 1;@endphp
                              @foreach($planKeys as $pk)
                              @php 
                                $val="";
                                $cnt = DB::table('plans_features')->where('plan_id',$plan->id)->where('features',$pk->key_features)->count();
                              @endphp
                              @if($cnt)
                                  @php
                                     $val = DB::table('plans_features')->where('plan_id',$plan->id)->where('features',$pk->key_features)->value('val');
                                  @endphp
                              @endif
                             
                                <tr>
                                    <th style="vertical-align: middle;text-align: center;">{{$pk->key_features}}</th>
                                    <td><input class="form-control input-fields pk-fields" name="{{$plan->id}}-pk-{{$pk->id}}" id="{{$plan->id}}-pk-{{$pk->id}}" value="{{$val}}"/></td>
                                    
                                </tr>
                              @php $kcnt++; @endphp
                           @endforeach
                        </tbody>
                    </table>
                            
                </div>
                <hr/>
                <div class="row">
                    <div class="col-lg-12 col-md-12 text-right">
                        <button type="button" id="btnupdatePlaninfo" class="btn btn-success">Update</button>
                    </div>
               </div>
             </form>
         </div>
    </div><!-- card-body -->
      
@endsection