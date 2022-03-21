@extends('admin.layout.app')
@section('content')


<div class="card bd-0 ">
    <!--<div class="card-header tx-medium bd-0 tx-white bg-danger">-->
     
    <!--</div><!-- card-header -->
     <div class="card-header bg-danger d-flex  align-items-center justify-content-between pd-y-5">
          <h6 class="mg-b-0 tx-14 tx-white"> Users Details</h6>
          <div class="card-option tx-24">
            <a href="https://admin.supersolutions.co.in/users" class="btn btn-dark  btn-sm tx-white mg-l-10"><i class="icon ion-chevron-left lh-0"></i> Back</a>
          </div><!-- card-option -->
      </div>
    <div class="card-body bd bd-t-0 rounded-bottom">
        <div class="row">
            <input type="hidden" name="_makeId" id="_makeId" value="{{$data->make_id}}"/>
            <div class="col-md-3" style="text-align: center;">
                    <h4>{{$data->make_name}}</h4>
                    <figure class="overlay0">
                      <img id="makeImagesrc" style="width:200px;height:200px;" src="{{asset('public/assets/vehicles/'.$data->makeImg)}}" class="img-fluid" alt="">
                          
                    </figure>
                   <div class=" d-flex align-items-center justify-content-center">
                    <input type="file" name="makeImage" id="makeImage" class="inputfile" data-multiple-caption="{count} files selected">
                    <label for="makeImage" class="tx-white bg-info">
                      <i class="icon ion-ios-upload-outline tx-24"></i>
                      <span>Choose a file...</span>
                    </label>
                  </div>
                  <br>
                  <div class="progress mg-b-10 ht-10" id="myprogress-container" >
                    <div class="progress-bar myprogress" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
             </div>
            <div class="col-md-9">
                 <div class="table-wrapper">
                     <table class="table display responsive ">
                      
                      <tbody>
                        <tr>
                          <td style="width:15%;background: #d5d3d3;">Make Name</td>
                          <td style="width:35%">{{$data->make_name}}</td>
                          <td style="width:15%;background: #d5d3d3;">Modal Name </td>
                          <td style="width:35%">{{$data->modal_name}}</td>
                        </tr>
                        <tr>
                          <td style="width:15%;background: #d5d3d3;">Variant</td>
                          <td style="width:35%">{{$data->variant}}</td>
                          <td style="width:15%;background: #d5d3d3;">Body Type</td>
                          <td style="width:35%">{{$data->body_type}}</td>
                        </tr>
                        
                        <tr>
                           <td style="width:15%;background: #d5d3d3;">Digit Code</td>
                          <td style="width:35%">{{$data->digit_code}}</td>
                          <td style="width:15%;background: #d5d3d3;">FGI Code</td>
                          <td style="width:35%">{{$data->fgi_code}}</td>
                        </tr>
                        
                        <tr>
                           <td style="width:15%;background: #d5d3d3;">Variant</td>
                          <td style="width:35%">{{$data->variant}}</td>
                          <td style="width:15%;background: #d5d3d3;">Body Type</td>
                          <td style="width:35%">{{$data->body_type}}</td>
                        </tr>
                        
                        <tr>
                          <td style="width:15%;background: #d5d3d3;">Seating</td>
                          <td style="width:35%">{{$data->seating_capacity}}</td>
                          <td style="width:15%;background: #d5d3d3;">Power</td>
                          <td style="width:35%">{{$data->power}}</td>
                        </tr>
                        
                        <tr>
                          <td style="width:15%;background: #d5d3d3;">Cubic Capacity</td>
                          <td style="width:35%">{{$data->cubic_capacity}}</td>
                          <td style="width:15%;background: #d5d3d3;">Gross Weight</td>
                          <td style="width:35%">{{$data->grosss_weight}}</td>
                        </tr>
                       
                        <tr>
                          <td style="width:15%;background: #d5d3d3;">Fule</td>
                          <td style="width:35%">{{$data->fuel_type}}</td>
                          <td style="width:15%;background: #d5d3d3;">Wheels</td>
                          <td style="width:35%">{{$data->wheels}}</td>
                        </tr>
                        
                        <tr>
                          <td style="width:15%;background: #d5d3d3;">Abs</td>
                          <td style="width:35%">{{$data->abs}}</td>
                          <td style="width:15%;background: #d5d3d3;">Price Year</td>
                          <td style="width:35%">{{$data->price_year}}</td>
                        </tr>
                        <tr>
                          <td style="width:15%;background: #d5d3d3;">Vehicle Type</td>
                          <td style="width:35%">{{$data->vehicle_type}}</td>
                          <td style="width:15%;background: #d5d3d3;">Length</td>
                          <td style="width:35%">{{$data->_length}}</td>
                        </tr>
                        
                        
                      </tbody>
                    </table>
                 </div>
            </div>
        </div>
        
         
     </div><!-- card-body -->
 </div>
 
 @endsection