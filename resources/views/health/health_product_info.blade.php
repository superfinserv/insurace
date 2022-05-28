 @extends($layout)
@section('content')
<style>
.partner-logo{
    height: 150px;
    width: 150px;
    border: 1px solid #ccc;
    box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
    padding: 1px 9px;
    border-radius: 50%;
}

.partner-name{
    font-family: "Nunito",sans-serif;
    line-height: 1.3;
    font-weight: 600;
    font-size: 17px !important;
    color: #01357b!important;
}
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
                <div class="col-12 col-md-4 col-lg-4 col-sm-12">
                   <div class="card border-0 sidebar sticky-bar me-lg-4" style="box-shadow: 0px 0px 3px #ccc;">
                            <div class="card-header border-0 py-3 d-flex align-items-center">
                                 <h4 class="card-title text-center mb-1" style="font-weight: 700;font-family: 'Nunito Sans';color:#C52118;">{{$product->partnerName}}</h4>
                            </div>
                            <div class="card-body p-0">
                                <!-- Author -->
                                <div class="text-center">
                                    <div class="mt-4">
                                        <img src="{{asset('assets/partners/'.$product->partnerLogo)}}" class="img-fluid avatar partner-logo rounded-pill shadow-md d-block mx-auto" alt="">

                                        <a href="#" class="partner-name h5 mt-4 mb-0 d-block" >{{$product->partnerName}}</a>
                                        <small class="d-block" style="font-weight: 700;font-family: 'Nunito Sans';color:#C52118;"> {{$product->plan_name}}</small>
                                    </div>
                                </div>
                                <!-- Author -->
                                <div style="padding: 12px;">
                                    <div style="border: 1px solid #ccc; padding: 2px 0px 2px 10px;box-shadow: 0px 0px 1px #ccc;margin-bottom: 10px;">
                                        <h3 style="color: #C52118;font-size: 17px;font-weight: 500;margin-bottom: 0px;">Policy Wording</h3>
                                        <a href="{{url('/get/download/file/policy-word/'.$product->policy_wording)}}" style="font-size: 12px;color: #01357a;">Download</a>
                                    </div>
                                    <div style="border: 1px solid #ccc; padding: 2px 0px 2px 10px;box-shadow: 0px 0px 1px #ccc;margin-bottom: 10px;">
                                        <h4 style="color: #C52118;font-size: 17px;font-weight: 500;margin-bottom: 0px;">Policy Brochure</h4>
                                        <a href="{{url('/get/download/file/policy-word/'.$product->policy_brochure)}}" style="font-size: 12px;color: #01357a;">Download</a>
                                    </div>
                                </div>
                                  <div style="    padding: 12px;">
                                     <a href="{{url('/health-insurance/product-detail/'.$enQ->enquiry_id)}}" style="width: 100%;font-size: 18px;"class="btn btn-ss">Buy Now <i class="mdi mdi-send"></i></a>
                                  </div>
                            </div>
                    </div>
                </div>
                 <div class="col-12 col-md-8 col-lg-8 col-sm-12">
                     <h2>About {{$enQ->title}}</h2>
                   <p><?=html_entity_decode($product->descriptions);?></p>
                   
                    <div>
                                <h3 style="font-size: 16px;font-weight: 700;">Other additional benefits :</h3>
                                <div class="row">
                                    @foreach($features as $each)
                                     @if($each->val!="")
                                     <div class="col-md-4">
                                         <div class="plan-features-box">
                                            
                                             <h4 style="">{{$each->features}} <span data-toggle="tooltip" title="{{$each->val}}" class="fa fa-question-circle" style="float:right;"></span></h4>
                                             <p style="">{{$each->val}}</p>
                                         </div>
                                         
                                     </div>
                                     @endif
                                    @endforeach
                                </div>
                            </div>
                </div>
                
    	    </div>
    </section>

</main>


@endsection