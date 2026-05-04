
Runner.controls.EditTags = Runner.extend(Runner.controls.Control,{
	constructor: function(cfg){
		this.addEvent(["change", "keyup"]);		
		Runner.controls.EditTags.superclass.constructor.call(this, cfg);
		var options = {};
		var $this = this;

		if ($this.getFieldSetting('required')) $this.addValidation('IsRequired');

        /*
		$this->addJSSetting("required", $this->required);
		$this->addJSSetting("defaultLabel", $this->defaultLabel); 
		$this->addJSSetting("defaultTagClass", $this->defaultTagClass); 
		$this->addJSSetting("trimValue", $this->trimValue); 
		$this->addJSSetting("dashspaces", $this->dashspaces); 
		$this->addJSSetting("lowercase", $this->lowercase); 
		$this->addJSSetting("tagLimit", $this->tagLimit); 
		$this->addJSSetting("isSuggestions", $this->isSuggestions); 
		$this->addJSSetting("noSuggestionMsg", $this->noSuggestionMsg); 
		// $this->addJSSetting("sqlTagsSuggestions", $this->sqlTagsSuggestions); 
		// $this->addJSSetting("data",$dataAll); // Pararm for javasript
		$this->addJSSetting("whiteList", $this->whiteList);  
		$this->addJSSetting("showAllSuggestions", $this->showAllSuggestions);  
        */

        options.printValues = false; // DEBUG console
        options.defaultLabel = $this.getFieldSetting('defaultLabel');
		options.defaultTagClass = $this.getFieldSetting('defaultTagClass');
		options.trimValue = $this.getFieldSetting('trimValue');
		options.dashspaces = $this.getFieldSetting('dashspaces');
		options.lowercase = $this.getFieldSetting('lowercase');
        if($this.getFieldSetting('tagLimit') != 0 ) options.tagLimit = $this.getFieldSetting('tagLimit');

        if($this.getFieldSetting('isSuggestions') != false ) {
            options.sqlTagsSuggestions = $this.getFieldSetting('sqlTagsSuggestions');
            options.whiteList = $this.getFieldSetting('whiteList');
            options.showAllSuggestions = $this.getFieldSetting('showAllSuggestions');
            options.noSuggestionMsg = $this.getFieldSetting('noSuggestionMsg');
            options.suggestions = $this.getFieldSetting('data');
        };


		$('#'+$this.valContId).amsifySuggestags(options);

		
		
	},      
	_onBegin: function(){
		Runner.pages.RunnerPage.prototype.setPageModified(true);
	},
	getForSubmit: function(){
		if (!this.appearOnPage()){ return []; }       
		return [this.valueElem.clone().val($('#'+this.valContId).val())];
	}
});

Runner.controls.constants["EditTags"] = "EditTags";
