Runner.controls.EditSqlcodemirror5 = Runner.extend( Runner.controls.Control, {
	myVal: "value of my Field: ", 
	editor: "",
	
	/**
	 * Override constructor
	 * @param {Object} cfg
	 */
	constructor: function( cfg ) {		
		this.addEvent( ["change", "keyup"] );		
		// call parent
		Runner.controls.EditSqlcodemirror5.superclass.constructor.call( this, cfg );
		if (this.getFieldSetting("required")==true) { this.addValidation("IsRequired"); }

		this.myVal = this.valContId;
		this.editor = CodeMirror.fromTextArea(document.getElementById(this.valContId), {
                        mode: 'text/x-mariadb',
                        indentWithTabs: true,
                        smartIndent: true,
                        lineNumbers: true,
                        matchBrackets : true,
                        // readOnly: true,   // para View
                        autofocus: true,
                        viewportMargin: Infinity,
                        extraKeys: {
                            "Ctrl-Space": "autocomplete",
                            "F11": function(cm) {
                                cm.setOption("fullScreen", !cm.getOption("fullScreen"));
                                              },
                            "Esc": function(cm) {
                                if (cm.getOption("fullScreen")) cm.setOption("fullScreen", false);
                            }
                        },
                        hintOptions: this.getFieldSetting("hintOptions"),
			styleActiveLine: true
		  });				

	},
	
	setFocus: function() {
		return false;
	},
	
	/**
	 * Clone html for iframe submit
	 * @return {array}
	 */
	getForSubmit: function() {
				if (!this.appearOnPage()){ return []; }
                var realCb = $('#'+this.valContId);
				// console.log("valor1: "+realCb.val() );
				// console.log("valor2: "+this.editor.getValue() );
                var cbClone = document.createElement('input');
                $(cbClone).attr('type', 'hidden');
                $(cbClone).attr('id', realCb.attr('id'));
                $(cbClone).attr('name', realCb.attr('name'));
                $(cbClone).val(this.editor.getValue());
                return [cbClone];
	}

});

Runner.controls.constants["EditSqlcodemirror5"] = "EditSqlcodemirror5"; 



