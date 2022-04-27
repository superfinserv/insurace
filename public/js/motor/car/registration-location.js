// $(window).on('load', function(){
//     var twInfo = [];
//     if(localStorage.getItem("twInfo")){ 
//       twInfo = JSON.parse(localStorage.getItem('twInfo'));
//       addedItem = Object.keys(twInfo).length;
//       if(addedItem){
          
//       }
//     }
// });

$(document).ready(function() {
   $("#rtocodeForm").validate({
       ignore: ':hidden:not([class~=selectized]),:hidden > .selectized, .selectize-control .selectize-input input',
    rules: {
        'rto_code': { required: true, },
        //'bikenew': { required: true, },
    },
    messages: {
        'rto_code': { required: "Your car registration place is required!", },
        //'bikenew': {  required: "Bike policy renew and new is required!",  },
    },
    errorPlacement: function(error, element) {
        if (element.attr("name") == "rto_code") {  error.appendTo('#rto_code-error'); return; }
       // if (element.attr("name") == "bikenew") {  error.appendTo('#bikenew-error'); return; }
    },
    submitHandler: function(form) {
      //localStorage.removeItem('addons');
       var rto_code = $('#rto_code').val();
       var carInfo = JSON.parse(localStorage.getItem('carInfo'));
           carInfo.vehicle.rtoCode    = rto_code;
           localStorage.setItem("carInfo", JSON.stringify(carInfo));
        window.location.href = base_url + "/car-insurance/brand";
    }
});

$(".rto-location").selectize({
  create: false,
  sortField: "text",
});
});