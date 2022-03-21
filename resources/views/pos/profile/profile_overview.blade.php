 @extends('pos.layouts.app')
    @section('content')
     <?php $assetRoot = "https://supersolutions.in/insassets/agents/";?>
        <main role="main">
		    <section class="invest-long ">
				<div class="container invest-long-bg">
					<h2 class="text-center" style="color:#0E3679; font-weight: 600;font-family: 'Quicksand';padding: 11px 1px;">Your Personal information & Relationship Manager Details</h2>
					
					<div class="row text-center">
    					<div class="col-md-3 col-sm-3"></div>
                        <div class="col-md-6 col-sm-6">
                           <div class="card">
                                <div class="card-header" style="background: #AC0F0B;color: #fff;">My Profile</div>
                                <div class="card-body">
                                   <table class="table table-bordered">
                                    <tr><th>Name</th><td>{{ucwords($agent->name)}}</td></tr>
                                    <tr><th>POSP ID</th><td>{{strtoupper($agent->posp_ID)}}</td></tr>
                                    <tr><th>PAN Number</th><td>{{strtoupper($agent->pan_card_number)}}</td></tr>
                                    <tr><th>Aadhar Number</th><td><?=($agent->adhaar_card_number!="")?"XXXX-XXXX-".substr($agent->adhaar_card_number, -4):'-';?></td></tr>
                                    <tr><th>Email</th><td>{{$agent->email}}</td></tr>
                                    <tr><th>Mobile</th><td>{{$agent->mobile}}</td></tr>
                                    
                                     <tr><th>RM Name</th><td>@if(isset($sp)) {{$sp->name}} @else - @endif</td></tr>
                                     <tr><th>RM Number</th><td>@if(isset($sp)){{$sp->mobile}}@else - @endif</td></tr>
                                     <tr><th>RM Email</th><td>@if(isset($sp)){{$sp->email}}@else - @endif</td></tr>
                					
                					
                                   
                                </table>
                                </div>
                                <div class="card-footer text-muted">
                                  	<a href="{{url('/profile')}}" class="btn btn-default btn-lg" style="width:100%; font-weight:100">View Full Profile</a>
                                </div>
                             </div>
                        </div>
                        <div class="col-md-3 col-sm-3"></div>

					</div>
				
				</div>
		   </section>
        </main>

	



    @endsection