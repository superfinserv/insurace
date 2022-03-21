

$(document).on('click','.age-selector',function(e){
    e.preventDefault();
    var agesel = $(this).attr('data-class');
          if($(this).prop("checked") == true){
                $('.'+agesel).css('display','block');
            }
            else if($(this).prop("checked") == false){
                 $('.'+agesel).css('display','none');
            }
       
})

$(document).ready(function() {
    $("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
        e.preventDefault();
        $(this).siblings('a.active').removeClass("active");
        $(this).addClass("active");
        var index = $(this).index();
        $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
        $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
    });
});

$(document). ready(function() {
    $('#mobile').on('keyup', function (e) {
      
        var v = e.target.value, num = /^[6789]\d{9}$/;
        if (v.length > 9) {

          if (num.test(v)) {
          
             $('#mobile-error').hide();
            
            if(e.keyCode == 13){
              //checkUserEnter(e);
            }
           

          } else {
          
            $('#mobile-error').show();
             $('#mobile-error').text('Invalid Mobile Number.');
          }
        }
        else{
          
          $('#mobile-error').hide();
        }
      })
     })
     
     
// WebFontConfig = {
//                 google: { families: [ 'Nunito+Sans:400,400i,700,700i,800,800i,900,900i', 'Quicksand:300,400,700'] }
//             };
//             (function() {
//                 var wf = document.createElement('script');
//                 wf.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
//                 wf.type = 'text/javascript';
//                 wf.async = 'true';
//                 var s = document.getElementsByTagName('script')[0];
//                 s.parentNode.insertBefore(wf, s);
//             })();


var _html = document.documentElement,
                isTouch = (('ontouchstart' in _html) || (navigator.msMaxTouchPoints > 0) || (navigator.maxTouchPoints));

            _html.className = _html.className.replace("no-js","js");
            _html.classList.add( isTouch ? "touch" : "no-touch");


function filter($state){
    var x   = document.getElementsByClassName($state);
    var btn = document.getElementById($state);
    
    if (btn.className == "btn"){
        btn.className = btn.dataset.class;
        for (i = 0; i < x.length; i++) {x[i].className = " animated fadeInLeft "+$state;}
        }
        else{ 
        for (i = 0; i < x.length; i++) {x[i].className = " animated fadeOutRight "+$state;}
         btn.className = "btn";
        }

}

// WebFontConfig = {
//                 google: { families: [ 'Nunito+Sans:400,400i,700,700i,800,800i,900,900i', 'Quicksand:300,400,700'] }
//             };
//             (function() {
//                 var wf = document.createElement('script');
//                 wf.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
//                 wf.type = 'text/javascript';
//                 wf.async = 'true';
//                 var s = document.getElementsByTagName('script')[0];
//                 s.parentNode.insertBefore(wf, s);
//             })();



/* YYY */
// var _html = document.documentElement,
//                 isTouch = (('ontouchstart' in _html) || (navigator.msMaxTouchPoints > 0) || (navigator.maxTouchPoints));

//             _html.className = _html.className.replace("no-js","js");
//             _html.classList.add( isTouch ? "touch" : "no-touch");




(function(w, d){
                        var m = d.getElementsByTagName('main')[0],
                            s = d.createElement("script"),
                            v = !("IntersectionObserver" in w) ? "8.17.0" : "11.0.6",
                            o = {
                                elements_selector: ".lazy",
                                threshold: 500,
                                callback_enter: function (element) {

                                },
                                callback_load: function (element) {

                                },
                                callback_set: function (element) {

                                    oTimeout = setTimeout(function ()
                                    {
                                        clearTimeout(oTimeout);

                                        AOS.refresh();
                                    }, 1000);
                                },
                                callback_error: function(element) {
                                    element.src = "https://placeholdit.imgix.net/~text?txtsize=21&amp;txt=Image%20not%20load&amp;w=200&amp;h=200";
                                }
                            };
                        s.type = 'text/javascript';
                        s.async = false; // This includes the script as async. See the "recipes" section for more information about async loading of LazyLoad.
                        s.src = "https://cdn.jsdelivr.net/npm/vanilla-lazyload@" + v + "/dist/lazyload.min.js";
                        m.appendChild(s);
                        // m.insertBefore(s, m.firstChild);
                        w.lazyLoadOptions = o;
                    }(window, document));


/* YYY*/
// function filter($state){
//             var x   = document.getElementsByClassName($state);
//             var btn = document.getElementById($state);
            
//             if (btn.className == "btn"){
//                 btn.className = btn.dataset.class;
//                 for (i = 0; i < x.length; i++) {x[i].className = " animated fadeInLeft "+$state;}
//                 }
//                 else{ 
//                 for (i = 0; i < x.length; i++) {x[i].className = " animated fadeOutRight "+$state;}
//                  btn.className = "btn";
//                 }

// }



/* YYY*/
// (function(w, d){
//                         var m = d.getElementsByTagName('main')[0],
//                             s = d.createElement("script"),
//                             v = !("IntersectionObserver" in w) ? "8.17.0" : "11.0.6",
//                             o = {
//                                 elements_selector: ".lazy",
//                                 threshold: 500,
//                                 callback_enter: function (element) {

//                                 },
//                                 callback_load: function (element) {

//                                 },
//                                 callback_set: function (element) {

//                                     oTimeout = setTimeout(function ()
//                                     {
//                                         clearTimeout(oTimeout);

//                                         AOS.refresh();
//                                     }, 1000);
//                                 },
//                                 callback_error: function(element) {
//                                     element.src = "https://placeholdit.imgix.net/~text?txtsize=21&amp;txt=Image%20not%20load&amp;w=200&amp;h=200";
//                                 }
//                             };
//                         s.type = 'text/javascript';
//                         s.async = false; // This includes the script as async. See the "recipes" section for more information about async loading of LazyLoad.
//                         s.src = "https://cdn.jsdelivr.net/npm/vanilla-lazyload@" + v + "/dist/lazyload.min.js";
//                         m.appendChild(s);
//                         // m.insertBefore(s, m.firstChild);
//                         w.lazyLoadOptions = o;
//                     }(window, document));
                    
                    
var WebFontConfig = {
                google: { families: [ 'Nunito+Sans:400,400i,700,700i,800,800i,900,900i', 'Quicksand:300,400,700'] }
            };
            
(function() {
                var wf = document.createElement('script');
                wf.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
                wf.type = 'text/javascript';
                wf.async = 'true';
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(wf, s);
            })();
            
            
   /* YYY*/       
    // var _html = document.documentElement,
    //     isTouch = (('ontouchstart' in _html) || (navigator.msMaxTouchPoints > 0) || (navigator.maxTouchPoints));

    // _html.className = _html.className.replace("no-js","js");
    // _html.classList.add( isTouch ? "touch" : "no-touch");
  
  /* YYY*/      
// function filter($state){
//         var x   = document.getElementsByClassName($state);
//         var btn = document.getElementById($state);
        
//         if (btn.className == "btn"){
//             btn.className = btn.dataset.class;
//             for (i = 0; i < x.length; i++) {x[i].className = " animated fadeInLeft "+$state;}
//             }
//             else{ 
//             for (i = 0; i < x.length; i++) {x[i].className = " animated fadeOutRight "+$state;}
//              btn.className = "btn";
//             }

// }

      

$(document).ready(function () {
$('.navbar-light .dmenu').hover(function () {
        $(this).find('.sm-menu').first().stop(true, true).slideDown(150);
    }, function () {
        $(this).find('.sm-menu').first().stop(true, true).slideUp(105)
    });
});


$(document).ready(function() {
    $('[id^=detail-]').hide();
    $('.toggle').click(function() {
        $input = $( this );
        $target = $('#'+$input.attr('data-toggle'));
        $target.slideToggle();
    });
});



