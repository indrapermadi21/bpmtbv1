<script type="text/javascript">

    $(document).ready(function () {
        var panel_list = $('#panel_list');
        var panel_form = $('#panel_form');

        //init 
        panel_form.hide();
        $('#menu_table').dataTable();

    });

    //kembali ke tampillan tabel 
    function back_grid() {
        $('#panel_form').hide();
        $('#panel_list').show();
    }
    
    
    //memunculkan form menu
    function create_menu() {
        $('#form_menu').trigger('reset');
        $('#form_status').val('add');
        $('#panel_form').show();
        $('#panel_list').hide();
    }

    //fungsi untuk proses save data
    function save_menu() {
        var form_status = $('#form_status').val();

        var data = {
            menu_name : $('#menu_name').val(),
            menu_group_id : $('#menu_group_id').val(),
            path : $('#path').val(),
            menu_desc : $('#menu_desc').val(),
            menu_id : $('#menu_id').val()
        };
        

        if (form_status == 'add') {
            $.post('<?php echo base_url() ?>administrasi/menu/save',data, function (r) {
                alert(r.success);
                
                if (r.success) {
                    window.location.href = '<?php echo base_url() ?>administrasi/menu';
                }
            },'json')
        } else {
            $.post('<?php echo base_url() ?>administrasi/menu/edit',data, function (r) {
                if (r.success) {
                    window.location.href = '<?php echo base_url() ?>administrasi/menu';
                }
            },'json')
        }
    }

    function edit_menu(el) {

        $.post('<?php echo base_url() ?>administrasi/menu/get_menu', {
            menu_id: el
        }, function (r) {
            if (r) {
                $('#menu_id').val(r.data.menu_id);
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

    function remove_menu(el) {
        $.post('<?php echo base_url() ?>administrasi/menu/delete', {
            menu_id: el
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
                        <div class="panel-heading"><a href="#" id="create_menu" onclick="create_menu()"><i class="fa fa-user-plus fa-2x"></i></a></div>
                        <div class="panel-body">
                            <table id="menu_table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 20px">No.</th>
                                        <th style="width: 150px;">Menu Name</th>
                                        <th style="width: 150px;">Group Name</th>
                                        <th style="width: 300px;">Description</th>
                                        <th style="width: 300px;">Path</th>
                                        <th style="width: 100px;"></th>
                                        <th style="width: 100px;"></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($list_menu as $r) {
                                        ?>

                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $r->menu_name ?></td>
                                            <td><?php echo $r->group_name; ?></td>
                                            <td><?php echo $r->menu_desc ?></td>
                                            <td><?php echo $r->path ?></td>
                                            <td>
                                                <button class="btn btn-info" type="button" id="edit_menu" onclick="edit_menu(<?php echo $r->menu_id ?>)"><i class="fa fa-pencil"></i></button>
                                            </td>
                                            <td>
                                                <button class="btn btn-warning" type="button" id="remove_menu" onclick="remove_menu(<?php echo $r->menu_id ?>)"><i class="fa fa-trash"></i></button>

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
                                <div class="row">
                                    <div class="col-xs-2">
                                        <label for="menu_name">Name : </label>
                                    </div>
                                    <div class="col-xs-4">
                                        <input type="hidden" id="form_status" >
                                        <input type="hidden" id="menu_id" >
                                        <input type="text" class="form-control input-sm" id="menu_name"/>
                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    <div class="col-xs-2">
                                        <label for="menu_desc">Description: </label>
                                    </div>
                                    <div class="col-xs-4">
                                        <input type="text" class="form-control input-sm" id="menu_desc"/>
                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    <div class="col-xs-2">
                                        <label for="path">Path : </label>
                                    </div>
                                    <div class="col-xs-4">
                                        <input type="text" class="form-control input-sm" id="path"/>
                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    <div class="col-xs-2">
                                        <label for="fullname">Menu Group: </label>
                                    </div>
                                    <div class="col-xs-4">
                                            <select class="form-control" id="menu_group_id">
                                                <option value="0">-- Pilih --</option>
                                                <?php
                                                foreach($list_menu_group as $r){
                                                ?>
                                                <option value="<?php echo $r->menu_group_id?>"><?php echo $r->name?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                    </div>
                                </div>
                                <br/>
                            </form>
                        </div>
                    </div>



                </div><!-- /.box-body -->

            </div><!-- /.box -->
        </div>                
    </div><!--/.row-->

</section><!-- /.content -->