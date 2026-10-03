<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Surat Jalan</title>
    
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
        .section-title h3 {
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
            padding: 6px 0;
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
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <h2>Modify Surat Jalan #{{ $sj->id }}</h2>
        </div>
        <div class="body">
            <form action="{{ route('surat-jalan.update', $sj->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                
                <div class="row form-group">
                    <div class="col">
                        <label>Tanggal Buat</label>
                        <input type="datetime-local" name="TglBuat" class="form-control" value="{{ date('Y-m-d\TH:i', strtotime($sj->TglBuat)) }}" required>
                    </div>
                    <div class="col">
                        <label>Perusahaan Tujuan</label>
                        <input type="text" name="PerusahaanTujuan" class="form-control" value="{{ $sj->PerusahaanTujuan }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Nama Tujuan</label>
                    <input type="text" name="NamaTujuan" class="form-control" value="{{ $sj->NamaTujuan }}" required>
                </div>

                <div class="form-group">
                    <label>Alamat Tujuan</label>
                    <textarea name="AlamatTujuan" class="form-control" rows="3" required>{{ $sj->AlamatTujuan }}</textarea>
                </div>

               
                <div class="section-title">
                    <h3>Detail Item</h3>
                    <button type="button" class="btn btn-green" id="addItemBtn">+ Tambah Baris Item</button>
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
                        @foreach($sj->items as $index => $item)
                        <tr>
                            <td><input type="text" name="items[{{ $index }}][NamaItem]" class="form-control" value="{{ $item->NamaItem }}" required></td>
                            <td><input type="text" name="items[{{ $index }}][WarnaItem]" class="form-control" value="{{ $item->WarnaItem }}" required></td>
                            <td><input type="number" name="items[{{ $index }}][JumlahItem]" class="form-control text-center" min="1" value="{{ $item->JumlahItem }}" required></td>
                            <td><button type="button" class="btn btn-red-outline remove-row">Hapus</button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                
                <div class="footer-action">
                    <a href="{{ route('surat-jalan.index') }}" class="btn btn-gray">Kembali ke Daftar</a>
                    <button type="submit" class="btn btn-blue">Update Surat Jalan</button>
                </div>
            </form>
        </div>
    </div>

    
    <script>
        let rowIndex = document.querySelectorAll('#itemTable tbody tr').length;

        document.getElementById('addItemBtn').addEventListener('click', function() {
            let tableBody = document.querySelector('#itemTable tbody');
            let newRow = '<tr>' +
                '<td><input type="text" name="items[' + rowIndex + '][NamaItem]" class="form-control" required></td>' +
                '<td><input type="text" name="items[' + rowIndex + '][WarnaItem]" class="form-control" required></td>' +
                '<td><input type="number" name="items[' + rowIndex + '][JumlahItem]" class="form-control text-center" min="1" required></td>' +
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
                rows.forEach(function(row) {
                    row.querySelector('.remove-row').removeAttribute('disabled');
                });
            }
        }
        toggleDeleteButtons(); 
    </script>
</body>
</html>
