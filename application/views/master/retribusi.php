<script type="text/javascript">

    $(document).ready(function () {
        var panel_list = $('#panel_list');
        var panel_form = $('#panel_form');
        //init 
        panel_form.hide();
        $('#retribusi_table').DataTable({
            
        });
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
        var data = {    
            'id_retribusi':$('#id_retribusi').val(),
            'kategori': $('#kategori').val(),
            'nama': $('#nama').val(),
            'jumlah_retribusi': $('#jumlah_retribusi').val(),
            'form_status': $('#form_status').val()
        };

        $.post('<?php echo base_url() ?>master/retribusi/saved', data, function (r) {
            if (r.success) {
                window.location.href = '<?php echo base_url() ?>master/retribusi';
            }
        }, 'json');
    }

    function edit_retribusi(el) {
        $.post('<?php echo base_url() ?>master/retribusi/getRetribusi', {
            id_retribusi: el
        }, function (r) {
            if (r) {
                $('#id_retribusi').val(r.data.id_retribusi);
                $('#kategori').val(r.data.kategori);
                $('#nama').val(r.data.nama);
                $('#jumlah_retribusi').val(r.data.jumlah_retribusi);
                $('#form_status').val('edit');
                $('#panel_list').hide();
                $('#panel_form').show();
            }
        }, 'json');
    }

    function remove_retribusi(el) {
        $.post('<?php echo base_url() ?>master/retribusi/delete', {
            id_retribusi: el
        }, function (r) {
            if(r.success){
                window.location.href = '<?php echo base_url() ?>master/retribusi';
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
                        <div class="panel-heading"><a href="#" id="create_retribusi" onclick="create_retribusi()"><i class="fa fa-plus-square fa-2x"></i></a></div>
                        <div class="panel-body">
                            <table id="retribusi_table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 20px">No.</th>
                                        <th style="width: 150px;">Kategori</th>
                                        <th style="width: 150px;">Nama</th>
                                        <th style="width: 150px;">Jumlah Retribusi</th>
                                        <th style="width: 5px;"></th>
                                        <th style="width: 5px;"></th>
                                        <th style="width: 5px;"></th>
                                        <th style="width: 5px;"></th>
                                    </tr>
                                </thead>

                                <tbody>
                                   <?php
                                    $i = 1;
                                    foreach ($listRetribusi as $r) {
                                        if($r['status']==1){
                                            $color ='red';
                                        }else{
                                            $color ='black';
                                        }
                                        ?>
                                        <tr>
                                            <td><font color="<?php echo $color?>"><?php echo $i?></font></td>
                                            <td><font color="<?php echo $color?>"><?php echo $r['kategori']?></font></td>
                                            <td><font color="<?php echo $color?>"><?php echo $r['nama']?></font></td>
                                            <td><font color="<?php echo $color?>"><?php echo $r['jumlah_retribusi']?></font></td>
                                            <td>
                                                <?php if ($r['status']!= 1) { ?>
                                                <button class="btn btn-info" type="button" id="edit_retribusi" onclick="edit_retribusi(<?php echo $r['id_retribusi'] ?>)"><i class="fa fa-pencil"></i></button>
                                                <?php } else { ?>
                                                    <div style="text-align: center">-</div>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php if ($r['status']!= 1) { ?>
                                                    <button class="btn btn-warning" type="button" id="remove_retribusi" onclick="remove_retribusi(<?php echo $r['id_retribusi'] ?>)"><i class="fa fa-trash"></i></button>
                                                <?php } else { ?>
                                                    <div style="text-align: center">-</div>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <button class="btn btn-success" type="button" id="print" onclick="print_retribusi(<?php echo $r['id_retribusi'] ?>, '')"><i class="fa fa-print"></i></button>
                                            </td>
                                            <td>
                                                <button class="btn btn-primary" type="button" id="print" onclick="print_retribusi(<?php echo $r['id_retribusi'] ?>, 'doc')"><i class="fa fa-file-word-o"></i></button>
                                            </td>
                                        </tr>
                                        <?php
                                        $i++;
                                    } //End of foreach
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