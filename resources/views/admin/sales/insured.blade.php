@extends('admin.layout.app')
@section('content')
  <style>
      .dataTables_filter{
          display:none;
      }
      
      #agent-datatable tbody tr td{
            /*padding: 5px 5px;*/
            text-align: center;
            vertical-align: middle;
      }
      
      #agent-datatable thead tr th{
           text-align: center;
      }
      
     .modal.left .modal-dialog,
	.modal.right .modal-dialog {
		position: fixed;
		margin: auto;
		width: 320px;
		height: 100%;
		-webkit-transform: translate3d(0%, 0, 0);
		    -ms-transform: translate3d(0%, 0, 0);
		     -o-transform: translate3d(0%, 0, 0);
		        transform: translate3d(0%, 0, 0);
	}

	.modal.left .modal-content,
	.modal.right .modal-content {
		height: 100%;
		/*overflow-y: auto;*/
	}
	
	.modal.left .modal-body,
	.modal.right .modal-body {
	    padding: 8px;
	   overflow: scroll;
	}

      
   .modal.right.fade .modal-dialog {
		right: 0px;
		-webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
		   -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
		     -o-transition: opacity 0.3s linear, right 0.3s ease-out;
		        transition: opacity 0.3s linear, right 0.3s ease-out;
	}
	
	.modal.right.fade.in .modal-dialog {
		right: 0;
	}
	
	.modal-header {
		border-bottom-color: #EEEEEE;
		background-color: #0E3679;
		    padding: 5px 10px;
       color: #ccc;
       border-bottom:0px;

	}
	
	.modal.right .modal-content .modal-header {
    display: initial;
	}
	
	.modal.right .modal-body::-webkit-scrollbar {
  width: 3px;               /* width of the entire scrollbar */
}


.modal.right .modal-body::-webkit-scrollbar-thumb {
    background-color: #a5150d;
    border-radius: 40px;
    border: 0px solid #a5150d  
}
	
	a{
	    color:#0E3679
	}
	a:hover{
	    color: #C52118;
	}
	.sk-cube-grid .sk-cube {
    background-color: #C52118;
	}
  </style> 
  
   <div class="agent-list-notify"></div>
  <div class="card bd-0 ">
    <!--<div class="card-header tx-medium bd-0 tx-white bg-danger">-->
     
    <!--</div><!-- card-header -->
     <div class="card-header bg-danger d-flex   align-items-center justify-content-between">
          <h6 class="mg-b-0 tx-14 tx-white"> Insured List</h6>
          
      </div>
    <div class="card-body bd bd-t-0 rounded-bottom">
         <div class="table-wrapper">
          <table class="table table-bordered filter-table ">
                            <tr>
                                <td style="width:10%"></td>
                                <td style="width:30%">
                                    <div class="input-group">
                                     <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                                       <input id="table-0" class="form-control search-input-text" data-column="0" type="text" placeholder="Policy Number" data-original-title="" title="">
                                    </div>
                               </td>
                               <td style="width:30%">
                                    <div class="input-group">
                                     <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                                       <input id="table-1" class="form-control search-input-text" data-column="1" type="text" placeholder="Transaction Number" data-original-title="" title="">
                                    </div>
                               </td>
                               <td style="width:30%">
                                    <div class="input-group">
                                     <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                                       <input id="table-2" class="form-control search-input-text" data-column="2" type="text" placeholder="Customer Name/Mobile" data-original-title="" title="">
                                    </div>
                               </td>
                              
                            </tr>
                            
                        </table>
            <table id="sales-datatable" class="table display responsive table-bordered">
              <thead>
                <tr>
                  <th>Policy No</th>
                  <th>Transaction ID</th>
                  <th>Type</th>
                  <th>Amount</th>
                  <th>Insurer</th>
                  <th>Customer</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
        </div><!-- table-wrapper -->
     </div><!-- card-body -->
 </div>
 
 <!-- Modal -->
	<div class="modal right fade  effect-slide-in-right " id="policyOverviewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
		<div class="modal-dialog" role="document">
			<div class="modal-content" id="policyModalContent">

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:#fff"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="policyModalHeader">Right Sidebar</h4>
				</div>

				<div class="modal-body" id="policyModalBody">
					<div class="d-flex pos-relative align-items-center" style="height:85vh;">
                        <div class="sk-cube-grid">
                          <div class="sk-cube sk-cube1"></div>
                          <div class="sk-cube sk-cube2"></div>
                          <div class="sk-cube sk-cube3"></div>
                          <div class="sk-cube sk-cube4"></div>
                          <div class="sk-cube sk-cube5"></div>
                          <div class="sk-cube sk-cube6"></div>
                          <div class="sk-cube sk-cube7"></div>
                          <div class="sk-cube sk-cube8"></div>
                          <div class="sk-cube sk-cube9"></div>
                        </div>
                    </div>
				</div>

			</div><!-- modal-content -->
		</div><!-- modal-dialog -->
	</div><!-- modal -->
         
         

      
@endsection