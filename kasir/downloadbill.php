<?php
// Ambil parameter dari URL
$total = isset($_GET['total']) ? $_GET['total'] : '';
$cashAmount = isset($_GET['cashAmount']) ? $_GET['cashAmount'] : '';
$change = isset($_GET['change']) ? $_GET['change'] : '';
$paymentMethod = isset($_GET['paymentMethod']) ? $_GET['paymentMethod'] : '';

// Fungsi untuk format harga
function formatHarga($angka)
{
    return "Rp " . number_format($angka, 2, ',', '.');
}
?>
<html>

<head>
    <title>Omah Angkringan - Nota Pembayaran</title>
    <style>
        @page {
            margin: 3mm;
        }
    </style>
    <style>
        hr {
            display: block;
            margin-top: 0.5em;
            margin-bottom: 0.5em;
            margin-left: auto;
            margin-right: auto;
            border-style: inset;
            border-width: 1px;
        }
    </style>
</head>

<body style='font-family:tahoma; font-size:8pt;padding-top:50px'>
    <center>
        <div style="width: 270px;border: 2px solid black">
            <table style='width:230px; font-size:16pt; font-family:calibri; border-collapse: collapspe;' border='0'>
                <tr>
                    <br>
                    <td align="center">
                        <center>
                            <font size=""><b>OMAH ANGKRINGAN</b></font>
                            <br>
                            Kota Pekalongan
                            <br>
                            08213795153
                        </center>
                    </td>
                </tr>
            </table>
            <br>
            -----------------------------------------------------------
            <br>
            <br>
            <table style='width:230px; font-size:12pt; font-family:calibri; border-collapse: collapse;' border='0'>
                <tbody>
                    <tr>
                        <td>Total yang dibayar:</td>
                        <td align="right"><?php echo formatHarga($total); ?></td>
                    </tr>
                    <?php if ($paymentMethod === 'cashModal') : ?>
                        <tr>
                            <td>Jumlah Uang:</td>
                            <td align="right"><?php echo formatHarga($cashAmount); ?></td>
                        </tr>
                        <tr>
                            <td>Kembalian</td>
                            <td align="right"><?php echo formatHarga($change); ?></td>
                        </tr>
                    <?php elseif ($paymentMethod === 'qrisPaymentModal') : ?>
                        <tr>
                            <td>Metode Pembayaran:</td>
                            <td align="right">QRIS</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <br><br>
            <table cellspacing='0' cellpadding='0' style='width:230px; font-size:11pt; font-family:calibri; border-collapse: collapse;'>
                <tr>
                    <th align="center">Terima kasih telah berbelanja
                    </th>
                </tr>
            </table>
            <br>
            <br>
        </div>
    </center>
</body>

</html>
<script>
    window.print();
</script>