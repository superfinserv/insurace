@extends('admin.layout.app')
@section('content')
  <style>
      .dataTables_filter{
          display:none;
      }
      #varients-datatable td{
          font-size: 13px;
         padding: 10px 0px;
 
      }
      #varients-datatable td.vcode{
          background-color: #f3f2f2;
         padding: 10px 0px;
      }
      
      #varients-datatable td,#varients-datatable th{
              vertical-align: middle;
              text-align:center;
      }
      
      #varients-datatable td.vcode a{
          color: black;
      }
      
      #varients-datatable td.vcode a i{
          margin-left: 12px;
          color: #17a3b5;
      }
  </style> 
       <div class="form-layout">
           <div class="variant-notify"></div>
           <!--$_SERVER["DOCUMENT_ROOT"]."/insassets/vehicles/"-->
            <form class="form-group" method="post" enctype="multipart/form-data" action="#" id="VarientForm" >
                  <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                    <div class="row">
                      <div class="col-lg-3">
                        <div class="form-group">
                          <label class="form-control-label">Variant  Name: <span class="tx-danger">*</span></label>
                          <input class="form-control" type="text" id="VariantName" name="VariantName"  placeholder="Enter variant name" >
                        </div>
                      </div>
                      
                      <div class="col-lg-3">
                        <div class="form-group">
                          <label class="form-control-label">Select Brand: <span class="tx-danger">*</span></label>
                            <select class="form-control select2-show-search" data-placeholder="Choose one" name="brand" id="brand" >
                             <option value="">Choose one</option>
                              @foreach ($brands as $row)
                               <option value="{{$row->id}}">{{$row->brand}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      
                      <div class="col-lg-3">
                        <div class="form-group">
                          <label class="form-control-label">Select Model: <span class="tx-danger">*</span></label>
                            <select class="form-control select2-show-search" data-placeholder="Choose one" name="model" id="model" >
                             <option value="">Choose one</option>
                          </select>
                        </div>
                      </div>
                      
                      <div class="col-lg-3">
                        <div class="form-group">
                            <label class="form-control-label">Fuel Type: <span class="tx-danger">*</span></label>
                            <select id="fuelType" name="fuelType" class="form-control">
                                <option value="Petrol">Petrol</option>
                                <option value="Diesel">Diesel</option>
                                <option value="CNG">CNG</option>               
                            </select>
                        </div>
                      </div><!-- col-4 -->
                    </div>
                      
                    <div class="row">
                      <div class="col-lg-2">
                        <div class="form-group">
                            <label class="form-control-label">Body Type: <span class="tx-danger">*</span></label>
                            <select id="bodyType" name="bodyType" class="form-control select2-show-search">
                                <option value="">Choose one</option>
                                 @foreach ($body_types as $bt)
                                   <option value="{{$bt->type}}">{{$bt->type}}</option>
                                 @endforeach
                            </select>
                        </div>
                      </div><!-- col-2 -->
                      
                      
                      <div class="col-lg-2">
                        <div class="form-group">
                            <label class="form-control-label">No of wheels: <span class="tx-danger">*</span></label>
                            <select id="no_of_wheels" name="no_of_wheels" class="form-control select2-show-search">
                                @for ($i = 2; $i < 100; $i++)
                                 <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                      </div><!-- col-2 -->
                      
                      <div class="col-lg-2">
                        <div class="form-group">
                            <label class="form-control-label">Seating Capacity: <span class="tx-danger">*</span></label>
                            <select id="no_of_seating" name="no_of_seating" class="form-control select2-show-search">
                                @for ($i = 0; $i < 100; $i++)
                                 <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                      </div><!-- col-2 -->
                      
                      <div class="col-lg-2">
                        <div class="form-group">
                          <label class="form-control-label">Vehicle code(Digit): <span class="tx-danger">*</span></label>
                          <input class="form-control" type="text" name="DigitCode"  id="DigitCode" placeholder="Enter code for digit" >
                        </div>
                      </div>
                      <div class="col-lg-2">
                        <div class="form-group">
                          <label class="form-control-label">Vehicle code(FG): <span class="tx-danger">*</span></label>
                          <input class="form-control" type="text" name="FgCode"  id="FgCode" placeholder="Enter code for Future Generali" >
                        </div>
                      </div>
                      <div class="col-lg-2 pd-t-30">
                          <button type="submit"  class="btn btn-info btn-block variantSaveBtn">Submit</button>
                      </div>
                    </div>
          </form>
        </div>
        <div class="card bd-0 ">
    <div class="card-header tx-medium bd-0 tx-white bg-danger">
      Vehicles Brands List
    </div><!-- card-header -->
    <div class="card-body bd bd-t-0 rounded-bottom">
         <div class="table-wrapper">
             <table class="table table-bordered filter-table ">
                <tr>
                    <td style="width:25%">
                        <div class="input-group">
                         <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                           <input id="table-0" class="form-control search-input-text" data-column="0" type="text" placeholder="Variant  Name" data-original-title="" title="">
                        </div>
                   </td>
                    <td style="width:25%">
                        <div class="input-group">
                         <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                           <input id="table-1" class="form-control search-input-text" data-column="1" type="text" placeholder="Model Name" data-original-title="" title="">
                        </div>
                   </td>
                    <td style="width:25%">
                        <div class="input-group">
                         <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                           <input id="table-2" class="form-control search-input-text" data-column="2" type="text" placeholder="Brand Name" data-original-title="" title="">
                        </div>
                   </td>
                   <td style="width:25%">
                        <div class="input-group">
                         <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                           <input id="table-3" class="form-control search-input-text" data-column="3" type="text" placeholder="Vehicle Code" data-original-title="" title="">
                        </div>
                   </td>
                </tr>
                            
            </table>
            <table id="varients-datatable" class="table table-bordered">
              <thead>
                <tr>
                    <th rowspan="2">variant Name</th>
                    <th rowspan="2">Model Name</th>
                    <th rowspan="2">Brand Name</th>
                    <th rowspan="2">Seat</th>
                    <th rowspan="2">Wheels</th>
                    <th rowspan="2">Fuel</th>
                    <th rowspan="2">Body</th>
                    <th colspan="2">Supplier Code</th>
                    <th rowspan="2">Status</th>
                    <th rowspan="2">Action</th>
                </tr>
                <tr>
                    <th style="border-left:1px solid #ccc;">Digit</th>
                    <th>FG</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
        </div><!-- table-wrapper -->
     </div><!-- card-body -->
 </div>
@endsection