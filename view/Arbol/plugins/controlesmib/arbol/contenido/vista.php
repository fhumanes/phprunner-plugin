<?php
	if($_REQUEST["multi"]=='yes') { header('location: vistamulti.php?limiterecursividad='.$_REQUEST["limiterecursividad"].'&etiquetafiltro='.$_REQUEST["etiquetafiltro"].'&id='.$_REQUEST["id"].'&elemento='.$_REQUEST["elemento"].'&botonverelementotexto='.$_REQUEST["botonverelementotexto"].'&botonverelementotooltip='.$_REQUEST["botonverelementotooltip"].'&separator='.$_REQUEST["separator"].'&values='.$_REQUEST["values"].'&sqlvista='.$_REQUEST["sqlvista"]); exit(); }
	// session_start();
	/* // PARA EVITAR QUE SE VEA DIRECTAMENTE DESDE URL. FALTA HACER CHEQUEO DE PERMISOS EN TABLA PARA MOSTRAR O NO
	if (@!$_SESSION["UserID"]) {
		echo("NO DISPONIBLE");
		exit();
	}
	*/
	//$claveencriptacion = '$a<A&>+@ioK*UY673#-.,;';
	//$mibcontrolarbolSQL = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($claveencriptacion), base64_decode($_REQUEST["sqlvista"]), MCRYPT_MODE_CBC, md5(md5($claveencriptacion))), "\0");
	$mibcontrolarbolSQL = base64_decode($_REQUEST["sqlvista"]);
?>
<html>
	<head>
		<meta charset="ISO-8552-0">
		<link rel="stylesheet" href="../estilos/mib.css">
		<script type="text/javascript" src="../../../../include/jquery.js"></script>
		<script type="text/javascript" src="../javascript/treelistfilter.js"></script>
		<script src="../javascript/filteringhighlight.js"></script>
		<script type="text/javascript">
			$('a[href^="#"]').on('click',function (e) {
				e.preventDefault();
				var target = this.hash,
				$target = $(target);
				$('html, body').stop().animate({ 'scrollTop': $target.offset().top }, 900, 'swing', function() { window.location.hash = target; });
			});
		</script>
	</head>

  <body>
	<div style="border: 1px solid; padding:7px; background-color: LightGoldenRodYellow; display: table; width: 97%">
		<label for="filtro" style="display: table-cell; width:1px"><?php echo($_GET['etiquetafiltro']); ?>&nbsp;</label>
		<input id="filtro" style="display: table-cell; width: 100%; background-color: GhostWhite" />
	</div>
	<br/>
	<a href="#<?php echo($_GET['id']); ?>"><button title="<?php echo($_REQUEST['botonverelementotooltip']); ?>"><?php echo($_REQUEST['botonverelementotexto']); ?></button></a>
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
		unset($mibcontrolarbolSQL, $registros, $dato, $matriz);
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
			<?php $filtroaaplicar = $_GET['elemento']; ?>
			$('#filtro').val('<?=$filtroaaplicar?>');
			$('#filtro').trigger('change');
			$('#filtro').prop('disabled', true);
			$('a').css('cursor', 'default');
			$('#<?php echo($_GET['id']); ?>').css('color', 'red');
			$('#<?php echo($_GET['id']); ?>').css('font-weight', 'bold');
			$('#<?php echo($_GET['id']); ?>').append('&nbsp;&nbsp;<<<<');
		});
	</script>
  </body>
</html>