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
     $('#pvt-car-vehicles-datatable thead #searchTR th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
    $('#pvt-car-vehicles-datatable').DataTable( {
        "ajax": base_url+"/js/hdfc-car-model.json",
          "pageLength": 50,
        "columns": [
            { "data": "ModelName" },
            { "data": "VariantName" },
            { "data": "MakeId" },
            { "data": "ModelId" },
            { "data": "FuelType" },
            { "data": "CubicCapacity" }
        ],initComplete: function () {
            // Apply the search
            this.api().columns().every( function () {
                var that = this;
                 
                $( 'input', this.header() ).on( 'keyup change clear', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
        }
        
    } );
}

if($('#2w-vehicles-datatable').length){
    $('#2w-vehicles-datatable thead #searchTR th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
    
    
    $('#2w-vehicles-datatable').DataTable( {
       "ajax": base_url+"/js/hdfc-2w-model.json",
        "pageLength": 50,
        "columns": [
             { "data": "ModelName" },
            { "data": "VariantName" },
            { "data": "MakeId" },
            { "data": "ModelId" },
            { "data": "FuelType" },
            { "data": "CubicCapacity" }
        ],
        initComplete: function () {
            // Apply the search
            this.api().columns().every( function () {
                var that = this;
                  console.log(this);
                $( 'input', this.header() ).on( 'keyup change clear', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
        }
    } );
}

    
    
});