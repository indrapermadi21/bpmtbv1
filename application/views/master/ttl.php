<script type="text/javascript">

    $(document).ready(function () {
        var panel_list = $('#panel_list');
        var panel_form = $('#panel_form');

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
                                        <th style="width: 150px;">NIP</th>
                                        <th style="width: 150px;">Nama Pegawai</th>
                                        <th style="width: 150px;">Jabatan</th>
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
                                        Input Pegawai
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <label for="nip">NIP : </label>
                                            </div>
                                            <div class="col-xs-4">
                                                <input type="text" class="form-control input-sm" id="nip"/>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <label for="nama_pegawai">Nama Pegawai : </label>
                                            </div>
                                            <div class="col-xs-4">
                                                <input type="hidden" id="form_status" >
                                                <input type="hidden" id="id_ttl" >
                                                <input type="text" class="form-control input-sm" id="nama_pegawai"/>
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