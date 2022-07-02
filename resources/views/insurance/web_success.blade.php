 <?php $host = request()->getHttpHost(); //@extends('web.layout.app')?>
 @extends(($host=="superfinserv.co.in") ? 'web.layout.app' : 'pos.layouts.app')
 @section('content')
<style>
    .ribbon{
  font-size:20px;
  position:relative;
  display:inline-block;
  /*margin:5em;*/
  text-align:center;
}
.text{
  display:inline-block;
  padding:0.5em 1em;
  min-width:20em;
  line-height:1.2em;
     background: #c52118;
    position: relative;
    color: #fff;
}
.ribbon:after,.ribbon:before,
.text:before,.text:after,
.bold:before{
  content:'';
  position:absolute;
  border-style:solid;
}
.ribbon:before{
  top:0.3em; left:0.2em;
  width:100%; height:100%;
  border:none;
  background:#EBECED;
  z-index:-2;
}
.text:before{
  bottom:100%; left:0;
  border-width: .5em .7em 0 0;
  border-color: transparent #C52118 transparent transparent;
}
.text:after{
  top:100%; right:0;
  border-width: .5em 2em 0 0;
  border-color: #C52118 transparent transparent transparent;
}
.ribbon:after, .bold:before{
  top:0.5em;right:-2em;
  border-width: 1.1em 1em 1.1em 3em;
  border-color: #FECC30 transparent #FECC30 #FECC30;
  z-index:-1;
}
.bold:before{
  border-color: #EBECED transparent #EBECED #EBECED;
  top:0.7em;
  right:-2.3em;
}


.page-success .card .card-header{
    text-align: center;
    font-size: 35px;
    color: #C52118;
    font-weight: 500;
    background: #fff;
}

.page-success .card .card-body{
    /*background: #0e36793d;*/
}

.page-success .card .card-body .table td {
    border-top:none;
    font-weight: 500;
    font-size: 18px;
}

.page-success .card .card-body img {
    max-width: 50%;
    display: block;
    margin: 0 auto;
}
.page-success .card .s-btn{
    padding: 3px 10px;
    background: #0E3679;
    border: 1px solid #0E3679;
    color: #fff;
    font-size: 16px;
}

.success-line{
    color:#0E3679;
    font-size: 20px;
    font-weight: 600;
}
.page-success .card .card-body .transaction-box{
    border: 1px solid #f6f4f4;
    padding: 19px;
    box-shadow: 0px 0px 5px #f6f4f4;
}

.com-box h4{
        color: #C52118;
    font-size: 20px;
    font-weight: 700;
    font-family: 'Nunito Sans';
}
.com-box p{
     margin-top: 0px;
    font-size: 14px;
    font-weight: 600;
    color: #0E3679;
}
.com-box{
        border-top: 1px solid #ccc;
    border-bottom: 1px solid #ccc;
    padding: 14px 0px;
}

