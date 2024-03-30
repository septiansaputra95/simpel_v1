@extends('layout.main_layout')
@php
    $tanggalSaatIni = new DateTime();
    $tanggalKemarin = $tanggalSaatIni->sub(new DateInterval('P1D'));
@endphp
@section('container')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Antrian Online</h1>
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Antrol</h3>
                        </div>
                        <div class="card-body">
                            <br><br>
                            <label for="">Tanggal Check In: </label>
                            <input type="date" id="tanggal-registrasi" name="tanggal_registrasi"
                                value="{{ $tanggalKemarin->format('Y-m-d') }}" class="input-sm col-xs-3 col-sm-3" />
                            <br>
                            <div class="table-responsive">
                                <table class="table table-sm table-hover" id="tabel-rawat-jalan">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Booking</th>
                                            <th>MRN</th>
                                            <th>Nama Pasien</th>
                                            <th>Dokter</th>
                                            <th>Status</th>
                                            <th>No Kartu</th>
                                            <th>Task 1</th>
                                            <th>Task 2</th>
                                            <th>Task 3</th>
                                            <th>Task 4</th>
                                            <th>Task 5</th>
                                            <th>Task 6</th>
                                            <th>Task 7</th>
                                            <th>No SEP</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript untuk menampilkan modal -->
    @include('antrol.scripts');
@endsection
