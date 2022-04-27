  @extends($layout)
    @section('content')
    <style>
.planInfo-card{
    box-shadow: 0 2px 4px 0 rgba(0,0,0,.2), 0 -1px 0 0 rgba(0,0,0,.03);
}
.table-planInfo tr:last-child td,.table-planInfo tr:last-child th{
   border-bottom:1px solid #ccc;
}

.table-planInfo tr th{
    font-size: 12px;
    font-weight: 500;
    border-left:1px solid #ccc;
}
.table-planInfo tr td{
   font-size: 12px;
   color: black;
       font-weight: 600;
    border-right:1px solid #ccc;
}
.userInfo-title{
    font-size: 16px;font-weight: 600;
}
.userInfo-subtitle{
        margin: 0px;
    font-size: 13px;
    text-align: center;
    margin-bottom: 15px;
}
.sp-custom-btn i.forword{
    font-size: 25px;
    float: right;
}
.sp-custom-btn i.backword{
    font-size: 25px;
    float: left;
}
.btn-red{
    color: #fff;
    background-color: #AC0F0B;;
    border-color: #AC0F0B;
}
.font-18{
   font-size: 18px !important; 
}
.word-capitalize{
    text-transform: capitalize;
}
.word-uppercase{
    text-transform: uppercase;
    color: #000;
}
.sp-custom-btn{
    
    display: inline-block;
    margin-bottom: 0;
    font-weight: 400;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    background-image: none;
    border: 1px solid transparent;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    border-radius: 4px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
.steps{
    display:none;
}
.steps.active-step{
     display:block;
}
#car_number{
     text-transform: uppercase;
}
input.form-control{
    font-weight: 600;
}
input[type="email"]::placeholder,input[type="text"]::placeholder{ /* Firefox, Chrome, Opera */ 
    color: #7673737a;
    font-weight: 400;
    
    
} 
input[type="email"]:-ms-input-placeholder,input[type="text"]:-ms-input-placeholder { /* Internet Explorer 10-11 */ 
    color: #7673737a; 
    font-weight: 400;
} 
  
