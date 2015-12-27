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
        $('#perluasan_table').dataTable();

        $('#btn_cari').click(function () {
            var data = {
                tgl_awal: $('#tgl_awal').val(),
                tgl_akhir: $('#tgl_akhir').val()
            };

            $.post('<?php echo base_url() ?>c_ppu/tdp/setSession', data, function () {
                window.location.href = '<?php echo base_url() ?>c_ppu/perluasan';
            });
        });

        $('#btn_reset_cari').click(function () {
            var data = {
                tgl_awal: $('#tgl_awal').val(),
                tgl_akhir: $('#tgl_akhir').val()
            };

            $.post('<?php echo base_url() ?>c_ppu/tdp/unsetSession', data, function () {
                window.location.href = '<?php echo base_url() ?>c_ppu/perluasan';
            });
        });

        // change kecamatan 
        $('#kecamatan').change(function () {
            $.post("<?php echo base_url(); ?>globals/getRefKelurahan/", {
                kd_kecamatan: $('#kecamatan').val()
            }, function (obj) {
                $('#kelurahan').html(obj);
            });
        });

        // change lokasi kecamatan 
        $('#lokasi_kec').change(function () {
            $.post("<?php echo base_url() ?>globals/getRefKelurahan/", {
                kd_kecamatan: $('#lokasi_kec').val()
            }, function (obj) {
                $('#lokasi_kel').html(obj);
            });

        });




    });

    //kembali ke tampillan tabel 
    function back_grid() {
        $('#panel_form').hide();
        $('#panel_list').show();
    }


    //memunculkan form menu
    function create_perluasan() {
        $('#form_perluasan').trigger('reset');
        $('#jenis_perizinan').val('IZIN PERLUASAN');
        $('#nama_pejabat').val('MAMAT HAMBALI, SH, M.Si');
        $('#jabatan').val('Pembina Utama Muda');
        $('#nip').val('19610704 198603 1 013');
        $('#jumlah_retribusi').val('10,000');
        $('#form_status').val('add');
        $('#panel_form').show();
        $('#panel_list').hide();
    }

    //fungsi untuk proses save data
    function save_perluasan() {
        var data = {
            tgl_bap: $('#tgl_bap').val(),
            jenis_perizinan: $('#jenis_perizinan').val(),
            tgl_pembuatan: $('#tgl_pembuatan').val(),
            no_pelayanan: $('#no_pelayanan').val(),
            keterangan: $('#keterangan').val(),
            type_prinsip: $('#type_prinsip').val(),
            nama_perusahaan: $('#nama_perusahaan').val(),
            npwp: $('#npwp').val(),
            jenis_industri: $('#jenis_industri').val(),
            alamat: $('#alamat').val(),
            kota: $('#kota').val(),
            kecamatan: $('#kecamatan').val(),
            kelurahan: $('#kelurahan').val(),
            alamat_usaha: $('#alamat_usaha').val(),
            nama_pemohon: $('#nama_pemohon').val(),
            jabatan_pemohon: $('#jabatan_pemohon').val(),
            no_surat: $('#no_surat').val(),
            tgl_permohonan: $('#tgl_permohonan').val(),
            komoditi_industri: $('#komoditi_industri').val(),
            kapasitas: $('#kapasitas').val(),
            total_investasi: $('#total_investasi').val(),
            modal_mesin: $('#modal_mesin').val(),
            modal_kerja: $('#modal_kerja').val(),
            tki: $('#tki').val(),
            tka: $('#tka').val(),
            type_merk: $('#type_merk').val(),
            nama_merk: $('#nama_merk').val(),
            tgl_penetapan: $('#tgl_penetapan').val(),
            no_registrasi: $('#no_registrasi').val(),
            nama_pejabat: $('#nama_pejabat').val(),
            jabatan: $('#jabatan').val(),
            nip: $('#nip').val(),
            jumlah_retribusi: $('#jumlah_retribusi').val(),
            id_perluasan: $('#id_perluasan').val(),
            form_status: $('#form_status').val()
        };

        $.post('<?php echo base_url() ?>c_ppu/perluasan/save', data, function (r) {
            if (r.success) {
                window.location.href = '<?php echo base_url() ?>c_ppu/perluasan';
            }
        }, 'json');
    }

    function edit_perluasan(el) {

        $.post('<?php echo base_url() ?>c_ppu/perluasan/getPerluasan', {
            id_perluasan: el
        }, function (r) {
            if (r) {
                $('#tgl_bap').val(r.data.tgl_bap);
                $('#jenis_perizinan').val(r.data.jenis_perizinan);
                $('#tgl_pembuatan').val(r.data.tgl_pembuatan);
                $('#no_pelayanan').val(r.data.no_pelayanan);
                $('#keterangan').val(r.data.keterangan);
                $('#type_prinsip').val(r.data.type_prinsip);
                $('#nama_perusahaan').val(r.data.nama_perusahaan);
                $('#npwp').val(r.data.npwp);
                $('#jenis_industri').val(r.data.jenis_industri);
                $('#alamat').val(r.data.alamat);
                $('#kota').val(r.data.kota);
                $('#kecamatan').val(r.data.kecamatan);
                $.post("<?php echo base_url(); ?>globals/getRefKelurahan/", {
                    kd_kecamatan: r.data.kecamatan
                }, function (obj) {
                    $('#kelurahan').html(obj);
                    $('#kelurahan').val(r.data.kelurahan);
                });
                $('#alamat_usaha').val(r.data.alamat_usaha);
                $('#nama_pemohon').val(r.data.nama_pemohon);
                $('#jabatan_pemohon').val(r.data.jabatan_pemohon);
                $('#no_surat').val(r.data.no_surat);
                $('#tgl_permohonan').val(r.data.tgl_permohonan);
                $('#komoditi_industri').val(r.data.komoditi_industri);
                $('#kapasitas').val(r.data.kapasitas);
                $('#total_investasi').val(r.data.total_investasi);
                $('#modal_mesin').val(r.data.modal_mesin);
                $('#modal_kerja').val(r.data.modal_kerja);
                $('#tki').val(r.data.tki);
                $('#tka').val(r.data.tka);
                $('#type_merk').val(r.data.type_merk);
                $('#nama_merk').val(r.data.nama_merk);
                $('#tgl_penetapan').val(r.data.tgl_penetapan);
                $('#no_registrasi').val(r.data.no_registrasi);
                $('#nama_pejabat').val(r.data.nama_pejabat);
                $('#jabatan').val(r.data.jabatan);
                $('#nip').val(r.data.nip);
                $('#jumlah_retribusi').val(r.data.jumlah_retribusi);
                $('#id_perluasan').val(r.data.id_perluasan);
                $('#form_status').val('edit');
                $('#panel_list').hide();
                $('#panel_form').show();
            }
        }, 'json');
    }

    function remove_perluasan(el) {
        $.post('<?php echo base_url() ?>c_ppu/perluasan/delete', {
            id_perluasan: el
        }, function () {
            window.location.href = '<?php echo base_url() ?>c_ppu/perluasan';
        }, 'json');
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
                            <a href="#" id="create_perluasan" class="btn btn-info" onclick="create_perluasan()"><i class="fa fa-plus-square fa"></i></a>
                            <div style="float: right"><strong>Tanggal</strong> <input type="text" id="tgl_awal" class="datepicker" value="<?php echo $tgl_awal ?>"> - <input type="text" id="tgl_akhir" class="datepicker" value="<?php echo $tgl_akhir ?>"> <button id="btn_cari" class="btn btn-info"><i class="fa fa-search"></i></button> <button id="btn_reset_cari" class="btn btn-warning"><i class="fa fa-remove"></i></button></div>
                        </div>
                        <div class="panel-body">
                            <div style="text-align: center"><h3>Izin Perluasan</h3></div>
                            <div class="show_message"></div>
                            <table id="perluasan_table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 20px">No.</th>
                                        <th style="width: 150px;">Nomor Pelayanan</th>
                                        <th style="width: 150px;">No Registrasi</th>
                                        <th style="width: 150px;">Tgl Buat</th>
                                        <th style="width: 150px;">Nama Perusahaan</th>
                                        <th style="width: 150px;">Nama Pemohon</th>
                                        <th style="width: 5px;"></th>
                                        <th style="width: 5px;"></th>
                                        <!--th style="width: 5px;"></th>
                                        <th style="width: 5px;"></th-->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($listPerluasan as $r) {
                                        if ($r['status'] == 1) {
                                            $color = 'red';
                                        } else {
                                            $color = 'black';
                                        }
                                        ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $r['no_pelayanan'] ?></td>
                                            <td><?php echo $r['no_registrasi'] ?></td>
                                            <td><?php echo $r['tgl_pembuatan'] ?></td>
                                            <td><?php echo $r['nama_perusahaan'] ?></td>
                                            <td><?php echo $r['nama_pemohon'] ?></td>
                                            <td>
                                                <?php if ($r['status'] != 1) { ?>
                                                    <button class="btn btn-info" type="button" id="edit_perluasan" onclick="edit_perluasan(<?php echo $r['id_perluasan'] ?>)"><i class="fa fa-pencil"></i></button>
                                                <?php } else { ?>
                                                    <div style="text-align: center">-</div>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php if ($r['status'] != 1) { ?>
                                                    <button class="btn btn-warning" type="button" id="remove_perluasan" onclick="remove_perluasan(<?php echo $r['id_perluasan'] ?>)"><i class="fa fa-trash"></i></button>
                                                <?php } else { ?>
                                                    <div style="text-align: center">-</div>
                                                <?php } ?>
                                            </td>
                                            <!--td>
                                                <button class="btn btn-success" type="button" id="print" onclick="print_perluasan(<?php echo $r['id_perluasan'] ?>, '')"><i class="fa fa-print"></i></button>
                                            </td>
                                            <td>
                                                <button class="btn btn-primary" type="button" id="print" onclick="print_perluasan(<?php echo $r['id_perluasan'] ?>, 'doc')"><i class="fa fa-file-word-o"></i></button>
                                            </td-->
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
                            <button class="btn btn-primary" id="save_perluasan" onclick="save_perluasan()"><i class="fa fa-save"></i></button>
                        </div>
                        <div class="panel-body">
                            <div class="show_error"></div>
                            <form id="form_perluasan">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Input Izin
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <label for="tgl_bap">Tgl. BAP : </label>
                                            </div>
                                            <div class="col-lg-2">
                                                <input type="text" class="form-control input-sm datepicker" id="tgl_bap"/>
                                            </div>
                                        </div>
                                        <br/>
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
                                                <input type="hidden" id="id_perluasan" >
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
                                                <label for="type_prinsip">Type Prinsip : </label>
                                            </div>
                                            <div class="col-lg-4" >
                                                <select class="form-control" id="type_prinsip">
                                                    <option value="0">-- Pilih --</option>
                                                    <option value="1">IZIN PERLUASAN ( MELALUI PERSETUJUAN PRINSIP )</option>
                                                    <option value="2">IZIN PERLUASAN ( TANPA MELALUI PERSETUJUAN PRINSIP ) </option>
                                                </select>
                                            </div>
                                        </div>
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
                                                    <div class="col-lg-2">
                                                        <label for="nama_perusahaan">Nama : </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="text" class="form-control input-sm" id="nama_perusahaan"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-2">
                                                        <label for="npwp">NPWP : </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="text" class="form-control input-sm" id="npwp"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-2">
                                                        <label for="jenis_industri">Jenis Industri : </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <textarea class="form-control input-sm" id="jenis_industri"></textarea>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-2">
                                                        <label for="alamat">Alamat Perusahaan: </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <textarea class="form-control input-sm" id="alamat"></textarea>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-2">
                                                        <label for="kota">Kota : </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="text" class="form-control input-sm" id="kota"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-2">
                                                        <label for="kecamatan">Kecamatan : </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <select class="form-control input-sm" id="kecamatan" >
                                                            <option value="-">-</option>
                                                            <?php
                                                            foreach ($listKecamatan as $r) {
                                                                ?>
                                                                <option value="<?php echo $r['kd_kecamatan'] ?>"><?php echo $r['kecamatan'] ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-2">
                                                        <label for="kelurahan">Kelurahan : </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <select class="form-control input-sm" id="kelurahan">
                                                            <option value="-">-</option>
                                                            <?php
                                                            foreach ($listKelurahan as $r) {
                                                                ?>
                                                                <option value="<?php echo $r['kd_kelurahan'] ?>"><?php echo $r['kelurahan'] ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-2">
                                                        <label for="nama_pemohon">Nama Pemohon : </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="text" class="form-control input-sm" id="nama_pemohon"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-2">
                                                        <label for="jabatan_pemohon">Jabatan : </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="text" class="form-control input-sm" id="jabatan_pemohon"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-2">
                                                        <label for="no_surat">No Surat Permohonan : </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="text" class="form-control input-sm" id="no_surat"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-2">
                                                        <label for="tgl_permohonan">Tgl Permohonan : </label>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <input type="text" class="form-control input-sm datepicker" id="tgl_permohonan"/>
                                                    </div>
                                                </div>
                                                <br/>
                                            </div>
                                            <div id="info_lain" class="tab-pane fade">
                                                <br><br>
                                                <div class="row">
                                                    <div class="col-lg-2">
                                                        <label for="komoditi_industri">Komoditi Industri ( KKI ) : </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <textarea class="form-control input-sm" id="komoditi_industri"></textarea>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-2">
                                                        <label for="kapasitas">Kapasitas Terpasang : </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="text" class="form-control input-sm" id="kapasitas"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-2">
                                                        <label for="total_investasi">Total Investasi : </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="text" class="form-control input-sm" id="total_investasi"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-2">
                                                        <label for="modal_mesin">Modal Mesin : </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="text" class="form-control input-sm" id="modal_mesin"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-2">
                                                        <label for="modal_kerja">Modal Kerja : </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="text" class="form-control input-sm" id="modal_kerja"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-2">
                                                        <label for="tki">Tenaga Kerja Indonesia: </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="text" class="form-control input-sm" id="tki"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-2">
                                                        <label for="tka">Tenaga Kerja Asing: </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="text" class="form-control input-sm" id="tka"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-2">
                                                        <label for="type_merk">Type Merk : </label>
                                                    </div>
                                                    <div class="col-lg-4" >
                                                        <select class="form-control" id="type_merk">
                                                            <option value="0">-- Pilih --</option>
                                                            <option value="1">Lisensi</option>
                                                            <option value="2">Milik Snediri</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-2">
                                                        <label for="nama_merk">Nama Merk: </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="text" class="form-control input-sm" id="nama_merk"/>
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
                                                    <div class="col-lg-2">
                                                        <label for="tgl_penetapan">Tanggal : </label>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <input type="text" class="form-control input-sm datepicker" id="tgl_penetapan"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-2">
                                                        <label for="no_registrasi">Nomor Registrasi : </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="text" class="form-control input-sm" id="no_registrasi"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-2">
                                                        <label for="nama_pejabat">Nama Pejabat : </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="text" class="form-control input-sm" id="nama_pejabat"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-2">
                                                        <label for="jabatan">Jabatan : </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="text" class="form-control input-sm" id="jabatan"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-2">
                                                        <label for="nip">NIP: </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="text" class="form-control input-sm" id="nip"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-2">
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