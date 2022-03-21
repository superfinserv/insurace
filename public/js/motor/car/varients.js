$(window).on('load', function(){
    $('#VarientContainer').loading({
              message: 'Loading varients...'
            });
    var carInfo = [];
    if(localStorage.getItem("carInfo")){ 
       carInfo = JSON.parse(localStorage.getItem('carInfo'));
       addedItem = Object.keys(carInfo).length;
       if(addedItem){
           $('#span-modal-name').text(carInfo.vehicle.model.name);
            $.get(base_url+"/car-insurance/load-varients/"+carInfo.vehicle.model.id+"/"+carInfo.vehicle.model.name, function(result) {
                  $('#VarientContainer').loading('stop');
                  $('#VarientContainer').empty().html(result);
                  $('[data-toggle="tooltip"]').tooltip();
            })
       }
    }
});

$(document).on('click', '.choose-varient', function(e) {
    var name = $(this).attr('data-name');
    var id = $(this).attr('data-id');
    var carInfo = JSON.parse(localStorage.getItem('carInfo'));
    carInfo.vehicle.varient = {id:id,name:name};
    carInfo.vehicle.fueltype = $(this).attr('data-fule');
   carInfo.vehicle.cc = $(this).attr('data-cc');
    localStorage.setItem("carInfo", JSON.stringify(carInfo));
    if(carInfo.vehicle.isBrandNew===true && carInfo.vehicle.hasvehicleNumber===false){
         // Go to list plan
        window.location.href = base_url + "/car-insurance/plans/";
     }else{
         // Go to regstration-year
        window.location.href = base_url + "/car-insurance/registration-year/";
     }
});
$(document).on('click', '.nextvariant', function(e) {
    var carInfo = JSON.parse(localStorage.getItem('carInfo'));
    var varff = carInfo.vehicle.model.id;
    if (varff) {
        window.location.href = base_url + "/car-insurance/registration-year/";
    } else {
        $('#errors').text('Please select any Car variant');
    }
});
$(document).on('click', '#backs', function(e) {
    var carInfo = JSON.parse(localStorage.getItem('carInfo'));
    window.location.href = base_url + "/car-insurance/model/" + carInfo.vehicle.brand.name;
})