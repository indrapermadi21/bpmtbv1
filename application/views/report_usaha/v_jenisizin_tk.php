<head>
    <style type="text/css">
        .layout-report{
            width:1100px;

        }

        .layout-report{
            width:1100px;
            height: auto;
            overflow-x: scroll;
        }

        .tablereport th{
            font-size:14px;
            text-align: center;
        }
        .tablereport td{
            font-size:12px;
        }
    </style>
</head>
<body>
    <?php
    if (!$type) {
        $classnya = 'layout-report';
        $align = 'left';
    } else {
        $classnya = 'layout-report2';
        $align = 'center';
    }
    ?>
    <div class="<?php echo $classnya ?>">

        <table align="<?php echo $align ?>" width="700px">
            <tr>
                <td width="100px"><img src="<?php echo base_url() ?>inc/img/logohp.jpg" width="100px" height="100px"></td>
                <td valign="top" widht="600px"><strong>PEMERINTAHAN KOTA SERANG<br>BADAN PELAYANAN TERPADU DAN PENANAMAN MODAL</strong>
                    <br>Jl. Jendral Sudirman No. 5 Tlp. 0254-203720, Serang-Banten
                </td>
            </tr>
            <tr>
                <td colspan="2"><hr></td>
            </tr>
        </table><br>
        <table align="<?php echo $align ?>" width="800px">
            <tr>
                <td align="center" colspan="4"><strong>LAPORAN BULANAN KEGIATAN PELAYANAN</strong></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td width="200px">BIDANG</td>
                <td width="50px">:</td>
                <td width="350px">PERIZINAN USAHA</td>
                <td width="400px"></td>
            </tr>
            <tr>
                <td><?php echo strtoupper($filter_type); ?></td>
                <td>:</td>
                <td colspan="2">
                    <?php
                    if ($filter_type == 'bulan') {
                        echo getBulan($tgl_bulan);
                    } else {
                        echo getTglBulan($tgl_awal) . ' s/d ' . getTglBulan($tgl_akhir);
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td>JENIS IZIN</td>
                <td>:</td>
                <td><?php echo getNamaIzin($jenis_perizinan) ?></td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
        </table>
    
    <?php
    foreach ($typeIzin as $key => $value) {
        ?>
        <table align="<?php echo $align ?>" class="tablereport" width="1200" border="1" cellspacing="0" cellpadding="0">
            <tbody>
            <caption style="text-align: left">Type : <?php echo $value ?></caption>
            <tr>
                <th  width="50" rowspan="2" bgcolor="#E4E4E4" scope="col">NO</th>
                <th  colspan="2" bgcolor="#E4E4E4" scope="col">PENDAFTARAN</th>
                <th  colspan="2" bgcolor="#E4E4E4" scope="col">NAMA</th>
                <th  width="150" rowspan="2" bgcolor="#E4E4E4" scope="col">ALAMAT</th>
                <th  width="150" rowspan="2" bgcolor="#E4E4E4" scope="col">KOTA</th>
                <th  width="150" rowspan="2" bgcolor="#E4E4E4" scope="col">KECAMATAN</th>
                <th  width="150" rowspan="2" bgcolor="#E4E4E4" scope="col">KETERANGAN</th>
            </tr>
            <tr>
                <th  width="100" bgcolor="#E4E4E4" scope="col">TANGGAL</th>
                <th  width="150" bgcolor="#E4E4E4" scope="col">NOMOR</th>
                <th  width="150" bgcolor="#E4E4E4" scope="col">PERUSAHAAN</th>
                <th  width="150" bgcolor="#E4E4E4" scope="col">PEMOHON</th>
            </tr>
            <?php
            $totalnya = 0;
            foreach ($listKecamatan as $row) {
                ?>
                <tr>
                    <td colspan="9"><strong>Kecamatan : <?php echo $row['kecamatan'] ?></strong></td>
                </tr>
                <?php
                $i = 1;
                $total=0;
                foreach ($results as $r) {
                    if ($r['type'] == $key && $r['kecamatan'] == $row['kd_kecamatan']) {
                        ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $r['tgl_pembuatan'] ?></td>
                            <td><?php echo $r['no_pelayanan'] ?></td>
                            <td><?php echo $r['nama_perusahaan'] ?></td>
                            <td><?php echo $r['penanggung_jawab'] ?></td>
                            <td><?php echo $r['alamat'] ?></td>
                            <td><?php echo $r['kota'] ?></td>
                            <td><?php echo $r['kecamatan'] ?></td>
                            <td><?php echo $r['keterangan'] ?></td>
                        </tr>
                        <?php
                        $i++;
                        $total = $total + 1;
                    }
                }
                $totalnya = $totalnya + $total;
            }
            ?>
            </tbody>
        </table>
        <br><br>
        <table width="1100px">
            <tr>
                <td width="200px">JUMLAH PELAYANAN</td>
                <td width="50px">:</td>
                <td width="400px"><?php echo $totalnya ?> PELAYANAN</td>
            </tr>
        </table>
        <br>
    <?php
}
?>
    <br><br>

    <table width="1100px" align="<?php echo $align ?>">
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td width="200px">&nbsp;</td>
            <td width="50px">&nbsp;</td>
            <td width="400px">&nbsp;</td>
            <td colspan="3">Serang</td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td colspan="3">-</td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td colspan="3" align="center">Kepala Badan Pelayanan Terpadu dan Penanaman Modal<br>Kota Serang</td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td colspan="3"><br><br><br><br><br>&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td colspan="3" align="center"><strong><u>MAMAT HAMBALI, SH. ,M.SI</u></strong></td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td colspan="3" align="center">NIP : 19610704 198603 1 013</td>
        </tr>
    </table>
</div>
</body>
