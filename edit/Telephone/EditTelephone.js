
Runner.controls.EditTelephone = Runner.extend(Runner.controls.Control,{
	constructor: function(cfg){		
		this.addEvent(["change", "keyup"]);		
		Runner.controls.EditTelephone.superclass.constructor.call(this, cfg);
		if (this.getFieldSetting("required")===true) { this.addValidation("IsRequired"); }
                
                var input = document.querySelector("input#"+this.valContId);
                console.log ("")
                window.intlTelInput(input, {
                  // allowDropdown: false,
                  autoHideDialCode: false,
                  autoPlaceholder: "off",
                  // dropdownContainer: document.body,
                  // excludeCountries: ["us"],
                  // formatOnDisplay: false,
                  // geoIpLookup: function(callback) {
                  //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
                  //     var countryCode = (resp && resp.country) ? resp.country : "";
                  //     callback(countryCode);
                  //   });
                  // },
                  // hiddenInput: "full_number",
                  // initialCountry: "auto",
                  initialCountry: this.getFieldSetting('initialCountry'),
                  // localizedCountries: { "es": "España" },
                  nationalMode: false,
                  // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
                  placeholderNumberType: "MOBILE",
                  preferredCountries: [this.getFieldSetting('preferredCountries') ],
                  // separateDialCode: true,
                  utilsScript: "plugins/controles/telephone/js/utils.js"
                  });
 
                
	}, 

	getForSubmit: function(){
		if (!this.appearOnPage()){ return []; }
		return [this.valueElem.clone().val(this.getValue())];
	}
});

Runner.controls.constants["EditTelephone"] = "EditTelephone";
