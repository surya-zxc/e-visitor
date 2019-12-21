@extends('layouts.admin')
@section('content')
<h6 class="c-grey-900">
    {{ trans('global.add') }} {{ trans('cruds.kunjungan.title_singular') }}
</h6>
<div class="mT-30">
    <div id="smartwizard" class="sw-main sw-theme-arrows">
      <ul class="nav nav-tabs step-anchor">
        <li class="nav-item"><a href="{{ route("admin.kunjungan.create") }}" class="nav-link">Step 1<br><small>Data Pengunjung</small></a></li>
        <li class="nav-item active"><a href="{{ route("admin.kunjungan.area",1) }}" class="nav-link">Step 2<br><small>Akses Area</small></a></li>
      </ul>
    </div>
    <hr class="mT-10"/>
    <form action="{{ route("admin.kunjungan.store") }}" method="POST" enctype="multipart/form-data">
        @csrf
      <p>
        kolom buat milih area yang boleh dimasuki (select2 multiple, kek yg di permissions user)
      </p>
        <div>
            <a class="btn btn-danger" href="{{ url()->previous() }}">
                {{ trans('global.back') }}
            </a>
            <input class="btn btn-success" type="submit" value="{{ trans('global.save') }}">
        </div>
    </form>
</div>
@endsection
