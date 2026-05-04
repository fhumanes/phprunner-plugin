<?php
require_once("include/dbcommon.php");


$sql = $_SESSION["MultiColumnSql"][postvalue("field")];


$tokens = DB::scanTokenString($sql);
$sqlP = DB::prepareSQL($sql);
if(postvalue($tokens["tokens"][0]."_field")!=false){
    $value = postvalue($tokens["tokens"][0]."_field");
    $sql = str_replace(":".$tokens["tokens"][0],":1",$sql);
    $sqlP = DB::prepareSQL($sql,$value );
}



$result = array();

$rs = DB::Query($sqlP);
while( $items = $rs->fetchNumeric() ) {
    if($items[0] == "" || is_null($items[0]))
        continue;
    $result[] = $items[0];
}
echo my_json_encode($result);


?>