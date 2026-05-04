<?php
	// session_start();
	$mibcontrolarbolSQL = base64_decode($_REQUEST["sqlvista"]);
?>
<html>
	<head>
		<meta charset="ISO-8552-0">
		<link rel="stylesheet" href="../estilos/mib.css">
		<script type="text/javascript" src="../../../../include/jquery.js"></script>
		<script type="text/javascript" src="../javascript/treelistfilter.js"></script>
		<script src="../javascript/filteringhighlight.js"></script>
		<style>.seleccionado { color:red; font-weight:bold; }</style>
	</head>

  <body>
	<div style="border: 1px solid; padding:7px; background-color: LightGoldenRodYellow; display: table; width: 97%">
		<label for="filtro" style="display: table-cell; width:1px"><?php echo($_GET['etiquetafiltro']); ?>&nbsp;</label>
		<input id="filtro" style="display: table-cell; width: 100%; background-color: GhostWhite" />
		<select id="seleccionesdisponibles" style="display: table-cell; width: 100%; background-color: GhostWhite"></select>
	</div>
	<br/>
	<a id="iraseleccionado"><button title="<?php echo($_REQUEST['botonverelementotooltip']); ?>"><?php echo($_REQUEST['botonverelementotexto']); ?></button></a>
	<br/><br/>
	<div style="border: 1px solid; background-color: LightYellow">
	<?php
		include("../../../../include/dbcommon.php");
		global $conn;
		$limiterecursividad = $_REQUEST["limiterecursividad"];
		$registros = db_query($mibcontrolarbolSQL, $conn);
		while($dato = db_fetch_numarray($registros)) { $matriz[] = $dato; }
		function generararbol($matriz, $primeraocurrencia = false, $limite = -1, $padre = 0, $profundidad = 0){
			if ($limite > -1 && $limite < $profundidad) return '';
			$arbol = ( $primeraocurrencia ? '' : '<ul>' );
			for($i=0, $dimensionmatriz = count($matriz); $i < $dimensionmatriz; $i++){
				if($matriz[$i][2] == $padre){
					$arbol .= '<li><span class="iconos"></span>';
					$arbol .= '<a id="' . $matriz[$i][0] . '">' . $matriz[$i][1] . '</a>';
					$arbol .= generararbol($matriz, false, $limite, $matriz[$i][0], $profundidad + 1);
					$arbol .= '</li>';
				}
			}
			$arbol .= ( $primeraocurrencia ? '' : '</ul>' );
			return $arbol;
		}
		echo('<ul id="raiz">');
		echo(generararbol($matriz, true, $limiterecursividad));
		//db_closequery($registros); Corrección PHPRunner 8
		$ids = $_REQUEST['id']; $ids = explode($_REQUEST['separator'], $ids);
		$valores = $_REQUEST['values']; $valores = explode($_REQUEST['separator'], $valores);
		foreach ($ids as $indice => $valr) {
			$selecciondisponible .= '<option value = "' . $valr . '">' . $valores[$indice] . '</option>';
		}
		unset($mibcontrolarbolSQL, $registros, $dato, $matriz, $ids, $valores, $indice, $valr);
	?>
	</div>
	<script type="text/javascript">
		$(function() {
			$('#filtro').treeListFilter('#raiz', 200);
			$('#filtro').filteringHighlight('#raiz', 'resaltado');
			$('ul').has('li').closest('li').children('.iconos').html('<img alt="" class="expandido" src="../imagenes/menos.png" /><img alt="" class="colapsado" src="../imagenes/mas.png" />&nbsp;&nbsp;');
        		$(".expandido").click(function () {
	        		$(this).toggle();
				$(this).next().toggle();
				$(this).parent().parent().children().last().slideToggle('fast');
			});
			$(".colapsado").click(function () {
				$(this).toggle();
				$(this).prev().toggle();
				$(this).parent().parent().children().last().slideToggle('fast');
			});
			$('#filtro').hide();
			$('#seleccionesdisponibles').html('<?php echo($selecciondisponible); ?>');
			$('a').css('cursor', 'default');
			$('#filtro').val($("#seleccionesdisponibles option:selected").text()); $('#filtro').trigger('change');
			$('#'+$('#seleccionesdisponibles').val()).toggleClass('seleccionado').append('<span class="marca seleccionado">&nbsp;&nbsp;<<<<</span>');
			$('#iraseleccionado').attr('href', '#'+$('#seleccionesdisponibles').val());
			$('#seleccionesdisponibles').change(function() {
				$('#iraseleccionado').attr('href', '#'+$(this).val());
				$('.marca').remove(); $('.seleccionado').removeClass('seleccionado');
				$('#filtro').val($("option:selected", this).text());
				$('#filtro').trigger('change');
				$('#'+$(this).val()).toggleClass('seleccionado');
				$('#'+$(this).val()).append('<span class="marca seleccionado">&nbsp;&nbsp;<<<<</span>');
			});
		});
	</script>
  </body>
</html>