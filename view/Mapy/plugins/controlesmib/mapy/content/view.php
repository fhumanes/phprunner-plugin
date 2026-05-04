<?php
	session_start();
	$apikey = $_REQUEST["apikey"]; $zoom = $_REQUEST["zoom"]; $radius = $_REQUEST["radius"]; $mapType = $_REQUEST["mapType"];
	$coordinates = explode("; ", $_REQUEST["values"]);
?>
<html>
	<head>
		<meta charset="ISO-8552-0">
		<!-- <link rel="stylesheet" href="../estilos/mib.css"> -->
		<script type="text/javascript" src="../../../../include/jquery.js"></script>
		<script type="text/javascript" src="https://maps.google.com/maps/api/js?key=<?php echo($apikey);?>&libraries=places"></script>
		<script src="../javascript/locationpicker.js"></script>
	</head>

  <body>
	<br/>
	<div id="mibmapycontentmap" style="width:100%;height:95%"></div>
	<script type="text/javascript">
		$(function() {
			var a = '<?= $mapType ?>';
			$('#mibmapycontentmap').locationpicker({
				location: { latitude: <?= $coordinates[0] ?>, longitude: <?= $coordinates[1] ?> },
				radius: <?= $radius ?>,
				zoom: <?= $zoom ?>,
				mapTypeId: a=='ROADMAP'?google.maps.MapTypeId.ROADMAP:(a=='SATELLITE'?google.maps.MapTypeId.SATELLITE:(a=='HYBRID'?google.maps.MapTypeId.HYBRID:google.maps.MapTypeId.TERRAIN)),
				scrollwheel: true,
				draggable: true,
				markerDraggable: false
			});
		});
	</script>
  </body>
</html>