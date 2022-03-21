$(window).on('load', function(){
    var carInfo = [];
    if(localStorage.getItem("carInfo")){ 
       carInfo = JSON.parse(localStorage.getItem('carInfo'));
    //   addedItem = Object.keys(carInfo).length;
    //   if(addedItem){
    //       if(carInfo.vehicleType!==null && carInfo.vehicleType!==undefined){
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
        var carInfo = JSON.parse(localStorage.getItem('carInfo'));
        carInfo.vehicle.brand = {id:id,name:V[0]};
        //carInfo.vehicleType = V[1];
        localStorage.setItem("carInfo", JSON.stringify(carInfo));
   
    }
});
  


$(document).on('click', '.brands', function(e) {
    var name = $(this).attr('data-name');
    var id = $(this).attr('data-id');
    
     var carInfo = JSON.parse(localStorage.getItem('carInfo'));
         carInfo.vehicle.brand = {id:id,name:name};
    localStorage.setItem("carInfo", JSON.stringify(carInfo));
    window.location.href = base_url + "/car-insurance/model/" + name;
});

$(document).on('click', '.next', function(e) {
    var carInfo = JSON.parse(localStorage.getItem('carInfo'));
    var brand = carInfo.vehicle.brand.name;
    if (brand) {
        window.location.href = base_url + "/car-insurance/model/" + brand;
    } else {
        $('#errors').text('Please select any brands');
    }
});