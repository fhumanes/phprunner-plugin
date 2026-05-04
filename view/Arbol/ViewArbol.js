
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
			if (Runner.isChrome) {
				bodyNode.addClass("noScrollBar");
			}
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

Runner.viewControls.ViewArbol = Runner.extend(Runner.viewControls.ViewControl,{
	valuePrefix: "",
	constructor: function(cfg) { Runner.viewControls.ViewArbol.superclass.constructor.call(this, cfg); },
	init: function(){
		etiquetafiltro = this.filterlabel;
		botonverelementotexto = this.gotoelementtext;
		botonverelementotooltip = this.gotoelementtooltip;
		parametros = {	ancho: ( this.contentswidth=='default' ? $(window).width() - 100 : this.contentswidth ),
				alto: ( this.contentsheight ? this.contentsheight : $(window).height() - 100 ),
				titulo: this.title
		};
		$("span[class*='mibcontrolarbolspan']", this.pageContext).css('cursor', 'pointer');
		$("span[class*='mibcontrolarbolspan']", this.pageContext).unbind("click").click(function() {
			if ($("#popupIframe1").length) { return false; }
			$limiterecursividad = $(this).attr('limite');
			$ismulti = $(this).attr('ismulti');
			$separator = $(this).attr('separator');
			parametros.url = 'plugins/controlesmib/arbol/contenido/vista'+($ismulti=='yes' ? 'multi' : '' )+'.php?limiterecursividad=' + $limiterecursividad + '&etiquetafiltro=' + etiquetafiltro + '&id=' + $(this).attr('id') + '&elemento=' + $(this).text() + '&botonverelementotexto=' + botonverelementotexto + '&botonverelementotooltip=' + botonverelementotooltip + '&multi=' + ($ismulti=='yes' ? 'yes&values=' +  $(this).attr('data') : 'no' ) + '&separator=' + $separator + '&sqlvista=' + $(this).attr("class").replace("mibcontrolarbolspan ", "");
			if(Runner.displayPopup) Runner.displayPopup({url:parametros.url,header:parametros.titulo,footer:parametros.titulo,width:parametros.ancho,height:parametros.alto,beforeClose:function(win){$('div.modal-backdrop.in').hide();return true;} });
			else mostrararbol(parametros);
		});
	}
});