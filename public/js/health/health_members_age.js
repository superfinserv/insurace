var healthInfo = [];
var agegroup1 = '<option value="">Select age</option><option value="3-12">3-12 Months</option>';
var agegroup2 = '<option value="">Select age</option>';
var agegroup3 = '<option value="">Select age</option>';
$(window).on('load', function(){
    for(var a1=1;a1<=24;a1++){  agegroup1 +='<option value="'+a1+'">'+a1+' Yr</option>';}
    for(var a2=18;a2<=99;a2++){ agegroup2 +='<option value="'+a2+'">'+a2+' Yr</option>';}
    for(var a3=40;a3<=99;a3++){ agegroup3 +='<option value="'+a3+'">'+a3+' Yr</option>';}
    if(localStorage.getItem("healthInfo")){ 
       healthInfo = JSON.parse(localStorage.getItem('healthInfo'));
     //  console.log("agegroup1",healthInfo);
       addedItem = Object.keys(healthInfo).length;
       if(addedItem){
          if(healthInfo.members){
              var indx =1;
              $.each(healthInfo.members, function (key, data) {
                  //console.log(key,data);
                  var _typ = data.type;
                  var str = _typ.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                        return letter.toUpperCase();
                    });
                        var options ="";
                        if(_typ=="daughter" || _typ=="son"){  options = agegroup1;
                        }else if(_typ=='self' || _typ=='wife' || _typ=='husband'){   options = agegroup2;
                        }else{  options = agegroup3; }
                        var val = (data.dd)?data.dd+'/'+data.mm+'/'+data.yy:"";
                          $('.listing-members').append('<div class="col-md-6 col-sm-12 col-xs-12">'
                                    +'<div class="media-box-container">'
                                         +'<ul class="mediabox" style="">'
                                          +'<li class="li-left"><label>'+str+'</label></li>'
                                         +' <li class="text-right li-right">'
                                              +'<select tabindex="'+indx+'" id="'+_typ+'-age-'+key+'" name="'+_typ+'-age-'+key+'" style="font-size: 16px;border: none;width: 100%;">'+options+'</select>'
                                         +'</li>'
                                        +'</ul>'
                                    +'</div>'
                                +'</div>');
                         //$('#'+_typ+'-age-'+key).val(healthInfo.members[key].age);
                  indx++;  
              });
              
              $('#state_id').attr('tabindex',indx);indx++;
               $('#city_id').attr('tabindex',indx);indx++;
                $('#pincode').attr('tabindex',indx);
          }
       }
    }
    
   
});




