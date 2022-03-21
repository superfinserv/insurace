$(function(){
    'use strict'
     var _token = $('meta[name="csrf-token"]').attr('content'); 
    $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': _token
         }
    });
    
  if($('#GetVehicleInfo').length){  
          $.post(base_url+'/agent/new/saveInfo/',$(form).serialize(),function(result){
                 $(".agentRegisterInfoBtn").loadButton('off');
                if($.trim(result.status)=='success'){
                   $('.agent-register-notify')._success(result.message);
                   $('#agentRegisterInfo')[0].reset();
                }else{
                   $('.agent-register-notify')._error(result.message);  
                }
            },'json');
      
  }
    

if($('#pvt-car-vehicles-datatable').length){
    $('#pvt-car-vehicles-datatable').DataTable( {
        "ajax": base_url+"/js/hdfc-car-model.json",
        "columns": [
            { "data": "ModelName" },
            { "data": "VariantName" },
            { "data": "MakeId" },
            { "data": "ModelId" },
            { "data": "FuelType" },
            { "data": "CubicCapacity" }
        ]
    } );
}

if($('#2w-vehicles-datatable').length){
    $('#2w-vehicles-datatable').DataTable( {
       "ajax": base_url+"/js/hdfc-2w-model.json",
        "columns": [
             { "data": "ModelName" },
            { "data": "VariantName" },
            { "data": "MakeId" },
            { "data": "ModelId" },
            { "data": "FuelType" },
            { "data": "CubicCapacity" }
        ]
    } );
}

    
    
});