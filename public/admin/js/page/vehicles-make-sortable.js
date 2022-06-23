    // CAR Sortable
    var $vsortable = $( ".sortable-vehicle" );
    var $typ = $vsortable.attr('data-type');
          $vsortable.sortable({
              start: function (event, ui) { 
                   ui.item.toggleClass("bd-1 bd-success");
              },
              stop: function ( event, ui ) {
                  var parameters = $vsortable.sortable("toArray");
                  //console.log(parameters);
                //   var data = $(this).sortable('serialize');
                  $.post(base_url+"/vehicles/update/make/serial-number/"+$typ,{data:parameters},function(result){
                      console.log(result);
                      var serial =1;
                      $('.sortable-vehicle').find('.list-item-car').each(function(){
                            $(this).find('span').text(serial+".");
                            serial++;
                        });
                  });
                  ui.item.toggleClass("bd-1 bd-success");
              }
          });
          
    $vsortable.disableSelection();
    
    // // BIKE Sortable
    // var $bikesortable = $( ".sortable-bike" );
    //       $bikesortable.sortable({
    //           start: function (event, ui) { 
    //               ui.item.toggleClass("bd-1 bd-success");
    //           },
    //           stop: function ( event, ui ) {
    //               var parameters = $bikesortable.sortable("toArray");
    //               //console.log(parameters);
    //             //   var data = $(this).sortable('serialize');
    //               $.post(base_url+"/vehicles/update/make/serial-number/",{data:parameters},function(result){
    //                   console.log(result);
    //                   var serial =1;
    //                   $('.sortable-bike').find('.list-item-bike').each(function(){
    //                         $(this).find('span').text(serial+".");
    //                         serial++;
    //                     });
    //               });
    //               ui.item.toggleClass("bd-1 bd-success");
    //           }
    //       });
          
    // $bikesortable.disableSelection();
    
   
    
    
    // $('body').on('click','.list-group-item',function(e){
    //   var ID =  $(this).attr('data-id');
    //   window.location.href=base_url+'/vehicles/modal/sortable/'+ID;
    // })