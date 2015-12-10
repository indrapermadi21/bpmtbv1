<script type="text/javascript">

    $(document).ready(function () {
        var panel_list = $('#panel_list');
        var panel_form = $('#panel_form');

        //init 
        panel_form.hide();
        $('#retribusi_table').dataTable();

    });

    //kembali ke tampillan tabel 
    function back_grid() {
        $('#panel_form').hide();
        $('#panel_list').show();
    }


    //memunculkan form menu
    function create_retribusi() {
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
            id_retribusi: $('#id_retribusi').val()
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

    function edit_retribusi(el) {

        $.post('<?php echo base_url() ?>administrasi/menu/get_menu', {
            id_retribusi: el
        }, function (r) {
            if (r) {
                $('#id_retribusi').val(r.data.id_retribusi);
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

    function remove_retribusi(el) {
        $.post('<?php echo base_url() ?>administrasi/menu/delete', {
            id_retribusi: el
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
                        <div class="panel-heading"><a href="#" id="create_retribusi" onclick="create_retribusi()"><i class="fa fa-plus-square fa-2x"></i></a></div>
                        <div class="panel-body">
                            <table id="retribusi_table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 20px">No.</th>
                                        <th style="width: 150px;">Kategori</th>
                                        <th style="width: 150px;">Nama</th>
                                        <th style="width: 300px;">Jumlah Retribusi</th>
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
                                                <label for="kategori">Kategori : </label>
                                            </div>
                                            <div class="col-xs-4">
                                                <!--input type="text" class="form-control input-sm" id="kategori"/-->
                                                <select class="form-control input-sm" id="kategori">
                                                    <option value="1">USAHA</option>
                                                    <option value="2">NON USAHA</option>
                                                </select>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <label for="nama">Nama : </label>
                                            </div>
                                            <div class="col-xs-4">
                                                <input type="hidden" id="form_status" >
                                                <input type="hidden" id="id_retribusi" >
                                                <input type="text" class="form-control input-sm" id="nama"/>
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

                            </form>
                        </div>
                    </div>


                </div><!-- /.box-body -->

            </div><!-- /.box -->
        </div>                
    </div><!--/.row-->

</section><!-- /.content -->