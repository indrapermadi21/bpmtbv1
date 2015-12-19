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
        $('#tdg_table').dataTable();

        $('#btn_cari').click(function () {
            var data = {
                tgl_awal: $('#tgl_awal').val(),
                tgl_akhir: $('#tgl_akhir').val()
            };

            $.post('<?php echo base_url() ?>c_ppu/tdp/setSession', data, function () {
                window.location.href = '<?php echo base_url() ?>c_ppu/tdg';
            });
        });

        $('#btn_reset_cari').click(function () {
            var data = {
                tgl_awal: $('#tgl_awal').val(),
                tgl_akhir: $('#tgl_akhir').val()
            };

            $.post('<?php echo base_url() ?>c_ppu/tdp/unsetSession', data, function () {
                window.location.href = '<?php echo base_url() ?>c_ppu/tdg';
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
    function create_tdg() {
        $('#form_tdg').trigger('reset');
        $('#jenis_perizinan').val('TANDA DAFTAR GUDANG');
        $('#nama_pejabat').val('MAMAT HAMBALI, SH, M.Si');
        $('#jabatan').val('Pembina Utama Muda');
        $('#nip').val('19610704 198603 1 013');
        $('#jumlah_retribusi').val('10,000');
        $('#form_status').val('add');
        $('#panel_form').show();
        $('#panel_list').hide();
    }

    //fungsi untuk proses save data
    function save_tdg() {
        var data = {
            jenis_perizinan: $('#jenis_perizinan').val(),
            tgl_pembuatan: $('#tgl_pembuatan').val(),
            no_pelayanan: $('#no_pelayanan').val(),
            keterangan: $('#keterangan').val(),
            nama_perusahaan: $('#nama_perusahaan').val(),
            alamat_perusahaan: $('#alamat_perusahaan').val(),
            kota: $('#kota').val(),
            kecamatan: $('#kecamatan').val(),
            kelurahan: $('#kelurahan').val(),
            nama_pemilik: $('#nama_pemilik').val(),
            alamat_pemilik: $('#alamat_pemilik').val(),
            no_siup: $('#no_siup').val(),
            tgl_siup: $('#tgl_siup').val(),
            no_tdp: $('#no_tdp').val(),
            tgl_tdp: $('#tgl_tdp').val(),
            tmpt_keluar: $('#tmpt_keluar').val(),
            siui: $('#siui').val(),
            lokasi_prov: $('#lokasi_prov').val(),
            lokasi_kota: $('#lokasi_kota').val(),
            lokasi_kec: $('#lokasi_kec').val(),
            lokasi_kel: $('#lokasi_kel').val(),
            luas_gudang: $('#luas_gudang').val(),
            tgl_penetapan: $('#tgl_penetapan').val(),
            tgl_berlaku: $('#tgl_berlaku').val(),
            no_registrasi: $('#no_registrasi').val(),
            nama_pejabat: $('#nama_pejabat').val(),
            jabatan: $('#jabatan').val(),
            nip: $('#nip').val(),
            jumlah_retribusi: $('#jumlah_retribusi').val(),
            id_tdg: $('#id_tdg').val(),
            form_status: $('#form_status').val()
        };

        $.post('<?php echo base_url() ?>c_ppu/tdg/save', data, function (r) {
            if (r.success) {
                window.location.href = '<?php echo base_url() ?>c_ppu/tdg';
            }
        }, 'json');
    }

    function edit_tdg(el) {

        $.post('<?php echo base_url() ?>c_ppu/tdg/getTdg', {
            id_tdg: el
        }, function (r) {
            if (r) {
                $('#jenis_perizinan').val(r.data.jenis_perizinan);
                $('#tgl_pembuatan').val(r.data.tgl_pembuatan),
                        $('#no_pelayanan').val(r.data.no_pelayanan),
                        $('#keterangan').val(r.data.keterangan),
                        $('#nama_perusahaan').val(r.data.nama_perusahaan),
                        $('#alamat_perusahaan').val(r.data.alamat_perusahaan),
                        $('#kota').val(r.data.kota),
                        $('#kecamatan').val(r.data.kecamatan),
                        $.post("<?php echo base_url(); ?>globals/getRefKelurahan/", {
                            kd_kecamatan: r.data.kecamatan
                        }, function (obj) {
                            $('#kelurahan').html(obj);
                            $('#kelurahan').val(r.data.kelurahan);
                        });
                        $('#nama_pemilik').val(r.data.nama_pemilik),
                        $('#alamat_pemilik').val(r.data.alamat_pemilik),
                        $('#no_siup').val(r.data.no_siup),
                        $('#tgl_siup').val(r.data.tgl_siup),
                        $('#no_tdp').val(r.data.no_tdp),
                        $('#tgl_tdp').val(r.data.tgl_tdp),
                        $('#tmpt_keluar').val(r.data.tmpt_keluar),
                        $('#siui').val(r.data.siui),
                        $('#lokasi_prov').val(r.data.lokasi_prov),
                        $('#lokasi_kota').val(r.data.lokasi_kota),
                        $('#lokasi_kec').val(r.data.lokasi_kec),
                        $.post("<?php echo base_url(); ?>globals/getRefKelurahan/", {
                            kd_kecamatan: r.data.lokasi_kec
                        }, function (obj) {
                            $('#lokasi_kel').html(obj);
                            $('#lokasi_kel').val(r.data.lokasi_kel);
                        });
                        $('#luas_gudang').val(r.data.luas_gudang),
                        $('#tgl_penetapan').val(r.data.tgl_penetapan),
                        $('#tgl_berlaku').val(r.data.tgl_berlaku),
                        $('#no_registrasi').val(r.data.no_registrasi),
                        $('#nama_pejabat').val(r.data.nama_pejabat),
                        $('#jabatan').val(r.data.jabatan),
                        $('#nip').val(r.data.nip),
                        $('#jumlah_retribusi').val(r.data.jumlah_retribusi),
                        $('#id_tdg').val(r.data.id_tdg);
                $('#form_status').val('edit');
                $('#panel_list').hide();
                $('#panel_form').show();
            }
        }, 'json');
    }

    function remove_tdg(el) {
        $.post('<?php echo base_url() ?>c_ppu/tdg/delete', {
            id_tdg: el
        }, function () {
            window.location.href = '<?php echo base_url() ?>c_ppu/tdg';
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
                            <a href="#" id="create_tdg" class="btn btn-info" onclick="create_tdg()"><i class="fa fa-plus-square fa"></i></a>
                            <div style="float: right"><strong>Tanggal</strong> <input type="text" id="tgl_awal" class="datepicker" value="<?php echo $tgl_awal ?>"> - <input type="text" id="tgl_akhir" class="datepicker" value="<?php echo $tgl_akhir ?>"> <button id="btn_cari" class="btn btn-info"><i class="fa fa-search"></i></button> <button id="btn_reset_cari" class="btn btn-warning"><i class="fa fa-remove"></i></button></div>
                        </div>
                        <div class="panel-body">
                            <div style="text-align: center"><h3>Tanda Daftar Gudang</h3></div>
                            <div class="show_message"></div>
                            <table id="tdg_table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 20px">No.</th>
                                        <th style="width: 150px;">Nomor Pelayanan</th>
                                        <th style="width: 150px;">No Registrasi</th>
                                        <th style="width: 150px;">Tgl Buat</th>
                                        <th style="width: 150px;">Nama Perusahaan</th>
                                        <th style="width: 150px;">Nama Pemilik</th>
                                        <th style="width: 5px;"></th>
                                        <th style="width: 5px;"></th>
                                        <!--th style="width: 5px;"></th>
                                        <th style="width: 5px;"></th-->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($listTdg as $r) {
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
                                            <td><?php echo $r['nama_pemilik'] ?></td>
                                            <td>
                                                <button class="btn btn-info" type="button" id="edit_tdg" onclick="edit_tdg(<?php echo $r['id_tdg'] ?>)"><i class="fa fa-pencil"></i></button>
                                            </td>
                                            <td>
                                                <?php if ($r['status'] != 1) { ?>
                                                    <button class="btn btn-warning" type="button" id="remove_tdg" onclick="remove_tdg(<?php echo $r['id_tdg'] ?>)"><i class="fa fa-trash"></i></button>
                                                <?php } else { ?>
                                                    <div style="text-align: center">-</div>
                                                <?php } ?>
                                            </td>
                                            <!--td>
                                                <button class="btn btn-success" type="button" id="print" onclick="print_tdg(<?php echo $r['id_tdg'] ?>, '')"><i class="fa fa-print"></i></button>
                                            </td>
                                            <td>
                                                <button class="btn btn-primary" type="button" id="print" onclick="print_tdg(<?php echo $r['id_tdg'] ?>, 'doc')"><i class="fa fa-file-word-o"></i></button>
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
                            <button class="btn btn-primary" id="save_tdg" onclick="save_tdg()"><i class="fa fa-save"></i></button>
                        </div>
                        <div class="panel-body">
                            <div class="show_error"></div>
                            <form id="form_tdg">
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
                                                <input type="hidden" id="id_tdg" >
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
                                                        <label for="alamat_perusahaan">Alamat : </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <textarea class="form-control input-sm" id="alamat_perusahaan"></textarea>
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
                                                        <label for="nama_pemilik">Nama Pemilik : </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="text" class="form-control input-sm" id="nama_pemilik"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-2">
                                                        <label for="alamat_pemilik">Alamat Pemilik: </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <textarea class="form-control input-sm" id="alamat_pemilik"></textarea>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-2">
                                                        <label for="no_siup">Nomor SIUP : </label>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <input type="text" class="form-control input-sm" id="no_siup"/>
                                                    </div>
                                                    <div class="col-lg-1">
                                                        <label for="tgl_siup">Tgl : </label>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <input type="text" class="form-control input-sm datepicker" id="tgl_siup"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-2">
                                                        <label for="no_tdp">Nomor TDP : </label>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <input type="text" class="form-control input-sm" id="no_tdp"/>
                                                    </div>
                                                    <div class="col-lg-1">
                                                        <label for="tgl_tdp">Tgl : </label>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <input type="text" class="form-control input-sm datepicker" id="tgl_tdp"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-2">
                                                        <label for="tmpt_siuptdg">Tempat dikeluarkan SIUP / TDP : </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="text" class="form-control input-sm" id="tmpt_keluar"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-2">
                                                        <label for="siui">Surat Izin Usaha Industri: </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="text" class="form-control input-sm" id="siui"/>
                                                    </div>
                                                </div>
                                                <br/>

                                            </div>
                                            <div id="info_lain" class="tab-pane fade">
                                                <br><br>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <label for="lokasi_gudang">Lokasi Gudang Per Unit : </label>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-2">
                                                        <label for="lokasi_prov">Provinsi : </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="text" class="form-control input-sm" id="lokasi_prov"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-2">
                                                        <label for="lokasi_kota">Kota : </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="text" class="form-control input-sm" id="lokasi_kota"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-2">
                                                        <label for="lokasi_kec">Kecamatan : </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <select class="form-control input-sm" id="lokasi_kec">
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
                                                        <label for="lokasi_kel">Kelurahan : </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <select class="form-control input-sm" id="lokasi_kel">
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
                                                    <div class="col-lg-4">
                                                        <label for="luas_gudang_per_unit">Luas Gudang (Per Unit) : </label>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-lg-2">
                                                        <label for="luas_gudang">M2 (Dalam Huruf) : </label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <textarea class="form-control input-sm" id="luas_gudang"></textarea>
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