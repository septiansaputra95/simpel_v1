@extends('layout.main_layout')
@php
    $tanggalSaatIni = new DateTime();
    $tanggalKemarin = $tanggalSaatIni->sub(new DateInterval('P1D'));
    $no = 1;

    foreach ($data as $key) {
        $idheader           = $key->idheader;
        $namapemohon        = $key->namapemohon;
        $hubunganpasien     = $key->hubunganpasien;
        $namapasien         = $key->namapasien;
        $nomorrekammedis    = $key->nomorrekammedis;
        $tanggalperiksa     = $key->tanggalperiksa;
        $alamatemail        = $key->alamatemail;
        $nomorwhatsapp      = $key->nomorwhatsapp;
        $tanggalinput       = $key->tanggalinput;
        $proseskirim        = $key->proseskirim;
    }

    if ($proseskirim == 0 ) {
        $proseskirim = 'Belum Dikirim';
    } else {
        $proseskirim = 'Sudah Dikirim';
    }
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
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Detail Permohonan PACS</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="row">
                                    <div class="col-md-2">
                                        <h5 class="h5">Id Header</h5>
                                        <h5 class="h5">Nama Pemohon</h5>
                                        <h5 class="h5">Hubungan Pasien</h5>
                                        <h5 class="h5">Nomor Rekam Medis</h5>
                                        <h5 class="h5">Nama Pasien</h5>
                                    </div>
                                    <div class="col-md-0">
                                        <h5 class="h5">:</h5>
                                        <h5 class="h5">:</h5>
                                        <h5 class="h5">:</h5>
                                        <h5 class="h5">:</h5>
                                        <h5 class="h5">:</h5>
                                    </div>
                                    <div class="col-md-2">
                                        <h5 class="h5">{{ $idheader }}</h5>
                                        <h5 class="h5">{{ $namapemohon }}</h5>
                                        <h5 class="h5">{{ $hubunganpasien }}</h5>
                                        <h5 class="h5">{{ $nomorrekammedis }}</h5>
                                        <h5 class="h5">{{ $namapasien }}</h5>
                                    </div>
                                    <div class="col-md-1">

                                    </div>
                                    <div class="col-md-2">
                                        <h5 class="h5">Tanggal Periksa</h5>
                                        <h5 class="h5">Alamat Email</h5>
                                        <h5 class="h5">Nomor Whatsapp</h5>
                                        <h5 class="h5">Tanggal Input</h5>
                                        <h5 class="h5">Sudah Dikirim</h5>
                                    </div>
                                    <div class="col-md-0">
                                        <h5 class="h5">:</h5>
                                        <h5 class="h5">:</h5>
                                        <h5 class="h5">:</h5>
                                        <h5 class="h5">:</h5>
                                        <h5 class="h5">:</h5>
                                    </div>
                                    <div class="col-md-2">
                                        <h5 class="h5">{{ $tanggalperiksa }}</h5>
                                        <h5 class="h5">{{ $alamatemail }}</h5>
                                        <h5 class="h5">{{ $nomorwhatsapp }}</h5>
                                        <h5 class="h5">{{ $tanggalinput }}</h5>
                                        <h5 class="h5">{{ $proseskirim }}</h5>
                                    </div>
                                </div>
                                <br>
                                <table class="table table-sm table-hover" id="tabel-rawat-jalan">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Id Detail</th>
                                            <th>Permohonan Data</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $data)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data->iddetail }}</td>
                                            <td>{{ $data->permohonandata }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                
                            </div>
                            <br>
                            <a href="{{ route("permohonan.index") }}" class="btn btn-outline-primary">Kembali</a>
                            <a href="{{ route('permohonan.kirim', ['id' => $idheader]) }}" class="btn btn-outline-success">Proses Kirim</a>
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
@endsection
