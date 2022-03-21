/*!
 * Bracket Plus v1.1.0 (https://themetrace.com/bracketplus)
 * Copyright 2017-2018 ThemePixels
 * Licensed under ThemeForest License
 */

 'use strict';

 $(document).ready(function(){
     
  var _token = $('meta[name="csrf-token"]').attr('content'); 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': _token
        }
    });

  // This will collapsed sidebar menu on left into a mini icon menu
  $('#btnLeftMenu').on('click', function(){
    var menuText = $('.menu-item-label');

    if($('body').hasClass('collapsed-menu')) {
      $('body').removeClass('collapsed-menu');

      // show current sub menu when reverting back from collapsed menu
      $('.show-sub + .br-menu-sub').slideDown();

      $('.br-sideleft').one('transitionend', function(e) {
        menuText.removeClass('op-lg-0-force');
        menuText.removeClass('d-lg-none');
      });

    } else {
      $('body').addClass('collapsed-menu');

      // hide toggled sub menu
      $('.show-sub + .br-menu-sub').slideUp();

      menuText.addClass('op-lg-0-force');
      $('.br-sideleft').one('transitionend', function(e) {
        menuText.addClass('d-lg-none');
      });
    }
    return false;
  });



  // This will expand the icon menu when mouse cursor points anywhere
  // inside the sidebar menu on left. This will only trigget to left sidebar
  // when it's in collapsed mode (the icon only menu)
  $(document).on('mouseover', function(e){
    e.stopPropagation();

    if($('body').hasClass('collapsed-menu') && $('#btnLeftMenu').is(':visible')) {
      var targ = $(e.target).closest('.br-sideleft').length;
      if(targ) {
        $('body').addClass('expand-menu');

        // show current shown sub menu that was hidden from collapsed
        $('.show-sub + .br-menu-sub').slideDown();

        var menuText = $('.menu-item-label');
        menuText.removeClass('d-lg-none');
        menuText.removeClass('op-lg-0-force');

      } else {
        $('body').removeClass('expand-menu');

        // hide current shown menu
        $('.show-sub + .br-menu-sub').slideUp();

        var menuText = $('.menu-item-label');
        menuText.addClass('op-lg-0-force');
        menuText.addClass('d-lg-none');
      }
    }
  });



  // This will show sub navigation menu on left sidebar
  // only when that top level menu have a sub menu on it.
  $('.br-sideleft').on('click', '.br-menu-link', function(){
    var nextElem = $(this).next();
    var thisLink = $(this);

    if(nextElem.hasClass('br-menu-sub')) {

      if(nextElem.is(':visible')) {
        thisLink.removeClass('show-sub');
        nextElem.slideUp();
      } else {
        $('.br-menu-link').each(function(){
          $(this).removeClass('show-sub');
        });

        $('.br-menu-sub').each(function(){
          $(this).slideUp();
        });

        thisLink.addClass('show-sub');
        nextElem.slideDown();
      }
      return false;
    }
  });



  // This will trigger only when viewed in small devices
  // #btnLeftMenuMobile element is hidden in desktop but
  // visible in mobile. When clicked the left sidebar menu
  // will appear pushing the main content.
  $('#btnLeftMenuMobile').on('click', function(){
    $('body').addClass('show-left');
    return false;
  });



  // This is the right menu icon when it's clicked, the
  // right sidebar will appear that contains the four tab menu
  $('#btnRightMenu').on('click', function(){
    $('body').addClass('show-right');
    return false;
  });



  // This will hide sidebar when it's clicked outside of it
  $(document).on('click touchstart', function(e){
    e.stopPropagation();

    // closing left sidebar
    if($('body').hasClass('show-left')) {
      var targ = $(e.target).closest('.br-sideleft').length;
      if(!targ) {
        $('body').removeClass('show-left');
      }
    }

    // closing right sidebar
    if($('body').hasClass('show-right')) {
      var targ = $(e.target).closest('.br-sideright').length;
      if(!targ) {
        $('body').removeClass('show-right');
      }
    }
  });



  // displaying time and date in right sidebar
  var interval = setInterval(function() {
    var momentNow = moment();
    $('#brDate').html(momentNow.format('MMMM DD, YYYY') + ' '
      + momentNow.format('dddd')
      .substring(0,3).toUpperCase());
      $('#brTime').html(momentNow.format('hh:mm:ss A'));
  }, 100);

  // Datepicker
  if($().datepicker) {
    $('.form-control-datepicker').datepicker()
      .on("change", function (e) {
        console.log("Date changed: ", e.target.value);
    });
  }

  // custom scrollbar style
  new PerfectScrollbar('.sideleft-scrollbar', {
    suppressScrollX: true
  });
     if($('.contact-scrollbar').length>0){
      new PerfectScrollbar('.contact-scrollbar', {
        suppressScrollX: true
      });
     }
 
  if($('.attachment-scrollbar').length>0){
  new PerfectScrollbar('.attachment-scrollbar', {
    suppressScrollX: true
  });
  }
  if($('.schedule-scrollbar').length>0){
  new PerfectScrollbar('.schedule-scrollbar', {
    suppressScrollX: true
  });
  }
  
  if($('.settings-scrollbar').length>0){
  new PerfectScrollbar('.settings-scrollbar', {
    suppressScrollX: true
  });
  }

  // jquery ui datepicker
  $('.datepicker').datepicker();

  // switch button
  $('.br-switchbutton').on('click', function(){
    $(this).toggleClass('checked');
  });

  // peity charts
  $('.peity-bar').peity('bar');

  // highlight syntax highlighter
  $('pre code').each(function(i, block) {
    hljs.highlightBlock(block);
  });

  // Initialize tooltip
  $('[data-toggle="tooltip"]').tooltip();

  // Initialize popover
  $('[data-popover-color="default"]').popover();



  // By default, Bootstrap doesn't auto close popover after appearing in the page
  // resulting other popover overlap each other. Doing this will auto dismiss a popover
  // when clicking anywhere outside of it
  $(document).on('click', function (e) {
    $('[data-toggle="popover"],[data-original-title]').each(function () {
        //the 'is' for buttons that trigger popups
        //the 'has' for icons within a button that triggers a popup
        if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
            (($(this).popover('hide').data('bs.popover')||{}).inState||{}).click = false  // fix for BS 3.3.6
        }

    });
  });



  // Select2 Initialize
  // Select2 without the search
  if($().select2) {
    $('.select2').select2({
      minimumResultsForSearch: Infinity,
      placeholder: 'Choose one'
    });

    // Select2 by showing the search
    $('.select2-show-search').select2({
      minimumResultsForSearch: ''
    });

    // Select2 with tagging support
    $('.select2-tag').select2({
      tags: true,
      tokenSeparators: [',', ' ']
    });
  }

});
 $.fn.serializeObject = function() {    
        var o = {};
        var a = this.serializeArray();
        $.each(a, function() {
            if (o[this.name]) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    };

jQuery.fn.extend({
  _success:function(msg){
      var r = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
      var success = '<div id="success-'+r+'" class="alert alert-bordered alert-success" role="alert">'
                        +'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'
                          +'<span aria-hidden="true">×</span>'
                        +'</button>'
                        +'<strong class="d-block d-sm-inline-block-force">Well done!</strong> '+msg+'.'
                      +'</div>';
          jQuery(success).appendTo(this);
          setTimeout(function(){ $('#success-'+r).remove();}, 10000);
  },
  
   _error:function(msg){
         var r = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
        var error = '<div id="danger-'+r+'" class="alert alert-bordered alert-danger" role="alert">'
                        +'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'
                          +'<span aria-hidden="true">×</span>'
                        +'</button>'
                        +'<strong class="d-block d-sm-inline-block-force">Error!</strong> '+msg+'.'
                      +'</div>';
        jQuery(error).appendTo(this);
      setTimeout(function(){ $('#danger-'+r).remove();}, 10000);
  },
});

function notification(typ,message){
       toastr.options = {
                closeButton: true,
                positionClass:'toast-bottom-right',
                timeOut:6000,
                progressBar:true,
                toastClass:'toast',
                closeOnHover:0,
            };
            var title = typ.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                return letter.toUpperCase();
            });
    if(typ=='success'){
      toastr.success(message,title)
    }else if(typ=='error'){
      toastr.error(message,title)
    }else if(typ=='info'){
      toastr.info(message,title)
    }else if(typ=='warning'){
      toastr.warning(message,title)
    }
    
}

  $.fn.serializeObject = function() {
        var o = {};
        var a = this.serializeArray();
        $.each(a, function() {
            if (o[this.name]) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    };
      //called when key is pressed in textbox
    $('body').on("keypress",".number-only",function (e) {
         //if the letter is not digit then display error and don't type anything
         if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            //display error message
            $(this).css("border-color","red");
            return false;
        }else{
             $(this).css("border-color","#ccc");
        }
      });
      
function calculateAge(DOB) {
    var today = new Date();
    var birthDate = new Date(DOB);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age = age - 1;
    }
    return age;
}