$("body").on('click','.btnTable3',function(e){
    if(healthInfo.members){
        var valid = true;var adult=0;var child=0;
        $.each(healthInfo.members, function (key, data) {
           var _typ = data.type;
           var str = _typ.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                return letter.toUpperCase();
            });
            if(_typ=="daughter" || _typ=="son"){ child++; }else{  adult++; }
                if($('#'+_typ+'-age-'+key).val()==""){
                      valid = false;
                      $('#'+_typ+'-age-'+key).parent().parent().parent('.media-box-container').after("<span class='span-error'>Age is required.</span>");
                }else{
                    
                    var age = $('#'+_typ+'-age-'+key).val();//(calculateAge(dobArr[1]+"/"+dobArr[0]+"/"+dobArr[2]));
                    age = (age=='3-12')?1:age;
                    var d = new Date();
                    var Y = parseInt(d.getFullYear())-parseInt(age);
                    var M = parseInt(d.getMonth())+1;
                    var D = d.getDate();
                    var _date = D+'/'+M+'/'+Y;//$('#'+_typ+'-age-'+key).val();
                    var dobArr = _date.split("/");
                    if(_typ=='self'){ healthInfo.selfAge = age;healthInfo.selfdd = dobArr[0];healthInfo.selfmm = dobArr[1];healthInfo.selfyy = dobArr[2];healthInfo.selfDob=dobArr[2]+"-"+dobArr[1]+"-"+dobArr[0];} 
                     healthInfo.members[key].age=age;healthInfo.members[key].dd = dobArr[0];healthInfo.members[key].mm = dobArr[1];healthInfo.members[key].yy = dobArr[2];healthInfo.members[key].dob=dobArr[2]+"-"+dobArr[1]+"-"+dobArr[0];
                     $('#'+_typ+'-age'+key).parent().parent().parent().parent('.media-box-container').find(".span-error").remove(); 
                }
               
        })
        if($('#state_id').val()==""){ valid = false;
              $('#state_id').parent().parent().find(".select2-error").remove();
              $('#state_id').parent().after("<span class='select2-error'>Field is required.</span>");
        }else{
              healthInfo.state =$('#state_id').val(); 
              $('#state_id').parent().parent().find(".select2-error").remove();
        }
        if($('#city_id').val()==""){ valid = false;
             $('#city_id').parent().parent().find(".select2-error").remove();
             $('#city_id').parent().after("<span class='select2-error'>Field is required.</span>"); 
        }else{
             healthInfo.city =$('#city_id').val(); 
             $('#city_id').parent().parent().find(".select2-error").remove(); 
        }
        if($('#pincode').val()==""){ valid = false; console.log("_blnk",$('#pincode').val());
             $('#pincode').parent().parent().find(".select2-error").remove();
             $('#pincode').parent().after("<span class='select2-error'>Field is required.</span>"); 
        }else{
             var _pin = $('#pincode').val();
             if(_pin.length<6  || _pin.length>6){ valid = false;
                $('#pincode').parent().parent().find(".select2-error").remove();
                $('#pincode').parent().after("<span class='select2-error'>Valid pin is required.</span>"); 
             }else{
                healthInfo.pincode =$('#pincode').val(); 
                $('#pincode').parent().parent().find(".select2-error").remove();   
             }
              
        }
        
        
        if(valid){
            healthInfo.total_child = child;
            healthInfo.total_adult = adult;
            healthInfo.document = {documentType:"",documentId:"",documentmm:"",documentdd:"",documentyy:""};
            healthInfo.address ={house_no:"",street:"",city:$('#city_id').val(),state:$('#state_id').val(),pincode:$('#pincode').val()};
            localStorage.setItem("healthInfo", JSON.stringify(healthInfo));
            window.location.href = base_url + "/health-insurance/health-plans"; 
            
            
            
            //   var _isvalid = validatedPincode($('#pincode').val(),$('#city_id').val(),$('#state_id').val()) 
            //                     .then(function(response) { 
            //                         if(response.status===true){
            //                             //console.log(response.status,response.status)
            //                             healthInfo.total_child = child;
            //                             healthInfo.total_adult = adult;
            //                             healthInfo.document = {documentType:"",documentId:"",documentmm:"",documentdd:"",documentyy:""};
            //                             healthInfo.address ={house_no:"",street:"",city:$('#city_id').val(),state:$('#state_id').val(),pincode:$('#pincode').val()};
            //                             localStorage.setItem("healthInfo", JSON.stringify(healthInfo));
            //                             window.location.href = base_url + "/health-insurance/health-plans"; 
            //                         }else{
            //                             $('#pincode').parent().after("<span class='select2-error'>Invalid pincode for city.</span>"); 
            //                         }
            //                     }) 
            //                     .fail(function(err) { 
            //                       return false;
            //                     });
            
            
           
        }
    }
});



$('body').on('change','.age-selector',function(e){
    if($(this).val()==""){
        $(this).parent().parent().parent('.media-box-container').after("<span class='span-error'>Age is required.</span>");
    }else{
        $(this).parent().parent().parent('.media-box-container').parent().find(".span-error").remove();
    }
});
$('body').on('change','.state-city-selector',function(e){
    if($(this).val()==""){
         $(this).parent().parent().find(".select2-error").remove();
        $(this).parent().after("<span class='select2-error'>Field is required.</span>");
    }else{
        $(this).parent().parent().find(".select2-error").remove();
    }
});
 
	var xhr;
				var select_state, $select_state;
				var select_city, $select_city;

				$select_state = $('#state_id').selectize({
					onChange: function(value) {
						if (!value.length) return;
						 var state = value;
                         var stateID = state.split('-');
						select_city.disable();
						select_city.clearOptions();
						select_city.load(function(callback) {
							xhr && xhr.abort();
							xhr = $.ajax({
								url: base_url + "/get-cities/"+stateID[0],
								success: function(results) {
									select_city.enable();
									callback(results.data);
								},
								error: function() {
									callback();
								}
							})
						});
					}
				});

				$select_city = $('#city_id').selectize({
					valueField: 'id',
					labelField: 'value',
					searchField: ['value']
				});

				select_city  = $select_city[0].selectize;
				select_state = $select_state[0].selectize;

				select_city.disable();
