@extends('layouts.admin')
@section('content')
<h6 class="c-grey-900">
    {{ trans('cruds.history.title_singular') }}
</h6>
<div class="mT-30">
    <div class="table-responsive">
        <table class=" table table-bordered table-striped table-hover datatable datatable-User">
            <thead>
            <tr>
                <th width="10">

                </th>
                <th>
                    {{ trans('cruds.history.fields.id') }}
                </th>
                <th>
                    {{ trans('cruds.pengunjung.fields.nama') }}
                </th>
                <th>
                    {{ trans('cruds.kunjungan.fields.tanggal') }}
                </th>
                <th>
                    {{ trans('cruds.kunjungan.fields.keperluan') }}
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
                        @can('alat_access')
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.history.show', $user->id) }}">
                                {{ trans('global.view') }}
                            </a>
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
// @can('user_delete')
//   let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
//   let deleteButton = {
//     text: deleteButtonTrans,
//     url: "{{ route('admin.users.massDestroy') }}",
//     className: 'btn-danger',
//     action: function (e, dt, node, config) {
//       var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
//           return $(entry).data('entry-id')
//       });

//       if (ids.length === 0) {
//         alert('{{ trans('global.datatables.zero_selected') }}')

//         return
//       }

//       if (confirm('{{ trans('global.areYouSure') }}')) {
//         $.ajax({
//           headers: {'x-csrf-token': _token},
//           method: 'POST',
//           url: config.url,
//           data: { ids: ids, _method: 'DELETE' }})
//           .done(function () { location.reload() })
//       }
//     }
//   }
//   dtButtons.push(deleteButton)
// @endcan

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
