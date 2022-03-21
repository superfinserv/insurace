$(function(){
    'use strict'
  
    var agenttable = $('#agent-payment-datatable').DataTable( {
        "scrollX": false,
         bLengthChange: false,
         responsive: true,
        "autoWidth": false,
                "processing": true,
                "serverSide": true,
               "ajax": {
                    "url": base_url+"/agent/payments-datatable",
                     "type": "POST",
                },
                "columns": [
                    { "data": "sno","orderable":false},
                    {"data" : "invoice","orderable":false},
                    {"data" : "paymentId","orderable":false},
                    {"data" : "pospName","orderable":false},
                    {"data" : "pospId","orderable":false},
                    {"data" : "amount","orderable":false},
                    {"data" : "date","orderable":false},
                    { "data": "action" ,"orderable":false}
                ],
                "columnDefs": [
                    { "width": "3%", "targets": 0 },
                    { "width": "10%", "targets": 1 },
                    { "width": "10%", "targets": 2 },
                    { "width": "20%", "targets": 3 },
                    { "width": "15%", "targets": 4 },
                    { "width": "10%", "targets": 5 },
                    { "width": "15%", "targets": 6 },
                    { "width": "10%", "targets": 7 },
                 
                  ],
            } );
 
    $('.search-input-text').on( 'keyup change', function () {   // for text boxes
        var i =$(this).attr('data-column');  // getting column index
        var v =$(this).val();  // getting search input value
        agenttable.columns(i).search(v).draw();
   });
   
   agenttable.on( 'draw', function () { 
         $('[data-toggle="tooltip"]').tooltip({
            template: '<div class="tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
          });
   })
   
   
 
    
    
 });
