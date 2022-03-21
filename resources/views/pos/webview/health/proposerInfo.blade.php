@extends('webview.layouts.app')
  @section('content')
    
        <div class="container">
            <!-- page content here -->
            <div class="row" style="text-align: center;margin-top: 15px;padding: 30px;" >
                <p class="lead" style="font-weight: 500;text-align: center;">Select members you want to insure?</p>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12">
                     <div class="th-border">
                        <label class="control control--checkbox">You
                          <input type="checkbox" name="f-members-self" value="self" class="f-members" checked="checked">
                          <div class="control__indicator"></div>
                        </label>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12">
                     <div class="th-border self-rel"><label class="control control--checkbox">Wife<input type="checkbox" name="f-members-wife" value="wife" class="f-members" checked="checked"><div class="control__indicator"></div></label></div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12">
                     <div class="th-border">
                        <label class="control control--checkbox">Father
                          <input type="checkbox" name="f-members-father" value="father" class="f-members" checked="checked">
                          <div class="control__indicator"></div>
                        </label>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12">
                     <div class="th-border">
                        <label class="control control--checkbox">Mother
                          <input type="checkbox" name="f-members-mother" value="mother" class="f-members" checked="checked">
                          <div class="control__indicator"></div>
                        </label>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="th-border">
                       <label class="control control--checkbox">Daughter
                          <input type="checkbox" name="f-members-daughter" value="daughter" class="f-members" checked="checked">
                          <div class="control__indicator"></div>
                        </label>
                        <ul class="act-count count-daughter" style="display: block;">
                          <li><a href="#" class="daughter-counter _minus"><i class="icon-act material-icons">add</i></a></li>
                          <li><span class="count-value daughter-counter-val">1</span></li>
                          <li><a href="#" class="daughter-counter _plus"><i class="icon-act material-icons">remove</i></a></li>
                        </ul> 
                    </div>
                     
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="th-border">
                        <label class="control control--checkbox">Son
                          <input type="checkbox" name="f-members-son" value="son" class="f-members" checked="checked">
                          <div class="control__indicator"></div>
                        </label>
                        <ul class="act-count count-son" style="display: block;">
                          <li><a href="#" class="son-counter _minus"><i class="icon-act material-icons">add</i></a></li>
                          <li><span class="count-value son-counter-val">1</span></li>
                          <li><a href="#" class="son-counter _plus"><i class="icon-act material-icons">remove</i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="row mx-0 bottom-button-container">
            <div class="col">
                <a href="#" class="btn btn-default btn-lg btn-rounded shadow btn-block">Next</a>
            </div>
        </div>
            
        </div>

  @endsection