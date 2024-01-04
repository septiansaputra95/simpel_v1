<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Page</title>
</head>
<body>
    <!-- Tampilkan data yang diperlukan di sini -->
    <h2>{{ $data['dokter'] }}</h2>
    <p>{{ $data['poliklinik'] }}</p>
    <p>{{ $data['nomorAntrian'] }}</p>
    <p>{{ $data['formattedDate'] }}</p>

    <script>
        // Otomatis jalankan pencetakan saat halaman dimuat
        window.onload = function() {
            window.print();
            // Jika Anda ingin menutup tab setelah mencetak, Anda bisa menambahkan:
            // window.close();
        };
    </script>
</body>
</html>