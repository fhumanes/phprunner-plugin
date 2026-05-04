Runner.controls.EditTrumbowyg = Runner.extend( Runner.controls.Control, {
	myVal: "value of my Field: ", 
	lang: "de",

	
	/**
	 * Override constructor
	 * @param {Object} cfg
	 */
	constructor: function( cfg ) {		
		this.addEvent( ["change", "keyup"] );		
		// call parent
		Runner.controls.EditTrumbowyg.superclass.constructor.call( this, cfg );
		if (this.getFieldSetting("required")==true) { this.addValidation("IsRequired"); }
		
		this.myVal = this.getFieldSetting("myVal");
		this.lang = this.getFieldSetting("lang");
		this.semantic = this.getFieldSetting("semantic");
		this.btns = this.getFieldSetting("btns");
		this.templates= this.getFieldSetting("templates");

		
		$('#'+this.valContId).trumbowyg({
			// prefix: this.valContId,
			semantic: this.semantic,
			lang: this.lang,
			btns: this.btns,
			// svgPath: "plugins/controles/trumbowyg/ui/icons.svg",
			svgPath: false,
			hideButtonTexts: true,
			
			autogrowOnEnter: true,
			tagsToRemove: ['script', 'link', 'font', 'iframe', 'input', 'embed'],
			plugins: {
				table: {
						rows:10,
						columns:10,
						styler: 'table table-bordered'
				},
				allowTagsFromPaste: {
						allowedTags: ['h1','h2','h3','b','strong','i','em', 'p', 'br']
				},
				templates: this.templates
			}
		});	
	
	},
	
	/**
	 * Clone html for iframe submit
	 * @return {array}
	 */
	getForSubmit: function() {
		if ( !this.appearOnPage() ) {
			return [];
		}
		
		return [ this.valueElem.clone().val( this.getValue() ) ];
	},
	
	setFocus: function() {
		return false;
	}
});

Runner.controls.constants["EditTrumbowyg"] = "EditTrumbowyg"; 



