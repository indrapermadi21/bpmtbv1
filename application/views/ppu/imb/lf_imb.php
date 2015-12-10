<script type="text/javascript">

    $(document).ready(function () {
        var panel_list = $('#panel_list');
        var panel_form = $('#panel_form');

        $(".datepicker").datepicker({
            changeMonth: true,
            changeYear: true
        }).on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });

        //init 
        panel_form.hide();
        $('#imb_table').dataTable();
        
        $('#btn_cari').click(function () {
            var data = {
                tgl_awal : $('#tgl_awal').val(),
                tgl_akhir : $('#tgl_akhir').val()
            };
            
            $.post('<?php echo base_url() ?>c_ppu/tdp/setSession', data, function () {
                window.location.href = '<?php echo base_url() ?>c_ppu/imb';
            });
        });
        
        $('#btn_reset_cari').click(function(){
            var data = {
                tgl_awal : $('#tgl_awal').val(),
                tgl_akhir : $('#tgl_akhir').val()
            };
            
            $.post('<?php echo base_url() ?>c_ppu/tdp/unsetSession', data, function () {
                window.location.href = '<?php echo base_url() ?>c_ppu/imb';
            });
        });
    });

    //kembali ke tampillan tabel 
    function back_grid() {
        $('#panel_form').hide();
        $('#panel_list').show();
    }


    //memunculkan form menu
    function create_imb() {
        $('#form_imb').trigger('reset');
        $('#form_status').val('add');
        $('#jenis_perizinan').val('IZIN MENDIRIKAN BANGUNAN');
        $('#panel_form').show();
        $('#panel_list').hide();
    }

    //fungsi untuk proses save data
    function save_imb() {
        var data = {
            jenis_perizinan: $('#jenis_perizinan').val(),
            tgl_pembuatan: $('#tgl_pembuatan').val(),
            no_pelayanan: $('#no_pelayanan').val(),
            keterangan: $('#keterangan').val(),
            type_imb: $('#type_imb').val(),
            nama: $('#nama').val(),
            alamat: $('#alamat').val(),
            kota: $('#kota').val(),
            kecamatan: $('#kecamatan').val(),
            kelurahan: $('#kelurahan').val(),
            fungsi_bangunan: $('#fungsi_bangunan').val(),
            penanggung_jawab: $('#penanggun_jawab').val(),
            alamat_bangunan: $('#alamat_bangunan').val(),
            lokasi_kota: $('#lokasi_kota').val(),
            lokasi_kec: $('#lokasi_kec').val(),
            lokasi_kel: $('#lokasi_kel').val(),
            sempadan: $('#sempadan').val(),
            as_jalan: $('#as_jalan').val(),
            sempadan_pagar: $('#sempadan_pagar').val(),
            as_jalan_pagar: $('#as_jalan_pagar').val(),
            luas_a: $('#luas_a').val(),
            luas_b: $('#luas_b').val(),
            luas_c: $('#luas_c').val(),
            luas_d: $('#luas_d').val(),
            sarana_a: $('#sarana_a').val(),
            sarana_b: $('#sarana_b').val(),
            sarana_c: $('#sarana_c').val(),
            sarana_d: $('#sarana_d').val(),
            tgl_penetapan: $('#tgl_penetapan').val(),
            no_registrasi: $('#no_registrasi').val(),
            nama_pejabat: $('#nama_pejabat').val(),
            jabatan: $('#jabatan').val(),
            nip: $('#nip').val(),
            jumlah_retribusi: $('#jumlah_retribusi').val(),
            id_imb: $('#id_imb').val(),
            form_status: $('#form_status').val()
        };

        $.post('<?php echo base_url() ?>c_ppu/imb/save', data, function (r) {
            if (r.success) {
                window.location.href = '<?php echo base_url() ?>c_ppu/imb';
            }
        }, 'json');
    }

    function edit_imb(el) {

        $.post('<?php echo base_url() ?>c_ppu/imb/getImb', {
            id_imb: el
        }, function (r) {
            if (r.success) {
                $('#jenis_perizinan').val(r.data.jenis_perizinan);
                $('#tgl_pembuatan').val(r.data.tgl_pembuatan),
                $('#no_pelayanan').val(r.data.no_pelayanan),
                $('#keterangan').val(r.data.keterangan),
                $('#typ_imb').val(r.data.type_imb),
                $('#nama').val(r.data.nama),
                $('#alamat').val(r.data.alamat),
                $('#kota').val(r.data.kota),
                $('#kecamatan').val(r.data.kecamatan),
                $('#kelurahan').val(r.data.kelurahan),
                $('#fungsi_bangunan').val(r.data.fungsi_bangunan),
                $('#penanggung_jawab').val(r.data.penanggung_jawab),
                $('#alamat_bangunan').val(r.data.alamat_bangunan),
                $('#lokasi_kota').val(r.data.lokasi_kota),
                $('#lokasi_kec').val(r.data.lokasi_kec),
                $('#lokasi_kel').val(r.data.lokasi_kel),
                $('#lokasi_kel').val(r.data.lokasi_kel),
                $('#sempadan').val(r.data.sempadan),
                $('#as_jalan').val(r.data.as_jalan),
                $('#sempadan_pagar').val(r.data.sempadan_pagar),
                $('#as_jalan_pagar').val(r.data.as_jalan_pagar),
                $('#luas_a').val(r.data.luas_a),
                $('#luas_b').val(r.data.luas_b),
                $('#luas_c').val(r.data.luas_c),
                $('#luas_d').val(r.data.luas_d),
                $('#sarana_a').val(r.data.sarana_a),
                $('#sarana_b').val(r.data.sarana_b),
                $('#sarana_c').val(r.data.sarana_c),
                $('#sarana_d').val(r.data.sarana_d),
                $('#tgl_penetapan').val(r.data.tgl_penetapan),
                $('#no_registrasi').val(r.data.no_registrasi),
                $('#nama_pejabat').val(r.data.nama_pejabat),
                $('#jabatan').val(r.data.jabatan),
                $('#nip').val(r.data.nip),
                $('#jumlah_retribusi').val(r.data.jumlah_retribusi),
                $('#id_imb').val(r.data.id_imb);
                $('#form_status').val('edit');
                $('#panel_list').hide();
                $('#panel_form').show();
            }
        }, 'json');
    }

    function remove_imb(el) {
        $.post('<?php echo base_url() ?>c_ppu/imb/delete', {
            id_imb: el
        }, function () {
            window.location.href = '<?php echo base_url() ?>c_ppu/imb';
        },'json');
    }
