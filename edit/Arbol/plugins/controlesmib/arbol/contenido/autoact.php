<?php
include("../../../../include/dbcommon.php");
global $conn;
$_REQUEST['id'] = explode(';;mib;;',$_REQUEST['id'])[12];
$_REQUEST['id'] = str_replace(' ','+',$_REQUEST['id']);
$claveencr = '$a<A&>+@ioK*UY673#-.,;';
// $_REQUEST['id'] = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($claveencr), base64_decode($_REQUEST['id']), MCRYPT_MODE_CBC, md5(md5($claveencr))), "\0");
$_REQUEST['id'] = rtrim( base64_decode($_REQUEST['id']), "\0");
$mibrs = db_query($_REQUEST['id'], $conn);
while( 
$mibdato = db_fetch_numarray($mibrs) ) {
	
if(
$mibdato[0] == $_REQUEST['valor'])
 { $mibcampodescripcion = $mibdato[1]; break; }
}
echo(htmlspecialchars($mibcampodescripcion));

unset($mibrs, $mibdato, $mibcampodescripcion, $claveencr);

?>