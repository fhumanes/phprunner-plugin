/**
 * Example for view control control class
 */
Runner.viewControls.ViewCodeView = Runner.extend( Runner.viewControls.ViewControl, {
	/**
	 * Override constructor
	 * @param {Object} cfg
	 */
	constructor: function( cfg ) {		
		// call parent
		Runner.viewControls.ViewCodeView.superclass.constructor.call( this, cfg );
		
	},

	init: function() {
	var obj = this;
	$("[id^=ace-c9-editor]").each(function(){
		  if($(this).length>0){
			var editor = ace.edit($(this).attr("id"));
			//editor.setTheme("ace/theme/twilight");
			editor.session.setMode("ace/mode/"+obj.codetype);
			editor.setReadOnly(true);
		  }
	});
	}
});