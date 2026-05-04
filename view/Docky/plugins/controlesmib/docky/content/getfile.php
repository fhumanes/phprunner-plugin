<?php 
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

require_once("../../../../include/dbcommon.php");

$table = postvalue("table");
$strTableName = GetTableByShort($table);

if (!checkTableName($table))
{
	exit(0);
}

require_once("../../../../include/".$table."_variables.php");

$strFilename = postvalue("filename");
$ext = substr($strFilename, strlen($strFilename)-4);
$ctype = getContentTypeByExtension($ext);

$field = postvalue("field");
if(!$gSettings->checkFieldPermissions($field))
	exit();

if(!$gQuery->HasGroupBy())
{
	// Do not select any fields except current (file) field.
	// If query has 'group by' clause then other fields are used in it and we may not simply cut 'em off.
	// Just don't do anything in that case.
	$gQuery->RemoveAllFieldsExcept($gSettings->getFieldIndex($field));
}

$_connection = $cman->byTable( $strTableName );

//	construct sql
$keysArr = $gSettings->getTableKeys();
$keys = array();
foreach ($keysArr as $ind=>$k)
{	
	$keys[$k]=postvalue("key".($ind+1));
}
$where = KeyWhere($keys);

if ($gSettings->getAdvancedSecurityType() == ADVSECURITY_VIEW_OWN)
{
	$where=whereAdd($where,SecuritySQL("Search"));	
}


$sql = $gQuery->gSQLWhere($where);
$qResult = $_connection->query( $sql );
if( !$qResult || !($data = $qResult->fetchAssoc()) )
	return;

$value = $_connection->stripSlashesBinary( $data[$field ] );

$dockypath = '../../../../plugins/controlesmib/docky/content/files/'.date('YmdHis').$strFilename;
$archivo = fopen($dockypath, 'a');
fwrite($archivo, print_r($value, true));
fclose($archivo);
$linkdocky = (isset($_SERVER['HTTPS'])?'https':'http').'://'.$_SERVER[HTTP_HOST].'/'.str_replace('../../../../','',$dockypath);

require_once('mime_type_lib.php');
$mime_type = get_file_mime_type($dockypath);
$esimagen = 'n'; if(strstr($mime_type, 'image/')) $esimagen = 's';

return;

?>
