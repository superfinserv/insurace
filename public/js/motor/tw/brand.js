$(window).on('load', function(){
    var twInfo = [];
    if(localStorage.getItem("twInfo")){ 
       twInfo = JSON.parse(localStorage.getItem('twInfo'));
    //   addedItem = Object.keys(twInfo).length;
    //   if(addedItem){
    //       if(twInfo.vehicleType!==null && twInfo.vehicleType!==undefined){
    //       }else{
    //          ModalVehicalType();
    //       }
    //   }
    }
    
  
});

$('body').on('change', '.select-choose-make', function(e) {
    e.preventDefault();
    var id = $(this).val();
    if(id!==""){
        var name = $(".select-choose-make option:selected").text();
        var V = name.split("-");
        var twInfo = JSON.parse(localStorage.getItem('twInfo'));
        twInfo.vehicle.brand = {id:id,name:V[0]};
        //twInfo.vehicleType = V[1];
        localStorage.setItem("twInfo", JSON.stringify(twInfo));
   
    }
});
  


$(document).on('click', '.brands', function(e) {
    var name = $(this).attr('data-name');
    var id = $(this).attr('data-id');
    
     var twInfo = JSON.parse(localStorage.getItem('twInfo'));
         twInfo.vehicle.brand = {id:id,name:name};
    localStorage.setItem("twInfo", JSON.stringify(twInfo));
    window.location.href = base_url + "/twowheeler-insurance/model/" + name;
});

$(document).on('click', '.next', function(e) {
    var twInfo = JSON.parse(localStorage.getItem('twInfo'));
    var brand = twInfo.vehicle.brand.name;
    if (brand) {
        window.location.href = base_url + "/twowheeler-insurance/model/" + brand;
    } else {
        $('#errors').text('Please select any brands');
    }
});