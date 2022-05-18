@extends('admin.layout.app')
@section('content')
  <div class="card bd-0 ">
      @include('admin.agents.agents_menu_header')
    <div class="card-body bd bd-t-0 rounded-bottom">
        <div class="row">
            <div class="col-md-3 col-lg-3">@include('admin.agents.agents_menu')</div>
            <?php  $assetUrl = "https://supersolutions.in/insurance/agents/";?>
            <div class="col-md-9 col-lg-9 mg-t-20 mg-lg-t-0-force">
              <div class="agent-identity-notify"></div>
              <div class="row mg-t-20">
                    <div class="col-sm-12 col=ms-12 col-lg-12">
                       
                        <div class="card shadow-base bd-0">
                            
                            <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                                <h6 class="card-title tx-uppercase tx-12 mg-b-0">All attempted certificates</h6>
                              <div class="card-option tx-24">
                                <?php if($agentData->is_tranning_complete=='Yes'){ 
                                        $certification_count = DB::table('certification')->where('agent_id', $agentData->id)->orderBy('id', 'desc')->count();
                                        if($certification_count){
                                            $certification = DB::table('certification')->where('agent_id', $agentData->id)->orderBy('id', 'desc')->first();
                                            $certificate_link=url('/get/download/file/test-certificate/'.$certification->file);
                                            echo (round($certification->obtained_marks)>=50)?'<a href="#" data-id="'.$agentData->id.'" id="regenerate_cert" class="btn btn-dark  btn-sm tx-white mg-l-10"><i class="fas fa-sync-alt lh-0"></i> Regenerate Certificate</a>
                                                                                              <a href="#" class="btn btn-success btn-sm tx-white mg-l-10 ">Passed ('.$certification->obtained_marks.'%)</a>'
                                                                                           :'<a href="#" class="btn btn-success  btn-sm tx-white mg-l-10 take-test" data-id="'.$agentData->id.'"><i class="icon ion-ios-bookmarks-outline lh-0"></i> Take a Test</a>';
                                        }else{
                                           echo '<a href="#" class="btn btn-success take-test  btn-sm tx-white mg-l-10" data-id="'.$agentData->id.'"><i class="icon ion-ios-bookmarks-outline lh-0"></i> Take a Test</a>';
                                        }
                                    }?>
                               
                              </div>
                            </div><!-- card-header -->
                            <div class="card-body"> 
                              
                              <div class="table-wrapper">
                                <table id="agent-certificates-table" class="table display responsive nowrap">
                                  <thead>
                                    <tr>
                                      <th style="width:2%">#</th>
                                      <th style="width:15%">Date</th>
                                      <th style="width:10%">Correct</th>
                                      <th style="width:10%">wrong</th>
                                      <th style="width:10%">Required Marks</th>
                                      <th style="width:10%">Obtained Marks</th>
                                      <th style="width:10%">Status</th>
                                      <th style="width:10%">Certificate</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                      @php($i=1)
                                      @foreach($certificates as $cert)
                                     <?php  $corr = DB::table('certification_results')->where('certification_id',$cert->id)->where('status',1)->count();?>
                                     <?php  $incorr = DB::table('certification_results')->where('certification_id',$cert->id)->where('status',0)->count();?>
                                       <tr>
                                           <td>{{$i}}</td>
                                           <td>{{$cert->date}}</td>
                                           <td class="tx-success">{{$corr}}</td>
                                           <td class="tx-danger">{{$incorr}}</td>
                                           <td class="tx-info">{{$cert->required_marks}}</td>
                                           
                                           <td class="@if($cert->obtained_marks>=50) tx-purple @else tx-orange @endif">{{$cert->obtained_marks}}</td>
                                           <td>
                                               @if($cert->obtained_marks>=50) <span class="bg-success pd-y-3 pd-x-10 tx-white tx-11 tx-roboto">Passed</span> @else <span class="bg-danger pd-y-3 pd-x-10 tx-white tx-11 tx-roboto">Fail</span> @endif
                                           </td>
                                           <?php $cer_link=url('/get/download/file/test-certificate/'.$cert->file);?>
                                           <td>@if($cert->obtained_marks>=50 && $cert->file!="") <a href="{{$cer_link}}" id="download-link" class="mg-r-10 tx-gray">Download</a> @else - @endif</td>
                                           
                                       </tr>
                                        @php($i++)
                                      @endforeach
                                  </tbody>
                                </table>
                            </div><!-- table-wrapper -->
                              
                            </div><!-- card-body -->
                        </div><!-- card -->
                       
                      </div><!-- col6-->
                    </div>
            </div>
        </div>
     </div><!-- card-body -->
 </div>
         
         

      
@endsection