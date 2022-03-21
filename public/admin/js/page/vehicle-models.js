$(function(){
    'use strict'
     var _token = $('meta[name="csrf-token"]').attr('content'); 
    $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': _token
         }
    });
    
    var agenttable = $('#models-datatable').DataTable( {
        "scrollX": false,
         bLengthChange: false,
         responsive: true,
        "autoWidth": false,
                "processing": true,
                "serverSide": true,
               "ajax": {
                    "url": base_url+"/vehicle/models/getModelsdatatable",
                     "type": "POST",
                },
                "columns": [
                    { "data": "sno"},
                     {"data" : "model","orderable":false},
                    {"data" : "brand","orderable":false},
                    { "data": "type" ,"orderable":false},
                    {"data" : "status","orderable":false},
                    { "data": "action" ,"orderable":false}
                ],
                "columnDefs": [
                    { "width": "5%", "targets": 0 },
                    { "width": "25%", "targets": 1 },
                    { "width": "25%", "targets": 2 },
                    { "width": "10%", "targets": 3 },
                    { "width": "10%", "targets": 4 },
                    { "width": "15%", "targets":5 },
                 
                  ],
            } );
 
    $('.search-input-text').on( 'keyup click', function () {   // for text boxes
        var i =$(this).attr('data-column');  // getting column index
        var v =$(this).val();  // getting search input value
        agenttable.columns(i).search(v).draw();
   });
   
  $("#ModelsForm").validate({
        rules: {
            'modelName': { required: true },
            'brand': { required: true,},
            'type': { required: true,},
        }

    });
    
 
  $('body').on('click','.update-cat',function(e){
        var id = $(this).attr('data-id');
        var typ = $('#typ-'+id).val();
        console.log(id,typ);
        $.get(base_url+"/vehicle/model/update-model-category/"+typ+"/"+id,  function(result) { 
            
        })
  });
 
 $('body').on('change','#type',function(e){
        var typ = $(this).val();
        if(typ!=""){
           $.get(base_url+"/get-brands-by-category/"+typ,  function(result) {
            var newdata =result.data;
            $('#brand').empty().trigger("change");
            var newState1 = new Option("choose brand", "", true, true);
              $("#brand").append(newState1);
              jQuery.each(newdata, function (index, item) {
                 var newState = new Option(item['value'], item['id'], true, true);
                $("#brand").append(newState);//.trigger('change');
              });
            $('#brand').val('').trigger("change");
        },'json');
        }else{
           $('#brand').empty().trigger("change"); 
        }
    });
   
 });
