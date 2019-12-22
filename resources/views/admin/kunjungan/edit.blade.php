@extends('layouts.admin')
@section('content')
<h6 class="c-grey-900">
    {{ trans('global.edit') }} {{ trans('cruds.kunjungan.title_singular') }}
</h6>
<div class="mT-30">
        <div id="smartwizard" class="sw-main sw-theme-arrows">
          <ul class="nav nav-tabs step-anchor">
            <li class="nav-item active"><a href="{{ route("admin.kunjungan.edit", 1) }}" class="nav-link">Step 1<br><small>Data Pengunjung</small></a></li>
            <li class="nav-item"><a href="{{ route("admin.kunjungan.editArea",1) }}" class="nav-link">Step 2<br><small>Akses Area</small></a></li>
          </ul>
        </div>
        <hr class="mT-10"/>
        @csrf
        @method('PUT')
        <div class="form-group {{ $errors->has('visitor') ? 'has-error' : '' }}">
            <label for="visitor">{{ trans('cruds.kunjungan.fields.visitor_id') }}*</label>
            <select name="visitor[]" id="visitor" class="form-control select1" required>
                
            </select>
            @if($errors->has('visitor'))
                <em class="invalid-feedback">
                    {{ $errors->first('visitor') }}
                </em>
            @endif
            <p class="helper-block">
                {{ trans('cruds.kunjungan.fields.visitor_id_helper') }}
            </p>
        </div>
        <div class="form-group {{ $errors->has('user') ? 'has-error' : '' }}">
            <label for="user">{{ trans('cruds.kunjungan.fields.user_id') }}*</label>
            <select name="user[]" id="user" class="form-control select1" required>
                
            </select>
            @if($errors->has('user'))
                <em class="invalid-feedback">
                    {{ $errors->first('user') }}
                </em>
            @endif
            <p class="helper-block">
                {{ trans('cruds.kunjungan.fields.user_id_helper') }}
            </p>
        </div>
        <div class="form-group {{ $errors->has('card') ? 'has-error' : '' }}">
            <label for="card">{{ trans('cruds.kunjungan.fields.card_id') }}*</label>
            <select name="card[]" id="card" class="form-control select1" required>
                
            </select>
            @if($errors->has('card'))
                <em class="invalid-feedback">
                    {{ $errors->first('card') }}
                </em>
            @endif
            <p class="helper-block">
                {{ trans('cruds.kunjungan.fields.card_id_helper') }}
            </p>
        </div>
        <div class="form-group {{ $errors->has('tanggal') ? 'has-error' : '' }}">
            <label for="tanggal">{{ trans('cruds.kunjungan.fields.tanggal') }}*</label>
            <input type="date" id="tanggal" name="tanggal" class="form-control" value="{{ old('tanggal', isset($user) ? $user->email : '') }}" required>
            @if($errors->has('tanggal'))
                <em class="invalid-feedback">
                    {{ $errors->first('tanggal') }}
                </em>
            @endif
            <p class="helper-block">
                {{ trans('cruds.kunjungan.fields.tanggal_helper') }}
            </p>
        </div>
        <div class="form-group {{ $errors->has('keperluan') ? 'has-error' : '' }}">
            <label for="keperluan">{{ trans('cruds.kunjungan.fields.keperluan') }}*</label>
            <input type="text" id="keperluan" name="keperluan" class="form-control" value="{{ old('keperluan', isset($user) ? $user->email : '') }}" required>
            @if($errors->has('keperluan'))
                <em class="invalid-feedback">
                    {{ $errors->first('keperluan') }}
                </em>
            @endif
            <p class="helper-block">
                {{ trans('cruds.kunjungan.fields.keperluan_helper') }}
            </p>
        </div>
        <div class="form-group {{ $errors->has('jaminan') ? 'has-error' : '' }}">
            <label for="jaminan">{{ trans('cruds.kunjungan.fields.jaminan') }}*</label>
            <select name="jaminan[]" id="jaminan" class="form-control select1" required>
                
            </select>
            @if($errors->has('jaminan'))
                <em class="invalid-feedback">
                    {{ $errors->first('jaminan') }}
                </em>
            @endif
            <p class="helper-block">
                {{ trans('cruds.kunjungan.fields.jaminan_helper') }}
            </p>
        </div>
        <div class="form-group {{ $errors->has('jaminan_lain') ? 'has-error' : '' }}">
            <label for="jaminan_lain">{{ trans('cruds.kunjungan.fields.jaminan_lainnya') }}*</label>
            <input type="text" id="jaminan_lain" name="jaminan_lain" class="form-control" value="{{ old('jaminan_lain', isset($user) ? $user->email : '') }}" required>
            @if($errors->has('jaminan_lain'))
                <em class="invalid-feedback">
                    {{ $errors->first('jaminan_lain') }}
                </em>
            @endif
            <p class="helper-block">
                {{ trans('cruds.kunjungan.fields.jaminan_lainnya_helper') }}
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