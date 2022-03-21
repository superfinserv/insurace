 @extends($layout)
@section('content')
<style>
.plan-features-box{
            padding: 12px;
            border: 2px solid #0E3679;
            margin-bottom: 15px;
            border-radius: 7px;
            box-shadow: 0px 5px 6px #ccc;
            font-family: 'Nunito Sans';
    }
    .plan-features-box:hover{
            background: #0e367933;
            cursor: pointer;
    }
    .plan-features-box h4{
       font-size: 16px;font-weight: 700;
       /*margin-bottom: 0;*/
        color:#C52118;
    }
    .plan-features-box p{
       margin: 0px;font-size: 12px;
       color:#0E3679;
    }
    
    
    /*Red: #C52118  Blue: #0E3679*/
    .link-buyNow{
        float: right;
    padding: 8px 50px;
    text-align: center;
    background-color: #C52118 !important;
    color: #fff;
    font-size: 17px;
    font-weight: 700;
    font-family: 'Nunito Sans';
    border: 1px solid #C52118;
    border-radius: 8px;
}

    .link-buyNow :hover{
        color:#fff !important;
    }
</style>

<main role="main">
	<section class="invest-long page-heading-h2" style="background: none;">
        <div class="container invest-long-bg" style="box-shadow: none;">
            <div class="row" id="page-proposal">
                <div class="col-12 col-md-12 col-lg-12 col-sm-12">
                    <div class="card">
                        <div class="card-header border-0 py-3 d-flex align-items-center">
                            <img src="{{$plan->supp_logo}}" style="width: 100px;" class="rounded-circle align-self-start mr-3">
                            <div>
                                <h4 class="card-title mb-1" style="font-weight: 700;font-family: 'Nunito Sans';color:#C52118;">{{$plan->supp_name}}</h4>
                                <h6 class="card-subtitle" style="color:#0E3679; font-weight: 600;">{{$enQ->title}}</h6>
                            </div>
                            
                            <span class="ml-auto px-4"><a  class="link-buyNow"  href="{{url('/health-insurance/product-detail/'.$enQ->enquiry_id)}}">Buy Now</a></span>
                            
                             
                        </div>
                        
                        <div class="card-body" style="padding:6px;">
                            <div style="width:100%;"><?=html_entity_decode($data->descriptions);?></div>
                            <hr/>
                            <div>
                                <h3 style="font-size: 16px;font-weight: 700;">Other additional benefits :</h3>
                                <div class="row">
                                    @foreach($features as $each)
                                     @if($each->val!="")
                                     <div class="col-md-4">
                                         <div class="plan-features-box">
                                             <?php $description= DB::table('plan_key_features')->where('key_features',$each->features)->value('description'); ?>
                                             <h4 style="">{{$each->features}} <span data-toggle="tooltip" title="{{$description}}" class="fa fa-question-circle" style="float:right;"></span></h4>
                                             <p style="">{{$each->val}}</p>
                                         </div>
                                         
                                     </div>
                                     @endif
                                    @endforeach
                                </div>
                            </div>
                            
                            
                        </div>
                        
                    </div>
                </div>
    	</div>
    </section>

</main>


@endsection