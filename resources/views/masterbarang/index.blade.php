@extends('layout.main_layout')

@section('container')
     <!-- Content Header (Page header) -->
     <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> Master Barang GU KOKARMINA</h1>
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
                    <h3 class="card-title">Master Barang</h3>
                </div>
              <div class="card-body">
                <a href="masterbarang_add" class="btn btn-outline-primary">+ Tambah Data</a>
                <br><br>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th>Satuan</th>
                            <th colspan=2>Action</th>
                        </tr>
                        @foreach ($data as $item)
                        <tr>
                            <td>{{ $item->barang_id }}</td>
                            <td>{{ $item->barang_nama }}</td>
                            <td>Rp.{{ $item->barang_harga }}</td>
                            <td>{{ $item->barang_satuan }}</td>
                            <td>
                              <a href="masterbarang/edit/{{ $item->barang_id }}" class="btn btn-outline-info">Edit</a>
                            </td>
                        </tr>
                        @endforeach
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
@endsection