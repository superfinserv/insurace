 @extends($layout)
    @section('content')
 
<style>
/*    .flex-radio {*/
/*	  display: flex;*/
/*	  flex-flow: row wrap;*/
/*	      margin-top: 20px;*/
/*   }*/
/* .flex-radio > div {*/
/*	 flex: 1;*/
/*	 padding: 0.5rem;*/
/*}*/
/* .flex-radio input[type="radio"] {*/
/*	 display: none;*/
/* }*/
/* .flex-radio input[type="radio"]:not(:disabled) ~ label {*/
/*	 cursor: pointer;*/
/*}*/
/* .flex-radio input[type="radio"]:disabled ~ label {*/
/*	 color: rgba(188, 194, 191, 1);*/
/*	 border-color: rgba(188, 194, 191, 1);*/
/*	 box-shadow: none;*/
/*	 cursor: not-allowed;*/
/*}*/
/* .flex-radio label {*/
/*	 height: 100%;*/
/*	 display: block;*/
/*	 background: white;*/
/*	 border: 1px solid #2d3a49;;*/
/*	 border-radius: 20px;*/
/*	 padding: 1rem;*/
/*	 margin-bottom: 1rem;*/
/*	 text-align: center;*/
/*	 box-shadow: 0px 3px 10px -2px rgba(161, 170, 166, 0.5);*/
/*	 position: relative;*/
/*}*/
/* .flex-radio input[type="radio"]:checked + label {*/
/*	 background: #2d3a49;*/
/*	 color: rgba(255, 255, 255, 1);*/
	 /*box-shadow: 0px 0px 20px rgba(0, 255, 128, 0.75);*/
/*}*/
/* .flex-radio input[type="radio"]:checked + label::after {*/
/*	 color: #AC0F0B;*/
/*	 font-family: FontAwesome;*/
/*	 border: 2px solid #AC0F0B;*/
/*	 content: "\f00c";*/
/*	 font-size: 15px;*/
/*    position: absolute;*/
/*    top: -15px;*/
/*    left: 50%;*/
/*    transform: translateX(-50%);*/
/*    height: 30px;*/
/*    width: 30px;*/
/*    line-height: 27px;*/
/*    text-align: center;*/
/*    border-radius: 50%;*/
/*    background: white;*/
	/*box-shadow: 0px 2px 5px -2px rgba(0, 0, 0, 0.25);*/
/*}*/
/* .flex-radio input[type="radio"]#control_05:checked + label {*/
/*	 background: red;*/
/*	 border-color: red;*/
/*}*/
/* .flex-radio p {*/
/*	 font-weight: 900;*/
/*}*/
/* @media only screen and (max-width: 700px) {*/
/*	 .flex-radio {*/
		 /*flex-direction: column;*/
/*	}*/
/*}*/



input[name='gender'] {
  -webkit-appearance: none;
  -moz-appearance: none;
  -o-appearance: none;
  -ms-appearance: none;
  appearance: none;
  outline: none;
  border: 1px solid #ccc;
}
input[name='gender']:after {
  font-family: 'FontAwesome';
  display: inline-block;
  text-align: center;
  font-size: 50px;
  content: attr(data-icon);
  
  padding: 15px 25px;
  border-radius: 15px;
  color: rgba(0, 0, 0, 0.4);
  transition: box-shadow 1s, color 1s;
  background: #fff;
  color:#ccc;
}

/*.male-icon:after {*/
/*  font-family: 'FontAwesome';*/
/*  display: inline-block;*/
/*  text-align: center;*/
/*  font-size: 50px;*/
  /*content: attr(data-icon);*/
/*  content:"";*/
/*  background: url("https://assets.coverfox.com/static/img/male.ae02e34e1ffa.svg") no-repeat right top;*/
/*   background-size: 40px 40px;*/
/*            height: 40px;*/
/*            width: 40px;*/
/*  padding: 15px 25px;*/
  /*border-radius: 15px;*/
/*  color: rgba(0, 0, 0, 0.4);*/
/*  transition: box-shadow 1s, color 1s;*/
  /*background: #fff;*/
/*  color:#ccc;*/
/*}*/

