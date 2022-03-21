
      $(function(){
        'use strict';

        // show only the icons and hide left menu label by default
       // $('.menu-item-label,.menu-item-arrow').addClass('op-lg-0-force d-lg-none');

        // $(document).on('mouseover', function(e){
        //   e.stopPropagation();
        //   if($('body').hasClass('collapsed-menu')) {
        //     var targ = $(e.target).closest('.br-sideleft').length;
        //     if(targ) {
        //       $('body').addClass('expand-menu');

        //       // show current shown sub menu that was hidden from collapsed
        //       $('.show-sub + .br-menu-sub').slideDown();

        //       var menuText = $('.menu-item-label,.menu-item-arrow');
        //       menuText.removeClass('d-lg-none');
        //       menuText.removeClass('op-lg-0-force');

        //     } else {
        //       $('body').removeClass('expand-menu');

        //       // hide current shown menu
        //       $('.show-sub + .br-menu-sub').slideUp();

        //       var menuText = $('.menu-item-label,.menu-item-arrow');
        //       menuText.addClass('op-lg-0-force');
        //       menuText.addClass('d-lg-none');
        //     }
        //   }
        // });

        // depcrecated
        //$('.br-mailbox-list').perfectScrollbar();

        new PerfectScrollbar('.br-mailbox-list', {
          suppressScrollX: true
        });

        $('#showMailBoxLeft').on('click', function(e){
          e.preventDefault();
          if($('body').hasClass('show-mb-left')) {
            $('body').removeClass('show-mb-left');
            $(this).find('.fa').removeClass('fa-arrow-left').addClass('fa-arrow-right');
          } else {
            $('body').addClass('show-mb-left');
            $(this).find('.fa').removeClass('fa-arrow-right').addClass('fa-arrow-left');
          }
        });
      });
    