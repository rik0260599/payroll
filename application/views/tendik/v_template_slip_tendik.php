<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
    table {
        border-collapse: collapse;
    }

    td {
        vertical-align: top;
    }

    body {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 11;
    }
    </style>
</head>

<body style=" font-family: Arial;">
    <table width="100%">
        <tr>
            <td colspan="6">
                <h1>LOGO Universitas XYZ</h1>
            </td>
        </tr>
        <tr>
            <th colspan="6">
                SLIP GAJI TENAGA KEPENDIDIKAN<br>
                BULAN <?= bulan_indonesia2($tendik['periode']); ?>
                <br>
                <br>
            </th>
        </tr>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td><?= $tendik['nama_karyawan']; ?></td>
            <td>Bank</td>
            <td>:</td>
            <td><?= $tendik['nama_bank']; ?></td>
        </tr>
        <tr>
            <td>NIP</td>
            <td>:</td>
            <td><?= $tendik['nip']; ?></td>
            <td>No Rekenig</td>
            <td>:</td>
            <td><?= $tendik['no_rek']; ?></td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td><?= $tendik['jabatan']; ?></td>

            <td>Periode</td>
            <td>:</td>
            <td><?= tanggal_indonesia2($tendik['periode']); ?></td>
        </tr>
    </table>
    <table width="100%" style=" margin-top: 50px;">
        <tr>
            <td>
                <table width="100%">
                    <tr style="border-top :1px solid black; border-bottom :1px solid black;">
                        <td colspan="3">PENGHASILAN</td>
                    </tr>
                    <tr>
                        <td>Gaji Pokok</td>
                        <td>:</td>
                        <td style=" text-align: right;"><?= number_format($tendik['gaji_pokok'],2, ".", ","); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Tunjangan Jabatan Fungsional</td>
                        <td>:</td>
                        <td style=" text-align: right;">
                            <?= number_format($tendik['t_jabatan_fungsional'],2, ".", ","); ?></td>
                    </tr>
                    <tr>
                        <td>Tunjangan Pendidikan Khusus S3</td>
                        <td>:</td>
                        <td style=" text-align: right;">
                            <?= number_format($tendik['t_pendidikan_s3'],2, ".", ","); ?></td>
                    </tr>
                    <tr>
                        <td>Tunjangan Kehadiran</td>
                        <td>:</td>
                        <td style=" text-align: right;">
                            <?= number_format($tendik['tunjangan_kehadiran'],2, ".", ","); ?></td>
                    </tr>
                    <tr>
                        <td>Tunjangan Makan</td>
                        <td>:</td>
                        <td style=" text-align: right;">
                            <?= number_format($tendik['tunjangan_makan'],2, ".", ","); ?></td>
                    </tr>
                    <tr>
                        <td>Tunjangan Jabatan Struktural</td>
                        <td>:</td>
                        <td style=" text-align: right;">
                            <?= number_format($tendik['t_jabatan_struktural'],2, ".", ","); ?></td>
                    </tr>
                    <tr>
                        <td>Tunjangan Jabatan Rangkap</td>
                        <td>:</td>
                        <td style=" text-align: right;">
                            <?= number_format($tendik['t_jabatan_rangkap'],2, ".", ","); ?></td>
                    </tr>
                    <tr>
                        <td>BPJS TK (Yayasan)
                            <?= number_format($tendik['bpjs_yayasan_ketnaker'],2, ".", ","); ?>%
                            <b>*)</b>
                        </td>
                        <td>:</td>
                        <td style=" text-align: right;">
                            <?= number_format($tendik['bpjs_yayasan_ketnaker_biaya'],2, ".", ","); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>BPJS Kesehatan (yayasan)
                            <?= number_format($tendik['bpjs_yayasan_kesehatan'],2, ".", ","); ?>%
                            <b>*)</b>
                        </td>
                        <td>:</td>
                        <td style=" text-align: right;">
                            <?= number_format($tendik['bpjs_yayasan_kesehatan_biaya'],2, ".", ","); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Penyesuaian (Transisi)</td>
                        <td>:</td>
                        <td style=" text-align: right;">
                            <?= number_format($tendik['transisi'],2, ".", ","); ?></td>
                    </tr>
                    <tr style="border-top :1px solid black; border-bottom :1px solid black;">
                        <td><b>Total Penerimaan</b></td>
                        <td>:</td>
                        <td style=" text-align: right;">
                            <b><?= number_format($tendik['total_terima'],2, ".", ",");  ?></b>
                        </td>
                    </tr>
                    <tr style="padding : 100px;">
                        <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr style="border-top :1px solid black; border-bottom :1px solid black;">
                        <td><b>Total Gaji Diterima (<i>Take Home Pay</i>)</b></td>
                        <td>:</td>
                        <td style=" text-align: right;">
                            <b><?= $tendik['total']; ?></b>
                        </td>
                    </tr>

                </table>
            </td>
            <td>
                <table width="100%" style="margin-left:5px;">

                    <tr style="border-top :1px solid black; border-bottom :1px solid black;">
                        <td class="text-left" colspan="2">POTONGAN</td>
                    </tr>
                    <tr>
                        <td>Pajak <b>*)</b></td>
                        <td style=" text-align: right;">
                            <?= number_format($tendik['bpjs_pribadi_ketnaker_biaya'],2, ".", ","); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>PPH 21 DTP</td>
                        <td style=" text-align: right;">
                            <?= number_format($tendik['bpjs_pribadi_ketnaker_biaya'],2, ".", ","); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>BPJS TK (Pribadi)
                            <?= number_format($tendik['bpjs_pribadi_ketnaker'],2, ".", ","); ?>%</td>
                        <td style=" text-align: right;">
                            <?= number_format($tendik['bpjs_pribadi_ketnaker_biaya'],2, ".", ","); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>BPJS Kesehatan (Pribadi)
                            <?= number_format($tendik['bpjs_pribadi_kesehatan'],2, ".", ","); ?>%</td>
                        <td style=" text-align: right;">
                            <?= number_format($tendik['bpjs_pribadi_kesehatan_biaya'],2, ".", ","); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Pinjaman</td>
                        <td style=" text-align: right;">
                            <?= number_format($tendik['bpjs_pribadi_kesehatan_biaya'],2, ".", ","); ?>
                        </td>
                    </tr>
                    <tr style="border-top :1px solid black; border-bottom :1px solid black;">
                        <td><b>Total Potongan</b></td>
                        <td style=" text-align: right;">
                            <b><?= $tendik['total']; ?></b>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
        <tr style="padding : 100px;">
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2">*)langsung disetorkan ke Pemerintah</td>
        </tr>
        <tr style="padding : 100px;">
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2">
                <h4>CATATAN</h4> Mohon menyimpan slip gaji dengan baik. Kelalaian dalam menyimpan slip gaji dianggap
                sebuah pelanggaran
                pengungkapan informasi rahasia karena slip gaji bersifat <b><i>confidential</i></b>
            </td>
        </tr>
        <tr style="padding : 100px;">
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2">
                Kontak Email :<br>
                sdm@xyz.xyz.z
            </td>
        </tr>
        <tr style="padding : 100px;">
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                Diketahui Oleh<br>
                <b>Jabatan</b><br><br><br><br><br><br>
                <b>nama</b>
            </td>
        </tr>
    </table>
</body>

</html>