jQuery(function($) {
  
  
  var doAnimations = function() {
    
   
    var offset = $(window).scrollTop() + $(window).height(),
        $animatables = $('.animatable');
    
   
    if ($animatables.length == 0) {
      $(window).off('scroll', doAnimations);
    }
    
    
        $animatables.each(function(i) {
       var $animatable = $(this);
            if (($animatable.offset().top + $animatable.height() - 20) < offset) {
        $animatable.removeClass('animatable').addClass('animated');
            }
    });

    };
  
  
    $(window).on('scroll', doAnimations);
      $(window).trigger('scroll');

});
/* YYY*/
// WebFontConfig = {
//                 google: { families: [ 'Nunito+Sans:400,400i,700,700i,800,800i,900,900i', 'Quicksand:300,400,700'] }
//             };
//             (function() {
//                 var wf = document.createElement('script');
//                 wf.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
//                 wf.type = 'text/javascript';
//                 wf.async = 'true';
//                 var s = document.getElementsByTagName('script')[0];
//                 s.parentNode.insertBefore(wf, s);
//             })();

/* YYY*/
    // var _html = document.documentElement,
    //             isTouch = (('ontouchstart' in _html) || (navigator.msMaxTouchPoints > 0) || (navigator.maxTouchPoints));

    //         _html.className = _html.className.replace("no-js","js");
    //         _html.classList.add( isTouch ? "touch" : "no-touch");


/* YYY*/
// (function(w, d){
//                         var m = d.getElementsByTagName('main')[0],
//                             s = d.createElement("script"),
//                             v = !("IntersectionObserver" in w) ? "8.17.0" : "11.0.6",
//                             o = {
//                                 elements_selector: ".lazy",
//                                 threshold: 500,
//                                 callback_enter: function (element) {

//                                 },
//                                 callback_load: function (element) {

//                                 },
//                                 callback_set: function (element) {

//                                     oTimeout = setTimeout(function ()
//                                     {
//                                         clearTimeout(oTimeout);

//                                         AOS.refresh();
//                                     }, 1000);
//                                 },
//                                 callback_error: function(element) {
//                                     element.src = "https://placeholdit.imgix.net/~text?txtsize=21&amp;txt=Image%20not%20load&amp;w=200&amp;h=200";
//                                 }
//                             };
//                         s.type = 'text/javascript';
//                         s.async = false; // This includes the script as async. See the "recipes" section for more information about async loading of LazyLoad.
//                         s.src = "https://cdn.jsdelivr.net/npm/vanilla-lazyload@" + v + "/dist/lazyload.min.js";
//                         m.appendChild(s);
//                         // m.insertBefore(s, m.firstChild);
//                         w.lazyLoadOptions = o;
//                     }(window, document));
/* YYY*/
// function filter($state){
// var x   = document.getElementsByClassName($state);
// var btn = document.getElementById($state);

// if (btn.className == "btn"){
//     btn.className = btn.dataset.class;
//     for (i = 0; i < x.length; i++) {x[i].className = " animated fadeInLeft "+$state;}
//     }
//     else{ 
//     for (i = 0; i < x.length; i++) {x[i].className = " animated fadeOutRight "+$state;}
//      btn.className = "btn";
//     }

// }

/* YYY*/
// $(document).ready(function () {
// $('.navbar-light .dmenu').hover(function () {
//         $(this).find('.sm-menu').first().stop(true, true).slideDown(150);
//     }, function () {
//         $(this).find('.sm-menu').first().stop(true, true).slideUp(105)
//     });
// });

/* YYY*/
// $(document).ready(function() {
//     $('[id^=detail-]').hide();
//     $('.toggle').click(function() {
//         $input = $( this );
//         $target = $('#'+$input.attr('data-toggle'));
//         $target.slideToggle();
//     });
// });
/* YYY*/
// WebFontConfig = {
//                 google: { families: [ 'Nunito+Sans:400,400i,700,700i,800,800i,900,900i', 'Quicksand:300,400,700'] }
//             };
//             (function() {
//                 var wf = document.createElement('script');
//                 wf.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
//                 wf.type = 'text/javascript';
//                 wf.async = 'true';
//                 var s = document.getElementsByTagName('script')[0];
//                 s.parentNode.insertBefore(wf, s);
//             })();

/* YYY*/
// var _html = document.documentElement,
//                 isTouch = (('ontouchstart' in _html) || (navigator.msMaxTouchPoints > 0) || (navigator.maxTouchPoints));

//             _html.className = _html.className.replace("no-js","js");
//             _html.classList.add( isTouch ? "touch" : "no-touch");


/* YYY*/
// (function(w, d){
//                         var m = d.getElementsByTagName('main')[0],
//                             s = d.createElement("script"),
//                             v = !("IntersectionObserver" in w) ? "8.17.0" : "11.0.6",
//                             o = {
//                                 elements_selector: ".lazy",
//                                 threshold: 500,
//                                 callback_enter: function (element) {

//                                 },
//                                 callback_load: function (element) {

//                                 },
//                                 callback_set: function (element) {

//                                     oTimeout = setTimeout(function ()
//                                     {
//                                         clearTimeout(oTimeout);

//                                         AOS.refresh();
//                                     }, 1000);
//                                 },
//                                 callback_error: function(element) {
//                                     element.src = "https://placeholdit.imgix.net/~text?txtsize=21&amp;txt=Image%20not%20load&amp;w=200&amp;h=200";
//                                 }
//                             };
//                         s.type = 'text/javascript';
//                         s.async = false; // This includes the script as async. See the "recipes" section for more information about async loading of LazyLoad.
//                         s.src = "https://cdn.jsdelivr.net/npm/vanilla-lazyload@" + v + "/dist/lazyload.min.js";
//                         m.appendChild(s);
//                         // m.insertBefore(s, m.firstChild);
//                         w.lazyLoadOptions = o;
//                     }(window, document));

/* YYY*/
// function filter($state){
// var x   = document.getElementsByClassName($state);
// var btn = document.getElementById($state);

// if (btn.className == "btn"){
//     btn.className = btn.dataset.class;
//     for (i = 0; i < x.length; i++) {x[i].className = " animated fadeInLeft "+$state;}
//     }
//     else{ 
//     for (i = 0; i < x.length; i++) {x[i].className = " animated fadeOutRight "+$state;}
//      btn.className = "btn";
//     }

// }



/* YYY*/
// $(document).ready(function () {
// $('.navbar-light .dmenu').hover(function () {
//         $(this).find('.sm-menu').first().stop(true, true).slideDown(150);
//     }, function () {
//         $(this).find('.sm-menu').first().stop(true, true).slideUp(105)
//     });
// });

/* YYY*/
// $(document).ready(function() {
//     $('[id^=detail-]').hide();
//     $('.toggle').click(function() {
//         $input = $( this );
//         $target = $('#'+$input.attr('data-toggle'));
//         $target.slideToggle();
//     });
// });


/* YYY*/
// jQuery(function($) {
  
  
//   var doAnimations = function() {
    
   
//     var offset = $(window).scrollTop() + $(window).height(),
//         $animatables = $('.animatable');
    
   
//     if ($animatables.length == 0) {
//       $(window).off('scroll', doAnimations);
//     }
    
    
//         $animatables.each(function(i) {
//       var $animatable = $(this);
//             if (($animatable.offset().top + $animatable.height() - 20) < offset) {
//         $animatable.removeClass('animatable').addClass('animated');
//             }
//     });

//     };
  
  
//     $(window).on('scroll', doAnimations);
//   $(window).trigger('scroll');

// });

/* YYY*/
// function filter($state){
// var x   = document.getElementsByClassName($state);
// var btn = document.getElementById($state);

// if (btn.className == "btn"){
//     btn.className = btn.dataset.class;
//     for (i = 0; i < x.length; i++) {x[i].className = " animated fadeInLeft "+$state;}
//     }
//     else{ 
//     for (i = 0; i < x.length; i++) {x[i].className = " animated fadeOutRight "+$state;}
//      btn.className = "btn";
//     }

// }

/* YYY*/
// $(document).ready(function () {
// $('.navbar-light .dmenu').hover(function () {
//         $(this).find('.sm-menu').first().stop(true, true).slideDown(150);
//     }, function () {
//         $(this).find('.sm-menu').first().stop(true, true).slideUp(105)
//     });
// });

