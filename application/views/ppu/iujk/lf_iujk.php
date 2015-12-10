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
        $('#iujk_table').dataTable();

        $('#btn_cari').click(function () {
            var data = {
                tgl_awal: $('#tgl_awal').val(),
                tgl_akhir: $('#tgl_akhir').val()
            };

            $.post('<?php echo base_url() ?>c_ppu/tdp/setSession', data, function () {
                window.location.href = '<?php echo base_url() ?>c_ppu/iujk';
            });
        });

        $('#btn_reset_cari').click(function () {
            var data = {
                tgl_awal: $('#tgl_awal').val(),
                tgl_akhir: $('#tgl_akhir').val()
            };

            $.post('<?php echo base_url() ?>c_ppu/tdp/unsetSession', data, function () {
                window.location.href = '<?php echo base_url() ?>c_ppu/iujk';
            });
        });
    });

    //kembali ke tampillan tabel 
    function back_grid() {
        $('#panel_form').hide();
        $('#panel_list').show();
    }


    //memunculkan form menu
    function create_iujk() {
        $('#form_iujk').trigger('reset');
        $('#jenis_perizinan').val('IZIN USAHA JASA KONSTRUKSI');
        $('#form_status').val('add');
        $('#panel_form').show();
        $('#panel_list').hide();
    }

    //fungsi untuk proses save data
    function save_iujk() {
        var data = {
            jenis_perizinan: $('#jenis_perizinan').val(),
            tgl_pembuatan: $('#tgl_pembuatan').val(),
            no_pelayanan: $('#no_pelayanan').val(),
            keterangan: $('#keterangan').val(),
            type_iujk: $('#type_iujk').val(),
            nama_perusahaan: $('#nama_perusahaan').val(),
            alamat_perusahaan: $('#alamat_perusahaan').val(),
            rtrw: $('#rtrw').val(),
            provinsi: $('#provinsi').val(),
            kota: $('#kota').val(),
            kecamatan: $('#kecamatan').val(),
            kelurahan: $('#kelurahan').val(),
            kodepos: $('#kodepos').val(),
            no_telp: $('#no_telp').val(),
            fax: $('#fax').val(),
            penanggung_jawab: $('#penanggung_jawab').val(),
            npwp: $('#npwp').val(),
            bidang1: $('#bidang1').val(),
            bidang2: $('#bidang2').val(),
            bidang3: $('#bidang3').val(),
            tgl_penetapan: $('#tgl_penetapan').val(),
            tgl_berlaku: $('#tgl_berlaku').val(),
            no_registrasi: $('#no_registrasi').val(),
            nama_pejabat: $('#nama_pejabat').val(),
            jabatan: $('#jabatan').val(),
            nip: $('#nip').val(),
            jumlah_retribusi: $('#jumlah_retribusi').val(),
            id_iujk: $('#id_iujk').val(),
            form_status: $('#form_status').val()
        };

        $.post('<?php echo base_url() ?>c_ppu/iujk/save', data, function (r) {
            if (r.success) {
                window.location.href = '<?php echo base_url() ?>c_ppu/iujk';
            }
        }, 'json');
    }

    function edit_iujk(el) {

        $.post('<?php echo base_url() ?>c_ppu/iujk/getIujk', {
            id_iujk: el
        }, function (r) {
            if (r) {
                $('#jenis_perizinan').val(r.data.jenis_perizinan);
                $('#tgl_pembuatan').val(r.data.tgl_pembuatan),
                        $('#no_pelayanan').val(r.data.no_pelayanan),
                        $('#keterangan').val(r.data.keterangan),
                        $('#type_iujk').val(r.data.type_iujk),
                        $('#nama_perusahaan').val(r.data.nama_perusahaan),
                        $('#alamat_perusahaan').val(r.data.alamat_perusahaan),
                        $('#rtrw').val(r.data.rtrw),
                        $('#provinsi').val(r.data.provinsi),
                        $('#kota').val(r.data.kota),
                        $('#kecamatan').val(r.data.kecamatan),
                        $('#kelurahan').val(r.data.kelurahan),
                        $('#kodepos').val(r.data.kodepos),
                        $('#no_telp').val(r.data.no_telp),
                        $('#fax').val(r.data.fax),
                        $('#penanggung_jawab').val(r.data.penanggung_jawab),
                        $('#npwp').val(r.data.npwp),
                        $('#bidang1').val(r.data.bidang1),
                        $('#bidang2').val(r.data.bidang2),
                        $('#bidang3').val(r.data.bidang3),
                        $('#tgl_penetapan').val(r.data.tgl_penetapan),
                        $('#tgl_berlaku').val(r.data.tgl_berlaku),
                        $('#no_registrasi').val(r.data.no_registrasi),
                        $('#nama_pejabat').val(r.data.nama_pejabat),
                        $('#jabatan').val(r.data.jabatan),
                        $('#nip').val(r.data.nip),
                        $('#jumlah_retribusi').val(r.data.jumlah_retribusi),
                        $('#id_iujk').val(r.data.id_iujk);
                $('#form_status').val('edit');

                $('#panel_list').hide();
                $('#panel_form').show();
            }
        }, 'json');
    }

    function remove_iujk(el) {
        $.post('<?php echo base_url() ?>c_ppu/iujk/delete', {
            id_iujk: el
        }, function () {
            window.location.href = '<?php echo base_url() ?>c_ppu/iujk';
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
                            <a href="#" id="create_iujk" class="btn btn-info" onclick="create_iujk()"><i class="fa fa-plus-square fa"></i></a>
                            <div style="float: right"><strong>Tanggal</strong> <input type="text" id="tgl_awal" class="datepicker" value="<?php echo $tgl_awal ?>"> - <input type="text" id="tgl_akhir" class="datepicker" value="<?php echo $tgl_akhir ?>"> <button id="btn_cari" class="btn btn-info"><i class="fa fa-search"></i></button> <button id="btn_reset_cari" class="btn btn-warning"><i class="fa fa-remove"></i></button></div>
                        </div>
                        <div class="panel-body">
                            <div style="text-align: center"><h3>Izin Usaha Jasa Konstruksi</h3></div>
                            <div class="show_message"></div>
                            <table id="iujk_table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 20px">No.</th>
                                        <th style="width: 150px;">Nomor Pelayanan</th>
                                        <th style="width: 150px;">No Registrasi</th>
                                        <th style="width: 150px;">Tgl Buat</th>
                                        <th style="width: 150px;">Nama Perusahaan</th>
                                        <th style="width: 150px;">Penanggung Jawab</th>
                                        <th style="width: 5px;"></th>
                                        <th style="width: 5px;"></th>
                                        <th style="width: 5px;"></th>
                                        <th style="width: 5px;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($listIujk as $r) {
                                        if ($r['status'] == 1) {
                                            $color = 'red';
                                        } else {
                                            $color = 'black';
                                        }
                                        ?>
                                        <tr>
                                            <td><font color="<?php echo $color ?>"><?php echo $i ?></td>
                                            <td><font color="<?php echo $color ?>"><?php echo $r['no_pelayanan'] ?></font></td>
                                            <td><font color="<?php echo $color ?>"><?php echo $r['no_registrasi'] ?></font></td>
                                            <td><font color="<?php echo $color ?>"><?php echo $r['tgl_pembuatan'] ?></font></td>
                                            <td><font color="<?php echo $color ?>"><?php echo $r['nama_perusahaan'] ?></font></td>
                                            <td><font color="<?php echo $color ?>"><?php echo $r['penanggung_jawab'] ?></font></td>
                                            <td>
                                                <?php if ($r['status'] != 1) { ?>
                                                    <button class="btn btn-info" type="button" id="edit_iujk" onclick="edit_iujk(<?php echo $r['id_iujk'] ?>)"><i class="fa fa-pencil"></i></button>
                                                <?php } else { ?>
                                                    <div style="text-align: center">-</div>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php if ($r['status'] != 1) { ?>
                                                    <button class="btn btn-warning" type="button" id="remove_iujk" onclick="remove_iujk(<?php echo $r['id_iujk'] ?>)"><i class="fa fa-trash"></i></button>
                                                <?php } else { ?>
                                                    <div style="text-align: center">-</div>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <button class="btn btn-success" type="button" id="print" onclick="print_iujk(<?php echo $r['id_iujk'] ?>, '')"><i class="fa fa-print"></i></button>
                                            </td>
                                            <td>
                                                <button class="btn btn-primary" type="button" id="print" onclick="print_iujk(<?php echo $r['id_iujk'] ?>, 'doc')"><i class="fa fa-file-word-o"></i></button>
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
                            <button class="btn btn-primary" id="save_iujk" onclick="save_iujk()"><i class="fa fa-save"></i></button>
                        </div>
                        <div class="panel-body">
                            <div class="show_error"></div>
                            <form id="form_iujk">

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Input Izin
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <label for="jenis_perizinan">Jenis Perizinan : </label>
                                            </div>
                                            <div class="col-xs-4">
                                                <input type="text" class="form-control input-sm" id="jenis_perizinan"/>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <label for="tgl_pembuatan">Tgl. Pembuatan : </label>
                                            </div>
                                            <div class="col-xs-2">
                                                <input type="hidden" id="form_status" >
                                                <input type="hidden" id="id_iujk" >
                                                <input type="text" class="form-control input-sm datepicker" id="tgl_pembuatan"/>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <label for="no_pelayanan">No. Pelayanan : </label>
                                            </div>
                                            <div class="col-xs-4">
                                                <input type="text" class="form-control input-sm" id="no_pelayanan"/>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <label for="keterangan">Keterangan : </label>
                                            </div>
                                            <div class="col-xs-4">
                                                <textarea class="form-control input-sm" id="keterangan"></textarea>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <label for="type_iujk">Type SIUJK : </label>
                                            </div>
                                            <div class="col-xs-4">
                                                <select class="form-control" id="type_iujk">
                                                    <option value="0">-- Pilih --</option>
                                                    <option value="1">Khusus</option>
                                                    <option value="2">Global</option>
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
                                                    <div class="col-xs-2">
                                                        <label for="nama_perusahaan">Nama : </label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <input type="text" class="form-control input-sm" id="nama_perusahaan"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label for="alamat_perusahaan">Alamat : </label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <textarea class="form-control input-sm" id="alamat_perusahaan"></textarea>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label for="rtrw">RT / RW : </label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <input type="text" class="form-control input-sm" id="rtrw"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label for="provinsi">Provinsi : </label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <input type="text" class="form-control input-sm" id="provinsi"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label for="kota">Kota : </label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <input type="text" class="form-control input-sm" id="kota"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label for="kecamatan">Kecamatan : </label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <input type="text" class="form-control input-sm" id="kecamatan"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label for="kelurahan">Kelurahan : </label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <input type="text" class="form-control input-sm" id="kelurahan"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label for="kodepos">Kode Pos : </label>
                                                    </div>
                                                    <div class="col-xs-2">
                                                        <input type="text" class="form-control input-sm" id="kodepos"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label for="no_telp">No.Telp : </label>
                                                    </div>
                                                    <div class="col-xs-2">
                                                        <input type="text" class="form-control input-sm" id="no_telp" placeholder="No. Telp"/>
                                                    </div>
                                                    <div class="col-xs-2">
                                                        <input type="text" class="form-control input-sm" id="fax" placeholder="No. Fax"/>
                                                    </div>
                                                </div>
                                                <br/>
                                            </div>
                                            <div id="info_lain" class="tab-pane fade">
                                                <br><br>
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label for="penganggung_jawab">Penaggung Jawab : </label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <input type="text" class="form-control input-sm" id="penanggung_jawab"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label for="npwp">NPWP : </label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <input type="text" class="form-control input-sm" id="npwp"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label for="bidang_pekerjaan">Bidang Pekerjaan : </label>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label for="bidang1">1 : </label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <textarea class="form-control input-sm" id="bidang1"></textarea>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label for="bidang2">2 : </label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <textarea class="form-control input-sm" id="bidang2"></textarea>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label for="bidang3">3 : </label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <textarea class="form-control input-sm" id="bidang3"></textarea>
                                                    </div>
                                                </div>
                                                <br/>
                                            </div>
                                            <div id="info_penetapan" class="tab-pane fade">
                                                <br><br>
                                                <div class="row">
                                                    <div class="col-xs-6">
                                                        <label >Ditetapkan di Serang tanggal : </label>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label for="tgl_penetapan">Tanggal : </label>
                                                    </div>
                                                    <div class="col-xs-2">
                                                        <input type="text" class="form-control input-sm datepicker" id="tgl_penetapan"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label for="tgl_berlaku">Tanggal Berlaku : </label>
                                                    </div>
                                                    <div class="col-xs-2">
                                                        <input type="text" class="form-control input-sm datepicker" id="tgl_berlaku"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label for="no_registrasi">Nomor Registrasi : </label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <input type="text" class="form-control input-sm" id="no_registrasi"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label for="nama_pejabat">Nama Pejabat : </label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <input type="text" class="form-control input-sm" id="nama_pejabat"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label for="jabatan">Jabatan : </label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <input type="text" class="form-control input-sm" id="jabatan"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label for="nip">NIP: </label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <input type="text" class="form-control input-sm" id="nip"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label for="jumlah_retribusi">Jumlah Retribusi : </label>
                                                    </div>
                                                    <div class="col-xs-4">
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