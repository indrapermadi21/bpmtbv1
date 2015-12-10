<script type="text/javascript">

    $(document).ready(function () {
        var panel_list = $('#panel_list');
        var panel_form = $('#panel_form');
        
        $(".datepicker").datepicker({
			changeMonth : true,
            changeYear  : true
		}).on('changeDate',function(ev){
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
    function create_ttl() {
        $('#form_menu').trigger('reset');
        $('#form_status').val('add');
        $('#panel_form').show();
        $('#panel_list').hide();
    }

    //fungsi untuk proses save data
    function save_menu() {
        var form_status = $('#form_status').val();

        var data = {
            menu_name: $('#menu_name').val(),
            menu_group_id: $('#menu_group_id').val(),
            path: $('#path').val(),
            menu_desc: $('#menu_desc').val(),
            id_ttl: $('#id_ttl').val()
        };


        if (form_status == 'add') {
            $.post('<?php echo base_url() ?>administrasi/menu/save', data, function (r) {
                alert(r.success);

                if (r.success) {
                    window.location.href = '<?php echo base_url() ?>administrasi/menu';
                }
            }, 'json')
        } else {
            $.post('<?php echo base_url() ?>administrasi/menu/edit', data, function (r) {
                if (r.success) {
                    window.location.href = '<?php echo base_url() ?>administrasi/menu';
                }
            }, 'json')
        }
    }

    function edit_ttl(el) {

        $.post('<?php echo base_url() ?>administrasi/menu/get_menu', {
            id_ttl: el
        }, function (r) {
            if (r) {
                $('#id_ttl').val(r.data.id_ttl);
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

    function remove_ttl(el) {
        $.post('<?php echo base_url() ?>administrasi/menu/delete', {
            id_ttl: el
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
                        <div class="panel-heading"><a href="#" id="create_ttl" onclick="create_ttl()"><i class="fa fa-plus-square fa-2x"></i></a></div>
                        <div class="panel-body">
                            <table id="ttl_table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 20px">No.</th>
                                        <th style="width: 150px;">Nomor Pelayanan</th>
                                        <th style="width: 150px;">Tgl Pembuatan</th>
                                        <th style="width: 150px;">Nama Perusahaan</th>
                                        <th style="width: 150px;">Penanggung Jawab</th>
                                        <th style="width: 150px;">Berlaku S/d</th>
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
                            <button class="btn btn-primary" id="save_menu" onclick="save_menu()"><i class="fa fa-save"></i></button>
                        </div>
                        <div class="panel-body">
                            <form id="form_menu">

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
                                                <input type="hidden" id="id_ttl" >
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
                                                <select class="form-control">
                                                    <option value="">-- Pilih --</option>
                                                    <option value="1">Khusus</option>
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
                                                        <label for="rt_rw">RT / RW : </label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <input type="text" class="form-control input-sm" id="rt_rw"/>
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
                                                        <label for="npwp_pj">NPWP : </label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <input type="text" class="form-control input-sm" id="npwp_pj"/>
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