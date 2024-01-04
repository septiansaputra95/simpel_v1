<script>
    
    $(function () {
        console.log('S')
        let urlLoadData = "/farmasi/datatables";
        let urlGenerateResep = "/farmasi/generateResep";
        let urlGenerateSubResep = "/farmasi/generateSubResep";
        let urlGenerateBiayaEkse = "/farmasi/generateBiayaEkse";
        let urlGenerateBiayaJKN = "/farmasi/generateBiayaJKN";


    
        const dataRawatJalan = () => {
            // let tanggal_dari = document.getElementById("tanggal-dari").value;
            // let tanggal_sampai = document.getElementById("tanggal-sampai").value;
            // console.log("tanggal dari: " + tanggal_dari);
            // console.log("tanggal sampai: " + tanggal_sampai);
            $("#tabel-rawat-jalan").DataTable({
                rocessing: true,
                serverSide: true,
                paging: true,
                sDom: "<t<p>>",
                iDisplayLength: 15,
                bDestroy: true,
                autoWidth: false,
                ordering: false,
                oLanguage: {
                    sLengthMenu: "_MENU_ ",
                    sInfo: "Showing <b>_START_ to _END_/b> of _TOTAL_ entries",
                    sSearch: "Search Data : ",
                    sZeroRecords: "Tidak ada data",
                    sEmptyTable: "Data tidak tersedia",
                    sLoadingRecords: '<img src="../../ajax-loader.gif"> Loading...',
                },
                ajax: {
                    url: urlLoadData,
                    type: "GET",
                    data: {
                        // tanggal_dari: tanggal_dari,
                        // tanggal_sampai: tanggal_sampai
                    },
                },
                columns: [
                    { mData: "no" },
                    { mData: "data_id" },
                    { mData: "nama" },
                    { mData: "tanggal" },
                    { mData: "konsumsi" },
                    { className: "text-center", mData: "aksiResep" },
                    { className: "text-center", mData: "aksiSubResep" },
                    { className: "text-center", mData: "aksiObatEkse" },
                    { className: "text-center", mData: "aksiObatJKN" }
                ],
            });
        }

        // GENERATE DATA FARMASI KONSUMSI
        function generateDataResep(data_id) {
            console.log('Data ID yang dikirim Resep:', data_id);
            $.ajax({
                type: 'POST',
                url: urlGenerateResep,
                data: {
                    data_id: data_id,
                    action: 'Resep',
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                //data: {data_id: data_id},
                success: function (response) {
                    alert(response);
                },
                error: function () {
                    alert('Terjadi kesalahan saat mencoba generate data.');
                }
            });
        }

        function generateDataSubResep(data_id) {
            console.log('Data ID yang dikirim Sub Resep:', data_id);
            $.ajax({
                type: 'POST',
                url: urlGenerateSubResep,
                data: {
                    data_id: data_id,
                    action: 'Resep',
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                //data: {data_id: data_id},
                success: function (response) {
                    alert(response);
                },
                error: function () {
                    alert('Terjadi kesalahan saat mencoba generate data.');
                }
            });
        }

        // GENERATE DATA OBAT EKSE

        function generateDataObatEkse(data_id) {
            console.log('Data ID yang dikirim Obat Ekse:', data_id);
            $.ajax({
                type: 'POST',
                url: urlGenerateBiayaEkse,
                data: {
                    data_id: data_id,
                    action: 'Biaya',
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                //data: {data_id: data_id},
                success: function (response) {
                    alert("BIAYA OBAT EKSEKUTIF = " + formatRupiah(response));
                    // alert(response);
                },
                error: function () {
                    alert('Terjadi kesalahan saat mencoba generate data.');
                }
            });
        }

        function generateDataObatJKN(data_id) {
            console.log('Data ID yang dikirim Obat JKN:', data_id);
            $.ajax({
                type: 'POST',
                url: urlGenerateBiayaJKN,
                data: {
                    data_id: data_id,
                    action: 'Biaya',
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                //data: {data_id: data_id},
                success: function (response) {
                    alert("BIAYA OBAT JKN = " + formatRupiah(response));
                    // alert(response);
                },
                error: function () {
                    alert('Terjadi kesalahan saat mencoba generate data.');
                }
            });
        }

        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(angka);
        }
        // __CONSTUCTOR 
        (() => {
            dataRawatJalan();  
            // PERLU DIMASUKAN KE CONSTRUCTOR AGAR DI EKSEKUSI LANGSUNG KETIKA DILAKUKAN KLIK 
            $('#tabel-rawat-jalan tbody').on('click', '#generateResep', function () {
                var dataId = $(this).data('id');
                console.log(dataId)
                // Memanggil fungsi khusus untuk generate dengan AJAX
                 generateDataResep(dataId);
            });

            $('#tabel-rawat-jalan tbody').on('click', '#generateSubResep', function () {
                var dataId = $(this).data('id');
                console.log(dataId)
                // Memanggil fungsi khusus untuk generate dengan AJAX
                generateDataSubResep(dataId);
            });

            $('#tabel-rawat-jalan tbody').on('click', '#generateObatEkse', function () {
                var dataId = $(this).data('id');
                console.log(dataId)
                // Memanggil fungsi khusus untuk generate dengan AJAX
                generateDataObatEkse(dataId);
            });

            $('#tabel-rawat-jalan tbody').on('click', '#generateObatJKN', function () {
                var dataId = $(this).data('id');
                console.log(dataId)
                // Memanggil fungsi khusus untuk generate dengan AJAX
                generateDataObatJKN(dataId);
            });

        })();
       
    });

    
    </script>
    