/*.female-icon:after {*/
/*  font-family: 'FontAwesome';*/
/*  display: inline-block;*/
/*  text-align: center;*/
/*  font-size: 50px;*/
  /*content: attr(data-icon);*/
/*  content:"";*/
/*  background: url("https://assets.coverfox.com/static/img/female.2d108198afa3.svg") no-repeat right top;*/
/*   background-size: 40px 40px;*/
/*            height: 40px;*/
/*            width: 40px;*/
/*  padding: 15px 25px;*/
  /*border-radius: 15px;*/
/*  color: rgba(0, 0, 0, 0.4);*/
/*  transition: box-shadow 1s, color 1s;*/
  /*background: #fff;*/
/*  color:#ccc;*/
/*}*/


input[name='gender']:checked:after {
  box-shadow: 2px 2px 14px rgba(0, 0, 0, 0.4);
  color: rgba(255, 255, 255, 0.6);
  border: 1px solid #AC0F0B;
  color: #AC0F0B;
  background: #ac0f0b1f;
}
input[name='gender']:checked{
 border: none;   
 outline: none;
}




health_form > div.health_gender_radio {
  display: block;
}
.w--health_form > div {
  display: inline-block;
  vertical-align: top;
  text-align: left;
}

.navigation-radio.w--radio {
  margin: 0 auto 12px;
  max-width: 700px;
}

.navigation-radio .w--radio__label {
  display: none;
}
.w--radio__label {
  width: 60%;
  display: inline-block;
  color: rgba(49,68,81,.7);
}

.w--health_form > div.health_gender_radio .w--radio__options {
  padding-left: 0;
}
.navigation-radio .w--radio__options {
  text-align: center;
  width: 100%;
  padding-left: 22px;
}
.w--radio__options {
  width: 40%;
  display: inline-block;
}

.w--health_form > div.health_gender_radio .w--radio__option {
  border: 1px solid rgba(107,122,254,.12);
  border-radius: 8px;
  background-color: #fff;
  box-shadow: 0 8px 12px -8px rgba(0,0,0,.12),0 5px 24px 0 rgba(132,148,248,.39);
  padding: 12px 24px;
  color: #000;
  margin-right: 16px;
}
.bike_product .w--radio__option, .w--health_form .w--radio__option, .w--term_form .w--radio__option, .w--travel_form .w--radio__option, .w--ulip_form .w--radio__option {
  min-width: 42px;
}
.navigation-radio .w--radio__option {
  margin-right: 40px;
  margin-bottom: 8px;
  color: rgba(49,68,81,.7);
  outline: none;
}
.w--radio .w--radio__option {
  display: inline-block;
  margin-right: 30px;
  position: relative;
  cursor: pointer;
  min-width: 35px;
}

.w--health_form > div.health_gender_radio .w--radio .w--radio__option:first-child::before {
  background: url("https://assets.coverfox.com/static/img/male.ae02e34e1ffa.svg") no-repeat right top;
}
.w--health_form > div.health_gender_radio .w--radio .w--radio__option::before {
  width: 48px;
  height: 48px;
  background: url("https://assets.coverfox.com/static/img/female.2d108198afa3.svg") no-repeat right top;
  background-size: contain;
  top: 0;
  left: 0;
  border: none;
  -webkit-transform: none;
  transform: none;
  position: relative;
  display: block;
  margin-bottom: 8px;
}
.w--radio .w--radio__option::before {
  position: absolute;
  content: "";
  width: 14px;
  left: -22px;
  top: 50%;
  -webkit-transform: translateY(-50%);
  transform: translateY(-50%);
  height: 14px;
  border: 1px solid #314451;
  border-radius: 20px;
}

