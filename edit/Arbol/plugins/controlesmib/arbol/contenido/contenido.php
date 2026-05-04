<?php
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");
require_once(__DIR__."/../../../../include/dbcommon.php");

	$mib = $_REQUEST["mib"];
	/* // PARA EVITAR QUE SE VEA DIRECTAMENTE DESDE URL. FALTA HACER CHEQUEO DE PERMISOS EN TABLA PARA MOSTRAR O NO
	if (@!$_SESSION["UserID"]) {
		echo("NO DISPONIBLE");
		exit();
	}
	*/
	$subparte = explode(";;mib;;", $mib);
	$subparte[12] = str_replace(" ", "+", $subparte[12]);
	if($subparte[13]=='yes') { header('location: multiarbol.php?mib=' . $mib); exit(); }
?>
<html>
	<head>
		<meta charset="ISO-8552-0">
		<link rel="stylesheet" href="../estilos/mib.css">
		<script type="text/javascript" src="../../../../include/jquery.js"></script>
		<script type="text/javascript" src="../javascript/treelistfilter.js"></script>
		<script src="../javascript/filteringhighlight.js"></script>
	</head>

  <body>
	<div>
		<button id="vaciar" title="<?php echo($subparte[5]); ?>"><?php echo($subparte[4]); ?></button>
		<?php if ($subparte[2]=="yes") { echo('<button id="agregarnuevoelemento" title="' . $subparte[7] . '">' . $subparte[6] . '</button>'); } ?>
	</div>
	<br/>
	<div style="border: 1px solid; padding:7px; background-color: LightGoldenRodYellow; display: table; width: 97%">
		<label for="filtro" style="display: table-cell; width:1px"><?php echo($subparte[8]); ?></label>
		<input id="filtro" placeholder="<?php echo($subparte[9]); ?>" style="display: table-cell; width: 100%; background-color: GhostWhite" />
	</div>
	<br/>
	<div style="border: 1px solid; background-color: LightYellow">
	<?php
		// include("../../../../include/dbcommon.php");
		global $conn;
		$claveenc = '$a<A&>+@ioK*UY673#-.,;';
		$mibcontrolarbolSQL = rtrim(base64_decode($subparte[12]), "\0");
		$registros = db_query($mibcontrolarbolSQL, $conn);
		while($dato = db_fetch_numarray($registros)) { $matriz[] = $dato; }
		$limiterecursividad = $subparte[0];
		function generararbol($matriz, $primeraocurrencia = false, $limite = -1, $padre = 0, $profundidad = 0){
			if ($limite > -1 && $limite < $profundidad) return '';
			$arbol = ( $primeraocurrencia ? '' : '<ul>' );
			for($i=0, $dimensionmatriz = count($matriz); $i < $dimensionmatriz; $i++){
				if ( $matriz[$i][2] == $padre ) {
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
		//db_closequery($registros); // CORRECCIÓN PHPRunner 8
		unset($mibcontrolarbolSQL, $registros, $dato, $matriz);
	?>
	</div>

	<script type="text/javascript">
		$(function() {
			$mibcontrolarbolid = '<?php echo($subparte[11]); ?>';
                        var mib = '<?php echo($mib); ?>';
			$('#filtro').treeListFilter('#raiz', 200);
			$('#filtro').filteringHighlight('#raiz', 'resaltado');

			// ---------------- CORRECCIÓN JQUERY > 1.9 ------------------------------
			// http://stackoverflow.com/questions/14923301/uncaught-typeerror-cannot-read-property-msie-of-undefined-jquery-tools -- respuesta 119
			$.browser = {};
			$.browser.msie = false;
			$.browser.version = 0;
			if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
				$.browser.msie = true;
				$.browser.version = RegExp.$1;
			} // ---------------- CORRECCIÓN JQUERY > 1.9 ------------------------------

			if ( $.browser.msie && parseInt($.browser.version, 10) < 9 ) {
				if(!window.location.hash) {
					window.location = window.location + '#cargado';
					window.location.reload();
				}
			}
			$('#filtro').focus();
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
			$('#raiz a').on("click", function() {
				if ( '<?php echo($subparte[1]); ?>' != 'yes' && $(this).parent('li').find('ul').has('li').length > 0 ) {
					alert('<?php echo($subparte[10]); ?>'); }
				else {
					window.parent.document.getElementById('display_' + $mibcontrolarbolid).value = $(this).text();
					window.parent.document.getElementById($mibcontrolarbolid).value = $(this).attr('id');
					if ( window.parent.document.getElementById('errorCont0_' + $mibcontrolarbolid) && 
					     window.parent.document.getElementById('display_' + $mibcontrolarbolid).value ) {
						window.parent.document.getElementById('errorCont0_' + $mibcontrolarbolid).style.display = "none";
					}
					var aborrar = window.parent.document.getElementById("popupIframe1").parentNode.parentNode;
					$(".yui3-button-close", aborrar).trigger("click");
					$(".yui3-panel-content", aborrar).remove();
					//aborrar.parentNode.removeChild(aborrar);
					$('button.close', aborrar).trigger('click');
				}
			});
			$('#vaciar').on("click", function() {
				window.parent.document.getElementById('display_' + $mibcontrolarbolid).value = '';
				window.parent.document.getElementById($mibcontrolarbolid).value = '';
				var aborrar = window.parent.document.getElementById("popupIframe1").parentNode.parentNode;
				$(".yui3-button-close", aborrar).trigger("click");
				$(".yui3-panel-content", aborrar).remove();
				$('button.close', aborrar).trigger('click');
			});
			$('#agregarnuevoelemento').on("click", function() {
				var Runner = window.parent.Runner;
				args = {
					bodyContent: "<iframe frameborder='0' id='popupIframe2' style='width: 100%; height: 100%; border: 0;' class='<?php echo($subparte[11]); ?>'></iframe>",
					footerContent: "<span>&nbsp;</span>",
					headerContent: "Nuevo elemento",
					centered: true,
					render: true,
					width: parent.document.body.clientWidth - 100,
					height: $(window).height()
				},
				afterCreateHandler = function(win) {
					var bodyNode = $(win.bodyNode.getDOMNode()),
					iframeNode = $("iframe#popupIframe2", bodyNode);
					iframeNode.load(function() {
						if (Runner.isChrome) { bodyNode.addClass("noScrollBar"); }
						win.show();	
					}).attr("src", "../../../../<?php echo($subparte[3]); ?>");
				},
				afterCloseHandler = function(win){ win.destroy(true); }
				if(Runner.displayPopup) {
					var aborrar = window.parent.document.getElementById("popupIframe1").parentNode.parentNode;
					$(".yui3-button-close", aborrar).trigger("click");
					$(".yui3-panel-content", aborrar).remove();
					$('button.close', aborrar).trigger('click');
					Runner.displayPopup({html:
						"<iframe frameborder='0' id='popupIframe2' src='../../../../<?php echo($subparte[3]); ?>' style='width: 100%; height: 100%; border: 0;' class='<?php echo($subparte[11]); ?>'></iframe>"
						,header:args.headerContent,footer:args.headerContent,height:args.height,beforeClose:function(win){$('div.modal-backdrop.in').hide();return true;},afterCreate:function(win){win.setWidth(args.width);} }); }
				else {
					if (Runner.isChrome) {
						$("< style type='text/css'> .yui3-widget-bd::-webkit-scrollbar {display:none;} < /style>").appendTo("head");
					}
					Runner.pages.PageManager.createFlyWin.call(Runner.pages.PageManager.getById(1), args, false, afterCreateHandler, afterCloseHandler);
					$("#popupIframe1", window.parent.document).parent('div').parent('div').children('div').children('span').children('button').trigger("click");
					$("#popupIframe1", window.parent.document).parent('div').parent('div').parent('div').remove();
				}
			});
		});
	</script>
  </body>
</html>