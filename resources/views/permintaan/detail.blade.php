@extends('layout.main_layout')
@php
$no = 1;
@endphp
@section('container')
     <!-- Content Header (Page header) -->
     <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> Laporan Permintaan GU KOKARMINA</h1>
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
                    <h3 class="card-title">Laporan Permintaan</h3>
                </div>
              <div class="card-body">
                <h3 align="center">Detail Laporan Jumlah Permintaan Unit {{ $unitnama }}</h3>
                <h3 align="center">Bulan {{ $bulan }} Tahun {{ $tahun }}</h3>
                <hr>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Barang</th>
                            <th>Jumlah</th>
                            <th>Barang Harga</th>
                            <th>Total</th>
                        </tr>
                        @if(!is_null($datapermintaan))
                            @foreach($datapermintaan as $item)
                            <tbody>
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->barang_nama }}</td>
                                    <td>{{ $item->permintaan_detail_jumlah }}</td>
                                    <td>Rp.{{ $item->permintaan_detail_harga }}</td>
                                    <td>Rp.{{ $item->permintaan_detail_jumlah * $item->permintaan_detail_harga }}</td>
                                </tr>
                            </tbody>
                            @endforeach
                        @endif
                    </thead>
                </table>
                <br>
                <a href="{{ URL::previous() }}" class="btn btn-outline-warning">Kembali</a>
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection