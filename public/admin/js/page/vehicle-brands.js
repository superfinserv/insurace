$(function(){
    'use strict'
     var _token = $('meta[name="csrf-token"]').attr('content'); 
    $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': _token
         }
    });
    
    var brandtable = $('#agent-datatable').DataTable( {
        "scrollX": false,
         bLengthChange: false,
         responsive: true,
        "autoWidth": false,
                "processing": true,
                "serverSide": true,
               "ajax": {
                    "url": base_url+"/vehicle/brands/getBrandsdatatable",
                     "type": "POST",
                },
                "columns": [
                    { "data": "sno"},
                    {"data" : "brand","orderable":false},
                    {"data" : "icon","orderable":false},
                    {"data" : "type","orderable":false},
                    {"data" : "status","orderable":false},
                    { "data": "action" ,"orderable":false}
                ],
                "columnDefs": [
                    { "width": "5%", "targets": 0 },
                    { "width": "25%", "targets": 1 },
                    { "width": "25%", "targets": 2 },
                    { "width": "15%", "targets": 3 },
                    { "width": "20%", "targets": 4 },
                 
                  ],
            } );
 
    $('.search-input-text').on( 'keyup click', function () {   // for text boxes
        var i =$(this).attr('data-column');  // getting column index
        var v =$(this).val();  // getting search input value
        brandtable.columns(i).search(v).draw();
   });
   
    $("#BrandsForm").validate({
        
        rules: {
            'brandName': { required: true },
            
            'brandType[]': { required: true,},
            
            'brandlogoFile':{ required:true,},
    
        }

    });
 });
