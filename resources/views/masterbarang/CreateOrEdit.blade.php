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
    <?php //dd($data);?>
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Tambah Data</h3>
                </div>
              <div class="card-body">
                <form action="{{ route('masterbarang_update') }}" method="POST">
                    @csrf
                    @foreach ($data as $item)
                    <?php //dd($data);?>
                    <input type="hidden" name="id" value="{{ $item->barang_id }}">
                    <label>Nama Barang</label>
                    <input type="text" name="nama" class="form-control" value="{{ $item->barang_nama }}">
                    <label>Harga Barang</label>
                    <input type="number" name="harga" class="form-control" value="{{ $item->barang_harga }}">
                    <label>Satuan</label>
                    <select name="satuan" class="form-control">
                        <option value="0"{{ $item->barang_satuan === 'BAK' ? 'selected' : '' }}>Pilih Satuan</option>
                        <option value="BAK" {{ $item->barang_satuan === 'BAK' ? 'selected' : '' }}>BAK</option>
                        <option value="BOTOL" {{ $item->barang_satuan === 'BOTOL' ? 'selected' : '' }}>BOTOL</option>
                        <option value="BUAH" {{ $item->barang_satuan === 'BUAH' ? 'selected' : '' }}>BUAH</option>
                        <option value="BUKU" {{ $item->barang_satuan === 'BUKU' ? 'selected' : '' }}>BUKU</option>
                        <option value="JERIGEN" {{ $item->barang_satuan === 'JERIGEN' ? 'selected' : '' }}>JERIGEN</option>
                        <option value="KOTAK" {{ $item->barang_satuan === 'KOTAK' ? 'selected' : '' }}>KOTAK</option>
                        <option value="LEMBAR" {{ $item->barang_satuan === 'LEMBAR' ? 'selected' : '' }}>LEMBAR</option>
                        <option value="LUSIN" {{ $item->barang_satuan === 'LUSIN' ? 'selected' : '' }}>LUSIN</option>
                        <option value="METER" {{ $item->barang_satuan === 'METER' ? 'selected' : '' }}>METER</option>
                        <option value="PACK" {{ $item->barang_satuan === 'PACK' ? 'selected' : '' }}>PACK</option>
                        <option value="PASANG" {{ $item->barang_satuan === 'PASANG' ? 'selected' : '' }}>PASANG</option>
                        <option value="POUCH" {{ $item->barang_satuan === 'POUCH' ? 'selected' : '' }}>POUCH</option>
                        <option value="RIM" {{ $item->barang_satuan === 'RIM' ? 'selected' : '' }}>RIM</option>
                        <option value="ROLL" {{ $item->barang_satuan === 'ROLL' ? 'selected' : '' }}>ROLL</option>
                        <option value="SET" {{ $item->barang_satuan === 'SET' ? 'selected' : '' }}>SET</option>
                        <option value="STRIP" {{ $item->barang_satuan === 'STRIP' ? 'selected' : '' }}>STRIP</option>
                        <option value="TUBE" {{ $item->barang_satuan === 'TUBE' ? 'selected' : '' }}>TUBE</option>
                        <option value="UNIT" {{ $item->barang_satuan === 'UNIT' ? 'selected' : '' }}>UNIT</option>
                    </select>
                    @endforeach
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