<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan</title>

    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            color: #1f2937;
        }

        .text-center { text-align: center; }
        .font-bold { font-weight: bold; }
        .text-lg { font-size: 18px; }
        .text-sm { font-size: 12px; }

        .mt-4 { margin-top: 16px; }
        .mt-6 { margin-top: 24px; }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .table th {
            background-color: #e5e7eb;
            padding: 8px;
            border: 1px solid #000;
        }

        .table td {
            padding: 6px;
            border: 1px solid #000;
        }

        .footer {
            margin-top: 40px;
            text-align: right;
            font-size: 11px;
        }
    </style>
</head>
<body>

    <!-- HEADER -->
    <div class="text-center">
        <h1 class="text-lg font-bold">LAPORAN PENGADUAN SARANA</h1>
        <p class="text-sm">Periode: {{ date('F Y') }}</p>
    </div>

    <!-- RINGKASAN -->
    <div class="mt-6">
        <h3 class="font-bold">Ringkasan</h3>
        <table class="table">
            <tr>
                <td>Total Tiket</td>
                <td>{{ $total }}</td>
            </tr>
            <tr>
                <td>Total Selesai</td>
                <td>{{ $totalSelesai }}</td>
            </tr>
            <tr>
                <td>Total Ditolak</td>
                <td>{{ $totalDitolak }}</td>
            </tr>
            <tr>
                <td>Bulan Ini</td>
                <td>{{ $bulanIni }}</td>
            </tr>
        </table>
    </div>

    <!-- KATEGORI -->
    <div class="mt-6">
        <h3 class="font-bold">Laporan Berdasarkan Kategori</h3>

        <table class="table">
            <thead>
                <tr>
                    <th>Kategori</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kategoriData as $item)
                    <tr>
                        <td>{{ $item->kategori->nama ?? '-' }}</td>
                        <td>{{ $item->total }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- FOOTER -->
    <div class="footer">
        Dicetak pada: {{ date('d M Y') }}
    </div>

</body>
</html>