<html>
    <head>
        
    </head>
    <style>
        .background-image {
            background-image: url("{{ asset('image/hospital.jpg') }}"); /* Sesuaikan path dengan lokasi gambar di direktori public */
            background-size: cover;
            background-position: center;
            /* Tambahkan properti CSS lain sesuai kebutuhan */
        }
    
        /* Gaya tambahan untuk konten */
        .content {
            color: white;
            text-align: center;
            padding: 50px;
        }
    </style>
    <body>
        <div class="background-image">
            <!-- Isi konten halaman Anda di sini -->
        </div>
        <div style="background-image: url('{{ asset('image/hospital.jpg')}}');">

        </div>
    </body>
</html>