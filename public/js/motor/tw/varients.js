$(window).on('load', function(){
    $('#VarientContainer').loading({
              message: 'Loading varients...'
            });
    var twInfo = [];
    if(localStorage.getItem("twInfo")){ 
       twInfo = JSON.parse(localStorage.getItem('twInfo'));
       addedItem = Object.keys(twInfo).length;
       if(addedItem){
           $('#span-modal-name').text(twInfo.vehicle.model.name);
            $.get(base_url+"/twowheeler-insurance/load-varients/"+twInfo.vehicle.model.id+"/"+twInfo.vehicle.model.name, function(result) {
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
    var twInfo = JSON.parse(localStorage.getItem('twInfo'));
    twInfo.vehicle.varient = {id:id,name:name};
    twInfo.vehicle.fueltype = $(this).attr('data-fule');
    twInfo.vehicle.cc = $(this).attr('data-cc');
    localStorage.setItem("twInfo", JSON.stringify(twInfo));
    if(twInfo.vehicle.isBrandNew===true && twInfo.vehicle.hasvehicleNumber===false){
         // Go to list plan
        window.location.href = base_url + "/twowheeler-insurance/plans/";
     }else{
         // Go to regstration-year
        window.location.href = base_url + "/twowheeler-insurance/registration-year/";
     }
});
$(document).on('click', '.nextvariant', function(e) {
    var twInfo = JSON.parse(localStorage.getItem('twInfo'));
    var varff = twInfo.vehicle.model.id;
    if (varff) {
        window.location.href = base_url + "/twowheeler-insurance/registration-year/";
    } else {
        $('#errors').text('Please select any Tw variant');
    }
});
$(document).on('click', '#backs', function(e) {
    var twInfo = JSON.parse(localStorage.getItem('twInfo'));
    window.location.href = base_url + "/twowheeler-insurance/model/" + twInfo.vehicle.brand.name;
})