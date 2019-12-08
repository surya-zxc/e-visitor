@extends('layouts.admin')
@section('content')
<h6 class="c-grey-900">
    {{ trans('global.add') }} {{ trans('cruds.alat.title_singular') }}
</h6>
<div class="mT-30">
    <form action="{{ route("admin.alat.store") }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group {{ $errors->has('mac') ? 'has-error' : '' }}">
            <label for="mac">{{ trans('cruds.alat.fields.mac_address') }}*</label>
            <input type="text" id="mac" name="mac" class="form-control" value="{{ old('mac', isset($user) ? $user->name : '') }}" required>
            @if($errors->has('mac'))
                <em class="invalid-feedback">
                    {{ $errors->first('mac') }}
                </em>
            @endif
            <p class="helper-block">
                {{ trans('cruds.alat.fields.mac_address_helper') }}
            </p>
        </div>
        <div class="form-group {{ $errors->has('ip') ? 'has-error' : '' }}">
            <label for="ip">{{ trans('cruds.alat.fields.ip_address') }}*</label>
            <input type="text" id="ip" name="ip" class="form-control" value="{{ old('ip', isset($user) ? $user->email : '') }}" required>
            @if($errors->has('ip'))
                <em class="invalid-feedback">
                    {{ $errors->first('ip') }}
                </em>
            @endif
            <p class="helper-block">
                {{ trans('cruds.alat.fields.ip_address_helper') }}
            </p>
        </div>
        <div class="form-group {{ $errors->has('area') ? 'has-error' : '' }}">
            <label for="area">{{ trans('cruds.alat.fields.area_id') }}*</label>
            <select name="area[]" id="area" class="form-control select1" required>
                @foreach($roles as $id => $roles)
                    <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || isset($user) && $user->roles->contains($id)) ? 'selected' : '' }}>{{ $roles }}</option>
                @endforeach
            </select>
            @if($errors->has('area'))
                <em class="invalid-feedback">
                    {{ $errors->first('area') }}
                </em>
            @endif
            <p class="helper-block">
                {{ trans('cruds.alat.fields.area_id_helper') }}
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
