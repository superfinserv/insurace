  @extends('pos.layouts.app')
    @section('content')

        <main role="main">
            @if($certification_count)
            <section class="invest-long page-heading-h2">
				<div class="container invest-long-bg" style="padding-top: 16px;">
					
					@if($certification->percentage>=$certification->required_marks)
					<div class="row text-center" style="margin-bottom: 15px;">
					    <div class="col-md-8 col-sm-8"></div>
					    <div class="col-md-2 col-sm-2">
					        <a href="{{url('/get/download/file/test-certificate/'.$certification->file)}}" 
					          class="btn" 
					          style="font-weight:100;background: #AC0F0B;color: #fff;font-size: 15px; padding: 6px 8px;"><i style="font-size: 12px;" class="fa fa-download"></i> Downloads Certificate </a>
					    </div>
					    <div class="col-md-2 col-sm-2"></div>
					    
					</div>
					<div class="row text-center">
    					 <div class="col-md-2 col-sm-2"></div>
    					 <div class="col-md-8 col-sm-8 alig-20">
                               <iframe  class="scrollbar" id="style-1"src="{{asset('/assets/agents/pdf/certificate/'.$certification->file)}}#toolbar=0" width="100%" height="900px">
    					</div>
    					<div class="col-md-2 col-sm-2"></div>
    				</div>
    				
    				  
					@else 
					<h2>Download Study Material And Re-Start Test</h2>
					<div class="row text-center">
					  <div class="col-md-3 col-sm-3"></div>
					  <div class="col-md-3 col-sm-3">
					      <a href="{{url('/get/download/file/traning-material/Training-Material-POSP.pdf')}}" class="btn btn-default btn-lg btn-dfault-amt become-sign-btn" style="width:100%; font-weight:100" download>Download Study Material</a>
					  </div> 
					  <div class="col-md-3 col-sm-3">
					      <button  class="btn btn-default btn-lg btn-dfault-amt become-sign-btn starttest" style="width:100%; font-weight:100">Restart Test </button>
					 </div>
					  <div class="col-md-3 col-sm-3"></div>
					</div>
					@endif
				</div>

			</section>
           @else
		    <section class="invest-long page-heading-h2">
				<div class="container invest-long-bg">
					<h2>Download Study Material And Start Test</h2>
					<div class="row text-center">
    					 <div class="col-md-3 col-sm-3"></div>
    					
    					 <div class="col-md-3 col-sm-3 alig-20">
    					       	<a href="{{url('/get/download/file/traning-material/Training-Material-POSP.pdf')}}" class="btn btn-default btn-lg btn-dfault-amt become-sign-btn" style="width:100%; font-weight:100" download>Download Study Material</a>
    					  </div>
    
    					 <div class="col-md-3 col-sm-3 alig-20">
    
    					    <button  class="btn btn-default btn-lg btn-dfault-amt become-sign-btn starttest" style="width:100%; font-weight:100">Start Test </button>
    					           
    					  </div>
    
    					 <div class="col-md-3 col-sm-3"></div>

					</div>
				</div>

			</section>
       @endif
    </main>
@endsection
 
 