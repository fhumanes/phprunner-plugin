
Runner.controls.EditTelegramia = Runner.extend(Runner.controls.Control,{
	constructor: function(cfg){		
		this.addEvent(["change", "keyup"]);
		Runner.controls.EditTelegramia.superclass.constructor.call(this, cfg);
		if (this.getFieldSetting("required")==true) { this.addValidation("IsRequired"); }
		var telmaxcount = this.getFieldSetting("maxcount");
		var telmincount = this.getFieldSetting("mincount");
		var telmax = this.getFieldSetting("max");
		var telmin = this.getFieldSetting("min");
		var telinit = this.getFieldSetting("init");
		var flagmaxcount = false; var flagmincount = false;
		$('#'+this.valContId).keypress(function() {
			if($(this).val().length <  telmax) flagmaxcount = false;
			if($(this).val().length >= telmin) flagmincount = true;
			else flagmincount = false;
		});
		$('#'+this.valContId).textcounter({
			type                     : this.getFieldSetting("type"),
			min                      : this.getFieldSetting("min"),
			max                      : this.getFieldSetting("max"),
			countContainerElement    : this.getFieldSetting("countContainerElement"),
			countContainerClass      : this.getFieldSetting("countContainerClass"),
			inputErrorClass          : this.getFieldSetting("inputErrorClass"),
			counterErrorClass        : this.getFieldSetting("counterErrorClass"),
			counterText              : this.getFieldSetting("counterText"),
			errorTextElement         : this.getFieldSetting("errorTextElement"),
			minimumErrorText         : this.getFieldSetting("minimumErrorText"),
			maximumErrorText         : this.getFieldSetting("maximumErrorText"),
			displayErrorText         : this.getFieldSetting("displayErrorText"),
			stopInputAtMaximum       : this.getFieldSetting("stopInputAtMaximum"),
			countSpaces              : this.getFieldSetting("countSpaces"),
			countDown                : this.getFieldSetting("countDown"),
			countDownText            : this.getFieldSetting("countDownText"),
			countExtendedCharacters  : this.getFieldSetting("countExtendedCharacters"),
			maxcount                 : function(el){ if(!flagmaxcount) { eval(telmaxcount); flagmaxcount=true; } },
			mincount                 : function(el){ if(!flagmincount) { eval(telmincount); flagmincount=true; } },
			init                     : function(el){ eval(telinit); }
		});
	},
	getForSubmit: function(){
		if (!this.appearOnPage()){ return []; }
		return [this.valueElem.clone().val(this.getValue())]
	}
});

Runner.controls.constants["EditTelegramia"] = "EditTelegramia";
