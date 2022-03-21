 @extends($layout)
@section('content')
<style>
  .control {
        
    }
.control input {
  position: absolute;
  z-index: -1;
  opacity: 0;
}
.control__indicator {
     position: absolute;
    top: 10px;
    left: 8px;
    height: 20px;
    width: 20px;
    background: #e6e6e6;
}
.control--radio .control__indicator {
  border-radius: 50%;
}
.control:hover input ~ .control__indicator,
.control input:focus ~ .control__indicator {
  background: #ccc;
}
.control input:checked ~ .control__indicator {
  background: #AC0F0B;
}
.control:hover input:not([disabled]):checked ~ .control__indicator,
.control input:checked:focus ~ .control__indicator {
  background: #AC0F0B;
}
.control input:disabled ~ .control__indicator {
  background: #e6e6e6;
  opacity: 0.6;
  pointer-events: none;
}
.control__indicator:after {
  content: '';
  position: absolute;
  display: none;
}
.control input:checked ~ .control__indicator:after {
  display: block;
}
.control--checkbox .control__indicator:after {
  left: 8px;
    top: 4px;
    width: 5px;
    height: 12px;
    border: solid #fff;
    border-width: 0 2px 2px 0;
    transform: rotate(45deg);
}
.control--checkbox input:disabled ~ .control__indicator:after {
  border-color: #7b7b7b;
}
.control--radio .control__indicator:after {
  left: 7px;
  top: 7px;
  height: 6px;
  width: 6px;
  border-radius: 50%;
  background: #fff;
}
.control--radio input:disabled ~ .control__indicator:after {
  background: #7b7b7b;
}


 .toggle {
	 /*margin: 0 0 1.5rem;*/
	 box-sizing: border-box;
	 font-size: 0;
	 display: flex;
	 flex-flow: row nowrap;
	 justify-content: flex-start;
	 align-items: stretch;
}
 .toggle input {
	 width: 0;
	 height: 0;
	 position: absolute;
	 left: -9999px;
}
 .toggle input + label {
	 margin: 0;
	 padding: 0.75rem 2rem;
	 box-sizing: border-box;
	 position: relative;
	 display: inline-block;
	 border: solid 1px #ddd;
	 background-color: #fff;
	 font-size: 1rem;
	 line-height: 140%;
	 font-weight: 600;
	 text-align: center;
	 box-shadow: 0 0 0 rgba(255, 255, 255, 0);
	 transition: border-color 0.15s ease-out, color 0.25s ease-out, background-color 0.15s ease-out, box-shadow 0.15s ease-out;
	/* ADD THESE PROPERTIES TO SWITCH FROM AUTO WIDTH TO FULL WIDTH */
	/*flex: 0 0 50%;
	 display: flex;
	 justify-content: center;
	 align-items: center;
	*/
	/* ----- */
}
 .toggle input + label:first-of-type {
	 border-radius: 6px 0 0 6px;
	 border-right: none;
}
 .toggle input + label:last-of-type {
	 border-radius: 0 6px 6px 0;
	 border-left: none;
}
 .toggle input:hover + label {
	 border-color: #213140;
}
 .toggle input:checked + label {
	    background-color: #AC0F0B;
       color: #fff;
    /* box-shadow: 0 0 10px #AC0F0B; */
    border-color: #AC0F0B;
    z-index: 1;
}
 .toggle input:focus + label {
	 /*outline: dotted 1px #ccc;*/
	 outline-offset: 0.45rem;
}
 @media (max-width: 800px) {
	 .toggle input + label {
		 padding: 0.75rem 0.25rem;
		 flex: 0 0 50%;
		 display: flex;
		 justify-content: center;
		 align-items: center;
	}
}
.th-border{
   border: 1px solid #AC0F0B;
        padding: 5px 10px 5px 40px;
        display: block;
        position: relative;
        /* padding-left: 30px; */
        margin-bottom: 15px;
        cursor: pointer;
        font-size: 18px;
        border-radius: 8px;
        box-shadow: 0px 0px 10px #ccc;
}

