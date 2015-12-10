<script type="text/javascript">

    $(document).ready(function () {
        var panel_list = $('#panel_list');
        var panel_form = $('#panel_form');

        //init 
        panel_form.hide();
        $('#user_table').dataTable();

    });

    function back_grid() {
        $('#panel_form').hide();
        $('#panel_list').show();
    }

    function create_user() {
        $('#form_user').trigger('reset');
        $('#form_status').val('add');
        $('#panel_form').show();
        $('#panel_list').hide();
    }

    function save_user() {

        var password = $('#password').val();
        var retype_password = $('#retype_password').val();

        if (password !== retype_password) {
            $('.show_error').append('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong> Password </strong> tidak sama.</div>');
            $('#password').focus();
            return false;
        }

        var data = {
            username: $('#username').val(),
            fullname: $('#fullname').val(),
            password: password,
            email: $('#email').val(),
            role : $('#role').val(),
            form_status: $('#form_status').val(),
            id_user : $('#id_user').val()
        };

        $.post('<?php echo base_url() ?>administrasi/user/save', data, function (r) {
            //console.log(r);
            if (r.success) {
                window.location.href = '<?php echo base_url() ?>administrasi/user';
            }
        },'json');
    }

    function edit_user(el) {
    
        $.post('<?php echo base_url() ?>administrasi/user/getUser', {
            id_user: el
        }, function (r) {
            if (r.success) {
                
                $('#id_user').val(r.data.id_user);
                $('#username').val(r.data.username);
                $('#fullname').val(r.data.fullname);
                $('#email').val(r.data.email);
                $('#role').val(r.data.role);
                $('#form_status').val('edit');
                $('#panel_list').hide();
                $('#panel_form').show();

            }
        }, 'json');
    }

    function remove_user(el) {
        $.post('<?php echo base_url() ?>administrasi/user/delete', {
            id_user: el
        }, function (r) {
            if(r.success){
                window.location.href = '<?php echo base_url() ?>administrasi/user';
            }
        },'json');
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
                        <div class="panel-heading"><a href="#" id="create_user" class="btn btn-info" onclick="create_user()"><i class="fa fa-user-plus fa"></i></a></div>
                        <div class="panel-body">
                            <div style="text-align: center"><h3>Manajemen User</h3></div>
                            <table id="user_table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 20px">No.</th>
                                        <th style="width: 100px;">Username</th>
                                        <th style="width: 500px;">Nama Lengkap</th>
                                        <th style="width: 400px;">Email</th>
                                        <th style="width: 400px;">Role</th>
                                        <th style="width: 5px;"></th>
                                        <th style="width: 5px;"></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($listUser as $r) {
                                        ?>

                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $r['username']; ?></td>
                                            <td><?php echo $r['fullname'] ?></td>
                                            <td><?php echo $r['email'] ?></td>
                                            <td><?php echo roleDesc($r['role']) ?></td>
                                            <td>
                                                <button class="btn btn-info" type="button" id="edit_user" onclick="edit_user(<?php echo $r['id_user'] ?>)"><i class="fa fa-pencil"></i></button>
                                            </td>
                                            <td>
                                                <button class="btn btn-warning" type="button" id="remove_user" onclick="remove_user(<?php echo $r['id_user'] ?>)"><i class="fa fa-trash"></i></button>
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
                            <button class="btn btn-primary" id="save_user" onclick="save_user()"><i class="fa fa-save"></i></button>
                        </div>
                        <div class="panel-body">
                            <div class="show_error"></div>
                            <form id="form_user">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <label for="username">Username : </label>
                                    </div>
                                    <div class="col-lg-4">
                                        <input type="hidden" id="form_status" >
                                        <input type="hidden" id="id_user" >
                                        <input type="text" class="form-control input-sm" id="username"/>
                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    <div class="col-lg-2">
                                        <label for="fullname">Nama Lengkap : </label>
                                    </div>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control input-sm" id="fullname"/>
                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    <div class="col-lg-2">
                                        <label for="password">Password: </label>
                                    </div>
                                    <div class="col-lg-4">
                                        <input type="password" class="form-control input-sm" id="password"/>
                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    <div class="col-lg-2">
                                        <label for="retype_password">Retype Password: </label>
                                    </div>
                                    <div class="col-lg-4">
                                        <input type="password" class="form-control input-sm" id="retype_password"/>
                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    <div class="col-lg-2">
                                        <label for="email">Email : </label>
                                    </div>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control input-sm" id="email"/>
                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    <div class="col-lg-2">
                                        <label for="role">Role : </label>
                                    </div>
                                    <div class="col-lg-4">
                                        <select class="form-control input-sm" id="role">
                                            <option value="0">-</option>
                                            <option value="1">Admin</option>
                                            <option value="2">Back Office</option>
                                            <option value="3">Front Office</option>
                                            <option value="4">Supervisor</option>
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