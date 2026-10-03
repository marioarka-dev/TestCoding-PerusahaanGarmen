<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Surat Jalan</title>
    
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
        .header h4 {
            margin: 0;
            font-size: 18px;
            color: #333;
        }
        .body {
            padding: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .row {
            display: flex;
            gap: 15px;
        }
        .col {
            flex: 1;
        }
        label {
            display: block;
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 5px;
            color: #555;
        }
        .form-control {
            width: 100%;
            padding: 8px 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .form-control:focus {
            border-color: #66afe9;
            outline: 0;
        }
        textarea.form-control {
            resize: vertical;
        }
        .section-title {
            margin-top: 25px;
            padding-top: 15px;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .section-title h5 {
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
            padding: 8px;
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
            padding: 6px 12px;
            font-size: 14px;
            cursor: pointer;
            border-radius: 4px;
            border: 1px solid transparent;
            text-decoration: none;
            display: inline-block;
        }
        .btn-blue {
            background-color: #007bff;
            color: white;
        }
        .btn-blue:hover {
            background-color: #0069d9;
        }
        .btn-green {
            background-color: #28a745;
            color: white;
        }
        .btn-green:hover {
            background-color: #218838;
        }
        .btn-gray {
            background-color: #e2e6ea;
            color: #333;
            border: 1px solid #ccc;
        }
        .btn-gray:hover {
            background-color: #dae0e5;
        }
        .btn-red-outline {
            background-color: transparent;
            color: #dc3545;
            border: 1px solid #dc3545;
            width: 100%;
            box-sizing: border-box;
        }
        .btn-red-outline:hover:not(:disabled) {
            background-color: #dc3545;
            color: white;
        }
        .btn-red-outline:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
        .footer-action {
            margin-top: 25px;
            padding-top: 15px;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }
        .hint {
            font-size: 12px;
            color: #777;
            display: block;
            margin-top: 5px;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <h4>Tambah Surat Jalan Baru</h4>
        </div>
        <div class="body">
            <form action="{{ route('surat-jalan.store') }}" method="POST">
                @csrf
                
                <div class="row form-group">
                    <div class="col">
                        <label>Tanggal Buat</label>
                        <input type="datetime-local" name="TglBuat" class="form-control" required value="{{ old('TglBuat') }}">
                    </div>
                    <div class="col">
                        <label>Perusahaan Tujuan</label>
                        <input type="text" name="PerusahaanTujuan" class="form-control" placeholder="PT. Contoh Sukses" required value="{{ old('PerusahaanTujuan') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label>Nama Penerima / Tujuan</label>
                    <input type="text" name="NamaTujuan" class="form-control" placeholder="Nama PIC Penerima" required value="{{ old('NamaTujuan') }}">
                </div>

                <div class="form-group">
                    <label>Alamat Lengkap Tujuan</label>
                    <textarea name="AlamatTujuan" class="form-control" rows="3" placeholder="Tuliskan alamat pengiriman dengan jelas..." required>{{ old('AlamatTujuan') }}</textarea>
                </div>

                <!-- Bagian Detail Tabel -->
                <div class="section-title">
                    <h5>Detail Item Terlampir</h5>
                    <button type="button" class="btn btn-green" id="addItemBtn">+ Tambah Baris</button>
                </div>
                
                <table id="itemTable">
                    <thead>
                        <tr>
                            <th style="width: 40%;">Nama Item</th>
                            <th style="width: 30%;">Warna Item</th>
                            <th style="width: 20%;">Jumlah Item</th>
                            <th style="width: 10%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" name="items[0][NamaItem]" class="form-control" placeholder="Contoh: Semen" required></td>
                            <td><input type="text" name="items[0][WarnaItem]" class="form-control" placeholder="Contoh: Abu-abu" required></td>
                            <td><input type="number" name="items[0][JumlahItem]" class="form-control text-center" min="1" placeholder="0" required></td>
                            <td><button type="button" class="btn btn-red-outline remove-row" disabled>Hapus</button></td>
                        </tr>
                    </tbody>
                </table>
                <span class="hint">* Surat jalan wajib memasukkan minimal 1 item detail.</span>

                <!-- Tombol Aksi Bawah -->
                <div class="footer-action">
                    <a href="{{ route('surat-jalan.index') }}" class="btn btn-gray">Kembali</a>
                    <button type="submit" class="btn btn-blue">Simpan Surat Jalan</button>
                </div>
            </form>
        </div>
    </div>

    
    <script>
        let rowIndex = 1;
        document.getElementById('addItemBtn').addEventListener('click', function() {
            let tableBody = document.querySelector('#itemTable tbody');
            
            let newRow = '<tr>' +
                '<td><input type="text" name="items[' + rowIndex + '][NamaItem]" class="form-control" placeholder="Nama Item" required></td>' +
                '<td><input type="text" name="items[' + rowIndex + '][WarnaItem]" class="form-control" placeholder="Warna" required></td>' +
                '<td><input type="number" name="items[' + rowIndex + '][JumlahItem]" class="form-control text-center" min="1" placeholder="0" required></td>' +
                '<td><button type="button" class="btn btn-red-outline remove-row">Hapus</button></td>' +
                '</tr>';
                
            tableBody.insertAdjacentHTML('beforeend', newRow);
            rowIndex++;
            toggleDeleteButtons();
        });

        document.querySelector('#itemTable').addEventListener('click', function(e) {
            if(e.target && e.target.classList.contains('remove-row')) {
                e.target.closest('tr').remove();
                toggleDeleteButtons();
            }
        });

        function toggleDeleteButtons() {
            let rows = document.querySelectorAll('#itemTable tbody tr');
            if (rows.length === 1) {
                rows[0].querySelector('.remove-row').setAttribute('disabled', 'disabled');
            } else {
                rows.forEach(row => row.querySelector('.remove-row').removeAttribute('disabled'));
            } 
        }
    </script>
</body>
</html>
