<style>
    .table-idv tr td,.table-idv tr th{
      border: 1px solid #ac0f09;
      vertical-align: middle;
    }

    .table-idv tr th{
        font-size: 12px;
        font-weight: 400;
        text-align:center;
        padding:5px;
    }
    
    .table-idv tr th .min-idv,.table-idv tr th .max-idv{
        color:#ac0f0a; 
        font-weight: 600;
    }
    .jconfirm .jconfirm-box div.jconfirm-content-pane .jconfirm-content {
     overflow: initial;
     }
    
    .jconfirm .jconfirm-box div.jconfirm-content-pane.no-scroll {
       overflow-y: scroll;
   }
</style>
<div class="row" style="margin-top: 30px;">
    <div class="col-md-12">
        <table class="table table-idv">
            <tbody>
                <tr><th style="background: #ac0f09;color: #fff;" colspan="2"><h3>Premium Breakup</h3></th></tr>
                    <?php  $covers = $data->covers;
                    foreach($covers as $key=>$cover){
                        if($key!="addons" && $cover->selection===true){?>
                         <tr><th><b><?=$cover->title;?></b></th><td>(+) ₹<?=$cover->netAmt;?>/-</td></tr>
                        <?php  } ?>
                      <?php } ?>
                      <?php foreach($covers->addons as $adon){ ?>
                       <tr><th><b><?=$adon->title;?></b></th><td>(+) ₹<?=$adon->netAmt;?>/-</td></tr>
                      <?php  } ?>
                       <?php foreach($data->discount->discounts as $dis){ 
                          $typ = ($dis->type=='NCB_DISCOUNT')?"NCB":"OTHER";?>
                         <tr><th><b>@if($typ=='NCB')No Claim Bonus ({{$dis->percent}}%) @else Discount @endif ({{$typ}}-{{$dis->percent}}%)</b></th><td>(-) ₹<?=$dis->amount;?>/-</td></tr>
                       <?php }?>
                       <?php
                            echo "<tr><th><b>Service Tax GST(18%)</b></th><td>(+) ₹".$data->tax."/-</td></tr>";
                            echo "<tr><th><b>Final Premium</b></th><td> ₹".$data->gross."/-</td></tr>"; 
                        ?>
        
    </div>
</div>
