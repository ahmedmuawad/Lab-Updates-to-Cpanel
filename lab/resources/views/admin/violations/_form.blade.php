<div class="row">
    <div class="col-lg-6">
      <div class="form-group">
        <label class="form-label" for="duration">{{__('Duration Minutes')}}</label>
        <input type="number" class="form-control" placeholder="{{__('Duration Minutes')}}" name="duration" id="duration" @if(isset($violation)) value="{{$violation->duration}}" @endif required>
      </div>
    </div>

    <div class="col-lg-6">
        <div class="row">
          <div class="col-lg-3">
            <div class="form-group">
              <label class="form-label" for="duration">{{__('Violations Hours')}}</label>
              <input type="number" class="form-control" placeholder="{{__('Violations Hours')}}" name="hours" id="" @if(isset($violation)) value="{{(int)($violation->violations_mins/60)}}" @endif>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="form-group">
              <label class="form-label" for="duration">{{__('Violations Minutes')}}</label>
              <input type="number" class="form-control" placeholder="{{__('Violations Minutes')}}" name="mins" id="" @if(isset($violation)) value="{{($violation->violations_mins%60)}}" @endif>
            </div>
          </div>
        </div>
        {{-- <div class="input-group form-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
              </span>
            </div>
            <input type="number" class="form-control" placeholder="{{__('Violations Hours')}}" name="violations_mins" id="" @if(isset($violation)) value="{{$violation->violations_mins}}" @endif required>
        </div> --}}
    </div>


</div>

