@include('layout.menu')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
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
                    <h3 class="card-title">Tambah Data</h3>
                </div>
              <div class="card-body">
              @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
                <form action="{{ route('masterbarang_store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="<?php echo rand(2,1000000); ?>">
                    <label>Nama Barang</label>
                    <input type="text" name="nama" class="form-control">
                    <label>Harga Barang</label>
                    <input type="number" name="harga" class="form-control">
                    <label>Satuan</label>
                    <select name="satuan" id="" class="form-control">
                            <option value="">Pilih Satuan</option>
                            <option value="BAK">BAK</option>
                            <option value="BOTOL">BOTOL</option>
                            <option value="BUAH">BUAH</option>
                            <option value="BUKU">BUKU</option>
                            <option value="JERIGEN">JERIGEN</option>
                            <option value="KOTAK">KOTAK</option>
                            <option value="LEMBAR">LEMBAR</option>
                            <option value="LUSIN">LUSIN</option>
                            <option value="METER">METER</option>
                            <option value="PACK">PACK</option>
                            <option value="PASANG">PASANG</option>
                            <option value="POUCH">POUCH</option>
                            <option value="RIM">RIM</option>
                            <option value="ROLL">ROLL</option>
                            <option value="SET">SET</option>
                            <option value="STRIP">STRIP</option>
                            <option value="TUBE">TUBE</option>
                            <option value="UNIT">UNIT</option>
                    </select>
                    <br>
                    <button class="btn btn-outline-success">Save</button>
                    <a href="{{ URL::previous() }}" class="btn btn-outline-warning">Kembali</a>
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
@include('layout.footer')