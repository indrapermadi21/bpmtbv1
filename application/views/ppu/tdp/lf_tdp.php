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

        // change kecamatan 
        $('#kecamatan').change(function () {
            $.post("<?php echo base_url(); ?>globals/getRefKelurahan/", {
                kd_kecamatan: $('#kecamatan').val()
            }, function (obj) {
                $('#kelurahan').html(obj);
            });
        });

        //init 
        panel_form.hide();
        $('#tdp_table').dataTable();

        $('#btn_cari').click(function () {
            var data = {
                tgl_awal: $('#tgl_awal').val(),
                tgl_akhir: $('#tgl_akhir').val()
            };

            $.post('<?php echo base_url() ?>c_ppu/tdp/setSession', data, function () {
                window.location.href = '<?php echo base_url() ?>c_ppu/tdp';
            });
        });

        $('#btn_reset_cari').click(function () {
            var data = {
                tgl_awal: $('#tgl_awal').val(),
                tgl_akhir: $('#tgl_akhir').val()
            };

            $.post('<?php echo base_url() ?>c_ppu/tdp/unsetSession', data, function () {
                window.location.href = '<?php echo base_url() ?>c_ppu/tdp';
            });
        });

    });

    //kembali ke tampillan tabel 
    function back_grid() {
        $('#panel_form').hide();
        $('#panel_list').show();
    }


    //memunculkan form menu
    function create_tdp() {
        $('#form_menu').trigger('reset');
        $('#form_status').val('add');
        $('#panel_form').show();
        $('#panel_list').hide();
    }

    //fungsi untuk proses save edit data
    function save_tdp() {
        var data = {
            id_tdp: $('#id_tdp').val(),
            jenis_perizinan: $('#jenis_perizinan').val(),
            tgl_pembuatan: $('#tgl_pembuatan').val(),
            no_pelayanan: $('#no_pelayanan').val(),
            type_perusahaan: $('#type_perusahaan').val(),
            jenis_perusahaan: $('#jenis_perusahaan').val(),
            perusahaan_ke: $('#perusahaan_ke').val(),
            nama_perusahaan: $('#nama_perusahaan').val(),
            status_perusahaan: $('#status_perusahaan').val(),
            npwp: $('#npwp').val(),
            alamat: $('#alamat').val(),
            kota: $('#kota').val(),
            kecamatan: $('#kecamatan').val(),
            kelurahan: $('#kelurahan').val(),
            no_telp: $('#no_telp').val(),
            penanggung_jawab: $('#penanggung_jawab').val(),
            keg_up: $('#keg_up').val(),
            kbli: $('#kbli').val(),
            tgl_penetapan: $('#tgl_penetapan').val(),
            tgl_berlaku: $('#tgl_berlaku').val(),
            no_registrasi: $('#no_registrasi').val(),
            nama_pejabat: $('#nama_pejabat').val(),
            nip: $('#nip').val(),
            jabatan: $('#jabatan').val(),
            jumlah_retribusi: $('#jumlah_retribusi').val(),
            form_status: $('#form_status').val()
        };

        if (!data.tgl_pembuatan) {
            $('.show_error').append('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong> Tanggal pembuatan </strong> tidak boleh kosong.</div>');
            $('#tgl_pembuatan').focus();
            return false;
        }
        if (!data.no_pelayanan) {
            $('.show_error').append('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong> No Pelayanan </strong> tidak boleh kosong.</div>');
            $('#no_pelayanan').focus();
            return false;
        }
        if (!data.nama_perusahaan) {
            $('.show_error').append('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong> Nama Perusahaan </strong> tidak boleh kosong.</div>');
            $('#nama_perusahaan').focus();
            return false;
        }
        if (!data.tgl_penetapan) {
            $('.show_error').append('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong> Tanggal penetapan</strong> tidak boleh kosong.</div>');
            $('#tgl_penetapan').focus();
            return false;
        }
        if (!data.tgl_berlaku) {
            $('.show_error').append('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong> Tanggal berlaku </strong> tidak boleh kosong.</div>');
            $('#tgl_berlaku').focus();
            return false;
        }
        if (!data.no_registrasi) {
            $('.show_error').append('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong> No. Registrasi </strong> tidak boleh kosong.</div>');
            $('#no_registrasi').focus();
            return false;
        }

        $.post('<?php echo base_url() ?>c_ppu/tdp/save', data, function (r) {
            if (r.success) {
                window.location.href = '<?php echo base_url() ?>c_ppu/tdp';
            }
        }, 'json');

    }

    function edit_tdp(el) {

        $.post('<?php echo base_url() ?>c_ppu/tdp/getTdp', {
            id_tdp: el
        }, function (r) {
            if (r.success) {
                $('#id_tdp').val(r.data.id_tdp);
                $('#jenis_perizinan').val(r.data.jenis_perizinan);
                $('#tgl_pembuatan').val(r.data.tgl_pembuatan);
                $('#no_pelayanan').val(r.data.no_pelayanan);
                $('#keterangan').val(r.data.keterangan);
                $('#type_perusahaan').val(r.data.type_perusahaan);
                $('#jenis_perusahaan').val(r.data.jenis_perusahaan);
                $('#perusahaan_ke').val(r.data.perusahaan_ke);

                //informasi Perusahaan
                $('#nama_perusahaan').val(r.data.nama_perusahaan);
                $('#status_perusahaan').val(r.data.status_perusahaan);
                $('#npwp').val(r.data.npwp);
                $('#alamat').val(r.data.alamat);
                $('#kota').val(r.data.kota);
                $('#kecamatan').val(r.data.kecamatan);
                $.post("<?php echo base_url(); ?>globals/getRefKelurahan/", {
                    kd_kecamatan: r.data.kecamatan
                }, function (obj) {
                    $('#kelurahan').html(obj);
                    $('#kelurahan').val(r.data.kelurahan);
                });
                $('#no_telp').val(r.data.no_telp);

                //Informasi Lainnya
                $('#penanggung_jawab').val(r.data.penanggung_jawab);
                $('#keg_up').val(r.data.keg_up);
                $('#kbli').val(r.data.kbli);

                //Informasi Penetapan
                $('#tgl_penetapan').val(r.data.tgl_penetapan);
                $('#tgl_berlaku').val(r.data.tgl_berlaku);
                $('#no_registrasi').val(r.data.no_registrasi);
                $('#nama_pejabat').val(r.data.nama_pejabat);
                $('#jabatan').val(r.data.jabatan);
                $('#nip').val(r.data.nip);
                $('#jumlah_retribusi').val(r.data.jumlah_retribusi);

                $('#form_status').val('edit');
                $('#panel_list').hide();
                $('#panel_form').show();

            }
        }, 'json');
    }

    function remove_tdp(el) {
        $.post('<?php echo base_url() ?>c_ppu/tdp/delete', {
            id_tdp: el
        }, function (r) {
            if (r.success) {
                $('.show_message').append('<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong> No Pelayanan </strong> telah berhasil di cancel.</div>');
                window.location.href = '<?php echo base_url() ?>c_ppu/tdp';
            }

        }, 'json');
    }

    function print_tdp(el, type) {
        window.open('<?php echo base_url() ?>c_ppu/tdp/export_doc/' + el + '/' + type);
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
                            <a href="#" class="btn btn-info" id="create_tdp" onclick="create_tdp()"><i class="fa fa-plus-square fa"></i></a>
                            <div style="float: right"><strong>Tanggal</strong> <input type="text" id="tgl_awal" class="datepicker" value="<?php echo $tgl_awal ?>"> - <input type="text" id="tgl_akhir" class="datepicker" value="<?php echo $tgl_akhir ?>"> <button id="btn_cari" class="btn btn-info"><i class="fa fa-search"></i></button> <button id="btn_reset_cari" class="btn btn-warning"><i class="fa fa-remove"></i></button></div>
                        </div>
                        <div class="panel-body">
                            <div style="text-align: center"><h3>Tanda Daftar Perusahaan</h3></div>
                            <div class="show_message"></div>
                            <table id="tdp_table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 20px">No.</th>
                                        <th style="width: 200px;">Nomor Pelayanan</th>
                                        <th style="width: 150px;">No. Registrasi</th>
                                        <th style="width: 100px;">Tgl. Pembuatan</th>
                                        <th style="width: 250px;">Nama Perusahaan</th>
                                        <th style="width: 200px;">Penanggung Jawab</th>
                                        <th style="width: 5px;"></th>
                                        <th style="width: 5px;"></th>
                                        <!--th style="width: 5px;"></th>
                                        <th style="width: 5px;"></th-->
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($listTdp as $r) {
                                        $r['status'] == 1 ? $color = 'red' : $color = 'black';
                                        ?>
                                        <tr>
                                            <td><font color="<?php echo $color ?>"><?php echo $i ?></font></td>
                                            <td><font color="<?php echo $color ?>"><?php echo $r['no_pelayanan'] ?></font></td>
                                            <td><font color="<?php echo $color ?>"><?php echo $r['no_registrasi'] ?></font></td>
                                            <td><font color="<?php echo $color ?>"><?php echo $r['tgl_pembuatan'] ?></font></td>
                                            <td><font color="<?php echo $color ?>"><?php echo $r['nama_perusahaan'] ?></font></td>
                                            <td><font color="<?php echo $color ?>"><?php echo $r['penanggung_jawab'] ?></font></td>
                                            <td>
                                                <?php if ($r['status'] != 1) { ?>
                                                    <button class="btn btn-info" type="button" id="edit_tdp" onclick="edit_tdp(<?php echo $r['id_tdp'] ?>)"><i class="fa fa-pencil"></i></button>
                                                <?php } else { ?>
                                                    <div style="text-align: center">-</div>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php if ($r['status'] != 1) { ?>
                                                    <button class="btn btn-warning" type="button" id="remove_tdp" onclick="remove_tdp(<?php echo $r['id_tdp'] ?>)"><i class="fa fa-trash"></i></button>
                                                <?php } else { ?>
                                                    <div style="text-align: center">-</div>
                                                <?php } ?>
                                            </td>
                                            <!--td>
                                                <button class="btn btn-success" type="button" id="print" onclick="print_tdp(<?php echo $r['id_tdp'] ?>, '')"><i class="fa fa-print"></i></button>
                                            </td>
                                            <td>
                                                <button class="btn btn-primary" type="button" id="print" onclick="print_tdp(<?php echo $r['id_tdp'] ?>, 'doc')"><i class="fa fa-file-word-o"></i></button>
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
                            <button class="btn btn-primary" id="save_tdp" onclick="save_tdp()"><i class="fa fa-save"></i></button>
                        </div>
                        <div class="show_error"></div>
                        <div class="panel-body">
                            <form id="form_menu">

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
                                                <input type="text" class="form-control input-sm" id="jenis_perizinan" value="<?php echo $jenis_perizinan ?>"/>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <label for="tgl_pembuatan">Tgl. Pembuatan : </label>
                                            </div>
                                            <div class="col-lg-2">
                                                <input type="hidden" id="form_status" >
                                                <input type="hidden" id="id_tdp" >
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
                                                <label for="type_perusahaan">Type Perusahaan : </label>
                                            </div>
                                            <div class="col-lg-4">
                                                <select class="form-control input-sm" id="type_perusahaan">

                                                    <option value="0">-</option>
                                                    <?php
                                                    foreach ($type_perusahaan as $r) {
                                                        ?>
                                                        <option value="<?php echo $r->id_tipe ?>"><?php echo $r->tipe_perusahaan ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <label for="jenis_perusahaan">Jenis Perusahaan : </label>
                                            </div>
                                            <div class="col-lg-2">
                                                <select class="form-control input-sm" id="jenis_perusahaan">

                                                    <option value="0">-</option>
                                                    <?php
                                                    foreach ($jenis_perusahaan as $r) {
                                                        ?>
                                                        <option value="<?php echo $r->id_jenis ?>"><?php echo $r->jenis_perusahaan ?></option>
                                                        <?php
                                                    }
                                                    ?>

                                                </select>
                                            </div>
                                            <div class="col-lg-1">
                                                <label for="perusahaan_ke">Ke : </label>
                                            </div>
                                            <div class="col-lg-1">
                                                <input type="text" id="perusahaan_ke" class="form-control input-sm"/>
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
                                                        <label for="status">Status : </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <select class="form-control input-sm" id="status_perusahaan">

                                                            <option value="0">-</option>
                                                            <?php
                                                            foreach ($getStatus as $r) {
                                                                ?>
                                                                <option value="<?php echo $r->id_status ?>"><?php echo $r->status_perusahaan ?></option>
                                                                <?php
                                                            }
                                                            ?>

                                                        </select>
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
                                                        <label for="alamat">Alamat : </label>
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
                                                        <label for="nama_pemilik">No. Telp : </label>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <input type="text" class="form-control input-sm" id="no_telp"/>
                                                    </div>
                                                </div>
                                                <br/>
                                            </div> <!-- End info perusahaan -->
                                            <div id="info_lain" class="tab-pane fade">
                                                <br><br>
                                                <div class="row">
                                                    <div class="col-lg-2">
                                                        <label for="penanggung_jawab">Penanggung Jawab : </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="text" class="form-control input-sm" id="penanggung_jawab"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-2">
                                                        <label for="keg_up">Kegiatan Usaha Pokok : </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="text" class="form-control input-sm" id="keg_up"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-2">
                                                        <label for="kbli">KBLI : </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="text" class="form-control input-sm" id="kbli"/>
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
                                                        <label for="tgl_berlaku">Tanggal Berlaku : </label>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <input type="text" class="form-control input-sm datepicker" id="tgl_berlaku"/>
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