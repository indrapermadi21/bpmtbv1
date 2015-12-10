<script type="text/javascript">

    $(document).ready(function () {
        var panel_list = $('#panel_list');
        var panel_form = $('#panel_form');
        //init 
        panel_form.hide();
        $('#pegawai_table').DataTable({
            "bProcessing": true,
            "bServerSide": true,
            "iDisplayLength": 20,
//"bPaginate": true,
            "bAutoWidth": false,
            "iDisplayStart": 0,
            "bLengthChange": false, //for sorting 10,20,30,50 ....
            "sAjaxSource": "<?php echo base_url() ?>master/pegawai/getDataPegawai",
            "aaSorting": [[1, "desc"]],
            //"sPaginationType": "full_numbers",
            "aoColumns": [
                {"data":"nip","bSearchable": false, "bSortable": false},
                {"data":"nama_lengkap","bSearchable": true, "bSortable": true},
                {"data":"jabatan","bSearchable": false, "bSortable": false}
            ],
            "fnServerData": function (sSource, aoData, fnCallback) {
                $.ajax(
                        {
                            'dataType': 'json',
                            'type': 'POST',
                            'url': sSource,
                            'data': aoData,
                            'success': fnCallback
                        }
                );//end ajx
                // console.log(fnCallback);
            }
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
            'nama_lengkap': $('#nama_lengkap').val(),
            'jabatan': $('#jabatan').val(),
            'form_status': $('#form_status').val()
        };

        $.post('<?php echo base_url() ?>master/pegawai/saved', data, function (r) {
            if (r.success) {

            }
        }, 'json');
    }

    function editPegawai(el) {

        $.post('<?php echo base_url() ?>master/pegawai/getPegawai', {
            nip: el
        }, function (r) {
            if (r) {
                $('#nip').val(r.data.nip);
                $('#nama_lengkap').val(r.data.nama_lengkap);
                $('#jabatan').val(r.data.jabatan);
                $('#form_status').val('edit');
                $('#panel_list').hide();
                $('#panel_form').show();
            }
        }, 'json');
    }

    function remove_pegawai(el) {
        $.post('<?php echo base_url() ?>administrasi/menu/delete', {
            id_pegawai: el
        }, function () {
            window.location.href = '<?php echo base_url() ?>administrasi/menu';
        });
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
                        <div class="panel-heading"><a href="#" id="create_pegawai" onclick="create_pegawai()"><i class="fa fa-plus-square fa-2x"></i></a></div>
                        <div class="panel-body">
                            <table id="pegawai_table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 20px">No.</th>
                                        <th style="width: 150px;">NIP</th>
                                        <th style="width: 150px;">Nama</th>
                                        <th style="width: 300px;">Jabatan</th>
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
                                                <input type="hidden" id="id_pegawai" >
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