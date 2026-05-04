<?php
require_once("include/dbcommon.php");

$field_dest = postvalue("f");

$sql = $_SESSION['SELECT2_AJAX_SQL'][$field_dest];
$session_param = postvalue("session");
$session_value = $_SESSION[$session_param][$field_dest];
$search_value = postvalue("q");


if ($search_value === null) { // no hay filtro/search
    $search_value = '';
}

$sql = str_replace("{search}", $search_value, $sql);
$sql = str_replace("{".$session_param.'}', $session_value, $sql);

$options = [];

$data = array();
$rs = DB::Query($sql);
while( $data_rs = $rs->fetchNumeric() )
{
    $data[] = $data_rs;
}
$dataRows = count($data);

for ($x = 0; $x < $dataRows; $x++) { // All Record
    $field1 = $data[$x][0]; // Key
    $field2 = htmlspecialchars($data[$x][1]); // Values
    $options[] = array('id'=> $field1, 'text' => $field2
    ) ;
}

echo my_json_encode($options);



