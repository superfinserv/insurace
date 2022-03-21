
   <div class="row">
        <div class="col-md-12">
            <h5>Q.{{$count}} {{$question}}</h5>
        </div>
        <div class="col-md-12 ">
            <ul class="list-group">
                @foreach($answers as $ans)
                <li class="list-group-item rounded-top-0">
                  <label class="rdiobox">
                    <input type="radio" name="test-answer" id="test-answer-{{$ans->id}}" value="{{$ans->id}}"><span>{{$ans->text}}</span>
                  </label>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9"></div>
        <div class="col-md-3">
             <input type="hidden" value="{{$count}}" name="test-que-count" id="test-que-count">
             <input type="hidden" value="{{$queId}}" name="test-que-id" id="test-que-id">
             @if($count<20)
              <button class="btn btn-dark btn-block btn-sm active mg-t-10" id="btn-next-question">Next &nbsp;&nbsp;<i class="fa fa-chevron-right"></i></button>
            @else
            <button class="btn btn-dark btn-success btn-sm active mg-t-10" id="btn-submit-test"><i class="fa fa-tasks"></i>&nbsp;&nbsp;Submit </button>
            @endif
        </div>
    </div>