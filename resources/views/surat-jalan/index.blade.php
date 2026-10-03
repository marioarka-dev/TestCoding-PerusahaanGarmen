<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Surat Jalan</title>
    
    <style>
        body { 
            background-color: #f4f6f9; 
            font-family: Arial, sans-serif; 
            margin: 0; 
            padding: 40px 0;
            color: #333;
        }
        .container { 
            max-width: 1000px; 
            margin: 0 auto; 
            padding: 0 15px; 
        }
        .d-flex { display: flex !important; }
        .justify-content-between { justify-content: space-between !important; }
        .align-items-center { align-items: center !important; }
        .mb-1 { margin-bottom: 4px !important; }
        .mb-4 { margin-bottom: 24px !important; }
        .fw-bold { font-weight: bold !important; }
        .fw-semibold { font-weight: 600 !important; }
        
        /* Tombol & Aksi */
        .btn { 
            display: inline-block; 
            font-size: 14px; 
            padding: 8px 16px; 
            border-radius: 6px; 
            text-decoration: none; 
            cursor: pointer; 
            border: 1px solid transparent; 
            box-sizing: border-box;
        }
        .btn-primary { background-color: #007bff; color: white; }
        .btn-primary:hover { background-color: #0069d9; }
        .btn-outline-secondary { background-color: transparent; color: #6c757d; border: 1px solid #6c757d; }
        .btn-outline-secondary:hover { background-color: #6c757d; color: white; }
        .btn-warning { background-color: #ffc107; color: #212529; }
        .btn-warning:hover { background-color: #e0a800; color: #212529; }
        .btn-danger { background-color: #dc3545; color: white; }
        .btn-danger:hover { background-color: #bd2130; }
        .btn-action { padding: 5px 10px; font-size: 12px; border-radius: 4px; display: inline-flex; align-items: center; gap: 4px; }
        .d-inline-flex { display: inline-flex !important; }
        .gap-1 { gap: 4px !important; }
        .d-inline { display: inline !important; }

        
        .alert {
            padding: 12px 20px;
            margin-bottom: 24px;
            border-radius: 6px;
            font-size: 14px;
            box-sizing: border-box;
        }
        .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }

        
        .card { 
            background: #ffffff; 
            border: 1px solid #cccccc; 
            border-radius: 8px; 
            box-shadow: 0 2px 4px rgba(0,0,0,0.05); 
            overflow: hidden; 
        }
        .table-responsive { overflow-x: auto; }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            vertical-align: middle; 
            font-size: 14px; 
        }
        th, td { 
            padding: 12px 15px; 
            text-align: left; 
            border-bottom: 1px solid #dee2e6; 
        }
        thead tr { background-color: #343a40; color: white; }
        th { font-weight: bold; }
        tbody tr:nth-of-type(odd) { background-color: rgba(0,0,0,.02); }
        tbody tr:hover { background-color: rgba(0,0,0,.075); }
        .text-center { text-align: center !important; }
        .text-dark { color: #212529 !important; }
        .text-secondary { color: #6c757d !important; }
        
       
        .badge { 
            display: inline-block; 
            padding: 4px 12px; 
            font-size: 12px; 
            font-weight: bold; 
            border-radius: 20px; 
        }
        .bg-info { background-color: #17a2b8; color: white; }

        .icon-placeholder {
            font-size: 32px;
            font-weight: bold;
            color: #ccc;
            margin-bottom: 10px;
            display: block;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                
                
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="fw-bold text-dark mb-1" style="margin: 0; font-size: 26px;">Aplikasi Surat Jalan</h2>
                    </div>
                    <a href="{{ route('surat-jalan.create') }}" class="btn btn-primary fw-semibold">
                        [+] Buat Surat Jalan
                    </a>
                </div>

                
                @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        ✓ {{ session('success') }}
                    </div>
                @endif

                
                <div class="card">
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th style="width: 8%; padding-left: 20px;">ID</th>
                                    <th style="width: 18%;">Tanggal Buat</th>
                                    <th style="width: 25%;">Perusahaan Tujuan</th>
                                    <th style="width: 20%;">Nama Tujuan</th>
                                    <th class="text-center" style="width: 12%;">Total</th>
                                    <th class="text-center" style="width: 17%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($suratJalan as $sj)
                                <tr>
                                    <td style="padding-left: 20px;" class="fw-bold text-secondary">#{{ $sj->id }}</td>
                                    <td>{{ date('d M Y H:i', strtotime($sj->TglBuat)) }}</td>
                                    <td class="fw-semibold text-dark">{{ $sj->PerusahaanTujuan }}</td>
                                    <td>{{ $sj->NamaTujuan }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-info">
                                            {{ $sj->items->count() }} Item
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-inline-flex gap-1">
                                            <a href="{{ route('surat-jalan.show', $sj->id) }}" class="btn btn-outline-secondary btn-action" title="Lihat">
                                                👁 View
                                            </a>
                                            <a href="{{ route('surat-jalan.edit', $sj->id) }}" class="btn btn-warning btn-action" title="Ubah">
                                                ✏ Edit
                                            </a>
                                            <form action="{{ route('surat-jalan.destroy', $sj->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus surat jalan ini?')">
                                                @csrf 
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-action" title="Hapus">
                                                    🗑
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted" style="padding: 40px 0;">
                                        <span class="icon-placeholder">🗀</span>
                                        Belum ada data surat jalan terdaftar. Klik tombol di atas untuk menambah data baru.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
</html>
