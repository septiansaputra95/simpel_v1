@extends('layout.main_layout')
@php
    $tanggalSaatIni = new DateTime();
    $tanggal_dari    = (clone $tanggalSaatIni)->sub(new DateInterval('P8D'));
    $tanggal_sampai = (clone $tanggalSaatIni)->sub(new DateInterval('P1D'));
@endphp
@section('container')
     <!-- Content Header (Page header) -->
     <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Farmasi Konsumsi</h1>
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
                    <h3 class="card-title">Farmasi</h3>
                </div>
              <div class="card-body">
                {{-- <button class="btn btn-outline-primary" id="tambah_data">+ Tambah Data</button> --}}
                <label for="">Di Tunggu Jam 08.15, Data Akan diupdate oleh Petugas Snake Man</label>
                <br>
                {{-- <label for="">Tanggal:</label> 
                <input type="date" id="tanggal-dari" name="tanggal_registrasi"
                value="{{ $tanggal_dari->format('Y-m-d') }}" class="input-sm col-xs-2 col-sm-2" />

                <label for=""> s/d: </label>
                <input type="date" id="tanggal-sampai" name="tanggal_registrasi"
                value="{{ $tanggal_sampai->format('Y-m-d') }}" class="input-sm col-xs-2 col-sm-2" />

                &nbsp;&nbsp;<button class="btn btn-sm btn-info">Reload</button> --}}
                <br><br>
                <meta name="csrf-token" content="{{ csrf_token() }}">
                <table class="table table-bordered table-hover" id="tabel-rawat-jalan">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Document Id</th>
                            <th>Nama Petugas</th>
                            <th>Tanggal Input</th>
                            <th>Konsumsi Tanggal</th>
                            <th>Aksi Resep</th>
                            <th>Aksi Sub Resep</th>
                            <th>Aksi Biaya Obat Ekse</th>
                            <th>Aksi Biaya Obat JKN</th>
                        </tr>
                    </thead>
                </table>
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
@include('farmasikonsumsi.scripts')
@endsection
