<!DOCTYPE html>
<html>
<head>
    <title>Bukti Permintaan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        .header {
            text-align: center;
            padding: 20px;
            background-color: #f2f2f2;
            border-bottom: 1px solid #ccc;
        }
        
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        .table th,
        .table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        
        .table th {
            background-color: #f2f2f2;
        }
        
        .signature {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        
        .signature-box {
            width: 25%;
            height: 170px;
            border: 1px solid #ccc;
            text-align: center;
            padding-top: 30px;
            position: relative;
        }
        
        .signature-text {
            position: absolute;
            bottom: 10px;
            left: 0;
            right: 0;
        }
    </style>
</head>
@php
    foreach ($data as $item){
        $id             = $item->permintaan_header_id;
        $keterangan     = $item->permintaan_header_keterangan;
        $namakaryawan   = $item->karyawan;
        $date           = $item->permintaan_header_tgl;
    }
    $no = 1;
    $total = 0;
@endphp
<?php 
//dd($id);
?>

<body>
    <div class="header">
        <h1>BUKTI PERMINTAAN</h1>
        <hr>
        <p>No. Permintaan: {{ $id }} </p>
    </div>
    <br>
    <div class="row">
        <div class="col-md-6">
            <label>Keterangan:</label>
            <label>{{ $keterangan }}</label>
        </div>
        <div class="col-md-6">
            <label>Tanggal:</label>
            <label>{{ $date }}</label>
            <br>
            <label>Supplier:</label>
            <label>KOKARMINA PEKALONGAN</label>
        </div>
    </div>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Satuan</th>
                <th>Harga Satuan</th>
                <th><b>Total Harga per item</b></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item->barang_nama }}</td>
                    <td>{{ $item->permintaan_detail_jumlah }}</td>
                    <td>{{ $item->barang_satuan }}</td>
                    <td>Rp.{{ $item->permintaan_detail_harga }}</td>
                    <td>Rp.{{ $item->permintaan_detail_harga * $item->permintaan_detail_jumlah }}</td>
                </tr>
                @php 
                $total = $total + ($item->permintaan_detail_harga * $item->permintaan_detail_jumlah);
                @endphp
            @endforeach
            <tr>
                <td colspan="5" align="center">TOTAL HARGA</td>
                <td>Rp.{{ $total }}</td>
            </tr>
            <tr>
                <td colspan="5" align="center">PPN 11%</td>
                <td>Rp.{{ $total * 11/100 }}</td>
            </tr>
            <tr>
                <td colspan="5" align="center">GRAND TOTAL</td>
                <td><b>Rp.{{ $grandtotal = $total + ($total * 11/100) }}</b></td>
            </tr>
        </tbody>
    </table>
    <div class="signature">
        <div class="signature-box">
            Yang Meminta
            <br>
            <span class="signature-text">{{ $namakaryawan }}</span>
        </div>
        <div class="signature-box">
            Manajer Unit
        </div>
        <div class="signature-box">
            Manajer Penunjang Umum
            <br>
            <span class="signature-text">Kurniawan, Amd. TEM</span>
        </div>
        <div class="signature-box">
            Direktur RS<br>
            <span class="signature-text">drg. Retno Windanarti, MARS</span>
        </div>
    </div>
    <br>
    <a href="permintaan" class="btn btn-outline-warning">Halaman Permintaan</a>
</body>
<script>
    // Mencetak halaman saat halaman dimuat
    window.onload = function() {
        window.print();
    };
</script>

</html>