<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Surat Jalan</title>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            color: #333;
            margin: 0;
            padding: 40px 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: #ffffff;
            border: 1px solid #cccccc;
            border-radius: 6px;
        }
        .header {
            background-color: #f8f9fa;
            padding: 15px 20px;
            border-bottom: 1px solid #cccccc;
            border-top-left-radius: 6px;
            border-top-right-radius: 6px;
        }
        .header h2 {
            margin: 0;
            font-size: 18px;
            color: #333;
        }
        .body {
            padding: 20px;
        }
        .detail-group {
            margin-bottom: 15px;
        }
        .row {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
        }
        .col {
            flex: 1;
        }
        strong {
            display: block;
            font-size: 14px;
            color: #555;
            margin-bottom: 5px;
        }
        .detail-value {
            font-size: 15px;
            color: #212529;
            background-color: #f8f9fa;
            padding: 8px 10px;
            border: 1px solid #e2e6ea;
            border-radius: 4px;
            min-height: 20px;
        }
        .detail-value-textarea {
            white-space: pre-wrap;
            min-height: 60px;
        }
        .section-title {
            margin-top: 25px;
            padding-top: 15px;
            border-top: 1px solid #eee;
        }
        .section-title h4 {
            margin: 0;
            font-size: 16px;
            color: #555;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 14px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px 12px;
            text-align: left;
        }
        th {
            background-color: #f8f9fa;
            font-weight: bold;
            text-align: center;
        }
        .text-center {
            text-align: center;
        }
        .btn {
            padding: 8px 16px;
            font-size: 14px;
            cursor: pointer;
            border-radius: 4px;
            border: 1px solid transparent;
            text-decoration: none;
            display: inline-block;
        }
        .btn-gray {
            background-color: #e2e6ea;
            color: #333;
            border: 1px solid #ccc;
        }
        .btn-gray:hover {
            background-color: #dae0e5;
        }
        .footer-action {
            margin-top: 25px;
            padding-top: 15px;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: flex-end;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <h2>Detail Surat Jalan #{{ $sj->id }}</h2>
        </div>
        <div class="body">
            
            <!-- Informasi Utama (Header Data) -->
            <div class="row">
                <div class="col">
                    <strong>Tanggal Buat:</strong>
                    <div class="detail-value">{{ date('d M Y H:i', strtotime($sj->TglBuat)) }}</div>
                </div>
                <div class="col">
                    <strong>Perusahaan Tujuan:</strong>
                    <div class="detail-value">{{ $sj->PerusahaanTujuan }}</div>
                </div>
            </div>

            <div class="detail-group">
                <strong>Nama Tujuan:</strong>
                <div class="detail-value">{{ $sj->NamaTujuan }}</div>
            </div>

            <div class="detail-group">
                <strong>Alamat Tujuan:</strong>
                <div class="detail-value detail-value-textarea">{{ $sj->AlamatTujuan }}</div>
            </div>

            <!-- Tabel Detail Item -->
            <div class="section-title">
                <h4>Daftar Item Terlampir</h4>
            </div>
            
            <table>
                <thead>
                    <tr>
                        <th style="width: 45%;">Nama Item</th>
                        <th style="width: 35%;">Warna Item</th>
                        <th class="text-center" style="width: 20%;">Jumlah Item</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sj->items as $item)
                    <tr>
                        <td>{{ $item->NamaItem }}</td>
                        <td>{{ $item->WarnaItem }}</td>
                        <td class="text-center">{{ $item->JumlahItem }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Tombol Kembali Bawah -->
            <div class="footer-action">
                <a href="{{ route('surat-jalan.index') }}" class="btn btn-gray">Kembali ke Grid List</a>
            </div>
            
        </div>
    </div>
</body>
</html>
