@extends('layouts.admin')
@section('content')
<h6 class="c-grey-900">
    {{ trans('global.show') }} {{ trans('cruds.tracking.title') }}
</h6>
<div class="mT-30">
    <div class="mb-2">
        <table class="table table-bordered table-striped">
            <tbody>
            <tr>
                <th>
                    {{ trans('cruds.tracking.fields.id') }}
                </th>
                <td>
                    {{ $user->id }} id
                </td>
            </tr>
            <tr>
                <th>
                    {{ trans('cruds.tracking.fields.visitation_id') }}
                </th>
                <td>
                    {{ $user->name }} kunjungan
                </td>
            </tr>
            <tr>
                <th>
                    {{ trans('cruds.tracking.fields.area_id') }}
                </th>
                <td>
                    {{ $user->email }} area
                </td>
            </tr>
            <tr>
                <th>
                    {{ trans('cruds.tracking.fields.device_id') }}
                </th>
                <td>
                    @foreach($user->roles as $id => $roles)
                        <span class="label label-info label-many">{{ $roles->title }}</span>
                    @endforeach
                    device
                </td>
            </tr>
            <tr>
                <th>
                    {{ trans('cruds.tracking.fields.timestamp') }}
                </th>
                <td>
                    {{ $user->email_verified_at }} time
                </td>
            </tr>
            </tbody>
        </table>
        <a style="margin-top:20px;" class="btn btn-primary" href="{{ url()->previous() }}">
            {{ trans('global.back_to_list') }}
        </a>
    </div>
</div>
@endsection
