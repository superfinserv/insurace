$(window).on('load', function(){
    $('#ModelContainer').loading({
              message: 'Loading Models...'
            });
    var carInfo = [];
    if(localStorage.getItem("carInfo")){ 
       carInfo = JSON.parse(localStorage.getItem('carInfo'));
       addedItem = Object.keys(carInfo).length;
       if(addedItem){
          $("#span-brand-name").text(carInfo.vehicle.brand.name);
              $.get(base_url+"/car-insurance/load-models/"+carInfo.vehicle.brand.id+"/"+carInfo.vehicle.brand.name, function(result) {
                 $('#ModelContainer').loading('stop');
                 $('#ModelContainer').empty().html(result);
            })
       }
    }
});

$(document).on('click', '.choose-model', function(e) {
    var name = $(this).attr('data-name');
    var id = $(this).attr('data-id');
    var carInfo = JSON.parse(localStorage.getItem('carInfo'));
    carInfo.vehicle.model={id:id,name:name};
    localStorage.setItem("carInfo", JSON.stringify(carInfo));
   window.location.href = base_url + "/car-insurance/variant/"+name;
});

$('body').on('change', '.select-choose-model', function(e) {
    e.preventDefault();
    var id = $(this).val();
    if(id!=""){
        var name = $(".select-choose-model option:selected").text();
        var carInfo = JSON.parse(localStorage.getItem('carInfo'));
        carInfo.vehicle.model = {id:id,name:name};
        localStorage.setItem("carInfo", JSON.stringify(carInfo));
        window.location.href = base_url + "/car-insurance/variant/"+name;
    }
});


$(document).on('click', '.nextmodel', function(e) {
    var localDatass = JSON.parse(localStorage.getItem('carInfo'));
    var modelff = localDatass.model.name;
    if (modelff) {
       window.location.href = base_url + "/car-insurance/variant/"+modelff;
    } else {
        $('#errors').text('Please select any Car Model');
    }
});