// $("body").on("change","#state_id",function() {
//       var state = $(this).val();
//       var stateID = state.split('-');
//         $.get(base_url + "/get-cities/"+stateID[0], function (resp) {
//               if(resp.status=='success'){
//                  var citydata =resp.data;
//                  $("#city_id").empty();
//                   var newState_ = new Option("Select City", "", false, false);
//                   $("#city_id").append(newState_);//.trigger('change');
//                   jQuery.each(citydata, function (index, item) {
//                     var newState = new Option(item['value'], item['id'], false, false);
//                       $("#city_id").append(newState);//.trigger('change');
//                   });
//                   $('#city_id').val('').trigger("change");
                
//               }
//         });
//     });
 
$( function() {
      
           $( "#pincode" ).autocomplete({
                      source: function(request,response){
                          $.ajax( {
                          url:  base_url+"/get-city-pincode",
                          dataType: "json",
                          data: {
                            term: request.term,city:$('#city_id').val()
                          },
                          success: function( data ) {
                            response( data );
                          },
                        } );
                      },
                      minLength: 0,
                      select: function( event, ui ) {
                        //alert( "Selected: " + ui.item.value + " aka " + ui.item.label );
                        // window.location.href = ui.item.url;
                      }
                }).focus(function () {
                    $(this).autocomplete("search");
                });
      
      
      
      
     
       $("body").on("change","#city_id",function() {
          var city = $(this).val();
          if(city!=""){
            $('#pincode').attr('disabled',false);
            $('#pincode').prop('disabled',false);
         }else{
              $('#pincode').val('') ;
              $('#pincode').attr('disabled',true);
              $('#pincode').attr('disabled',true);
         }
    })
      
 
  });   
    
//     $( function() {
//     $("body").on("change","#city_id",function() {
//       var city = $(this).val();
//       if(city!=""){
//          var CT = city.split('-');
//          $.post(base_url + "/get-city-pincode/",{city:CT[1]}, function (resp) { 
//               if(resp.status=="success"){
//                   $('#pincode').val(resp.pincode);
//                 //   availableTags = resp.data;
//                 //   console.log(availableTags);
//               }
//           },'json');
//       }else{
//           $('#pincode').val('') 
//       }
//     })
//     // $( "#pincode" ).autocomplete({
//     //   source: availableTags
//     // });
//   } );
    
   // https://api.postalpincode.in/postoffice/New Delhi
// var start = new Date();
// //var default_end = new Date(start.getFullYear()-80, start.getMonth(), start.getDate());
// var endDate = new Date(start.getFullYear()-18, start.getMonth(), start.getDate());
// $(".self-dobpicker").datepicker({
//     changeMonth: true,changeYear: true,endDate:endDate,
//     format: 'dd-mm-yyyy', autoclose: true,
//  });
 
 
 $(document).ready(function(){ 
     
    //  var options =  {
    //       onComplete: function(cep) {
    //         //alert('CEP Completed!:' + cep);
    //       },
    //       onKeyPress: function(cep, event, currentField, options){
    //         console.log('A key was pressed!:', cep, ' event: ', event,
    //                     'currentField: ', currentField, ' options: ', options);
    //       },
    //       onChange: function(cep){
    //         console.log('cep changed! ', cep);
    //       },
    //       onInvalid: function(val, e, f, invalid, options){
    //         var error = invalid[0];
    //         console.log ("Digit: ", error.v, " is invalid for the position: ", error.p, ". We expect something like: ", error.e);
    //       }
    //     };

$('.dob-mask').mask('00/00/0000');
 })