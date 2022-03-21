$(document).ready(function(){
    'use strict';
     var _token = $('meta[name="csrf-token"]').attr('content'); 
     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': _token
        }
    });
    
    $('body').on('click','.getPolicyPdf',function(e){
        e.preventDefault();
        var id  = $(this).attr('data-id');
        var clone = $('#actionPolicy-td-'+id).html();
        $('#actionPolicy-td-'+id).html('<i style="font-size: 20px;color: #C52118;" class="fa fa-spin fa-spinner"></i>');
        $.post(base_url+"/get-policy-doc",{id:id}, function(data) {
            var str = $.trim(data.status);
            if (str == "success") {
                $('#actionPolicy-td-'+id).html('<a class="" href="'+data.path+'">Download</a>');
                 toastr.success("Policy Pdf Get successfully");
            }else{
                 $('#actionPolicy-td-'+id).html(clone);
                 toastr.error("Error while get policy Pdf");
            }
        },'json')
    })
    
    //$('#myBusinessTable').DataTable();
    
     var myBusinessTable = $('#myBusinessTable').DataTable( {
        "scrollX": false,
         bLengthChange: false,
         responsive: true,
        "autoWidth": false,
                "processing": true,
                "serverSide": true,
                "order":[[0,'desc']],
               "ajax": {
                    "url": base_url+"/sales-dashbord/datatable",
                     "type": "POST",
                },
                "columns": [
                    { "data": "customer","orderable":false},
                    {"data" : "date","orderable":true},
                    {"data" : "amount","orderable":true},
                    {"data" : "policyNo","orderable":false},
                    {"data" : "transactionNo","orderable":false},
                    {"data" : "policyFrom","orderable":false},
                    {"data" : "policyFor","orderable":false},
                    {"data" : "Paymentstatus","orderable":false},
                    { "data": "policyStatus" ,"orderable":false},
                    { "data": "action" ,"orderable":false}
                ],
                "columnDefs": [
                    { "width": "3%", "targets": 0 },
                    { "width": "15%", "targets": 1 },
                    { "width": "7%", "targets": 2 },
                    { "width": "20%", "targets": 3 },
                    { "width": "10%", "targets": 4 },
                    { "width": "10%", "targets": 5 },
                    { "width": "10%", "targets": 6 },
                    { "width": "10%", "targets": 7 },
                    { "width": "10%", "targets": 8 },
                    { "width": "10%", "targets": 9 },
                 
                  ],
            } );
 
    $('.search-input-text').on( 'keyup change', function () {   // for text boxes
        var i =$(this).attr('data-column');  // getting column index
        var v =$(this).val();  // getting search input value
        myBusinessTable.columns(i).search(v).draw();
   });
   
    myBusinessTable.on( 'draw', function () { 
            var postData = {
                            fYear:$('#table-0').val(),
                            supp:$('#table-1').val(),
                            pTyp:$('#table-2').val(),
                            term:$('#table-3').val()
                          }
            $.post(base_url+"/sales-dashbord/get-dashboard-counts",postData,function(result){
                 $('#TotalSale').text(result.TotalSale);
                 //$('#MonthSale').text(result.MonthSale); 
                 $('#TotalSalesCount').text(result.TotalSalesCount+'/'.result.TotalSaleMonthCount);
                // $('#collateral_total').text(result.collateral_total); 
                // $('#net_total').text(result.net_total);
                
                // $('#count_saving').text('('+result.count_saving+')'); 
                // $('#count_loan').text('('+result.count_loan+')'); 
                // $('#count_collateral').text('('+result.count_collateral+')'); 
            },'json');
   })

});