@media only screen and (max-width: 600px) {
  .text {
    min-width: 13em;
}
	table, thead, tbody, th, td, tr { 
		display: block; 
	}
	
	/* Hide table headers (but not display: none;, for accessibility) */
	thead tr { 
		position: absolute;
		top: -9999px;
		left: -9999px;
	}
	
	tr { border: 1px solid #ccc; }
	
	td { 
		/* Behave  like a "row" */
		border: none;
		border-bottom: 1px solid #eee; 
		position: relative;
		padding-left: 50%; 
	}
	
	td:before { 
		/* Now like a table header */
		position: absolute;
		/* Top/left values mimic padding */
		top: 6px;
		left: 6px;
		width: 45%; 
		padding-right: 10px; 
		white-space: nowrap;
	}
	.page-success .card .card-header{
	    font-size: 25px;
	}
}
</style>

<!--ESWCADS60-->

<main role="main">
 
  
  
   <section class="term-smoke ptb page-success">

    <div class="container">
        
        <?php  $param = json_decode($data->params);
               $jd= json_decode($data->json_data);
              ?>
        <div class="card">
            <header class="card-header">Transaction Successful</header>
            <div class="card-body">
                <div class="row ">
                 <div class="col-md-2 col-sm-12">
                      <!--<img  src="{{asset('site_assets/img/pay-success.png')}}" class="center" alt="" />-->
                      <!--<p class="text-center success-line">We are delighted to inform you that we have received your payment</p>-->
                    </div>
                  <div class="col-md-8 col-sm-12">
                      <div class="text-center transaction-box">
                      <p class="ribbon">
                          <span class="text"><strong class="bold">Transaction Details:</strong></span>
                     </p>
                     
                         <table class="table">
                             @if($data->type=='CAR' || $data->type=='BIKE')
                             <tr>
                                 <td>Plan Name</td>
                                 <td style="color: #000;">
                                     
                                     <?php $typ = ($data->type=='CAR')?'Pvt Car Insurance':'Two wheeler Insurance';?>
                                      @if($data->policyType=="COM")
                                       {{$typ}} - Comprehensive 
                                     @elseif($data->policyType=="TP")
                                       {{$typ}} - Third Party
                                      @elseif($data->policyType=="SAOD")
                                      {{$typ}} - Standalone Own Damage
                                     @endif
                                     </td>
                             </tr>
                             <tr>
                                 <td>Registration No</td>
                                 <td style="color: #000;">
                                     @if($param->vehicle->isBrandNew=="true")
                                       NEW - {{$param->vehicle->rtoCode}}
                                     @else
                                       {{$param->vehicle->vehicleNumber}}
                                     @endif
                                  </td>
                             </tr>
                             @else
                             <tr>
                                 <td>Plan Name</td>
                                 <td style="color: #000;">{{$jd->title}}</td>
                             </tr>
                             <tr>
                                 <td>Sum Insured:</td>
                                 <td style="color: #000;">{{$jd->sumInsured}} Lakhs</td>
                             </tr>
                              
                             @endif
                             <tr>
                                 <td>Transaction No:</td>
                                 <td style="color: #000;">#<?=$trno;?></td>
                             </tr>
                             @if($data->provider=='MANIPAL_CIGNA')
                             
                              <tr>
                                 <td>Proposal No. :</td>
                                 <td style="color: #000;">{{$data->proposalNumber}}</td>
                             </tr>
                             @endif
                              <tr>
                                 <td>Policy Number:</td>
                                 @if($data->policy_status=='Pending')
                                   <td style="color: #000;">Your policy is Pending <a id="getPolicyStatus" data-enq="{{$data->enquiry_id}}" href="#">Click here to get status</a> </td>
                                 @else
                                   <td style="color: #000;">#<?=$policyno;?></td>
                                 @endif
                             </tr>
                             <tr>
                                 <td>Amount Paid:</td>
                                 <td style="color: #000;">₹{{$data->amount}}/-</td>
                             </tr>
                             <tr>
                                 <td>Timestamp:</td>
                                 <?php  $date=date_create($data->date);?>
                                 <td style="color: #000;">{{date_format($date,"d M,Y h:i:A")}}</td>
                             </tr>
                             <tr>
                                 <td>Insurer:</td>
                                 <td style="color: #000;">{{$insurer}}</td>
                             </tr>
                            
                             @if($data->provider=='MANIPAL_CIGNA' && $data->type=='HEALTH')
                               <tr>
                                 <td>Transaction Receipt:</td>
                                 <td style="color: #000;" id="ReceiptDocTd">
                                     <?php if($data->receipt!=""){ ?>
                                     <a  style="color:#C52118" target="_blank" href="{{url('/get/download/file/policy-receipt/'.$data->receipt)}}">
                                          <i style="font-size: 16px;" class="fa fa-download"></i>
                                          Download Transaction Receipt
                                      </a>
                                      <?php  }else{?>
                                        <!--<p>For your policy document contact to administrator.</p>-->
                                        <a href="#" id="getPolicyDoc" data-opt="Receipt" data-id="{{$data->id}}">Click here to get transaction Recipt</a>
                                        
                                     <?php } ?>
                                </td>
                             </tr>
                             
                              <tr>
                                 <td>Policy Document:</td>
                                 <td style="color: #000;" id="PolicyDocTd">
                                     <?php if($filename!=""){ ?>
                                     <a  style="color:#C52118" target="_blank" href="{{url('/get/download/file/policy-file/'.$filename)}}">
                                          <i style="font-size: 16px;" class="fa fa-download"></i>
                                          Download Policy PDF
                                      </a>
                                      <?php  }else{?>
                                        <!--<p>For your policy document contact to administrator.</p>-->
                                        <a href="#" id="getPolicyDoc" data-opt="Policy" data-id="{{$data->id}}">Click here to get policy document</a>
                                        
                                     <?php } ?>
                                </td>
                             </tr>
                             
                             @else
                             <tr>
                                 <td>Policy Document:</td>
                                 <td style="color: #000;" id="PolicyDocTd">
                                     <?php if($data->filename!=""){ ?>
                                     <a  style="color:#C52118" target="_blank" href="{{url('/get/download/file/policy-file/'.$filename)}}">
                                          <i style="font-size: 16px;" class="fa fa-download"></i>
                                          Download Policy PDF
                                      </a>
                                      <?php  }else{?>
                                        <!--<p>For your policy document contact to administrator.</p>-->
                                         <a href="#" id="getPolicyDoc" data-opt="Policy" data-id="{{$data->id}}">Click here to get policy document</a>
                                        
                                     <?php } ?>
                                </td>
                             </tr>
                             @endif
                             @if($data->provider=='DIGIT' && $data->type=='HEALTH')
                              <tr>
                                 <td>Policy Proposal:</td>
                                 <td style="color: #000;" id="ProposalDocTd">
                                     <?php if($data->proposal!=""){ ?>
                                     <a  style="color:#C52118" target="_blank" href="{{url('/get/download/file/policy-proposal/'.$data->proposal)}}">
                                          <i style="font-size: 16px;" class="fa fa-download"></i>
                                          Download Policy Proposal
                                      </a>
                                      <?php  }else{?>
                                        <a href="#" id="getPolicyDoc" data-opt="Proposal" data-id="{{$data->id}}">Click here to get transaction Recipt</a>
                                     <?php } ?>
                                </td>
                             </tr>
                              <tr>
                                 <td>Policy eCard:</td>
                                 <td style="color: #000;" id="eCardDocTd">
                                     <?php if($data->ecard!=""){ ?>
                                     <a  style="color:#C52118" target="_blank" href="{{url('/get/download/file/policy-ecard/'.$data->ecard)}}">
                                          <i style="font-size: 16px;" class="fa fa-download"></i>
                                          Download Policy eCard
                                      </a>
                                      <?php  }else{?>
                                         <a href="#" id="getPolicyDoc" data-opt="eCard" data-id="{{$data->id}}">Click here to get transaction Recipt</a>
                                     <?php } ?>
                                </td>
                             </tr>
                             @endif
                             
                             
                         </table>
                         <div class="com-box">
                             <h4>{{config('custom.site_short_name')}} customer care</h4>
                             <p>{{config('custom.contact_phone')}}, {{config('custom.contact_email')}} </p>
                         </div>
                     </div>
                  </div>
                  <div class="col-md-2 col-sm-12"></div>
                </div>
            </div>
            <div class="card-footer text-center">
                @if($isAgent)
                   <a class="btn s-btn" href="{{url('/create/quote')}}">Continue</a>
                 @else
                   <a  class="btn s-btn" href="{{url('/')}}">Back to Home</a>
                 @endif
            </div>
        </div>
      
        
     
  </div>

   
</section>

</main>

@endsection