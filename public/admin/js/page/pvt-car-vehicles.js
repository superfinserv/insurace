var editor;
$(function(){
    'use strict'
     var _token = $('meta[name="csrf-token"]').attr('content'); 
    $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': _token
         }
    });
    
    // function format ( d ) {
    //         // `d` is the original data object for the row
    //          var item = d.fullInfo;
    //          console.log(item);
    //          var tbl= '<table class="table table-bordered" cellspacing="0" width="100%">';
    //             tbl +='<thead><tr><th class="text-center">Fule</th><th class="text-center">Wheels</th><th class="text-center">Seating Capacity</th><th class="text-center">Power</th><th class="text-center">Cubic Capacity</th><th class="text-center">Weight</th><th class="text-center">Abs</th><th class="text-center">Air bags</th><th class="text-center">Length</th><tr/></thead><tbody>';
    //             tbl +=  '<tr><td class="text-center">'+item.fuel_type+'</td><td class="text-center">'+item.wheels+'</td><td class="text-center">'+item.seating_capacity+'</td><td>'
    //                       +item.power+'</td><td class="text-center">'+item.cubic_capacity+'</td><td class="text-center">'+item.grosss_weight+'</td><td>'
    //                       +item.abs+'</td><td class="text-center">'+item.air_bags+'</td><td class="text-center">'+item._length+'</td></tr>';

    //         tbl +='</tbody></table>';
             
    //         return tbl;
    //     }  
    
   
    
    var vehiclestable = $('#vehicles-datatable').DataTable( {
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
                    "url": base_url+"/vehicles/pvt-car/datatable",
                     "type": "POST",
                },
                "columns": [
                    {"data" : "make","orderable":true ,'className':'text-center'},
                    {"data" : "modal","orderable":true,'className':'text-center'},
                    {"data" : "variant","orderable":true,'className':'text-center'},
                    {"data" : "cc","orderable":true,'className':'text-center'},
                    {"data" : "fuel_type","orderable":false,'className':'text-center'},
                    {"data" : "digit_code","orderable":true,'className':'vcode text-center'},
                    {"data" : "fgi_code","orderable":true,'className':'vcode text-center'},
                    {"data" : "hdfc_make","orderable":true,'className':'text-center'},
                    {"data" : "hdfc_code","orderable":true,'className':'vcode text-center'}
                ],
                "columnDefs": [
                    { "width": "16%", "targets": 0 },
                    { "width": "15%", "targets": 1 },
                    { "width": "20%", "targets": 2 },
                    { "width": "5%", "targets": 3 },
                    { "width": "8%", "targets": 4 },
                    { "width": "9%", "targets": 5},
                    { "width": "9%", "targets": 6 },
                    { "width": "8%", "targets": 7 },
                    { "width": "9%", "targets": 8 },
                  ],
            } );
            
    // $('#vehicles-datatable tbody').on('click', 'td.details-control', function () {
    //     var tr = $(this).closest('tr');
    //     var row = vehiclestable.row( tr );

    //     if ( row.child.isShown() ) {
    //         // This row is already open - close it
    //         row.child.hide();
    //         tr.removeClass('shown');
    //     }
    //     else {
    //         // Open this row
    //         row.child( format(row.data()) ).show();
    //         tr.addClass('shown');
    //     }
    // });
    
     $('.search-input-text').on( 'keyup change', function () {   // for text boxes
        var i =$(this).attr('data-column');  // getting column index
        var v =$(this).val();  // getting search input value
        vehiclestable.columns(i).search(v).draw();
     });
     
//      $('#vehicles-datatable').editable({
// 		container:'body',
// 		selector:'.editable-varient',
// 		url:'update.php',
// 		title:'Varient Name',
// 		type:'POST',
// 		validate:function(value){
// 			if($.trim(value) === '')
// 			{
// 				return 'This field is required';
// 			}
// 		}
// 	});
  
    $('body').on('change','.text-vcode', function () {   // for text boxes
        var i =$(this).attr('data-id');  // getting column index
        var supp =$(this).attr('data-supp'); 
        var val = $(this).val();
        if(val!=""){
            $.post(base_url+'/vehicles/update-vcode/Pvt-Car',{id:i,column:supp,val:val},function(result){
                  notification($.trim(result.status),"Vehicle Code update successfully");
            },'json');
        }
  });
    
});