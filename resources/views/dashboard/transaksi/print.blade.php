<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>PRINT | TRANSAKSI</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
            box-sizing: border-box;
            letter-spacing: 0.5px;
        }

        body {
            padding: 20px;
        }

        h1, h2, h3 {
            text-align: center;
        }

        table {
            width: 100%;
            margin: 25px auto;
            border-collapse: collapse;
            box-shadow: 0px 10px 30px 5px rgba(0, 0, 0, 0.15);
        }

        thead tr td {
            font-size: 16px;
            color: black;
            padding: 8px;
        }

        .judul-table {
            width: 60%;
        }

        .invoice-table {
            width: 100%;
        }

        .invoice-table thead tr,
        .invoice-table tfoot tr {
            border: 1px dashed black;
        }

        .invoice-table td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        .invoice-table tfoot td {
            font-weight: bold;
        }

        .right-align {
            text-align: right;
        }
    </style>
</head>

<body>

    <h1>BUKTI PEMBAYARAN KONSU APP</h1>
    <h2>ID TRANSAKSI: TRS-{{ $transaction->id }}</h2>

    <table class="judul-table">
        <thead>
            <tr>
                <td>Atas Nama: {{ $transaction->user->name }}</td>
                <td class="right-align">
                    {{ \Carbon\Carbon::now()->setTimezone('Asia/Jakarta')->locale('id')->isoFormat('dddd, D MMMM YYYY') }},
                    {{ \Carbon\Carbon::now()->setTimezone('Asia/Jakarta')->locale('id')->format('H:i') }}
                </td>
            </tr>
        </thead>
    </table>

    <table class="invoice-table">
        <thead>
            <tr>
                <td>Nama</td>
                <td>Tgl</td>
                <td>Status Pembayaran</td>
                <td>Nama Kontrakan</td>
                <td>Tipe Kontrakan</td>
                <td>Harga (/Bulan)</td>
                <td>Lama Sewa</td>
                <td>Total Harga 
                <br>
                (*Jumlah Bulan)</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $transaction->user->name }}</td>
                <td>{{ $transaction->tgl_transaksi }}</td>
                <td>{{ $transaction->status_transaksi }}</td>
                <td>{{ $transaction->rent->nama_kontrakan }}</td>
                <td>{{ $transaction->rent->tipe_kontrakan }}</td>
                <td>Rp{{ number_format($transaction->harga_perbulan, 2, ',', '.') }}</td>
                <td>{{ $transaction->jml_sewa_bulan }} Bulan</td>
                <td>Rp{{ number_format($transaction->total_harga, 2, ',', '.') }}</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="7">Total Harga</td>
                <td class="right-align">Rp{{ number_format($transaction->total_harga, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="7">Total Bayar</td>
                <td class="right-align">Rp{{ number_format($transaction->total_bayar, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="7">Kembalian</td>
                <td class="right-align">Rp{{ number_format($transaction->kembalian, 2, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

    <br>
    <h1>KONSU APP</h1>
    <h3>
        Terima kasih telah berbelanja di KONSU APP!
        <br>
        Kami mengucapkan terima kasih atas kunjungan, kepercayaan, dan dukungan Anda.
        <br>
        Kami senang dapat memberikan pelayanan terbaik dan produk berkualitas.
    </h3> 

    <!-- SCRIPT UNTUK PRINT -->
    <script type="text/javascript">
        window.print();
    </script>
    

</body>

</html>
