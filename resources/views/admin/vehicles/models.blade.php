@extends('admin.layout.app')
@section('content')
  <style>
      .dataTables_filter{
          display:none;
      }
  </style> 
       <div class=""   >
           <form class="form-group" method="post" enctype="multipart/form-data" action="{{url('vehicle/models/save')}}" id="ModelsForm" >
            <input name="_token" type="hidden" value="{{ csrf_token() }}" />
            <div class="row mg-b-25" data-select2-id="11">
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Model Name: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="modelName" id="modelName"  placeholder="Enter model name" >
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-3">
                 <div class="form-group">
                  <label class="form-control-label">Vehicle Categories: <span class="tx-danger">*</span></label>
                    <select class="form-control select2-show-search" data-placeholder="Choose one" name="type" id="type" >
                     <option value="">Choose one</option>
                     <option value="Bike">Bike</option>
                     <option value="Car">Car</option>
                     <option value="Bus">Bus</option>
                     <option value="Tractor">Tractor</option>
                     <option value="Taxi">Taxi</option>
                     <option value="Goods">Goods</option>
                  </select>
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-3">
                <div class="form-group">
                  <label class="form-control-label">Select Brand: <span class="tx-danger">*</span></label>
                    <select class="form-control select2-show-search" data-placeholder="Choose one" name="brand" id="brand" >
                     <option value="">Choose one</option>
                      
                  </select>
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-2 pd-t-30">
                  <button type="submit" class="btn btn-info btn-block">Submit</button>
              </div><!-- row -->
            </div>
          </form>
        </div>
        <div class="card bd-0 ">
            <div class="card-header tx-medium bd-0 tx-white bg-danger">
              Vehicles Models List
            </div><!-- card-header -->
            <div class="card-body bd bd-t-0 rounded-bottom">
                 <div class="table-wrapper">
                     <table class="table table-bordered filter-table ">
                                    <tr>
                                        <td style="width:20%"></td>
                                        <td style="width:30%">
                                            <div class="input-group">
                                             <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                                               <input id="table-0" class="form-control search-input-text" data-column="0" type="text" placeholder="Model Name" data-original-title="" title="">
                                            </div>
                                       </td>
                                       <td style="width:30%">
                                            <div class="input-group">
                                             <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                                               <input id="table-1" class="form-control search-input-text" data-column="1" type="text" placeholder="Brand Name" data-original-title="" title="">
                                            </div>
                                       </td>
                                       <td style="width:20%">
                                            <div class="input-group">
                                             <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                                               <select id="table-2" class="form-control search-input-text" data-column="2">
                                                            <option value="">-All Type-</option>
                                                             <option value="Bike">Bike</option>
                                                             
                                                            <option value="Bus">Bus</option>
                                                            <option value="Car">Car</option>
                                                            <option value="Tractor">Tractor</option>
                                                            <option value="Taxi">Taxi</option>
                                                            <option value="Goods">Goods</option>
                                                            
                                                      </select>
                                            </div>
                                       </td>
                                    </tr>
                                    
                                </table>
                     <table id="models-datatable" class="table display responsive nowrap">
                      <thead>
                        <tr>
                          <th class="wd-15p">#</th>
                          <th class="wd-20p">Model Name</th>
                          <th class="wd-20p">Brand Name</th>
                          <th class="wd-20p">Category</th>
                          <th class="wd-10p">Status</th>
                          <th class="wd-25p">Action</th>
                        </tr>
                      </thead>
                      <tbody></tbody>
                    </table>
                </div><!-- table-wrapper -->
             </div><!-- card-body -->
         </div>
@endsection