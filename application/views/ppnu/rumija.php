<script type="text/javascript">

    $(document).ready(function () {
        var panel_list = $('#panel_list');
        var panel_form = $('#panel_form');

        //init 
        panel_form.hide();
        $('#rumija_table').dataTable();

    });

    //kembali ke tampillan tabel 
    function back_grid() {
        $('#panel_form').hide();
        $('#panel_list').show();
    }


    //memunculkan form menu
    function create_rumija() {
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
            id_rumija: $('#id_rumija').val()
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

    function edit_rumija(el) {

        $.post('<?php echo base_url() ?>administrasi/menu/get_menu', {
            id_rumija: el
        }, function (r) {
            if (r) {
                $('#id_rumija').val(r.data.id_rumija);
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

    function remove_rumija(el) {
        $.post('<?php echo base_url() ?>administrasi/menu/delete', {
            id_rumija: el
        }, function () {
            window.location.href = '<?php echo base_url() ?>administrasi/menu';
        })
    }
    
    function print_rumija(el){
        window.open('<?php echo base_url()?>c_ppnu/rumija/export_doc/' + el );
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
                        <div class="panel-heading"><a href="#" id="create_rumija" onclick="create_rumija()"><i class="fa fa-plus-square fa-2x"></i></a></div>
                        <div class="panel-body">
                            <table id="rumija_table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 20px">No.</th>
                                        <th style="width: 150px;">Nomor</th>
                                        <th style="width: 150px;">Pemohon</th>
                                        <th style="width: 300px;">Tanggal</th>
                                        <th style="width: 300px;">Nama Badan Usaha</th>
                                        <th style="width: 300px;">No. Telp</th>
                                        <th style="width: 50px;"></th>
                                        <th style="width: 50px;"></th>
                                        <th style="width: 50px;"></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($list_rumija as $r) {
                                        ?>

                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $r->nomor ?></td>
                                            <td><?php echo $r->pemohon; ?></td>
                                            <td><?php echo $r->tgl_pengajuan ?></td>
                                            <td><?php echo $r->nama_badan_usaha ?></td>
                                            <td><?php echo $r->telp_pemohon ?></td>
                                            <td>
                                                <button class="btn btn-info" type="button" id="edit_rumija" onclick="edit_rumija(<?php echo $r->id_rumija ?>)"><i class="fa fa-pencil"></i></button>
                                            </td>
                                            <td>
                                                <button class="btn btn-warning" type="button" id="remove_rumija" onclick="remove_rumija(<?php echo $r->id_rumija ?>)"><i class="fa fa-trash"></i></button>
                                            </td>
                                            <td>
                                                <button class="btn btn-success" type="button" id="print" onclick="print_rumija(<?php echo $r->id_rumija ?>)"><i class="fa fa-file-word-o"></i></button>
                                            </td>
                                        </tr>

                                        <?php
                                        $i++;
                                    }//end foreach
                                    ?>

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

                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        Rumija
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <label for="nomor">Jenis Perijinan : </label>
                                            </div>
                                            <div class="col-xs-4">
                                                <input type="text" class="form-control input-sm" id="nomor"/>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <label for="tgl_pengajuan">Tanggal Pembuatan : </label>
                                            </div>
                                            <div class="col-xs-4">
                                                <input type="hidden" id="form_status" >
                                                <input type="hidden" id="id_rumija" >
                                                <input type="text" class="form-control input-sm" id="tgl_pengajuan"/>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <label for="pemohon">Nomor Pelayanan : </label>
                                            </div>
                                            <div class="col-xs-4">
                                                <input type="text" class="form-control input-sm" id="pemohon"/>
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
                                                    <label for="fullname">Tipe Rumija: </label>
                                            </div>
                                            <div class="col-xs-4">
                                                <select class="form-control" id="menu_group_id">
                                                    <option value="0">-- Pilih Tipe Rumija --</option>
                                                    <?php
                                                    foreach ($list_menu_group as $r) {
                                                        ?>
                                                        <option value="<?php echo $r->menu_group_id ?>"><?php echo $r->name ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <br/>
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