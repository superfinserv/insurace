@extends('admin.layout.app')
@section('content')
  <style>
      .dataTables_filter{
          display:none;
      }
      
      #agent-datatable.dataTable td.reorder {
            text-align: center;
            cursor: move;
        }
        
        table.dataTable thead .sorting_desc , table.dataTable thead .sorting_asc,table.dataTable thead .sorting {
            background-image: unset;
         }
         
        table thead th {
            vertical-align: middle !important;
        }
        
        table tbody tr td{
           font-size: 13px;
           letter-spacing: 0.5px;
           vertical-align: middle !important;
        }
  </style> 
   <div class="agent-list-notify"></div>
    <!--<div class="card bd-0 ">-->
    <!--    <div class="card-body bd bd-t-0 rounded-bottom">-->
    <!--        <div class="row">-->
    <!--           <div class="col-lg-3 col-md-3">-->
    <!--                <div class="form-group">-->
    <!--                  <input class="form-control" type="text" id="ssoID" name="ssoID" value="" placeholder="Enter HDFC ID">-->
    <!--                </div>-->
    <!--           </div>-->
    <!--           <div class="col-lg-3 col-md-3">-->
    <!--               <button class="btn btn-success btn-sm "  id="go_hdfc_plan" type="button">Go to SSO</button>-->
    <!--           </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->
  <div class="card bd-0 ">
    <!--<div class="card-header tx-medium bd-0 tx-white bg-danger">-->
     
    <!--</div><!-- card-header -->
     <div class="card-header bg-danger d-flex  align-items-center justify-content-between pd-y-5">
          <h6 class="mg-b-0 tx-14 tx-white"> Rule List</h6>
          <div class="card-option tx-24">
            
            <a href="#" class="btn btn-dark  btn-sm tx-white mg-l-10 open-model" data-param="create"><i class="icon ion-plus-circled lh-0 "></i> ADD NEW</a>
            
           </div><!-- card-option -->
      </div>
    <div class="card-body bd bd-t-0 rounded-bottom">
         <div class="table-wrapper">
            <table class="table table-bordered filter-table ">
                <tr>
                    <td style="width:20%">
                        <div class="input-group">
                         <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-date"></i></span></div>
                           <input id="table-4" class="form-control search-input-text" data-column="4" type="text" placeholder="Date" data-original-title="" title="">
                        </div>
                    </td>
                    <td style="width:20%">
                        <div class="input-group">
                         <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                           <input id="table-0" class="form-control search-input-text" data-column="0" type="text" placeholder="Insurer Name" data-original-title="" title="">
                        </div>
                   </td>
                   <td style="width:20%">
                        <div class="input-group">
                         <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                           <select id="table-2" class="form-control search-input-text" data-column="1">
                                <option value="">-All TYPE-</option>
                                <option value="MOTOR">Motor</option>
                                <option value="NON_MOTOR">Non Motor</option>
                                <option value="HEALTH">Health</option>
                            </select>
                        </div>
                   </td>
                   <td style="width:20%">
                        <div class="input-group">
                         <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                           <select id="table-2" class="form-control search-input-text" data-column="2">
                                <option value="">-All PAYOUT-</option>
                                <option value="Percent">Percent</option>
                                <option value="Fixed">Fixed</option>
                            </select>
                        </div>
                   </td>
                    <td style="width:20%">
                        <div class="input-group">
                         <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                           <select id="table-2" class="form-control search-input-text" data-column="3">
                                <option value="">-All POLICY TYPE-</option>
                                 <option value="COM">Comprehensive </option>
                                  <option value="TP">Third Party</option>
                                  <option value="SAOD">Standalone Own Damage</option>
                                  <option value="FL">Floater </option>
                                  <option value="IN">Individual </option> 
                            </select>
                        </div>
                   </td>
                   
                </tr>
            </table>
            <table id="rules-datatable" class="table table-bordered display">
              <thead>
                <tr>
                  <th class="th-v-middle">Rule</th>
                  <th class="th-v-middle">Insurer</th>
                   <th class="text-center th-v-middle">Total</th>
                  <th class="text-center th-v-middle">POSP</th>
                  <th class="text-center th-v-middle">SP</th>
                  <th class="text-center th-v-middle">On Amount</th>
                  <th class="text-center th-v-middle">Vehicle</th>
                  <th class="th-v-middle">Date</th>
                  <th class="text-center th-v-middle">Action</th>
                </tr>
               
              </thead>
              
              <tbody>
                  
              </tbody>
            </table>
        </div><!-- table-wrapper -->
     </div><!-- card-body -->
 </div>
         
         

      
@endsection