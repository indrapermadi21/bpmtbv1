<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Tanda Daftar Perusahaan</title>
        <style type="text/css">
            .areamid {text-align: center}
            .h1mid { font-size: 27pt; line-height: 25pt }
            .h2mid { font-size: 20pt; line-height: 20pt }
            .h3mid { font-size: 17pt; line-height: 20pt }
            .alamid { font-size: 16pt; line-height: 20pt }
            
            .isi{
                border-collapse: collapse;
            }
            .isa{
                border-collapse: collapse;
                border: solid;
            }
            
        </style>
    </head>
    <body>
        <table  width="1024px" align="center" style="padding: 1px;">
            <tr>
                <td width="100px" rowspan="4"><img src="<?php echo base_url() ?>inc/img/logo.jpg" style="width: 100px;height: 100px"></td>
                <td>
                    <div class="areamid">
                        <div class="h2mid">PEMERINTAH KOTA SERANG</div>
                        <div class="h1mid">BADAN PELAYANAN PERIZINAN</div>
                        <div class="alamid">Jl. Jend. Sudirman No.5, Kec. Serang, Kota Serang, Banten 42118</div>
                        <div class="h2mid">SERANG</div>
                    </div>
                </td>
            </tr>
        </table>
        <hr>
        <br>
        <div style="text-align: center;">
            <div class="areamid">
                <div class="h1mid">TANDA DAFTAR PERUSAHAAN</div>
                <div class="h2mid"><?php echo strtoupper($type->tipe_perusahaan);?></div>
                <br>
                <div class="h3mid">BERDASARKAN<br>
                    UNDANG-UNDANG REPUBLIK INDONESIA NOMOR 3 TAHUN 1982<br>
                    TENTANG WAJIB DAFTAR PERUSAHAAN</div>
            </div>
        </div>
        <br>
        <table class="isa" width="1024px" align="center" style="padding: 1px;">
            <tr>
                <td style="width:300px;"><strong><center>NOMOR TDP</center></strong></td>
                <td style="width:250px;"><strong><center>BERLAKU S/D TGL</center></strong></td>
                <td style="width:250px;"><strong><center>PENDAFTARAN</center></strong></td>
                <td style="width:10px;"><strong><center>:</center></strong></td>
                <td style="width:150px;"><strong><center><?php echo $pendaftaran?></center></strong></td>
            </tr>
            <tr>
                <td ><strong><center><?php echo $results->no_registrasi?></center></strong></td>
                <td ><strong><center><?php echo $results->tgl_berlaku?></center></strong></td>
                <td ><strong><center>PEMBARUAN KE</center></strong></td>
                <td ><strong><center>:</center></strong></td>
                <td ><strong><center><?php echo $pembaruan?></center></strong></td>
            </tr>
        </table>
        <br>
        <table class="isi" border="1" width="1024px" align="center">
            <tr>
                <td style="widht:10%;height: 50px;border: solid;padding: 5px" rowspan="2" valign="top"><strong>NAMA PERUSAHAAN</strong></td>
                <td style="widht:5%;border: solid;padding: 5px" rowspan="2" valign="top"><strong>:</strong></td>
                <td style="width:50%;border: solid;padding: 5px"rowspan="2" valign="top"><?php echo $results->nama_perusahaan?></td>
                <td style="widht:35%;border: solid;padding: 5px" class="areamid"><strong> STATUS :</strong></td>
            </tr>
            <tr>
                <td style="border: solid;padding: 5px"><strong><center><?php echo $status->status_perusahaan?></center></strong></td>
            </tr>
            <tr>
                <td style="height: 50px;border: solid;padding: 5px" valign="top"><strong>NAMA PENGURUS / PENANGGUNG JAWAB</strong></td>
                <td style="border: solid;padding: 5px" valign="top"><strong>:</strong></td>
                <td style="border: solid;padding: 5px" colspan="2" valign="top"><strong><?php echo $results->penanggung_jawab?></strong></td>
            </tr>
            <tr>
                <td style="height: 50px;border: solid;padding: 5px" valign="top"><strong>ALAMAT PERUSAHAAN</strong></td>
                <td style="border: solid;padding: 5px" valign="top"><strong>:</strong></td>
                <td style="border: solid;padding: 5px" colspan="2" valign="top"><strong><?php echo $results->alamat?></strong></td>
            </tr>
            <tr>
                <td style="height: 50px;border: solid;padding: 5px" valign="top"><strong>NPWP</strong></td>
                <td style="border: solid;padding: 5px" valign="top"><strong>:</strong></td>
                <td style="border: solid;padding: 5px" colspan="2" valign="top"><strong><?php echo $results->npwp?></strong></td>
            </tr>
            <tr>
                <td style="height: 50px;border: solid;padding: 5px" valign="top"><strong>NOMOR TELEPON</strong></td>
                <td style="border: solid;padding: 5px" valign="top"><strong>:</strong></td>
                <td style="border: solid;padding: 5px" colspan="2" valign="top"><strong><?php echo $results->no_telp?></strong></td>
            </tr>
            <tr>
                <td style="height: 50px;border: solid;padding: 5px" rowspan="2" valign="top"><strong>KEGIATAN USAHA POKOK</strong></td>
                <td style="border: solid;padding: 5px" rowspan="2" valign="top"><strong>:</strong></td>
                <td style="border: solid;padding: 5px" rowspan="2" valign="top"><strong><?php echo $results->keg_up?></strong></td>
                <td style="border: solid;padding: 5px" valign="top"><strong><center>KBLI</center></strong></td>
            </tr>
            <tr>
                <td style="border: solid;padding: 5px" ><center><?php echo $results->kbli?></center></td>
            </tr>
        </table>
        <br><br>
        <table style="width: 1024px;border: 1" align="center">
            <tr>
                <td style="width: 30%"></td>
                <td style="width: 30%"></td>
                <td style="width: 40%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Serang, </td>
            </tr>
            <tr>
                <td >&nbsp;</td>
                <td >&nbsp;</td>
                <td >&nbsp;</td>
            </tr>
            <tr>
                <td >&nbsp;</td>
                <td ></td>
                <td ><strong>a.n WALIKOTA SERANG</strong> </td>
            </tr>
            <tr>
                <td >&nbsp;</td>
                <td >&nbsp;</td>
                <td ><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kepala Badan Pelayanan Perizinan</strong></td>
            </tr>
            <tr>
                <td >&nbsp;</td>
                <td >&nbsp;</td>
                <td >&nbsp;</td>
            </tr>
            <tr>
                <td >&nbsp;</td>
                <td >&nbsp;</td>
                <td >&nbsp;</td>
            </tr>
            <tr>
                <td >&nbsp;</td>
                <td >&nbsp;</td>
                <td >&nbsp;</td>
            </tr>
            <tr>
                <td ></td>
                <td ></td>
                <td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><u>Nama Pejabat</u></strong></td>
            </tr>
            <tr>
                <td ></td>
                <td ></td>
                <td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Jabatan</strong></td>
            </tr>
            <tr>
                <td ></td>
                <td ></td>
                <td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>NIP : nip_pejabat</strong></td>
            </tr>
        </table>
    </body>
</html>
