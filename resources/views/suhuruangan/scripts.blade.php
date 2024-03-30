<script>
$(function () {
    // Temukan tombol dengan id 'process-suhu'
    var button = document.getElementById('process-suhu');
    
    button.addEventListener('click', function() {
        var unitValue = $('#unit-ruangan').val();
        var bulanValue = $('#bulanSelect').val();
        var tahunValue = $('#tahunSelect').val();
        console.log(unitValue);
        console.log(bulanValue);
        console.log(tahunValue);

        //alert('Tombol "Process" diklik!');
        // Anda dapat menambahkan kode JavaScript tambahan di sini
        $.ajax({
            url: "{{ route('suhuruangan.chart') }}",
            method: 'GET',
            data: {
                unit: unitValue,
                bulan: bulanValue,
                tahun: tahunValue
            },
            success: function(response) {
                // Setelah menerima data dari server, gunakan data tersebut untuk memperbarui chart line
                var dataChart = {
                    labels: response.labels,
                    datasets: [{
                        label: 'Suhu Ruangan ' + response.ruangan,
                        data: response.data,
                        backgroundColor: 'rgba(0, 162, 39, 0.33)',
                        borderColor: 'rgba(0, 162, 39, 0.8)',
                        borderWidth: 1
                    }]
                };

                // Update chart dengan data yang baru
                myChart.data = dataChart;
                myChart.update();
            },
            error: function(xhr, status, error) {
                console.error(error); // Tampilkan pesan error jika terjadi kesalahan
            }
        });
    });
    (() => {
    
    
    })();
});
</script>
