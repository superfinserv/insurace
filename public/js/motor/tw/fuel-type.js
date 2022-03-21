$(window).on('load', function(){
  
    var bikeInfo = [];
    if(localStorage.getItem("bikeInfo")){ 
       bikeInfo = JSON.parse(localStorage.getItem('bikeInfo'));
       addedItem = Object.keys(bikeInfo).length;
       if(addedItem){
           bikeInfo = JSON.parse(localStorage.getItem('bikeInfo'));
           
       }
    }
});

$(document).ready(function() {
$("#fueltypeForm").validate({
    rules: {
        'fueltype': {
            required: true,
        },
    },
    messages: {
        'fueltype': {
            required: "fuel type  is required!",
        },
    },
    errorPlacement: function(error, element) {
        if (element.attr("name") == "fueltype") {
            error.appendTo('#errors');
            return;
        }
    },
    submitHandler: function(form) {
        var fueltype = $("input[name='fueltype']:checked").val();
        var bikeInfo = JSON.parse(localStorage.getItem('bikeInfo'));
        bikeInfo.fueltype = fueltype;
        localStorage.setItem("bikeInfo", JSON.stringify(bikeInfo));
        window.location.href = base_url + "/bike-insurance/bike-variant/"+bikeInfo.model.name;
    }
  });
});

$(document).on('click', '#backs', function(e) {
    var localDatagh = JSON.parse(localStorage.getItem('customersDetails'));
    var brands = localDatagh.brand;
    window.location.href = base_url + "/bike-insurance/bike-model/" + brands;
})