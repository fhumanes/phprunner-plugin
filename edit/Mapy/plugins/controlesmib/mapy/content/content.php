<?php
	session_start();
	$mib = $_REQUEST["mib"];
	$subparte = explode(";;mib;;", $mib);
?>
<html>
	<head>
		<meta charset="ISO-8552-0">
		<!-- <link rel="stylesheet" href="../estilos/mib.css"> -->
		<script type="text/javascript" src="../../../../include/jquery.js"></script>
		<script type="text/javascript" src="https://maps.google.com/maps/api/js?key=<?php echo($subparte[12]);?>&libraries=places"></script>
		<script src="../javascript/locationpicker.js"></script>
	</head>

  <body>
	<div style="width:100%;display:table">
		<div style="display:table-cell"><button id="vaciar" title="<?php echo($subparte[5]); ?>"><?php echo($subparte[4]); ?></button></div>
		<div style="display:table-cell;text-align:center"><div style="border: 1px solid; padding:7px; background-color: LightGoldenRodYellow; display: table; width: 96%; border-radius: 5px;">
			<label for="filtro" style="display: table-cell; width:1px"><?php echo($subparte[8]); ?></label>
			<input id="filtro" placeholder="<?php echo($subparte[9]); ?>" style="display: table-cell; width: 100%; background-color: GhostWhite" />
		</div></div>
		<div style="display:table-cell;text-align:right"><button id="seleccionar" title="<?php echo($subparte[16]); ?>"><?php echo($subparte[15]); ?></button></div>
	</div>
	<br/>
	<div style="border: 1px solid; background-color: LightYellow;">
	<div id="mibmapycontentmap" style="width:100%;height:70%"></div></div><br/>
	<div style="text-align:center;font-size:75%;width:100%;border: 1px solid;border-radius:5px;background-color:LightGoldenRodYellow">
		<input id="mapylat" readonly> || </input><input id="mapylon" readonly></input> || 
		<input id="mapycity" readonly></input> || <input id="mapystate" readonly></input> || 
		<input id="mapypcode" readonly></input> || <input id="mapycountry" readonly></input>
	</div>
	<script type="text/javascript">
		$(function() {
			$('input[id^="mapy"]')./*attr('size','12').*/css('border','0px').css('font-size','75%').css('text-align','center').css('background-color','Transparent');
			$mibcontrolmapyid = '<?php echo($subparte[11]); ?>';
			$('#seleccionar').on("click", function() {
				window.parent.document.getElementById('display_' + $mibcontrolmapyid).value = $('#mapylat').val()+'; '+$('#mapylon').val();
				window.parent.document.getElementById($mibcontrolmapyid).value = $('#mapylat').val()+'; '+$('#mapylon').val();
				if ( window.parent.document.getElementById('errorCont0_' + $mibcontrolmapyid) && 
				     window.parent.document.getElementById('display_' + $mibcontrolmapyid).value ) {
					window.parent.document.getElementById('errorCont0_' + $mibcontrolmapyid).style.display = "none";
				}
				var aborrar = window.parent.document.getElementById("popupIframe1").parentNode.parentNode;
				$(".yui3-button-close", aborrar).trigger("click");
				$(".yui3-panel-content", aborrar).remove();
				//aborrar.parentNode.removeChild(aborrar);
				$('button.close', aborrar).trigger('click');
			});
			$('#vaciar').on("click", function() {
				window.parent.document.getElementById('display_' + $mibcontrolmapyid).value = '';
				window.parent.document.getElementById($mibcontrolmapyid).value = '';
				var aborrar = window.parent.document.getElementById("popupIframe1").parentNode.parentNode;
				$(".yui3-button-close", aborrar).trigger("click");
				$(".yui3-panel-content", aborrar).remove();
				$('button.close', aborrar).trigger('click');
			});
			function updateControls(addressComponents) {
				$('#filtro').val(addressComponents.addressLine1);
				$('#mapycity').val(addressComponents.city);
				$('#mapystate').val(addressComponents.stateOrProvince);
				$('#mapypcode').val(addressComponents.postalCode);
				$('#mapycountry').val(addressComponents.country);
			}
			var a = '<?= $subparte[6] ?>';
			$('#mibmapycontentmap').locationpicker({
				location: { latitude: <?= $subparte[0] ?>, longitude: <?= $subparte[1] ?> },
				radius: <?= $subparte[2] ?>,
				zoom: <?= $subparte[3] ?>,
				mapTypeId: a=='ROADMAP'?google.maps.MapTypeId.ROADMAP:(a=='SATELLITE'?google.maps.MapTypeId.SATELLITE:(a=='HYBRID'?google.maps.MapTypeId.HYBRID:google.maps.MapTypeId.TERRAIN)),
				scrollwheel: <?php echo $subparte[7]=='true'?'true':'false'; ?>,
				onchanged: function (currentLocation, radius, isMarkerDropped) {
					var addressComponents = $(this).locationpicker('map').location.addressComponents;
					updateControls(addressComponents);
				},
				oninitialized: function(component) {
					var addressComponents = $(component).locationpicker('map').location.addressComponents;
					updateControls(addressComponents);
				},
				inputBinding: {
					latitudeInput: $('#mapylat'),
					longitudeInput: $('#mapylon'),
					radiusInput: null,
					locationNameInput: $('#filtro')
				},
				enableAutocomplete: true,
				draggable: <?php echo $subparte[10]=='true'?'true':'false'; ?>
			});
		});
	</script>
  </body>
</html>