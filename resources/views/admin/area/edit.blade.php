@extends('layouts.admin')
@section('content')
<h6 class="c-grey-900">
    {{ trans('global.edit') }} {{ trans('cruds.user.title_singular') }}
</h6>
<div class="mT-30">
    <form action="{{ route("admin.area.update", [$area->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group {{ $errors->has('nama') ? 'has-error' : '' }}">
            <label for="name">Nama</label>
            <input type="text" id="name" name="nama" class="form-control" value="{{ old('name', isset($area) ? $area->nama : '') }}" required>
            @if($errors->has('nama'))
                <em class="invalid-feedback">
                    {{ $errors->first('nama') }}
                </em>
            @endif
        </div>
        <div>
            <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
        </div>
    </form>
</div>
@endsection
