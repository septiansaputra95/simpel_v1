@extends('layout.main_layout')

@section('container')
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
                    <h3 class="card-title">Permintaan</h3>
                </div>
              <div class="card-body">
                <a href="permintaan_add" class="btn btn-outline-primary">+ Tambah Data</a>
                <br><br>
                <table class="table table-bordered table-hover" id="datatable">
                    <thead>
                        <tr>
                            <th>Permintaan Id</th>
                            <th>Keterangan</th>
                            <th>Unit</th>
                            <th>Karyawan</th>
                            <th>Pelanggan</th>
                            <th colspan=3>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!is_null($data))
                            @foreach ($data as $item)
                            
                                <tr>
                                    <td>{{ $item->permintaan_header_id }}</td>
                                    <td>{{ $item->permintaan_header_keterangan }}</td>
                                    <td>{{ $item->unit_nama }}</td>
                                    <td>{{ $item->karyawan }}</td>
                                    <td>{{ $item->supplier_nama }}</td>
                                    <td>
                                    <a href="permintaan/print/{{ $item->permintaan_header_id }}" class="btn btn-outline-danger">Print</a>
                                    </td> 
                                </tr>
                            
                            @endforeach
                        @else
                            <tr>
                                <td colspan='6'>Data Kosong</td>
                            </tr>
                        @endif
                    </tbody>
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
<script>
  $(document).ready(function() {
    new DataTable('#datatable');
  });
</script>

@endsection