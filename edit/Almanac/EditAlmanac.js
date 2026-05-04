
Runner.controls.EditAlmanac = Runner.extend(Runner.controls.Control,{
	constructor: function(cfg){		
		this.addEvent(["change", "keyup"]);		
		Runner.controls.EditAlmanac.superclass.constructor.call(this, cfg);
		if (this.getFieldSetting("required")==true) { this.addValidation("IsRequired"); }
		$('input#'+this.valContId).dateDropper({
			animate			: this.getFieldSetting('animate'),
			init_animation		: this.getFieldSetting('init_animation'),
			format			: this.getFieldSetting('format'),
			lang			: this.getFieldSetting('lang'),
			lock			: this.getFieldSetting('lock'),
			maxYear			: this.getFieldSetting('maxYear'),
			minYear			: this.getFieldSetting('minYear'),
			yearsRange		: this.getFieldSetting('yearsRange'),
			dropPrimaryColor	: this.getFieldSetting('dropPrimaryColor'),
			dropTextColor		: this.getFieldSetting('dropTextColor'),
			dropBackgroundColor	: this.getFieldSetting('dropBackgroundColor'),
			dropBorder		: this.getFieldSetting('dropBorder'),
			dropBorderRadius	: this.getFieldSetting('dropBorderRadius'),
			dropShadow		: this.getFieldSetting('dropShadow'),
			dropWidth		: this.getFieldSetting('dropWidth'),
			dropTextWeight		: this.getFieldSetting('dropTextWeight')
		});
		$('input#'+this.valContId).click(function(){
			if($(this).val()!='') $('div.dd-d > div.dd-ul > a.dd-n-right > i.dd-icon-right').trigger('click');
			$('div.dd-s > a, a.dd-n').css('text-decoration','none').css('-moz-text-decoration','none');
		});
	},
	getForSubmit: function(){
		if (!this.appearOnPage()){ return []; }
		return [this.valueElem.clone().val(this.getValue())]
	}
});

Runner.controls.constants["EditAlmanac"] = "EditAlmanac";
