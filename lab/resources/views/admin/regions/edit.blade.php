@extends('layouts.app')

@section('title')
    {{__('Edit Region')}}
@endsection

@section('content')
     
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{__('Edit Region')}}</h3>
            </div>
            <form method="POST" action="{{route('admin.regions.update', $region->id)}}">
                <!-- /.card-header -->
                <div class="card-body">
                    @csrf
                    <div class="form-group">
                        <label class="form-label" for="name">{{__('Name')}}</label>
                        <input class="form-control" id="name" name="name" placeholder="{{__('Name')}}" required
                               type="text" value="{{ $region->name }}">
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary save_contract">
                        <i class="fa fa-check"></i> {{__('Save')}}
                    </button>
                </div>
            </form>

        </div>
@endsection
