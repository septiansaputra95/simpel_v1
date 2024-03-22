@extends('layout.main_layout')
@php
    $tanggalSaatIni = new DateTime();
    $bulan = $tanggalSaatIni->format('m'); // Mendapatkan bulan dalam format dua digit (01-12)
    $tahun = $tanggalSaatIni->format('Y'); // Mendapatkan tahun dalam format empat digit (misalnya 2024)
@endphp
@section('container')
    
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Suhu Ruangan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item">Layout</li>
                        <li class="breadcrumb-item">Top Navigation</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Suhu Ruangan</h3>
                        </div>
                        <div class="card-body">
                            <br><br>
                            <div class="row">
                                <div class="col-lg-3">
                                    <label for="">Unit: </label>
                                    <select name="unit_ruangan" id="unit-ruangan" class="input-sm col-xs-8 col-sm-8">
                                        @foreach ($masterUnitData as $unit)
                                        <option value="{{ $unit->unit_id }}">{{ $unit->unit_nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <label for="">Bulan:  </label>
                                    <select class="input-sm col-xs-8 col-sm-8" id="bulanSelect">
                                        <option value="1">Januari</option>
                                        <option value="2">Februari</option>
                                        <option value="3">Maret</option>
                                        <option value="4">April</option>
                                        <option value="5">Mei</option>
                                        <option value="6">Juni</option>
                                        <option value="7">Juli</option>
                                        <option value="8">Agustus</option>
                                        <option value="9">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <label for="">Tahun:  </label>
                                    <select class="input-sm col-xs-8 col-sm-8" id="tahunSelect">
                                        <option value="2024">2024</option>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <button class="btn btn-outline-danger btn-sm ">Process</button>
                                    <button class="btn btn-outline-success btn-sm ">Export Excel</button>
                                </div>
                            </div>
                            
                            <br>
                            <canvas id="myChart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    @include('suhuruangan.scripts');
    <!-- /.content -->
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/js/bootstrap.bundle.min.js"></script>

    
    
    <script>
        // Mendapatkan bulan saat ini dari PHP
        var bulan = <?php echo $bulan; ?>;
        var tahun = <?php echo $tahun; ?>;

        $("#bulanSelect").val(bulan);
        $("#tahunSelect").val(tahun);
        
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['07.00', '14.00', '21.00','07.00', '14.00', '21.00'],
                datasets: [{
                    label: 'Suhu Ruangan',
                    data: [25.5, 22.5, 21.3, 22.4, 23.5, 23.0],
                    backgroundColor: 'rgba(0, 162, 39, 0.33)',
                    borderColor: 'rgba(0, 162, 39, 0.8)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });


        var unitValue = $('#unit-ruangan').val();
        var bulanValue = $('#bulanSelect').val();
        var tahunValue = $('#tahunSelect').val();
        console.log(unitValue);
        console.log(bulanValue);
        console.log(tahunValue);

        // Lakukan AJAX request untuk mengambil data dari server
    $.ajax({
        url: '/suhuruangan/chart',
        method: 'GET',
        data: {
            unit: unitValue,
            bulan: bulanValue,
            tahun: tahunValue
        },
        success: function(response) {
            // Setelah menerima data dari server, gunakan data tersebut untuk memperbarui chart line
            var dataChart = {
                labels: response.labels,
                datasets: [{
                    label: 'Suhu Ruangan',
                    data: response.data,
                    backgroundColor: 'rgba(0, 162, 39, 0.33)',
                    borderColor: 'rgba(0, 162, 39, 0.8)',
                    borderWidth: 1
                }]
            };

            // Update chart dengan data yang baru
            myChart.data = dataChart;
            myChart.update();
        },
        error: function(xhr, status, error) {
            console.error(error); // Tampilkan pesan error jika terjadi kesalahan
        }
    });
    </script>
@endsection
