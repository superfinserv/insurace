<?php $loader=1;?>
    @if($loader=='1')        
          <section class="ch-preloader-sec" id="pre-loader">
            <div id="ch-preloader">
        
                <div id="chp-top" class="mask">
                <div class="plane"></div>
                </div>
                <div id="chp-middle" class="mask">
                <div class="plane"></div>
                </div>
        
                <div id="chp-bottom" class="mask">
                <div class="plane"></div>
                </div>
                
                <p><i>LOADING...</i></p>
                
            </div>
        </section>
  @else
   <div class="loader-default" id="pre-loader"></div>
 @endif