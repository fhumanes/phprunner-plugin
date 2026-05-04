
Runner.controls.EditSecury = Runner.extend(Runner.controls.Control,{
	constructor: function(cfg){		
		this.addEvent(["change", "keyup"]);		
		Runner.controls.EditSecury.superclass.constructor.call(this, cfg);
		if (this.getFieldSetting("required")==true) { this.addValidation("IsRequired"); }
		$('input#'+this.valContId).passwordstrength({
			'minlength': this.getFieldSetting('minlength'),
			'number'   : this.getFieldSetting('number'),
			'capital'  : this.getFieldSetting('capital'),
			'special'  : this.getFieldSetting('special'),
			'bgcolor'  : this.getFieldSetting('specialtooltipbgcolor'),
			'labels'   : {
				'general'   : this.getFieldSetting('labelgeneral'),
				'minlength' : this.getFieldSetting('labelminlength'),
				'number'    : this.getFieldSetting('labelnumber'),
				'capital'   : this.getFieldSetting('labelcapital'),
				'special'   : this.getFieldSetting('labelspecial') }
		});
	},
	getForSubmit: function(){
		if (!this.appearOnPage()){ return []; }
		return [this.valueElem.clone().val(this.getValue())]
	}
});

Runner.controls.constants["EditSecury"] = "EditSecury";
