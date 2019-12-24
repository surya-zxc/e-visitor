@extends('layouts.admin')
@section('content')
<h6 class="c-grey-900">
    {{ trans('cruds.kunjungan.title_singular') }}
</h6>
<div class="mT-30">
    @can('alat_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.kunjungan.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.kunjungan.title_singular') }}
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
                    {{ trans('cruds.kunjungan.fields.id') }}
                </th>
                <th>
                    Nama Pengunjung
                </th>
                <th>
                    Kartu
                </th>
                <th>
                    {{ trans('cruds.kunjungan.fields.tanggal') }}
                </th>
                <th>
                    {{ trans('cruds.kunjungan.fields.keperluan') }}
                </th>
                <th>
                    {{ trans('cruds.kunjungan.fields.jaminan') }}
                </th>
                <th>
                    {{ trans('global.actions') }}
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($visitations as $key => $visitation)
                <tr data-entry-id="{{ $visitation->id }}">
                    <td>

                    </td>
                    <td>
                        {{ $visitation->id ?? '' }}
                    </td>
                    <td>
                        {{ $visitation->visitor->nama }}
                    </td>
                    <td>
                        {{ $visitation->card->card_uid }}
                    </td>
                    <td>
                        {{ $visitation->tanggal->toDateString() }}
                    </td>
                    <td>
                        {{ $visitation->keperluan }}
                    </td>
                    <td>
                        {{ $visitation->jaminan }}
                    </td>
                    <td>
                        @can('alat_edit')
                            <a class="btn btn-xs btn-info" href="{{ route('admin.kunjungan.edit', $visitation->id) }}">
                                {{ trans('global.edit') }}
                            </a>
                        @endcan

                        @can('alat_delete')
                            <form action="{{ route('admin.kunjungan.destroy', $visitation->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
