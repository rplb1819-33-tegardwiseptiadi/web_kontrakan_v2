<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRINT LAPORAN TRANSAKSI</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
            box-sizing: border-box;
            letter-spacing: 0.5px;
        }

        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            margin: 0;
            box-sizing: border-box;
        }

        h1, h2, h3 {
            text-align: center;
            margin-bottom: 20px;
        }

        .lunas {
            background-color: green;
            color: white;
            padding: 5px;
            border: none;
            border-radius: 3px;
            display: inline-block;
        }

        .belumlunas {
            background-color: red;
            color: white;
            padding: 5px;
            border: none;
            border-radius: 3px;
            display: inline-block;
        }

        .table-container {
            overflow-x: auto;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto;
            font-size: 12px;
            page-break-inside: avoid;
        }

        th, td {
            padding: 8px;
            text-align: center;
            border: 1px solid #ccc;
            page-break-inside: avoid;
        }

        th {
            background-color: #2ECD71;
            color: white;
        }

        tbody tr:nth-child(odd) {
            background-color: #f5fff9;
        }

        tbody tr:hover {
            background-color: #f0f0f0;
            transition: background-color 0.2s;
        }

        img {
            max-width: 100px;
            max-height: 100px;
        }

        tfoot tr {
            background-color: #f0f0f0;
            font-weight: bold;
        }

        @media screen and (max-width: 600px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }

            thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            tr {
                margin: 0 0 1rem 0;
                border: 1px solid #ccc;
            }

            td {
                border: none;
                border-bottom: 1px solid #eee;
                position: relative;
                padding-left: 50%;
                text-align: left;
            }

            td:before {
                position: absolute;
                top: 0;
                left: 6px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
                content: attr(data-header);
                font-weight: bold;
            }
        }
    </style>
</head>

<body>
    <h3>PRINT LAPORAN TRANSAKSI BULANAN</h3>
    <div class="table-container">
        <table class="responsive-3">
            <thead>
                <tr>
                    <th scope="col">NO</th>
                    <th scope="col">ID TRANSAKSI</th>
                    <th scope="col">NAMA PENGHUNI</th>
                    <th scope="col">TGL TRANSAKSI</th>
                    <th scope="col">STATUS TRANSAKSI</th>
                    <th scope="col">NAMA KONTRAKAN</th> 
                    <th scope="col">HARGA (/BULAN)</th>
                    <th scope="col">LAMA SEWA</th>
                    <th scope="col">HARGA (*LAMA SEWA)</th>
                    <th scope="col">TOTAL BAYAR</th> 
                    <th scope="col">KEMBALIAN</th> 
                </tr>
            </thead>
            <tbody>
                @forelse ($cetakPertanggal as $transaksi)
                    <tr>
                        <th scope="row" data-header="NO">{{ $loop->iteration }}</th>
                        <td data-header="ID TRANSAKSI">TRS-{{ $transaksi->id }}</td>
                        <td data-header="NAMA PENGHUNI">{{ $transaksi->occupant?->nama_penghuni }}</td>
                        <td data-header="TGL TRANSAKSI">{{ $transaksi->tgl_transaksi }}</td>
                        <td data-header="STATUS TRANSAKSI">
                            @if ($transaksi->status_transaksi == 'Sudah Divalidasi')
                                <span class="lunas">Sudah Divalidasi</span>
                            @elseif ($transaksi->status_transaksi == 'Belum Divalidasi')
                                <span class="belumlunas">Belum Divalidasi</span>
                            @else
                                {{ $transaksi->status_transaksi }}
                            @endif
                        </td>
                        <td data-header="NAMA KONTRAKAN">{{ $transaksi->rent?->nama_kontrakan }}</td> 
                        <td data-header="HARGA (/BULAN)">Rp{{ number_format($transaksi->harga_perbulan, 2, ',', '.') }}</td>
                        <td data-header="LAMA SEWA">{{ $transaksi->jml_sewa_bulan }} BULAN</td>
                        <td data-header="TOTAL HARGA">Rp{{ number_format($transaksi->total_harga, 2, ',', '.') }}</td>
                        <td data-header="TOTAL BAYAR">Rp{{ number_format($transaksi->total_bayar, 2, ',', '.') }}</td> 
                        <td data-header="KEMBALIAN">Rp{{ number_format($transaksi->kembalian, 2, ',', '.') }}</td> 
                    </tr>
                @empty
                    <tr>
                        <td colspan="11">No transactions found</td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="8">Total Harga</td>
                    <td class="right-align">Rp{{ number_format($cetakPertanggal->sum('total_harga'), 2, ',', '.') }}</td>
                    <td class="right-align">Rp{{ number_format($cetakPertanggal->sum('total_bayar'), 2, ',', '.') }}</td>
                    <td class="right-align">Rp{{ number_format($cetakPertanggal->sum('kembalian'), 2, ',', '.') }}</td>
                </tr> 
            </tfoot>
        </table>
    </div>

    <!-- SCRIPT UNTUK PRINT -->
    <script type="text/javascript">
        window.print();
    </script>
</body>

</html>
