@extends('layouts.app')

@section('title')
{{ __('Profile') }}
@endsection

@section('content')

    @include('partials.validation_errors')


        <div class="content-header row">
        </div>
        <div class="content-body">
          <section class="invoice-list-wrapper">
              <div class="card">
                  <section id="advanced-search-datatable">
                  <div class="row">
                      <div class="col-12">
                          <div class="card">
                              <div class="card-header border-bottom">
                                  <h4 class="card-title">{{ __('Transfers table') }}</h4>
                                  @can('create_transfer')
                                    <a href="{{route('admin.inventory.transfers.create')}}" class="btn btn-primary btn-sm">
                                      <i class="fa fa-plus"></i> {{ __('Create') }}
                                    </a>
                                  @endcan
                                    <a href="{{route('admin.profile.index')}}" class="btn btn-primary btn-sm">
                                      <i class="fa fa-plus"></i> {{ __('HR') }}
                                    </a>
                              </div>
                              <hr class="my-0">
                              <form method="POST" action="{{route('admin.profile.update')}}" enctype="multipart/form-data" id="profile_form">
                                @csrf
                                <div class="card-body ml-4">
                                    <div class="col-lg-12">
                                        @include('admin.profile._form')
                                    </div>
                                </div>
                            </form>
                              <!--Search Form -->
                          </div>
                      </div>
                  </div>
              </section>
              </div>
          </section>
        </div>



@endsection
@section('scripts')
    <script src="{{url('js/admin/profile.js')}}"></script>
@endsection
