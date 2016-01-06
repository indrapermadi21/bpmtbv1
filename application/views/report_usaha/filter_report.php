<script type="text/javascript">
	var page_current = 1;
	var page_total = 1;
	var row_start = 1;
	var row_end = 1;
	var row_total = 1;

	var tgl_awal = '';
	var tgl_akhir = '';
	var tgl_bulan = '';
	var jenis_perizinan = '';
	var filter_type = '';
	var per_type = '';
	var per_kecamatan = '';

    $(document).ready(function () {
    	$("#form").validate();

    	refreshFilter($('#filter_type').val());
    	$('#filter_type').change(function(){
        	refreshFilter($(this).val());
        });

    	
        $(".datepicker").datepicker({
            changeMonth: true,
            changeYear: true
        }).on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });

        $(".monthpicker").datepicker({
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,

            onClose: function(dateText, inst) {  
                var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val(); 
                var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val(); 
                $(this).val($.datepicker.formatDate('mm-yy', new Date(year, month, 1)));
            }
        });

        $(".monthpicker").focus(function () {
            $(".ui-datepicker-calendar").hide();
            $("#ui-datepicker-div").position({
                my: "center top",
                at: "center bottom",
                of: $(this)
            });    
        });
        
        $('#filter_data').click(function(){
        	if ($("#form").valid()) {
	            tgl_awal = $('#tgl_awal').val();
	            tgl_akhir = $('#tgl_akhir').val();
	            tgl_bulan = $('#tgl_bulan').val();
	            jenis_perizinan = $('#jenis_perizinan').val();
	            filter_type = $('#filter_type').val();
	            per_type = $('#per_type').val();
	            per_kecamatan = $('#per_kecamatan').val();
	            page_current = 1;
	
	            reloadData();
        	}
        });
        
        $('#preview_data').click(function(){
        	if ($("#form").valid()) {
        		tgl_awal = $('#tgl_awal').val();
	            tgl_akhir = $('#tgl_akhir').val();
	            tgl_bulan = $('#tgl_bulan').val();
	            jenis_perizinan = $('#jenis_perizinan').val();
	            filter_type = $('#filter_type').val();
	            per_type = $('#per_type').val();
	            per_kecamatan = $('#per_kecamatan').val();
	            
	            var data = {
	            		tgl_awal : tgl_awal,
	                    tgl_akhir : tgl_akhir,
	                    tgl_bulan : tgl_bulan,
	                    jenis_perizinan : jenis_perizinan,
	                    filter_type : filter_type,
	                    per_type : per_type,
	                    per_kecamatan : per_kecamatan
	            };

	            var param = decodeURIComponent( $.param(data) );
	            
	            window.open('<?php echo base_url() ?>report/usaha/' + data.jenis_perizinan+ '/download.pdf?' + param);
        	} 
        });
        
        $('#export_data').click(function(){
        	if ($("#form").valid()) {
        		tgl_awal = $('#tgl_awal').val();
	            tgl_akhir = $('#tgl_akhir').val();
	            tgl_bulan = $('#tgl_bulan').val();
	            jenis_perizinan = $('#jenis_perizinan').val();
	            filter_type = $('#filter_type').val();
	            per_type = $('#per_type').val();
	            per_kecamatan = $('#per_kecamatan').val();
	            
	            var data = {
	            		tgl_awal : tgl_awal,
	                    tgl_akhir : tgl_akhir,
	                    tgl_bulan : tgl_bulan,
	                    jenis_perizinan : jenis_perizinan,
	                    filter_type : filter_type,
	                    per_type : per_type,
	                    per_kecamatan : per_kecamatan
	            };

	            var param = decodeURIComponent( $.param(data) );
	            
	            window.location.href = '<?php echo base_url() ?>report/usaha/' + data.jenis_perizinan+ '/download.docx?' + param;
        	} 
        });

        $('#pagination-bar-first-page').click(function(){
            first();
        });
        $('#pagination-bar-prev-page').click(function(){
            prev();
        });
        $('#pagination-bar-next-page').click(function(){
            next();
        });
        $('#pagination-bar-last-page').click(function(){
            last();
        });
        $('#refresh').click(function(){
        	refresh();
        });
    });

    function refreshFilter(filterType){
    	if (filterType == 'bulan'){
        	$('#bulan').fadeIn();
        	$('#period').hide();
    	} else {
    		$('#bulan').hide();
        	$('#period').fadeIn();
    	}
    }

    function refresh(){
        var page_number = $('#page-number').val();
        if (!isNaN(page_number)){
            if (page_number >=1 && page_number <= page_total){
                page_current = page_number;
                reloadData();
            } else {
                alert('Halaman tidak tersedia');
            }
        } else {
        	alert('Halaman harus berupa angka');
        }
    }
    function next(){
    	page_current++;
        reloadData();
    }

    function last(){
    	page_current = page_total;
        reloadData();
    }

    function first(){
    	page_current = 1;
        reloadData();
    }
    
    function prev(){
    	page_current--;
        reloadData();
    }
    
    function reloadData(){
    	var data = {
                tgl_awal : tgl_awal,
                tgl_akhir : tgl_akhir,
                tgl_bulan : tgl_bulan,
                jenis_perizinan : jenis_perizinan,
                filter_type : filter_type,
                per_type : per_type,
                per_kecamatan : per_kecamatan,
                page : page_current
            };

        $('#indicator').fadeIn();
        
       	$.post('<?php echo base_url()?>report_usaha/jenisIzin/getJenisIzin',data,function(r){
                $('#show_result').html(r.html);
            	$("#header-page").fadeIn();
            	$("#show_result").fadeIn();

            	page_current = r.page_current;
            	page_total = r.page_total;
            	row_total = r.row_total;
            	row_start = r.row_start;
            	row_end = r.row_end;
            	
            	$('#jumlah_pelayanan').html(row_total);
            	
            	refreshHeaderPagination();

            	$('#indicator').hide();
            },'json');
    }

    function refreshHeaderPagination(){
    	$("#results").html('Results '+row_start+' - '+row_end+' of '+row_total);
    	$("#total-page-count").html(page_total);

    	$('#page-number').val(page_current);

    	$('#pagination-bar-first-page').removeClass();
    	$('#pagination-bar-prev-page').removeClass();
    	$('#pagination-bar-next-page').removeClass();
    	$('#pagination-bar-last-page').removeClass();

    	$('#pagination-bar-first-page').addClass('pagination-button');
    	$('#pagination-bar-prev-page').addClass('pagination-button');
    	$('#pagination-bar-next-page').addClass('pagination-button');
    	$('#pagination-bar-last-page').addClass('pagination-button');
    	
    	if (page_current == 1){
        	$('#pagination-bar-first-page').addClass('pagination-bar-first-page-disabled');
        	$('#pagination-bar-prev-page').addClass('pagination-bar-prev-page-disabled');
    	}
    	if (page_current == page_total){
        	$('#pagination-bar-next-page').addClass('pagination-bar-next-page-disabled');
        	$('#pagination-bar-last-page').addClass('pagination-bar-last-page-disabled');
    	}

    	if ((page_current+1) <= page_total){
    		$('#pagination-bar-next-page').addClass('pagination-bar-next-page');
    		$('#pagination-bar-last-page').addClass('pagination-bar-last-page');
    	}
    	if ((page_current-1) >= 1){
    		$('#pagination-bar-prev-page').addClass('pagination-bar-prev-page');
    		$('#pagination-bar-first-page').addClass('pagination-bar-first-page');
    	}
    }
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
                	<form id="form">
                    <table border="0">
                        <tr>
                            <td width="200px" style="vertical-align: top;padding-top:5px">Filter Type</td>
                            <td width="25px" style="vertical-align: top;padding-top:5px">:</td>
                            <td width="180px" style="vertical-align: top">
                            	<select id="filter_type" name="filter_type" class="form-control input-sm">
                            		<option value="period">Period</option>
                            		<option value="bulan">Bulan</option>
                            	</select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5">&nbsp;</td>
                        </tr>
                        <tr id="period">
                            <td width="200px" style="vertical-align: top;padding-top:5px">Tanggal</td>
                            <td width="25px" style="vertical-align: top;padding-top:5px">:</td>
                            <td width="180px" style="vertical-align: top"><input type="text" class="form-control input-sm datepicker" id="tgl_awal" name="tgl_awal" required="required"/></td>
                            <td width="25px" align="center" style="vertical-align: top;padding-top:5px">-</td>
                            <td width="180px" style="vertical-align: top"><input type="text" style="width: 180px" class="form-control input-sm datepicker" id="tgl_akhir" name="tgl_akhir" required="required"/></td>
                        </tr>
                        <tr id="bulan" style="display: none">
                            <td width="200px" style="vertical-align: top;padding-top:5px">Bulan</td>
                            <td width="25px" style="vertical-align: top;padding-top:5px">:</td>
                            <td width="180px" style="vertical-align: top"><input type="text" class="form-control input-sm monthpicker" id="tgl_bulan" name="tgl_bulan" required="required"/></td>
                            <td width="25px" align="center" style="vertical-align: top;padding-top:5px"></td>
                            <td width="180px" style="vertical-align: top"></td>
                        </tr>
                        <tr>
                            <td colspan="5">&nbsp;</td>
                        </tr>
                        <tr>
                            <td width="200px" style="vertical-align: top;padding-top:5px">Per Type</td>
                            <td width="25px" style="vertical-align: top;padding-top:5px">:</td>
                            <td width="180px" style="vertical-align: top">
                            	<select id="per_type" name="per_type" class="form-control input-sm">
                            		<option value="yes">Yes</option>
                            		<option value="no">No</option>
                            	</select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5">&nbsp;</td>
                        </tr>
                        <tr>
                            <td width="200px" style="vertical-align: top;padding-top:5px">Per Kecamatan</td>
                            <td width="25px" style="vertical-align: top;padding-top:5px">:</td>
                            <td width="180px" style="vertical-align: top">
                            	<select id="per_kecamatan" name="per_kecamatan" class="form-control input-sm">
                            		<option value="yes">Yes</option>
                            		<option value="no">No</option>
                            	</select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5">&nbsp;</td>
                        </tr>
                        <tr>
                            <td>Jenis Perizinan</td>
                            <td>:</td>
                            <td>
                                <select class="form-control input-sm" id="jenis_perizinan" name="jenis_perizinan" required="required">
                                	<?php
                                	foreach (getTabelJenisPerizinan() as $key => $value) {?>
                                		<option value="<?=$key?>"><?=$value?></option>
                                	<?php 
                                	} 
                                	?>
                                </select>
                            </td>
                            <td></td>
                            <td width="300px">&nbsp;&nbsp;&nbsp;<button type="button" id="filter_data" class="btn btn-info"><span class="fa fa-search">&nbsp;Cari</span></button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" id="preview_data" class="btn btn-success"><span class="fa fa-print"></span></button>&nbsp;<button type="button" id="export_data" class="btn btn-primary"><span class="fa fa-file-word-o"></span></button></td>
                        </tr>
                    </table>
                    </form>
                    <br><br><br>
                    <div id="indicator" style="display:none"><img title="Loading... Please wait..." src="<?=base_url()?>inc/img/ajax-loader.gif"/> Loading data...</div>
                    <div id="header-page" class="header-page" style="display: none">
	                    <div class="king-table-region theme-clear">
		                    <div class="pagination-bar">
			                    <span class="pagination-bar-buttons">
									<span id="pagination-bar-first-page" class="pagination-button pagination-bar-first-page-disabled" title="First" tabindex="0"></span>
									<span id="pagination-bar-prev-page" class="pagination-button pagination-bar-prev-page-disabled" title="Previous" tabindex="0"></span>
									<span class="separator"></span>
									<span class="valigned">Page </span>
									<input class="w30 must-integer pagination-bar-page-number" value="1" text="text" id="page-number" name="page-number">
									<span class="valigned total-page-count"> of <span id="total-page-count">-</span></span>
									<span class="separator"></span>
									<span id="refresh" class="pagination-button pagination-bar-refresh" title="Refresh" tabindex="0"></span>
									<span class="separator"></span>
									<span id="pagination-bar-next-page" class="pagination-button pagination-bar-next-page" title="Next" tabindex="0"></span>
									<span id="pagination-bar-last-page" class="pagination-button pagination-bar-last-page" title="Last" tabindex="0"></span>
<!-- 									<span class="separator"></span> -->
<!-- 									<span class="valigned">Results per page</span> -->
<!-- 									<select class="pagination-bar-results-select valigned" name="pageresults"> -->
<!-- 										<option value="10">10</option> -->
<!-- 										<option selected="selected" value="30">30</option> -->
<!-- 										<option value="50">50</option> -->
<!-- 										<option value="100">100</option> -->
<!-- 									</select> -->
									<span class="separator"></span>
									<span id="results" class="valigned m0"></span>
									<span class="separator"></span>
								</span>
								<span class="pagination-bar-filters">
									<input class="search-field" type="text" value="" placeholder="Search...">
								</span>
							</div>
	                    </div>
                    </div>
                    <br/>
					<div id="show_result" style="display: none"></div>
                </div><!-- /.box-body -->

            </div><!-- /.box -->
        </div>                
    </div><!--/.row-->

</section><!-- /.content -->
