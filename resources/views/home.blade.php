@extends('layouts.admin')
@section('content')
<h6 class="c-grey-900">
    Home
</h6>
</div>
</div>
<div class="masonry-item col-md-12">
    <div class="bgc-white p-20 bd">
        <h6 class="c-grey-900">
            Tracking Pengunjung
        </h6>
        Tanggal : {{ date('d/m/Y')}}
        <div class="mT-30"></div>
        <!-- tabel track -->
        <div class="table-responsive" id="tabelTrack">
            <table class="datatable datatable-User" >
                <thead>
                    <tr>
                        <th width="10">
                        </th>
                        <th>
                            <h1>Tidak ada Pengunjung</h1>
                        </th>
                    </tr>
                </thead>
            </table>
            <div class="mT-30"></div>
        </div>
        <!-- chart -->
        <div class="mT-30"></div>

    </div>
</div>
<div class="masonry-item col-md-12">
    <div class="bgc-white p-20 bd">
        <h6 class="c-grey-900">
            Grafik Pengunjung
        </h6>
        Tahun : {{ date('Y')}}
        <div class="mT-30"></div>
        <div class="container">
            <canvas id="myChart"></canvas>
        </div>
        <div class="mT-30"></div>

        @endsection
        @section('scripts')
        @parent
        <script>
            $(function() {
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
                    order: [
                        [1, 'desc']
                    ],
                    pageLength: 100,
                });
                $('.datatable-User:not(.ajaxTable)').DataTable({
                    buttons: dtButtons
                })
                $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                    $($.fn.dataTable.tables(true)).DataTable()
                        .columns.adjust();
                });
            })
        </script>
        <script>
            var ctx = document.getElementById("myChart");
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ["Januari", "Feburari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
                    datasets: [{
                        label: 'Jumlah Pengunjung',
                        data: [<?php echo $januari ?>, <?php echo $februari ?>, <?php echo $maret ?>, <?php echo $april ?>,<?php echo $mei ?>,<?php echo $juni ?>,<?php echo $juli ?>,<?php echo $agustus ?>,<?php echo $september ?>,<?php echo $oktober ?>,<?php echo $november ?>,<?php echo $desember ?>],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        </script>
        @endsection