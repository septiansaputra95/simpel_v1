<script>
$(function () {
    console.log('S')
    let urlLoadData = "{{  route('antrol.datatables') }}";

    const dataRawatJalan = () => {
        let tanggal = document.getElementById("tanggal-registrasi").value;
        console.log(tanggal);
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
                    tanggal_registrasi: tanggal
                },
            },
            columns: [
                { mData: "no" },
                { mData: "kodebooking" },
                { mData: "mrn" },
                { mData: "nama_pasien" },
                { mData: "dokter" },
                { mData: "status" },
                { mData: "no_kartu" },
                { mData: "task_1" },
                { mData: "task_2" },
                { mData: "task_3" },
                { mData: "task_4" },
                { mData: "task_5" },
                { mData: "task_6" },
                { mData: "task_7" },
                { mData: "no_sep" },
                { className: "text-center", mData: "aksi" },
            ],
        });
    }

    // __CONSTUCTOR 
    (() => {
        dataRawatJalan();  
    })();
});
</script>
