@extends('layout.main_layout')

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
                <form action="laporan" method="POST">
                @csrf
                  <div class="row">
                    <div class="col-md-6">
                      <select name="bulan" class="form-control">
                        <option value="1">JANUARI</option>
                        <option value="2">FEBRUARI</option>
                        <option value="3">MARET</option>
                        <option value="4">APRIL</option>
                        <option value="5">MEI</option>
                        <option value="6">JUNI</option>
                        <option value="7">JULI</option>
                        <option value="8">AGUSTUS</option>
                        <option value="9">SEPTEMBER</option>
                        <option value="10">OKTOBER</option>
                        <option value="11">NOVEMBER</option>
                        <option value="12">DESEMBER</option>
                      </select>
                    </div>

                    <div class="col-md-6">
                      <select name="tahun" class="form-control">
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                      </select>
                    </div>
                  </div>
                  <br>
                  <button type="submit" name="action" value="generate" class="btn btn-outline-primary">Generate</button>
                  <button type="submit" name="action" value="export" class="btn btn-outline-success">Export Spreadsheet</button>
                </form>
                <br>
                <hr>
                <h3 align="center">Laporan Jumlah Permintaan Seluruh Unit</h3>
                <h3 align="center">Bulan {{ $bulan }} Tahun {{ $tahun }}</h3>
                <hr>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Unit</th>
                            <th>Jumlah Permintaan</th>
                            <th colspan=3>Action</th>
                        </tr>
                        @if(!is_null($data))
                            @for($i=1; $i<=count($data); $i++)
                            <tbody>
                                <tr>
                                    <td>{{ $dataunitid[$i] }}</td>
                                    <td>{{ $dataunitnama[$i] }}</td>
                                    <td>Rp.{{ $dataharga[$i] }}</td>
                                    <td>
                                    <a href="laporan/detail/{{ $dataunitid[$i] }}/{{ $bulan }}/{{ $tahun }}" class="btn btn-outline-success">Detail</a>
                                    </td> 
                                </tr>
                            </tbody>
                            @endfor
                        @endif
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