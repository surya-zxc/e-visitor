@extends('layouts.admin')
@section('content')
<h6 class="c-grey-900">
    {{ trans('cruds.pengunjung.title_singular') }}
</h6>
<div class="mT-30">
    @can('alat_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.pengunjung.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.pengunjung.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="table-responsive">
        <table class=" table table-bordered table-striped table-hover datatable datatable-User">
            <thead>
            <tr>
                <th width="10">

                </th>
                <th>
                    {{ trans('cruds.pengunjung.fields.id') }}
                </th>
                <th>
                    {{ trans('cruds.pengunjung.fields.no_identitas') }}
                </th>
                <th>
                    {{ trans('cruds.pengunjung.fields.jenis_identitas') }}
                </th>
                <th>
                    {{ trans('cruds.pengunjung.fields.jenis_identitas_lain') }}
                </th>
                <th>
                    {{ trans('cruds.pengunjung.fields.nama') }}
                </th>
                <th>
                    {{ trans('cruds.pengunjung.fields.jenis_kelamin') }}
                </th>
                <th>
                    {{ trans('cruds.pengunjung.fields.no_telp') }}
                </th>
                <th>
                    {{ trans('cruds.pengunjung.fields.pekerjaan') }}
                </th>
                <th>
                    {{ trans('global.actions') }}
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $key => $user)
                <tr data-entry-id="{{ $user->id }}">
                    <td>

                    </td>
                    <td>
                        {{ $user->id ?? '' }}
                    </td>
                    <td>
                        {{ $user->name ?? '' }}
                    </td>
                    <td>
                        {{ $user->email ?? '' }}
                    </td>
                    <td>
                        @foreach($user->roles as $key => $item)
                            <span class="badge badge-info">{{ $item->title }}</span>
                        @endforeach
                    </td>
                    <td>
                        {{ $user->id ?? '' }}
                    </td>
                    <td>
                        {{ $user->name ?? '' }}
                    </td>
                    <td>
                        {{ $user->email ?? '' }}
                    </td>
                    <td>
                        @foreach($user->roles as $key => $item)
                            <span class="badge badge-info">{{ $item->title }}</span>
                        @endforeach
                    </td>
                    <td>
                        @can('alat_edit')
                            <a class="btn btn-xs btn-info" href="{{ route('admin.pengunjung.edit', $user->id) }}">
                                {{ trans('global.edit') }}
                            </a>
                        @endcan

                        @can('alat_delete')
                            <form action="{{ route('admin.pengunjung.destroy', $user->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                            </form>
                        @endcan

                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('user_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.users.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-User:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection
