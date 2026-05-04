function MostrarEnPopup(params) {
	args = {
		bodyContent: "<iframe frameborder='0' id='popupIframe1' style='width: 100%; height: 100%; border: 0;'></iframe>",
		footerContent: "<span>&nbsp;</span>",
		headerContent: params.headerContent,
		centered: true,
		render: true,
		width: params.width ? params.width : 450,
		height: params.height ? params.height : 315
	},
	afterCreateHandler = function(win) {
		var bodyNode = $(win.bodyNode.getDOMNode()),
		iframeNode = $("iframe#popupIframe1", bodyNode);
		iframeNode.load(function() {
			if (Runner.isChrome) { bodyNode.addClass("noScrollBar"); }
			win.show();	
		}).attr("src", params.url);
	},
	afterCloseHandler = params.afterClose;
	if (Runner.isChrome) {
		$("< style type='text/css'> .yui3-widget-bd::-webkit-scrollbar {display:none;} < /style>").appendTo("head");
	}
	Runner.pages.PageManager.createFlyWin.call(Runner.pages.PageManager.getById(1), args, false, afterCreateHandler, afterCloseHandler);
}

function mostrararbol(parametros) {
	params = {
			url: parametros.url,
			headerContent: parametros.titulo,
			width: parametros.ancho ? parametros.ancho : $(window).width() - 100,
			height: parametros.alto ? parametros.alto : $(window).height() - 100
	};
	MostrarEnPopup(params);
}

Runner.controls.EditArbol = Runner.extend(Runner.controls.Control,{
	constructor: function(cfg){		
		this.addEvent(["change", "keyup"]);
		Runner.controls.EditArbol.superclass.constructor.call(this, cfg);
		if (this.getFieldSetting("required")==true) { this.addValidation("IsRequired"); $obligatorio = true; }
		parametrosedit = {	url: (this.getFieldSetting("customcontent") ? this.getFieldSetting("customcontent") : $("#display_"+this.valContId).attr('data')),
					ancho: ( this.getFieldSetting("contentswidth")=='default' ? $(window).width() - 100 : this.getFieldSetting("contentswidth") ),
					alto: ( this.getFieldSetting("contentsheight") ? this.getFieldSetting("contentsheight") : $(window).height() - 100 ),
					titulo: this.getFieldSetting("title")
		};
		$("#display_"+this.valContId).unbind("click").click(function() {
			$clavemib = $(this).attr("class");
			if (parametrosedit.url.indexOf("plugins/controlesmib/arbol/contenido/contenido.php?mib=") > -1) { parametrosedit.url = "plugins/controlesmib/arbol/contenido/contenido.php"; }
			parametrosedit.url = ( parametrosedit.url=='plugins/controlesmib/arbol/contenido/contenido.php' ? parametrosedit.url + "?mib=" + $clavemib : parametrosedit.url );
			if(Runner.displayPopup) Runner.displayPopup({url:parametrosedit.url,header:parametrosedit.titulo,footer:parametrosedit.titulo,width:parametrosedit.ancho,height:parametrosedit.alto,beforeClose:function(win){$('div.modal-backdrop.in').hide();return true;} });
			else mostrararbol(parametrosedit);
		});
		$("#mibarbolseleccionar"+this.valContId).unbind("click").click(function() {
			$clavemib = $(this).attr("class");
			if (parametrosedit.url.indexOf("plugins/controlesmib/arbol/contenido/contenido.php?mib=") > -1) { parametrosedit.url = "plugins/controlesmib/arbol/contenido/contenido.php"; }
			parametrosedit.url = ( parametrosedit.url=='plugins/controlesmib/arbol/contenido/contenido.php' ? parametrosedit.url + "?mib=" + $clavemib : parametrosedit.url );
			if(Runner.displayPopup) Runner.displayPopup({url:parametrosedit.url,header:parametrosedit.titulo,footer:parametrosedit.titulo,width:parametrosedit.ancho,height:parametrosedit.alto,beforeClose:function(win){$('div.modal-backdrop.in').hide();return true;} });
			else mostrararbol(parametrosedit);
		});
		$("#"+this.valContId).css('cursor','pointer');
		$("#display_"+this.valContId).addClass('form-control');
		$.getScript('plugins/controlesmib/arbol/javascript/attrchange.js', function() {
			$('.mibarboloculto').attrchange({
				trackValues: true, 
				callback: function (event) {
					$contr = $(this).parent().find('input')[0];
					$mibesmulti = $contr.className.split(';;mib;;');
					$mibesmulti = $mibesmulti[13];
					if($mibesmulti!='yes') {
						$.get('plugins/controlesmib/arbol/contenido/autoact.php?id='+$contr.className+'&valor='+event.newValue, function(data) {
							$contr.value = data;
						});
					}
				}
			});
		});
	},
	getForSubmit: function(){
		if (!this.appearOnPage()){ return []; }
		return [this.valueElem.clone().val(this.getValue())]
	} // ,
	// destructor: function(cfg){ $.get("plugins/controlesmib/arbol/contenido/limpiar.php", {mib: $("#"+this.valContId).attr("class")}); }
});

Runner.controls.constants["EditArbol"] = "EditArbol"; 
