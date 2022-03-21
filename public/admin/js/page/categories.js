$(function(){
    'use strict'
     var _token = $('meta[name="csrf-token"]').attr('content'); 
    $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': _token
         }
    });
    
    var cattable = $('#categories-datatable').DataTable( {
        "scrollX": false,
         bLengthChange: false,
         responsive: true,
        "order": [[0, "desc" ]],
        "autoWidth": false,
                "processing": true,
                 "serverSide": true,
               "ajax": {
                    "url": base_url+"/categories/getdatatable",
                     "type": "POST",
                },
                "columns": [
                   
                    {"data" : "name","orderable":true },
                    {"data" : "icon","orderable":false ,'className':'tx-32'},
                    { "data": "type","orderable":false},
                    { "data": "serial","orderable":true},
                    { "data": "mserial","orderable":true},
                    {"data" : "Isfront","orderable":true},
                    {"data" : "appIcon","orderable":false ,'className':'pd-l-20'},
                    {"data" : "status","orderable":true },
                    { "data": "action" ,"orderable":false}
                ],
                "columnDefs": [
                    { "width": "15%", "targets": 0 },
                    { "width": "10%", "targets": 1 },
                    { "width": "10%", "targets": 2 },
                    { "width": "8%", "targets": 3},
                    { "width": "8%", "targets": 4},
                    { "width": "10%", "targets": 5},
                    { "width": "10%", "targets": 6 },
                    { "width": "15%", "targets": 7 },
                    { "width": "15%", "targets": 8 },
                 
                  ],
            } );
 
    $('.search-input-text').on( 'keyup change', function () {   // for text boxes
        var i =$(this).attr('data-column');  // getting column index
        var v =$(this).val();  // getting search input value
        cattable.columns(i).search(v).draw();
   });
   

 });
