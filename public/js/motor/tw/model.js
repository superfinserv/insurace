$(window).on('load', function(){
    $('#ModelContainer').loading({
              message: 'Loading Models...'
            });
    var twInfo = [];
    if(localStorage.getItem("twInfo")){ 
       twInfo = JSON.parse(localStorage.getItem('twInfo'));
       addedItem = Object.keys(twInfo).length;
       if(addedItem){
          $("#span-brand-name").text(twInfo.vehicle.brand.name);
              $.get(base_url+"/twowheeler-insurance/load-models/"+twInfo.vehicle.brand.id+"/"+twInfo.vehicle.brand.name, function(result) {
                 $('#ModelContainer').loading('stop');
                 $('#ModelContainer').empty().html(result);
            })
       }
    }
});

$(document).on('click', '.choose-model', function(e) {
    var name = $(this).attr('data-name');
    var id = $(this).attr('data-id');
    var twInfo = JSON.parse(localStorage.getItem('twInfo'));
    twInfo.vehicle.model={id:id,name:name};
    localStorage.setItem("twInfo", JSON.stringify(twInfo));
   window.location.href = base_url + "/twowheeler-insurance/variant/"+name;
});

$('body').on('change', '.select-choose-model', function(e) {
    e.preventDefault();
    var id = $(this).val();
    if(id!=""){
        var name = $(".select-choose-model option:selected").text();
        var twInfo = JSON.parse(localStorage.getItem('twInfo'));
        twInfo.vehicle.model = {id:id,name:name};
        localStorage.setItem("twInfo", JSON.stringify(twInfo));
        window.location.href = base_url + "/twowheeler-insurance/variant/"+name;
    }
});


$(document).on('click', '.nextmodel', function(e) {
    var localDatass = JSON.parse(localStorage.getItem('twInfo'));
    var modelff = localDatass.model.name;
    if (modelff) {
       window.location.href = base_url + "/twowheeler-insurance/variant/"+modelff;
    } else {
        $('#errors').text('Please select any Two-wheeler Model');
    }
});