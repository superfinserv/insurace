$(function(){
    'use strict'
     var _token = $('meta[name="csrf-token"]').attr('content'); 
    $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': _token
         }
    });
    
    var salestable = $('#sales-datatable').DataTable( {
        "scrollX": false,
         bLengthChange: false,
         responsive: true,
        "autoWidth": false,
                "processing": true,
                "serverSide": true,
               "ajax": {
                    "url": base_url+"/sales/insured/getInsureddatatable",
                     "type": "POST",
                },
                "columns": [
                    {"data" : "policy_no","orderable":false},
                    { "data": "transaction_no","orderable":false},
                    {"data" : "type","orderable":false},
                    {"data" : "amount","orderable":false},
                    {"data" : "provider","orderable":false},
                    {"data" : "customer","orderable":false},
                   // {"data" : "file","className":"td-file","orderable":false},
                    {"data" : "date","orderable":false},
                   // {"data" : "policy_status","orderable":false},
                   // {"data" : "payment_status","orderable":false},
                    { "data": "action" ,"orderable":false}
                ],
                "columnDefs": [
                    { "width": "10%", "targets": 0 },
                    { "width": "12%", "targets": 1 },
                    { "width": "10%", "targets": 2 },
                    { "width": "10%", "targets": 3 },
                    { "width": "15%", "targets": 4 },
                    { "width": "10%", "targets": 5 },
                    { "width": "10%", "targets": 6 },
                    { "width": "10%", "targets": 7 },
                   // { "width": "10%", "targets": 8 },
                   // { "width": "10%", "targets": 9 },
                   // { "width": "10%", "targets": 10 },
                 
                  ],
            } );
 
    $('.search-input-text').on( 'keyup click', function () {   // for text boxes
        var i =$(this).attr('data-column');  // getting column index
        var v =$(this).val();  // getting search input value
        salestable.columns(i).search(v).draw();
   });
   
   $('body').on('click','.get-policy-overview',function(e){ 
       e.preventDefault();
        var policyId = $(this).attr('data-id');
        var policyNo = $(this).attr('data-no');
        $('#policyModalHeader').text(policyNo);
            $("#policyOverviewModal").modal("show");
        //   $('#policyOverviewModal').find('#policyModalContent').empty();
        //   $('#policyOverviewModal').find('#policyModalContent').append('<div class="lds-ring"><div></div><div></div><div></div><div></div></div>');
          
        $.get(base_url+'/sales/insured/get-policy-overview/'+policyId,function(result){
             $('#policyOverviewModal').find('#policyModalBody').empty();
             $('#policyOverviewModal').find('#policyModalBody').append(result);
        });
   })
   
     
   $('body').on('click','.get-policy-doc',function(e){
         var _this = $(this);
         var policyid = $(this).attr('data-id');
         _this.find('div').find('.fa').removeClass('fa-globe').addClass('fa-spinner fa-spin');
          $.post(base_url+"/sales/insured/getpdf",{policyid:policyid},function(result){
              var st = $.trim(result.status);
              if(st=="success"){
                 _this.find('div').find('.fa').removeClass('fa-spinner fa-spin').addClass('fa-download');
                 _this.attr('href',result.filePath)
                  notification('success',result.message); 
                }else{
                 _this.find('div').find('.fa').removeClass('fa-spinner fa-spin').addClass('fa-globe');
                  notification('error',result.message); 
                }
          },'json')
    });
   
  
 });
