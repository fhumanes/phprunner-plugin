<?php
	session_start();
	$linkdocky = $_REQUEST['value'];
	parse_str($linkdocky, $_GET);
	include('getfile.php');
	$linkdocky = "http://docs.google.com/viewer?url=" . $linkdocky . "&embedded=true";
	if($esimagen=='s') $linkdocky = $dockypath;
?>
<html>
	<head>
		<meta charset="ISO-8552-0">
		<script type="text/javascript" src="../../../../include/jquery.js"></script>
	</head>

  <body>
	<!-- Alternativa: http://docs.google.com/gview? -->
	<iframe id="mibdockycontentpop" src="<?= $linkdocky ?>" style="width:100%;height:95%" frameborder="0"></iframe>
	<script>
		function borrar() { $.get('del.php', {f:'<?= $dockypath ?>'}, function(data) { }); }
	</script>
  </body>
</html>