 @extends('pos.layouts.app')
    @section('content')
    <main role="main">
      <section class="invest-long page-heading-h3">
		<div class="container">
			<div class="row">
		       <div class="col-md-2 col-sm-2"></div>
		       <div class="col-md-8 col-sm-8 invest-long-bg">
		       	
		       	<div class="row">
		       		<div class="col-md-1"></div>
		       		<div class="col-md-10">
		       		<style type="text/css">
                        .right-ans {
                            color:green;
                            font-size: 15px !important;
                        } 
                        .wrong-ans {
                            color:red;
                            font-size: 15px !important;
                        } 

                        .none-ans {
                            color:#ddd;
                            font-size: 15px !important;
                        }      

                    </style>	
				<div >
                    <?php $i=1;
                     foreach ($certification as $value) {  ?>
                        <h2>{{$i++}}. {{$value->question_en}}</h2>
                       <?php $answers = DB::table('answers')->where('que_id', $value->q_id)->get();?>
                            <ul>
                         <?php foreach ($answers as $ans) {  ?>
                                <li style="font-size: 15px !important;"> 
                                    <?php if($value->ans_id && $ans->id==$value->ans_id && $value->marks>0){?>
                                          <i class="fa fa-check right-ans" ></i>
                                    <?php }else if($value->ans_id && $ans->id==$value->ans_id && $value->marks==0){?>
                                        <i class="fa fa-times wrong-ans" ></i>
                                    <?php }else if($value->ans_id &&  $ans->status==1){?>
                                        <i class="fa fa-check right-ans" ></i>
                                    <?php }else {  ?>
                                        <i class="fa fa-check none-ans" ></i>
                                    <?php } ?>
                                
                                  {{$ans->ans_en}} 
                              </li>
                            <?php } ?>
                            <?php if($value->ans_id==0){?>
                                <li  style=" color:red;font-size: 15px !important;">
                                   Not attempt!
                                </li>
                            <?php } ?>

                           </ul>
                     
                    <?php } ?>
                      
                    
                        <div style="text-align: center;">
                                                     
                        <a  href="{{url('/profile')}}" class="btn btn-default btn-lg btn-dfault-amt become-sign-btn " style="width:25%; font-weight:100; margin-top:30px;">Go to profile</a>
                        
                    </div>
                    </div>
		       		</div>
		       		<div class="col-md-1"></div>
		       		
		       	</div>
		      
		       </div>
		       <div class="col-md-2 col-sm-2"></div>
		      
			</div>
		</div>
	</section>
  </main>
	 

    
    
    
<style>
.text-success {
    color: #28a745 !important;
    border-radius: 50%;
    width: 61px;
    height: 60px;
    margin: 0 auto;
    margin-top: 0px;
}
.progress-bar {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    -ms-flex-pack: center;
    justify-content: center;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    background-color: #dc3545;
    transition: width .6s ease;
}
.progress {
    display: -ms-flexbox;
    display: flex;
    height: 2rem;
    overflow: hidden;
    font-size: 1.75rem;
    font-weight: 600;
    background-color: #e9ecef;
    border-radius: .25rem;
    margin-top: 25px;
}
.invest-long-bg h2 {
    color: #194581 !important;
    font-size: 18px;
    letter-spacing: 0.5px;
    font-weight: 600;
}
section.invest-long.page-heading-h3 h2 {
    padding-top: 35px;
    padding-bottom: 5px;
}
span.ans-wer {
    margin-left: 18px;
    font-size: 16px;
    float: right;
}





[type="radio"]:checked,
[type="radio"]:not(:checked) {
    position: absolute;
    left: -9999px;
}
[type="radio"]:checked + label,
[type="radio"]:not(:checked) + label
{
    position: relative;
    padding-left: 28px;
    cursor: pointer;
    line-height: 20px;
    display: inline-block;
    color: #666;
}
[type="radio"]:checked + label:before,
[type="radio"]:not(:checked) + label:before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    width:28px;
    height:28px;
    border: 1px solid #194581;
    border-radius: 100%;
    background: #fff;
}
[type="radio"]:checked + label:after,
[type="radio"]:not(:checked) + label:after {
    content: '';
    width:20px;
    height:20px;
    background: #e12c30;
    position: absolute;
    top: 4px;
    left: 4px;
    border-radius: 100%;
    -webkit-transition: all 0.2s ease;
    transition: all 0.2s ease;
}
[type="radio"]:not(:checked) + label:after {
    opacity: 0;
    -webkit-transform: scale(0);
    transform: scale(0);
}
[type="radio"]:checked + label:after {
    opacity: 1;
    -webkit-transform: scale(1);
    transform: scale(1);
}
</style>    
    
    
    
    
    
    @endsection