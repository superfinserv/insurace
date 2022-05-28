$(function(){
    'use strict'
    
     var Rtable = $('#policy-orc-datatable').DataTable({
        "scrollX": false,
         bLengthChange: false,
         responsive: true,
         //rowReorder: true,
         autoWidth: false,
                "processing": true,
                "serverSide": true,
                "pageLength":25,
                "order": [[ 0, "ASC" ]],
                "ajax": {
                    "url": base_url+"/policies-orc/datatable",
                     "type": "POST",
                },
                "columns": [
                    {"data" : "Date","orderable":true ,'className':'text-center'},
                    {"data" : "PolicyNo","orderable":true,'className':'text-center'},
                    {"data" : "Customer","orderable":false,'className':''},
                    {"data" : "Insurer","orderable":false,'className':''},
                    {"data" : "Amount","orderable":true,'className':'text-center'},
                    {"data" : "Total","orderable":true,'className':'text-center'},
                    {"data" : "pospAmt","orderable":true,'className':'text-center'},
                    {"data" : "spAmt","orderable":true,'className':''},
                    {"data" : "PospName","orderable":true,'className':'text-center'},
                    {"data" : "SpName","orderable":true,'className':''},
                ],
                "columnDefs": [
                    { "width": "8%", "targets": 0 },
                    { "width": "10%", "targets": 1 },
                    { "width": "12%", "targets": 2 },
                    { "width": "20%", "targets": 3 },
                    { "width": "4%", "targets": 4 },
                    { "width": "4%", "targets": 5 },
                    { "width": "4%", "targets": 6},
                    { "width": "4%", "targets":7 },
                    { "width": "10%", "targets": 8 },
                    { "width": "10%", "targets": 9 },
                    
                  ],
            } );
             $('.search-input-text').on( 'keyup change', function () {   // for text boxes
                var i =$(this).attr('data-column');  // getting column index
                var v =$(this).val();  // getting search input value
                Rtable.columns(i).search(v).draw();
           });
           
           
          
})