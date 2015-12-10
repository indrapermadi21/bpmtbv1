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
        $('#ttl_table').dataTable();

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
        $('#panel_form').show();
        $('#panel_list').hide();
    }

    //fungsi untuk proses save data
    function save_imb() {

        var data = {
            menu_name: $('#menu_name').val(),
            menu_group_id: $('#menu_group_id').val(),
            path: $('#path').val(),
            menu_desc: $('#menu_desc').val(),
            id_imb: $('#id_imb').val()
        };


        $.post('<?php echo base_url() ?>administrasi/menu/save', data, function (r) {
            alert(r.success);

            if (r.success) {
                window.location.href = '<?php echo base_url() ?>administrasi/menu';
            }
        }, 'json');
    }

    function edit_imb(el) {

        $.post('<?php echo base_url() ?>c_ppu/imb/getImb', {
            id_imb: el
        }, function (r) {
            if (r) {
                $('#id_imb').val(r.data.id_imb);
                $('#menu_name').val(r.data.name);
                $('#menu_desc').val(r.data.description);
                $('#menu_group_id').val(r.data.menu_group_id);
                $('#path').val(r.data.url);
                $('#form_status').val('edit');
                $('#panel_list').hide();
                $('#panel_form').show();

            }
        }, 'json');
    }

    function remove_imb(el) {
        $.post('<?php echo base_url() ?>administrasi/menu/delete', {
            id_imb: el
        }, function () {
            window.location.href = '<?php echo base_url() ?>administrasi/menu';
        })
    }
</script>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <!--strong><center><h2>Menu</h2></center></strong-->
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">


                    <div id="panel_list" class="panel panel-default">
                        <div class="panel-heading"><a href="#" class="btn btn-info" id="create_imb" onclick="create_imb()"><i class="fa fa-plus-square fa"></i></a></div>
                        <div class="panel-body">
                            <table id="ttl_table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 20px">No.</th>
                                        <th style="width: 150px;">Nomor Pelayanan</th>
                                        <th style="width: 150px;">Nomor Registrasi</th>
                                        <th style="width: 150px;">Tgl Pembuatan</th>
                                        <th style="width: 150px;">Penanggung Jawab</th>
                                        <th style="width: 100px;"></th>
                                        <th style="width: 100px;"></th>
                                    </tr>
                                </thead>

                                <tbody>

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
                            <form id="form_imb">

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
                                                <input type="hidden" id="id_imb" >
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
                                                <label for="type_imb">Type IMB : </label>
                                            </div>
                                            <div class="col-xs-4">
                                                <select class="form-control">
                                                    <option value="">-- Pilih --</option>
                                                    <option value="1">Rumah Tinggal</option>
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
                                                        <label for="fungsi_bangungan">Fungsi Bangungan : </label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <textarea class="form-control input-sm" id="fungsi_bangunan"></textarea>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label for="penanggung_jawab">Penanggung Jawab : </label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <input type="text" class="form-control input-sm" id="penanggung_jawab" placeholder="No. Telp"/>
                                                    </div>
                                                </div>
                                                <br/>
                                            </div>
                                            <div id="info_lain" class="tab-pane fade">
                                                <br><br>
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label for="lokasi_bangunan">Lokasi Bangunan </label>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label for="alamat_bangunan">Penaggung Jawab : </label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <textarea class="form-control input-sm" id="alamat_bangunan"></textarea>
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
                                                        <label for="bidang_pekerjaan">Garis sempadan dan Bangunan : </label>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label for="sempadan_bangunan">Sempadan Bangunan (M2) : </label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <input type="text" class="form-control input-sm" id="sempadan_bangunan"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label for="dari_as_jalan">Dari As Jalan : </label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <textarea class="form-control input-sm" id="dari_as_jalan"></textarea>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label for="sempadan_pagar">Sempadan Pagar (M2) : </label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <input type="text" class="form-control input-sm" id="sempadan_bangunan"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label for="dari_as_jalan2">Dari As Jalan : </label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <textarea class="form-control input-sm" id="dari_as_jalan2"></textarea>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                        <label for="luas_bangunan_terdiri">Luas Bangunan Terdiri dari  : </label>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label for="terdiri_a">A : </label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <textarea class="form-control input-sm" id="terdiri_a"></textarea>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label for="terdiri_b">B : </label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <textarea class="form-control input-sm" id="terdiri_b"></textarea>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label for="terdiri_c">C : </label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <textarea class="form-control input-sm" id="terdiri_c"></textarea>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label for="terdiri_d">D : </label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <textarea class="form-control input-sm" id="terdiri_d"></textarea>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                        <label for="bangunan_sarana_terdiri">Bangunan Sarana Terdiri dari : </label>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label for="terdiri_a">A : </label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <textarea class="form-control input-sm" id="terdiri_a"></textarea>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label for="terdiri_b">B : </label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <textarea class="form-control input-sm" id="terdiri_b"></textarea>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label for="terdiri_c">C : </label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <textarea class="form-control input-sm" id="terdiri_c"></textarea>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label for="terdiri_d">D : </label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <textarea class="form-control input-sm" id="terdiri_d"></textarea>
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
                                                        <label for="retribusi">Jumlah Retribusi : </label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <input type="text" class="form-control input-sm" id="retribusi"/>
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