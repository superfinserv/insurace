 @inject('service', 'App\Utils\AppUtil')
 @extends('pos.layouts.app')
@section('content')
    <main role="main">
      <section class="become-an-insurance">
        <div class="container">
            <div class="row ">
                <div class="col-12">
                    <div class="col-md-12 col-sm-12 myprofile">
                        <h2>Your Selected Plan</h2>
                     </div>

                        <div class="steps steps--s2">

                          <div class="container ">
                             
                            <div class="create row">
                                    <div class="col-3 mb-3 ">
                                 
                                    <div class="tab-nav__link term-insurance">
                                      <img class="group list-group-image" src="{{getAssets('insurer-logo/hdfclife.png') }}" alt="" style=" width: 100px; ">
                                      <p></p>
                                      <a class="smoke-annual2 hdfc_plan" > Buy now <span class="fa fa-angle-right"></span></a>
                                    </div>

                                  </div>                          
                             
                            </div>
                     
                          </div>

                        </div>

                        <!-- end steps -->



                     </div>

                  </div>

                  </div>

               </section>
             </main>
       <style type="text/css">
  .smoke-annual2:hover {
    background: #ac0f0b;
    cursor: pointer;
    color: #fff !important;
}
.steps--s2 .create .__item {
    color: #333 !important;
}
.create i.fa ,.create i.fas{
    font-size: 40px;
    padding: 5px 10px;
}
.steps--s2 .tab-nav__link {
    /* color: inherit; */
    text-decoration: none;
    box-shadow: 0px 1px 5px 0px rgba(0,0,0,0.2), 0px 2px 2px 0px rgba(0,0,0,0.14), 0px 3px 1px -2px rgba(0,0,0,0.12);
    border-radius: 10px;
    text-align: center !important;
    padding: 15px;
    width: 100%;
    margin-bottom: 5px;
    background: #ffffff;
    color: #333 !important;
    border-color: #fff !important;
}
.smoke-annual2 {
    color: #fff!important;
    padding: 7px 14px;
    width: auto !important;
    text-align: center;
    float: none;
    
}

.myprofile {

    /* padding: 15px 0px; */

    padding-top: 20px;

    padding-bottom: 25px;

}
input.select2-search__field{
  padding: 19px 10px !important;
  font-size: 15px !important;
}

.integer-mobile::-webkit-inner-spin-button, 
.integer-mobile::-webkit-outer-spin-button { 
-webkit-appearance: none; 
margin: 0; }
      </style>
    @endsection