$(function(){
    'use strict'
    var agenttable = $('#agent-application-datatable').DataTable( {
        "scrollX": false,
         bLengthChange: false,
         responsive: true,
        "autoWidth": false,
                "processing": true,
                "serverSide": true,
               "ajax": {
                    "url": base_url+"/agents/applications/datatable",
                     "type": "POST",
                },
                "columns": [
                    { "data": "sno","orderable":false},
                    {"data" : "name","orderable":false},
                    {"data" : "contact","orderable":false},
                    {"data" : "city","orderable":false},
                    {"data" : "state","orderable":false},
                    {"data" : "status","orderable":false},
                    { "data": "action" ,"orderable":false}
                ],
                "columnDefs": [
                    { "width": "3%", "targets": 0 ,'className':'text-center'},
                    { "width": "15%", "targets": 1 },
                    { "width": "12%", "targets": 2 },
                    { "width": "10%", "targets": 3 ,'className':'text-center'},
                    { "width": "15%", "targets": 4 ,'className':'text-center'},
                    { "width": "10%", "targets": 5,'className':'text-center' },
                    { "width": "10%", "targets": 6,'className':'text-center' },
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
   
  
   
   $('body').on('click', '.reload-table', function (e) {
       $(this).find('i').addClass('fa-spin');
       agenttable.ajax.reload();
        $(this).find('i').removeClass('fa-spin');
   });
   
   
  
    
 });
