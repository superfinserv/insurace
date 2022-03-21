$(function(){
    'use strict'
     var _token = $('meta[name="csrf-token"]').attr('content'); 
    $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': _token
         }
    });
    
      var enQtable = $('#enq-datatable').DataTable( {
        "scrollX": false,
         bLengthChange: false,
         responsive: true,
        "pagingType": "simple",
        "autoWidth": false,
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": base_url+"/sales/leads/datatable/enq",
                     "type": "POST",
                },
                "columns": [
                    {"data" : "img","orderable":false},
                    {"data" : "mobile","orderable":false},
                    {"data" : "title","orderable":false},
                    { "data": "date","orderable":false},
                ]
            
            } );
    
    var Quotetable = $('#quote-datatable').DataTable( {
        "scrollX": false,
         bLengthChange: false,
         responsive: true,
         "pagingType": "simple",
        "autoWidth": false,
                "processing": true,
                "serverSide": true,
               "ajax": {
                    "url": base_url+"/sales/leads/datatable/quote",
                     "type": "POST",
                },
                "columns": [
                    
                    {"data" : "customer","orderable":false},
                    {"data" : "type","orderable":false},
                    {"data" : "partner","orderable":false},
                    {"data" : "date","orderable":false},
                    { "data": "action" ,"orderable":false}
                ]
                
            } );
 
//     $('.search-input-text').on( 'keyup click', function () {   // for text boxes
//         var i =$(this).attr('data-column');  // getting column index
//         var v =$(this).val();  // getting search input value
//         agenttable.columns(i).search(v).draw();
//   });
   
   $('body').on('click','.view-param' ,function(e){
       var id = $(this).attr('data-id');
        $.dialog({
            title: 'Enquiry Deatils',
            content: 'url:'+base_url+"/sales/leads/info/"+id,
            animation: 'scale',
            columnClass: 'medium',
            closeAnimation: 'scale',
            backgroundDismiss: true,
        });
    });
  
 });
