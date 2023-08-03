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
    $id = $request['id'];
    $supplier       = $request['supplier'];
    $keterangan     = $request['keterangan'];
    $namakaryawan   = $request['namakaryawan'];
    $unitbagian     = $request['unitbagian'];
    //$namaunit       = $dataunit['unit_nama'];
    $no             = 1;
    $total          = 0;
@endphp
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
            <br>
            <label>Unit Bagian:</label>
            @foreach($dataunit as $item)
                <label>{{ $item->unit_nama }}</label>
            @endforeach
        </div>
        <div class="col-md-6">
            <label>Tanggal:</label>
            <label>{{ date('d/m/Y') }}</label>
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
            @foreach ($databarang as $key => $value)
                @foreach ($masterbarang as $barang)
                    @if ($barang->barang_id == $value)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $barang->barang_nama }}</td>
                            <td>{{ $datajumlah[$key] }}</td>
                            <td>{{ $barang->barang_satuan }}</td>
                            <td>Rp.{{ $barang->barang_harga }}</td>
                            <td>Rp.{{ $barang->barang_harga * $datajumlah[$key] }}</td>
                        </tr>
                        @php 
                        $total = $total + ($barang->barang_harga * $datajumlah[$key]);
                        @endphp
                    @endif
                @endforeach
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
    <br><br>
    <form action="{{ route('permintaan_store') }}" method="POST">
    @csrf
        <input type="hidden" name="id" value="{{ $id }}">
        <input type="hidden" name="keterangan" value="{{ $keterangan }}">
        <input type="hidden" name="supplier" value="<?php echo '1'; ?>">
        <input type="hidden" name="namakaryawan" value="{{ $namakaryawan }}">
        <input type="hidden" name="unitbagian" value="{{ $unitbagian }}">
        <input type="hidden" name="nomor" value="{{ $no-1 }}">
        @foreach ($databarang as $key => $value)
                @foreach ($masterbarang as $barang)
                    @if ($barang->barang_id == $value)
                    <input type="hidden" name="barang_{{ $key }}" value="{{ $barang->barang_id }}">
                    <input type="hidden" name="jumlah_{{ $key }}" value="{{ $datajumlah[$key] }}">
                    <input type="hidden" name="hargasatuan_{{ $key }}" value="{{ $barang->barang_harga }}">
                    @endif
                @endforeach
         @endforeach
         <br>
        <button class="btn btn-outline-success">Save & Print</button>
        <a href="{{ URL::previous() }}" class="btn btn-outline-warning">Kembali</a>
    </form>
    
</body>
</html>