</script>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header">
                    <!--strong><center><h2>Menu</h2></center></strong-->
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <div id="panel_list" class="panel panel-default">
                        <div class="panel-heading">
                            <a href="#" id="create_imb" class="btn btn-info" onclick="create_imb()"><i class="fa fa-plus-square fa"></i></a>
                            <div style="float: right"><strong>Tanggal</strong> <input type="text" id="tgl_awal" class="datepicker" value="<?php echo $tgl_awal?>"> - <input type="text" id="tgl_akhir" class="datepicker" value="<?php echo $tgl_akhir?>"> <button id="btn_cari" class="btn btn-info"><i class="fa fa-search"></i></button> <button id="btn_reset_cari" class="btn btn-warning"><i class="fa fa-remove"></i></button></div>
                        </div>
                        <div class="panel-body">
                            <div style="text-align: center"><h3>Izin Mendirikan Bangunan</h3></div>
                            <div class="show_message"></div>
                            <table id="imb_table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 20px">No.</th>
                                        <th style="width: 150px;">Nomor Pelayanan</th>
                                        <th style="width: 150px;">No Registrasi</th>
                                        <th style="width: 150px;">Tgl Buat</th>
                                        <th style="width: 150px;">Nama </th>
                                        <th style="width: 150px;">Kota</th>
                                        <th style="width: 5px;"></th>
                                        <th style="width: 5px;"></th>
                                        <th style="width: 5px;"></th>
                                        <th style="width: 5px;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($listImb as $r) {
                                        if ($r['status'] == 1) {
                                            $color = 'red';
                                        } else {
                                            $color = 'black';
                                        }
                                        ?>
                                        <tr>
                                            <td><font color="<?php echo $color?>"><?php echo $i ?></font></td>
                                            <td><font color="<?php echo $color?>"><?php echo $r['no_pelayanan'] ?></font></td>
                                            <td><font color="<?php echo $color?>"><?php echo $r['no_registrasi'] ?></font></td>
                                            <td><font color="<?php echo $color?>"><?php echo $r['tgl_pembuatan'] ?></font></td>
                                            <td><font color="<?php echo $color?>"><?php echo $r['nama'] ?></font></td>
                                            <td><font color="<?php echo $color?>"><?php echo $r['kota'] ?></font></td>
                                            <td>
                                                <?php if ($r['status'] != 1) { ?>
                                                <button class="btn btn-info" type="button" id="edit_imb" onclick="edit_imb(<?php echo $r['id_imb'] ?>)"><i class="fa fa-pencil"></i></button>
                                                <?php } else { ?>
                                                    <div style="text-align: center">-</div>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php if ($r['status'] != 1) { ?>
                                                    <button class="btn btn-warning" type="button" id="remove_imb" onclick="remove_imb(<?php echo $r['id_imb'] ?>)"><i class="fa fa-trash"></i></button>
                                                <?php } else { ?>
                                                    <div style="text-align: center">-</div>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <button class="btn btn-success" type="button" id="print" onclick="print_imb(<?php echo $r['id_imb'] ?>, '')"><i class="fa fa-print"></i></button>
                                            </td>
                                            <td>
                                                <button class="btn btn-primary" type="button" id="print" onclick="print_imb(<?php echo $r['id_imb'] ?>, 'doc')"><i class="fa fa-file-word-o"></i></button>
                                            </td>
                                        </tr>
                                        <?php
                                        $i++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>



                    <div id="panel_form" class="panel panel-default">
                        <div class="panel-heading">
                            <button class="btn btn-primary" id="back_grid" onclick="back_grid()"><i class="fa fa-table"></i></button>
                            <button class="btn btn-primary" id="save_imb" onclick="save_imb()"><i class="fa fa-save"></i></button>
                        </div>
                        <div class="panel-body">
                            <div class="show_error"></div>
                            <form id="form_imb">

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Input Izin
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <label for="jenis_perizinan">Jenis Perizinan : </label>
                                            </div>
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control input-sm" id="jenis_perizinan"/>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <label for="tgl_pembuatan">Tgl. Pembuatan : </label>
                                            </div>
                                            <div class="col-lg-2">
                                                <input type="hidden" id="form_status" >
                                                <input type="hidden" id="id_imb" >
                                                <input type="text" class="form-control input-sm datepicker" id="tgl_pembuatan"/>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <label for="no_pelayanan">No. Pelayanan : </label>
                                            </div>
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control input-sm" id="no_pelayanan"/>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <label for="keterangan">Keterangan : </label>
                                            </div>
                                            <div class="col-lg-4">
                                                <textarea class="form-control input-sm" id="keterangan"></textarea>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <label for="type_imb">Type IMB : </label>
                                            </div>
                                            <div class="col-lg-4">
                                                <select class="form-control" id="type_imb">
                                                    <option value="0">-- Pilih --</option>
                                                    <option value="1">IMB</option>
                                                    <option value="2">IMB Bersyarat</option>
                                                    <option value="3">IMB Bersyarat</option>
                                                    <option value="4">IMB Bersyarat Sementara Berjangka</option>
                                                    <option value="5">Izin Khusus</option>
                                                </select>
                                            </div>
                                        </div>
                                        <br/>
                                        <br/>
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a data-toggle="tab" href="#info_perusahaan">Informasi Perusahaan</a></li>
                                            <li><a data-toggle="tab" href="#info_lain">Informasi Lainnya</a></li>
                                            <li><a data-toggle="tab" href="#info_penetapan">Informasi Penetapan</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div id="info_perusahaan" class="tab-pane fade in active">
                                                <br><br>
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <label for="nama_perusahaan">Nama : </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="text" class="form-control input-sm" id="nama_perusahaan"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <label for="alamat_perusahaan">Alamat : </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <textarea class="form-control input-sm" id="alamat_perusahaan"></textarea>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <label for="kota">Kota : </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="text" class="form-control input-sm" id="kota"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <label for="kecamatan">Kecamatan : </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="text" class="form-control input-sm" id="kecamatan"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <label for="kelurahan">Kelurahan : </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="text" class="form-control input-sm" id="kelurahan"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <label for="fungsi_bangungan">Fungsi Bangungan : </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <textarea class="form-control input-sm" id="fungsi_bangunan"></textarea>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <label for="penanggung_jawab">Penanggung Jawab : </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="text" class="form-control input-sm" id="penanggung_jawab" placeholder="No. Telp"/>
                                                    </div>
                                                </div>
                                                <br/>
                                            </div>
                                            <div id="info_lain" class="tab-pane fade">
                                                <br><br>
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <label for="lokasi_bangunan">Lokasi Bangunan </label>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <label for="alamat_bangunan">Alamat : </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <textarea class="form-control input-sm" id="alamat_bangunan"></textarea>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <label for="lokasi_kota">Kota : </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="text" class="form-control input-sm" id="lokasi_kota"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <label for="lokasi_kec">Kecamatan : </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="text" class="form-control input-sm" id="lokasi_kec"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <label for="lokasi_kel">Kelurahan : </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="text" class="form-control input-sm" id="lokasi_kel"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <label for="bidang_pekerjaan">Garis sempadan dan Bangunan : </label>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <label for="sempadan">Sempadan Bangunan (M2) : </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="text" class="form-control input-sm" id="sempadan"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <label for="as_jalan">Dari As Jalan : </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <textarea class="form-control input-sm" id="as_jalan"></textarea>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <label for="sempadan_pagar">Sempadan Pagar (M2) : </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="text" class="form-control input-sm" id="sempadan_pagar"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <label for="as_jalan_pagar">Dari As Jalan : </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <textarea class="form-control input-sm" id="as_jalan_pagar"></textarea>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <label for="luas_bangunan_terdiri">Luas Bangunan Terdiri dari  : </label>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-2"></div>
                                                    <div class="col-lg-1">
                                                        <label for="luas_a">A : </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <textarea class="form-control input-sm" id="luas_a"></textarea>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-2"></div>
                                                    <div class="col-lg-1">
                                                        <label for="luas_b">B : </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <textarea class="form-control input-sm" id="luas_b"></textarea>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-2"></div>
                                                    <div class="col-lg-1">
                                                        <label for="luas_c">C : </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <textarea class="form-control input-sm" id="luas_c"></textarea>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-2"></div>
                                                    <div class="col-lg-1">
                                                        <label for="luas_d">D : </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <textarea class="form-control input-sm" id="luas_d"></textarea>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <label for="bangunan_sarana_terdiri">Bangunan Sarana Terdiri dari : </label>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-2"></div>
                                                    <div class="col-lg-1">
                                                        <label for="sarana_a">A : </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <textarea class="form-control input-sm" id="sarana_a"></textarea>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-2"></div>
                                                    <div class="col-lg-1">
                                                        <label for="sarana_b">B : </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <textarea class="form-control input-sm" id="sarana_b"></textarea>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-2"></div>
                                                    <div class="col-lg-1">
                                                        <label for="sarana_c">C : </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <textarea class="form-control input-sm" id="sarana_c"></textarea>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-2"></div>
                                                    <div class="col-lg-1">
                                                        <label for="sarana_d">D : </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <textarea class="form-control input-sm" id="sarana_d"></textarea>
                                                    </div>
                                                </div>
                                                <br/>
                                            </div>
                                            <div id="info_penetapan" class="tab-pane fade">
                                                <br><br>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label >Ditetapkan di Serang tanggal : </label>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <label for="tgl_penetapan">Tanggal : </label>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <input type="text" class="form-control input-sm datepicker" id="tgl_penetapan"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <label for="no_registrasi">Nomor Registrasi : </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="text" class="form-control input-sm" id="no_registrasi"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <label for="nama_pejabat">Nama Pejabat : </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="text" class="form-control input-sm" id="nama_pejabat"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <label for="jabatan">Jabatan : </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="text" class="form-control input-sm" id="jabatan"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <label for="nip">NIP: </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="text" class="form-control input-sm" id="nip"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <label for="jumlah_retribusi">Jumlah Retribusi : </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="text" class="form-control input-sm" id="jumlah_retribusi"/>
                                                    </div>
                                                </div>
                                                <br/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>


                </div><!-- /.box-body -->

            </div><!-- /.box -->
        </div>                
    </div><!--/.row-->

</section><!-- /.content -->