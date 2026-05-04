
Runner.controls.EditGeolocation = Runner.extend(Runner.controls.Control,{

	myVal: "value of my Field: ", 
	constructor: function(cfg){		
		this.addEvent(["change", "keyup"]);		
		// call parent
		Runner.controls.EditGeolocation.superclass.constructor.call(this, cfg);
                if (this.getFieldSetting("required")==true) { this.addValidation("IsRequired"); }
//		this.inputType = "text";		
		this.myVal = this.getFieldSetting("myVal");
	},

	 
	getForSubmit: function(){
		if (!this.appearOnPage()){
			return [];
		}
		return [this.valueElem.clone().val(this.getValue())]
	}
});


Runner.controls.constants["EditGeolocation"] = "EditGeolocation";

