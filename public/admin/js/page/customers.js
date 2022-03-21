$(function(){
    'use strict'
  
    
    
    var customerstable = $('#customers-datatable').DataTable( {
        "scrollX": false,
         bLengthChange: false,
         responsive: true,
        "autoWidth": false,
                "processing": true,
                "serverSide": true,
               "ajax": {
                    "url": base_url+"/customers/datatable",
                     "type": "POST",
                },
                "columns": [
                    { "data": "sno","orderable":false},
                    {"data" : "name","orderable":false},
                    {"data" : "mobile","orderable":false},
                    {"data" : "email","orderable":false},
                    {"data" : "status","orderable":false},
                    { "data": "created_at" ,"orderable":false},
                   { "data": "action" ,"orderable":false}
                ],
                "columnDefs": [
                    { "width": "5%", "targets": 0 },
                    { "width": "15%", "targets": 1 },
                    { "width": "10%", "targets": 2 },
                    { "width": "20%", "targets": 3 },
                    { "width": "12%", "targets": 4 },
                    { "width": "10%", "targets": 5 },
                    { "width": "10%", "targets": 6 },
                  ],
            } );
 
    $('.search-input-text').on( 'keyup click', function () {   // for text boxes
        var i =$(this).attr('data-column');  // getting column index
        var v =$(this).val();  // getting search input value
        customerstable.columns(i).search(v).draw();
   });
   
   
   
 });
