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
    
   
    /*td.long { white-space: nowrap; }*/
    div.dataTables_wrapper {
       
        margin: 0 auto;
    }
    
    td,th{width:20%;}
    
    .table tr td.headcol { 
            vertical-align: middle !important;
            font-weight:700 !important;
    }
    
    .table tr td.long{
          font-size: 13px;
          font-weight: 600;
    }
    .product-head{
            background-color: #fff;
            color: #c52d23;
            font-weight: 600;
    }
    .product-features{
            background-color: #fff !important;
            color: #01367b;
            font-weight: 600;
             font-size: 13px;
    }
</style>

<main role="main">
	<section class="invest-long page-heading-h2" style="background: #fff;">
        <div class="container invest-long-bg" style="box-shadow: none;">
            <div class="row" id="page-proposal">
                <div class="col-12 col-md-12 col-lg-12 col-sm-12 ">
                   <div class="ccol-table">
                       <table id="example"  class="table table-bordered row-border order-column" style="width:100%;max-width: 100%;">
                         
                        <thead>
                           
                             <tr>
                               <td  class="headcol">Plan Name</td>
                                <?php foreach($plans as $pln){ ?> 
                                 <td  class="long product-head">{{$pln->plan_name}}</td>
                               <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                          
                           <?php foreach($key_features as $tr){ ?>
                                <tr>
                                     <td class="headcol product-features">{{$tr->features}}</td>
                                     <?php foreach($plans as $pln){ 
                                         $plans_features = DB::table('plans_features')
                                                               ->where('featuresKey',$tr->code)
                                                               ->where('plan_id',$pln->id)->value('val');?>
                                       <td class="long">{{$plans_features}}</td>
                                     <?php } ?>
                                     
                                </tr>
                            <?php } ?>
                       </tbody>
                    </table>
                 </div>
    	    </div>
    </section>

</main>


@endsection