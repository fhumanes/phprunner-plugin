
Runner.controls.EditGestury = Runner.extend(Runner.controls.Control,{
	constructor: function(cfg){		
		this.addEvent(["change", "keyup"]);		
		Runner.controls.EditGestury.superclass.constructor.call(this, cfg);
		if (this.getFieldSetting("required")==true) { this.addValidation("IsRequired"); }
		$('div#gest'+this.valContId).GesturePasswd({
			backgroundColor: this.getFieldSetting('backgroundColor'),
			color: this.getFieldSetting('color'),
			roundRadii: this.getFieldSetting('roundRadii'),
			pointRadii: this.getFieldSetting('pointRadii'),
			space: this.getFieldSetting('space'),
			width: this.getFieldSetting('width'),
			height: this.getFieldSetting('height'),
			lineColor: this.getFieldSetting('lineColor'),
			zindex: 100
		});
		var idoculto = 'input#'+this.valContId;
		$('div#gest'+this.valContId).on('hasPasswd',function(e,passwd) {
			$(idoculto).val(passwd);
			$(this).trigger('passwdRight');
			//$(this).trigger('passwdWrong');
		});
	},
	getForSubmit: function(){
		if (!this.appearOnPage()){ return []; }
		return [this.valueElem.clone().val(this.getValue())]
	}
});

Runner.controls.constants["EditGestury"] = "EditGestury";
