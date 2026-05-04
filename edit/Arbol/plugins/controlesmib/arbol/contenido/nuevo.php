<?php

	session_start();
/*
	if (@!$_SESSION["UserID"]) { // PARA EVITAR QUE SE VEA DIRECTAMENTE DESDE URL
		echo("NO DISPONIBLE");
		exit();
	}
*/
/*
	MODO DE USO - LLAMAR A ESTE ARCHIVO EN AFTER ADD:
	$valorid = $values["..."];
	$valordescripcion = $values["..."];
	include("plugins/controlesmib/arbol/contenido/nuevo.php");
*/

	echo('
		<script type="text/javascript" src="include/loadfirst.js"></script>
		<script>
			$control = $("#popupIframe2", window.parent.document).attr("class");
			$("#display_" + $control, window.parent.document).val("' . $valordescripcion . '");
			$("#" + $control, window.parent.document).val("' . $valorid . '");
			var borrar = window.parent.document.getElementById("popupIframe2").parentNode.parentNode;
			$(".yui3-button-close", borrar).trigger("click");
			$(".yui3-panel-content", borrar).remove();
			$("button.close", borrar).trigger("click");
		</script>
	');
	unset($valorid, $valordescripcion);

?>