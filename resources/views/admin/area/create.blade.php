@extends('layouts.admin')
@section('content')
<h6 class="c-grey-900">
    {{ trans('global.add') }} {{ trans('cruds.area.title_singular') }}
</h6>
<div class="mT-30">
    <form action="{{ route("admin.area.store") }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group {{ $errors->has('nama') ? 'has-error' : '' }}">
            <label for="nama">{{ trans('cruds.area.fields.nama') }}*</label>
            <input type="text" id="nama" name="nama" class="form-control" value="{{ old('nama', isset($user) ? $user->name : '') }}" required>
            @if($errors->has('nama'))
                <em class="invalid-feedback">
                    {{ $errors->first('nama') }}
                </em>
            @endif
            <p class="helper-block">
                {{ trans('cruds.area.fields.nama_helper') }}
            </p>
        </div>
        <div>
            <a class="btn btn-danger" href="{{ url()->previous() }}">
                {{ trans('global.back') }}
            </a>
            <input class="btn btn-success" type="submit" value="{{ trans('global.save') }}">
        </div>
    </form>
</div>
@endsection
