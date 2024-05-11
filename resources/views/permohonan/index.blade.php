@extends('layout.main_layout')
@php
    $tanggalSaatIni = new DateTime();
    $tanggalKemarin = $tanggalSaatIni->sub(new DateInterval('P1D'));
    $no = 1;

    $page = $_SERVER['PHP_SELF'];
    $sec = "10";
@endphp
@section('container')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Permohonan PACS</h1>
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
            <audio id="notificationSound">
                <source src="{{ asset('sounds/doorbell.wav') }}" type="audio/mpeg">
            </audio>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Permohonan PACS Belum di Kirim</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm table-hover" id="tabel-rawat-jalan">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Pemohon</th>
                                            <th>Hubungan Pasien</th>
                                            <th>Nama Pasien</th>
                                            <th>No. Rekam MEdis</th>
                                            <th>Tanggal Periksa</th>
                                            <th>Alamat Email</th>
                                            <th>No WA</th>
                                            <th>Tanggal Input</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($data)>0)
                                            @foreach($data as $data)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $data->namapemohon }}</td>
                                                <td>{{ $data->hubunganpasien }}</td>
                                                <td>{{ $data->namapemohon }}</td>
                                                <td>{{ $data->nomorrekammedis }}</td>
                                                <td>{{ $data->tanggalperiksa }}</td>
                                                <td>{{ $data->alamatemail }}</td>
                                                <td>{{ $data->nomorwhatsapp }}</td>
                                                <td>{{ $data->tanggalinput }}</td>
                                                <td><a class="btn btn-outline-primary" href="{{ route('permohonan.detail', ['id' => $data->idheader]) }}">Detail</a></td>
                                            </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="10" align="center">No Data</td>
                                            </tr>
                                        @endif
                                    </tbody>
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
    @include('permohonan.scripts');
@endsection