/* YYY*/
// $(document).ready(function() {
//     $('[id^=detail-]').hide();
//     $('.toggle').click(function() {
//         $input = $( this );
//         $target = $('#'+$input.attr('data-toggle'));
//         $target.slideToggle();
//     });
// });


// WebFontConfig = {
//                 google: { families: [ 'Nunito+Sans:400,400i,700,700i,800,800i,900,900i', 'Quicksand:300,400,700'] }
//             };
//             (function() {
//                 var wf = document.createElement('script');
//                 wf.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
//                 wf.type = 'text/javascript';
//                 wf.async = 'true';
//                 var s = document.getElementsByTagName('script')[0];
//                 s.parentNode.insertBefore(wf, s);
//             })();


/* YYY*/
// var _html = document.documentElement,
//                 isTouch = (('ontouchstart' in _html) || (navigator.msMaxTouchPoints > 0) || (navigator.maxTouchPoints));

//             _html.className = _html.className.replace("no-js","js");
//             _html.classList.add( isTouch ? "touch" : "no-touch");



/* YYY*/
// (function(w, d){
//                         var m = d.getElementsByTagName('main')[0],
//                             s = d.createElement("script"),
//                             v = !("IntersectionObserver" in w) ? "8.17.0" : "11.0.6",
//                             o = {
//                                 elements_selector: ".lazy",
//                                 threshold: 500,
//                                 callback_enter: function (element) {

//                                 },
//                                 callback_load: function (element) {

//                                 },
//                                 callback_set: function (element) {

//                                     oTimeout = setTimeout(function ()
//                                     {
//                                         clearTimeout(oTimeout);

//                                         AOS.refresh();
//                                     }, 1000);
//                                 },
//                                 callback_error: function(element) {
//                                     element.src = "https://placeholdit.imgix.net/~text?txtsize=21&amp;txt=Image%20not%20load&amp;w=200&amp;h=200";
//                                 }
//                             };
//                         s.type = 'text/javascript';
//                         s.async = false; // This includes the script as async. See the "recipes" section for more information about async loading of LazyLoad.
//                         s.src = "https://cdn.jsdelivr.net/npm/vanilla-lazyload@" + v + "/dist/lazyload.min.js";
//                         m.appendChild(s);
//                         // m.insertBefore(s, m.firstChild);
//                         w.lazyLoadOptions = o;
//                     }(window, document));


/* YYY*/
// function filter($state){
// var x   = document.getElementsByClassName($state);
// var btn = document.getElementById($state);

// if (btn.className == "btn"){
//     btn.className = btn.dataset.class;
//     for (i = 0; i < x.length; i++) {x[i].className = " animated fadeInLeft "+$state;}
//     }
//     else{ 
//     for (i = 0; i < x.length; i++) {x[i].className = " animated fadeOutRight "+$state;}
//      btn.className = "btn";
//     }

// }

/* YYY*/
// $(document).ready(function () {
// $('.navbar-light .dmenu').hover(function () {
//         $(this).find('.sm-menu').first().stop(true, true).slideDown(150);
//     }, function () {
//         $(this).find('.sm-menu').first().stop(true, true).slideUp(105)
//     });
// });

/* YYY*/
// $(document).ready(function() {
//     $('[id^=detail-]').hide();
//     $('.toggle').click(function() {
//         $input = $( this );
//         $target = $('#'+$input.attr('data-toggle'));
//         $target.slideToggle();
//     });
// });

/* YYY*/

// jQuery(function($) {
  
  
//   var doAnimations = function() {
    
   
//     var offset = $(window).scrollTop() + $(window).height(),
//         $animatables = $('.animatable');
    
   
//     if ($animatables.length == 0) {
//       $(window).off('scroll', doAnimations);
//     }
    
    
//         $animatables.each(function(i) {
//       var $animatable = $(this);
//             if (($animatable.offset().top + $animatable.height() - 20) < offset) {
//         $animatable.removeClass('animatable').addClass('animated');
//             }
//     });

//     };
  
  
//     $(window).on('scroll', doAnimations);
//   $(window).trigger('scroll');

// });

/* YYY*/
// (function(w, d){
//                         var m = d.getElementsByTagName('main')[0],
//                             s = d.createElement("script"),
//                             v = !("IntersectionObserver" in w) ? "8.17.0" : "11.0.6",
//                             o = {
//                                 elements_selector: ".lazy",
//                                 threshold: 500,
//                                 callback_enter: function (element) {

//                                 },
//                                 callback_load: function (element) {

//                                 },
//                                 callback_set: function (element) {

//                                     oTimeout = setTimeout(function ()
//                                     {
//                                         clearTimeout(oTimeout);

//                                         AOS.refresh();
//                                     }, 1000);
//                                 },
//                                 callback_error: function(element) {
//                                     element.src = "https://placeholdit.imgix.net/~text?txtsize=21&amp;txt=Image%20not%20load&amp;w=200&amp;h=200";
//                                 }
//                             };
//                         s.type = 'text/javascript';
//                         s.async = false; // This includes the script as async. See the "recipes" section for more information about async loading of LazyLoad.
//                         s.src = "https://cdn.jsdelivr.net/npm/vanilla-lazyload@" + v + "/dist/lazyload.min.js";
//                         m.appendChild(s);
//                         // m.insertBefore(s, m.firstChild);
//                         w.lazyLoadOptions = o;
//                     }(window, document));


/* YYY*/
// function filter($state){
// var x   = document.getElementsByClassName($state);
// var btn = document.getElementById($state);

// if (btn.className == "btn"){
//     btn.className = btn.dataset.class;
//     for (i = 0; i < x.length; i++) {x[i].className = " animated fadeInLeft "+$state;}
//     }
//     else{ 
//     for (i = 0; i < x.length; i++) {x[i].className = " animated fadeOutRight "+$state;}
//      btn.className = "btn";
//     }

// }

/* YYY*/
// $(document).ready(function () {
// $('.navbar-light .dmenu').hover(function () {
//         $(this).find('.sm-menu').first().stop(true, true).slideDown(150);
//     }, function () {
//         $(this).find('.sm-menu').first().stop(true, true).slideUp(105)
//     });
// });

/* YYY*/
// $(document).ready(function() {
//     $('[id^=detail-]').hide();
//     $('.toggle').click(function() {
//         $input = $( this );
//         $target = $('#'+$input.attr('data-toggle'));
//         $target.slideToggle();
//     });
// });



// jQuery(function($) {
  
  
//   var doAnimations = function() {
    
   
//     var offset = $(window).scrollTop() + $(window).height(),
//         $animatables = $('.animatable');
    
   
//     if ($animatables.length == 0) {
//       $(window).off('scroll', doAnimations);
//     }
    
    
//         $animatables.each(function(i) {
//        var $animatable = $(this);
//             if (($animatable.offset().top + $animatable.height() - 20) < offset) {
//         $animatable.removeClass('animatable').addClass('animated');
//             }
//     });

//     };
  
  
//     $(window).on('scroll', doAnimations);
//   $(window).trigger('scroll');

// });

/* YYY*/
// $(document).ready(function () {
// $('.navbar-light .dmenu').hover(function () {
//         $(this).find('.sm-menu').first().stop(true, true).slideDown(150);
//     }, function () {
//         $(this).find('.sm-menu').first().stop(true, true).slideUp(105)
//     });
// });

/* YYY*/
// $(document).ready(function() {
//     $('[id^=detail-]').hide();
//     $('.toggle').click(function() {
//         $input = $( this );
//         $target = $('#'+$input.attr('data-toggle'));
//         $target.slideToggle();
//     });
// });



// jQuery(function($) {
  
  
//   var doAnimations = function() {
    
   
//     var offset = $(window).scrollTop() + $(window).height(),
//         $animatables = $('.animatable');
    
   
//     if ($animatables.length == 0) {
//       $(window).off('scroll', doAnimations);
//     }
    
    
//         $animatables.each(function(i) {
//        var $animatable = $(this);
//             if (($animatable.offset().top + $animatable.height() - 20) < offset) {
//         $animatable.removeClass('animatable').addClass('animated');
//             }
//     });

