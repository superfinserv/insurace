    // CAR Sortable
    var $carsortable = $( ".sortable-car" );
          $carsortable.sortable({
              start: function (event, ui) { 
                   ui.item.toggleClass("bd-1 bd-success");
              },
              stop: function ( event, ui ) {
                  var parameters = $carsortable.sortable("toArray");
                  //console.log(parameters);
                //   var data = $(this).sortable('serialize');
                  $.post(base_url+"/vehicles/update/make/serial-number/",{data:parameters},function(result){
                      console.log(result);
                      var serial =1;
                      $('.sortable-car').find('.list-item-car').each(function(){
                            $(this).find('span').text(serial+".");
                            serial++;
                        });
                  });
                  ui.item.toggleClass("bd-1 bd-success");
              }
          });
          
    $carsortable.disableSelection();
    
    // BIKE Sortable
    var $bikesortable = $( ".sortable-bike" );
          $bikesortable.sortable({
              start: function (event, ui) { 
                   ui.item.toggleClass("bd-1 bd-success");
              },
              stop: function ( event, ui ) {
                  var parameters = $bikesortable.sortable("toArray");
                  //console.log(parameters);
                //   var data = $(this).sortable('serialize');
                  $.post(base_url+"/vehicles/update/make/serial-number/",{data:parameters},function(result){
                      console.log(result);
                      var serial =1;
                      $('.sortable-bike').find('.list-item-bike').each(function(){
                            $(this).find('span').text(serial+".");
                            serial++;
                        });
                  });
                  ui.item.toggleClass("bd-1 bd-success");
              }
          });
          
    $bikesortable.disableSelection();
    
    // Passanger Carring Sortable
    var $pcsortable = $( ".sortable-pc" );
          $pcsortable.sortable({
              start: function (event, ui) { 
                   ui.item.toggleClass("bd-1 bd-success");
              },
              stop: function ( event, ui ) {
                  var parameters = $pcsortable.sortable("toArray");
                  //console.log(parameters);
                //   var data = $(this).sortable('serialize');
                  $.post(base_url+"/vehicles/update/make/serial-number/",{data:parameters},function(result){
                      console.log(result);
                      var serial =1;
                      $('.sortable-pc').find('.list-item-pc').each(function(){
                            $(this).find('span').text(serial+".");
                            serial++;
                        });
                  });
                  ui.item.toggleClass("bd-1 bd-success");
              }
          });
          
    $pcsortable.disableSelection();
    
    // Passanger Carring Sortable
    var $gcsortable = $( ".sortable-gc" );
          $gcsortable.sortable({
              start: function (event, ui) { 
                   ui.item.toggleClass("bd-1 bd-success");
              },
              stop: function ( event, ui ) {
                  var parameters = $gcsortable.sortable("toArray");
                  //console.log(parameters);
                //   var data = $(this).sortable('serialize');
                  $.post(base_url+"/vehicles/update/make/serial-number/",{data:parameters},function(result){
                      console.log(result);
                      var serial =1;
                      $('.sortable-gc').find('.list-item-gc').each(function(){
                            $(this).find('span').text(serial+".");
                            serial++;
                        });
                  });
                  ui.item.toggleClass("bd-1 bd-success");
              }
          });
          
    $gcsortable.disableSelection();
    
    
    // $('body').on('click','.list-group-item',function(e){
    //   var ID =  $(this).attr('data-id');
    //   window.location.href=base_url+'/vehicles/modal/sortable/'+ID;
    // })