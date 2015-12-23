<style type="text/css">
        .layout-report{
            width:100%;
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

        <table align="<?php echo $align ?>" width="100%">
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
                <td>PERIODE</td>
                <td>:</td>
                <td><?php echo convert_to_id($tgl_awal,FALSE).' Sampai '.convert_to_id($tgl_akhir,FALSE)?></td>
            </tr>
            <tr>
                <td>JENIS IZIN</td>
                <td>:</td>
                <td>SURAT IZIN USAHA PERDAGANGAN</td>
            </tr>
        </table>
        <br>
        <table align="<?php echo $align ?>" class="tablereport" width="1200" border="1" cellspacing="0" cellpadding="0">
            <tbody>
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
                $i = $row_start;
                foreach ($results as $r) {
                    ?>
                    <tr>
                        <td style="padding: 5px"><?php echo $i ?></td>
                        <td style="padding: 5px"><?php echo convert_to_id($r['tgl_pembuatan'],FALSE) ?></td>
                        <td style="padding: 5px"><?php echo $r['no_pelayanan'] ?></td>
                        <td style="padding: 5px"><?php echo $r['nama_perusahaan'] ?></td>
                        <td style="padding: 5px"><?php echo $r['penanggung_jawab'] ?></td>
                        <td style="padding: 5px"><?php echo $r['alamat'] ?></td>
                        <td style="padding: 5px"><?php echo $r['kota'] ?></td>
                        <td style="padding: 5px"><?php echo $r['kecamatan'] ?></td>
                        <td style="padding: 5px">Non Retribusi</td>
                    </tr>
                    <?php
                    $i++;
                }
                ?>
            </tbody>
        </table>
        <br><br>
        
        <table width="1100px" align="<?php echo $align?>">
            <tr>
                <td>KETERANGAN</td>
            </tr>
            <tr>
                <td width="200px">JUMLAH PELAYANAN</td>
                <td width="50px">:</td>
                <td width="400px"><span id="jumlah_pelayanan"></span> PELAYANAN</td>
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
