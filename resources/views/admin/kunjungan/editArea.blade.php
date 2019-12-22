@extends('layouts.admin')
@section('content')
<h6 class="c-grey-900">
    {{ trans('global.edit') }} {{ trans('cruds.kunjungan.title_singular') }}
</h6>
<div class="mT-30">
        <div id="smartwizard" class="sw-main sw-theme-arrows">
          <ul class="nav nav-tabs step-anchor">
            <li class="nav-item"><a href="{{ route("admin.kunjungan.edit", 1) }}" class="nav-link">Step 1<br><small>Data Pengunjung</small></a></li>
            <li class="nav-item active"><a href="{{ route("admin.kunjungan.editArea",1) }}" class="nav-link">Step 2<br><small>Akses Area</small></a></li>
          </ul>
        </div>
        <hr class="mT-10"/>
        @csrf
        @method('PUT')
        <div class="form-group {{ $errors->has('area') ? 'has-error' : '' }}">
            <label for="area">{{ trans('cruds.area.fields.nama') }}*</label>
            <select name="area[]" id="area" class="form-control select2" multiple="multiple" required>
                @foreach($roles as $id => $roles)
                    <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || isset($user) && $user->roles->contains($id)) ? 'selected' : '' }}>{{ $roles }}</option>
                @endforeach
            </select>
            <label for="area" style="margin-top: 1%">
                <span class="btn btn-info btn-xs select-all">{{ trans('global.select_all') }}</span>
                <span class="btn btn-info btn-xs deselect-all">{{ trans('global.deselect_all') }}</span>
            </label>
            @if($errors->has('area'))
                <em class="invalid-feedback">
                    {{ $errors->first('area') }}
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
</div>
@endsection