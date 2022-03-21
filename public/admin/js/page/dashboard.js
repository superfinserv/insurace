$(function(){
  'use strict'
   
   function pospStatistic(tab){
        $('#posp-statistic').loading({message: 'Loading...'});
        $.get(base_url+"/get-posp-statistic/"+tab,function(resp) {
                    console.log(resp)
                    var res = resp.data;
                    $('#spn-Recruited').text(res.Recruited);
                    $('#spn-active').text(res.Active);
                    $('#spn-trash').text(res.Trash);
                    $('#spn-untr').text(res.Untra);
                    $('#posp-statistic').loading('stop');
                },'json');
   }
   function nopStatistic(tab){
        $('#nop-statistic').loading({message: 'Loading...'});
        $.get(base_url+"/get-nop-statistic/"+tab,function(resp) {
                    console.log(resp)
                    var res = resp.data;
                    $('#spn-nop-Life').text(res.Life);
                    $('#spn-nop-Health').text(res.Health);
                    $('#spn-nop-Motor').text(res.Motor);
                    $('#spn-nop-NonMotor').text(res.NonMotor);
                    $('#nop-statistic').loading('stop');
                },'json');
   }
   
   
   function premiumStatistic(tab){
        $('#premium-statistic').loading({message: 'Loading...'});
        $.get(base_url+"/get-premium-statistic/"+tab,function(resp) {
                    
                    var res = resp.data;
                    $('#spn-Life').text(res.Life);
                    $('#spn-Health').text(res.Health);
                    $('#spn-Motor').text(res.Motor);
                    $('#spn-NonMotor').text(res.NonMotor);
                    $('#premium-statistic').loading('stop');
                },'json');
   }
   
   function salesStatistic(){
        $('.sales-statistic').loading({message: 'Loading...'});
        $.get(base_url+"/get-sales-statistic/",function(resp) {
                   $.each(resp.data, function(i, obj) { 
                      
                       $.each(obj, function(j, item) {
                           if($('.'+i+'-'+j).length){
                             $('.'+i+'-'+j).text(item);
                           }
                           
                       });
                       
                   })
                    $('.sales-statistic').loading('stop');
                },'json');
   }
   
   pospStatistic('ALL');
   premiumStatistic('ALL');
   nopStatistic('ALL');
   salesStatistic();
   
   $('body').on('click','.btn-posp-statistic',function(e){
       e.preventDefault();
       $('.btn-posp-statistic').removeClass('active');
       $(this).addClass('active');
       var tab  = $(this).attr('data-attr');
       pospStatistic(tab);
   });
   $('body').on('click','.btn-nop-statistic',function(e){
       e.preventDefault();
       $('.btn-nop-statistic').removeClass('active');
       $(this).addClass('active');
       var tab  = $(this).attr('data-attr');
       nopStatistic(tab);
   })
   
   $('body').on('click','.btn-premium-statistic',function(e){
       e.preventDefault();
       $('.btn-premium-statistic').removeClass('active');
       $(this).addClass('active');
       var tab  = $(this).attr('data-attr');
       premiumStatistic(tab);
   })
  

});