input[type="email"]::-ms-input-placeholder,input[type="text"]:-ms-input-placeholder { /* Microsoft Edge */ 
    color: #7673737a;
    font-weight: 400;
} 
.form-group {
    margin-bottom: 0px;
}
.fieldset .row{
    margin-bottom: 10px;
}
    .progress-indicator{display:-webkit-box;display:-moz-box;display:-ms-flexbox;display:-webkit-flex;display:flex}.no-flexer,.progress-indicator.stacked{display:block}.no-flexer-element{-ms-flex:0;-webkit-flex:0;-moz-flex:0;flex:0}.flexer-element,.progress-indicator>li{-ms-flex:1;-webkit-flex:1;-moz-flex:1;flex:1}.progress-indicator{margin:0 0 1em;padding:0;font-size:80%;text-transform:uppercase}.progress-indicator>li{list-style:none;text-align:center;width:auto;padding:0;margin:0;position:relative;text-overflow:ellipsis;color:#bbb;display:block}.progress-indicator>li:hover{color:#6f6f6f}.progress-indicator>li.completed,.progress-indicator>li.completed .bubble{color:#3a8a47}.progress-indicator>li .bubble{border-radius:1000px;width:20px;height:20px;background-color:#bbb;display:block;margin:0 auto .5em;border-bottom:1px solid #888}.progress-indicator>li .bubble:after,.progress-indicator>li .bubble:before{display:block;position:absolute;top:9px;width:100%;height:3px;content:'';background-color:#bbb}.progress-indicator>li.completed .bubble,.progress-indicator>li.completed .bubble:after,.progress-indicator>li.completed .bubble:before{background-color:#3a8a47;border-color:#3a8a47}.progress-indicator>li .bubble:before{left:0}.progress-indicator>li .bubble:after{right:0}.progress-indicator>li:first-child .bubble:after,.progress-indicator>li:first-child .bubble:before{width:50%;margin-left:50%}.progress-indicator>li:last-child .bubble:after,.progress-indicator>li:last-child .bubble:before{width:50%;margin-right:50%}.progress-indicator>li.active,.progress-indicator>li.active .bubble{color:#AC0F0B}.progress-indicator>li.active .bubble,.progress-indicator>li.active .bubble:after,.progress-indicator>li.active .bubble:before{background-color:#AC0F0B;border-color:#122a3f}.progress-indicator>li a:hover .bubble,.progress-indicator>li a:hover .bubble:after,.progress-indicator>li a:hover .bubble:before{background-color:#5671d0;border-color:#1f306e}.progress-indicator>li a:hover .bubble{color:#5671d0}.progress-indicator>li.danger .bubble,.progress-indicator>li.danger .bubble:after,.progress-indicator>li.danger .bubble:before{background-color:#d3140f;border-color:#440605}.progress-indicator>li.danger .bubble{color:#d3140f}.progress-indicator>li.warning .bubble,.progress-indicator>li.warning .bubble:after,.progress-indicator>li.warning .bubble:before{background-color:#edb10a;border-color:#5a4304}.progress-indicator>li.warning .bubble{color:#edb10a}.progress-indicator>li.info .bubble,.progress-indicator>li.info .bubble:after,.progress-indicator>li.info .bubble:before{background-color:#5b32d6;border-color:#25135d}.progress-indicator>li.info .bubble{color:#5b32d6}.progress-indicator.stacked>li{text-indent:-10px;text-align:center;display:block}.progress-indicator.stacked>li .bubble:after,.progress-indicator.stacked>li .bubble:before{left:50%;margin-left:-1.5px;width:3px;height:100%}.progress-indicator.stacked .stacked-text{position:relative;z-index:10;top:0;margin-left:60%!important;width:45%!important;display:inline-block;text-align:left;line-height:1.2em}.progress-indicator.stacked>li a{border:none}.progress-indicator.stacked.nocenter>li .bubble{margin-left:0;margin-right:0}.progress-indicator.stacked.nocenter>li .bubble:after,.progress-indicator.stacked.nocenter>li .bubble:before{left:10px}.progress-indicator.stacked.nocenter .stacked-text{width:auto!important;display:block;margin-left:40px!important}@media handheld,screen and (max-width:400px){.progress-indicator{font-size:60%}}
.
</style>

       <main role="main">
          <input type="hidden" value="{{$info->enquiry_id}}" name="enQId" id="enQId"/>
          <section class="term-smoke ptb">
            <div class="container ">
              <div class="row">
                <div class="col-md-12 col-12 col-sm-12" style="background: #fff;padding-top: 25px;">
                    <h4 class="userInfo-title text-center" style="">Just a step away from protecting your car.</h4>
                    <p class="userInfo-subtitle">Please wait till complete your inspection then process for get insured.</p>
                    @if($info->provider == "HDFCEERGO")
                    <ul class="progress-indicator">
                        <li class="active" id="progress-step-1">
                            <span class="bubble"></span>
                            Step 1. <br><small>(Inspection Status)</small>
                        </li>
                        <li class=""  id="progress-step-2">
                            <span class="bubble"></span>
                            Step 2. <br><small>(Recalculate Premium)</small>
                        </li>
                        <li class=""  id="progress-step-3">
                            <span class="bubble"></span>
                            Step 3. <br><small>(Create Proposal)</small>
                        </li>
                        <!-- <li class=""  id="progress-step-4">-->
                        <!--    <span class="bubble"></span>-->
                        <!--    Step 4. <br><small></small>-->
                        <!--</li>-->
                    </ul>
                    @endif
                    @if($info->provider == "DIGIT")
                    <ul class="progress-indicator">
                        
                        <li class="active" id="progress-step-1">
                            <span class="bubble"></span>
                            Step 1. <br><small>(Inspection Status)</small>
                        </li>
                        <li class=""  id="progress-step-2">
                            <span class="bubble"></span>
                            Step 2. <br><small>(Payment Link)</small>
                        </li>
                        <!--<li class=""  id="progress-step-3">-->
                        <!--    <span class="bubble"></span>-->
                        <!--    Step 3. <br><small>(Create Proposal)</small>-->
                        <!--</li>-->
                        <!-- <li class=""  id="progress-step-4">-->
                        <!--    <span class="bubble"></span>-->
                        <!--    Step 4. <br><small></small>-->
                        <!--</li>-->
                    </ul>
                    @endif
                    
                    <div class="fieldset">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="steps active-step" id="step1">
                                    <?php $breakIn =  json_decode($info->breakInJson,true);
                                      // print_r($breakIn);
                                    ?>
                                  <p class="text-center">Your inspection tracking no. <b><?=$breakIn['QuoteId'];?></b> </p>
                                  <p class="text-center">Please Wait <span class="inline-loader"><span class="inline-loader-box"></span><span class="inline-loader-box"></span><span class="inline-loader-box"></span></span></p>
                                  <p class="text-center">We are checking your Self-Inspection status</p> 
                                  
                                </div>
                                <div class="steps" id="step2">
                                   <p class="text-center">Your inspection tracking no. <b><?=$breakIn['QuoteId'];?></b> </p>
                                   <p class="text-center">Please Wait <span class="inline-loader"><span class="inline-loader-box"></span><span class="inline-loader-box"></span><span class="inline-loader-box"></span></span></p>
                                   <p class="text-center">We are recalculating premium after successful inspection.</p>
                                </div>
                                <div class="steps" id="step3">
                                  <p class="text-center">Please Wait <span class="inline-loader"><span class="inline-loader-box"></span><span class="inline-loader-box"></span><span class="inline-loader-box"></span></span></p>
                                   <p class="text-center">We are creating proposal.</p>
                                </div>
                                <!--<div class="steps" id="step4">-->
                                <!--  <p class="text-center">Creating Proposal after successful inspection</p> -->
                                <!--</div>-->
                            </div>
                        </div>
                    </div>
                  
                </div>
               
              </div>        
            </div>
          </section>
       </main>
 

@endsection