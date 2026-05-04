
Runner.controls.EditSummernote = Runner.extend(Runner.controls.Control,{

	constructor: function(cfg){		
		this.addEvent(["change", "keyup"]);
		Runner.controls.EditSummernote.superclass.constructor.call(this, cfg);
		if (this.getFieldSetting("required")==true) { this.addValidation("IsRequired"); }
                
                // document.emojiType = 'unicode'; // default: image, other: 'unicode'
                document.emojiSource = 'plugins/controles/summernote/plugin/emoji/img';
                
                if (this.getFieldSetting('language') != 'en-US') {
                    $('#'+this.valContId).summernote({
                        height: this.getFieldSetting('height'),                
                        minHeight:this.getFieldSetting('minHeight'),         
                        maxHeight: this.getFieldSetting('maxHeight'),             
                        lang: this.getFieldSetting('language'),             
                        spellCheck: this.getFieldSetting('spellCheck'),
                        disableGrammar: this.getFieldSetting('disableGrammar'),
                        toolbar: this.getFieldSetting('toolbar_menu')

                    });
                } else {
                     $('#'+this.valContId).summernote({
                        height: this.getFieldSetting('height'),                
                        minHeight:this.getFieldSetting('minHeight'),         
                        maxHeight: this.getFieldSetting('maxHeight'),             
                        // lang: this.getFieldSetting('language'),             
                        spellCheck: this.getFieldSetting('spellCheck'),
                        disableGrammar: this.getFieldSetting('disableGrammar'),
                        toolbar: this.getFieldSetting('toolbar_menu')  

                    });                   
                }
	},
        setFocus: function() {
                return false;
        },
        _onBegin: function(){
		Runner.pages.RunnerPage.prototype.setPageModified(true);
	},
	getForSubmit: function(){
		if (!this.appearOnPage()){ return []; }
		return [this.valueElem.clone().val(this.getValue())]; 
	}
});

Runner.controls.constants["EditSummernote"] = "EditSummernote";
