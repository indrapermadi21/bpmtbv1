<script type="text/javascript">

    $(document).ready(function () {
        $(".datepicker").datepicker({
            changeMonth: true,
            changeYear: true
        }).on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });
        
        $('#filter_data').click(function(){
            var data = {
                tgl_awal : $('#tgl_awal').val(),
                tgl_akhir : $('#tgl_akhir').val(),
                jenis_perizinan : $('#jenis_perizinan').val()
            };
            
            $.post('<?php echo base_url()?>report_usaha/jenisIzin/getJenisIzin',data,function(r){
                $('#show_result').html(r.html);
            },'json');
        });
        
        $('#preview_data').click(function(){
            var data = {
                tgl_awal : $('#tgl_awal').val(),
                tgl_akhir : $('#tgl_akhir').val(),
                jenis_perizinan : $('#jenis_perizinan').val()
            };
            
            window.open('<?php echo base_url() ?>report_usaha/jenisIzin/preview/?awal=' + data.tgl_awal + '&akhir='+ data.tgl_akhir + '&jp=' + data.jenis_perizinan); 
        });
        
        $('#export_data').click(function(){
            var data = {
                tgl_awal : $('#tgl_awal').val(),
                tgl_akhir : $('#tgl_akhir').val(),
                jenis_perizinan : $('#jenis_perizinan').val()
            };
            
            window.open('<?php echo base_url() ?>report_usaha/jenisIzin/preview/?awal=' + data.tgl_awal + '&akhir='+ data.tgl_akhir + '&jp=' + data.jenis_perizinan+ '&ex=yes'); 
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
                    <table border="0" width="550px">
                        <tr>
                            <td width="300px">Tanggal</td>
                            <td width="25px">:</td>
                            <td width="150px"><input type="text" style="width: 200px" class="form-control input-sm datepicker" id="tgl_awal"/></td>
                            <td width="25px" align="center">-</td>
                            <td width="150px"><input type="text" style="width: 200px" class="form-control input-sm datepicker" id="tgl_akhir"/></td>
                        </tr>
                        <tr>
                            <td colspan="5">&nbsp;</td>
                        </tr>
                        <tr>
                            <td>Jenis Perizinan</td>
                            <td>:</td>
                            <td colspan="2">
                                <select class="form-control input-sm" id="jenis_perizinan" >
                                    <option value="siup">Surat Izin Usaha Perdagangan</option>
                                </select>
                            </td>
                            <td>&nbsp;&nbsp;&nbsp;<button id="filter_data" class="btn btn-info"><span class="fa fa-search">&nbsp;Cari</span></button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button id="preview_data" class="btn btn-success"><span class="fa fa-print"></span></button>&nbsp;<button id="export_data" class="btn btn-primary"><span class="fa fa-file-word-o"></span></button></td>
                        </tr>
                    </table>
                    <br><br><br>
                    <div id="show_result"></div>
                </div><!-- /.box-body -->

            </div><!-- /.box -->
        </div>                
    </div><!--/.row-->

</section><!-- /.content -->