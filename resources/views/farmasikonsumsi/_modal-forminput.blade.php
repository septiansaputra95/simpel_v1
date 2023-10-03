<!-- Modal -->
<div class="modal fade" id="formFarmasiKonsumsiModal" tabindex="-1" role="dialog" aria-labelledby="formFarmasiKonsumsiModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="formFarmasiKonsumsiModalLabel">Form Farmasi Konsumsi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Form untuk mengunggah data -->
          <form action="{{ route('farmasi.konsumsi.simpan') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="namaKaryawan">Nama Karyawan</label>
              <input type="text" class="form-control" id="namaKaryawan" name="namaKaryawan" placeholder="Masukkan Nama Karyawan">
            </div>
            <div class="form-group">
              <label for="uploadFile">Upload File</label>
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="uploadFile" name="uploadFile">
                <label class="custom-file-label" for="uploadFile">Pilih file</label>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
          <!-- Akhir form -->
        </div>
      </div>
    </div>
  </div>
  