@extends('layouts.app')

@section('title')
    {{__('Edit Government')}}
@endsection

@section('content')
    <div class="app-content content ">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{__('Edit Government')}}</h3>
            </div>
            <form method="POST" action="{{route('admin.governments.update', $government->id)}}">
                <!-- /.card-header -->
                <div class="card-body">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label class="form-label" for="name">{{__('Name')}}</label>
                        <input class="form-control" id="name" name="name" placeholder="{{__('Name')}}" required
                               type="text" value="{{ $government->name }}">
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