//     };
  
  
//     $(window).on('scroll', doAnimations);
//   $(window).trigger('scroll');

// });



// WebFontConfig = {
//                 google: { families: [ 'Nunito+Sans:400,400i,700,700i,800,800i,900,900i', 'Quicksand:300,400,700'] }
//             };
//             (function() {
//                 var wf = document.createElement('script');
//                 wf.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
//                 wf.type = 'text/javascript';
//                 wf.async = 'true';
//                 var s = document.getElementsByTagName('script')[0];
//                 s.parentNode.insertBefore(wf, s);
//             })();


/* YYY*/
// var _html = document.documentElement,
//                 isTouch = (('ontouchstart' in _html) || (navigator.msMaxTouchPoints > 0) || (navigator.maxTouchPoints));

//             _html.className = _html.className.replace("no-js","js");
//             _html.classList.add( isTouch ? "touch" : "no-touch");


/* YYY*/
// (function(w, d){
//                         var m = d.getElementsByTagName('main')[0],
//                             s = d.createElement("script"),
//                             v = !("IntersectionObserver" in w) ? "8.17.0" : "11.0.6",
//                             o = {
//                                 elements_selector: ".lazy",
//                                 threshold: 500,
//                                 callback_enter: function (element) {

//                                 },
//                                 callback_load: function (element) {

//                                 },
//                                 callback_set: function (element) {

//                                     oTimeout = setTimeout(function ()
//                                     {
//                                         clearTimeout(oTimeout);

//                                         AOS.refresh();
//                                     }, 1000);
//                                 },
//                                 callback_error: function(element) {
//                                     element.src = "https://placeholdit.imgix.net/~text?txtsize=21&amp;txt=Image%20not%20load&amp;w=200&amp;h=200";
//                                 }
//                             };
//                         s.type = 'text/javascript';
//                         s.async = false; // This includes the script as async. See the "recipes" section for more information about async loading of LazyLoad.
//                         s.src = "https://cdn.jsdelivr.net/npm/vanilla-lazyload@" + v + "/dist/lazyload.min.js";
//                         m.appendChild(s);
//                         // m.insertBefore(s, m.firstChild);
//                         w.lazyLoadOptions = o;
//                     }(window, document));

/* YYY*/
// function filter($state){
// var x   = document.getElementsByClassName($state);
// var btn = document.getElementById($state);

// if (btn.className == "btn"){
//     btn.className = btn.dataset.class;
//     for (i = 0; i < x.length; i++) {x[i].className = " animated fadeInLeft "+$state;}
//     }
//     else{ 
//     for (i = 0; i < x.length; i++) {x[i].className = " animated fadeOutRight "+$state;}
//      btn.className = "btn";
//     }

// }

/* YYY*/
// $(document).ready(function () {
// $('.navbar-light .dmenu').hover(function () {
//         $(this).find('.sm-menu').first().stop(true, true).slideDown(150);
//     }, function () {
//         $(this).find('.sm-menu').first().stop(true, true).slideUp(105)
//     });
// });

/* YYY*/
// $(document).ready(function() {
//     $('[id^=detail-]').hide();
//     $('.toggle').click(function() {
//         $input = $( this );
//         $target = $('#'+$input.attr('data-toggle'));
//         $target.slideToggle();
//     });
// });



// WebFontConfig = {
//                 google: { families: [ 'Nunito+Sans:400,400i,700,700i,800,800i,900,900i', 'Quicksand:300,400,700'] }
//             };
//             (function() {
//                 var wf = document.createElement('script');
//                 wf.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
//                 wf.type = 'text/javascript';
//                 wf.async = 'true';
//                 var s = document.getElementsByTagName('script')[0];
//                 s.parentNode.insertBefore(wf, s);
//             })();


/* YYY*/
// var _html = document.documentElement,
//                 isTouch = (('ontouchstart' in _html) || (navigator.msMaxTouchPoints > 0) || (navigator.maxTouchPoints));

//             _html.className = _html.className.replace("no-js","js");
//             _html.classList.add( isTouch ? "touch" : "no-touch");

/* YYY*/
// (function(w, d){
//                         var m = d.getElementsByTagName('main')[0],
//                             s = d.createElement("script"),
//                             v = !("IntersectionObserver" in w) ? "8.17.0" : "11.0.6",
//                             o = {
//                                 elements_selector: ".lazy",
//                                 threshold: 500,
//                                 callback_enter: function (element) {

//                                 },
//                                 callback_load: function (element) {

//                                 },
//                                 callback_set: function (element) {

//                                     oTimeout = setTimeout(function ()
//                                     {
//                                         clearTimeout(oTimeout);

//                                         AOS.refresh();
//                                     }, 1000);
//                                 },
//                                 callback_error: function(element) {
//                                     element.src = "https://placeholdit.imgix.net/~text?txtsize=21&amp;txt=Image%20not%20load&amp;w=200&amp;h=200";
//                                 }
//                             };
//                         s.type = 'text/javascript';
//                         s.async = false; // This includes the script as async. See the "recipes" section for more information about async loading of LazyLoad.
//                         s.src = "https://cdn.jsdelivr.net/npm/vanilla-lazyload@" + v + "/dist/lazyload.min.js";
//                         m.appendChild(s);
//                         // m.insertBefore(s, m.firstChild);
//                         w.lazyLoadOptions = o;
//                     }(window, document));

/* YYY*/
//     function filter($state){
// var x   = document.getElementsByClassName($state);
// var btn = document.getElementById($state);

// if (btn.className == "btn"){
//     btn.className = btn.dataset.class;
//     for (i = 0; i < x.length; i++) {x[i].className = " animated fadeInLeft "+$state;}
//     }
//     else{ 
//     for (i = 0; i < x.length; i++) {x[i].className = " animated fadeOutRight "+$state;}
//      btn.className = "btn";
//     }

// }


// $(document).ready(function () {
// $('.navbar-light .dmenu').hover(function () {
//         $(this).find('.sm-menu').first().stop(true, true).slideDown(150);
//     }, function () {
//         $(this).find('.sm-menu').first().stop(true, true).slideUp(105)
//     });
// });


// $(document).ready(function() {
//     $('[id^=detail-]').hide();
//     $('.toggle').click(function() {
//         $input = $( this );
//         $target = $('#'+$input.attr('data-toggle'));
//         $target.slideToggle();
//     });
// });



// jQuery(function($) {
  
  
//   var doAnimations = function() {
    
   
//     var offset = $(window).scrollTop() + $(window).height(),
//         $animatables = $('.animatable');
    
   
//     if ($animatables.length == 0) {
//       $(window).off('scroll', doAnimations);
//     }
    
    
//         $animatables.each(function(i) {
//        var $animatable = $(this);
//             if (($animatable.offset().top + $animatable.height() - 20) < offset) {
//         $animatable.removeClass('animatable').addClass('animated');
//             }
//     });

//     };
  
  
//     $(window).on('scroll', doAnimations);
//   $(window).trigger('scroll');

// });


    // WebFontConfig = {
    //             google: { families: [ 'Nunito+Sans:400,400i,700,700i,800,800i,900,900i', 'Quicksand:300,400,700'] }
    //         };
    //         (function() {
    //             var wf = document.createElement('script');
    //             wf.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
    //             wf.type = 'text/javascript';
    //             wf.async = 'true';
    //             var s = document.getElementsByTagName('script')[0];
    //             s.parentNode.insertBefore(wf, s);
    //         })();


/* YYY*/
// var _html = document.documentElement,
//                 isTouch = (('ontouchstart' in _html) || (navigator.msMaxTouchPoints > 0) || (navigator.maxTouchPoints));

//             _html.className = _html.className.replace("no-js","js");
//             _html.classList.add( isTouch ? "touch" : "no-touch");

/* YYY*/
// (function(w, d){
//                         var m = d.getElementsByTagName('main')[0],
//                             s = d.createElement("script"),
//                             v = !("IntersectionObserver" in w) ? "8.17.0" : "11.0.6",
//                             o = {
//                                 elements_selector: ".lazy",
//                                 threshold: 500,
//                                 callback_enter: function (element) {

