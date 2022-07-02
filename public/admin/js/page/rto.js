$(function(){
    'use strict'
     var _token = $('meta[name="csrf-token"]').attr('content'); 
    $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': _token
         }
    });
    
    
    
    
    
    
    var vehiclestable = $('#rto-datatable').DataTable( {
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
                    "url": base_url+"/rto-master/datatable",
                     "type": "POST",
                },
               
                //  createdRow: function( row, data, dataIndex ) {
                //         // Set the data-status attribute, and add a class
                //         $( row ).find('td:eq(0)').attr('data-make', data.make_id);
                //         $( row ).find('td:eq(0)').attr('data-varient', data.varient_id);
                //         $(row).attr('id',data.varient_id);
                //         //.addClass('asset-context box');
                //     },
                "columns": [
                    // {"data" : "sno","orderable":false,'className':'text-center reorder'},
                    {"data" : "rto","orderable":true ,'className':'text-center'},
                    {"data" : "txt","orderable":false,'className':'text-center'},
                    {"data" : "city","orderable":true,'className':'text-center'},
                    
                    {"data" : "state","orderable":true,'className':'text-center'},
                    {"data" : "hdfcErgoTw_code","orderable":false,'className':'vcode text-center'},
                    {"data" : "hdfcErgoCar_code","orderable":false,'className':'vcode text-center'},
                    {"data" : "status","orderable":true,'className':'text-center'},
                    // {
                    //     "class":          "details-control",
                    //     "orderable":      false,
                    //     "data":           null,
                    //     "defaultContent": ""
                    // },
                ],
                "columnDefs": [
                    // { "width": "5%", "targets": 0 },
                    { "width": "12%", "targets": 0 },
                    { "width": "12%", "targets": 1 },
                    { "width": "12%", "targets": 2 },
                    { "width": "12%", "targets": 3 },
                    { "width": "12%", "targets": 4 },
                    { "width": "12%", "targets": 5 },
                     { "width": "5%", "targets": 6 },
                  ],
            } );
            
    
    $('.search-input-text').on( 'keyup change', function () {   // for text boxes
        var i =$(this).attr('data-column');  // getting column index
        var v =$(this).val();  // getting search input value
        vehiclestable.columns(i).search(v).draw();
    });
  
    $('body').on('change','.text-vcode', function () {   // for text boxes
        var i =$(this).attr('data-id');  // getting column index
        var typ =$(this).attr('data-typ'); 
        var val = $(this).val();
        //if(val!=""){
            $.post(base_url+'/rto-master/update-code/'+typ,{id:i,typ:typ,val:val},function(result){
                if(typ=='status'){
                  notification($.trim(result.status),"Status update successfully");
                }else{
                  notification($.trim(result.status),"Code update successfully"); 
                }
            },'json');
       // }
  });
  
  
    $('body').on('change','#rtoState',function(e){
        var stateID = $(this).val();
        $.get(base_url+"/get-cities/"+stateID,  function(result) {
            var newdata =result.data;
            $('#rtoCity').empty().trigger("change");
            var newState1 = new Option("choose city", "", true, true);
              $("#rtoCity").append(newState1); 
              
              jQuery.each(newdata, function (index, item) {
                 var newState = new Option(item['value'], item['id'], true, true);
                $("#rtoCity").append(newState);//.trigger('change');
              });
            $('#rtoCity').val('').trigger("change");
        },'json');
    });
    
    $("#createNewRtoForm").validate({
        rules: {
            'rtoCode': { required: true },
            'rtoTxt': { required: true},
            'rtoState':{ required:true},
            'rtoCity':{ required:true},
            'rtoTwHdfc':{ required:true},
            'rtoCarhdfc':{ required:true},
            'rtoStatus':{ required:true}
        },

       submitHandler: function (form) {
             $('#btnCreateRtocode').loadButton('on',{ faClass:'fa',faIcon:'fa-spinner', doSpin:true, loadingText:'Submitting...'});
            $.post(base_url+'/rto-master/create/',$(form).serialize(),function(result){
                 $("#btnCreateRtocode").loadButton('off');
                if($.trim(result.status)=='success'){
                  notification($.trim(result.status),result.message);
                  $('#createNewRtoForm')[0].reset();
                }else{
                    notification($.trim(result.status),result.message);
                }
            },'json')
            return false;
        }

    });
    
    $('body').on('click','#btnRtoinfo', function (e) {   // for text boxes
        e.preventDefault();
        var _this =  $(this);
        _this.loadButton('on',{ faClass:'fa',faIcon:'fa-spinner', doSpin:false, loadingText:'Fetching....'});
        $.post(base_url+'/get-vehicle-rto-info',{vehicleNumber:$('#vehicleNumber').val()},function(result){
           _this.loadButton('off');
           $('#VinfoCode').html('<pre style="color: #f8f8f2 !important;">'+JSON.stringify(JSON.parse(result), null, 2)+'</pre>');
          
        });
    });
    
   
    
});