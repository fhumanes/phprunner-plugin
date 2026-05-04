<?php

include("include/dbcommon.php");

$strSQL = "select ".AddFieldWrappers($_SESSION['tagit_field'])." from ".
	AddTableWrappers($_SESSION['tagit_table'])." where ".AddFieldWrappers($_SESSION['tagit_field'])." like '%" . 
	db_addslashes($_GET['term']) . "%'";
$strSQL = addLimitClause($strSQL);

$rs = CustomQuery($strSQL);
$arr = array();
while ( $data = db_fetch_array($rs)) {

	$arr[]=array("value"=>$data[$_SESSION['tagit_field']]);
	
}

echo json_encode($arr);

function addLimitClause($strSQL) {

	$dbType=GetGlobalData("dbType",0);
	$pageSize=15;

	if($dbType == nDATABASE_MySQL) {
		$strSQL.= " limit 0,".$pageSize;
	} 
	elseif($dbType == nDATABASE_MSSQLServer) 
	{
		$strSQL = AddTop($strSQL, $pageSize);
	} 
	elseif($dbType == nDATABASE_Access) 
	{
		$strSQL = AddTop($strSQL, $pageSize);
	} 
	elseif($dbType == nDATABASE_Oracle) 
	{
		$strSQL = AddRowNumber($strSQL, $pageSize);
	}
	elseif($dbType == nDATABASE_PostgreSQL) 
	{
		$strSQL.= " limit ".$pageSize;
	}
	elseif($dbType == nDATABASE_DB2) 
	{
		$strSQL  = "with DB2_QUERY as (".$strSQL.") select * from DB2_QUERY where DB2_ROW_NUMBER between 0 and ".($pageSize);
	} 
	elseif($dbType == nDATABASE_Informix) 
	{
		$strSQL= AddTopIfx($strSQL,$pageSize);
	}
	elseif($dbType == nDATABASE_SQLite3) 
	{
		$strSQL.= " limit 0,".$pageSize;
	}

	return $strSQL;
}


?>