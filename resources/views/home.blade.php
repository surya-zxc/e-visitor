@extends('layouts.admin')
@section('content')
<h6 class="c-grey-900">
    Home
</h6>
<div class="mT-30"></div>
<h6 class="c-grey-900">
    Tracking Pengunjung
</h6>
<div class="mT-30"></div>
<!-- tabel track -->
<div class="table-responsive">
    <table class=" table table-bordered table-striped table-hover" >
    <tr><Td>afef</Td></tr>
    <tr><Td>afef</Td></tr>
    </table>
</div>
<!-- chart -->
<div class="mT-30"></div>
<h6 class="c-grey-900">
    Grafik Pengunjung 
</h6>
<div class="mT-30"></div>
<div class="container">
    <canvas id="myChart"    ></canvas>
</div>
<div class="mT-30"></div>

@endsection
@section('scripts')
@parent
<script>
            var ctx = document.getElementById("myChart");
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ["Januari","Feburari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"],
                    datasets: [{
                            label: 'Jumlah Pengunjung',
                            data: [10,20,30,40],
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