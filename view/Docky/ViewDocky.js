
function MostrarDockyEnPopup(params) {
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

function mostrardocky(parametros) {
	params = {
			url: parametros.url,
			headerContent: parametros.titulo,
			width: parametros.ancho ? parametros.ancho : $(window).width() - 100,
			height: parametros.alto ? parametros.alto : $(window).height() - 100,
			afterClose: function(win) { $('#popupIframe1')[0].contentWindow.borrar(); }
	};
	MostrarDockyEnPopup(params);
}

Runner.viewControls.ViewDocky = Runner.extend(Runner.viewControls.ViewControl,{
	valuePrefix: "",
	constructor: function(cfg) { Runner.viewControls.ViewDocky.superclass.constructor.call(this, cfg); },
	init: function(){
		parametros = {	ancho: ( this.contentswidth=='default' ? $(window).width() - 100 : this.contentswidth ),
				alto: ( this.contentsheight ? this.contentsheight : $(window).height() - 100 ),
				titulo: this.title
		};
		$("span[class*='mibcontroldockyspan']", this.pageContext).css('cursor', 'pointer');
		$("span[class*='mibcontroldockyspan']", this.pageContext).unbind("click").click(function() {
			if ($("#popupIframe1").length) { return false; }
			$nombredoc = $(this).attr('data-name');
			parametros.url = 'plugins/controlesmib/docky/content/view.php?value=' +  $(this).attr('data');
			if(Runner.displayPopup) Runner.displayPopup({url:parametros.url,header:parametros.titulo+$(this).attr('data-name'),footer:parametros.titulo+$(this).attr('data-name'),width:parametros.ancho,height:parametros.alto,beforeClose:function(win){$('#popupIframe1')[0].contentWindow.borrar();$('div.modal-backdrop.in').hide();return true;} });
			else { 
				parametros.titulo = parametros.titulo + $(this).attr('data-name');
				mostrardocky(parametros);
			}
		});
	}
});