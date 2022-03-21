 $( window ).load(function() {
     var localData=[];
     localData = JSON.parse(localStorage.getItem('customersDetails'));
     var sex = document.getElementsByName("sex");
     var smoke = document.getElementsByName("smoke");
     var val =localData.sex;
     var age =localData.age;
     var smoks =localData.smoke;
     var city =localData.city;
     var state_id =localData.state_id;
     var name =localData.name;
     var pincode =localData.pincode;
     var income =localData.income;
     
     for(var i=0;i<sex.length;i++){
         if(sex[i].value == val){ sex[i].checked = true; } 
      }

     for(var i=0;i<smoke.length;i++){
         if(smoke[i].value == smoks){
           smoke[i].checked = true;
          }
       }

          if(age!=""){

           $("#age").val(age).find("option[value=" + age +"]").attr('selected', true).trigger('change');

          }

           if(name!=""){

           $("#name").val(name);

          }

           if(pincode!=""){

           $("#pincode").val(pincode);

          }

          if(state_id!=""){

           $("#state_id").val(state_id).find("option[value=" + state_id +"]").attr('selected', true).trigger('change');

          }

           if(city!=""){

           $("#city").val(city).find("option[value=" + city +"]").attr('selected', true).trigger('change');

          }



          if(income!=""){

           $("#income").val(income).find("option[value=" + income +"]").attr('selected', true).trigger('change');

          }

         

       

      

});

 

 $(document).ready(function(){

    'use strict';

     var _token = $('meta[name="csrf-token"]').attr('content'); 

    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': _token

        }

    });

 

 $(document).on('click', '.sex', function (e) { 

        var sex =$("input[name='sex']:checked").val();

       

        var localData = JSON.parse(localStorage.getItem('customersDetails'));

                        console.log(localData.customer_id);

                        localData.sex=sex;

                       

                        localStorage.setItem("customersDetails", JSON.stringify(localData));

                         window.location.href = base_url + "/term-insurance/users-info";

    });

$(document).on('click', '.smoke', function (e) { 

        var smoke =$("input[name='smoke']:checked").val();

       

        var localData = JSON.parse(localStorage.getItem('customersDetails'));

                        console.log(localData.customer_id);

                        localData.smoke=smoke;

                       

                        localStorage.setItem("customersDetails", JSON.stringify(localData));

                         window.location.href = base_url + "/term-insurance/your-income";

    });

$(document).on('click', '.customersdetails', function (e) { 

        var sex =$("input[name='radio1']:checked").val();

       

        var localData = JSON.parse(localStorage.getItem('customersDetails'));

                        console.log(localData.customer_id);

                        localData.sex=sex;

                       

                        localStorage.setItem("customersDetails", JSON.stringify(localData));

                         window.location.href = base_url + "/term-insurance/users-info";

    });



     





jQuery.validator.addMethod("fullname", function(value, element) {

  if (/^([a-zA-Z]{2,}\s[a-zA-z]{1,}'?-?[a-zA-Z]{2,}\s?([a-zA-Z]{1,})?)/.test(value)) {

    return true;

  } else {

    return false;

  };

}, 'Please enter your full name.');



$("#usersDetails").validate({   



        rules: {

            

            'name':{

                required: true,

                fullname: true

            },

             'city':{

                required: true,

               

            },

            'state_id':{

                required: true,

               

            },

             'age':{

                required: true,

                

            },

             'pincode':{

                required: true,

                number:true,

            }

        },

        messages: {

           

            'name':{

                required: "Name is required!",

               custom_fullname : "Your Name should be entered like: fullname lastname  (or) fullname-lastname"

            },

            'city':{

                required: "City is required!",

              

            },

             'state_id':{

                required: "state is required!",

              

            },

            'age':{

                required: "Age is required!",

              

            },

            'pincode':{

                required: "Pincode is required!",

                number:"Enter valid Pincode number.",

            }

        },

        errorPlacement: function(error, element) {

                            if(element.attr("name") == "city"){

                                error.appendTo('#errors');

                                return;

                            }



                            if(element.attr("name") == "state_id"){

                                    error.appendTo('#error');

                                    return;

                            }

                            if(element.attr("name") == "age"){

                                    error.appendTo('#errorss');

                                    return;

                            }else {

                                error.insertAfter(element);

                            }

                       },

             submitHandler: function (form) {

              var name=$('#name').val();

              var city=$('#city').val();

               var state_id=$('#state_id').val();

              var age=$('#age').val();

              var pincode=$('#pincode').val();

            var localData = JSON.parse(localStorage.getItem('customersDetails'));

                        console.log(localData.customer_id);

                        localData.name=name;

                        localData.city=city;

                        localData.state_id=state_id;

                        localData.age=age;

                        localData.pincode=pincode;

                        localStorage.setItem("customersDetails", JSON.stringify(localData));

                         window.location.href = base_url + "/term-insurance/do-skome";

        }

      }); 



$("#incomeForm").validate({   



        rules: {

            

            'income':{

                required: true,

               

            },

             

        },

        messages: {

           

            'income':{

                required: "Income  is required!",

               custom_fullname : "Your Name should be entered like: fullname lastname  (or) fullname-lastname"

            },

            

        },

             submitHandler: function (form) {

              var income=$('#income').val();

            

            var localData = JSON.parse(localStorage.getItem('customersDetails'));

                        console.log(localData.customer_id);

                        localData.income=income;

                        localStorage.setItem("customersDetails", JSON.stringify(localData));

                         window.location.href = base_url + "/term-insurance/do-skome";

        }

      }); 



 }); 



 $(document).ready(function($){

    $('#state_id').change(function(){

     var option= $(this).val()

        $.get(base_url+"/dropdown/"+option, 

        

        function(data) {

            

            $('#city').empty();

            $('#city').append("<option value=''>Select City</option>");

            $.each(data, function(key, element) {

                 localData = JSON.parse(localStorage.getItem('customersDetails'));

                var city =localData.city;

                if( city==element.id){

                    $('#city').append("<option value='" + element.id +"' selected>" + element.name + "</option>");

                }else{

                $('#city').append("<option value='" + element.id +"'>" + element.name + "</option>");

            }

                

            });

        });

       

        $('#city').val(city).prop('selected', true);

    });

});