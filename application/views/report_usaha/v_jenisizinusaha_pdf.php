<html lang="en">
<head>
<title><?=$filename?></title>
<link href='<?php echo base_url()?>inc/img/logos.png' rel='shortcut icon'>
<style type="text/css">
	body {  
	    font-family: "Source Sans Pro",sans-serif  
	}
	@page {}
     header { position: fixed; left: 0px; top: -180px; right: 0px; height: 150px; background-color: orange; text-align: center; }
     footer { position: fixed; left: 0px; bottom: 0px; right: 0px; height: 30px; background-color: #d0d0d0; padding: 5px 0 5px}
     footer .page:after { content: counter(page, upper-roman); }
     
        .layout-report{
            width:100%;
        }

        .tablereport th{
            font-size:14px;
            text-align: center;
        }
        .tablereport td{
            font-size:12px;
        }
        p { page-break-after: always; }
        .footer { position: fixed; bottom: 0px; right:0px; float:right;}
      	.pagenum:before { content: counter(page); }
</style>
</head>
<body>
    <?php
       $classnya = 'layout-report';
       $align = 'left';
    ?>
	<div class="footer">Page: <span class="pagenum"></span></div>
        <table width="100%">
            <tr>
                <td width="100px"><img src="<?php echo base_url() ?>inc/img/logohp.jpg" width="100px" height="100px"></td>
                <td valign="top" widht="600px"><strong>PEMERINTAHAN KOTA SERANG<br>BADAN PELAYANAN TERPADU DAN PENANAMAN MODAL</strong>
                    <br>Jl. Jendral Sudirman No. 5 Tlp. 0254-203720, Serang-Banten
                </td>
            </tr>
            <tr>
                <td colspan="2"><hr></td>
            </tr>
        </table>
        <center><strong>LAPORAN BULANAN KEGIATAN PELAYANAN</strong></center>
        <table style="font-size: 13px">
            <tr>
                <td colspan="4">&nbsp;</td>
            </tr>
            <tr>
                <td width="100">BIDANG</td>
                <td colspan="2">: &nbsp;&nbsp;&nbsp;&nbsp;PERIZINAN USAHA</td>
            </tr>
            <tr>
                <td width="100"><?=strtoupper($filter_type)?></td>
                <td colspan="2">: &nbsp;&nbsp;&nbsp;&nbsp;<?php
                    if ($filter_type == 'bulan') {
                        echo convert_to_id_month($tgl_bulan);
                    } else {
                        echo convert_to_id($tgl_awal) . ' s/d ' . convert_to_id($tgl_akhir);
                    }
                    ?></td>
            </tr>
            <tr>
                <td width="100">JENIS IZIN</td>
                <td colspan="2">: &nbsp;&nbsp;&nbsp;&nbsp;<?=strtoupper($nameIzin)?></td>
            </tr>
        </table>
        <br>
        <table class="tablereport" border="1" cellspacing="0" cellpadding="0">
        	<thead>
        		<tr>
                    <th  width="30" rowspan="2" bgcolor="#E4E4E4" scope="col">NO</th>
                    <th  colspan="2" bgcolor="#E4E4E4" scope="col">PENDAFTARAN</th>
                    <th  colspan="2" bgcolor="#E4E4E4" scope="col">NAMA</th>
                    <th  width="150" rowspan="2" bgcolor="#E4E4E4" scope="col">ALAMAT</th>
                    <th  width="50" rowspan="2" bgcolor="#E4E4E4" scope="col">KOTA</th>
                    <th  width="100" rowspan="2" bgcolor="#E4E4E4" scope="col">KECAMATAN</th>
                    <th  width="100" rowspan="2" bgcolor="#E4E4E4" scope="col">KETERANGAN</th>
                </tr>
                <tr>
                    <th  width="80" bgcolor="#E4E4E4" scope="col">TANGGAL</th>
                    <th  width="80" bgcolor="#E4E4E4" scope="col">NOMOR</th>
                    <th  width="80" bgcolor="#E4E4E4" scope="col">PERUSAHAAN</th>
                    <th  width="80" bgcolor="#E4E4E4" scope="col">PEMOHON</th>
                </tr>
        	</thead>
            <tbody>
                <?php
                $i = 1;
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
        
        <table width="100%">
            <tr>
                <td>KETERANGAN</td>
            </tr>
            <tr>
                <td width="200px">JUMLAH PELAYANAN</td>
                <td width="400px">: &nbsp;&nbsp;&nbsp;<?=$row_total?> PELAYANAN</td>
                <td colspan="2">Serang</td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td colspan="3">-</td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td colspan="3" align="center">Kepala Badan Pelayanan Terpadu dan Penanaman Modal<br>Kota Serang</td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td colspan="3"><br><br><br>&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td colspan="3" align="center"><strong><u>MAMAT HAMBALI, SH. ,M.SI</u></strong></td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td colspan="3" align="center">NIP : 19610704 198603 1 013</td>
            </tr>
        </table>
</body>
</html>