.act-count{
  position: absolute;top: 8px;right: 10px;border: 1px solid #ccc;padding: 0px 6px;
}
ul.act-count li{
  display:inline;padding: 1px 4px;
}
ul.act-count li a i.icon-act{
   font-size: 12px;
}
ul.act-count li .count-value{
  font-size: 12px;
}

.count-son { display:none;}
.count-daughter { display:none;}
    </style>
<main role="main">
  	<section class="health-profile">
  		<div class="container healt-pro-bg ptb hltmt-40 page-heading-h2">
  		    <h2 class="text-center">Select members you want to insure?</h2>
             <div class="section-inner">
                <div class="helth-introInfo" style="padding-top: 20px;">
                    <div class="row">
                        <div class="col-md-2 col-sm-12 col-xs-12"></div>
                        <div class="col-md-8 col-sm-12 col-xs-12">
                        
                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                     <div class="th-border">
                                        <label class="control control--checkbox">You
                                          <input type="checkbox" name="f-members-self" value="self" class="f-members"/>
                                          <div class="control__indicator"></div>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                     <div class="th-border self-rel" >
                                        <label class="control control--checkbox">Wife
                                          <input type="checkbox"  name="f-members" value="f-members-wife" class="f-members"/>
                                          <div class="control__indicator"></div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                     <div class="th-border">
                                        <label class="control control--checkbox">Father
                                          <input type="checkbox"  name="f-members-father" value="father" class="f-members"/>
                                          <div class="control__indicator"></div>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                     <div class="th-border">
                                        <label class="control control--checkbox">Mother
                                          <input type="checkbox"  name="f-members-mother" value="mother" class="f-members"/>
                                          <div class="control__indicator"></div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="th-border">
                                       <label class="control control--checkbox">Daughter
                                          <input type="checkbox"  name="f-members-daughter" value="daughter" class="f-members"/>
                                          <div class="control__indicator"></div>
                                        </label>
                                        <ul class="act-count count-daughter">
                                          <li><a href="#" class="daughter-counter _minus"><i class="icon-act fa fa-minus"></i></a></li>
                                          <li><span class="count-value daughter-counter-val">1</span></li>
                                          <li><a href="#" class="daughter-counter _plus"><i class="icon-act fa fa-plus"></i></a></li>
                                        </ul> 
                                    </div>
                                     
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="th-border">
                                        <label class="control control--checkbox">Son
                                          <input type="checkbox" name="f-members-son" value="son" class="f-members"/>
                                          <div class="control__indicator"></div>
                                        </label>
                                        <ul class="act-count count-son" >
                                          <li><a href="#" class="son-counter _minus"><i class="icon-act fa fa-minus"></i></a></li>
                                          <li><span class="count-value son-counter-val">1</span></li>
                                          <li><a href="#" class="son-counter _plus"><i   class="icon-act fa fa-plus"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="row text-center">
                                <div class="col-md-12">
                                      <a href="{{url('health-insurance/health-profile')}}" class="btn btn-ss"> <i class="left fa fa-chevron-left "></i> Back</a>
                                     <button type="button" class="btn btn-ss btnTable2">Continue <i class="right fa fa-chevron-right "></i></button>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                     <div class="error-elem" style="padding: 10px 10px;border: 1px solid #ccc;margin-top: 20px;font-size: 13px;color: red;font-weight: 600; background: #d7272769;display: inline-flex;border-radius: 12px;">
                                         <span class="error-message"></span>
                                    </div>
                                </div>
                               
                            </div> 
                            
                        </div>
                        <div class="col-md-2 col-sm-12 col-xs-12">
                           
                        </div>
                    </div>
                    
                
                </div>
            </div>
            
        </div>
    </section>
</main>
@endsection

 
