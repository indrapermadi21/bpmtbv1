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
        $('#sls_table').dataTable();

    });

    //kembali ke tampillan tabel 
    function back_grid() {
        $('#panel_form').hide();
        $('#panel_list').show();
    }


    //memunculkan form menu
    function create_sls() {
        $('#form_sls').trigger('reset');
        $('#form_status').val('add');
        $('#panel_form').show();
        $('#panel_list').hide();
    }

    //fungsi untuk proses save data
    function save_sls() {
        var form_status = $('#form_status').val();

        var data = {
            jumlah_retribusi: $('#jumlah_retribusi').val(),
            form_status: $('#form_status').val(),
            id_sls: $('#id_sls').val()
            
        };
        
            $.post('<?php echo base_url() ?>c_ppu/sls/save', data, function (r) {
                if (r.success) {
                    window.location.href = '<?php echo base_url() ?>c_ppu/sls';
                }
                
            }, 'json');
    }

    function edit_sls(el) {

        $.post('<?php echo base_url() ?>c_ppu/sls/getSiup', {
            id_sls: el
        }, function (r) {
            if (r) {
                $('#jumlah_retribusi').val(r.data.jumlah_retribusi);
                $('#form_status').val('edit');
                
                $('#panel_list').hide();
                $('#panel_form').show();

            }
        }, 'json');
    }

    function remove_sls(el) {
        $.post('<?php echo base_url() ?>c_ppu/sls/delete', {
            id_sls: el
        }, function (r) {
            if(r.success){
                window.location.href = '<?php echo base_url() ?>c_ppu/sls/';
            }
            
        },'json');
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
                        <div class="panel-heading"><a href="#" id="create_sls" onclick="create_sls()"><i class="fa fa-plus-square fa-2x"></i></a></div>
                        <div class="panel-body">
                            <table id="sls_table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 20px">No.</th>
                                        <th style="width: 150px;">Nomor Pelayanan</th>
                                        <th style="width: 150px;">Tgl Pembuatan</th>
                                        <th style="width: 150px;">Nama Perusahaan</th>
                                        <th style="width: 150px;">Penanggung Jawab</th>
                                        <th style="width: 150px;">Berlaku S/d</th>
                                        <th style="width: 5px;"></th>
                                        <th style="width: 5px;"></th>
                                        <th style="width: 5px;"></th>
                                        <th style="width: 5px;"></th>
                                        
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
                            <button class="btn btn-primary" id="save_sls" onclick="save_sls()"><i class="fa fa-save"></i></button>
                        </div>
                        <div class="panel-body">
                            <form id="form_sls">

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
                                                <input type="hidden" id="id_sls" >
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
                                                <label for="kecamatan">Type Laik Sehat : </label>
                                            </div>
                                            <div class="col-xs-4">
                                                <!--input type="text" class="form-control input-sm" id="nama_perusahaan"/-->
                                                <select class="form-control" id="form_kelurahan">
                                                    <option value="0">-- Pilih Tipe Laik Sehat --</option>
                                                    <option value="1">Laik Sehat 1</option>
                                                </select>
                                            </div>
                                        </div>
                                        <br/>
                                        <br/>
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a data-toggle="tab" href="#info_perusahaan">Informasi Perusahaan</a></li>
                                             <li><a data-toggle="tab" href="#info_penetapan">Informasi Penetapan</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div id="info_perusahaan" class="tab-pane fade in active">
                                                <br><br>
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label for="nama_restoran">Nama Restoran : </label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <input type="text" class="form-control input-sm" id="nama_restoran"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label for="alamat">Alamat Restoran: </label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <textarea class="form-control input-sm" id="alamat_restoran"></textarea>
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
                                                        <!--input type="text" class="form-control input-sm" id="nama_perusahaan"/-->
                                                        <select class="form-control" id="form_kecamatan">
                                                            <option value="0">-- Pilih --</option>
                                                            <option value="1">Cilegon Barat</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label for="kecamatan">Kelurahan : </label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <!--input type="text" class="form-control input-sm" id="nama_perusahaan"/-->
                                                        <select class="form-control" id="form_kelurahan">
                                                            <option value="0">-- Pilih --</option>
                                                            <option value="1">Cilegon Hilir</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label for="luas_tanah">Penanggung Jawab : </label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <input type="text" class="form-control input-sm" id="penanggung_jawab"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label for="alamat_penanggung_jawab">Alamat Penanggung Jawab: </label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <textarea class="form-control input-sm" id="alamat_penanggung_jawab"></textarea>
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