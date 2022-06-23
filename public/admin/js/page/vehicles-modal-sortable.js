    // CAR Sortable
    var $modalsortable = $( ".sortable-modals" );
          $modalsortable.sortable({
              start: function (event, ui) { 
                   ui.item.toggleClass("bd-1 bd-success");
              },
              stop: function ( event, ui ) {
                  var parameters = $modalsortable.sortable("toArray");
                  var make = $('.sortable-modals').attr('data-make');
                  //console.log(parameters);
                //   var data = $(this).sortable('serialize');
                  $.post(base_url+"/vehicles/update/modal/serial-number/"+make+"/pvt-car",{data:parameters},function(result){
                      console.log(result);
                      var serial =1;
                      $('.sortable-modals').find('.list-item-modal').each(function(){
                            $(this).find('span').text(serial+".");
                            serial++;
                        });
                  });
                  ui.item.toggleClass("bd-1 bd-success");
              }
          });
          
    $modalsortable.disableSelection();
    
   
    
    
    
    