.w--health_form > div.health_gender_radio .w--radio__option:last-child {
  margin-right: 0;
}
.w--health_form > div.health_gender_radio .w--radio__option.radio_selected {
  border: 2px solid #6b7afe;
  color: #6b7afe;
}
.w--health_form > div.health_gender_radio .w--radio__option {
  border: 1px solid rgba(107,122,254,.12);
  border-radius: 8px;
  background-color: #fff;
  box-shadow: 0 8px 12px -8px rgba(0,0,0,.12),0 5px 24px 0 rgba(132,148,248,.39);
  padding: 12px 24px;
  color: #000;
  margin-right: 16px;
}
.bike_product .w--radio__option.radio_selected, .w--health_form .w--radio__option.radio_selected, .w--term_form .w--radio__option.radio_selected, .w--travel_form .w--radio__option.radio_selected, .w--ulip_form .w--radio__option.radio_selected {
  font-weight: 700;
  color: #030303;
}
.navigation-radio .w--radio__option.radio_selected {
  color: #314451;
}
.w--radio .w--radio__option:last-child {
  margin-right: 0;
}
.bike_product .w--radio__option, .w--health_form .w--radio__option, .w--term_form .w--radio__option, .w--travel_form .w--radio__option, .w--ulip_form .w--radio__option {
  min-width: 42px;
}
.navigation-radio .w--radio__option {
  margin-right: 40px;
  margin-bottom: 8px;
  color: rgba(49,68,81,.7);
  outline: none;
}
.w--radio .w--radio__option {
  display: inline-block;
  margin-right: 30px;
  position: relative;
  cursor: pointer;
  min-width: 35px;
}
</style>
<main role="main">
  	<section class="health-profile">
  		<div class="container healt-pro-bg ptb hltmt-40 page-heading-h2">
  		    <h2 class="text-center ">Cover yourself, your family and get tax benefits </br>with the right health insurance policy</h2>
             <div class="section-inner">
                <div class="helth-introInfo" style="padding-top: 20px;">
                    <div class="row">
                        <div class="col-md-2 col-sm-12 col-xs-12"></div>
                        <div class="col-md-8 col-sm-12 col-xs-12">
                             <form class="" enctype="multipart/form-data"  id="healthProfileTable-1" method="post">
                                <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                                <div class="row">
                                     <div class="col-md-3 col-sm-12 col-xs-12"></div>
                                     <div class="col-md-6 col-sm-12 col-xs-12  text-center">
                                       <div class="form-group">
                                        <input type="radio" name="gender" id="gender_M" value="MALE" class="male-icon" data-icon='' />
                                        <input type="radio" name="gender" id="gender_F" value="FEMALE" class="female-icon" data-icon='' />
                                        
                                        </div>
                                    </div>
                                     <div class="col-md-3 col-sm-12 col-xs-12"></div>
                                </div>
                                @if($subview=='web')
                                  <div class="row">
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                         <label for="name">Your Name</label>
                                         <input type="text" class="form-control" id="name"  placeholder="Full Name" name="name"  style="margin-bottom: 0px;">
                                        </div>
                                    </div>
                                    @if(isset(Auth::guard('customers')->user()->id))<input type="hidden" value="{{Auth::guard('customers')->user()->mobile}}" id="mobileNumber"  name="mobileNumber">@endif
                                    
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                         <label for="name">Your Email</label>
                                         <input type="text" class="form-control" id="email"  placeholder="Your Email address" name="email" style="margin-bottom: 0px;">
                                        </div>
                                    </div>
                                </div>
                                @else
                                   <div class="row">
                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                         <label for="name">Your Name</label>
                                         <input type="text" class="form-control" id="name"  placeholder="Full Name" name="name">
                                        </div>
                                    </div>
                                     <div class="col-md-4 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                         <label for="name">Customer Mobile</label>
                                         <input type="text" class="form-control" id="mobile"  placeholder="Enter Mobile No." name="mobile">
                                        </div>
                                     </div>
                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                         <label for="name">Customer Email</label>
                                         <input type="text" class="form-control" id="email"  placeholder="Your Email address" name="email">
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="row text-center"> 
                                        <div class="col-md-12">
                                             <button type="submit" class="btn btn-ss">Continue <i class="right fa fa-chevron-right "></i></button>
                                        </div>
                                       
                                    </div> 
                            </form>
                        </div>
                        <div class="col-md-2 col-sm-12 col-xs-12"></div>
                    </div>
                    
                
                </div>
            </div>
            
        </div>
    </section>
</main>
@endsection

 