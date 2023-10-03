@extends('layout.main_layout')

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
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Farmasi</h3>
                </div>
              <div class="card-body">
                <button class="btn btn-outline-primary" id="tambah_data">+ Tambah Data</button>
                <br><br>
                <table class="table table-bordered table-hover" id="datatable">
                    <thead>
                        <tr>
                            <th>Document Id</th>
                            <th>Tanggal Input</th>
                            <th>Gudang</th>
                            <th>Petugas Input</th>
                            <th colspan=3>Action</th>
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
@include('farmasikonsumsi._modal-forminput')
@endsection
