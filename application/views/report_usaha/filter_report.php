<script type="text/javascript">

    $(document).ready(function () {
        $(".datepicker").datepicker({
            changeMonth: true,
            changeYear: true
        }).on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });
        //init
        $('.filter_period').show();
        $('.filter_bulan').hide();

        $('#filter_type').change(function () {
            var filter_type = $('#filter_type').val();
            if (filter_type === 'bulan') {
                $('.filter_bulan').show();
                $('.filter_period').hide();
            } else {
                $('.filter_period').show();
                $('.filter_bulan').hide();
            }
        });

        $('#filter_data').click(function () {
            var data = {
                tgl_bulan: $('#tgl_bulan').val(),
                tgl_awal: $('#tgl_awal').val(),
                tgl_akhir: $('#tgl_akhir').val(),
                per_type: $('#per_type').val(),
                per_kec: $('#per_kec').val(),
                filter_type: $('#filter_type').val(),
                jenis_perizinan: $('#jenis_perizinan').val()
            };

            $.post('<?php echo base_url() ?>report_usaha/jenisIzin/getJenisIzin', data, function (r) {
                $('#show_result').html(r.html);
            }, 'json');
        });

        $('#preview_data').click(function () {
            var data = {
                tgl_bulan: $('#tgl_bulan').val(),
                tgl_awal: $('#tgl_awal').val(),
                tgl_akhir: $('#tgl_akhir').val(),
                per_type: $('#per_type').val(),
                per_kec: $('#per_kec').val(),
                filter_type: $('#filter_type').val(),
                jenis_perizinan: $('#jenis_perizinan').val()
            };

            window.open('<?php echo base_url() ?>report_usaha/jenisIzin/preview/?awal=' + data.tgl_awal + '&akhir=' + data.tgl_akhir + '&jp=' + data.jenis_perizinan);
        });

        $('#export_data').click(function () {
            var data = {
                tgl_bulan: $('#tgl_bulan').val(),
                tgl_awal: $('#tgl_awal').val(),
                tgl_akhir: $('#tgl_akhir').val(),
                per_type: $('#per_type').val(),
                per_kec: $('#per_kec').val(),
                filter_type: $('#filter_type').val(),
                jenis_perizinan: $('#jenis_perizinan').val()
            };

            window.open('<?php echo base_url() ?>report_usaha/jenisIzin/preview/?awal=' + data.tgl_awal + '&akhir=' + data.tgl_akhir + '&jp=' + data.jenis_perizinan + '&ex=yes');
        });
    });
</script>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <strong><center><h2>Laporan Pelayanan Perizinan per Jenis Izin Usaha</h2></center></strong>
                </div><!-- /.box-header -->
                <div class="box-body ">
                    <table border="0" width="1000px">
                        <tr>
                            <td width="300px">Filter Type</td>
                            <td width="25px">:</td>
                            <td width="325px" colspan="3">
                                <select class="form-control input-sm" id="filter_type" style="width: 100px !important; min-width: 50px; max-width: 100px;">
                                    <option value="period" selected>Period</option>
                                    <option value="bulan">Bulan</option>
                                </select>
                            </td>
                            <td width="350px"></td>
                        </tr>
                        <tr>
                            <td colspan="6">&nbsp;</td>
                        </tr>
                        <tr class="filter_bulan">
                            <td width="300px">Tanggal</td>
                            <td width="25px">:</td>
                            <td width="325px" colspan="3"><input type="text" style="width: 410px" class="form-control input-sm datepicker" id="tgl_bulan"/></td>
                            <td width="350px"></td>
                        </tr>
                        <tr class="filter_bulan">
                            <td colspan="6">&nbsp;</td>
                        </tr>
                        <tr class="filter_period">
                            <td width="300px">Tanggal</td>
                            <td width="25px">:</td>
                            <td width="150px"><input type="text" style="width: 200px" class="form-control input-sm datepicker" id="tgl_awal"/></td>
                            <td width="25px" align="center">-</td>
                            <td width="150px"><input type="text" style="width: 200px" class="form-control input-sm datepicker" id="tgl_akhir"/></td>
                            <td width="350px"></td>
                        </tr>
                        <tr class="filter_period">
                            <td colspan="6">&nbsp;</td>
                        </tr>
                        <tr>
                            <td width="300px">Type</td>
                            <td width="25px">:</td>
                            <td width="325px" colspan="3">
                                <select class="form-control input-sm" id="per_type" style="width: 100px !important; min-width: 50px; max-width: 100px;">
                                    <option value="no" selected>No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </td>
                            <td width="350px"></td>
                        </tr>
                        <tr>
                            <td colspan="6">&nbsp;</td>
                        </tr>
                        <tr>
                            <td width="300px">Kecamatan</td>
                            <td width="25px">:</td>
                            <td width="325px" colspan="3">
                                <select class="form-control input-sm" id="per_kec" style="width: 100px !important; min-width: 50px; max-width: 100px;">
                                    <option value="no" selected>No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </td>
                            <td width="350px"></td>
                        </tr>
                        <tr>
                            <td colspan="6">&nbsp;</td>
                        </tr>
                        <tr>
                            <td width="300px">Jenis Perizinan</td>
                            <td width="25px">:</td>
                            <td width="325px" colspan="3">
                                <select class="form-control input-sm" id="jenis_perizinan" >
                                    <option value="-">-- Pilih --</option>
                                    <?php
                                    foreach ($jenisPerizinan as $key => $value) {
                                        ?>
                                        <option value="<?php echo $key?>"><?php echo $value?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </td>
                            <td width="350px">&nbsp;&nbsp;&nbsp;<button id="filter_data" class="btn btn-info"><span class="fa fa-search">&nbsp;Cari</span></button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button id="preview_data" class="btn btn-success"><span class="fa fa-print"></span></button>&nbsp;<button id="export_data" class="btn btn-primary"><span class="fa fa-file-word-o"></span></button></td>
                        </tr>
                    </table>
                    <br><br><br>
                    <div id="show_result"></div>
                </div><!-- /.box-body -->

            </div><!-- /.box -->
        </div>                
    </div><!--/.row-->

</section><!-- /.content -->