//                                 },
//                                 callback_load: function (element) {

//                                 },
//                                 callback_set: function (element) {

//                                     oTimeout = setTimeout(function ()
//                                     {
//                                         clearTimeout(oTimeout);

//                                         AOS.refresh();
//                                     }, 1000);
//                                 },
//                                 callback_error: function(element) {
//                                     element.src = "https://placeholdit.imgix.net/~text?txtsize=21&txt=Image%20not%20load&w=200&h=200";
//                                 }
//                             };
//                         s.type = 'text/javascript';
//                         s.async = false; // This includes the script as async. See the "recipes" section for more information about async loading of LazyLoad.
//                         s.src = "https://cdn.jsdelivr.net/npm/vanilla-lazyload@" + v + "/dist/lazyload.min.js";
//                         m.appendChild(s);
//                         // m.insertBefore(s, m.firstChild);
//                         w.lazyLoadOptions = o;
//                     }(window, document));


// WebFontConfig = {
//                 google: { families: [ 'Nunito+Sans:400,400i,700,700i,800,800i,900,900i', 'Quicksand:300,400,700'] }
//             };
//             (function() {
//                 var wf = document.createElement('script');
//                 wf.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
//                 wf.type = 'text/javascript';
//                 wf.async = 'true';
//                 var s = document.getElementsByTagName('script')[0];
//                 s.parentNode.insertBefore(wf, s);
//             })();

/* YYY*/
            // var _html = document.documentElement,
            //     isTouch = (('ontouchstart' in _html) || (navigator.msMaxTouchPoints > 0) || (navigator.maxTouchPoints));

            // _html.className = _html.className.replace("no-js","js");
            // _html.classList.add( isTouch ? "touch" : "no-touch");



/* YYY*/
    // (function(w, d){
    //                     var m = d.getElementsByTagName('main')[0],
    //                         s = d.createElement("script"),
    //                         v = !("IntersectionObserver" in w) ? "8.17.0" : "11.0.6",
    //                         o = {
    //                             elements_selector: ".lazy",
    //                             threshold: 500,
    //                             callback_enter: function (element) {

    //                             },
    //                             callback_load: function (element) {

    //                             },
    //                             callback_set: function (element) {

    //                                 oTimeout = setTimeout(function ()
    //                                 {
    //                                     clearTimeout(oTimeout);

    //                                     AOS.refresh();
    //                                 }, 1000);
    //                             },
    //                             callback_error: function(element) {
    //                                 element.src = "https://placeholdit.imgix.net/~text?txtsize=21&txt=Image%20not%20load&w=200&h=200";
    //                             }
    //                         };
    //                     s.type = 'text/javascript';
    //                     s.async = false; // This includes the script as async. See the "recipes" section for more information about async loading of LazyLoad.
    //                     s.src = "https://cdn.jsdelivr.net/npm/vanilla-lazyload@" + v + "/dist/lazyload.min.js";
    //                     m.appendChild(s);
    //                     // m.insertBefore(s, m.firstChild);
    //                     w.lazyLoadOptions = o;
    //                 }(window, document));




    // WebFontConfig = {
    //             google: { families: [ 'Nunito+Sans:400,400i,700,700i,800,800i,900,900i', 'Quicksand:300,400,700'] }
    //         };
    //         (function() {
    //             var wf = document.createElement('script');
    //             wf.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
    //             wf.type = 'text/javascript';
    //             wf.async = 'true';
    //             var s = document.getElementsByTagName('script')[0];
    //             s.parentNode.insertBefore(wf, s);
    //         })();


/* YYY*/
// var _html = document.documentElement,
//                 isTouch = (('ontouchstart' in _html) || (navigator.msMaxTouchPoints > 0) || (navigator.maxTouchPoints));

//             _html.className = _html.className.replace("no-js","js");
//             _html.classList.add( isTouch ? "touch" : "no-touch");

/* YYY*/
// var _html = document.documentElement,
//                 isTouch = (('ontouchstart' in _html) || (navigator.msMaxTouchPoints > 0) || (navigator.maxTouchPoints));

//             _html.className = _html.className.replace("no-js","js");
//             _html.classList.add( isTouch ? "touch" : "no-touch");



// WebFontConfig = {
//                 google: { families: [ 'Nunito+Sans:400,400i,700,700i,800,800i,900,900i', 'Quicksand:300,400,700'] }
//             };
//             (function() {
//                 var wf = document.createElement('script');
//                 wf.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
//                 wf.type = 'text/javascript';
//                 wf.async = 'true';
//                 var s = document.getElementsByTagName('script')[0];
//                 s.parentNode.insertBefore(wf, s);
//             })();


/* YYY*/
// var _html = document.documentElement,
//                 isTouch = (('ontouchstart' in _html) || (navigator.msMaxTouchPoints > 0) || (navigator.maxTouchPoints));

//             _html.className = _html.className.replace("no-js","js");
//             _html.classList.add( isTouch ? "touch" : "no-touch");

/* YYY*/
// function filter($state){
// var x   = document.getElementsByClassName($state);
// var btn = document.getElementById($state);

// if (btn.className == "btn"){
//     btn.className = btn.dataset.class;
//     for (i = 0; i < x.length; i++) {x[i].className = " animated fadeInLeft "+$state;}
//     }
//     else{ 
//     for (i = 0; i < x.length; i++) {x[i].className = " animated fadeOutRight "+$state;}
//      btn.className = "btn";
//     }

// }

/* YYY*/
// $(document).ready(function () {
// $('.navbar-light .dmenu').hover(function () {
//         $(this).find('.sm-menu').first().stop(true, true).slideDown(150);
//     }, function () {
//         $(this).find('.sm-menu').first().stop(true, true).slideUp(105)
//     });
// });


/* YYY*/
// $(document).ready(function() {
//     $('[id^=detail-]').hide();
//     $('.toggle').click(function() {
//         $input = $( this );
//         $target = $('#'+$input.attr('data-toggle'));
//         $target.slideToggle();
//     });
// });

/* YYY*/
// (function(w, d){
//                         var m = d.getElementsByTagName('main')[0],
//                             s = d.createElement("script"),
//                             v = !("IntersectionObserver" in w) ? "8.17.0" : "11.0.6",
//                             o = {
//                                 elements_selector: ".lazy",
//                                 threshold: 500,
//                                 callback_enter: function (element) {

//                                 },
//                                 callback_load: function (element) {

//                                 },
//                                 callback_set: function (element) {

//                                     oTimeout = setTimeout(function ()
//                                     {
//                                         clearTimeout(oTimeout);

//                                         AOS.refresh();
//                                     }, 1000);
//                                 },
//                                 callback_error: function(element) {
//                                     element.src = "https://placeholdit.imgix.net/~text?txtsize=21&amp;txt=Image%20not%20load&amp;w=200&amp;h=200";
//                                 }
//                             };
//                         s.type = 'text/javascript';
//                         s.async = false; // This includes the script as async. See the "recipes" section for more information about async loading of LazyLoad.
//                         s.src = "https://cdn.jsdelivr.net/npm/vanilla-lazyload@" + v + "/dist/lazyload.min.js";
//                         m.appendChild(s);
//                         // m.insertBefore(s, m.firstChild);
//                         w.lazyLoadOptions = o;
//                     }(window, document));

// WebFontConfig = {
//                 google: { families: [ 'Nunito+Sans:400,400i,700,700i,800,800i,900,900i', 'Quicksand:300,400,700'] }
//             };
//             (function() {
//                 var wf = document.createElement('script');
//                 wf.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
//                 wf.type = 'text/javascript';
//                 wf.async = 'true';
//                 var s = document.getElementsByTagName('script')[0];
//                 s.parentNode.insertBefore(wf, s);
//             })();


/* YYY*/
// var _html = document.documentElement,
//                 isTouch = (('ontouchstart' in _html) || (navigator.msMaxTouchPoints > 0) || (navigator.maxTouchPoints));

//             _html.className = _html.className.replace("no-js","js");
//             _html.classList.add( isTouch ? "touch" : "no-touch");


