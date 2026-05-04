/**
 * Example for view control control class
 */
Runner.viewControls.ViewQRCode = Runner.extend( Runner.viewControls.ViewControl, {	
	/**
	 * Override constructor
	 * @param {Object} cfg
	 */
	constructor: function( cfg ) {		
		// call parent
		Runner.viewControls.ViewQRCode.superclass.constructor.call( this, cfg );
	},

	init: function() {
		$("span[id*='qrcode_']", this.pageContext).each( function() {
			var text = $(this).attr('value');
			
			if ( text && !$(this).html() ) {
				$(this).qrcode({
					width: 128, 
					height: 128,
					text: text
				});
			}
		});
	}	
});