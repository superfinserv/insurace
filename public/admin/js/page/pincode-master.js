$(function(){
    'use strict'
     var _token = $('meta[name="csrf-token"]').attr('content'); 
    $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': _token
         }
    });
    
    var pincodetable = $('#pincode-datatable').DataTable( {
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
                    "url": base_url+"/pincode/datatable",
                     "type": "POST",
                },
               
                "columns": [
                    {"data" : "sno","orderable":false,'className':'text-center reorder'},
                    {"data" : "pincode","orderable":true ,'className':'text-center'},
                    {"data" : "District","orderable":true,'className':'text-center'},
                    {"data" : "State","orderable":true,'className':'text-center'},
                    {"data" : "stateName","orderable":true,'className':'text-center'},
                    {"data" : "cityName","orderable":false,'className':'vcode text-center'}
                ],
                "columnDefs": [
                    // { "width": "5%", "targets": 0 },
                    { "width": "12%", "targets": 0 },
                    { "width": "12%", "targets": 1 },
                    { "width": "12%", "targets": 2 },
                    { "width": "12%", "targets": 3 },
                    { "width": "12%", "targets": 4 },
                    { "width": "12%", "targets": 5 }
                  ],
            } );
     
    
     $('.search-input-text').on( 'keyup change', function () {   // for text boxes
        var i =$(this).attr('data-column');  // getting column index
        var v =$(this).val();  // getting search input value
        pincodetable.columns(i).search(v).draw();
  });
  
//     $('body').on('change','.text-vcode', function () {   // for text boxes
//         var i =$(this).attr('data-id');  // getting column index
//         var supp =$(this).attr('data-supp'); 
//         var val = $(this).val();
//         if(val!=""){
//             $.post(base_url+'/vehicles/update-vcode/2w',{id:i,column:supp,val:val},function(result){
//                   notification($.trim(result.status),"Vehicle Code update successfully");
//             },'json');
//         }
//   });
    
});