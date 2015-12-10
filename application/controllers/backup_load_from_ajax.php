<?php

class Surat_Masuk extends CI_Controller
{
	function __Construct()
	{
		parent::__Construct();
	}

	function index()
	{
		$d['content'] = 'surat_masuk/surat_masuk';
		$this->load->view('template',$d);
	}
	
	function get_data()
	{

	
		/* Array of database columns which should be read and sent back to DataTables. Use a space where
		 * you want to insert a non-database field (for example a counter or static image)
		 */
		$aColumns = array( 'no_agenda', 'status', 'tgl_status', 'no_agenda', 'no_surat_masuk','pengirim','perihal','klasifikasi_surat','derajat_surat' );
		
		/* Indexed column (used for fast and accurate table cardinality) */
		$sIndexColumn = "id";
		
		/* DB table to use */
		$sTable = "surat_masuk";
		
		/* 
		 * Paging
		 */

		$sLimit = "";
		if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
		{
			$sLimit = "LIMIT ".mysql_real_escape_string( $_GET['iDisplayStart'] ).", ".
				mysql_real_escape_string( $_GET['iDisplayLength'] );
		}
		
		
		/*
		 * Ordering
		 */
		if ( isset( $_GET['iSortCol_0'] ) )
		{
			$sOrder = "ORDER BY  ";
			for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
			{
				if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
				{
					$sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
					 	".mysql_real_escape_string( $_GET['sSortDir_'.$i] ) .", ";
				}
			}
			
			$sOrder = substr_replace( $sOrder, "", -2 );
			if ( $sOrder == "ORDER BY" )
			{
				$sOrder = "";
			}
		}
		
		
		/* 
		 * Filtering
		 * NOTE this does not match the built-in DataTables filtering which does it
		 * word by word on any field. It's possible to do here, but concerned about efficiency
		 * on very large tables, and MySQL's regex functionality is very limited
		 */
		$sWhere = "";
		if ( $_GET['sSearch'] != "" )
		{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
		
		/* Individual column filtering */
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			if ( $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
			{
				if ( $sWhere == "" )
				{
					$sWhere = "WHERE ";
				}
				else
				{
					$sWhere .= " AND ";
				}
				$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
			}
		}
		
		
		/*
		 * SQL queries
		 * Get data to display
		 */
		$sQuery = $this->db->query('
			SELECT SQL_CALC_FOUND_ROWS '.str_replace(" , ", " ", implode(", ", $aColumns)).'
			FROM   '.$sTable.'
			'.$sWhere.'
			'.$sOrder.'
			'.$sLimit.'');
		/*$sQuery = "
			SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."
			FROM   $sTable
			$sWhere
			$sOrder
			$sLimit
		";*/
		//$rResult = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
		$rResult = $sQuery;
		
		// Data set length after filtering 
		/*$sQuery = "
			SELECT FOUND_ROWS()
		";*/
		$sQuery = $this->db->query("
			SELECT FOUND_ROWS() as count");

		//echo $sQuery;
		//$rResultFilterTotal = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
		//$aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
		
		$rResultFilterTotal = $sQuery;
		$aResultFilterTotal = $rResultFilterTotal->row()->count;
		$iFilteredTotal = $aResultFilterTotal[0];
		
		/* Total data set length */
		/*$sQuery = "
			SELECT COUNT(".$sIndexColumn.")
			FROM   $sTable
		";*/
		$sQuery = $this->db->query("
				SELECT COUNT(".$sIndexColumn.")
				FROM ".$sTable."
			");
		$rResultTotal = $sQuery;
		$aResultTotal = $rResultTotal->result_array();
		$iTotal = $aResultTotal[0];
		
		/*
		 * Output
		 */
		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $iTotal,
			"iTotalDisplayRecords" => $iFilteredTotal,
			"aaData" => array()
		);
		

		foreach($rResult->result_array() as $aRow )
		{
			$row = array();
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				/*if ( $aColumns[$i] == "version" )
				{
					/* Special output formatting for 'version' column */
				/*	$row[] = ($aRow[ $aColumns[$i] ]=="0") ? '-' : $aRow[ $aColumns[$i] ];
				}
				else */
				if ( $aColumns[$i] != ' ' )
				{
					/* General output */
					$row[] = $aRow[ $aColumns[$i] ];
				}
			}
			$output['aaData'][] = $row;
		}
		echo json_encode($output);
	}

	function save()
	{
		
	}

	function edit()
	{
		
	}

	function delete()
	{
		
	}
}

?>