@extends('layouts.admin')
@section('content')
<h6 class="c-grey-900">
    Tambah Area
</h6>
<div class="mT-30">
    <form action="{{ route("admin.area.store") }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label for="name">Nama</label>
            <input type="text" id="name" name="nama" class="form-control" value="{{ old('nama', isset($area) ? $area->nama : '') }}" required>
            @if($errors->has('nama'))
                <em class="invalid-feedback">
                    {{ $errors->first('nama') }}
                </em>
            @endif
            <p class="helper-block">
                {{ trans('cruds.user.fields.name_helper') }}
            </p>
        </div>
        <div>
            <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
        </div>
    </form>
</div>
@endsection
