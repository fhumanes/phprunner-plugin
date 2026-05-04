
Runner.controls.EditCody = Runner.extend(Runner.controls.Control,{
	constructor: function(cfg){		
		this.addEvent(["change", "keyup"]);		
		Runner.controls.EditCody.superclass.constructor.call(this, cfg);
		if (this.getFieldSetting("required")==true) { this.addValidation("IsRequired"); }
		$('input#'+this.valContId).intlTelInput({
			allowDropdown		: this.getFieldSetting('allowDropdown'),
			autoPlaceholder		: this.getFieldSetting('autoPlaceholder'),
			excludeCountries	: (this.getFieldSetting('excludeCountries')==""?undefined:this.getFieldSetting('excludeCountries').split(',')),
			geoIpLookup		: function(callback) {
							$.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
								var countryCode = (resp && resp.country) ? resp.country : "";
								callback(countryCode);
							});
						  },
			initialCountry		: this.getFieldSetting('initialCountry'),
			onlyCountries		: (this.getFieldSetting('onlyCountries')==""?undefined:this.getFieldSetting('onlyCountries').split(',')),
			preferredCountries	: this.getFieldSetting('preferredCountries').split(','),
			separateDialCode	: this.getFieldSetting('separateDialCode'),
			utilsScript		: "plugins/controlesmib/cody/javascript/utils.js"
		});
	},
	getForSubmit: function(){
		if (!this.appearOnPage()){ return []; }
		return [this.valueElem.clone().val($('input#'+this.valContId).parents('div.intl-tel-input').find('div.selected-dial-code').html().trim()+this.getValue())]
	}
});

Runner.controls.constants["EditCody"] = "EditCody";