/* YYY*/
// (function(w, d){
//                         var m = d.getElementsByTagName('main')[0],
//                             s = d.createElement("script"),
//                             v = !("IntersectionObserver" in w) ? "8.17.0" : "11.0.6",
//                             o = {
//                                 elements_selector: ".lazy",
//                                 threshold: 500,
//                                 callback_enter: function (element) {

//                                 },
//                                 callback_load: function (element) {

//                                 },
//                                 callback_set: function (element) {

//                                     oTimeout = setTimeout(function ()
//                                     {
//                                         clearTimeout(oTimeout);

//                                         AOS.refresh();
//                                     }, 1000);
//                                 },
//                                 callback_error: function(element) {
//                                     element.src = "https://placeholdit.imgix.net/~text?txtsize=21&amp;txt=Image%20not%20load&amp;w=200&amp;h=200";
//                                 }
//                             };
//                         s.type = 'text/javascript';
//                         s.async = false; // This includes the script as async. See the "recipes" section for more information about async loading of LazyLoad.
//                         s.src = "https://cdn.jsdelivr.net/npm/vanilla-lazyload@" + v + "/dist/lazyload.min.js";
//                         m.appendChild(s);
//                         // m.insertBefore(s, m.firstChild);
//                         w.lazyLoadOptions = o;
//                     }(window, document));

/* YYY*/
// function filter($state){
// var x   = document.getElementsByClassName($state);
// var btn = document.getElementById($state);

// if (btn.className == "btn"){
//     btn.className = btn.dataset.class;
//     for (i = 0; i < x.length; i++) {x[i].className = " animated fadeInLeft "+$state;}
//     }
//     else{ 
//     for (i = 0; i < x.length; i++) {x[i].className = " animated fadeOutRight "+$state;}
//      btn.className = "btn";
//     }

// }

// WebFontConfig = {
//                 google: { families: [ 'Nunito+Sans:400,400i,700,700i,800,800i,900,900i', 'Quicksand:300,400,700'] }
//             };
//             (function() {
//                 var wf = document.createElement('script');
//                 wf.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
//                 wf.type = 'text/javascript';
//                 wf.async = 'true';
//                 var s = document.getElementsByTagName('script')[0];
//                 s.parentNode.insertBefore(wf, s);
//             })();


/* YYY*/
// var _html = document.documentElement,
//                 isTouch = (('ontouchstart' in _html) || (navigator.msMaxTouchPoints > 0) || (navigator.maxTouchPoints));

//             _html.className = _html.className.replace("no-js","js");
//             _html.classList.add( isTouch ? "touch" : "no-touch");

/* YYY*/
// (function(w, d){
//                         var m = d.getElementsByTagName('main')[0],
//                             s = d.createElement("script"),
//                             v = !("IntersectionObserver" in w) ? "8.17.0" : "11.0.6",
//                             o = {
//                                 elements_selector: ".lazy",
//                                 threshold: 500,
//                                 callback_enter: function (element) {

//                                 },
//                                 callback_load: function (element) {

//                                 },
//                                 callback_set: function (element) {

//                                     oTimeout = setTimeout(function ()
//                                     {
//                                         clearTimeout(oTimeout);

//                                         AOS.refresh();
//                                     }, 1000);
//                                 },
//                                 callback_error: function(element) {
//                                     element.src = "https://placeholdit.imgix.net/~text?txtsize=21&amp;txt=Image%20not%20load&amp;w=200&amp;h=200";
//                                 }
//                             };
//                         s.type = 'text/javascript';
//                         s.async = false; // This includes the script as async. See the "recipes" section for more information about async loading of LazyLoad.
//                         s.src = "https://cdn.jsdelivr.net/npm/vanilla-lazyload@" + v + "/dist/lazyload.min.js";
//                         m.appendChild(s);
//                         // m.insertBefore(s, m.firstChild);
//                         w.lazyLoadOptions = o;
//                     }(window, document));

/* YYY*/
// $(document).ready(function () {
// $('.navbar-light .dmenu').hover(function () {
//         $(this).find('.sm-menu').first().stop(true, true).slideDown(150);
//     }, function () {
//         $(this).find('.sm-menu').first().stop(true, true).slideUp(105)
//     });
// });

/* YYY*/
// $(document).ready(function() {
//     $('[id^=detail-]').hide();
//     $('.toggle').click(function() {
//         $input = $( this );
//         $target = $('#'+$input.attr('data-toggle'));
//         $target.slideToggle();
//     });
// });

// WebFontConfig = {
//                 google: { families: [ 'Nunito+Sans:400,400i,700,700i,800,800i,900,900i', 'Quicksand:300,400,700'] }
//             };
//             (function() {
//                 var wf = document.createElement('script');
//                 wf.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
//                 wf.type = 'text/javascript';
//                 wf.async = 'true';
//                 var s = document.getElementsByTagName('script')[0];
//                 s.parentNode.insertBefore(wf, s);
//             })();


/* YYY*/
            // var _html = document.documentElement,
            //     isTouch = (('ontouchstart' in _html) || (navigator.msMaxTouchPoints > 0) || (navigator.maxTouchPoints));

            // _html.className = _html.className.replace("no-js","js");
            // _html.classList.add( isTouch ? "touch" : "no-touch");



/* YYY*/
// (function(w, d){
//                         var m = d.getElementsByTagName('main')[0],
//                             s = d.createElement("script"),
//                             v = !("IntersectionObserver" in w) ? "8.17.0" : "11.0.6",
//                             o = {
//                                 elements_selector: ".lazy",
//                                 threshold: 500,
//                                 callback_enter: function (element) {

//                                 },
//                                 callback_load: function (element) {

//                                 },
//                                 callback_set: function (element) {

//                                     oTimeout = setTimeout(function ()
//                                     {
//                                         clearTimeout(oTimeout);

//                                         AOS.refresh();
//                                     }, 1000);
//                                 },
//                                 callback_error: function(element) {
//                                     element.src = "https://placeholdit.imgix.net/~text?txtsize=21&amp;txt=Image%20not%20load&amp;w=200&amp;h=200";
//                                 }
//                             };
//                         s.type = 'text/javascript';
//                         s.async = false; // This includes the script as async. See the "recipes" section for more information about async loading of LazyLoad.
//                         s.src = "https://cdn.jsdelivr.net/npm/vanilla-lazyload@" + v + "/dist/lazyload.min.js";
//                         m.appendChild(s);
//                         // m.insertBefore(s, m.firstChild);
//                         w.lazyLoadOptions = o;
//                     }(window, document));

/* YYY*/
// function filter($state){
// var x   = document.getElementsByClassName($state);
// var btn = document.getElementById($state);

// if (btn.className == "btn"){
//     btn.className = btn.dataset.class;
//     for (i = 0; i < x.length; i++) {x[i].className = " animated fadeInLeft "+$state;}
//     }
//     else{ 
//     for (i = 0; i < x.length; i++) {x[i].className = " animated fadeOutRight "+$state;}
//      btn.className = "btn";
//     }

// }

/* YYY*/
// $(document).ready(function () {
// $('.navbar-light .dmenu').hover(function () {
//         $(this).find('.sm-menu').first().stop(true, true).slideDown(150);
//     }, function () {
//         $(this).find('.sm-menu').first().stop(true, true).slideUp(105)
//     });
// });

/* YYY*/
$(document).ready(function() {
    $('[id^=detail-]').hide();
    $('.toggle').click(function() {
        $input = $( this );
        $target = $('#'+$input.attr('data-toggle'));
        $target.slideToggle();
    });
});




//$('#mySelect2').select2();


