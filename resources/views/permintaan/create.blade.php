@extends('layout.main_layout')
<!-- Content Wrapper. Contains page content -->
@section('container')
<div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> Permintaan GU KOKARMINA</h1>
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
                    <h3 class="card-title">Tambah Data</h3>
                </div>
              <div class="card-body">
              
                <form action="{{ route('permintaan_show') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="<?php echo date('Ymd').''.rand(2,1000); ?>">
                    <input type="hidden" name="supplier" value="<?php echo '1'; ?>">
                    <label>Nama Karyawan</label>
                    <input type="text" name="namakaryawan" class="form-control" placeholder="NAMA KARYAWAN">
                    <label>Unit Bagin</label>
                    <select name="unitbagian" class="form-control">
                      <option value="0">PILIH UNIT</option>
                    @foreach($dataunit as $item)
                      <option value="{{ $item->unit_id }}">{{ $item->unit_nama }}</option>
                    @endforeach
                    </select>
                    <label>Keterangan</label>
                    <input type="text" name="keterangan" class="form-control" placeholder="KETERANGAN">
                    @for ($i = 1; $i <= 10; $i++)
                        <label>Barang {{ $i }}</label>
                        <div class="row">
                            <div class="col-md-6">
                              <select name="barang_{{ $i }}" id="" class="form-control">
                                  <option value="">PILIH BARANG</option>
                                  @foreach ($data as $item)
                                  <option value="{{ $item->barang_id }}">{{ $item->barang_nama }} | <b>Rp.{{ $item->barang_harga }}</b></option>
                                  @endforeach
                              </select>
                            </div>
                            <div class="col-md-6">
                              <input type="number" name="jumlah_{{ $i }}" class="form-control" placeholder="JUMLAH BARANG">
                            </div>
                        </div>
                    @endfor

                    
                    <br>
                    <button class="btn btn-outline-success">Save</button>
                    <a href="/permintaan" class="btn btn-outline-warning">Kembali</a>
                </form>
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection