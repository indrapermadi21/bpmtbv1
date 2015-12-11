<script type="text/javascript">

    $(document).ready(function () {
        var panel_list = $('#panel_list');
        var panel_form = $('#panel_form');
        //init 
        panel_form.hide();
        $('#pegawai_table').DataTable({
            
        });
    });
    //kembali ke tampillan tabel 
    function back_grid() {
        $('#panel_form').hide();
        $('#panel_list').show();
    }


    //memunculkan form menu
    function create_pegawai() {
        $('#form_menu').trigger('reset');
        $('#form_status').val('add');
        $('#panel_form').show();
        $('#panel_list').hide();
    }

    //fungsi untuk proses save data
    function save_menu() {
        var data = {    
            'nip': $('#nip').val(),
            'nama_pegawai': $('#nama_pegawai').val(),
            'jabatan': $('#jabatan').val(),
            'form_status': $('#form_status').val()
        };

        $.post('<?php echo base_url() ?>master/pegawai/saved', data, function (r) {
            if (r.success) {
                window.location.href = '<?php echo base_url() ?>master/pegawai';
            }
        }, 'json');
    }

    function edit_pegawai(el) {
        $.post('<?php echo base_url() ?>master/pegawai/getPegawai', {
            nip: el
        }, function (r) {
            
            if (r) {
                $('#nip').val(r.data.nip);
                $('#nip').attr('readonly', true);
                $('#nama_pegawai').val(r.data.nama_pegawai);
                $('#jabatan').val(r.data.jabatan);
                $('#form_status').val('edit');
                $('#panel_list').hide();
                $('#panel_form').show();
            }
        }, 'json');
    }

    function remove_pegawai(el) {
        $.post('<?php echo base_url() ?>master/pegawai/delete', {
            nip: el
        }, function (r) {
            if(r.success){
                window.location.href = '<?php echo base_url() ?>master/pegawai';
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
                        <div class="panel-heading"><a href="#" id="create_pegawai" onclick="create_pegawai()"><i class="fa fa-plus-square fa-2x"></i></a></div>
                        <div class="panel-body">
                            <table id="pegawai_table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 20px">No.</th>
                                        <th style="width: 150px;">NIP</th>
                                        <th style="width: 150px;">Nama</th>
                                        <th style="width: 150px;">Jabatan</th>
                                        <th style="width: 5px;"></th>
                                        <th style="width: 5px;"></th>
                                        <th style="width: 5px;"></th>
                                        <th style="width: 5px;"></th>
                                    </tr>
                                </thead>

                                <tbody>
                                   <?php
                                    $i = 1;
                                    foreach ($listPegawai as $r) {
                                        if($r['status']==1){
                                            $color ='red';
                                        }else{
                                            $color ='black';
                                        }
                                        ?>
                                        <tr>
                                            <td><font color="<?php echo $color?>"><?php echo $i?></font></td>
                                            <td><font color="<?php echo $color?>"><?php echo $r['nip']?></font></td>
                                            <td><font color="<?php echo $color?>"><?php echo $r['nama_pegawai']?></font></td>
                                            <td><font color="<?php echo $color?>"><?php echo $r['jabatan']?></font></td>
                                            <td>
                                                <?php if ($r['status']!= 1) { ?>
                                                <button class="btn btn-info" type="button" id="edit_pegawai" onclick="edit_pegawai(<?php echo $r['nip'] ?>)"><i class="fa fa-pencil"></i></button>
                                                <?php } else { ?>
                                                    <div style="text-align: center">-</div>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php if ($r['status']!= 1) { ?>
                                                    <button class="btn btn-warning" type="button" id="remove_pegawai" onclick="remove_pegawai(<?php echo $r['nip'] ?>)"><i class="fa fa-trash"></i></button>
                                                <?php } else { ?>
                                                    <div style="text-align: center">-</div>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <button class="btn btn-success" type="button" id="print" onclick="print_pegawai(<?php echo $r['nip'] ?>, '')"><i class="fa fa-print"></i></button>
                                            </td>
                                            <td>
                                                <button class="btn btn-primary" type="button" id="print" onclick="print_pegawai(<?php echo $r['nip'] ?>, 'doc')"><i class="fa fa-file-word-o"></i></button>
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
                                            <div class="col-lg-2">
                                                <label for="nip">NIP : </label>
                                            </div>
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control input-sm" id="nip"/>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <label for="nama_pegawai">Nama Pegawai : </label>
                                            </div>
                                            <div class="col-lg-4">
                                                <input type="hidden" id="id_pegawai" >
                                                <input type="text" class="form-control input-sm" id="nama_pegawai"/>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <label for="jabatan">Jabatan : </label>
                                            </div>
                                            <div class="col-lg-4">
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