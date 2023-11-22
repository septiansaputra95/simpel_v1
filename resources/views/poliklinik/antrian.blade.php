@extends('layout.main_layout')

@section('container')
     <!-- Content Header (Page header) -->
     <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Antrian Poliklinik</h1>
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
              <h3 class="card-title">Antrian Poli</h3>
            </div>
            <div class="card-body">
              <form id="farmasiForm">
                <div class="form-group">
                  <label for="dokter">Dokter</label>
                  <select class="form-control" id="dokter" name="dokter">
                    <!-- Pilihan nama dokter -->
                      <option value="">Pilih Dokter</option>
                    @foreach($data as $item)
                      <option value="{{ $item->name }}">{{ $item->name }}</option>
                    @endforeach
                    <!-- Tambahkan pilihan lainnya sesuai kebutuhan -->
                  </select>
                </div>

                <div class="form-group">
                  <label for="poliklinik">Poliklinik</label>
                  <select class="form-control" id="poliklinik" name="poliklinik">
                    <option value="POLIKLINIK KAMALA">POLIKLINIK KAMALA</option>
                    <option value="POLIKLINIK PADMA">POLIKLINIK PADMA</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="nomorAntrian">Nomor Antrian</label>
                  <input type="text" class="form-control" id="nomorAntrian" name="nomorAntrian" placeholder="Masukkan Nomor Antrian">
                </div>

                <button type="button" class="btn btn-primary" id="cetakBtn">Cetak</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </div>
<!-- /.content -->
<script>
  document.getElementById('cetakBtn').addEventListener('click', function () {
    // Dapatkan waktu saat ini
    var currentTime = new Date();
    
    // Format tanggal dengan "YYYY-MM-DD hh:mm:ss"
    var formattedDate = currentTime.toISOString().slice(0, 19).replace("T", " ");

    // Dapatkan nilai dari form
    var selectedDokter = document.getElementById('dokter').value;
    var selectedPoliklinik = document.getElementById('poliklinik').value;
    var nomorAntrian = document.getElementById('nomorAntrian').value;

    // Buat teks untuk popup window
    var popupDokter = selectedDokter;
    popupPoli = 'Poliklinik: ' + selectedPoliklinik + '<br>';
    popupNomor = 'Nomor Antrian: ' + nomorAntrian + '<br>';

    // Buka popup window
    var popupWindow = window.open('', '_blank', 'width=400,height=400');
    
    // Modifikasi isi popup window
    popupWindow.document.write('<html><head><title>Antrian Poliklinik</title>');

    // URL gambar yang ingin Anda sertakan
    var imageUrl = '/image/LOGO_PEKALONGAN.jpeg';
    //'<img src="' + imageUrl + '" alt="Gambar">';
    // Tambahkan style untuk mengganti font
    popupWindow.document.write('<style>');
    popupWindow.document.write('body { font-family: "Arial", sans-serif; text-align: center; }'); // Mengatur posisi teks dan gambar menjadi tengah
    popupWindow.document.write('img { max-width: 70px; height: auto; }'); // Menyesuaikan gambar agar tidak melebihi lebar kontennya
    popupWindow.document.write('</style>');

    popupWindow.document.write('</head><body>');
    popupWindow.document.write('<img align="center" src="' + imageUrl + '" alt="Gambar">');
    popupWindow.document.write('<h5 align="center">RS Hermina Pekalongan</h5>');
    popupWindow.document.write('<h6 align="center">Jl. Jendral Sudirman No. 16A Pekalongan</h6>');
    popupWindow.document.write('<h5 align="center">'+ selectedPoliklinik +'</h5>');
    popupWindow.document.write('<h3 align="center">'+ selectedDokter +'</h3>');
    popupWindow.document.write('<h1 align="center">'+ nomorAntrian +'</h1>');
    popupWindow.document.write('<p align="center">' + formattedDate + '</p>');
    popupWindow.document.write('</body></html>');
    //popupWindow.print();
    // Tambahkan penundaan sebelum mencetak
    setTimeout(function() {
        popupWindow.print();
        popupWindow.close(); // Menutup popup setelah mencetak
    }, 1000); // Penundaan 1 detik (1000 milidetik)

  });
</script>
@endsection
