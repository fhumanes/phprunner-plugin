/**
 * Spinner control class
 */
Runner.controls.EditSpinner = Runner.extend(Runner.controls.Control,{
	/**
	 * Override constructor
	 * @param {Object} cfg
	 */
	min: -999999999, 
	max:  999999999,
	required: false,
	constructor: function(cfg){		
		this.addEvent(["change", "keyup"]);		
		// call parent
		Runner.controls.EditSpinner.superclass.constructor.call(this, cfg);
		this.min = this.getFieldSetting("min");
		this.max = this.getFieldSetting("max");
		this.required = this.getFieldSetting("required");

		if (this.required)
			this.addValidation("IsRequired");

		$("#"+this.valContId).spinner({min:this.min, max: this.max});
	},
	/**
	 * Clone html for iframe submit
	 * @return {array}
	 */
	getForSubmit: function(){
		if (!this.appearOnPage()){
			return [];
		}
		return [this.valueElem.clone().val(this.getValue())]
	}
});

Runner.controls.constants["EditSpinner"] = "EditSpinner"; 