$(function () {
    $('.button-checkbox').each(function () {

        // Settings
        var $widget = $(this),
            $button = $widget.find('button'),
            $checkbox = $widget.find('input:checkbox'),
            color = $button.data('color'),
            settings = {
                on: {
                    icon: 'glyphicon glyphicon-check'
                },
                off: {
                    icon: 'glyphicon glyphicon-unchecked'
                }
            };

        // Event Handlers
        $button.on('click', function () {
            $checkbox.prop('checked', !$checkbox.is(':checked'));
            $checkbox.triggerHandler('change');
            updateDisplay();
        });
        $checkbox.on('change', function () {
            updateDisplay();
        });

        // Actions
        function updateDisplay() {
            var isChecked = $checkbox.is(':checked');

            // Set the button's state
            $button.data('state', (isChecked) ? "on" : "off");

            // Set the button's icon
            $button.find('.state-icon')
                .removeClass()
                .addClass('state-icon ' + settings[$button.data('state')].icon);

            // Update the button's color
            if (isChecked) {
                $button
                    .removeClass('btn-default')
                    .addClass('btn-' + color + ' active');
            }
            else {
                $button
                    .removeClass('btn-' + color + ' active')
                    .addClass('btn-default');
            }
        }

        // Initialization
        function init() {

            updateDisplay();

            // Inject the icon if applicable
            if ($button.find('.state-icon').length == 0) {
                $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i> ');
            }
        }
        init();
    });
});


$(document).on('click','.invest-selector', function(e){
  $('.row-selector').css('display','none');
  var cls = $(this).attr('data-rowid');
  $('#'+cls).css('display','flex');
  $('#span-txt').text($(this).attr('data-text'));
});

$(document).on('click','.btn-dfault-amt', function(e){
  $('.input-amt').val($(this).text());
});


$(document).ready(function() {
    $('.invest-month').select2();
});






$('.btn-number').click(function(e){
    e.preventDefault();
    
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {
            
            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            } 
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }

        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});

$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});

$('.input-number').change(function() {
    
    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());
    
    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    
    
});

$(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });







// $('.btn-number').click(function(e){
//     e.preventDefault();
    
//     fieldName = $(this).attr('data-field');
//     type      = $(this).attr('data-type');
//     var input = $("input[name='"+fieldName+"']");
//     var currentVal = parseInt(input.val());
//     if (!isNaN(currentVal)) {
//         if(type == 'minus') {
            
//             if(currentVal > input.attr('min')) {
//                 input.val(currentVal - 1).change();
//             } 
//             if(parseInt(input.val()) == input.attr('min')) {
//                 $(this).attr('disabled', true);
//             }

//         } else if(type == 'plus') {

//             if(currentVal < input.attr('max')) {
//                 input.val(currentVal + 1).change();
//             }
//             if(parseInt(input.val()) == input.attr('max')) {
//                 $(this).attr('disabled', true);
//             }

//         }
//     } else {
//         input.val(0);
//     }
// });

// $('.input-number').focusin(function(){
//   $(this).data('oldValue', $(this).val());
// });

// $('.input-number').change(function() {
    
//     minValue =  parseInt($(this).attr('min'));
//     maxValue =  parseInt($(this).attr('max'));
//     valueCurrent = parseInt($(this).val());
    
//     name = $(this).attr('name');
//     if(valueCurrent >= minValue) {
//         $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
//     } else {
//         alert('Sorry, the minimum value was reached');
//         $(this).val($(this).data('oldValue'));
//     }
//     if(valueCurrent <= maxValue) {
//         $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
//     } else {
//         alert('Sorry, the maximum value was reached');
//         $(this).val($(this).data('oldValue'));
//     }
    
    
// });

// $(".input-number").keydown(function (e) {
//         // Allow: backspace, delete, tab, escape, enter and .
//         if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
//              // Allow: Ctrl+A
//             (e.keyCode == 65 && e.ctrlKey === true) || 
//              // Allow: home, end, left, right
//             (e.keyCode >= 35 && e.keyCode <= 39)) {
//                  // let it happen, don't do anything
//                  return;
//         }
//         // Ensure that it is a number and stop the keypress
//         if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
//             e.preventDefault();
//         }
//     });












$('.mint1').click(function(e){
    e.preventDefault();
    
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {
            
            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            } 
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }

        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});

$('.mint1').focusin(function(){
   $(this).data('oldValue', $(this).val());
});

$('.mint1').change(function() {
    
    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());
    
    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(".mint1[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".mint1[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    
    
});

$(".mint1").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });














// $('.btn-number').click(function(e){
//     e.preventDefault();
    
//     fieldName = $(this).attr('data-field');
//     type      = $(this).attr('data-type');
//     var input = $("input[name='"+fieldName+"']");
//     var currentVal = parseInt(input.val());
//     if (!isNaN(currentVal)) {
//         if(type == 'minus') {
            
//             if(currentVal > input.attr('min')) {
//                 input.val(currentVal - 1).change();
//             } 
//             if(parseInt(input.val()) == input.attr('min')) {
//                 $(this).attr('disabled', true);
//             }

//         } else if(type == 'plus') {

//             if(currentVal < input.attr('max')) {
//                 input.val(currentVal + 1).change();
//             }
//             if(parseInt(input.val()) == input.attr('max')) {
//                 $(this).attr('disabled', true);
//             }

//         }
//     } else {
//         input.val(0);
//     }
// });
// $('.input-number').focusin(function(){
//    $(this).data('oldValue', $(this).val());
// });
// $('.input-number').change(function() {
    
//     minValue =  parseInt($(this).attr('min'));
//     maxValue =  parseInt($(this).attr('max'));
//     valueCurrent = parseInt($(this).val());
    
//     name = $(this).attr('name');
//     if(valueCurrent >= minValue) {
//         $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
//     } else {
//         alert('Sorry, the minimum value was reached');
//         $(this).val($(this).data('oldValue'));
//     }
//     if(valueCurrent <= maxValue) {
//         $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
//     } else {
//         alert('Sorry, the maximum value was reached');
//         $(this).val($(this).data('oldValue'));
//     }
    
    
// });




// $(".input-number").keydown(function (e) {
//         // Allow: backspace, delete, tab, escape, enter and .
//         if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
//              // Allow: Ctrl+A
//             (e.keyCode == 65 && e.ctrlKey === true) || 
//              // Allow: home, end, left, right
//             (e.keyCode >= 35 && e.keyCode <= 39)) {
//                  // let it happen, don't do anything
//                  return;
//         }
//         // Ensure that it is a number and stop the keypress
//         if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
//             e.preventDefault();
//         }
//     });



// $(document).ready(function(){
//   $("checkbox").click(function(){
//     $(".fontello-check").addClass("intro");
//   });
// });

  $(".cb-checkbox").change(function() {     
     $("label[for='"+$(this).attr("id")+"']").button('toggle');    
     $("#test-if-checked").hide();     
     if(this.checked) {
         $(".mail-btn").addClass("active");
         $("#test-if-checked").show();
     }else{ $(".mail-btn").removeClass("active");

     }
});


  $(".cb-checkbox1").change(function() {     
     $("label[for='"+$(this).attr("id1")+"']").button('toggle1');    
     $("#test-if-checked1").hide();     
     if(this.checked) {
         $(".mail-btn1").addClass("active");
         $("#test-if-checked1").show();
     }else{ $(".mail-btn1").removeClass("active");

     }
});

  $(".cb-checkbox3").change(function() {     
     $("label[for='"+$(this).attr("id3")+"']").button('toggle3');    
     $("#test-if-checked3").hide();     
     if(this.checked) {
         $(".mail-btn3").addClass("active");
         $("#test-if-checked3").show();
     }else{ $(".mail-btn3").removeClass("active");

     }
});

  $(".cb-checkbox2").change(function() {     
     $("label[for='"+$(this).attr("id2")+"']").button('toggle2');    
     $("#test-if-checked2").hide();     
     if(this.checked) {
         $(".mail-btn2").addClass("active");
         $("#test-if-checked2").show();
     }else{ $(".mail-btn2").removeClass("active");

     }
});
$(document).on('touchstart', function(){
    $("label").addClass("no-hover");
});

 $(".cb-checkbox4").change(function() {     
     $("label[for='"+$(this).attr("id4")+"']").button('toggle4');    
     $("#test-if-checked4").hide();     
     if(this.checked) {
        $(".mail-btn4").addClass("active");
         $("#test-if-checked4").show();
          }else{ $(".mail-btn4").removeClass("active");
     }
});
$(document).on('touchstart', function(){
    $("label").addClass("no-hover");
});

 $(".cb-checkbox5").change(function() {     
     $("label[for='"+$(this).attr("id5")+"']").button('toggle5');    
     $("#test-if-checked5").hide();     
     if(this.checked) {
         $(".mail-btn5").addClass("active");
         $("#test-if-checked5").show();
          }else{ $(".mail-btn5").removeClass("active");
     }
});

