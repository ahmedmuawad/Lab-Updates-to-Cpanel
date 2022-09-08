<div class="modal fade" id="patient_modal" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('Create Patient') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('ajax.create_patient') }}" method="POST" id="create_patient">
                @csrf
                <div class="text-danger" id="patient_modal_error"></div>
                <div class="modal-body" id="create_patient_inputs">
                    <div class="row">
                    <div class="col-lg-4">
                            {{-- <div class="form-group"> --}}
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <i class="fas fa-user"></i>
                                            </span>
                                        </div>
                                        <select id="prefix" name="prefix" class="form-control" required>
                                <option  value="Mr">{{__('Mr')}}</option>
                                <option  value="Mrs">{{__('Mrs')}}</option>
                                <option  value="Dr_male">{{__('Dr_male')}}</option>
                                <option  value="Dr_female">{{__('Dr_female')}}</option>
                                <option  value="Eng_Male">{{__('Eng_Male')}}</option>
                                <option  value="Eng_Female">{{__('Eng_Female')}}</option>
                                <option  value="Mr_Counsellor">{{__('Mr_Counsellor')}}</option>
                                <option  value="Mrs_Counsellor">{{__('Mrs_Counsellor')}}</option>
                                <option  value="Prof_male">{{__('Prof_male')}}</option>
                                <option  value="Prof_Female">{{__('Prof_Female')}}</option>
                                <option  value="Captain">{{__('Captain')}}</option>
                                <option  value="child_male">{{__('child_male')}}</option>
                                <option  value="child_female">{{__('child_female')}}</option>
                            </select>
                                    </div>
                                </div>
                            {{-- </div> --}}
                        </div>
                   
                        <div class="col-lg-4">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fa fa-user"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="{{ __('Patient Name') }}"
                                        name="name" id="create_name" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <i class="fas fa-mars"></i>
                                            </span>
                                        </div>
                                        <select class="form-control" name="gender" placeholder="{{ __('Gender') }}"
                                            id="create_gender" required>
                                            <option value="" disabled selected>{{ __('Select Gender') }}</option>
                                            <option value="male">{{ __('Male') }}</option>
                                            <option value="female">{{ __('Female') }}</option>
                                            <option value="pregnant">{{__('Pregnant')}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                        
                        <div class="col-lg-4">
                            <div class="form-group">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <i class="fas fa-baby"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control datepicker"
                                            placeholder="{{ __('Date of birth') }}" name="dob" id="create_dob"
                                            required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                         <div class="col-lg-4">
                            <div class="row">
                                <div class="col-lg-6 col-sm-6 col-xs-6 col-md-6 pr-0">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <i class="fas fa-baby"></i>
                                            </span>
                                        </div>
                                        <input type="number" class="form-control" name="age" id="create_age"
                                            placeholder="{{ __('Age') }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-xs-6 col-md-6 pl-0">
                                    <div class="input-group mb-3">
                                        <select class="form-control" name="age_unit" id="create_age_unit" required>
                                            <option value="" disabled selected>{{ __('Select age unit') }}</option>
                                            <option value="years">{{ __('Years') }}</option>
                                            <option value="months">{{ __('Months') }}</option>
                                            <option value="days">{{ __('Days') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fas fa-phone-alt"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="{{ __('Phone number') }}"
                                        name="phone" id="create_phone">
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fas fa-phone-alt"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="{{ __('Phone number') }} 2"
                                        name="phone2" id="create_phone2">
                                </div>
                            </div>

                        </div>
                        
                        <div class="col-lg-4">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                    </div>
                                    <input type="email" class="form-control" placeholder="{{ __('Email Address') }}"
                                        name="email" id="create_email">
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-4">
                            <div class="form-group">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <i class="fas fa-map-marker-alt"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="{{ __('Address') }}"
                                            name="address" id="create_address">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-4">
                            <div class="form-group">
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1">
                                    <i class="fa fa-user"></i>
                                  </span>
                                </div>
                                <input type="number" class="form-control" placeholder="{{__('Hours of Fasting')}}" name="hours_fasting"
                                id="edit_hours_fasting">
                              </div>
                            </div>
                          </div>
                          
                          <div class="col-lg-4">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fas fa-file-contract"></i>
                                        </span>
                                    </div>
                                    <select name="contract_id" id="patient_contract_id" class="form-control">
                                        <option value="" selected disabled>{{ __('Select contract') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="create_avatar">
                                        <input type="hidden" id="create_patient_avatar_hidden" name="avatar">
                                        <label class="custom-file-label">{{ __('Choose avatar') }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                      





                        <div class="col-lg-4">
                            {{-- <div class="form-group"> --}}
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <i class="fas fa-globe"></i>
                                            </span>
                                        </div>
                                        <select class="form-control" name="country_id" id="create_country_id">
                                            <option value="" disabled selected>{{ __('Select nationality') }}</option>
                                        </select>
                                    </div>
                                </div>
                            {{-- </div> --}}
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fa fa-id-card"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="{{ __('National ID') }}"
                                        name="national_id" id="create_national_id">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fa fa-passport"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="{{ __('Passport no') }}"
                                        name="passport_no" id="create_passport_no">
                                </div>
                            </div>
                        </div>

                


                        
                        <div class="col-lg-4  d-none create_date_pms">
                            <div class="form-group">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <i class="fas fa-mars"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control datepicker" placeholder="{{__('Date of PMS')}}" name="date_pms"
                                        id="create_date_pms">
                                    </div>
                                </div>
                            </div>

                        </div>


                        

                       



                        {{-- Start Questions --}}
                        {{-- Fluid Patient --}}
                         <div class="col-lg-2">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" name="fluid_patient" id="fluid_patient" type="checkbox"
                                             id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ __('Hemophilia') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Diabetic --}}
                        <div class="col-lg-2">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" name="diabetic" id="diabetic" type="checkbox"
                                             id="flexCheckDefault1">
                                        <label class="form-check-label" for="flexCheckDefault1">
                                            {{ __('Diabetic') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Liver Patient --}}
                        <div class="col-lg-2">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" name="liver_patient" id="liver_patient" type="checkbox"
                                            id="flexCheckDefault2">
                                        <label class="form-check-label" for="flexCheckDefault2">
                                            {{ __('Liver Patient') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                                            {{-- gland --}}
                    <div class="col-lg-2">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="form-check">
                                    <input class="form-check-input check_ask" name="gland" type="checkbox" value="" id="flexCheckDefault3">
                                    <label class="form-check-label" for="flexCheckDefault3">
                                    {{__('gland')}}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- tumors --}}
                    <div class="col-lg-2">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="form-check">
                                    <input class="form-check-input check_ask" name="tumors" type="checkbox" value="" id="flexCheckDefault4">
                                    <label class="form-check-label" for="flexCheckDefault4">
                                    {{__('tumors')}}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- antibiotic --}}
                    <div class="col-lg-2">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="form-check">
                                    <input class="form-check-input check_ask" name="antibiotic" type="checkbox" value="" id="flexCheckDefault5">
                                    <label class="form-check-label" for="flexCheckDefault5">
                                    {{__('antibiotic')}}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- iron --}}
                    <div class="col-lg-2">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="form-check">
                                    <input class="form-check-input check_ask" name="iron" type="checkbox" value="" id="flexCheckDefault6">
                                    <label class="form-check-label" for="flexCheckDefault6">
                                    {{__('iron')}}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- cortisone --}}
                    <div class="col-lg-2">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="form-check">
                                    <input class="form-check-input check_ask" name="cortisone"  type="checkbox" value="" id="flexCheckDefault7">
                                    <label class="form-check-label" for="flexCheckDefault7">
                                    {{__('cortisone')}}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                        {{-- Pregnant --}}
                        {{-- <div class="col-lg-2">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input"  name="pregnant" id="pregnant" type="checkbox"
                                             id="flexCheckDefault3">
                                        <label class="form-check-label" for="flexCheckDefault3">
                                            {{ __('Pregnant') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        {{-- Other --}}
                        <div class="col-lg-4">
                            <div class="form-group">
                                <div class="form-floating">
                                    <textarea class="form-control" name="answer_other" placeholder="{{ __('Other') }}" id="floatingTextarea"
                                        style="height: 50px"></textarea>
                                </div>
                            </div>
                        </div>
                        {{-- End   Questions --}}
                    </div> 
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
</div>