$(".cb-checkbox12").change(function() {     
     $("label[for='"+$(this).attr("id12")+"']").button('toggle12');    
     $("#test-if-checked12").hide();     
     if(this.checked) {
         $(".mail-btn12").addClass("active");
         $("#test-if-checked12").show();
          }else{ $(".mail-btn12").removeClass("active");
     }
});

$(document).on('touchstart', function(){
    $("label").addClass("no-hover");
});

$(".cb-checkbox6").change(function() {     
     $("label[for='"+$(this).attr("id6")+"']").button('toggle6');    
     $("#test-if-checked6").hide();     
     if(this.checked) {
         $(".mail-btn6").addClass("active");
         $("#test-if-checked6").show();
         }else{ $(".mail-btn6").removeClass("active");
     }
});
$(document).on('touchstart', function(){
    $("label").addClass("no-hover");
});

$(".cb-checkbox7").change(function() {     
     $("label[for='"+$(this).attr("id7")+"']").button('toggle7');    
     $("#test-if-checked7").hide();     
     if(this.checked) {
        $(".mail-btn7").addClass("active");
         $("#test-if-checked7").show();
          }else{ $(".mail-btn7").removeClass("active");
     }
});
$(document).on('touchstart', function(){
    $("label").addClass("no-hover");
});


  $(".cb-checkbox").change(function() {     
     $("label[for='"+$(this).attr("id")+"']").button('toggle');    
     $("#test-if-checked").hide();     
     if(this.checked) {
         $("#test-if-checked").show();
     }
});
$(document).on('touchstart', function(){
    $("label").addClass("no-hover");
});

  $(".cb-checkbox2").change(function() {     
     $("label[for='"+$(this).attr("id2")+"']").button('toggle2');    
     $("#test-if-checked2").hide();     
     if(this.checked) {
         $("#test-if-checked2").show();
    
     }
});

$(document).on('touchstart', function(){
    $("label").addClass("no-hover");
});







$('.add').click(function () {
        if ($(this).prev().val() < 10) {
        $(this).prev().val(+$(this).prev().val() + 1);
        }
});
$('.sub').click(function () {
        if ($(this).next().val() > 1) {
        if ($(this).next().val() > 1) $(this).next().val(+$(this).next().val() - 1);
        }
});


 $(document).ready(function() {
      $(".add-more").click(function(){ 
     
       var len= $('.row-tr').length+1;
      // var counter = (len)?len+1?1;
       var html = '<div class="row row-tr" id="">'+
                           '<div class="col-md-3 col-sm-3 mt-2">'+
                            '<span class="tr-label">Traveller</span>'+
                            '</div>'+
                            '<div class="col-md-6 col-sm-6">'+
                                 '<input type="text"  maxlength="2" name="" onkeypress="validate(event)" class="float-input valid-age input-age form-control add-travel-but"  placeholder="Age (Years)">'+
                            '</div>'+
                            '<div class="col-md-1 col-sm-1 mt-2">'+
                                '<a class="text-danger remove-btn"><small class="fa fa-times"></small></a>'+
                            '</div>'+
                        '</div>'
        $('#traveller-contain').append(html);
        var index=2; $(".tr-label").each(function() {
                         $(this).text("Traveller - "+index);
                      
       index++; });
          var index=2; $(".row-tr").each(function() {
                         $(this).attr("id" , "row-id-"+index);
                      
       index++; });

           var index=2; $(".input-age").each(function() {
                         $(this).attr("id" , "tr-age-"+index);
                        $(this).attr("name" , "tr-age-"+index);
       index++; });
           var index=2; $(".remove-btn").each(function() {
                         $(this).attr("id" , "remove-id-"+index);
                         $(this).attr("data-id" , index);
                      
       index++; });
      });
      $("body").on("click",".remove-btn",function(){ 
          var id = $(this).attr("data-id");
          $('#row-id-'+id).remove();

      });
    });

function validate(evt) {
  var theEvent = evt || window.event;

  // Handle paste
  if (theEvent.type === 'paste') {
      key = event.clipboardData.getData('text/plain');
  } else {
  // Handle key press
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode(key);
  }
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}
function abc(){
    alert('hello');
    return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));
}

 // $(document).ready(function() {
 //      $(".add-more").click(function(){ 
 //       var clone =  $('.clone-row').clone(); 
 //       var len= $('.row-tr').length+1;
 //      // var counter = (len)?len+1?1;
 //       var html = '<div class="row row-tr" id="">'+
 //                           '<div class="col-md-3 col-sm-3 mt-2">'+
 //                            '<span class="tr-label">Traveller</span>'+
 //                            '</div>'+
 //                            '<div class="col-md-6 col-sm-6">'+
 //                                 '<input type="text" class="form-control add-travel-but" id="formGroupExampleInput" placeholder="Age (Years)">'+
 //                            '</div>'+
 //                            '<div class="col-md-1 col-sm-1 mt-2">'+
 //                                '<a class="text-danger remove-btn"><small class="fa fa-times"></small></a>'+
 //                            '</div>'+
 //                        '</div>'
 //        $('#traveller-contain').append(html);
 //        var index=2; $(".tr-label").each(function() {
 //                         $(this).text("Traveller - "+index);
                      
 //       index++; });
 //          var index=2; $(".row-tr").each(function() {
 //                         $(this).attr("id" , "row-id-"+index);
                      
 //       index++; });
 //           var index=2; $(".remove-btn").each(function() {
 //                         $(this).attr("id" , "remove-id-"+index);
 //                         $(this).attr("data-id" , index);
                      
 //       index++; });
 //      });
 //      $("body").on("click",".remove-btn",function(){ 
 //          var id = $(this).attr("data-id");
 //          $('#row-id-'+id).remove();

 //      });
 //    });
  

  $(document).ready(function () {
//called when key is pressed in textbox
$(".integer-mobile").keypress(function (e) {
//if the letter is not digit then display error and don't type anything
if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
//display error message
$(this).css('border-color','red');
return false;
}else{
$(this).css('border-color','#ddd');
}
});
});
$('input.integer-mobile').on('keyup', function() {
    limitText(this, 10)
});

function limitText(field, maxChar){
    var ref = $(field),
        val = ref.val();
    if ( val.length >= maxChar ){
        ref.val(function() {
            console.log(val.substr(0, maxChar))
            return val.substr(0, maxChar);       
        });
    }
}




 AOS.init({
  unable: function() {
    var maxWidth = 800;
    return window.innerWidth < maxWidth;
  }
});

$('#yourElement').addClass('animated bounceOutLeft');








var rangeSlider = function(){
  var slider = $('.range-slider'),
      range = $('.range-slider__range'),
      value = $('.range-slider__value');
    
  slider.each(function(){

    value.each(function(){
      var value = $(this).prev().attr('value');
      $(this).html(value);
    });
  });
};

// rangeSlider();


// var sliderLeft=document.getElementById("slider0to50");
//  var sliderRight=document.getElementById("slider51to100");
//  var inputMin=document.getElementById("min");
//  var inputMax=document.getElementById("max");


// function sliderLeftInput(){
//     sliderLeft.value=inputMin.value;
// }
// function sliderRightInput(){
//     sliderRight.value=(inputMax.value);
// }

// inputMin.addEventListener("change",sliderLeftInput);
// inputMax.addEventListener("change",sliderRightInput);


// function inputMinSliderLeft(){
//     inputMin.value=sliderLeft.value;
// }
// function inputMaxSliderRight(){
//     inputMax.value=sliderRight.value;
// }
// sliderLeft.addEventListener("change",inputMinSliderLeft);
// sliderRight.addEventListener("change",inputMaxSliderRight);









    AOS.init({
  duration: 1200,
})